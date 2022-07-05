<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 1/31/2019
 * Time: 3:05 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\AssessmentModel;
use App\Model\Admin\UtilsModel;
use Illuminate\Support\Facades\Validator;

class AssessmentController extends Controller
{
    private $assessmentModel;
    private $utilsModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->assessmentModel = new AssessmentModel();
        $this->utilsModel = new UtilsModel();
    }

    public function index()
    {
        $questionnaries_list = $this->utilsModel->getAllQuestionnaries();
        return view('admin.assessment',
            [
                'questionnaries_list' =>$questionnaries_list,
                'active'=>'assessment',
            ]
        );
    }

    public function getAssessmentList(Request $request)
    {
        $questionnaries_id = $request->get("questionnaries_id");

        $questionnaries_id = isset($questionnaries_id) ? $questionnaries_id : null;

        $dtData = $this->getDataTableParams($request);
        $total_count = $this->assessmentModel->getAssessmentCount($questionnaries_id, $dtData);
        $list = $this->dataTableFormat($this->assessmentModel->getAssessmentList($questionnaries_id, $dtData), $total_count);

        return response()->json($list);
    }

    public function getAssessmentRate(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'session_id' => ['required', 'exists:t_assessment,session_id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $list = $this->assessmentModel->getAssessmentRate($params["session_id"]);

        return response()->json($this->configSuccessArray($list));
    }
}