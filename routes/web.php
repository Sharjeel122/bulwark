<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clear', function () {

    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "Cleared";
    //  return redirect()->route('home');

});

Route::get('email', function(){
    return view('email.credentials_template');
});
Route::post('custom-register', 'Auth\RegisterController@custom_register')->name('custom.register');

Auth::routes();


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.support.tickers');

        } elseif (Auth::user()->hasRole('customer')) {
            if (Auth::user()->lead == 1) {
                return redirect()->route('payment');
            } else {
                return redirect()->route('customer.support.tickers');
            }

        } else {
            // return redirect()->route('seeker-area.show', Auth::user()->id);
            return redirect()->route('home');
        }
    } else {
        return view('auth.login');
    }
});


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/payment/', 'HomeController@payment')->name('payment');
    Route::get('/website-details/{website}', 'HomeController@website_details')->name('website.details');

//   -------------Payment route------------
    Route::get('/execute-payment', 'PaymentController@execute')->name('execute.payment');
    Route::post('/create-payment', 'PaymentController@create')->name('create.payment');
    Route::get('/cancel-payment', 'PaymentController@cancel')->name('cancel.payment');

    //   -------------Plan Subscription route------------
    Route::get('/plan-create', 'SubscriptionController@create_plan')->name('plan.create');
    Route::get('/plan-list', 'SubscriptionController@list_plan')->name('list.plan');
    Route::get('/plan/{id}', 'SubscriptionController@plan_details')->name('plan');
    Route::get('/plan/{id}/activate', 'SubscriptionController@activate')->name('plan.activate');
    Route::get('/plan/{id}/delete', 'SubscriptionController@delete')->name('plan.delete');
    Route::get('/plan/{id}/update', 'SubscriptionController@update')->name('plan.update');
    Route::post('/plan/{id}/agreement/create', 'SubscriptionController@create_agreement')->name('create.agreement');
    Route::get('/execute-agreement/{success}', 'SubscriptionController@execute_agreement')->name('execute.agreement');
    Route::get('/execute-other/', 'SubscriptionController@execute_other')->name('execute.other');

//    -------------Admin route------------
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('admin', 'AdminController');
        Route::get('admin-all-customers', 'AdminController@all_customers')->name('admin.customers');
        Route::get('customer-websites/{id}', 'AdminController@customer_websites')->name('admin.customer.websites');
        Route::get('update-website/{id}', 'AdminController@update_website')->name('admin.update.website');
        Route::get('admin-all-leads', 'AdminController@all_leads')->name('admin.leads');
        Route::get('admin-create-customers', 'AdminController@create_customer')->name('admin.create.customer');
        Route::post('admin-store-customers', 'AdminController@store_customer')->name('admin.store.customer');
        Route::get('admin-support-tickers', 'AdminController@support_ticker')->name('admin.support.tickers');
        Route::get('admin-view-support-ticker/{id}', 'AdminController@view_ticker')->name('admin.view.ticker');
        Route::post('admin-reply-support-ticker', 'AdminController@reply_ticker')->name('admin.reply.ticker');
        Route::get('admin-close-support-ticker/{id}', 'AdminController@close_ticker')->name('admin.close.ticker');
        Route::get('admin-open-support-ticker/{id}', 'AdminController@open_ticker')->name('admin.open.ticker');
        Route::get('reports', 'AdminController@reports')->name('admin.reports');
        Route::post('upload-report', 'AdminController@upload_report')->name('admin.upload_report');
        Route::get('edit-report/{id}', 'AdminController@edit_report')->name('admin.edit_report');
        Route::put('update-report{id}', 'AdminController@update_report')->name('admin.update_report');
        Route::post('user-website', 'AdminController@user_websites')->name('admin.user_website');
        Route::get('admin-all-employees', 'AdminController@all_employees')->name('admin.employees');
        Route::get('admin-create-employee', 'AdminController@create_employee')->name('admin.create.employee');
        Route::post('admin-store-employee', 'AdminController@store_employee')->name('admin.store.employee');
        Route::get('admin-edit-employee/{id}', 'AdminController@edit_employee')->name('admin.edit.employee');
        Route::put('admin-update-employee/{id}', 'AdminController@update_employee')->name('admin.update.employee');
        Route::get('admin-reports-list/{id}', 'AdminController@report_list')->name('admin.report.list');
        Route::get('admin-verified-website', 'AdminController@verified')->name('admin.verified.website');
        Route::post('admin-send-email', 'AdminController@send_email')->name('admin.send.email');



        Route::resource('paypal-plan', 'PaypalPlanController');
    });

    //    -------------Customer route------------
    Route::group(['middleware' => ['role:customer']], function () {
        Route::resource('customer', 'UserController');
        Route::get('support-tickers', 'UserController@support_ticker')->name('customer.support.tickers');
        Route::get('generate-support-ticker', 'UserController@generate_ticker')->name('customer.generate.ticker');
        Route::post('send-support-ticker', 'UserController@send_ticker')->name('customer.send.ticker');
        Route::get('view-support-ticker/{id}', 'UserController@view_ticker')->name('customer.view.ticker');
        Route::post('reply-support-ticker', 'UserController@reply_ticker')->name('customer.reply.ticker');
        Route::get('close-support-ticker/{id}', 'UserController@close_ticker')->name('customer.close.ticker');
        Route::get('open-support-ticker/{id}', 'UserController@open_ticker')->name('customer.open.ticker');
        Route::put('update-website-info/{id}', 'UserController@update_website_info')->name('customer.update.website.info');
        Route::get('websites', 'UserController@view_websites')->name('customer.website');
        Route::get('website-detail/{id}', 'UserController@websites_detail')->name('customer.website.detail');
        Route::get('view-reports', 'UserController@reports')->name('customer.reports');
    });


    //    -------------Employee Common route------------

    Route::group(['middleware' => ['role:employee1|employee2']], function () {

        Route::resource('employee', 'EmployeeController');
        Route::get('employee-dashboard', 'EmployeeController@dashboard')->name('employee.dashboard');
//------------------reports-------------------------------------
        Route::get('employee-reports', 'EmployeeController@reports')->name('employee.reports');
        Route::post('employee-upload-report', 'EmployeeController@upload_report')->name('employee.upload_report');
        Route::get('employee-edit-report/{id}', 'EmployeeController@edit_report')->name('employee.edit_report');
        Route::put('employee-update-report{id}', 'EmployeeController@update_report')->name('employee.update_report');
        Route::post('employee-user-website', 'EmployeeController@user_websites')->name('employee.user_website');

        Route::get('employee-reports-list/{id}', 'EmployeeController@report_list')->name('employee.report.list');

//---------------------tickets------------------------------------
        Route::get('employee-support-tickers', 'EmployeeController@support_ticker')->name('employee.support.tickers');
        Route::get('employee-view-support-ticker/{id}', 'EmployeeController@view_ticker')->name('employee.view.ticker');
        Route::post('employee-reply-support-ticker', 'EmployeeController@reply_ticker')->name('employee.reply.ticker');
        Route::get('employee-close-support-ticker/{id}', 'EmployeeController@close_ticker')->name('employee.close.ticker');
        Route::get('employee-open-support-ticker/{id}', 'EmployeeController@open_ticker')->name('employee.open.ticker');


//---------------------customer------------------------------------
          Route::get('employee-all-customers', 'EmployeeController@all_customers')->name('employee.customers');
        Route::get('employee-website-list/{id}', 'EmployeeController@website_list')->name('employee.website.list');

    });


    //    -------------Employee1 route------------
    Route::group(['middleware' => ['role:employee1']], function () {

        Route::post('employee-send-email', 'EmployeeController@send_email')->name('employee.send.email');
        Route::post('employee-reminder-email', 'EmployeeController@reminder_email')->name('employee.reminder.email');
        Route::get('verified-website', 'EmployeeController@verified')->name('employee.verified.website');

    });

    //    -------------Employee2 route------------
    Route::group(['middleware' => ['role:employee2']], function () {

    });
});
