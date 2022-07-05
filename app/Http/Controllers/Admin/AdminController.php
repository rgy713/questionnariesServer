<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\AdminModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $adminModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->adminModel = new AdminModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->administrator == 1)
            return view('admin.admin', [
                "active" => "admin"
            ]);
        else
            return redirect()->route('admin.home');
    }

    public function getAdminList(Request $request)
    {
        $dtData = $this->getDataTableParams($request);
        $total_count = $this->adminModel->getAdminCount($dtData);
        $list = $this->dataTableFormat($this->adminModel->getAdminList($dtData), $total_count);

        return response()->json($list);
    }

    public function addAdmin(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'uid' => ['required', 'string', 'max:64', 'unique:t_admin'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:16', 'unique:t_admin'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:t_admin'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->adminModel->addAdmin($params['uid'], $params['name'], $params['email'], $params['phone'], Hash::make($params['password']), $params['password']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateAdmin(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' => ['required', 'exists:t_admin,id'],
            'uid' => ['required', 'string', 'max:64', 'unique:t_admin,uid,' . $params['id']],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:16', 'unique:t_admin,phone,' . $params['id']],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:t_admin,email,' . $params['id']],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->adminModel->updateAdmin($params['id'], $params['uid'], $params['name'], $params['email'], $params['phone'], Hash::make($params['password']), $params['password']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function deleteAdmin(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' => ['required', 'exists:t_admin,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }
        $this->adminModel->deleteAdmin($params['id']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function updateAgreeStatus(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' => ['required', 'exists:t_admin,id'],
            'agree_status' => ['required', 'ingeter', 'max:1'],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->adminModel->updateAgreeStatus($params['id'], $params['agree_status']);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function adminProfile()
    {
        return view('admin.profile', ["active"=>""]);
    }

    public function updateAdminProfile(Request $request)
    {
        $params = $request->all();
        $params["id"] = Auth::user()->id;
        $validator = Validator::make($params, [
            'uid' => ['required', 'string', 'max:64', 'unique:t_admin,uid,' . $params['id']],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:16', 'unique:t_admin,phone,' . $params['id']],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:t_admin,email,' . $params['id']],
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        $this->adminModel->updateAdminProfile($params);

        return response()->json($this->configSuccessArray("SUCCESS"));
    }

    public function changeAdminPassword(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required','same:new_password']
        ]);

        if ($validator->fails()) {
            return response()->json($this->configFailArray($validator->errors()->all()));
        }

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json($this->configFailArray("Current password does not match!"));
        }

        $this->adminModel->changePassword(Auth::user()->id, Hash::make($request->new_password));

        return response()->json($this->configSuccessArray("SUCCESS"));
    }
}
