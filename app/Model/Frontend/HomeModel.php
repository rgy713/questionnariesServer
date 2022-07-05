<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 11/22/2018
 * Time: 4:13 PM
 */

namespace App\Model\Frontend;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;

class HomeModel extends BaseModel
{
    public function getQuestionnaries()
    {
        $locale = \App::getLocale();
        $result = DB::table("t_questionnaries")
            ->select(["id", "title_{$locale} as title", "content_{$locale} as content", "image",
                "rate_tooltip_{$locale} as rate_tooltip", "summary_{$locale} as summary",
                "summary25_{$locale} as summary25", "summary50_{$locale} as summary50", "summary75_{$locale} as summary75", "summary100_{$locale} as summary100",
                "score_image25", "score_image50", "score_image75", "score_image100"])
            ->first();
        return $result;
    }

    public function getQuestionnariesById($id)
    {
        $locale = \App::getLocale();
        $result = DB::table("t_questionnaries")
            ->select(["id", "title_{$locale} as title", "content_{$locale} as content", "image",
                "rate_tooltip_{$locale} as rate_tooltip", "summary_{$locale} as summary",
                "summary25_{$locale} as summary25", "summary50_{$locale} as summary50", "summary75_{$locale} as summary75", "summary100_{$locale} as summary100",
                "score_image25", "score_image50", "score_image75", "score_image100"])
            ->where('id',$id)
            ->first();
        return $result;
    }

    public function getQuestionTypeList($questionnaries_id)
    {
        $locale = \App::getLocale();
        $result = DB::table("t_question_type")
            ->select(["id", "type_{$locale} as type", "content_{$locale} as content", "pdf_content_{$locale} as pdf_content", "pdf_do_{$locale} as pdf_do", "pdf_donot_{$locale} as pdf_donot", "image"])
            ->where('questionnaries_id', $questionnaries_id)
            ->get();
        return $result;
    }

    public function getQuestionList($type_id)
    {
        $locale = \App::getLocale();
        $result = DB::table("t_question")
            ->select(["id", "question_{$locale} as question"])
            ->where([
                ['type_id', $type_id]
            ])
            ->get();
        return $result;
    }

    public function getQuestionIdList($questionnaries_id)
    {
        $sql_query="
            SELECT
                t0.id
            FROM t_question AS t0
            LEFT JOIN t_question_type AS t1 ON t0.type_id = t1.id
            LEFT JOIN t_questionnaries AS t2 ON t1.questionnaries_id = t2.id
            WHERE t2.id = {$questionnaries_id}            
        ";
        $list = DB::select($sql_query);

        return $list;
    }

    public function addUser($params)
    {
        $user_id = DB::table("t_user")
            ->insertGetId([
                "firstname" => $params["firstname"],
                "lastname" => $params["lastname"],
                "email" => $params["email"]
            ]);
        return $user_id;
    }

    public function getUserByEmail($email){
        $user = DB::table("t_user")
            ->where('email', $email)
            ->first();
        return $user;
    }

    public function getAssessment($session_id){
        $data = DB::table("t_assessment")
            ->where('session_id', $session_id)
            ->first();
        return $data;
    }

    public function addAssessment($params)
    {
        $id = DB::table("t_assessment")
            ->insertGetId([
                "ip_addr" => $params["ip_addr"],
                "country" => $params["country"],
                "city" => $params["city"],
                "latitude" => $params["latitude"],
                "longitude" => $params["longitude"],
                "session_id" => $params["session_id"],
                "questionnaries_id" => $params["questionnaries_id"]
            ]);
        return $id;
    }

    public function updateAssessment($id, $user_id)
    {
        $id = DB::table("t_assessment")
            ->where("id", $id)
            ->update([
                "user_id" => $user_id,
            ]);
        return $id;
    }

    public function getAssessmentAVGRate($assessment_id){
        $avg_rate = DB::table("t_assessment_rate")
            ->where('assessment_id', $assessment_id)
            ->avg('rate');
        return $avg_rate;
    }

    public function getAssessmentRate($assessment_id){
        $avg_rate = DB::table("t_assessment_rate")
            ->where('assessment_id', $assessment_id)
            ->get();
        return $avg_rate;
    }

    public function addAssessmentRate($params)
    {
        foreach($params as $param){
            DB::table("t_assessment_rate")
                ->insertGetId([
                    "assessment_id" => $param["assessment_id"],
                    "question_id" => $param["question_id"],
                    "rate" => $param["rate"]
                ]);
        }
    }
}