<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 12/5/2018
 * Time: 12:29 AM
 */

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Support\Facades\DB;


class UserModel extends BaseModel
{
    public function getUserCount($dtData)
    {

        $sql_where = $this->where($this->prepareOr(
            $this->clause('t1.name', $dtData),
            $this->prepareOr(
                $this->clause('t1.email', $dtData),
                $this->clause('t2.name', $dtData)
            )
        )
        );

        $sql_query = "
                SELECT
                    t1.*,
                    t2.name AS company_name
                FROM users AS t1
                LEFT JOIN company AS t2 ON t1.company_id = t2.id
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getUserList($dtData)
    {

        $sql_where = $this->where($this->prepareOr(
            $this->clause('t1.name', $dtData),
            $this->prepareOr(
                $this->clause('t1.email', $dtData),
                $this->clause('t2.name', $dtData)
            )
        )
        );

        $sql_query = "
                SELECT
                    t1.*,
                    t2.name AS company_name
                FROM users AS t1
                LEFT JOIN company AS t2 ON t1.company_id = t2.id
                " . $sql_where;


        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function getAllCompany()
    {
        $list = DB::table("company")
            ->get();

        return $list;
    }

    public function addUser($name, $email, $password, $pw_text, $company_id)
    {
        DB::table("users")
            ->insertGetId([
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "pw_text" => $pw_text,
                "company_id" => $company_id
            ]);
    }

    public function updateUser($id, $name, $email, $password, $pw_text, $company_id)
    {
        DB::table("users")
            ->where("id", $id)
            ->update([
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "pw_text" => $pw_text,
                "company_id" => $company_id
            ]);
    }

    public function deleteUser($id)
    {
        DB::table("users")
            ->where("id", $id)
            ->delete();
    }

    public function getUserDetailCount($user_id, $dtData)
    {

        $sql_where = $this->where($this->prepareOr(
            $this->clause('operator_id', $dtData),
            $this->prepareOr(
                $this->clause('container_id', $dtData),
                $this->prepareOr(
                    $this->clause('pi_id', $dtData),
                    $this->clause('site', $dtData)
                )
            )
        )
        );

        $sql_query = "
                SELECT
                    *                    
                FROM user_detail
                WHERE user_id = {$user_id}
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getUserDetailList($user_id, $dtData)
    {

        $sql_where = $this->where($this->prepareOr(
            $this->clause('operator_id', $dtData),
            $this->prepareOr(
                $this->clause('container_id', $dtData),
                $this->prepareOr(
                    $this->clause('pi_id', $dtData),
                    $this->clause('site', $dtData)
                )
            )
        )
        );

        $sql_query = "
                SELECT
                    *                    
                FROM user_detail
                WHERE user_id = {$user_id}
                " . $sql_where;


        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function addUserDetail($user_id, $operator_id, $container_id, $pi_id, $site, $is_synchronized)
    {
        DB::table("user_detail")
            ->insertGetId([
                "user_id" => $user_id,
                "operator_id" => $operator_id,
                "container_id" => $container_id,
                "pi_id" => $pi_id,
                "site" => $site,
                "is_synchronized" => $is_synchronized,
            ]);
    }

    public function updateUserDetail($id, $user_id, $operator_id, $container_id, $pi_id, $site)
    {
        DB::table("user_detail")
            ->where("id", $id)
            ->update([
                "user_id" => $user_id,
                "operator_id" => $operator_id,
                "container_id" => $container_id,
                "pi_id" => $pi_id,
                "site" => $site,
            ]);
    }

    public function deleteUserDetail($id)
    {
        DB::table("user_detail")
            ->where("id", $id)
            ->delete();
    }

}