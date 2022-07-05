<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'Frontend\HomeController@index')->name('frontend.home');


//Auth::routes();

Route::get('locale/{locale}', function($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::post('assessment', 'Frontend\HomeController@addAssessment')->name('frontend.addAssessment');
Route::get('assessment/{session_id}', 'Frontend\HomeController@viewResult')->name('frontend.viewResult');
Route::post('assessment/{session_id}', 'Frontend\HomeController@addResult')->name('frontend.addResult');
Route::get('download-pdf/{session_id}/{locale}', 'Frontend\HomeController@downloadPDF')->name('frontend.downloadPDF');
Route::get('thanks', 'Frontend\HomeController@thanks')->name('frontend.thanks');

Route::prefix('admin')->group(function()
{
    Route::get('/', function(){
        return redirect('/admin/home');
    });

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
    Route::post('/home/get-assessment-info', 'Admin\HomeController@getAssessmentInfo')->name('admin.getAssessmentInfo');

    Route::get('/profile', 'Admin\AdminController@adminProfile')->name('admin.profile');
    Route::post('/update-admin-profile', 'Admin\AdminController@updateAdminProfile')->name('admin.updateAdminProfile');
    Route::post('/change-admin-password', 'Admin\AdminController@changeAdminPassword')->name('admin.changeAdminPassword');

    Route::get('/admin', 'Admin\AdminController@index')->name('admin.admin');
    Route::post('/get-admin-list', 'Admin\AdminController@getAdminList')->name('admin.getAdminList');
    Route::post('/add-admin', 'Admin\AdminController@addAdmin')->name('admin.addAdmin');
    Route::post('/update-admin', 'Admin\AdminController@updateAdmin')->name('admin.updateAdmin');
    Route::post('/delete-admin', 'Admin\AdminController@deleteAdmin')->name('admin.deleteAdmin');
    Route::post('/update-agree-status', 'Admin\AdminController@updateAgreeStatus')->name('admin.updateAgreeStatus');

    Route::get('/assessment', 'Admin\AssessmentController@index')->name('admin.assessment');
    Route::post('/get-assessment-list', 'Admin\AssessmentController@getAssessmentList')->name('admin.getAssessmentList');
    Route::post('/get-assessment-rate', 'Admin\AssessmentController@getAssessmentRate')->name('admin.getAssessmentRate');

    Route::get('/questionnaries', 'Admin\QuestionnariesController@index')->name('admin.questionnaries');
    Route::post('/get-questionnaries-list', 'Admin\QuestionnariesController@getQuestionnariesList')->name('admin.getQuestionnariesList');
    Route::post('/add-questionnaries', 'Admin\QuestionnariesController@addQuestionnaries')->name('admin.addQuestionnaries');
    Route::post('/update-questionnaries', 'Admin\QuestionnariesController@updateQuestionnaries')->name('admin.updateQuestionnaries');
    Route::post('/delete-questionnaries', 'Admin\QuestionnariesController@deleteQuestionnaries')->name('admin.deleteQuestionnaries');

    Route::get('/question-type', 'Admin\QuestionTypeController@index')->name('admin.questionType');
    Route::post('/get-question-type-list', 'Admin\QuestionTypeController@getQuestionTypeList')->name('admin.getQuestionTypeList');
    Route::post('/add-question-type', 'Admin\QuestionTypeController@addQuestionType')->name('admin.addQuestionType');
    Route::post('/update-question-type', 'Admin\QuestionTypeController@updateQuestionType')->name('admin.updateQuestionType');
    Route::post('/delete-question-type', 'Admin\QuestionTypeController@deleteQuestionType')->name('admin.deleteQuestionType');

    Route::get('/question', 'Admin\QuestionController@index')->name('admin.question');
    Route::post('/get-question-list', 'Admin\QuestionController@getQuestionList')->name('admin.getQuestionList');
    Route::post('/add-question', 'Admin\QuestionController@addQuestion')->name('admin.addQuestion');
    Route::post('/update-question', 'Admin\QuestionController@updateQuestion')->name('admin.updateQuestion');
    Route::post('/delete-question', 'Admin\QuestionController@deleteQuestion')->name('admin.deleteQuestion');

    Route::post('/utils/get-question-type-list', 'Admin\UtilsController@getQuestionTypeList')->name('admin.utils.getQuestionTypeList');
});