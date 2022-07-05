<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 1/18/2019
 * Time: 4:45 PM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;

class QuestionTypeModel extends BaseModel
{
    public function getQuestionTypeCount($questionnaries_id, $dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('t0.questionnaries_id', $questionnaries_id, '='),
                $this->prepareOr(
                    $this->clause('t0.type_en', $dtData),
                    $this->clause('t0.content_en', $dtData)
                )
            )
        );

        $sql_query = "
                SELECT 
                  t0.*,
                  t1.title_en, 
                  t1.title_br 
                FROM t_question_type AS t0
                LEFT JOIN t_questionnaries AS t1 ON t0.questionnaries_id = t1.id                 
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getQuestionTypeList($questionnaries_id, $dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('t0.questionnaries_id', $questionnaries_id, '='),
                $this->prepareOr(
                    $this->clause('t0.type_en', $dtData),
                    $this->clause('t0.content_en', $dtData)
                )
            )
        );

        $sql_query = "
                SELECT 
                  t0.*,
                  t1.title_en,
                  t1.title_br 
                FROM t_question_type AS t0
                LEFT JOIN t_questionnaries AS t1 ON t0.questionnaries_id = t1.id                 
                " . $sql_where;

        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function addQuestionType($params)
    {
        DB::table("t_question_type")
            ->insertGetId([
                "questionnaries_id" => $params["questionnaries_id"],
                "type_en" => $params["type_en"],
                "type_br" => $params["type_br"],
                "content_en" => $params["content_en"],
                "content_br" => $params["content_br"],
                "pdf_content_en" => $params["pdf_content_en"],
                "pdf_content_br" => $params["pdf_content_br"],
                "pdf_do_en" => $params["pdf_do_en"],
                "pdf_do_br" => $params["pdf_do_br"],
                "pdf_donot_en" => $params["pdf_donot_en"],
                "pdf_donot_br" => $params["pdf_donot_br"],
                "image" => $params["image_path"]
            ]);
    }

    public function updateQuestionType($params)
    {
        $update_data = [
            "questionnaries_id" => $params["questionnaries_id"],
            "type_en" => $params["type_en"],
            "type_br" => $params["type_br"],
            "content_en" => $params["content_en"],
            "content_br" => $params["content_br"],
            "pdf_content_en" => $params["pdf_content_en"],
            "pdf_content_br" => $params["pdf_content_br"],
            "pdf_do_en" => $params["pdf_do_en"],
            "pdf_do_br" => $params["pdf_do_br"],
            "pdf_donot_en" => $params["pdf_donot_en"],
            "pdf_donot_br" => $params["pdf_donot_br"],
        ];
        if (isset($params["image_path"]))
            $update_data['image'] = $params["image_path"];

        DB::table("t_question_type")
            ->where("id", $params["id"])
            ->update($update_data);
    }

    public function deleteQuestionType($id)
    {
        DB::table("t_question_type")
            ->where("id", $id)
            ->delete();
    }

}