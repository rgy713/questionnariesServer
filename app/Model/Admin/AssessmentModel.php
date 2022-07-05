<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 1/31/2019
 * Time: 2:47 PM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;


class AssessmentModel extends BaseModel
{
    public function getAssessmentCount($questionnaries_id, $dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('questionnaries_id', $questionnaries_id, '='),
                $this->prepareOr(
                    $this->clause('name', $dtData),
                    $this->prepareOr(
                        $this->clause('email', $dtData),
                        $this->prepareOr(
                            $this->clause('country', $dtData),
                            $this->clause('title', $dtData)
                        )
                    )
                )
            )
        );

        $sql_query = "
                SELECT
                  t.*
                FROM (
                    SELECT
                        t0.*,
                        AVG(t1.rate) * 20 as avg_rate,
                        CONCAT(t2.lastname,' ',t2.firstname) as name,
                        t2.email,
                        t3.title_en as title
                    FROM t_assessment AS t0
                    LEFT JOIN t_assessment_rate AS t1 ON t0.id=t1.assessment_id
                    LEFT JOIN t_questionnaries AS t3 ON t0.questionnaries_id = t3.id                    
                    LEFT JOIN t_user AS t2 ON t0.user_id = t2.id                    
                    GROUP BY t0.id
                ) AS t
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getAssessmentList($questionnaries_id, $dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('questionnaries_id', $questionnaries_id, '='),
                $this->prepareOr(
                    $this->clause('name', $dtData),
                    $this->prepareOr(
                        $this->clause('email', $dtData),
                        $this->prepareOr(
                            $this->clause('country', $dtData),
                            $this->clause('title', $dtData)
                        )
                    )
                )
            )
        );

        $sql_query = "
                SELECT
                  t.*
                FROM (
                    SELECT
                        t0.*,
                        AVG(t1.rate) * 20 as avg_rate,
                        CONCAT(t2.lastname,' ',t2.firstname) as name,
                        t2.email,
                        t3.title_en as title
                    FROM t_assessment AS t0
                    LEFT JOIN t_assessment_rate AS t1 ON t0.id=t1.assessment_id
                    LEFT JOIN t_questionnaries AS t3 ON t0.questionnaries_id = t3.id                    
                    LEFT JOIN t_user AS t2 ON t0.user_id = t2.id                    
                    GROUP BY t0.id
                ) AS t
                " . $sql_where;

        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function getAssessmentRate($session_id)
    {
        $sql_query = "
            SELECT
                t0.rate,
                t2.title_en as title,
                t4.type_en as type,
                t3.question_en as question
            FROM t_assessment_rate AS t0
            LEFT JOIN t_assessment AS t1 ON t0.assessment_id = t1.id
            LEFT JOIN t_questionnaries AS t2 ON t1.questionnaries_id = t2.id
            LEFT JOIN t_question AS t3 ON t0.question_id = t3.id
            LEFT JOIN t_question_type AS t4 ON t3.type_id = t4.id
            WHERE t1.session_id = '{$session_id}' 
        ";
        $list = DB::select($sql_query);

        return $list;
    }
}