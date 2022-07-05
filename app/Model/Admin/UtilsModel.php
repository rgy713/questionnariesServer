<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 1/24/2019
 * Time: 5:04 PM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;

class UtilsModel extends BaseModel
{

    public function getAllQuestionnaries()
    {
        $list = DB::table("t_questionnaries")
            ->get();

        return $list;
    }

    public function getAllQuestionType($questionnaries_id)
    {
        $list = DB::table("t_question_type")
            ->where('questionnaries_id', $questionnaries_id)
            ->get();

        return $list;
    }
}