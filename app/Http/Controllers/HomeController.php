<?php

namespace App\Http\Controllers;
use Session;use Redirect;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Country;
use App\Course;
use App\Activity;
use App\Useractivity;
use App\Subscription;
use App\Transaction;
use App\Usercourse;
use App\Syllabus;
use App\Lesson;
use App\Example;
use App\Feature;
use App\User;
use App\Userlesson;
use App\Notification;
use Illuminate\Support\Facades\Hash;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Redirector $redirect)
    {
         $this->middleware(function ($request, $next){
             if(Session()->exists('user'))
            { 
           
              $userid =Session()->get('userid');
              $were= [['id','=',$userid],['status','=','1']];
              $exists= User::getUsermatch($were);
              if(count($exists) > 0)
              { 
                  $exists2= User::getbycondition($were);
                $user_id = session('user_id');
                return $next($request);
              }else
              { 
                $this->middleware('auth');
                Auth::logout();
                Session::flush('user');
                session()->forget('user');
                session()->flush('user');
                return Redirect('/'); 
              }
            }
              return $next($request);
            });
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
     public function facebooklogin(Request $request)
    {
           $messags = array();
                if($request->isMethod('post'))
                {
                    $data = $request->all();
                 
                    $data['status'] = '1';
                   if(!empty($data['fb_id']) || !empty($data['email']))
                   {
                       if(!empty($data['email']))
                       {
                           $condition1 = [['email','=',$data['email']],['status','!=','2']];
                           $d1 = User::getUsermatch($condition1);
                               if(count($d1) > 0)
                               {
                                   $condition2 = [['email','=',$data['email']],['status','!=','0']];
                                   $d2 = User::getUsermatch($condition2);
                                    if(count($d2) > 0)
                                    {
                                        
                                      $userdatas = User::getbycondition(array('email'=>$data['email']));
                                      	if(count($userdatas)>0  && !empty($userdatas))
                                        {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
	                                        Session::save(); 
                                        }
                                        $messags['message'] = "You logged in successfully.";
                                        $messags['erro']= 101;
                                        $messags['url']= url('/home'); 
                                    }else
                                    {
                                        $messags['message'] = "Your profile is exists, but your account is inactive.";
                                        $messags['erro']= 202;
                                        $messags['url']= ''; 
                                    }
                               }else
                               {
                                    $condition3 = [['fb_id','=',$data['fb_id']],['status','!=','2']];
                                    $d3 = User::getUsermatchdb($condition3);
                                   if(count($d3) > 0)
                                    { 
                                        $condition4 = [['fb_id','=',$data['fb_id']],['status','!=','0']];
                                        $d4 = User::getUsermatch($condition4);
                                        if(count($d4) > 0)
                                        {
                                            //$condition3 = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            $userdatas = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            } 
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/profile');
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        }
                                    }else
                                    {
                                        
                                        if(isset($data['image']))
                                        {
                                                $temp = explode('/', url('/'));
                                                $url = $data['image'];
                                                $destination_folder = public_path('/profile/');
                                                $uniquesavename=time().uniqid(rand());
                                                $newfname = $destination_folder.$uniquesavename.'.jpeg'; //set your file ext
                                                $savepath= $uniquesavename.'.jpeg';
                                                $file = fopen ($url, "rb");
                                                if ($file) {
                                                $newf = fopen ($newfname, "a"); // to overwrite existing file
                                                
                                                if ($newf)
                                                while(!feof($file)) {
                                                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                                                
                                                }
                                                }
                                                
                                                if ($file) {
                                                fclose($file);
                                                }
                                                
                                                if ($newf) {
                                                fclose($newf);
                                                }
                                                
                                                $data['image'] = $savepath;
                                                 
                                        }
                                        
                                       
                                        $data = array_filter($data);
                                       // $data['package_id']='1';
                                        $subs=Subscription::where('id','1')->first();
                                       // $data['feature']=$subs->features;
                                        if(User::insertUser($data))
                                        {
                                            $userdatas = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            } 
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/profile'); 
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        }
                                        
                                    }
                               }
                             
                           }else
                           {
                                 $condition3 = [['fb_id','=',$data['fb_id']],['status','!=','2']];
                                $d5 =  User::getUsermatchdb($condition3);
                                   if(count($d5) > 0)
                                    { 
                                        $condition4 = [['fb_id','=',$data['fb_id']],['status','!=','0']];
                                       $d6 =  User::getUsermatch($condition4);
                                        if(count($d6) > 0)
                                        {
                                           // $condition3 = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            $userdatas = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            }
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/profile'); 
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        }
                                    }else
                                    {
                                        
                                         if(isset($data['image']))
                                        {
                                                $temp = explode('/', url('/'));
                                                $url = $data['image'];
                                                $destination_folder = public_path('/profile/');
                                                $uniquesavename=time().uniqid(rand());
                                                $newfname = $destination_folder.$uniquesavename.'.jpeg'; //set your file ext
                                                $savepath= $uniquesavename.'.jpeg';
                                                $file = fopen ($url, "rb");
                                                if ($file) {
                                                $newf = fopen ($newfname, "a"); // to overwrite existing file
                                                
                                                if ($newf)
                                                while(!feof($file)) {
                                                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                                                
                                                }
                                                }
                                                
                                                if ($file) {
                                                fclose($file);
                                                }
                                                
                                                if ($newf) {
                                                fclose($newf);
                                                }
                                                
                                                $data['image'] = $savepath;
                                                
                                        }
                                        $data = array_filter($data);
                                       // $data['package_id']='1';
                                        // $subs=Subscription::where('id','1')->first();
                                       // $data['feature']=$subs->features;;
                                        if(User::insertUser($data))
                                        {
                                            $userdatas = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            } 
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/profile'); 
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        } 
                                    }
                                
                           }
                       
                       
                   }else
                   {
                        $messags['message'] = "Error to login, try again later.";
                        $messags['erro']= 202;
                        $messags['url']= '';
                        
                   }
                   
                }else
                {
                    return Redirect::route('myprofile'); 
                }
        
        echo json_encode($messags);
                         die;
    }
    
    public function delete_useractivity()
    {
       $del=Useractivity::where('id',$_POST['id'])->delete();
    }
    public function enroll_course(){
       if(Session()->exists('user')){
        $course_id=$_POST['cid'];
        $uid = Session::get('userid');
        $cource = Course::getdatawithid($course_id);
        
        if(!empty($cource)){
            if(empty($cource->enroled_ids)){
               $enroled_ids = $uid; 
            }
            else{
               $enroled_ids = $cource->enroled_ids.','.$uid; 
            }
            $data=array(
            'enroled_ids'=>$enroled_ids,
            );
            
            $id = Course::updateoption($data,$course_id);
            
            
            //notify admin for user course enroll
            $user = User::where('id',Session::get('userid'))->first();
            $userid=Session::get('userid');
            $url=url('/');
            $data2=array(
            "from_id"=>$userid,
            "from"=>'User',
            "to_id"=>'1',
            "to"=>'Admin',
            "title"=>'New course enrolled by user',
            "description"=>'New course <b>'.$cource->title.'</b> has been enrolled by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
            "url"=>$url.'/course-details/'.$cource->id,
            "status"=>'0');
            $not=Notification::insertNotification($data2);
            
            echo true; 
        }
        else{
            return false;
        }
        
        }else
        {
        return redirect('/');
        } 
    }
    
    public function startcourse()
    {
        if(Session()->exists('user')){
        $user=User::getdatawithid(Session::get('userid'));
        if(!empty($user->package_id))
        {
            
            $course_id=$_POST['cid'];
            $user=User::getdatawithid(Session::get('userid'));
            $features = explode(',', $user->feature);
            $fea=[];
            foreach($features as $f)
            {
            $fea[]=Feature::getdatawithid($f);
            }
           // print_r($fea);
            $total='0';
            foreach($fea as $fa)
            {
                    if($fa=='Video')
                    {
                        $arr=Lesson::getwithcourse($course_id);
                        $total=$total + count($arr);
                    
                    }
                    elseif($fa=='Text')
                    {
                        $arr=Lesson::getwithcoursex($course_id);
                        $total=$total + count($arr);
                        
                    }
                
            }
            
            $exist=Usercourse::where('course_id',$course_id)->where('user_id',Session::get('userid'))->first();
            if(empty($exist))
            {
            $data=array(
            'course_id'=>$course_id,
            'user_id'=>Session::get('userid'),
            'total_lessons'=>$total,
            'viewed_lesson'=>'0',
            'status'=>'0',
            );
            $cource = Course::getdatawithid($course_id);
            $id=Usercourse::insertcourse($data);
              //notify admin for user course enroll
            $user = User::where('id',Session::get('userid'))->first();
            $userid=Session::get('userid');
            $url=url('/');
            $data2=array(
            "from_id"=>$userid,
            "from"=>'User',
            "to_id"=>'1',
            "to"=>'Admin',
            "title"=>'Course started by user',
            "description"=>'Course <b>'.$cource->title.'</b> has been started by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
            "url"=>$url.'/course-details/'.$course_id,
            "status"=>'0');
            $not=Notification::insertNotification($data2);
           
            echo $id;
            }
            
        }
        }else
        {
        return redirect('/');
        }
        
    }
   public function lesson_not_found()
   {
        return view('lesson_not_found');   
   }
   public function delapp()
   {
    $message=array();
       $data=array(
          'course_id'=>$_POST['id'],
          'user_id'=>Session::get('userid')
      );
      $delete=Useractivity::deleterecord($data);
      
       if($delete)
      {
          $message=array(
              'code'=>'101',
              'message'=>'Application deleted successfully');
          
      }else
      {
         $message=array(
              'code'=>'102',
              'message'=>'Error occured');
          
      }
      echo json_encode($message);
      
      
      
   }
   public function resetcourse()
   {
      $message=array();
      $data=array(
          'course_id'=>$_POST['id'],
          'user_id'=>Session::get('userid')
      );
      $delete=Usercourse::deleterecord($data);
      
      
      
       $cource = Course::getdatawithid($_POST['id']);
       $user = User::where('id',Session::get('userid'))->first();
       $userid=Session::get('userid');
            $url=url('/');
            $data2=array(
            "from_id"=>$userid,
            "from"=>'User',
            "to_id"=>'1',
            "to"=>'Admin',
            "title"=>'Course reset by user',
            "description"=>'Course <b>'.$cource->title.'</b> has been reset by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
            "url"=>$url.'/course-details/'.$_POST['id'],
            "status"=>'0');
            $not=Notification::insertNotification($data2);
      
      
      
      $getlessons=Lesson::getlessoneithcourse($_POST['id']);
      foreach($getlessons as $l)
      {
          $data1=array(
          'lesson_id'=>$l->id,
          'user_id'=>Session::get('userid')
        );
        $delete1=  Userlesson::deleterecord($data1);
      }
      if($delete)
      {
          $message=array(
              'code'=>'101',
              'message'=>'Courses reset successfully');
          
      }else
      {
         $message=array(
              'code'=>'102',
              'message'=>'Error occured');
          
      }
      echo json_encode($message);
       
   }
    public function index()
   {
       if(Session()->exists('user')){ 
        $user=User::getdatawithid(Session::get('userid'));
        $data['user']=User::getdatawithid(Session::get('userid'));
        $data['course']=Course::getallactive();
       
        $data['completed']=Course::getcompleted(Session()->get('userid'));
        $data['application']=Useractivity::getappsuser(Session()->get('userid'));
        $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();
        return view('home',$data);   
        }
        else
        {
        
        return Redirect('/');    
        }
   }
   
   public function all_cources(){
       if(Session()->exists('user')){ 
        $user=User::getdatawithid(Session::get('userid'));
        $data['user']=User::getdatawithid(Session::get('userid'));
        $data['course']=Course::getallactive();
        $data['completed']=Course::getcompleted(Session()->get('userid'));
        $data['application']=Useractivity::getappsuser(Session()->get('userid'));
        $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();
        return view('active_cources',$data);   
        }
        else
        {
        
        return Redirect('/');    
        }
   }
 
	 public function profile()
    {
        if(Session()->exists('user')){ 
        $data['user_details'] =User::where('id',Session()->get('userid'))->first();
        $data['country_list'] = Country::getdata();
        return view('profile',$data);
        }else
        {
        return Redirect('/');       
        }
    }
    
    public function editprofile(Request $request)
    {
        $messags = array();
        if($request->isMethod('post'))
        {
            $data = $request->all();
             if(Session()->exists('user'))
             {
                unset($data['_token']);
                $data = array_filter($data);
                $user =User::where('id',Session::get('userid'))->first();
                $userid =$user->id;
                $were= [['email','=',$data["email"]],['id','!=',$userid]];
                $exists= User::getUsermatch($were);
                if(count($exists) > 0)
                {
                  $messags['message'] = "Error User is already exists with this email.";
                  $messags['erro']= 202;   
                }
                elseif(!empty($data['oldpassword']))
                {
                    if(!Hash::check($data['oldpassword'], $user->password)){
                        $messags['message'] = "The current password you entered does not match our records, Please try again.";
                        $messags['erro']= 202;
                    }
                     else if(empty($data['newpassword']) && empty($data['conpassword']))
                    {
                            $messags['message'] = "New and Confirm password is required.";
                            $messags['erro']= 202;
                    }
                    else if(!empty($data['newpassword']) && empty($data['conpassword']))
                    {
                            $messags['message'] = "Confirm password is required.";
                            $messags['erro']= 202;
                    }
                    else if(!empty($data['conpassword']) && empty($data['newpassword']))
                    {
                        $messags['message'] = "New password is required.";
                        $messags['erro']= 202;
                    }
                    
                    else if(!empty($data['conpassword']) && !empty($data['newpassword']))
                    {
                        if($data['conpassword'] == $data['newpassword'])   
                        {
                            $data['password'] = Hash::make( $data['newpassword'] );
                            unset($data['newpassword']);
                            unset($data['conpassword']);
                            unset($data['oldpassword']);
                            
                            if(User::updateUser($data,$userid))
                            {
                                $messags['message'] = "Your profile has been updated sucessfully.";
                                $messags['erro']= 101;    
                            }else
                            {
                                $messags['message'] = "Error to update your profile.";
                                $messags['erro']= 202;   
                            }
                        }
                        else
                        {
                            $messags['message'] = "Please enter confirm password same as new password.";
                            $messags['erro']= 202;
                        }
                    }
                    
                }
                else
                {
                    if(User::updateUser($data,$userid))
                    {
                        $messags['message'] = "Your profile has been updated sucessfully.";
                        $messags['erro']= 101;    
                    }else
                    {
                        $messags['message'] = "Error to update your profile.";
                        $messags['erro']= 202;   
                    } 
                }
            }
            else
            {
                $messags['message'] = "Error session has been expired.";
                $messags['erro']= 202;   
            }
        }
        else
        {
            return redirect('/profile');
        }
        echo json_encode($messags);
        die;
        
        
    }
    
     public function googlelogin(Request $request)
    {
      $messags = array();
                if($request->isMethod('post'))
                {
                    $data = $request->all();
                   // echo '<pre>'; print_r($data); die;
                    $data['status'] = '1';
                   if(!empty($data['g_id']) || !empty($data['email']))
                   {
                       if(!empty($data['email']))
                       {
                           $condition1 = [['email','=',$data['email']],['status','!=','2']];
                           $d1 = User::getUsermatch($condition1);
                          // print_r($d1);die;
                               if(count($d1) > 0)
                               {
                                   $condition2 = [['email','=',$data['email']],['status','!=','0']];
                                   $d2 = User::getUsermatch($condition2);
                                    if(count($d2) > 0)
                                    {
                                      $userdatas = User::getbycondition(array('email'=>$data['email']));
                                        if(count($userdatas)>0  && !empty($userdatas))
                                        {
                                        foreach($userdatas as $u){
                                        $users = $u;
                                        }
                                        $userdata = array(
                                        'id'=> $users->id ,
                                        'first_name' => $users->first_name ,
                                        'last_name' => $users->last_name ,
                                        'email' => $users->email ,
                                        );
                                        Session::put('user',$userdata);
                                        Session::put('userid', $users->id);
                                        Session::save(); 
                                        }
                                      
                                        $messags['message'] = "You logged in successfully.";
                                        $messags['erro']= 101;
                                        $messags['url']= url('/profile'); 
                                    }else
                                    {
                                        $messags['message'] = "Your profile is exists, but your account is inactive.";
                                        $messags['erro']= 202;
                                        $messags['url']= ''; 
                                    }
                               }else
                               {
                                
                                    $condition3 = [['g_id','=',$data['g_id']],['status','!=','2']];
                                    $d3 = User::getUsermatchdb($condition3);
                                   if(count($d3) > 0)
                                    { 
                                        $condition4 = [['g_id','=',$data['g_id']],['status','!=','0']];
                                        $d4 = User::getUsermatch($condition4);
                                        if(count($d4) > 0)
                                        {
                                            //$condition3 = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            $userdatas = User::getbycondition(array('g_id'=>$data['g_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            } 
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/home');
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        }
                                    }else
                                    {
                                       if(isset($data['image']))
                                        {
                                                $temp = explode('/', url('/'));
                                                $url = $data['image'];
                                                $destination_folder = public_path('/profile/');
                                                $uniquesavename=time().uniqid(rand());
                                                $newfname = $destination_folder.$uniquesavename.'.jpeg'; //set your file ext
                                                $savepath= $uniquesavename.'.jpeg';
                                                $file = fopen ($url, "rb");
                                                if ($file) {
                                                $newf = fopen ($newfname, "a"); // to overwrite existing file
                                                
                                                if ($newf)
                                                while(!feof($file)) {
                                                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                                                
                                                }
                                                }
                                                
                                                if ($file) {
                                                fclose($file);
                                                }
                                                
                                                if ($newf) {
                                                fclose($newf);
                                                }
                                                
                                                $data['image'] = $savepath;
                                                 //unset($data['picture']);
                                        }
                                        $data = array_filter($data);
                                       // $data['package_id']='1';
                                       //  $subs=Subscription::where('id','1')->first();
                                       // $data['feature']=$subs->features;
                                         //$data['refferal_code']=time().uniqid(rand());
                                        if(User::insertUser($data))
                                        {
                                            $userdatas = User::getbycondition(array('g_id'=>$data['g_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            }
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/home'); 
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        }
                                        
                                    }
                               }
                             
                           }else
                           {
                                 $condition3 = [['g_id','=',$data['g_id']],['status','!=','2']];
                                $d5 =  User::getUsermatchdb($condition3);
                                   if(count($d5) > 0)
                                    { 
                                        $condition4 = [['g_id','=',$data['g_id']],['status','!=','0']];
                                       $d6 =  User::getUsermatch($condition4);
                                        if(count($d6) > 0)
                                        {
                                           // $condition3 = User::getbycondition(array('fb_id'=>$data['fb_id']));
                                            $userdatas = User::getbycondition(array('g_id'=>$data['g_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            } 
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/home'); 
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        }
                                    }else
                                    {
                                         if(isset($data['image']))
                                        {
                                                $temp = explode('/', url('/'));
                                                $url = $data['image'];
                                                $destination_folder =  public_path('/profile/');
                                                $uniquesavename=time().uniqid(rand());
                                                $newfname = $destination_folder.$uniquesavename.'.jpeg'; //set your file ext
                                                $savepath= $uniquesavename.'.jpeg';
                                                $file = fopen ($url, "rb");
                                                if ($file) {
                                                $newf = fopen ($newfname, "a"); // to overwrite existing file
                                                
                                                if ($newf)
                                                while(!feof($file)) {
                                                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                                                
                                                }
                                                }
                                                
                                                if ($file) {
                                                fclose($file);
                                                }
                                                
                                                if ($newf) {
                                                fclose($newf);
                                                }
                                                
                                                $data['image'] = $savepath;
                                                
                                        }
                                        $data = array_filter($data);
                                      //  $data['package_id']='1';
                                      //   $subs=Subscription::where('id','1')->first();
                                      //  $data['feature']=$subs->features;
                                        // $data['refferal_code']=time().uniqid(rand());
                                        if(User::insertUser($data))
                                        {
                                            $userdatas = User::getbycondition(array('g_id'=>$data['g_id']));
                                            if(count($userdatas)>0  && !empty($userdatas))
                                            {
                                            foreach($userdatas as $u){
                                            $users = $u;
                                            }
                                            $userdata = array(
                                            'id'=> $users->id ,
                                            'first_name' => $users->first_name ,
                                            'last_name' => $users->last_name ,
                                            'email' => $users->email ,
                                            );
                                          
                                            Session::put('user',$userdata);
                                            Session::put('userid', $users->id);
                                            Session::save(); 
                                            }
                                            $messags['message'] = "You logged in successfully.";
                                            $messags['erro']= 101;
                                            $messags['url']= url('/home'); 
                                        }else
                                        {
                                            $messags['message'] = "Your profile is exists, but your account is inactive.";
                                            $messags['erro']= 202;
                                            $messags['url']= ''; 
                                        } 
                                    }
                                
                           }
                       
                       
                   }else
                   {
                        $messags['message'] = "Error to login, try again later.";
                        $messags['erro']= 202;
                        $messags['url']= '';
                        
                   }
                   
                }else
                {
                    return Redirect::route('myprofile'); 
                }
        
        echo json_encode($messags);
                         die;  
    }
    public function uploadprofile(Request $request)
    {
        if(Session()->exists('user'))
        {
            $messags = array();
            if($request->isMethod('post'))
            {
                $data = $request->all();
                if($request->file('file'))
                {
                    $image = $request->file('file');
                    $imagename = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/profile');
                    $image->move($destinationPath, $imagename);
                    $path1 = $imagename;
                    $user = User::where('id',Session()->get('userid'))->first();
                    $userid =$user->id;
                    if(User::updateUser(array('image'=>$path1),$userid))
                    {
                        $messags['path'] = $path1;
                        $messags['message'] = "Profile image updated successfully..";
                        $messags['erro']= 101;
                    }else
                    {
                        $messags['message'] = "Error to upload the profile image.";
                        $messags['erro']= 202;
                    }
                  
                }else
                {
                    $messags['message'] = "Error to upload the profile image.";
                    $messags['erro']= 202;
                }
            }else
            {
                $messags['message'] = "Error to upload the profile image.";
                $messags['erro']= 202;
            }
            echo json_encode($messags);
            die;
        }
    }
	 public function settings()
    {
        return view('settings');
    }
	public function pricing()
    {
      if(Session()->exists('user')){ 
         $data['subsriptions'] = Subscription::getbycondition34(array('status'=>'1'));
        return view('pricing',$data);
      }else
      {
         return redirect('/');
      }
    }
     public function update_status_notification(Request $request)
   {
       if(!empty($_POST['id']))
       {
           if($_POST['status'] == '0')
           {
               $data=array("status"=>'1');
               $get=Notification::where('id',$_POST['id'])->update($data);
           }
       }
       
   }
    public function notifications()
    {
        if(Session()->exists('user')){ 
          $data1=array('status'=>'0','to_id'=>Session()->get('userid'));
         $data['notification']=Notification::getdata2($data1);
        $data['title']='Notification';
        return view('notifications',$data);
        }else
      {
         return redirect('/');
      }
    }
    public function upgradeplan()
    { 
        $message=array();
        if(Session()->exists('user')){ 
            if(!empty($_POST['id']))
            {
                $user=User::getdatawithid(Session::get('userid'));
                $subs=Subscription::getwithid($_POST['id']);
                
                $update=array(
                'package_id'=>$_POST['id'],
                'feature'=>$subs->features);
                User::updateUser($update,$user->id);
                
                $option=array('status'=>'1');
                $updatestatus=Transaction::updateoptions($option,$user->id);
                $today = time();
                $twoMonthsLater = strtotime("+$subs->duration months", $today);
                $start_date=date('Y-m-d', $today);
                $end_date=date('Y-m-d', $twoMonthsLater);
                $transaction_data=array(
                        'transaction_id'=>'0',
                        'user_id'=>$user->id,
                        'package_id'=>$_POST['id'],
                        'status'=>'0',
                        'currency'=>'AUD',
                        'amount'=>$subs->price,
                        'start_date'=>$start_date,
                        'end_date'=>$end_date,
                        'added_by'=>$user->id,
                );
                $tran=Transaction::insertoption($transaction_data); 
                
                //notify admin for user course lesson view
                $user = User::where('id',Session::get('userid'))->first();
                $userid=Session::get('userid');
                $url=url('/admin');
                $data2=array(
                "from_id"=>$userid,
                "from"=>'User',
                "to_id"=>'1',
                "to"=>'Admin',
                "title"=>'Package upgraded by user',
                "description"=>'Package <b>'.$subs->plan_name.'</b> upgraded by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
                "url"=>$url.'/view-user-progress/'.$userid,
                "status"=>'0');
                $not=Notification::insertNotification($data2);

                if($tran)
                {
                        $message=array('code'=>'101',
                        'status'=>'Subscription upgraded successfully...!',
                );
                }else
                { 
                    $message=array('code'=>'102',
                    'status'=>'Error in saving subscription...!',
                    );
                    
                }

            }
        }
        else
        {
           return redirect('/'); 
        }
        echo json_encode($message);
        
    }
    
	public function all_completed()
	{
	    if(Session()->exists('user'))
            { 
	   $data['act']=Course::getcompletedall(Session()->get('userid'));
	   $data['user_course']=Course::getcompletedall(Session()->get('userid'));
	   $data['user']=User::getdatawithid(Session::get('userid'));
	   return view('all_completed',$data);
            }else
            {
                return redirect('/');
            }
	    
	}
	public function all_applications()
	{
	    if(Session()->exists('user'))
            { 
	     $data['act']=Useractivity::getalldata(Session()->get('userid'));
		 return view('all_applications',$data);
            }else
            {
                return redirect('/');
            }
		
	}
	public function all_courses()
	{ 
	   if(Session()->exists('user')){ 
	   $data['course']=Course::getactiveall();
	   $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();
	    $data['user']=User::getdatawithid(Session::get('userid'));
	   return view('all_courses',$data);
	   }
	   else
	   {
	   return redirect('/');
	   }
	    
	}
	public function all_coursess($id)
	{ 
	   if(Session()->exists('user')){ 
	   $data['is_start']=$id;
	   $data['course']=Course::getactiveall();
	   $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();
	    $data['user']=User::getdatawithid(Session::get('userid'));
	   return view('all_courses',$data);
	   }
	   else
	   {
	   return redirect('/');
	   }
	    
	}
	public function add_activity_user(Request $request)
	{
	
	  $message=array();
	  if(!empty($_POST['id']))
	  {
	   $id=array_filter($_POST['id']);
	   $a=count($id);
	   for($i='0';$i<count($id);$i++)
	      {
                if(!empty($_POST['activity_title'][$i]))
                {
                $data=array(
                
                "user_selection"=>$_POST['user_selection'][$i],
                "user_input"=>$_POST['user_input'][$i],
                "activity_title"=>$_POST['activity_title'][$i],
                "activity_time"=>$_POST['activity_time'][$i],
                "participation_grade"=>$_POST['participation_grade'][$i],
                "hour_week"=>$_POST['hour_week'][$i],
                "week_year"=>$_POST['week_year'][$i],
                );
                $actid=Useractivity::updateoption($data,$_POST['id'][$i]);
                }
	          
	      }
	      if(!empty($actid))
	      {
	           $message=array(
	              "code"=>'101',
	              "message"=>'User activity updated succcessfully....!');
	      }
	   
	  $course_id=array_slice($_POST['course_id'],$a);
	  $syllabus_id=array_slice($_POST['syllabus_id'],$a);
	  $lesson_id=array_slice($_POST['lesson_id'],$a);
	  $act=array_slice($_POST['user_selection'],$a);
	  $title=array_slice($_POST['user_input'],$a);
	  $activity_title=array_slice($_POST['activity_title'],$a);
	  
	  $participation_grade=array_slice($_POST['participation_grade'],$a);
	  $hour_week=array_slice($_POST['hour_week'],$a);
	  $week_year=array_slice($_POST['week_year'],$a);
	  
	  
	  $activity_time=array_slice($_POST['activity_time'],$a);
	  $random=array_slice($_POST['random'],$a);
	 
	  $id1=array_filter($activity_title);
	  $id1=array_values($id1);
	  $activity_id=array_values(array_filter($act));
	  $title=array_values(array_filter($title));
	  $activity_title=array_values(array_filter($activity_title));
	  $participation_grade=array_values(array_filter($participation_grade));
	  $hour_week=array_values(array_filter($hour_week));
	  $week_year=array_values(array_filter($week_year));
	  
	  $random=array_values(array_filter($random));
	  $act112=array();
	  
	
	 
	  for($j=0;$j<count($id1);$j++)
	  {
	      if(!empty($activity_title[$j]))
	      {
	          if(isset($activity_id[$j]))
	          {
	              $activity_id[$j]=$activity_id[$j];
	          }else
	          {
	              $activity_id[$j]='';
	          }
	           if(isset($activity_time[$j]))
	          {
	              $activity_time[$j]=$activity_time[$j];
	          }else
	          {
	              $activity_time[$j]='';
	          }
	          if(isset($title[$j]))
	          {
	              $title[$j]=$title[$j];
	          }else
	          {
	              $title[$j]='';
	          }
	          if(isset($participation_grade[$j]))
	          {
	              $participation_grade[$j]=$participation_grade[$j];
	          }else
	          {
	              $participation_grade[$j]='';
	          }
	          if(isset($hour_week[$j]))
	          {
	              $hour_week[$j]=$hour_week[$j];
	          }else
	          {
	              $hour_week[$j]='';
	          }
	          if(isset($week_year[$j]))
	          {
	              $week_year[$j]=$week_year[$j];
	          }else
	          {
	              $week_year[$j]='';
	          }
	          
	          
                $data=array(
                "user_id"=>Session::get('userid'),
                "course_id"=>$_POST['course_id'][$j],
                "syllabus_id"=>'0',
                "lesson_id"=>'0',
                "user_selection"=>$activity_id[$j],
                "user_input"=>$title[$j],
                "activity_title"=>$activity_title[$j],
                "activity_time"=>$activity_time[$j],
                "participation_grade"=>$participation_grade[$j],
                "hour_week"=>$hour_week[$j],
                "week_year"=>$week_year[$j],
                );
                $syllabus_id=Useractivity::insertoption($data);
                $act112[]=array("act_id"=>$syllabus_id,"random"=>$random[$j]);
                }
                
	  }
	  
	    if(!empty($syllabus_id))
	      {
	          $course = Course::getdatawithid($_POST['course_id'][0]);
         
            $user = User::where('id',Session::get('userid'))->first();
            $userid=Session::get('userid');
            $url=url('/');
            $data2=array(
            "from_id"=>$userid,
            "from"=>'User',
            "to_id"=>'1',
            "to"=>'Admin',
            "title"=>'New activity application added by user',
            "description"=>'New activity application for course <b>'.$course->title.' </b> has been added by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
            "url"=>$url.'/course-details/'.$_POST['course_id'][0],
            "status"=>'0');
            $not=Notification::insertNotification($data2);
	          
	          
	          
	          
	           $message=array(
	              "code"=>'101',
	              "message"=>'User activity saved succcessfully....!',
	              "data"=>$act112);
	      }
	  }
	  echo json_encode($message);
	}
	public function viewlesson()
	{
	    
	   
	  $mess=array();
	   if(!empty($_POST['lid']))
	   {
	    $user=User::getdatawithid(Session::get('userid'));
        $where=array(
        'user_id'=>Session::get('userid'),
        'lesson_id'=>$_POST['lid'],
        ); 
        $exist=Userlesson::getbycondition($where);
        
        if(count($exist)=='0'){
        $data=array(
        'user_id'=>Session::get('userid'),
        'lesson_id'=>$_POST['lid'],
        );
        $id=Userlesson::insertcourse($data);
        $lesson=Lesson::where('id',$_POST['lid'])->first();
        $course = Course::getdatawithid($lesson->course_id);
         //notify admin for user course lesson view
            $user = User::where('id',Session::get('userid'))->first();
            $userid=Session::get('userid');
            $url=url('/');
            $data2=array(
            "from_id"=>$userid,
            "from"=>'User',
            "to_id"=>'1',
            "to"=>'Admin',
            "title"=>'Lesson viewed by user',
            "description"=>'Lesson <b>'.$lesson->name.'</b> of course <b>'.$course->title.' </b> has been viewed by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
            "url"=>$url.'/course-details/'.$lesson->course_id,
            "status"=>'0');
            $not=Notification::insertNotification($data2);
        
        if(!empty($id)){
        $lessonsviewed =Userlesson::getviewedlessons(Session()->get('userid'),$_POST['cid']);
        $lessonsincourse =Lesson::getlessoneithcoursecon($_POST['cid'],$user->package_id);  
       
        if($lessonsviewed==$lessonsincourse)
        {
           $dataupdate=array('status'=>'1');
           Usercourse::updateoptionwithcid($dataupdate,$_POST['cid']);  
           $mess=array("code"=>'103',"status"=>'Course Completed Successfully');
            $course = Course::getdatawithid($lesson->course_id);
            //notify admin for user course enroll
            $user = User::where('id',Session::get('userid'))->first();
            $userid=Session::get('userid');
            $url=url('/');
            $data2=array(
            "from_id"=>$userid,
            "from"=>'User',
            "to_id"=>'1',
            "to"=>'Admin',
            "title"=>'Course completed by user',
            "description"=>'Course <b>'.$cource->title.'</b> has been completed by user <b> '.$user->first_name.' '.$user->last_name.'</b>',
            "url"=>$url.'/course-details/'.$cource->id,
            "status"=>'0');
            $not=Notification::insertNotification($data2);
           json_encode($mess);
           die;
        }
        }else
        {
            $id='';
        }
        } 
        }
	   }
	public function course_details($id)
	{
	    if(Session()->exists('user'))
        {
        $user=User::getdatawithid(Session::get('userid'));
	    $data['course_details']=Course::getwithid($id);
	    if(!empty($data['course_details']))
	    {
	    $data['syllabus_details']=Syllabus::getwithid($id,$user->package_id);
	  
	    $data['user']=User::getdatawithid(Session::get('userid'));
	    $data['user_course']=Usercourse::where('course_id',$id)->where('user_id',Session::get('userid'))->first();
		return view('course_details',$data);
	    }else
	    {
	    return view('course_not_found');   
	    }
		
		
		
		
        }
        elseif(Session()->exists('admin'))
        {
        //$user=User::getdatawithid(Session::get('userid'));
	    $data['course_details']=Course::getwithid($id);
	    
	     if(!empty($data['course_details']))
	    {
	    
	    
	    $data['syllabus_details']=Syllabus::getwithidadmin($id);
	    //$data['user_course']=Usercourse::where('course_id',$id)->where('user_id',Session::get('userid'));
		return view('course_details',$data);
	    }else
	    {
	     return view('course_not_found');    
	    }
        }else
        {
            return redirect('/');
        }
	}
	public function video_details($id)
	{
	$data['lid']=$id;
		    $data['lesson']=Lesson::getwithid($id);
	   // $data['syllabus']=Syllabus::getdata($data['lesson']->syllabus_id);
	    $data['course']=Course::getwithid($data['lesson']->course_id);
	    $data['s_lessons']=Lesson::getwithsyllabus($data['lesson']->syllabus_id);
	    $data['activities']=Activity::getwithlessonid($id);
	    $data['user']=User::getdatawithid(Session::get('userid'));
	    $data['act']=Activity::getwithlessonidnew($data['lesson']->course_id);
	    $data['user_activities']=Useractivity::getwithuserid(Session::get('userid'),$data['lesson']->syllabus_id);
	 //   $data['examples']=Example::getwithlessonidjoin($data['lesson']->course_id);
	   $data['examples']=Example::getwithlessonidjoin($data['lesson']->course_id,$data['lesson']->id);
	    $data['examples2']=Example::getwithlessonidjoin1($data['lesson']->course_id);
	    $data['course_details']=Course::getdata($data['lesson']->course_id);
	    $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();

	    $data['syllabus']=Syllabus::getdata($data['lesson']->syllabus_id);
	    $data['s_lessons']=Lesson::getwithsyllabus($data['lesson']->syllabus_id);
	    $data['course']=Course::getdata($data['lesson']->course_id);
	     $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();
		return view('video_details',$data);
	}
	public function getexamples_more()
	{
	   $all=Example::where('category_id',$_POST['id'])->where('course_id',$_POST['course'])->get();
	   $examples=Example::where('category_id',$_POST['id'])->where('course_id',$_POST['course'])->orderBy(DB::raw('RAND()'))->get();
	   
	   echo count($examples);
	   
	   
	}
	public function getexamples()
	{
	   $all=Example::where('category_id',$_POST['id'])->where('course_id',$_POST['course'])->get();
	   $examples=Example::where('category_id',$_POST['id'])->where('course_id',$_POST['course'])->orderBy(DB::raw('RAND()'))->get();
	   
	   if(count($examples)>=1)
	   {
	    foreach($examples as $e)
	    {
	        
	       $act2=Activity::where('id',$e->category_id)->first();
	       
	       echo '<div class="actvt-frm">';
	       if(!empty($act2))
	       {
	       echo '<h5>'.$act2->name.'</h5>'; 
	        echo $e->description;
	        echo '</div>';
	       }else
	       {
	       echo '<h5>Examples Not found</h5></div>';  
	       }
	      
	    }
	   }else
	   {
	     echo '<h5>Not found</h5></div>';    
	   }
	 if(count($all)>1)
	   {
	      
	       echo '<a href="javascript:void(0);" class="btn btn-info read_more hide'.$_POST['id'].'" data-course="'.$_POST['course'].'"
	       data-category="'.$_POST['id'].'"><b>See another example</b></a>';
	       echo '<span class="get_results"></span>';
	   }
	   
	}
	public function getwithlesson()
	{
	     $activities=Activity::getwithlessonid($_POST['less_id']);
	     foreach($activities as $a)
	     {
	         echo '<option value="'.$a->id.'">'.$a->name.'</option>';
	     }
	    
	}
	public function interactive_exercise($id)
	{
	     if(Session()->exists('user'))
        {
	    $data['lesson']=Lesson::getwithid($id);
	    if(empty($data['lesson']))
	    {
	        return view('lesson_not_found');
	    }else
	    {
	    $data['lid']=$id;
	    $data['syllabus']=Syllabus::getdata($data['lesson']->syllabus_id);
	    $data['course']=Course::getwithid($data['lesson']->course_id);
	    $data['s_lessons']=Lesson::getwithsyllabus($data['lesson']->syllabus_id);
	    $data['activities']=Activity::getwithlessonid($id);
	    $data['user']=User::getdatawithid(Session::get('userid'));
	    $data['act']=Activity::getwithlessonidnew($data['lesson']->course_id);
	  
	    $data['user_activities']=Useractivity::getwithuserid(Session::get('userid'),$data['lesson']->course_id);
	 //   $data['examples']=Example::getwithlessonidjoin($data['lesson']->course_id);
	   $data['examples']=Example::getwithlessonidjoin($data['lesson']->course_id,$data['lesson']->id);
	    $data['examples2']=Example::getwithlessonidjoin1($data['lesson']->course_id);
	    $data['course_details']=Course::getdata($data['lesson']->course_id);
	    $data['user_course']=Usercourse::where('user_id',Session()->get('userid'))->get();
		return view('interactive_exercise',$data);
	    }
        }else
        {
              return redirect('/');
        }
	}
	public function learn_details($id)
	{
	    $data['lesson']=Lesson::getwithid($id);
	    $data['syllabus']=Syllabus::getdata($data['lesson']->syllabus_id);
	    $data['s_lessons']=Lesson::getwithsyllabus($data['lesson']->syllabus_id);
	    $data['course']=Course::getdata($data['lesson']->course_id);
	     
		return view('learn_details',$data);
	}
    public function application_details($id)
    {
          if(Session()->exists('user'))
        {
        $data['act']=Useractivity::getwithids($id);
        return view('application_details',$data);
        }else
        {
            return redirect('/'); 
        }
    }
	public function courses()
	{
	    
	return view('courses');
	}
    public function deleteactivitylist()
    {
        Useractivity::deleterecord(array('user_id'=>Session::get('userid')));
    }
    public function getSignOut(Request $request)
    {
        $this->middleware('auth');
        Auth::logout();
        Session::flush();
        $request->session()->forget('user');
        $request->session()->flush();
	    return Redirect('/'); 
    }
	
    
}
