<?php
/**
 * Created by PhpStorm.
 * Admin: rgy
 * Date: 11/22/2018
 * Time: 4:13 PM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;

class HomeModel extends BaseModel
{
    public function getAssessmentInfo()
    {
        $sql_query = "
                SELECT
                    t0.*,
                    t1.firstname,
                    t1.lastname                    
                FROM t_assessment AS t0
                LEFT JOIN t_user AS t1 ON t0.user_id = t1.id                
                ";

        $list = DB::select($sql_query);

        return $list;
    }

    public function getUserCount()
    {
        $count = DB::table("t_user")
            ->count();

        return $count;
    }

    public function getAssessmentCount()
    {
        $count = DB::table("t_assessment")
            ->count();

        return $count;
    }

    public function getPDFCount()
    {
        $count = DB::table("t_assessment")
            ->where('user_id','>',0)
            ->count();

        return $count;
    }

    public function getAssessmentRateCount()
    {
        $sql_query = "
                SELECT
                  t.*
                FROM (
                    SELECT
                        t0.*,
                        AVG(t1.rate) * 20 as avg_rate
                    FROM t_assessment AS t0
                    LEFT JOIN t_assessment_rate AS t1 ON t0.id=t1.assessment_id                                        
                    GROUP BY t0.id
                ) AS t
                WHERE t.avg_rate >= 75                
                ";

        $list = DB::select($sql_query);

        return count($list);
    }

    public function getAssessmentRateDist()
    {
        $sql_query = "
                SELECT
                  COUNT(IF(t.avg_rate<25,1, NULL)) AS count_25,
                  COUNT(IF(t.avg_rate>=25 AND avg_rate<50,1, NULL)) AS count_50,
                  COUNT(IF(t.avg_rate>=50 AND avg_rate<75,1, NULL)) AS count_75,
                  COUNT(IF(t.avg_rate>=75,1, NULL)) AS count_100
                FROM (
                    SELECT                        
                        AVG(t1.rate) * 20 as avg_rate
                    FROM t_assessment AS t0
                    LEFT JOIN t_assessment_rate AS t1 ON t0.id=t1.assessment_id                                        
                    GROUP BY t0.id
                ) AS t                            
                ";

        $data = DB::select($sql_query);

        return $data[0];
    }

    public function getMonthlyData()
    {
        $sql_query = "
                SELECT
                    COUNT(IF(MONTH(datetime)=MONTH(NOW()),1, NULL)) AS mon_0,
                    COUNT(IF(MONTH(datetime)=MONTH(NOW() - INTERVAL 1 MONTH),1, NULL)) AS mon_1,
                    COUNT(IF(MONTH(datetime)=MONTH(NOW() - INTERVAL 2 MONTH),1, NULL)) AS mon_2,
                    COUNT(IF(MONTH(datetime)=MONTH(NOW() - INTERVAL 3 MONTH),1, NULL)) AS mon_3,
                    COUNT(IF(MONTH(datetime)=MONTH(NOW() - INTERVAL 4 MONTH),1, NULL)) AS mon_4
                FROM t_assessment                
                ";

        $data = DB::select($sql_query);

        return $data[0];
    }
}