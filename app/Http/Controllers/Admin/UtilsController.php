<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 1/24/2019
 * Time: 5:03 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\UtilsModel;

class UtilsController extends Controller
{
    private $utilsModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->utilsModel = new UtilsModel();
    }

    public function getQuestionTypeList(Request $request)
    {
        $questionnaries_id = $request->get('questionnaries_id');

        if (!isset($questionnaries_id))
            return response()->json($this->configFailArray("ERR_NO_questionnaries_id"));

        $list = $this->utilsModel->getAllQuestionType($questionnaries_id);

        return response()->json($this->configSuccessArray($list));
    }
}