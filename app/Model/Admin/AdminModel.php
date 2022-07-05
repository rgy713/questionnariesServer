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

class AdminModel extends BaseModel
{
    public function getAdminCount($dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('administrator', '0', '='),
                $this->prepareOr(
                    $this->clause('uid', $dtData),
                    $this->prepareOr(
                        $this->clause('email', $dtData),
                        $this->prepareOr(
                            $this->clause('name', $dtData),
                            $this->clause('phone', $dtData)
                        )
                    )
                )
            )
        );

        $sql_query = "
                SELECT
                    *
                FROM t_admin                
                " . $sql_where;

        $count = count(DB::select($sql_query));

        return $count;
    }

    public function getAdminList($dtData)
    {

        $sql_where = $this->where(
            $this->prepareAnd(
                $this->clause2('administrator', '0', '='),
                $this->prepareOr(
                    $this->clause('uid', $dtData),
                    $this->prepareOr(
                        $this->clause('email', $dtData),
                        $this->prepareOr(
                            $this->clause('name', $dtData),
                            $this->clause('phone', $dtData)
                        )
                    )
                )
            )
        );

        $sql_query = "
                SELECT
                    *
                FROM t_admin                
                " . $sql_where;


        $sql_query .= $this->orderby($dtData);

        $sql_query .= $this->limit($dtData);

        $list = DB::select($sql_query);

        return $list;
    }

    public function addAdmin($uid, $name, $email, $phone, $password, $pw_text)
    {
        DB::table("t_admin")
            ->insertGetId([
                "uid" => $uid,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "password" => $password,
                "pw_text" => $pw_text,
                "agree_status" => 0,
                "administrator" => 0,
            ]);
    }

    public function updateAdmin($id, $uid, $name, $email, $phone, $password, $pw_text)
    {
        DB::table("t_admin")
            ->where("id", $id)
            ->update([
                "uid" => $uid,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "password" => $password,
                "pw_text" => $pw_text,
                "agree_status" => 0,
                "administrator" => 0,
            ]);
    }

    public function deleteAdmin($id)
    {
        DB::table("t_admin")
            ->where("id", $id)
            ->delete();
    }

    public function updateAgreeStatus($id, $agree_status)
    {
        DB::table("t_admin")
            ->where("id", $id)
            ->update([
                "agree_status" => $agree_status,
            ]);
    }

    public function updateAdminProfile($params)
    {
        DB::table("t_admin")
            ->where("id", $params["id"])
            ->update([
                "uid" => $params["uid"],
                "name" => $params["name"],
                "email" => $params["email"],
                "phone" => $params["phone"],
            ]);
    }

    public function changePassword($id, $password)
    {
        DB::table("t_admin")
            ->where("id", $id)
            ->update([
                "password" => $password,
            ]);
    }
}