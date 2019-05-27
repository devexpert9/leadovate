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
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Auth::routes();
Route::post('/loginuser', 'Auth\LoginController@login')->name('loginuser');
Route::post('/upgradeplan', 'HomeController@upgradeplan');
Route::post('/register_user_add', 'Controller@register_user_add');
Route::post('/checkusername', 'Controller@checkusername');
Route::post('/checkuseremail', 'Controller@checkuseremail'); 
Route::post('/register_user', 'Controller@register_user');
Route::post('/resetcourse', 'HomeController@resetcourse');
Route::get('/notifications', 'HomeController@notifications');
Route::post('/delapp', 'HomeController@delapp');
Route::post('/viewlesson', 'HomeController@viewlesson');
Route::post('/delete_notification', 'AdminController@delete_notification');
Route::post('/startcourse', 'HomeController@startcourse');
Route::post('/enroll_course', 'HomeController@enroll_course');
Route::get('/all-courses', 'HomeController@all_courses');
Route::get('/all-courses/{id}', 'HomeController@all_coursess');
Route::post('/getwithlesson', 'HomeController@getwithlesson');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-cources', 'HomeController@all_cources')->name('home');
Route::get('/application-details/{id}', 'HomeController@application_details')->name('application_details');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/editprofile', 'HomeController@editprofile')->name('editprofile');
Route::post('/uploadprofile', 'HomeController@uploadprofile')->name('uploadprofile');
Route::get('/404_lesson', 'HomeController@lesson_not_found')->name('404_lesson');
Route::post('/update_status_notification', 'HomeController@update_status_notification');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::post('/getexamples_more', 'HomeController@getexamples_more')->name('getexamples_more');
Route::post('/delete_useractivity', 'HomeController@delete_useractivity')->name('delete_useractivity');
Route::post('/getexamples', 'HomeController@getexamples')->name('getexamples');
Route::post('/add-activity-user', 'HomeController@add_activity_user')->name('add_activity_user');
Route::post('/deleteactivitylist', 'HomeController@deleteactivitylist')->name('deleteactivitylist');
Route::get('/pricing', 'HomeController@pricing')->name('pricing');
Route::match(array('GET','POST'),'/getSignOut', 'HomeController@getSignOut')->name('getSignOut');	
Route::post('/user/googlelogin', 'HomeController@googlelogin')->name('googlelogin');	
Route::post('/user/facebooklogin', 'HomeController@facebooklogin')->name('facebooklogin');	
Route::get('/all-applications', 'HomeController@all_applications')->name('all-applications');	
Route::get('/all-completed', 'HomeController@all_completed')->name('all-completed');	
Route::match(array('GET','POST'),'/course-details/{id}', 'HomeController@course_details')->name('course-details');	
Route::match(array('GET','POST'),'/video-details/{id}', 'HomeController@video_details')->name('video-details');	
Route::match(array('GET','POST'),'/interactive-exercise/{id}', 'HomeController@interactive_exercise')->name('interactive-exercise');
Route::match(array('GET','POST'),'/learn-details/{id}', 'HomeController@learn_details')->name('learn-details');	
Route::get('/pricing-login', 'Controller@pricing_login')->name('pricing-login');
Route::get('/application_details', 'HomeController@application_details')->name('application_details');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/privacy-policy', 'Controller@privacy_policy')->name('privacy-policy');
Route::get('/terms-conditions', 'Controller@terms_conditions')->name('terms-conditions');
Route::get('/dynamic_pdf', 'DynamicPDFController@index');
Route::get('/dynamic_pdf/pdf/{id}', 'DynamicPDFController@pdf');
Route::get('/dynamic_pdf/pdf/{id}/{id1}', 'DynamicPDFController@pdfuser');

//admin
Route::prefix('admin')->group(function() {
    header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
Route::get('', function() {
  if(session()->exists('admin'))
    {   $data['mentors']=\App\Mentor::all();
        $data['user']=\App\User::getrecent();
        $data['courses']=\App\Course::all();
        $data['users_all']=\App\User::all();
        $userid =Session()->get('adminid');
        $data['admin'] = \App\Admin::where(array('id'=>$userid))->first();
        return view('/admin/dashboard',$data);
    }else
    {
        return view('auth.admin_login');  
    }
});
//admin routes
Route::post('/updateorder', 'AdminController@updateorder');
Route::post('/get_results', 'AdminController@get_results');
Route::post('/delete_notification', 'AdminController@delete_notification');
Route::post('/update_status_notification', 'AdminController@update_status_notification');
Route::post('/add_act', 'AdminController@add_act');
Route::post('/deleteheading', 'AdminController@deleteheading');
Route::post('/deleteeditheading', 'AdminController@deleteeditheading');
Route::post('/assign-user', 'AdminController@assign_user_mentor');
Route::post('/getpremium_users_mentor', 'AdminController@getpremium_users_mentor');
Route::post('/getpremium_users', 'AdminController@getpremium_users');
Route::post('/updatestatus', 'AdminController@updatestatus');
Route::post('/checkusername', 'AdminController@checkusername');
Route::post('/checkplanname', 'AdminController@checkplanname');
Route::post('/checkemail', 'AdminController@checkemail');
Route::post('/archive_record', 'AdminController@archive_record');
Route::post('/delete_record', 'AdminController@delete_record');
Route::post('/checkemailmentorwithid', 'AdminController@checkemailmentorwithid');
Route::post('/checkemailmentor', 'AdminController@checkemailmentor');
Route::post('/checkemailwithid', 'AdminController@checkemailwithid');
Route::post('/checkplannamewithid', 'AdminController@checkplannamewithid');
Route::post('/checkusernamewithid', 'AdminController@checkusernamewithid');
Route::get('/getSignOut', 'AdminController@getSignOut')->name('admin.getSignOut');
Route::post('/saveplan', 'AdminController@saveplan')->name('admin.saveplan');
Route::post('/getstates', 'AdminController@getstates')->name('admin.getstates');
Route::post('/edituser/{id}', 'AdminController@edituser')->name('admin.edituser');
Route::post('/updateimage', 'AdminController@updateimage')->name('admin.updateimage');
Route::match(array('GET','POST'),'/login', 'AdminController@logincheck')->name('admin.login');
Route::match(array('GET','POST'),'/profile', 'AdminController@profile')->name('admin.profile');
//Route::get('/admin', 'AdminController@login1')->name('login_admin');	
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');	
Route::get('/users', 'AdminController@users')->name('users');	
Route::get('/mentors', 'AdminController@mentors')->name('mentors');	
Route::get('/activities', 'AdminController@activities')->name('activities');	
Route::get('/archives', 'AdminController@archives')->name('archives');	
Route::get('/subscriptions', 'AdminController@subscriptions')->name('subscriptions');	
Route::get('/courses', 'AdminController@courses')->name('courses');	
Route::match(array('GET','POST'),'/add-course', 'AdminController@add_course')->name('add-course');	
Route::get('/exercise-list', 'AdminController@exercise_list')->name('exercise-list');	
Route::get('/add-exercise', 'AdminController@add_exercise')->name('add-exercise');	
Route::get('/notifications', 'AdminController@notifications')->name('notifications');	
Route::match(array('GET','POST'),'/add-user', 'AdminController@add_user')->name('admin.user');
Route::get('/view-user-progress/{id}', 'AdminController@view_user_progress')->name('view-user-progress');	
Route::match(array('GET','POST'),'/add-mentor', 'AdminController@add_mentor')->name('add-mentor');	
Route::match(array('GET','POST'),'/edit-mentor/{id}', 'AdminController@edit_mentor')->name('edit-mentor');	
Route::match(array('GET','POST'),'/assigned_user_list/{id}', 'AdminController@assigned_user_list')->name('admin.assigned_user_list');	
Route::get('/add-subscription', 'AdminController@add_subscription')->name('add-subscription');	
Route::match(array('GET','POST'),'/edit-subscription/{id}', 'AdminController@edit_subscription')->name('edit-subscription');	
Route::match(array('GET','POST'),'/edit-course/{id}', 'AdminController@edit_course')->name('edit-course');	
Route::get('/edit-exercise', 'AdminController@edit_exercise')->name('edit-exercise');	
Route::get('/privacy_policy', 'AdminController@privacy_policy')->name('admin.privacy_policy');
Route::get('/Social_links', 'AdminController@Social_links')->name('admin.Social_links');
Route::post('/addoptions', 'AdminController@addoptions')->name('admin.addoptions');
Route::get('/terms_conditions', 'AdminController@terms_conditions')->name('admin.terms_conditions');
});