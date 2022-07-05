<?php
/**
 * Created by PhpStorm.
 * User: rgy
 * Date: 12/5/2018
 * Time: 12:28 AM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Model\Admin\UserModel;

class UserController extends Controller
{
    private $userModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $company_list = $this->userModel->getAllCompany();
        return view('admin.user', [
            "company_list" => $company_list,
            "active" => "user"
        ]);
    }

    public function getUserList(Request $request)
    {
        $dtData = $this->getDataTableParams($request);
        $total_count = $this->userModel->getUserCount($dtData);
        $list = $this->dataTableFormat($this->userModel->getUserList($dtData), $total_count);

        return response()->json($list);
    }

    public function addUser(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'company_id' =>['required', 'exists:company,id']
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->userModel->addUser($params['name'],$params['email'],Hash::make($params['password']),$params['password'],$params['company_id']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateUser(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' =>['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$params['id']],
            'password' => ['required', 'string', 'min:6'],
            'company_id' =>['required', 'exists:company,id']
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->userModel->updateUser($params['id'],$params['name'],$params['email'],Hash::make($params['password']),$params['password'],$params['company_id']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function deleteUser(Request $request)
    {
        $id = $request->get("id");
        if (!isset($id) || $id == null)
            return response()->json($this->configFailArray("ERR_NO_ID"));

        $this->userModel->deleteUser($id);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function getUserDetailList(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'user_id' =>['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $dtData = $this->getDataTableParams($request);
        $total_count = $this->userModel->getUserDetailCount($params['user_id'], $dtData);
        $list = $this->dataTableFormat($this->userModel->getUserDetailList($params['user_id'], $dtData), $total_count);

        return response()->json($list);
    }

    public function addUserDetail(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'user_id' =>['required', 'exists:users,id'],
            'operator_id' => ['required', 'string', 'max:200'],
            'container_id' => ['required', 'string', 'max:200'],
            'pi_id' => ['required', 'string', 'max:200'],
            'site' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->userModel->addUserDetail($params['user_id'],$params['operator_id'],$params['container_id'],$params['pi_id'],$params['site'], 0);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateUserDetail(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' =>['required', 'exists:user_detail,id'],
            'user_id' =>['required', 'exists:users,id'],
            'operator_id' => ['required', 'string', 'max:200'],
            'container_id' => ['required', 'string', 'max:200'],
            'pi_id' => ['required', 'string', 'max:200'],
            'site' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->userModel->updateUserDetail($params['id'],$params['user_id'],$params['operator_id'],$params['container_id'],$params['pi_id'],$params['site']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function deleteUserDetail(Request $request)
    {
        $id = $request->get("id");
        if (!isset($id) || $id == null)
            return response()->json($this->configFailArray("ERR_NO_ID"));

        $this->userModel->deleteUserDetail($id);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }


}