<?php
/**
 * Created by PhpStorm.
 * Question: rgy
 * Date: 1/18/2019
 * Time: 5:10 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\QuestionModel;
use App\Model\Admin\UtilsModel;
use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{
    private $questionModel;
    private $utilsModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->questionModel = new QuestionModel();
        $this->utilsModel = new UtilsModel();
    }

    public function index()
    {
        $questionnaries_list = $this->utilsModel->getAllQuestionnaries();
        return view('admin.question', [
            "questionnaries_list" => $questionnaries_list,
            "active" => "question"
        ]);
    }

    public function getQuestionList(Request $request)
    {
        $type_id = $request->get("type_id");

        $type_id = isset($type_id) ? $type_id : null;

        $dtData = $this->getDataTableParams($request);
        $total_count = $this->questionModel->getQuestionCount($type_id, $dtData);
        $list = $this->dataTableFormat($this->questionModel->getQuestionList($type_id, $dtData), $total_count);

        return response()->json($list);
    }

    public function addQuestion(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'question_en' => ['required', 'string', 'max:255'],
            'question_br' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'exists:t_question_type,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->questionModel->addQuestion($params['type_id'], $params["question_en"], $params["question_br"]);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateQuestion(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' => ['required', 'exists:t_question,id'],
            'question_en' => ['required', 'string', 'max:255'],
            'question_br' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'exists:t_question_type,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->questionModel->updateQuestion($params['id'], $params['type_id'], $params["question_en"], $params["question_br"]);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function deleteQuestion(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' => ['required', 'exists:t_question,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }
        $this->questionModel->deleteQuestion($params['id']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }
}