<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\HomeModel;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use PDF;

class HomeController extends Controller
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        $questionnary = $this->homeModel->getQuestionnaries();
        $question_type_list = $this->homeModel->getQuestionTypeList($questionnary->id);
        $questionnary->type_list = array();
        foreach ($question_type_list as $question_type) {
            $question_list = $this->homeModel->getQuestionList($question_type->id);
            $question_type->question_list = $question_list;
            array_push($questionnary->type_list, $question_type);
        }
        return view('welcome', [
            "questionnary" => $questionnary
        ]);
    }

    public function addAssessment(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'questionnaries_id' => ['required', 'exists:t_questionnaries,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $ip_addr = \Illuminate\Support\Facades\Request::ip();
        $get_location_url = "https://ipstack.com/ipstack_api.php?ip=";

        $response = json_decode(file_get_contents($get_location_url . $ip_addr), true);

        $params["country"] = $response["country_name"];
        $params["city"] = $response["region_name"];
        $params["latitude"] = $response["latitude"];
        $params["longitude"] = $response["longitude"];

        $session_id = md5(microtime());

        $params["ip_addr"] = $ip_addr;
        $params["session_id"] = $session_id;

        $assessment_id = $this->homeModel->addAssessment($params);

        $question_list = $this->homeModel->getQuestionIdList($params["questionnaries_id"]);

        $rate_list = array();
        $score = isset($params["score"]) ? $params["score"] : array();

        foreach ($question_list as $question) {
            $question_id = $question->id;
            $rate = isset($score[$question_id]) ? $score[$question_id] : 0;

            $rate_one = [
                "assessment_id" => $assessment_id,
                "question_id" => $question_id,
                "rate" => $rate
            ];
            array_push($rate_list, $rate_one);
        }

        $this->homeModel->addAssessmentRate($rate_list);

        return redirect("/assessment/{$session_id}");
    }

    public function viewResult(Request $request, $session_id)
    {
        $params = $request->all();
        $params["session_id"] = $session_id;
        $validator = Validator::make($params, [
            'session_id' => ['required', 'exists:t_assessment,session_id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $assessment = $this->homeModel->getAssessment($params["session_id"]);

        $avg_rate = $this->homeModel->getAssessmentAVGRate($assessment->id) * 20;

        $questionnary = $this->homeModel->getQuestionnariesById($assessment->questionnaries_id);

        $score_image = "";
        $summary = "";

        if ($avg_rate <= 25) {
            $score_image = $questionnary->score_image25;
            $summary = $questionnary->summary25;
        } else if ($avg_rate <= 50) {
            $score_image = $questionnary->score_image50;
            $summary = $questionnary->summary50;
        } else if ($avg_rate <= 75) {
            $score_image = $questionnary->score_image75;
            $summary = $questionnary->summary75;

        } else if ($avg_rate <= 100) {
            $score_image = $questionnary->score_image100;
            $summary = $questionnary->summary100;
        }

        return view('result', [
            "title" => $questionnary->title,
            "summary" => $summary,
            "score_image" => $score_image,
            "session_id" => $session_id,
            "mean_rate" => intval($avg_rate)
        ]);

    }

    public function addResult(Request $request, $session_id)
    {
        $params = $request->all();
        $params["session_id"] = $session_id;
        $validator = Validator::make($params, [
            'session_id' => ['required', 'exists:t_assessment,session_id'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $user = $this->homeModel->getUserByEmail($params["email"]);
        if (!isset($user)) {
            $user_id = $this->homeModel->addUser($params);
        } else {
            $user_id = $user->id;
        }

        $assessment = $this->homeModel->getAssessment($params["session_id"]);

        $this->homeModel->updateAssessment($assessment->id, $user_id);

        $avg_rate = $this->homeModel->getAssessmentAVGRate($assessment->id) * 20;

        $questionnary = $this->homeModel->getQuestionnariesById($assessment->questionnaries_id);

        $summary = "";

        if ($avg_rate <= 25) {
            $summary = $questionnary->summary25;
        } else if ($avg_rate <= 50) {
            $summary = $questionnary->summary50;
        } else if ($avg_rate <= 75) {
            $summary = $questionnary->summary75;
        } else if ($avg_rate <= 100) {
            $summary = $questionnary->summary100;
        }

        $data =
            [
                "session_id" => $session_id,
                "username" =>  $params["firstname"] . " " . $params["lastname"]
            ];

        try{
            Mail::to($params["email"])->send(new ContactMail($questionnary->title, $summary, $data));
        }catch (\Exception $e){
            return back()
                ->withInput()
                ->withErrors(['email_invalid' => 'email is invalid']);
        }
        return redirect("/thanks");
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function downloadPDF(Request $request, $session_id, $locale)
    {
        if (isset($locale))
            \App::setLocale($locale);

        $params = $request->all();
        $params["session_id"] = $session_id;
        $validator = Validator::make($params, [
            'session_id' => ['required', 'exists:t_assessment,session_id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $assessment = $this->homeModel->getAssessment($params["session_id"]);

        $avg_rate = $this->homeModel->getAssessmentAVGRate($assessment->id) * 20;

        $questionnary = $this->homeModel->getQuestionnariesById($assessment->questionnaries_id);

        $score_image = "";
        $summary = "";

        if ($avg_rate <= 25) {
            $score_image = $questionnary->score_image25;
            $summary = $questionnary->summary25;
        } else if ($avg_rate <= 50) {
            $score_image = $questionnary->score_image50;
            $summary = $questionnary->summary50;
        } else if ($avg_rate <= 75) {
            $score_image = $questionnary->score_image75;
            $summary = $questionnary->summary75;

        } else if ($avg_rate <= 100) {
            $score_image = $questionnary->score_image100;
            $summary = $questionnary->summary100;
        }

        $rate = array();
        $rate_list = $this->homeModel->getAssessmentRate($assessment->id);
        foreach ($rate_list as $one) {
            $rate[$one->question_id] = $one->rate;
        }

        $question_type_list = $this->homeModel->getQuestionTypeList($questionnary->id);
        $questionnary->type_list = array();
        foreach ($question_type_list as $question_type) {
            $question_list = $this->homeModel->getQuestionList($question_type->id);
            $question_data = array();
            $question_rate = 0;

            foreach ($question_list as $question) {
                $question->rate = $rate[$question->id];
                $question_rate += $rate[$question->id];
                array_push($question_data, $question);
            }

            $question_rate = $question_rate / count($question_list) * 20;

            if ($question_rate <= 25) {
                $question_score_image = $questionnary->score_image25;
                $question_summary = $questionnary->summary25;
            } else if ($question_rate <= 50) {
                $question_score_image = $questionnary->score_image50;
                $question_summary = $questionnary->summary50;
            } else if ($question_rate <= 75) {
                $question_score_image = $questionnary->score_image75;
                $question_summary = $questionnary->summary75;

            } else if ($question_rate <= 100) {
                $question_score_image = $questionnary->score_image100;
                $question_summary = $questionnary->summary100;
            }

            $question_type->question_list = (object)$question_data;
            $question_type->score_image = $question_score_image;
            $question_type->summary = $question_summary;
            $question_type->rate = intval($question_rate);

            array_push($questionnary->type_list, $question_type);
        }

        $data =
            [
                "questionnary" => $questionnary,
                "summary" => $summary,
                "score_image" => $score_image,
                "session_id" => $session_id,
                "mean_rate" => intval($avg_rate),
            ];

        $pdf = PDF::loadView('pdf', $data);

        return $pdf->download('result.pdf');
    }
}
