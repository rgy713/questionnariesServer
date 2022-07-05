<?php
/**
 * Created by PhpStorm.
 * User: server
 * Date: 6/1/2017
 * Time: 4:05 AM
 */

namespace App\Model;

class BaseModel
{
    public function clause($field, $params, $op = 'like')
    {
        if($params == null || !isset($params["search_key"]))
            return "";

        $value = addslashes($params["search_key"]);

        if ($value != "")
        {
            $clause = "";
            switch($op)
            {
                case '=':
                case '<>':
                case '>':
                case '<':
                    $clause = " " . $field . " " . $op . "'" . addslashes($value) . "' ";
                    break;
                case 'like':
                    $clause = " " . $field . " like '%" . addslashes($value) . "%' ";
                    break;
                case 'llike':
                    $clause = " " . $field . " like '%" . addslashes($value) . "' ";
                    break;
                case 'rlike':
                    $clause = " " . $field . " like '" . addslashes($value) . "%' ";
                    break;
                default:
                    $clause = " " . $field . $op . "'" . addslashes($value) . "%' ";
                    break;
            }

            return $clause;
        }
        else
            return "";
    }

    public function clause1($field, $params, $op = 'like')
    {
        if($params == null)
            return "";

        $value = addslashes($params);

        if ($value != "")
        {
            $clause = "";
            switch($op)
            {
                case '=':
                case '<>':
                case '>':
                case '<':
                    $clause = " " . $field . " " . $op . "'" . addslashes($value) . "' ";
                    break;
                case 'like':
                    $clause = " " . $field . " like '%" . addslashes($value) . "%' ";
                    break;
                case 'llike':
                    $clause = " " . $field . " like '%" . addslashes($value) . "' ";
                    break;
                case 'rlike':
                    $clause = " " . $field . " like '" . addslashes($value) . "%' ";
                    break;
                default:
                    $clause = " " . $field .  $op . "'" . addslashes($value) . "%' ";
                    break;
            }

            return $clause;
        }
        else
            return "";
    }

    public function clause2($field, $value, $op = 'like')
    {
        if($value == null)
            return "";

        $value = addslashes($value);

        if ($value != "")
        {
            $clause = "";
            switch($op)
            {
                case '=':
                case '<>':
                case '>':
                case '<':
                    $clause = " " . $field . " " . $op . "'" . addslashes($value) . "' ";
                    break;
                case 'like':
                    $clause = " " . $field . " like '%" . addslashes($value) . "%' ";
                    break;
                case 'llike':
                    $clause = " " . $field . " like '%" . addslashes($value) . "' ";
                    break;
                case 'rlike':
                    $clause = " " . $field . " like '" . addslashes($value) . "%' ";
                    break;
                default:
                    $clause = " " . $field .  $op . "'" . addslashes($value) . "%' ";
                    break;
            }

            return $clause;
        }
        else
            return "";
    }

    public function where($clause)
    {
        if($clause == "")
            return "";
        else
            return " WHERE " . $clause;
    }

    public function limit($params)
    {
        if($params == null || !isset($params['length']))
            return "";

        $length = $params['length'];

        if($length != "" && $length != "-1")
            return " LIMIT " . $params["start"] . ", " . $params["length"];
        else
            return "";
    }

    public function orderby($params)
    {
        if($params == null || !isset($params['sort_data']))
            return "";
        $sort_data = $params['sort_data'];
        $orderBy = "";
        foreach ($sort_data as $sort_one) {
            if($sort_one['sort_col'] != '')
            {
                $orderBy .= ($orderBy == ""  ?  " ORDER BY " : ", ");
                $orderBy .= " " . $sort_one["sort_col"] . " " . $sort_one["sort_direction"] . " ";
            }
        }
        return $orderBy;
    }

    public function prepareAnd($clause1, $clause2)
    {
        if($clause1 != '' && $clause2 != '')
        {
            return ' (' . $clause1 . ') AND (' . $clause2 . ') ';
        }
        else if($clause1 != '')
            return $clause1;
        else if($clause2 != '')
            return $clause2;
        else
            return '';
    }

    public function prepareOr($clause1, $clause2)
    {
        if($clause1 != '' && $clause2 != '')
        {
            return $clause1 . ' OR ' . $clause2;
        }
        else if($clause1 != '')
            return $clause1;
        else if($clause2 != '')
            return $clause2;
        else
            return '';
    }
}