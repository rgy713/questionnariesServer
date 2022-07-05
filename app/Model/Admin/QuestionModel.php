<?php
/**
 * Created by PhpStorm.
 * Question: rgy
 * Date: 1/18/2019
 * Time: 4:52 PM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;

class QuestionModel extends BaseModel
{
    public function getQuestionCount($type_id, $dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('t0.type_id', $type_id, '='),
                $this->prepareOr(
                    $this->clause('t0.question_en', $dtData),
                    $this->prepareOr(
                        $this->clause('t1.type_en', $dtData),
                        $this->clause('t2.title_en', $dtData)
                    )
                )
            )
        );

        $sql_query = "
                SELECT
                    t0.*,
                    t1.type_en AS type_en,
                    t1.questionnaries_id AS questionnaries_id,
                    t2.title_en AS title_en
                FROM t_question AS t0
                LEFT JOIN t_question_type AS t1 ON t0.type_id = t1.id
                LEFT JOIN t_questionnaries AS t2 ON t1.questionnaries_id = t2.id
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getQuestionList($type_id, $dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('t0.type_id', $type_id, '='),
                $this->prepareOr(
                    $this->clause('t0.question_en', $dtData),
                    $this->prepareOr(
                        $this->clause('t1.type_en', $dtData),
                        $this->clause('t2.title_en', $dtData)
                    )
                )
            )
        );

        $sql_query = "
                SELECT
                    t0.*,
                    t1.type_en AS type_en,
                    t1.questionnaries_id AS questionnaries_id,
                    t2.title_en AS title_en
                FROM t_question AS t0
                LEFT JOIN t_question_type AS t1 ON t0.type_id = t1.id
                LEFT JOIN t_questionnaries AS t2 ON t1.questionnaries_id = t2.id
                " . $sql_where;


        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function addQuestion($type_id, $question_en, $question_br)
    {
        DB::table("t_question")
            ->insertGetId([
                "type_id" => $type_id,
                "question_en" => $question_en,
                "question_br" => $question_br
            ]);
    }

    public function updateQuestion($id, $type_id, $question_en, $question_br)
    {
        DB::table("t_question")
            ->where("id", $id)
            ->update([
                "type_id" => $type_id,
                "question_en" => $question_en,
                "question_br" => $question_br
            ]);
    }

    public function deleteQuestion($id)
    {
        DB::table("t_question")
            ->where("id", $id)
            ->delete();
    }

}