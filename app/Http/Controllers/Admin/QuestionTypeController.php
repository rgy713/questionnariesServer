<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 1/18/2019
 * Time: 5:08 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\QuestionTypeModel;
use App\Model\Admin\UtilsModel;
use Illuminate\Support\Facades\Validator;

class QuestionTypeController extends Controller
{
    private $questionTypeModel;
    private $utilsModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->questionTypeModel = new QuestionTypeModel();
        $this->utilsModel = new UtilsModel();
    }

    public function index()
    {
        $questionnaries_list = $this->utilsModel->getAllQuestionnaries();
        return view('admin.question-type', [
            "questionnaries_list" => $questionnaries_list,
            "active" => "questionType"
        ]);
    }

    public function getQuestionTypeList(Request $request)
    {
        $questionnaries_id = $request->get("questionnaries_id");

        $questionnaries_id = isset($questionnaries_id) ? $questionnaries_id : null;

        $dtData = $this->getDataTableParams($request);
        $total_count = $this->questionTypeModel->getQuestionTypeCount($questionnaries_id, $dtData);
        $workshop_list = $this->dataTableFormat($this->questionTypeModel->getQuestionTypeList($questionnaries_id, $dtData), $total_count);

        return response()->json($workshop_list);
    }

    public function addQuestionType(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'questionnaries_id' =>['required', 'exists:t_questionnaries,id'],
            'type_en' => ['required', 'string', 'max:255'],
            'type_br' => ['required', 'string', 'max:255'],
            'content_en' => ['required', 'string'],
            'content_br' => ['required', 'string'],
            'pdf_content_en' => ['required', 'string'],
            'pdf_content_br' => ['required', 'string'],
            'pdf_do_en' => ['required', 'string'],
            'pdf_do_br' => ['required', 'string'],
            'pdf_donot_en' => ['required', 'string'],
            'pdf_donot_br' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
        $image_path = "/images/$imageName";
        $params["image_path"] = $image_path;

        $this->questionTypeModel->addQuestionType($params);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateQuestionType(Request $request)
    {

        $params = $request->all();
        $validator = Validator::make($params, [
            'id' =>['required', 'exists:t_question_type,id'],
            'questionnaries_id' =>['required', 'exists:t_questionnaries,id'],
            'type_en' => ['required', 'string', 'max:255'],
            'type_br' => ['required', 'string', 'max:255'],
            'content_en' => ['required', 'string'],
            'content_br' => ['required', 'string'],
            'pdf_content_en' => ['required', 'string'],
            'pdf_content_br' => ['required', 'string'],
            'pdf_do_en' => ['required', 'string'],
            'pdf_do_br' => ['required', 'string'],
            'pdf_donot_en' => ['required', 'string'],
            'pdf_donot_br' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        if (isset($params['image'])){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $image_path = "/images/$imageName";
        }
        else
            $image_path = null;

        $params["image_path"] = $image_path;
        $this->questionTypeModel->updateQuestionType($params);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function deleteQuestionType(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' =>['required', 'exists:t_question_type,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->questionTypeModel->deleteQuestionType($params['id']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }
}