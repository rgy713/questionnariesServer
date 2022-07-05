<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $msg
     * @param string $param
     * @return array
     */
    protected function configSuccessArray($content = "")
    {
        return ["type" => "success", "content" => $content];
    }

    /**
     * @param string $msg
     * @param string $param
     * @return array
     *
     */
    protected function configFailArray($content = "")
    {
        return ["type" => "fail", "content" => $content];
    }

    /**
     * @param $data
     * @param $total
     * @return array
     *
     */
    public function dataTableFormat($data, $total)
    {
        if (count($data) > 0) {
            $start = request('start');

            $i = 1;
            if (is_array($data[0])) {
                foreach ($data as &$one) {
                    $one["no"] = $start + $i;
                    $i++;
                }
            } else {
                foreach ($data as &$one) {
                    $one->no = $start + $i;
                    $i++;
                }
            }
        }

        $result = array(
            "data" => $data,
            "draw" => request("draw") + 1,
            "recordsFiltered" => $total,
            "recordsTotal" => $total
        );

        return $result;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getDataTableParams(Request $request)
    {
        $dt_data = array();
        $dt_data["search_key"] = $request->get("search")["value"];
        $dt_data["search_column"] =  $request->get("aoSearchCols");
        $dt_data["start"] = $request->get("start");
        $dt_data["length"] = $request->get("length");

        $temp_sort = $request->get("order");
        $i = 0;
        $sort_data = [];
        while(1){
            if(!isset($temp_sort[$i]))
                break;

            $sort_one = array();
            $sort_num = $temp_sort[$i]["column"];
            $sort_dir = $temp_sort[$i]["dir"];
            $sort_col_name = $request->get("columns")[$sort_num]["name"];

            $sort_one["sort_col_num"] = $sort_num;
            $sort_one["sort_col"] = $sort_col_name;
            $sort_one["sort_direction"] = $sort_dir;
            array_push($sort_data, $sort_one);
            $i++;
        }

        $dt_data['sort_data'] = $sort_data;
        return $dt_data;
    }
}
