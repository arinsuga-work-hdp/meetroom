<?php

/*
|--------------------------------------------------------------------------
| BO Routes
|--------------------------------------------------------------------------
|
| Here is where you can register BO routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** route group without prefix */
Route::group(['middleware'=>'lang'],function ()
{
    
    //Change Language
    Route::get('changelang/{lang}', function($lang){

        $setLang = 'en';
        if ( ($lang == null) || ($lang == '') ) {
            $setLang = 'en';
        } elseif ($lang == 'en') {
            $setLang = 'id';
        } else {
            $setLang = 'en';
        }

        \Session::put('lang',$setLang);

        return redirect()->back();
    })->name('change.lang');



    //Home
//    Route::resource('home', 'Home\HomeController');
    // Route::get('/', 'Home\HomeController@index')->name('home.index');
    Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');

    //Tes
    Route::resource('ddd', 'All\DddController');

    //activity dashboard
    Route::resource('dashboard', 'Dashboard\DashboardController');
    //activity
    Route::resource('activity', 'Activity\ActivityController');

    //bookroom faried
    Route::resource('bookfaried', 'Bookfaried\BookfariedController');
    Route::get('bookfaried-index-today', 'Bookfaried\BookfariedController@indexToday')->name('bookfaried.index.today');
    Route::get('bookfaried-index-open', 'Bookfaried\BookfariedController@indexOpen')->name('bookfaried.index.open');
    Route::get('bookfaried-index-cancel', 'Bookfaried\BookfariedController@indexCancel')->name('bookfaried.index.cancel');
    Route::get('bookfaried-index-custom', 'Bookfaried\BookfariedController@indexCustom')->name('bookfaried.index.custom');
    Route::post('bookfaried-index-custom-post', 'Bookfaried\BookfariedController@indexCustomPost')->name('bookfaried.index.custom.post');

    //bookroom status faried
    Route::get('bookfaried/{approve}/approve', 'Bookfaried\BookfariedController@approve')->name('bookfaried.approve');
    Route::put('bookfaried/{approve}/approve', 'Bookfaried\BookfariedController@updateApprove')->name('bookfaried.update.approve');
    Route::get('bookfaried/{reject}/reject', 'Bookfaried\BookfariedController@reject')->name('bookfaried.reject');
    Route::put('bookfaried/{reject}/reject', 'Bookfaried\BookfariedController@updateReject')->name('bookfaried.update.reject');
    Route::get('bookfaried/{cancel}/cancel', 'Bookfaried\BookfariedController@cancel')->name('bookfaried.cancel');
    Route::put('bookfaried/{cancel}/cancel', 'Bookfaried\BookfariedController@updateCancel')->name('bookfaried.update.cancel');

    //bookroom postmo
    Route::resource('bookpostmo', 'Bookpostmo\BookpostmoController');
    Route::get('bookpostmo-index-today', 'Bookpostmo\BookpostmoController@indexToday')->name('bookpostmo.index.today');
    Route::get('bookpostmo-index-open', 'Bookpostmo\BookpostmoController@indexOpen')->name('bookpostmo.index.open');
    Route::get('bookpostmo-index-cancel', 'Bookpostmo\BookpostmoController@indexCancel')->name('bookpostmo.index.cancel');
    Route::get('bookpostmo-index-custom', 'Bookpostmo\BookpostmoController@indexCustom')->name('bookpostmo.index.custom');
    Route::post('bookpostmo-index-custom-post', 'Bookpostmo\BookpostmoController@indexCustomPost')->name('bookpostmo.index.custom.post');

    //bookroom status postmo
    Route::get('bookpostmo/{approve}/approve', 'Bookpostmo\BookpostmoController@approve')->name('bookpostmo.approve');
    Route::put('bookpostmo/{approve}/approve', 'Bookpostmo\BookpostmoController@updateApprove')->name('bookpostmo.update.approve');
    Route::get('bookpostmo/{reject}/reject', 'Bookpostmo\BookpostmoController@reject')->name('bookpostmo.reject');
    Route::put('bookpostmo/{reject}/reject', 'Bookpostmo\BookpostmoController@updateReject')->name('bookpostmo.update.reject');
    Route::get('bookpostmo/{cancel}/cancel', 'Bookpostmo\BookpostmoController@cancel')->name('bookpostmo.cancel');
    Route::put('bookpostmo/{cancel}/cancel', 'Bookpostmo\BookpostmoController@updateCancel')->name('bookpostmo.update.cancel');
    
    //bookroom founder
    Route::resource('bookfounder', 'Bookfounder\BookfounderController');
    Route::get('bookfounder-index-today', 'Bookfounder\BookfounderController@indexToday')->name('bookfounder.index.today');
    Route::get('bookfounder-index-open', 'Bookfounder\BookfounderController@indexOpen')->name('bookfounder.index.open');
    Route::get('bookfounder-index-cancel', 'Bookfounder\BookfounderController@indexCancel')->name('bookfounder.index.cancel');
    Route::get('bookfounder-index-custom', 'Bookfounder\BookfounderController@indexCustom')->name('bookfounder.index.custom');
    Route::post('bookfounder-index-custom-post', 'Bookfounder\BookfounderController@indexCustomPost')->name('bookfounder.index.custom.post');

    //bookroom status founder
    Route::get('bookfounder/{approve}/approve', 'Bookfounder\BookfounderController@approve')->name('bookfounder.approve');
    Route::put('bookfounder/{approve}/approve', 'Bookfounder\BookfounderController@updateApprove')->name('bookfounder.update.approve');
    Route::get('bookfounder/{reject}/reject', 'Bookfounder\BookfounderController@reject')->name('bookfounder.reject');
    Route::put('bookfounder/{reject}/reject', 'Bookfounder\BookfounderController@updateReject')->name('bookfounder.update.reject');
    Route::get('bookfounder/{cancel}/cancel', 'Bookfounder\BookfounderController@cancel')->name('bookfounder.cancel');
    Route::put('bookfounder/{cancel}/cancel', 'Bookfounder\BookfounderController@updateCancel')->name('bookfounder.update.cancel');

    //bookroom interior
    Route::resource('bookinterior', 'Bookinterior\BookinteriorController');
    Route::get('bookinterior-index-today', 'Bookinterior\BookinteriorController@indexToday')->name('bookinterior.index.today');
    Route::get('bookinterior-index-open', 'Bookinterior\BookinteriorController@indexOpen')->name('bookinterior.index.open');
    Route::get('bookinterior-index-cancel', 'Bookinterior\BookinteriorController@indexCancel')->name('bookinterior.index.cancel');
    Route::get('bookinterior-index-custom', 'Bookinterior\BookinteriorController@indexCustom')->name('bookinterior.index.custom');
    Route::post('bookinterior-index-custom-post', 'Bookinterior\BookinteriorController@indexCustomPost')->name('bookinterior.index.custom.post');

    //bookroom status interior
    Route::get('bookinterior/{approve}/approve', 'Bookinterior\BookinteriorController@approve')->name('bookinterior.approve');
    Route::put('bookinterior/{approve}/approve', 'Bookinterior\BookinteriorController@updateApprove')->name('bookinterior.update.approve');
    Route::get('bookinterior/{reject}/reject', 'Bookinterior\BookinteriorController@reject')->name('bookinterior.reject');
    Route::put('bookinterior/{reject}/reject', 'Bookinterior\BookinteriorController@updateReject')->name('bookinterior.update.reject');
    Route::get('bookinterior/{cancel}/cancel', 'Bookinterior\BookinteriorController@cancel')->name('bookinterior.cancel');
    Route::put('bookinterior/{cancel}/cancel', 'Bookinterior\BookinteriorController@updateCancel')->name('bookinterior.update.cancel');

    //bookroom bulat
    Route::resource('bookbulat', 'Bookbulat\BookbulatController');
    Route::get('bookbulat-index-today', 'Bookbulat\BookbulatController@indexToday')->name('bookbulat.index.today');
    Route::get('bookbulat-index-open', 'Bookbulat\BookbulatController@indexOpen')->name('bookbulat.index.open');
    Route::get('bookbulat-index-cancel', 'Bookbulat\BookbulatController@indexCancel')->name('bookbulat.index.cancel');
    Route::get('bookbulat-index-custom', 'Bookbulat\BookbulatController@indexCustom')->name('bookbulat.index.custom');
    Route::post('bookbulat-index-custom-post', 'Bookbulat\BookbulatController@indexCustomPost')->name('bookbulat.index.custom.post');

    //bookroom status bulat
    Route::get('bookbulat/{approve}/approve', 'Bookbulat\BookbulatController@approve')->name('bookbulat.approve');
    Route::put('bookbulat/{approve}/approve', 'Bookbulat\BookbulatController@updateApprove')->name('bookbulat.update.approve');
    Route::get('bookbulat/{reject}/reject', 'Bookbulat\BookbulatController@reject')->name('bookbulat.reject');
    Route::put('bookbulat/{reject}/reject', 'Bookbulat\BookbulatController@updateReject')->name('bookbulat.update.reject');
    Route::get('bookbulat/{cancel}/cancel', 'Bookbulat\BookbulatController@cancel')->name('bookbulat.cancel');
    Route::put('bookbulat/{cancel}/cancel', 'Bookbulat\BookbulatController@updateCancel')->name('bookbulat.update.cancel');

    //Activity Support API
    Route::get('api-support-monthlybyyear/{year}', 'Activity\ActivityController@supportMonthlybyyear')->name('api.support.monthlybyyear');
    Route::get('api-incident-bycategory-monthinyear/{year}/{month}', 'Activity\ActivityController@incidentBycategoryMonthinyear')->name('api.incident.bycategory.monthinyear');

    //support
    Route::resource('support', 'Support\SupportController');
    Route::get('support-index-today', 'Support\SupportController@indexToday')->name('support.index.today');
    Route::get('support-index-open', 'Support\SupportController@indexOpen')->name('support.index.open');
    Route::get('support-index-custom', 'Support\SupportController@indexCustom')->name('support.index.custom');
    Route::post('support-index-custom-post', 'Support\SupportController@indexCustomPost')->name('support.index.custom.post');


    Route::get('support/{changeActivitysubtype}/change-activitysubtype', 'Support\SupportController@changeActivitysubtype')->name('support.change.activitysubtype');
    Route::put('support/{changeActivitysubtype}/change-activitysubtype', 'Support\SupportController@updateChangeActivitysubtype')->name('support.update.change.activitysubtype');

    Route::get('support-report-detail', 'Support\SupportController@reportDetail')->name('support.report.detail');
    Route::get('support-report-detail-custom', 'Support\SupportController@reportDetailCustom')->name('support.report.detail.custom');
    Route::post('support-report-detail-custom-post', 'Support\SupportController@reportDetailCustomPost')->name('support.report.detail.custom.post');

    Route::get('support/{reopen}/reopen', 'Support\SupportController@reopen')->name('support.reopen');
    Route::put('support/{reopen}/reopen', 'Support\SupportController@updateReopen')->name('support.update.reopen');

    Route::get('support/{close}/close', 'Support\SupportController@close')->name('support.close');
    Route::put('support/{close}/close', 'Support\SupportController@updateClose')->name('support.update.close');

    Route::get('support/{cancel}/cancel', 'Support\SupportController@cancel')->name('support.cancel');
    Route::put('support/{cancel}/cancel', 'Support\SupportController@updateCancel')->name('support.update.cancel');

    Route::get('support/{pending}/pending', 'Support\SupportController@pending')->name('support.pending');
    Route::put('support/{pending}/pending', 'Support\SupportController@updatePending')->name('support.update.pending');

    //maintenance
    Route::resource('maintenance', 'Maintenance\MaintenanceController');
    Route::get('maintenance-index-today', 'Maintenance\MaintenanceController@indexToday')->name('maintenance.index.today');
    Route::get('maintenance-index-open', 'Maintenance\MaintenanceController@indexOpen')->name('maintenance.index.open');
    Route::get('maintenance-index-custom', 'Maintenance\MaintenanceController@indexCustom')->name('maintenance.index.custom');
    Route::post('maintenance-index-custom-post', 'Maintenance\MaintenanceController@indexCustomPost')->name('maintenance.index.custom.post');

    Route::get('maintenance-report-detail', 'Maintenance\MaintenanceController@reportDetail')->name('maintenance.report.detail');
    Route::get('maintenance-report-detail-custom', 'Maintenance\MaintenanceController@reportDetailCustom')->name('maintenance.report.detail.custom');
    Route::post('maintenance-report-detail-custom-post', 'Maintenance\MaintenanceController@reportDetailCustomPost')->name('maintenance.report.detail.custom.post');

    Route::get('maintenance/{close}/close', 'Maintenance\MaintenanceController@close')->name('maintenance.close');
    Route::put('maintenance/{close}/close', 'Maintenance\MaintenanceController@updateClose')->name('maintenance.update.close');

    Route::get('maintenance/{cancel}/cancel', 'Maintenance\MaintenanceController@cancel')->name('maintenance.cancel');
    Route::put('maintenance/{cancel}/cancel', 'Maintenance\MaintenanceController@updateCancel')->name('maintenance.update.cancel');

    Route::get('maintenance/{pending}/pending', 'Maintenance\MaintenanceController@pending')->name('maintenance.pending');
    Route::put('maintenance/{pending}/pending', 'Maintenance\MaintenanceController@updatePending')->name('maintenance.update.pending');

    //project
    Route::resource('project', 'Project\ProjectController');
    Route::get('project-index-today', 'Project\ProjectController@indexToday')->name('project.index.today');
    Route::get('project-index-open', 'Project\ProjectController@indexOpen')->name('project.index.open');
    Route::get('project-index-custom', 'Project\ProjectController@indexCustom')->name('project.index.custom');
    Route::post('project-index-custom-post', 'Project\ProjectController@indexCustomPost')->name('project.index.custom.post');

    Route::get('project-report-detail', 'Project\ProjectController@reportDetail')->name('project.report.detail');
    Route::get('project-report-detail-custom', 'Project\ProjectController@reportDetailCustom')->name('project.report.detail.custom');
    Route::post('project-report-detail-custom-post', 'Project\ProjectController@reportDetailCustomPost')->name('project.report.detail.custom.post');

    Route::get('project/{reopen}/reopen', 'Project\ProjectController@reopen')->name('project.reopen');
    Route::put('project/{reopen}/reopen', 'Project\ProjectController@updateReopen')->name('project.update.reopen');

    Route::get('project/{close}/close', 'Project\ProjectController@close')->name('project.close');
    Route::put('project/{close}/close', 'Project\ProjectController@updateClose')->name('project.update.close');

    Route::get('project/{cancel}/cancel', 'Project\ProjectController@cancel')->name('project.cancel');
    Route::put('project/{cancel}/cancel', 'Project\ProjectController@updateCancel')->name('project.update.cancel');

    Route::get('project/{pending}/pending', 'Project\ProjectController@pending')->name('project.pending');
    Route::put('project/{pending}/pending', 'Project\ProjectController@updatePending')->name('project.update.pending');

    //master
    Route::resource('mastercategory', 'Mastercategory\MastercategoryController');
    
    Route::resource('mastersubcategory', 'Mastersubcategory\MastersubcategoryController');
    Route::get('subcategory/{tasktype}', 'Mastersubcategory\MastersubcategoryController@getJson')->name('subcategory.json');

    Route::resource('masteritem', 'Masteritem\MasteritemController');
    Route::get('item/{tasktype}/{tasksubtype1}', 'Masteritem\MasteritemController@getJson')->name('item.json');

    Route::resource('masterobjectmaintenance', 'Masterobjectmaintenance\MasterobjectmaintenanceController');

    Route::resource('masterproject', 'Masterproject\MasterprojectController');
    Route::get('project-json/{tasktype}', 'Masterproject\MasterprojectController@getJson')->name('projectjson.json');

    //employee
    Route::resource('employee', 'Employee\EmployeeController');

    //404 - Not Found
    Route::fallback(function () {

        abort(404, 'Not Found.');
        // return '<h1>Not Found</h1>';
    });

}); //end route group 'middleware'=>'lang'


/** route prefix admin */
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        
        //return view('bo.index');
        return '<H1>ADMIN PAGE</H1>';

    })->name('admin');

    //All
    Route::resource('all', 'All\AllController');
    //UserAuth
    Route::get('AuthAdmin/login','AuthAdmin\UserController@showLoginForm')->name('AuthAdmin.login');
    Route::post('AuthAdmin/login','AuthAdmin\UserController@login');
    Route::post('AuthAdmin/logout','AuthAdmin\UserController@logout')->name('AuthAdmin.logout');
    //UserAdmin
    Route::get('UserAdmin/{UserAdmin}/delete','UserAdmin\UserController@delete')->name('UserAdmin.delete');
    Route::resource('UserAdmin', 'UserAdmin\UserController');
    //User
    Route::resource('user', 'User\UserController');
    //Home
    Route::resource('home', 'Home\HomeController');
    //productsubtype
    Route::resource('productsubtype', 'Productsubtype\ProductsubtypeController');
    //product
    Route::resource('product', 'Product\ProductController');
    //event
    Route::resource('event', 'Event\EventController');
    //news
    Route::resource('news', 'News\NewsController');

    //404 - Not Found
    Route::fallback(function () {

        abort(404, 'Not Found.');
        // return '<h1>Not Found</h1>';
    });

}); //end route prefix bo
