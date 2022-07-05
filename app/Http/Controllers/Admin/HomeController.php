<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\HomeModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $homeModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->homeModel = new HomeModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_count = $this->homeModel->getUserCount();
        $assessment_count = $this->homeModel->getAssessmentCount();
        $download_count = $this->homeModel->getPDFCount();
        $assessment_rate_count = $this->homeModel->getAssessmentRateCount();
        $assessment_rate_dist = $this->homeModel->getAssessmentRateDist();
        $assessment_month_dist = $this->homeModel->getMonthlyData();
        return view('admin.home', [
            "active" => "home",
            "user_count" => $user_count,
            "assessment_count" => $assessment_count,
            "download_count" => $download_count,
            "assessment_rate_count" => $assessment_rate_count,
            "assessment_rate_dist" => $assessment_rate_dist,
            "assessment_month_dist" => $assessment_month_dist,
        ]);
    }

    public function getAssessmentInfo(Request $request)
    {
        $list = $this->homeModel->getAssessmentInfo();
        return response()->json($this->configSuccessArray($list));
    }
}
