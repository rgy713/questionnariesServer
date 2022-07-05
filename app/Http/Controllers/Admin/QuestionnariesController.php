<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 12/4/2018
 * Time: 12:57 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\QuestionnariesModel;
use Illuminate\Support\Facades\Validator;

class QuestionnariesController extends Controller
{
    private $questionnariesModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->questionnariesModel = new QuestionnariesModel();
    }

    public function index()
    {
        return view('admin.questionnaries' ,[
            "active" => "questionnaries"
        ]);
    }

    public function getQuestionnariesList(Request $request)
    {
        $dtData = $this->getDataTableParams($request);
        $total_count = $this->questionnariesModel->getQuestionnariesCount($dtData);
        $workshop_list = $this->dataTableFormat($this->questionnariesModel->getQuestionnariesList($dtData), $total_count);

        return response()->json($workshop_list);
    }

    public function addQuestionnaries(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'title_en' => ['required', 'string', 'max:255'],
            'title_br' => ['required', 'string', 'max:255'],
            'content_en' => ['required', 'string'],
            'content_br' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'rate_tooltip_en' => ['required', 'string'],
            'rate_tooltip_br' => ['required', 'string'],
            'summary_en' => ['required', 'string'],
            'summary_br' => ['required', 'string'],
            'summary25_en' => ['required', 'string'],
            'summary25_br' => ['required', 'string'],
            'summary50_en' => ['required', 'string'],
            'summary50_br' => ['required', 'string'],
            'summary75_en' => ['required', 'string'],
            'summary75_br' => ['required', 'string'],
            'summary100_en' => ['required', 'string'],
            'summary100_br' => ['required', 'string'],
            'score_image25' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'score_image50' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'score_image75' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'score_image100' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $imageName = 'images'.time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        $image_path = "/images/$imageName";
        $params["image"] = $image_path;

        $imageName = 'score_image25'.time().'.'.request()->score_image25->getClientOriginalExtension();
        request()->score_image25->move(public_path('images'), $imageName);
        $image_path = "/images/$imageName";
        $params["score_image25"] = $image_path;

        $imageName = 'score_image50'.time().'.'.request()->score_image50->getClientOriginalExtension();
        request()->score_image50->move(public_path('images'), $imageName);
        $image_path = "/images/$imageName";
        $params["score_image50"] = $image_path;

        $imageName = 'score_image75'.time().'.'.request()->score_image75->getClientOriginalExtension();
        request()->score_image75->move(public_path('images'), $imageName);
        $image_path = "/images/$imageName";
        $params["score_image75"] = $image_path;

        $imageName = 'score_image100'.time().'.'.request()->score_image100->getClientOriginalExtension();
        request()->score_image100->move(public_path('images'), $imageName);
        $image_path = "/images/$imageName";
        $params["score_image100"] = $image_path;

        $this->questionnariesModel->addQuestionnaries($params);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateQuestionnaries(Request $request)
    {

        $params = $request->all();
        $validator = Validator::make($params, [
            'id' =>['required', 'exists:t_questionnaries,id'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_br' => ['required', 'string', 'max:255'],
            'content_en' => ['required', 'string'],
            'content_br' => ['required', 'string'],
            'summary_en' => ['required', 'string'],
            'summary_br' => ['required', 'string'],
            'summary25_en' => ['required', 'string'],
            'summary25_br' => ['required', 'string'],
            'summary50_en' => ['required', 'string'],
            'summary50_br' => ['required', 'string'],
            'summary75_en' => ['required', 'string'],
            'summary75_br' => ['required', 'string'],
            'summary100_en' => ['required', 'string'],
            'summary100_br' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        if (isset($params['image'])){
            $imageName = 'image'.time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $image_path = "/images/$imageName";
        }
        else
            $image_path = null;
        $params["image"] = $image_path;

        if (isset($params['score_image25'])){
            $imageName = 'score_image25'.time().'.'.request()->score_image25->getClientOriginalExtension();
            request()->score_image25->move(public_path('images'), $imageName);
            $image_path = "/images/$imageName";
        }
        else
            $image_path = null;
        $params["score_image25"] = $image_path;

        if (isset($params['score_image50'])){
            $imageName = 'score_image50'.time().'.'.request()->score_image50->getClientOriginalExtension();
            request()->score_image50->move(public_path('images'), $imageName);
            $image_path = "/images/$imageName";
        }
        else
            $image_path = null;
        $params["score_image50"] = $image_path;

        if (isset($params['score_image75'])){
            $imageName = 'score_image75'.time().'.'.request()->score_image75->getClientOriginalExtension();
            request()->score_image75->move(public_path('images'), $imageName);
            $image_path = "/images/$imageName";
        }
        else
            $image_path = null;
        $params["score_image75"] = $image_path;

        if (isset($params['score_image100'])){
            $imageName = 'score_image100'.time().'.'.request()->score_image100->getClientOriginalExtension();
            request()->score_image100->move(public_path('images'), $imageName);
            $image_path = "/images/$imageName";
        }
        else
            $image_path = null;
        $params["score_image100"] = $image_path;


        $this->questionnariesModel->updateQuestionnaries($params);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function deleteQuestionnaries(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' =>['required', 'exists:t_questionnaries,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->questionnariesModel->deleteQuestionnaries($params['id']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

}