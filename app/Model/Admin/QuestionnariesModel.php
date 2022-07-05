<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 12/4/2018
 * Time: 1:03 AM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;


class QuestionnariesModel  extends BaseModel
{
    public function getQuestionnariesCount($dtData)
    {

        $sql_where = $this->where(
            $this->prepareOr(
                $this->clause('title_en', $dtData),
                $this->clause('content_en', $dtData)
            )
        );

        $sql_query = "
                SELECT 
                  * 
                FROM t_questionnaries                
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getQuestionnariesList($dtData)
    {

        $sql_where = $this->where(
            $this->prepareOr(
                $this->clause('title_en', $dtData),
                $this->clause('content_en', $dtData)
            )
        );

        $sql_query = "
                SELECT 
                  * 
                FROM t_questionnaries                
                " . $sql_where;

        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function addQuestionnaries($params)
    {
        DB::table("t_questionnaries")
            ->insertGetId([
                "title_en" => $params["title_en"],
                "title_br" => $params["title_br"],
                "content_en" => $params["content_en"],
                "content_br" => $params["content_br"],
                "image" => $params["image"],
                'rate_tooltip_en' => $params['rate_tooltip_en'],
                'rate_tooltip_br' => $params['rate_tooltip_br'],
                'summary_en' => $params['summary_en'],
                'summary_br' => $params['summary_br'],
                'summary25_en' => $params['summary25_en'],
                'summary25_br' => $params['summary25_br'],
                'summary50_en' => $params['summary50_en'],
                'summary50_br' => $params['summary50_br'],
                'summary75_en' => $params['summary75_en'],
                'summary75_br' => $params['summary75_br'],
                'summary100_en' => $params['summary100_en'],
                'summary100_br' => $params['summary100_br'],
                'score_image25' => $params['score_image25'],
                'score_image50' => $params['score_image50'],
                'score_image75' => $params['score_image75'],
                'score_image100' => $params['score_image100'],
            ]);
    }

    public function updateQuestionnaries($params)
    {
        $update_data = [
            "title_en" => $params["title_en"],
            "title_br" => $params["title_br"],
            "content_en" => $params["content_en"],
            "content_br" => $params["content_br"],
            'rate_tooltip_en' => $params['rate_tooltip_en'],
            'rate_tooltip_br' => $params['rate_tooltip_br'],
            'summary_en' => $params['summary_en'],
            'summary_br' => $params['summary_br'],
            'summary25_en' => $params['summary25_en'],
            'summary25_br' => $params['summary25_br'],
            'summary50_en' => $params['summary50_en'],
            'summary50_br' => $params['summary50_br'],
            'summary75_en' => $params['summary75_en'],
            'summary75_br' => $params['summary75_br'],
            'summary100_en' => $params['summary100_en'],
            'summary100_br' => $params['summary100_br'],
        ];
        if (isset($params['image']))
            $update_data["image"] = $params['image'];
        if (isset($params['score_image25']))
            $update_data["score_image25"] = $params['score_image25'];
        if (isset($params['score_image50']))
            $update_data["score_image50"] = $params['score_image50'];
        if (isset($params['score_image75']))
            $update_data["score_image75"] = $params['score_image75'];
        if (isset($params['score_image100']))
            $update_data["score_image100"] = $params['score_image100'];

        DB::table("t_questionnaries")
            ->where("id", $params['id'])
            ->update($update_data);
    }

    public function deleteQuestionnaries($id)
    {
        DB::table("t_questionnaries")
            ->where("id", $id)
            ->delete();
    }

}