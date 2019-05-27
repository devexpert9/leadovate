<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userlesson;
use App\Notification;
use App\Usercourse;
use App\Country;
use App\Useractivity;
use App\User;
use App\Feature;
use App\Usermentor;
use App\Lesson;
use App\Syllabus;
use App\Course;
use App\Activity;
use App\Example;
use App\Admin;
use App\Options;
use Session;
use Mail;
use App\Subscription;
use App\Mentor;
use App\Transaction;
use Illuminate\Support\Facades\Hash;
use DB;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     
      public function index(Request $request)
    {  
      if(session()->exists('admin'))
      {
        $data['users_all']=User::all();
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
        return view('admin/dashboard',$data);
      }else
      { 
           return Redirect('/admin');
      }
    }
  
    public function getstates()
    {
       if(session()->exists('admin'))
         {  
            $data['states'] = Country::where(array('parent'=>$_POST['id']))->get();
            if(!empty($data['states']))
            {
              foreach($data['states'] as $s)
              {
                  echo "<option value=".$s->id.">$s->name</option>";
              
              }
            }
            else
            {
            }
         }else
         {
             return Redirect('/admin');
         }
        
    }
    public function get_results(Request $request)
    {
        if(!empty($_POST['id']))
        {
        $record=Course::joinresultssearch($_POST['id']);
        if(!empty($record))
        {
            foreach($record as $r)
            {

               
                if(!empty($r->title))
                {
                    $url=url('/');
                    echo '<a href="'.$url.'/course-details/'.$r->id.'"><li>Course Title    :-'.$r->title.'</li></a>';
                }elseif(!empty($r->first_name))
                {
                    $url=url('/admin');
                    echo '<a href="'.$url.'/view-user-progress/'.$r->id.'"><li>User Name    :-'.$r->first_name.'</li></a>';
                }
               
            }
        }
        }else
        {
            
        }
        
    }
    public function updateimage(Request $request)
    {
         if($request->file('uplod-img'))
			       {
			            $userid =Session()->get('adminid');
			            $image = $request->file('uplod-img');
			            $imagename = time().'.'.$image->getClientOriginalExtension();
			            $destinationPath = public_path('/uploads');
			            $image->move($destinationPath, $imagename);
			         $path1 = $imagename;
			       }
			       $data=array("profile"=>$imagename);
	            	Admin::updateoption($data,[['id','=',$userid]]) ;
		  echo $imagename;
          die;  
    }
    public function updatestatus()
    {
    $messags = array();
    $id=$_POST['id'];
    if($_POST['table']=='users')
    {
        if($_POST['status']==1)
        {
            $st='0';
        }else
        {
            $st='1';
        }
    if(User::updateoption2(array('status'=>$st),array('id'=>$id)))
    {
        $messags['message'] = "Status updated successfully!!";
        $messags['erro']= 101;  
    }else
    {
        $messags['message'] = "Error in updating!!";
        $messags['erro']= 102;  
    }
    }
     if($_POST['table']=='mentor')
    {
        if($_POST['status']==1)
        {
            $st='0';
        }else
        {
            $st='1';
        }
    if(Mentor::updateoption2(array('status'=>$st),array('id'=>$id)))
    {
        $messags['message'] = "Status updated successfully!!";
        $messags['erro']= 101;  
    }else
    {
        $messags['message'] = "Error in updating!!";
        $messags['erro']= 102;  
    }
    }
    if($_POST['table']=='plans')
    {
        if($_POST['status']==1)
        {
            $st='0';
        }else
        {
            $st='1';
        }
    if(Subscription::updateoption2(array('status'=>$st),array('id'=>$id)))
    {
        $messags['message'] = "Status updated successfully!!";
        $messags['erro']= 101;  
    }else
    {
        $messags['message'] = "Error in updating!!";
        $messags['erro']= 102;  
    }
    }
     if($_POST['table']=='activitytype')
    {
        if($_POST['status']==1)
        {
            $st='0';
        }else
        {
            $st='1';
        }
    if(Activity::updateoption2(array('status'=>$st),array('id'=>$id)))
    {
        $messags['message'] = "Status updated successfully!!";
        $messags['erro']= 101;  
    }else
    {
        $messags['message'] = "Error in updating!!";
        $messags['erro']= 102;  
    }
    }
    echo json_encode($messags);
    die;  
    }
    public function profile (Request $request)
    {  
    $messags = array();
        if(session()->exists('admin'))
            {
                if($request->isMethod('post'))
                    {
                        $userid =Session()->get('adminid');
                        $data = $request->all();
                        unset($data['_token']);
                        
                        if($data['password'] == '')
                        {
                            unset($data['password']);
                            unset($data['cpassword']);
                            unset($data['oldpassword']);
                        }else
                        {
                            $admin=Admin::where('password',md5($data['oldpassword']))->first();
                            if(empty($admin))
                            {
                                $messags['message'] = "Old password not exist in records";
                                $messags['erro']= 202;  
                                echo json_encode($messags);
                                die;
                            }
                            
                            $data['password']=md5($data['password']);
                            unset($data['cpassword']);
                            unset($data['oldpassword']);
                        }
                        if(Admin::updateoption($data,[['id','=',$userid]]))
                        {
                        $messags['message'] = "Updated successfully!!";
                        $messags['erro']= 101;  
                        $messags['first_name']= $data['first_name'].' '.$data['last_name']; 
                        $messags['email']= $data['email']; 
                        }else
                        {
                        $messags['message'] = "Error to update profile";
                        $messags['erro']= 202;   
                        }

                    }else
                    {
                        $userid =Session()->get('adminid');
                        $data['admin'] = Admin::where(array('id'=>$userid))->first();
                        if(!empty($data['admin']->country)){
                        $data['states'] = Country::where(array('parent'=>$data['admin']->country))->get();
                        }else
                        {
                          $data['states'] =array();  
                        }
                        $data['country'] = Country::where(array('parent'=>'0'))->get();
                        return view('admin/profile',$data); 
                        
                    }
            
            }else
            {
                    return Redirect('/admin');
            
            }
       echo json_encode($messags);
       die;  
        
    }
    public function logincheck(Request $request)
    {
       $messags = array();
       if($request->isMethod('post'))
      {
       $email = $request->email;
       $password = $request->password;
       $where = ['email' => $email,'password' => md5($password)];
       $user = Admin::where($where)->first();
       if (!empty($user)) {
            $userdata = array(
            'id'=> $user->id ,
            'name' => $user->first_name ,
            'lname' => $user->last_name ,
            'email' => $user->email ,
            'profile' => $user->profile ,
            );
            Session::put('admin',$userdata);
            Session::put('adminid', $user->id);
            Session::save(); 
            $messags['message'] = "You logged in successfully!!";
            $messags['erro']= 101;
            $messags['url']= '';
         }else{
            $messags['message'] = "Email or password is invalid!";
            $messags['erro']= 202;
            $messags['url']= '';
         }
      }else
      {
          return Redirect('/admin');
      }
    echo json_encode($messags);
    die;
   } 
   public function delete_notification(Request $request)
   {
        $get=Notification::where('id',$_POST['id'])->delete();
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
   public function add_act(Request $request)
   {
    $messags = array();
    if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($data['id']))
            {
              $add=array("name"=>$data['name']);
              $act_id=Activity::insertoption($add);
              $act=Activity::getdata();
              $datas=array();
              foreach($act as $o)
              {
                $del=url('admin/delete_record/');
                $url=url('/');
                $action='<a href="'.$url.'" class="btn round btn-info" data-toggle="tooltip" data-original-title="View Progress">
                <i class="fa fa-eye"></i></a>
                <span data-toggle="tooltip" data-original-title="Delete">
                <button type="button" class="btn btn-danger round delete_request" data-toggle="modal" 
                data-table="activities" data-id="'.$o->id.'" data-action="'.$del.'" data-target="#delete_modal">
                <i class="fa fa-trash"></i></button></span> ';
	            $datas[]= "<tr>
				<td id='actname$o->id'>$o->name</td>
				<td>$action</td>
				</tr>";  
              }
              if(!empty($act_id))
              {
                 
                  $messags=array('erro'=>'101','message'=>"Activity type added successfully.. !",'data'=>$datas);
                  
              }else
              {
                  $messags=array('erro'=>'102','message'=>"Error to add Activity type... !");
              }
            }else
            {
               $update=array('name'=>$data['name']);
               $up=Activity::updateoption($update,$data['id']);
               if($up)
               { 
                   $messags=array('erro'=>'101','message'=>"Activity type updated successfully.. !",'id'=>$data['id'],'name'=>$data['name']);
                   
               }else
               {
                   
               }
            }
        }
        echo json_encode($messags);
        die;
   }
   public function edituser($id,Request $request)
   {
    $messags = array();
    if($request->isMethod('post'))
        {
          $data = $request->all();
           unset($data['_token']);
           if($request->file('file'))
			            {
			            $userid =Session()->get('adminid');
			            $image = $request->file('file');
			            $imagename = time().'.'.$image->getClientOriginalExtension();
			            $destinationPath = public_path('/uploads');
			            $image->move($destinationPath, $imagename);
			        
			           }
                        $user = User::where('email',$data['email'])->where('id','!=',$id)->first();
                        if(!empty($user)){
                            $messags['message'] =  "User is already exists with this email.";
                            $messags['erro']= 202;
                            echo json_encode($messags);
                            die;
                        }
                         $user2 = User::where('username',$data['username'])->where('id','!=',$id)->first();
                        if(!empty($user2)){
                           $messags['message'] =  "Username is already exists please try another.";
                            $messags['erro']= 202;
                            echo json_encode($messags);
                            die;
                        }
			           
             $query= array(
                            'first_name'=>$data['first_name'],
                            'last_name'=>$data['last_name'],
                            'username'=>$data['username'],
                            'email'=>$data['email'],
                            'phone'=>$data['phone'],
                            'package_id'=>$data['package_id'],
                            );
             if(User::updateoption2($query,array('id'=>$id)))
                       { 
                          if($request->file('file'))
			            {
                          User::updateoption2(array('image'=>$imagename),array('id'=>$id));  
			            }
                        $messags['message'] = "User has been updated successfully.";
                        $messags['erro']= 101;
                       }else
                       {
                        $messags['message'] =  "Error to Update user.";
                        $messags['erro']= 202;  
                       }
                        
                    }
          
        echo json_encode($messags);
        die;
   }
   Public function checkemailmentor()
   {
    $user = Mentor::where('email',$_POST['email'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }     
       
   }
   public function checkemailmentorwithid()
   {
    $user = Mentor::where('email',$_POST['email'])->where('id','!=',$_POST['id'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }    
       
   }
   public function checkplannamewithid()
   {
    $user = Subscription::where('plan_name',$_POST['plan_name'])->where('id','!=',$_POST['id'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }   
         
   }
   public function checkusernamewithid()
   {
     $user = User::where('username',$_POST['username'])->where('id','!=',$_POST['id'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }   
        
       
   }
   public function checkemailwithid()
   {
    $user = User::where('email',$_POST['email'])->where('id','!=',$_POST['id'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }   
       
       
   }
   public function checkplanname()
   {
     $user = Subscription::where('plan_name',$_POST['plan_name'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }    
         
   }
   public function checkusername()
   {
    $user = User::where('username',$_POST['username'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }    
       
   }
   public function checkemail()
 {
   $user = User::where('email',$_POST['email'])->first();
    if(empty($user)){
      echo 'true';
     }
     else{
      echo 'false';
     }
 }
	 public function dashboard()
    {
         if(session()->exists('admin'))
      {
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
        $data['user']=User::getrecent();
        $data['users_all']=User::all();
        $data['mentors']=Mentor::all();
        $data['courses']=Course::all();
        return view('admin/dashboard',$data);
      }else
      {
           return Redirect('/admin');
      }
        
    }
	 public function users()
    {
        if(session()->exists('admin'))
      {
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
        $data['users'] = User::getall();
        return view('admin/users',$data);
      }else
      {
          return Redirect('/admin');
      }
    }
    public function assign_user_mentor()
    {
        $messags = array();
      
       if(!empty($_POST['mentor_id']))
       {
            Usermentor::where('mentor_id',$_POST['mentor_id'])->delete();
           
           $mid=$_POST['mentor_id'];
           foreach($_POST['assigned_users'] as $a)
           {
               $data=array(
                   'mentor_id'=>$mid,
                   'user_id'=>$a
                   
                   );
                   
               Usermentor::insertUser($data);
           }
           
           $messags['message'] = "User Assigned Successfully";
           $messags['erro']= 101;
           
       }
         echo json_encode($messags);
         die;

    }
	public function mentors()
    {
          if(session()->exists('admin'))
      {
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
        $data['mentor']=Mentor::getmentor();
        $features=Feature::getwithid('Mentor');
	    $getplans=Subscription::getoptionswithfeature($features->id);
	    $getusers=array();
	    $data['user_p']=array();
	    foreach($getplans as $a)
	    {
	        $getusers[]=User::getdatawithpackid($a->id);
	        
	    }
	   
	    
	    foreach($getusers[0] as $u)
	    {
	       
	        $data['user_p'][]='<option value="'.$u['id'].'">'.$u['username'].'</option>';
	    }
        return view('admin/mentors',$data);
      }else
      {
          return Redirect('/admin');
      }
    }
	public function activities1()
	{
	      if(session()->exists('admin'))
      {
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
		 return view('admin/activities');
      }else
      {
          return Redirect('/admin');
      }
		
	}
	public function subscriptions()
	{
	      if(session()->exists('admin'))
      {
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
        $data['subsription'] = Subscription::getall();
		 return view('admin/subscriptions',$data);
      }else
      {
          return Redirect('/admin');
      }
		
	}
	public function updateorder()
	{
	    $array = explode(',', $_POST['lid']);
	   
	    $i=1;
	    foreach($array as $a)
	    {
	        $m=$i++;
	        $update=Course::where('id',$a)->update(array('order'=>$m));
	    }
	    
	}
	public function archives()
	{
	if(session()->exists('admin'))
    {
            $userid =Session()->get('adminid');
            $data['admin'] = Admin::where(array('id'=>$userid))->first();
            $data['course']=Course::getdatapageinate_archive();
            return view('admin/archives',$data);
    }else
    {
            return Redirect('/admin');
    }     
	}
	public function activities()
	{
	 if(session()->exists('admin'))
    {
            $userid =Session()->get('adminid');
            $data['admin'] = Admin::where(array('id'=>$userid))->first();
            $data['activity']=Activity::getdata();
            return view('admin/activities',$data);
    }else
    {
            return Redirect('/admin');
    }   
	}
	public function courses()
	{
    if(session()->exists('admin'))
    {
            $userid =Session()->get('adminid');
            $data['admin'] = Admin::where(array('id'=>$userid))->first();
            $data['course']=Course::getdatapageinate();
            return view('admin/courses',$data);
    }else
    {
            return Redirect('/admin');
    }
	}
	
    public function deleteeditheading()
    {
    $mess=array();
    if($_POST['table']=='syllabus')
    {
    $exist=Syllabus::where('course_id',$_POST['course'])->get();
    
    if(count($exist)>1)
    {
     $sy=Syllabus::where('random_no',$_POST['random'])->first();
     
     $lessons=Lesson::where('syllabus_id',$sy->id)->get();
     $usercourses=Userlesson::get();
     $lesson_id=array();
     foreach($lessons as $l)
     {
        $lesson_id[]=$l->id;
     }
     
    foreach($usercourses as $uc)
    {
        if(in_array($uc->lesson_id,$lesson_id))
        {
        $les=Lesson::where('id',$uc->lesson_id)->first();
        $url=url('/');
           $data=array("from_id"=>Session()->get('adminid'),
           "from"=>'Admin',
           "to_id"=>$uc->user_id,
           "to"=>'User',
           "title"=>'Lesson deleted by Admin',
           "description"=>'Lesson <b>'.$les->name.' </b> has been deleted by admin',
           "url"=>$url.'/404_lesson',
           "status"=>'0');
          $not=Notification::insertNotification($data);
          
          $del=Userlesson::where('lesson_id',$uc->lesson_id)->delete();
            
        }
    }
        $lessons=Lesson::where('syllabus_id',$sy->id)->delete();
        Activity::where('syllabus_id',$sy->id)->delete();
        Example::where('syllabus_id',$sy->id)->delete();
        Syllabus::where('random_no',$_POST['random'])->delete(); 
        
        $getsyllabuswithcourse=Syllabus::getdatawithid($_POST['course']);
        if(!empty($getsyllabuswithcourse))
        {
        $array=array();
        foreach($getsyllabuswithcourse as $get)
        {
        $array[]='<option value="'.$get->id.'">'.$get->title.'</option>';
        }
        }
        $mess=array('code'=>'101','data'=>$array);
        echo json_encode($mess);
        die;
    
        
    }else
    { 
        $mess=array('code'=>'102','status'=>"Cannot delete all headings");
        echo json_encode($mess);
        die;
    
        
    }
  
    }elseif($_POST['table']=='lesson')
        {
        $exist=Lesson::where('random_no',$_POST['random'])->first();
        $usercourses=Userlesson::get();
        if(!empty($exist))
        {
            foreach($usercourses as $uc)
            {
                if($uc->lesson_id == $exist->id)
                {
                    $url=url('/');
                    $data=array("from_id"=>Session()->get('adminid'),
                    "from"=>'Admin',
                    "to_id"=>$uc->user_id,
                    "to"=>'User',
                    "title"=>'Lesson deleted by Admin',
                    "description"=>'Lesson <b>'.$exist->name.' </b> has been deleted by admin',
                    "url"=>$url.'/404_lesson',
                    "status"=>'0');
                    $not=Notification::insertNotification($data); 
                }
            }
      
                
                $del=Userlesson::where('lesson_id',$exist->id)->delete();
                Lesson::where('random_no',$_POST['random'])->delete();
                Activity::where('lesson_id',$exist->id)->delete();
                Example::where('lesson_id',$exist->id)->delete();
                $getsyllabuswithcourse=Activity::getwithlessonid($_POST['course']);
                if(!empty($getsyllabuswithcourse))
                {
                $array=array();
                foreach($getsyllabuswithcourse as $get)
                {
                $array[]='<option value="'.$get->id.'">'.$get->name.'</option>';
                }
                }
                
                $mess=array('code'=>'101','status'=>'Lesson deleted successfully','data'=>$array);
                echo json_encode($mess);
                die;
                }
    }
    }
    public function deleteheading()
    {
    $mess=array();
    if($_POST['table']=='heading')
    {
    $exist=Syllabus::where('random_no',$_POST['id'])->first();
    if(!empty($exist))
    {
        $sy=Syllabus::where('random_no',$_POST['id'])->first();
    
        $get=Lesson::where('syllabus_id',$sy->id)->get();
        foreach($get as $g)
        {
            $act=Example::where('lesson_id',$g->id)->delete();
            
        }
        
        $getless=Lesson::where('course_id',$exist->course_id)->get();
        if(!empty($getless))
        {
        $array1=array();
        foreach($getless as $get)
        {
        $array1[]='<option data-random="'.$get->random_no.'" value="'.$get->id.'">'.$get->name.'</option>';
        }
        }
        
        
        
        Lesson::where('syllabus_id',$sy->id)->delete();
        Activity::where('syllabus_id',$sy->id)->delete();
        Example::where('syllabus_id',$sy->id)->delete();
        Syllabus::where('random_no',$_POST['id'])->delete(); 
        
       
        
        
        
        
        $getsyllabuswithcourse=Syllabus::getdatawithid($exist->course_id);
        if(!empty($getsyllabuswithcourse))
        {
        $array=array();
        foreach($getsyllabuswithcourse as $get)
        {
        $array[]='<option value="'.$get->id.'">'.$get->title.'</option>';
        }
        }
        $mess=array('data'=>$array,'data1'=>$array1);
        echo json_encode($mess);
        die;
    }
    
    
    
    }
    elseif($_POST['table']=='lesson')
    {
    $exist=Lesson::where('random_no',$_POST['id'])->first();
    if(!empty($exist))
 {
     
    
        $del=Example::where('lesson_id',$exist->id)->delete();
        $del1=Userlesson::where('lesson_id',$exist->id)->delete();
        Lesson::where('random_no',$_POST['id'])->delete(); 
        
        $getsyllabuswithcourse=Lesson::getwithsyllabus($exist->syllabus_id);
        if(!empty($getsyllabuswithcourse))
        {
        $array=array();
        foreach($getsyllabuswithcourse as $get)
        {
        $array[]='<option value="'.$get->id.'">'.$get->name.'</option>';
        }
        }
        
        
        $mess=array('data'=>$array);
        echo json_encode($mess);
        die;
    }
      
    }
     elseif($_POST['table']=='example')
    {
    $exist=Example::where('random',$_POST['id'])->first();
    if(!empty($exist))
    {
    
        Example::where('random',$_POST['id'])->delete(); 
    }
      
    }
    else
    {
    $exist=Activity::where('random_no',$_POST['id'])->first();
    if(!empty($exist))
    {
        Activity::where('random_no',$_POST['id'])->delete(); 
        
        $getsyllabuswithcourse=Activity::getwithcourseid($exist->course_id);
        if(!empty($getsyllabuswithcourse))
        {
        $array=array();
        foreach($getsyllabuswithcourse as $get)
        {
        $array[]='<option value="'.$get->id.'">'.$get->name.'</option>';
        }
        }
        $mess=array('data'=>$array);
        echo json_encode($mess);
        die;    
    }  
    
    }
    }
	public function add_course(Request $request)
	{
	  $messags = array();
	  if(session()->exists('admin'))
      {
                if($request->isMethod('post'))
                {
                $userid =Session()->get('adminid');
                $data = $request->all();
            
                if($data['course_id'] !='' &&  !empty($data['course_overview']))
                {
                    $query=array('course_overview'=>$data['course_overview']);
                    $userid=Course::updateoption($query,$data['course_id']);
                    $courseid=$data['course_id'];
                    $url='';
                }
           
             elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='add_heading')
                {
                    $data = $request->all();
                    if(!empty($data['title']))
                    {
                    $array1=array();
                    $array=array();
                    $update=array();
                    foreach($data['title'] as $t)
                    {
                    $exists=Syllabus::where('random_no',$t['random_no'])->first();
                    if(!empty($exists))
                    {
                    $query=array(
                    "title"=>$t['title'],
                    );
                    $syllabus_id=Syllabus::where('random_no',$t['random_no'])->update($query);
                    
                    $update[] =array('random' => $t['random_no'],'text'=>$t['title']);
                    }else   
                    {
                    $query=array(
                    "random_no"=>$t['random_no'],
                    "title"=>$t['title'],
                    "course_id"=>$data['course_id']
                    );
                    $syllabus_id=Syllabus::insertoption($query);
                    $random=mt_rand(100000, 999999);
                    
                    $array1='<div class="col-md-12 remove'.$t['random_no'].' subj-head_box">
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <h4 class="dvl-brdr edit'.$t['random_no'].'"> '.$t['title'].' 
                                       
                                        </h4>
                                         <input type="hidden" value="0" id="getvalue">
                                         <input type="hidden" name="title['.$syllabus_id.'][syllabus_id][]" class="sylb_id edit'.$t['random_no'].'" data-count="'.$syllabus_id.'" value="'.$syllabus_id.'">
                                        
                                        </div>
                                        </div>
                                        <div class="row">
									    <div class="bg-ns-a">
										<div class="form-group col-sm-12 col-12">
										<label class="d-block" for="exampleInputPassword10">Lesson Name
										<a href="javascript:void(0)" class="lesson_count   float-right pull-right btn btn-info addScnt btn-adda" 
										id="addScnt"  data-count="'.$syllabus_id.'"  data-val="'.$syllabus_id.'" data-id="'.$random.'"> Add Lesson </a></label>
										<input type="text" class="form-control form-control-square" id="" 
										name="title['.$syllabus_id.'][name][]" maxlength="30"  placeholder="" required>
										<input type="hidden"  name="title['.$syllabus_id.'][random_no][]" value="'.$random.'">
										</div>
										
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Content Type</label>
										<select id="colorselector'.$random.'"  onchange="chnagefun('.$random.')" 
										class="colorselector'.$random.' form-control form-control-square" name="title['.$syllabus_id.'][type][]" 
										required>
										<option value="">Select One</option>
										<option value="Video'.$random.'">Video</option>
										<option value="Exercise'.$random.'" selected>Exercise</option>
										</select>
										</div>
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Lesson Number</label>
										<input type="text" class="quantity form-control form-control-square" 
										name="title['.$syllabus_id.'][lesson_no][]" 
										required>
										</div>
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Duration</label>
										<input type="text" class="quantity form-control form-control-square" 
										name="title['.$syllabus_id.'][duration][]" 
										required>
										</div>
										<div class="form-group col-sm-12 col-12 colors'.$random.' Video'.$random.'" id="Video'.$random.'" style="display:none">
										<label for="exampleInputPassword10">Add Video</label>
										<input type="hidden"  name="title['.$syllabus_id.'][file][]" class="file_video'.$random.'">
                                        <input type="file"   data-random="'.$random.'"  
                                        class="form-control form-control-square files file_video" id="file_video'.$random.'" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-12 col-12 colors'.$random.' Exercise'.$random.'" id="Exercise'.$random.'">
                                        <label for="exampleInputPassword10">Learn Column</label>
                                        <textarea class="summernote" id="content21" name="title['.$syllabus_id.'][description][]" ></textarea>
                                        </div>
                                        </div>
                                        <div class="p_scents  p_scents'.$random.'"></div>
                                        </div>';
                                        array_push($array,$array1);
                    }        
                    }
                  
                    $getsyllabuswithcourse=Syllabus::getdatawithid($data['course_id']);
                    if(!empty($getsyllabuswithcourse))
                    {
                    $array2=array();
                    foreach($getsyllabuswithcourse as $get)
                    {
                    $array2[]='<option value="'.$get->id.'">'.$get->title.'</option>';
                    }
                    }
                    $messags=array('html'=>$array,'erro'=>'101',
                    'message'=>'Saved successfully','data'=>$array2,'update'=>$update,'course_id'=>$data['course_id']);
                      
                     echo json_encode($messags);
                     die;  
                   
                    }
                   
                }
                
               elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='add_lesson')
                {
                    $data = $request->all();
                
                    $files = $request->file('file_video');
                    
                    if($request->hasFile('file_video'))
                    { 
                    foreach($files as $file) {
                    
                    $destinationPath = public_path('/uploads');
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    $path = $filename;
                    }
                    
                    
                    }
            
                    
                    if(!empty($data['title']))
                    {
                    $array1=array();
                    $array=array();
                    $update=array();   
                    foreach($data['title'] as $t)
                    {
                    if(!empty($t['syllabus_id']) && count($t['syllabus_id']) > 0){
                       
                    for($i=0;$i<count($t['name']);$i++)
                    {
                    if(!empty($t['name'][$i]))
                    {
                        $result = substr($t['type'][$i], 0, 5);
                        if($result == 'Video')
                        {
                        $type='Video';
                        $image=$t['file'][$i];
                        $imagename = $image;
                        $description=$imagename;
                        
                        }else
                        {
                        $type='Exercise';
                        $description=$t['description'][$i];
                        }
                        
                        
                        $exists=Lesson::where('random_no',$t['random_no'][$i])->first();
                        if(!empty($exists))
                        {
                        
                        $query1=array(
                        'name'=>$t['name'][$i],
                        'type'=>$type,
                        'description'=>$description,
                        'duration'=>$t['duration'][$i],
                        );
                        $lesson_id= Lesson::where('random_no',$t['random_no'][$i])->update($query1);  
                        
                        
                        $update[] =array('random' => $t['random_no'][$i],'text'=>$t['name'][$i]);
                        }
                        else
                        {
                        $query1=array(
                        'syllabus_id'=>$t['syllabus_id'][$i],
                        'course_id'=>$data['course_id'],
                        'name'=>$t['name'][$i],
                        'type'=>$type,
                        'description'=>$description,
                        'random_no'=>$t['random_no'][$i],
                        'duration'=>$t['duration'][$i],
                        'lesson_no'=>$t['lesson_no'][$i]
                        );
                        $random=mt_rand(100000, 999999);
                        $lesson_id= Lesson::insertoption($query1);
                        $heading=Syllabus::getdata($t['syllabus_id'][$i]);
                       
                        }
                        
                        }
                    }   
                    }
                    }
                   
                      
                    $getsyllabuswithcourse=Lesson::getlessoneithcourse($data['course_id']);
                    if(!empty($getsyllabuswithcourse))
                    {
                        $array2=array();
                        foreach($getsyllabuswithcourse as $get)
                        {
                            $array2[]='<option value="'.$get->id.'">'.$get->name.'</option>';
                        }
                    }
                    if(!empty($lesson_id))
                       {
                        $messags['message'] = "Lessons added Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['html']=$array;
                        $messags['data']=$array2;
                        $messags['update']=$update;
                       
                       }else
                       {
                        $messags['erro']= 102;  
                       }
                     echo json_encode($messags);
                     die;  
                   
                    }
                  
                }
                
             
                 
                 elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='add_activity')
                {
                    $data = $request->all();
                    $array1=array();
                    $array=array();
                    $update=array();
                    if(!empty($data['activity_type']))
                    {
                    $exist12=Activity::where('course_id',$data['course_id'])->delete();   
                    foreach($data['activity_type'] as $t)
                    {
                       
                    $exist=Activity::where('course_id',$data['course_id'])->where('name',$t)->first();
                    if(empty($exist))
                    {
                       $dataact=array(
                            'random_no'=>'',
                            'lesson_id'=>'',
                            'course_id'=>$data['course_id'],
                            'syllabus_id'=>'',
                            'name'=>$t
                            );

                        $act_id= Activity::insertoption($dataact);  
                    }else
                    {
                       $exist=Activity::where('course_id',$data['course_id'])->where('name',$t)->delete();  
                       $del=Example::where('course_id',$data['course_id'])->where('category_id',$t)->delete();  
                    }
                    }
                    
                    }else
                    {
                       $del=Activity::where('course_id',$data['course_id'])->delete();
                       $del=Example::where('course_id',$data['course_id'])->delete(); 
                    }
                    $getsyllabuswithcourse=Activity::getwithcourseid1($data['course_id']);
                    $getlesson=Lesson::getwithcourseid1($data['course_id']);
                    
                    if(!empty($getlesson))
                    {
                        $arraylessons=array();
                       
                        foreach($getlesson as $get)
                        {
                         
                            $arraylessons[]='<option data-random="'.$get->random_no.' "value="'.$get->id.'">'.$get->name.'</option>';
                        }
                    }
                    $countact=count($getsyllabuswithcourse);
                    $countless=count($getlesson);
                    if(!empty($getsyllabuswithcourse))
                    {
                        $array2=array();
                       
                        foreach($getsyllabuswithcourse as $get)
                        {
                            $act_name=Activity::where('id',$get->name)->first();
                            $lesson=Lesson::getwithid($get->lesson_id);
                           
                            if(empty($act_name))
                            {
                                $act_name="Not Found";
                            }else
                            {
                                $act_name=$act_name->name;
                            }
                            $array2[]='<option value="'.$get->name.'">'.$act_name.'</option>';
                        }
                    }
                    $stringRepresentation=Activity::getwithcourseid12($data['course_id']);
                    $getexpcourse=Example::getwithlessonidjoin1($data['course_id']);
                    
                  $examples="";  
                 if(count($getexpcourse)=='0')
                 {
                     $examples="0";
                 }
                    
                $array3=array();
            
                    if(count($getsyllabuswithcourse)>=1)
                       {
                        $messags['message'] = "Activity added Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['html']=$array;
                        $messags['data']=$array2;
                        $messags['activities']=$countact;
                        $messags['examples']=$examples;
                        
                        $messags['data1']=$array3;
                        $messags['lessons']=$arraylessons;
                        $messags['update']=$update;
                          
                       }else
                       {
                        
                        $messags['message'] = "Please select activity..!";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['examples']='';
                        
                        $messags['html']='';
                        $messags['data']='';
                        $messags['data1']='';
                        $messags['update']='';
                         
                       }
                     echo json_encode($messags);
                     die;  
                   
                    } 
                elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='add_example')
                {
                    $data = $request->all();
              
                
                    if(!empty($data['title']))
                    {
                    foreach($data['title'] as $t)
                    {
                    if(!empty($t['category_id'][0]) && count($t['category_id']) >= '1') 
                    {
                      
                      if(isset($t['example_description']))
                      {
                    for($i=0;$i<count($t['example_description']);$i++)
                    {
                    $exists=Example::where('random',$t['random'][$i])->first();
                    if(!empty($exists))
                    {
                        if(!empty($t['example_description'][$i]))
                        {
                    $query=array(
                    "category_id"=>$t['category_id'][0],
                    "name"=>$t['example_description'][$i],
                    "description"=>$t['example_description'][$i]
                    );
                    $syllabus_id=Example::where('random',$t['random'][$i])->update($query);
                        }
                    
                    }
                    else
                    {
                    $get=Activity::where('id',$t['category_id'][0])->first();
                      if(!empty($t['example_description'][$i]))
                        {
                    $dataactexp=array(
                    'lesson_id'=>'',
                    'course_id'=>$data['course_id'],
                    'syllabus_id'=>$get->syllabus_id,
                    'category_id'=>$t['category_id'][0],
                    'name'=>$t['example_description'][$i],
                    'random'=>$t['random'][$i],
                    'description'=>$t['example_description'][$i]
                    );
                    
                    $act_idexp= Example::insertoption($dataactexp); 
                        }
                    }
                    }
                    
                      }
                    }
                    else
                    { 
                    for($i=0;$i<count($t['example_description']);$i++)
                    {
                    if(!empty($t['example_description'][$i]))
                     {
                    $exists=Example::where('random',$t['random'][$i])->first();
                    if(!empty($exists))
                    {
                     $query=array(
                    "category_id"=>NULL,
                    "name"=>$t['example_description'][$i],
                    "description"=>$t['example_description'][$i]
                    );
                    $syllabus_id=Example::where('random',$t['random'][$i])->update($query);
                    
                    }else
                    {
                            
                            
                         $dataactexp=array(
                                         'lesson_id'=>'',
                                         'course_id'=>$data['course_id'],
                                         'syllabus_id'=>'',
                                         'category_id'=>'',
                                         'name'=>$t['example_description'][$i],
                                         'random'=>$t['random'][$i],
                                         'description'=>$t['example_description'][$i]
                                         );
                                         
                                        $act_idexp= Example::insertoption($dataactexp);
                        }
                        }
                    }
                    }
                    }
                    }
                    $url=url('/');
                    if(!empty($act_idexp))
                       {
                           
                        $messags['message'] = "Course added successfully......!";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['data']='';
                           
                       }else
                       {
                         $messags['message'] = "Course added successfully......!";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']=$url.'/admin/courses';
                        $messags['data']=''; 
                       }
                     echo json_encode($messags);
                     die;  
                   
                    }
                  
                
                
                
                
                
                else{
                      if($request->file('file'))
    			            {
    			            $userid =Session()->get('adminid');
    			            $image = $request->file('file');
    			            $imagename = time().'.'.$image->getClientOriginalExtension();
    			            $destinationPath = public_path('/uploads');
    			            $image->move($destinationPath, $imagename);
    			           }else
			           {
			               $imagename='';
			           }
			           unset($data['_token']);
			           
			           if(isset($data['course_overview']) && !empty($data['course_overview']))
			           {
			               $couse_over=$data['course_overview'];
			           }else
			           {
			               $couse_over='';
			           }
			           
                                    $query= array(
                                    'title'=>$data['title'],
                                    'type'=>$data['type'],
                                    'image'=>$imagename,
                                    'description'=>$data['description'],
                                    'course_overview'=>$couse_over,
                                    'status'=>'0');
                                    if(!empty($data['course_id']))
                                    {
                                    $userid=Course::updateoption($query,$data['course_id']);
                                    $courseid=$data['course_id'];
                                    }
                                    else{
                                    $courseid=Course::insertoption($query);    
                                    }
			          
                        $url='';
                       } 
                       if(!empty($userid))
                       {
                        $messags['message'] = "Saved Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $courseid;
                        $messags['url']=$url;
                           
                       }else
                       {
                        $messags['erro']= 102;  
                       }
                     echo json_encode($messags);
                     die;  
                }else{
                
                $userid =Session()->get('adminid');
                $data['admin'] = Admin::where(array('id'=>$userid))->first();
                $data['activity_admin'] = Activity::getdata();
                return view('admin/add_course',$data);
                }
                }else
                {
                return Redirect('/admin');
                }
        
	}
	
	public function add_exercise()
	{
	      if(session()->exists('admin'))
      {
        $userid =Session()->get('adminid');
        $data['admin'] = Admin::where(array('id'=>$userid))->first();
		 return view('admin/add_exercise');
      }else
      {
          return Redirect('/admin');
      }
	}
	public function exercise_list()
	{
		 return view('admin/exercise_list');
	}
	public function notifications()
	{
	    if(session()->exists('admin'))
        {
	    $data['notification']=Notification::getuser1();
		return view('admin/notifications',$data);
        }else
        {
        return Redirect('/admin');   
        }
	}
	public function add_user(Request $request)
	{
	     $messags = array();
            if(session()->exists('admin'))
            {
                    if($request->isMethod('post'))
                    {
                        $userid =Session()->get('adminid');
                        
                        $data = $request->all();
                      
                        if($request->file('file'))
			            {
			            $userid =Session()->get('adminid');
			            $image = $request->file('file');
			            $imagename = time().'.'.$image->getClientOriginalExtension();
			            $destinationPath = public_path('/uploads');
			            $image->move($destinationPath, $imagename);
			           }else
			           {
			               $imagename='';
			           }
                        unset($data['_token']);
                        unset($data['confirm_password']);
                        $user = User::where('email',$data['email'])->first();
                        if(!empty($user)){
                            $messags['message'] =  "User is already exists with this email.";
                            $messags['erro']= 202;
                            echo json_encode($messags);
                            die;
                        }
                         $user2 = User::where('username',$data['username'])->first();
                        if(!empty($user2)){
                           $messags['message'] =  "Username is already exists please try another.";
                            $messags['erro']= 202;
                            echo json_encode($messags);
                            die;
                        }
                        $query= array(
                            'first_name'=>$data['first_name'],
                            'last_name'=>$data['last_name'],
                            'username'=>$data['username'],
                            'email'=>$data['email'],
                            'phone'=>$data['phone'],
                            'password'=>Hash::make($data['password']),
                            'package_id'=>$data['package_id'],
                            'image'=>$imagename);
                            
                    $userid=User::insertoption($query);   
                    if(!empty($userid))
                       {
                        $package=Subscription::getwithid($data['package_id']); 
                        $today = time();
                        $twoMonthsLater = strtotime("+$package->duration months", $today);
                        $start_date=date('Y-m-d', $today);
                        $end_date=date('Y-m-d', $twoMonthsLater);
                          $transaction= array(
                            'transaction_id'=>'0',
                            'user_id'=>$userid,
                            'package_id'=>$data['package_id'],
                            'currency'=>'0',
                            'amount'=>'0',
                            'added_by'=>'Admin',
                            'start_date'=>$start_date,
                            'end_date'=>$end_date,
                            'status'=>'0');  
                        Transaction::insertoption($transaction);   
                        $messags['message'] = "User has been added successfully.";
                        $messags['erro']= 101;
                       }else
                       {
                        $messags['message'] =  "Error to Update ".$page;
                        $messags['erro']= 202;  
                       }
                        
                    }else
                    {
                    $data['subscription'] = Subscription::all();
		            return view('admin/add_user',$data);
                    }
            }
             else
             {
             return Redirect('/admin');
             }   
         echo json_encode($messags);
         die;
          
      
	}
	public function view_user_progress($id)
	{
            $messags = array();
            if(session()->exists('admin'))
            {
                    $data['subscription'] = Subscription::all();
                    $data['user'] = User::getdatawithid($id);
                    $data['package']=Subscription::getwithid($data['user']->package_id);
                    $data['current_package']=Transaction::get_active_payment_details($id);
                    $data['transaction']=Transaction::getwithid($id);
                    $data['application']=Useractivity::getappsuser($id);
                    $data['user_id']=$id;
                    $data['course']=Course::getactiveusercourses($id);
                    return view('admin/view_user_progress',$data);
            }else
            {
                    return Redirect('/admin');   
            }
            echo json_encode($messags);
            die;
          
	}
	public function archive_record()
	{
	    if(empty($_POST['status']))
	    {
	        $update=Course::where('id',$_POST['id'])->update(array('status'=>'2'));
	    }else
	    {
	         $update=Course::where('id',$_POST['id'])->update(array('status'=>'0'));
	    }
	    
	    
	}
	public function delete_record()
	{
	    
	     $message = array();
	    if(!empty($_POST['id']))
	    {
	        if($_POST['table'] == 'users')
	        {
	        $where=array('id'=>$_POST['id']);
	        $where1=array('user_id'=>$_POST['id']);
	        Transaction::deleterecord($where1);
	        if(User::deleterecord($where))
	        {
	            
	             $users = User::getall();
	             $datas=array();
	             $i=0;
	             foreach($users as $d)
	             {
	       $url1=url('/');
                if($d->image=='')   
                {
                $img='<img class="media-object rounded-circle" src="'.$url1.'/public/uploads/no-image-icon-6.png" alt="">';
                }else
                {
                $img='<img class="media-object rounded-circle" src="'.$url1.'/public/uploads/'.$d->image.'" alt="">';
                }
                $url=url('admin/view-user-progress/'.$d->id);
                $del=url('admin/delete_record/');
                $package=Subscription::getwithid($d->package_id);   
                if($d->status=='0')
                {
                $st='<label class="badge badge-success active_user" data-table="users" data-id="'.$d->id.'" data-status="'.$d->status.'"> Active </label>';
                }else
                {
                $st='<label class="badge badge-danger active_user"  data-table="users" data-id="'.$d->id.'" data-status="'.$d->status.'"> Inactive </label>'; 
                }    
	            $action='<a href="'.$url.'" class="btn round btn-info" data-toggle="tooltip" data-original-title="View Progress">
                <i class="fa fa-eye"></i></a>
                <span data-toggle="tooltip" data-original-title="Delete">
                <button type="button" class="btn btn-danger round delete_request" data-toggle="modal" data-table="users" data-id="'.$d->id.'" data-action="'.$del.'" data-target="#delete_modal">
                <i class="fa fa-trash"></i></button></span> ';
	            $i=$i+1;
	            $datas[]= "<tr><td>#$i</td>
	            <td><ul class='list-unstyled users-list m-0'><li data-toggle='tooltip' data-popup='tooltip-custom' data-original-title='$d->first_name $d->last_name' class='pull-up list_membler'>
                $img</li></ul></td>
				<td>$d->first_name</td>
				<td>$d->last_name</td>
				<td>$d->username</td>
				<td>$d->email</td>
				<td>$d->phone</td>
				<td id='statususer$d->id'>$st</td>
				<td>$package->plan_name</td>
				<td>$action</td>
				</tr>";
	             }
	             
	         $message=array(
			"code"=>'101',
			"status"=>'Deleted successfully..!',
			"data"=>$datas,
			);  
	             
	             
	             
	        }else
	        {
	            
	        }
	        }
	           elseif($_POST['table'] == 'courses')
	        {
	        $where=array('id'=>$_POST['id']);
	        $where1=array('course_id'=>$_POST['id']);
	         Syllabus::deleterecord($where1);
	         Lesson::deleterecord($where1);
	         Activity::deleterecord($where1);
	         Example::deleterecord($where1);
	       
	       $datas=array();
	       if(Course::deleterecord($where))
	        {
	            
	             $users = Course::getdata();
	             $datas=array();
	             $i=0;
	             foreach($users as $d)
	             {
                            $string = strip_tags($d->description);
                            if (strlen($string) > 120) {
                            $stringCut = substr($string, 0, 120);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                            }
                           
                        
	                 
	            $url=url('/');
	            
                $edit='<a href="'.$url.'/admin/edit-course/'.$d->id.'"
                class="btn round btn-success course-edit course-delete" 
                data-toggle="tooltip" 
                data-placement="bottom" title="Edit Course">
                <i class="icon-note "></i>
            	</a>';
            	
            	$delete='<button type="button" class="btn round btn-danger course-delete delete_request" data-toggle="modal" 
                data-table="courses" data-title="course" data-id="'.$d->id.'"  
                data-action="'.$url.'/admin/delete_record" data-target="#delete_modal">
                <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Delete"></i></button>';
                
                
                if(!empty($d->image)){
                   $img='<img src="'.$url.'/public/uploads/'.$d->image.'">';
                }else
                {
                    $img='<img src="'.$url.'/resources/admin_assets/images/card-icon.png">';
                }
                
            	
	            $datas[]= "<div class='col-xl-12 col-lg-12 col-sm-12'>
	            <div class='card course-card mb-4'>
	            <div class='card-body'>$edit $delete
	            <div class='card-icon'>$img</div>
	            <h4 class='card-title'>$d->title</h4>
	            <p class='card-text show-read-more'>$string</p>
	            </div>
                </div>
                </div>";
	             
                $message=array(
                "code"=>'101',
                "status"=>'Deleted successfully..!',
                "data"=>$datas,
                );  
	        }
	       
	        }
	        }
	        else if($_POST['table'] == 'mentor')
	        {
	            $where=array('id'=>$_POST['id']);
	        if(Mentor::deleterecord($where))
	        {
                    $userid =Session()->get('adminid');
                    $admin = Admin::where(array('id'=>$userid))->first();
                    $mentor=Mentor::getmentor();
                    $features=Feature::getwithid('Mentor');
                    $getplans=Subscription::getoptionswithfeature($features->id);
                    $getusers=array();
                    $user_p=array();
                    foreach($getplans as $a)
                    {
                    $getusers[]=User::getdatawithpackid($a->id);
                    
                    }
                    foreach($getusers[0] as $u)
                    {
                    
                    $user_p[]='<option value="'.$u['id'].'">'.$u['username'].'</option>';
                    }
	             $users = User::getall();
	             $datas='';
	              if(!empty($mentor)){
			        $i=1;
			        foreach($mentor as $m)
			        {
			          $data=\App\Usermentor::getdatawithmentorid($m->id); 
				   $datas .= '<tr>
					<td>#'.$i++.'</td>
					<td>
                    <ul class="list-unstyled users-list m-0">
                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="'.$m->first_name.' '.$m->last_name.'" class="pull-up list_membler">';
                    
                    if($m->image == '')
                    {
                    $datas .='<img class="media-object rounded-circle" src="'.url('/public/uploads/no-image-icon-6.png').'" alt="">';
                    }else{
                   $datas .= '<img class="media-object rounded-circle" src="'.url('/public/uploads/'.$m->image).'" alt="">';
                    }
                    $datas .='</li>
                    </ul>
                    </td>
					<td>'.$m->first_name.'</td>
					<td>'.$m->last_name.'</td>
					<td>'.$m->email.'</td>
					<td><a href="assigned-user-list.php">'.count($data).'</a></td>
					<td id="statususer'.$m->id.'">';
                    if($m->status == '1')
                    {
                    $datas .='<label class="badge badge-success active_user" data-id="'.$m->id.'" data-table="mentor" data-status="'.$m->status.'">Active </label>';
                    }else{
                    $datas .='<label class="badge badge-danger active_user" data-id="'.$m->id.'" data-table="mentor" data-status="'.$m->status.'">Inactive </label>';
                    }
                    $datas .='</td>
					<td>'.$m->phone.'</td>
					<td>
					    <a href="'.url('/admin/edit-mentor/'.$m->id).'" class="btn btn-success round" data-toggle="tooltip" data-original-title="Edit">
						<i class="icon-note "></i>
						</a>';
						if($m->status == '1')
				        {
				    	if(count($data) >0){
				    	  $data=array($data);
				    	 $string_version = implode(',', $data);
				         
						$datas .='<span data-toggle="tooltip" data-original-title="Update Assign User">
						<button type="button" class="btn round btn-info edit_assign_user" data-selected="'.$string_version.'" data-id="'.$m->id.'" data-original-title="Update Assign User" data-toggle="modal" data-target="#update_assign_user"><i class="fa fa-user-plus"></i>
						</button>
						</span>';
						 } else{
					   $datas .='<span data-toggle="tooltip" data-original-title="Assign User">
						<button type="button" class="btn round btn-info assign_user" data-id="'.$m->id.'" data-original-title="Assign User" data-toggle="modal" data-target="#assign_user"><i class="fa fa-user-plus"></i>
						</button>
						</span>';
					   } 
				         	}
						$datas .='<span data-toggle="tooltip" data-original-title="Delete">
						<button type="button" class="btn btn-danger round delete_request"  data-toggle="modal"  data-table="mentor" data-id="'.$m->id.'"  data-action="'.url('/admin/delete_record').'" data-target="#delete_modal">
                           <i class="fa fa-trash"></i>
						</button>
						</span>
					</td>
				</tr>';
			 }
			 } 
	         $message=array(
			"code"=>'101',
			"status"=>'Deleted successfully..!',
			"data"=>$datas,
			);  
	             
	             
	             
	        }else
	        {
	            
	        } 
	        }
	        else if($_POST['table'] == 'usermentor')
	        {
	            $where=array('id'=>$_POST['id']);
	            $datas='';
	            if(Usermentor::deleterecord($where))
	            {
	                $message=array(
            			"code"=>'101',
            			"status"=>'Deleted successfully..!',
            			"data"=>$datas,
			        );  
	            }
	            else
	            {
	                $message=array(
            			"code"=>'201',
            			"status"=>'Error in Deleting user',
            			"data"=>$datas,
			        );  
	            }
	        }
	          else if($_POST['table'] == 'activities')
	        {
	            $where=array('id'=>$_POST['id']);
	            $datas='';
	            if(Activity::deleterecord($where))
	            {
	                $message=array(
            			"code"=>'101',
            			"status"=>'Deleted successfully..!',
            			"data"=>$datas,
			        );  
	            }
	            else
	            {
	                $message=array(
            			"code"=>'201',
            			"status"=>'Error in Deleting user',
            			"data"=>$datas,
			        );  
	            }
	        }
	        
	    }
	echo json_encode($message);
    die;
	}
	public function add_mentor(Request $request)
	{
	    $messags = array();
        if(session()->exists('admin'))
        {
                if($request->isMethod('post'))
                {
                $userid =Session()->get('adminid');
                $data = $request->all();
                if($request->file('file'))
			            {
			            $userid =Session()->get('adminid');
			            $image = $request->file('file');
			            $imagename = time().'.'.$image->getClientOriginalExtension();
			            $destinationPath = public_path('/uploads');
			            $image->move($destinationPath, $imagename);
			           }else
			           {
			               $imagename='';
			           }
                        unset($data['_token']);
                        $query= array(
                            'first_name'=>$data['first_name'],
                            'last_name'=>$data['last_name'],
                            'email'=>$data['email'],
                            'phone'=>$data['phone'],
                            'image'=>$imagename);
                            
                       
                     $query = array_filter($query);       
                    $userid=Mentor::insertoption($query);   
                    if(!empty($userid))
                       {
                        
                        $messags['message'] = "Mentor has been added successfully.";
                        $messags['erro']= 101;
                       }else
                       {
                        $messags['message'] =  "Error to add mentor ";
                        $messags['erro']= 202;  
                       }
                }else
                {
                return view('admin/add_mentor');
                }
        }
        else
        {
        return Redirect('/admin');   
        }
        echo json_encode($messags);
        die;
          
	}
	public function getpremium_users_mentor()
	{
	    
	    
	    if(!empty($_POST['id']))
	    {
	     
	     $getusersselected=Usermentor::select('user_id')->where('mentor_id',$_POST['id'])->get()->toArray();
	     
	    $sel=explode(",",$_POST['selected']);  
	    $features=Feature::getwithid('Mentor');   
	    $getplans=Subscription::getoptionswithfeature($features->id);
	    $getusers=array();
	    $data['user_p']=array();
	    foreach($getplans as $a)
	    {
	        $getusers[]=User::getdatawithpackid($a->id);
	        
	    }
	   

	    foreach($getusers[0] as $u)
	    {
	        if($u->status=='1')
	        {
	        $st=' (Active)';
	        }else
	        {
	         $st=' (Inactive)';    
	        }
	       $ui= $u['id'];
	       $us = array();
	      foreach($getusersselected as $key=>$v)
    	     { 
    	          $us[] = $v['user_id'];   
    	       
	         
	       }
            if (in_array($u['id'],$us) )
            {
            $se="selected";
            }else
            {
            $se='';
            }
	        
	       
	        
	        $data['user_p'][]= '<option  '.$se.'  value="'.$u['id'].'">'.$u['username'].$st.'</option>';
	    } 
	        
	  return $data['user_p'];
	  }
	    
	    
	}
	public function getpremium_users()
	{
	    $messags = array();
	    
	    
	}
	public function edit_mentor($id,Request $request)
	{ 
	    $messags = array();
        if(session()->exists('admin'))
        {
            if($request->isMethod('post'))
                {
                    $data = $request->all();
                    unset($data['_token']);
          
                   if($request->file('file'))
			            {
			            $userid =Session()->get('adminid');
			            $image = $request->file('file');
			            $imagename = time().'.'.$image->getClientOriginalExtension();
			            $destinationPath = public_path('/uploads');
			            $image->move($destinationPath, $imagename);
			           Mentor::updateoption2(array('image'=>$imagename),array('id'=>$id));   
			           }
                     $query= array(
                            'first_name'=>$data['first_name'],
                            'last_name'=>$data['last_name'],
                            'email'=>$data['email'],
                            'phone'=>$data['phone'],
                            );
                      $query = array_filter($query);      
             if(Mentor::updateoption2($query,array('id'=>$id)))
                       {
                        $messags['message'] = "Mentor has been updated successfully.";
                        $messags['erro']= 101;
                       }else
                       {
                        $messags['message'] =  "Error to Update user";
                        $messags['erro']= 202;  
                       }
                }else
                {
            $data['mentor'] = Mentor::getdatawithid1($id);
            return view('admin/edit_mentor',$data);        
                }
        }
        else
        {
                return Redirect('/admin');   
        }
        echo json_encode($messags);
            die;
		
	}
	public function add_subscription ()
	{
	    $data['feature']=Feature::get();
		return view('admin/add_subscription',$data);
	}
	public function edit_subscription($id,Request $request)
	{
	     $messags = array();
        if(session()->exists('admin'))
        {
             if($request->isMethod('post'))
                {
                }else
                {
            $data['feature']=Feature::get();
            $data['sub']=Subscription::getwithid($id);
            return view('admin/edit_subscription',$data);     
                }
        }else
        {
             return Redirect('/admin');   
        }
         echo json_encode($messags);
            die;
		
		
	}
	public function saveplan(Request $request)
	{
	    $messags = array();
        if(session()->exists('admin'))
        {
             if($request->isMethod('post'))
                {
                $data = $request->all();
                  if(empty($_POST['id']))
                  {
                      if(!empty($data['features']))
                      {
                          	$features = implode(',', $data['features']);
                      }else
                      {
                            $features='';
                      }
                      
                      if(!empty($data['detailed_features']))
                      {
                          	$detailed_features = implode('#&', $data['detailed_features']);
                      }else
                      {
                            $detailed_features='';
                      }
                      
                      
                       if($request->file('file'))
    			            {
    			            $userid =Session()->get('adminid');
    			            $image = $request->file('file');
    			            $imagename = time().'.'.$image->getClientOriginalExtension();
    			            $destinationPath = public_path('/uploads');
    			            $image->move($destinationPath, $imagename);
    			           }else
    			           {
    			               $imagename='';
    			           }
			               unset($data['_token']);
			          
                            $user = Subscription::where('plan_name',$data['plan_name'])->first();
                            if(!empty($user)){
                            $messags['message'] =  "Plan name already exists.";
                            $messags['erro']= 202;
                            echo json_encode($messags);
                            die;
                            }
                            
                            $query= array(
                            'plan_name'=>$data['plan_name'],
                            'plan_img'=>$imagename,
                            'price'=>$data['price'],
                            'duration'=>$data['duration'],
                            'features'=>$features,
                            'detailed_features'=>$detailed_features,
                            );
                            
                            $userid=Subscription::insertUser($query);
                            $url='';
                            if($userid)
                            {
                            $messags=array('erro'=>'101','message'=>'Subscription added successfully..');  
                            }else
                            {
                            $messags=array('erro'=>'202','message'=>'Error Occured..');  
                            }
                       }  
                  else
                  {
                                if(!empty($data['features']))
                                {
                                $features = implode(',', $data['features']);
                                }else
                                {
                                $features='';
                                }
                                
                                if(!empty($data['detailed_features']))
                                {
                                $detailed_features1 = implode('#&', $data['detailed_features']);
                                }else
                                {
                                $detailed_features1='';
                                }
                       
                                if($request->file('file'))
                                {
                                $userid =Session()->get('adminid');
                                $image = $request->file('file');
                                $imagename = time().'.'.$image->getClientOriginalExtension();
                                $destinationPath = public_path('/uploads');
                                $image->move($destinationPath, $imagename);
                                }else
                                {
                                $imagename=$data['plan_img'];
                                }
			                   unset($data['_token']);
			          
                                $query1= array(
                                'plan_name'=>$data['plan_name'],
                                'plan_img'=>$imagename,
                                'price'=>$data['price'],
                                'duration'=>$data['duration'],
                                'features'=>$features,
                                'detailed_features'=>$detailed_features1,
                                );
                                $userid=Subscription::updateUser($query1,$_POST['id']);
                                if($userid)
                                {
                                $messags=array('erro'=>'101','message'=>'Subscription updated successfully..');  
                                }else
                                {
                                $messags=array('erro'=>'202','message'=>'Error Occured..');  
                                }
                                
                       }
                }
        }
        else
        {
        return Redirect('/admin');   
        }
        echo json_encode($messags);
        die;
	}
	public function edit_course($id,Request $request)
	{
	    $messags = array();
        if(session()->exists('admin'))
        {
            if($request->isMethod('post'))
                {
                $data = $request->all();
                  if(!empty($_POST['id']) && !empty($_POST['title']) )
                  {
                       if($request->file('file'))
    			            {
    			            $userid =Session()->get('adminid');
    			            $image = $request->file('file');
    			            $imagename = time().'.'.$image->getClientOriginalExtension();
    			            $destinationPath = public_path('/uploads');
    			            $image->move($destinationPath, $imagename);
    			            }else
    			            {
    			               $imagename=$_POST['image_course'];
    			            }
		                    unset($data['_token']);
                            $query= array(
                            'type'=>$data['type'],
                            'title'=>$data['title'],
                            'image'=>$imagename,
                            'description'=>$data['description'],
                            );
                            $userid=Course::updateoption($query,$_POST['id']);
                            $courseid=$_POST['id'];
                            $url='';
                 } 
                     elseif(!empty($_POST['course_overview']))
                     {
                             $query=array('course_overview'=>$data['course_overview']);
                             $userid=Course::updateoption($query,$id);
                             $courseid=$id;
                             $url='';
                    }
                    
                elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='edit_heading')
                {
                    $data = $request->all();
                    if(!empty($data['title']))
                    {
                    $array1=array();
                    $array=array();
                    $update=array();
                    foreach($data['title'] as $t)
                    {
                    for($i=0;$i<count($t['title']);$i++)
                    {
                    if(!empty($t['title'][$i])){
                    $exists=Syllabus::where('random_no',$t['random_no'][$i])->first();
                    if(!empty($exists))
                    {
                    $query=array("title"=>$t['title'][$i]);
                    $syllabus_id=Syllabus::where('random_no',$t['random_no'][$i])->update($query);
                    $update[] =array('random' =>$t['random_no'][$i],'text'=>$t['title'][$i]); 
                    }else   
                    {
                    $query=array(
                    "random_no"=>$t['random_no'][$i],
                    "title"=>$t['title'][$i],
                    "course_id"=>$data['course_id']
                    );
                    $syllabus_id=Syllabus::insertoption($query);
                    $random=mt_rand(100000, 999999);
                    $array1='<div class="col-md-12 subj-head_box-edit remove'.$t['random_no'][$i].'">
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <h4 class="dvl-brdr edit'.$t['random_no'][$i].'"> '.$t['title'][$i].' 
                                       
                                        </h4>
                                         <input type="hidden" value="0" id="getvalue">
                                         <input type="hidden" name="title['.$syllabus_id.'][syllabus_id][]" 
                                         class="sylb_id edit'.$t['random_no'][$i].'" data-count="'.$syllabus_id.'"
                                         value="'.$syllabus_id.'">
                                        
                                        </div>
                                        </div>
                                        <div class="row">
									    <div class="bg-ns-a">
										<div class="form-group col-sm-12 col-12">
										<label class="d-block" for="exampleInputPassword10">Lesson Name
										<a href="javascript:void(0)" class="float-right pull-right btn btn-info addScnt btn-adda" 
										id="addScnt"  data-count="'.$syllabus_id.'"  data-val="'.$syllabus_id.'" data-id="'.$random.'">
										Add Lesson </a></label>
										<input type="text" class="form-control form-control-square" id="" 
										name="title['.$syllabus_id.'][name][]"   maxlength="30" placeholder="" required>
										<input type="hidden"  name="title['.$syllabus_id.'][random_no][]" value="'.$random.'">
										</div>
										
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Content Type</label>
										<select id="colorselector'.$random.'"  onchange="chnagefun('.$random.')" 
										class="colorselector'.$random.' form-control form-control-square"
										name="title['.$syllabus_id.'][type][]" 
										required>
										<option value="">Select One</option>
										<option value="Video'.$random.'">Video</option>
										<option value="Exercise'.$random.'" selected>Exercise</option>
										</select>
										</div>
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Lesson Number</label>
										<input type="text" class="form-control form-control-square quantity" 
										name="title['.$syllabus_id.'][lesson_no][]" 
										required>
										</div>
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Duration</label>
										<input type="text" class="form-control form-control-square quantity" 
										name="title['.$syllabus_id.'][duration][]" 
										required>
										</div>
										<div class="form-group col-sm-12 col-12 colors'.$random.' Video'.$random.'"
										id="Video'.$random.'" style="display:none">
										<label for="exampleInputPassword10">Add Video</label>
										<input type="hidden"  name="title['.$syllabus_id.'][file][]" class="file_video'.$random.'">
                                        <input type="file"   data-random="'.$random.'"  
                                        class="form-control form-control-square files file_video" id="file_video'.$random.'" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-12 col-12 colors'.$random.' Exercise'.$random.'" 
                                        id="Exercise'.$random.'">
                                        <label for="exampleInputPassword10">Learn Column</label>
                                        <textarea class="summernote" id="content21" name="title['.$syllabus_id.'][description][]" ></textarea>
                                        </div>
                                        </div>
                                        <div class="p_scents  p_scents'.$random.'"></div>
                                        </div>';
                                        array_push($array,$array1);
                    } 
                    }
                    }
                    }
                    }
                    $getsyllabuswithcourse=Syllabus::getdatawithid($data['course_id']);
                    if(!empty($getsyllabuswithcourse))
                    {
                        $array2=array();
                        foreach($getsyllabuswithcourse as $get)
                        {
                            $array2[]='<option value="'.$get->id.'">'.$get->title.'</option>';
                        }
                    }
                    if(!empty($syllabus_id))
                       {
                        $messags['message'] = "Saved Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['data']=$array2;
                        $messags['update']=$update;
                        $messags['html']=$array;
                       }else
                       {
                        $messags['erro']= 102;  
                       }
                     echo json_encode($messags);
                     die;  
                    }
                elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='edit_lesson')
                {
                    $data = $request->all();
                   
                    $files = $request->file('file_video');
                    if($request->hasFile('file_video'))
                    { 
                    foreach($files as $file) {
                    
                    $destinationPath = public_path('/uploads');
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    $path = $filename;
                    }
                    
                    }
                    if(!empty($data['title']))
                    {
                    foreach($data['title'] as $t)
                    {
                    $array1=array();
                    $array=array();
                    $update=array();   
                   if(!empty($t['syllabus_id']) && count($t['syllabus_id']) > 0){
                       if(isset($t['name'])){
                         for($i=0;$i<count($t['name']);$i++)
                             {
                                 
                                 $result = substr($t['type'][$i], 0, 5);
                                 
                    
                                   if($result == 'Video')
                                 {
                                     $type='Video';
    			                     $image=$t['file'][$i];
    			                     $imagename = $image;
    			                     $description=$imagename;
                                 }else
                                 {
                                     $type='Exercise';
                                     $description=$t['description'][$i];
                                 }
                                 $exists=Lesson::where('random_no',$t['random_no'][$i])->first();
                                if(!empty($exists))
                                {
                                $query1=array(
                                'name'=>$t['name'][$i],
                                'type'=>$type,
                                'description'=>$description,
                                'duration'=>$t['duration'][$i],
                                'lesson_no'=>$t['lesson_no'][$i]
                                );
                                $lesson_id= Lesson::where('random_no',$t['random_no'][$i])->update($query1);  
                                $update[] =array('random' => $t['random_no'][$i],'text'=>$t['name'][$i]);
                                }
                                        else
                                        {
                                        $query1=array(
                                        'syllabus_id'=>$t['syllabus_id'][0],
                                        'course_id'=>$data['course_id'],
                                        'name'=>$t['name'][$i],
                                        'type'=>$type,  
                                        'description'=>$description,
                                        'random_no'=>$t['random_no'][$i],
                                        'duration'=>$t['duration'][$i],
                                        'lesson_no'=>$t['lesson_no'][$i]
                                        );
                                        $random=mt_rand(100000, 999999);
                                        $lesson_id= Lesson::insertoption($query1); 
                                        $user=Usercourse::where('course_id',$data['course_id'])->update(array('status'=>'0'));
                                        $heading=Syllabus::getdata($t['syllabus_id'][0]);
                                        $array1='<div class="remove'.$heading->random_no.' removelesson'.$t['random_no'][$i].'"><div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <label for="exampleInputPassword10" class="edit'.$heading->random_no.'">'.$heading->title.'</label>
                                        <input type="hidden" name="title['.$heading->id.'][syllabus_id][]" value="'.$heading->id.'">
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <label for="exampleInputPassword10 " class="editlesson'.$t['random_no'][$i].'">'.$t['name'][$i].'</label>
                                        <input type="hidden" name="title['.$heading->id.'][lesson_id][]" value="'.$lesson_id.'">
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <label class="d-block" for="exampleInputPassword10">
                                        Activity Type<a href="javascript:void(0);" class="btn btn-success pull-right add_act" data-count="'.$heading->id.'" data-id="0" data-id2="'.$random.'"><i class="fa fa-plus"></i>
                                        Add Activity</a></label>
                                        <input type="text" required name="title['.$heading->id.'][activity_name][]" class="form-control"> 
                                        <input type="hidden"  name="title['.$heading->id.'][random_no][]" value="'.$random.'">
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="p_scents_act'.$random.'"></div>
                                        </div></div><div class="clearfix"></div>';
                                        array_push($array,$array1);
                                }
                             }
                       }
                    }
                    }
                    $getsyllabuswithcourse=Lesson::getwithsyllabus($t['syllabus_id'][0]);
                    if(!empty($getsyllabuswithcourse))
                    {
                        $array2=array();
                        foreach($getsyllabuswithcourse as $get)
                        {
                            $array2[]='<option value="'.$get->id.'">'.$get->name.'</option>';
                        }
                    }
                    if(!empty($lesson_id))
                       {
                        $messags['message'] = "Saved Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['data']=$array2;
                        $messags['html']=$array;
                        $messags['update']=$update;
                       }else
                        {
                        $messags['erro']= 102;  
                        }
                        echo json_encode($messags);
                        die;  

                    }
                  
                }
                   elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='edit_activity')
                {
                    $data = $request->all();
                    $array1=array();
                    $array=array();
                    $update=array();
                    if(!empty($data['activity_type']))
                    {
                    $exist12=Activity::where('course_id',$data['course_id'])->delete();   
                    foreach($data['activity_type'] as $t)
                    {
                       
                    $exist=Activity::where('course_id',$data['course_id'])->where('name',$t)->first();
                    if(empty($exist))
                    {
                       $dataact=array(
                            'random_no'=>'',
                            'lesson_id'=>'',
                            'course_id'=>$data['course_id'],
                            'syllabus_id'=>'',
                            'name'=>$t
                            );

                        $act_id= Activity::insertoption($dataact);  
                    }else
                    {
                       $exist=Activity::where('course_id',$data['course_id'])->where('name',$t)->delete();  
                       $del=Example::where('course_id',$data['course_id'])->where('category_id',$t)->delete();  
                    }
                    }
                    
                    }else
                    {
                       $del=Activity::where('course_id',$data['course_id'])->delete();
                       $del=Example::where('course_id',$data['course_id'])->delete(); 
                    }
                    $getsyllabuswithcourse=Activity::getwithcourseid1($data['course_id']);
                    $getlesson=Lesson::getwithcourseid1($data['course_id']);
                    
                    if(!empty($getlesson))
                    {
                        $arraylessons=array();
                        foreach($getlesson as $get)
                        {
                         
                            $arraylessons[]='<option data-random="'.$get->random_no.' "value="'.$get->id.'">'.$get->name.'</option>';
                        }
                    }
                    $countact=count($getsyllabuswithcourse);
                    $countless=count($getlesson);
                    if(!empty($getsyllabuswithcourse))
                    {
                        $array2=array();
                        foreach($getsyllabuswithcourse as $get)
                        {
                            $act_name=Activity::where('id',$get->name)->first();
                            $lesson=Lesson::getwithid($get->lesson_id);
                           
                            if(empty($act_name))
                            {
                                $act_name="Not Found";
                            }else
                            {
                                $act_name=$act_name->name;
                            }
                            $array2[]='<option value="'.$get->name.'">'.$act_name.'</option>';
                        }
                    }
                    $stringRepresentation=Activity::getwithcourseid12($data['course_id']);
                    $getexpcourse=Example::getwithlessonidjoin1($data['course_id']);
                    
                  $examples="";  
                 if(count($getexpcourse)=='0')
                 {
                     $examples="0";
                 }
                    
                $array3=array();
                    if(count($getsyllabuswithcourse)>=1)
                       {
                        $messags['message'] = "Activity added Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['html']=$array;
                        $messags['data']=$array2;
                        $messags['activities']=$countact;
                        $messags['examples']=$examples;
                        
                        $messags['data1']=$array3;
                        $messags['lessons']=$arraylessons;
                        $messags['update']=$update;
                     
                           
                       }else
                       {
                        
                        $messags['message'] = "Please select activity..!";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']='';
                        $messags['examples']='';
                        
                        $messags['html']='';
                        $messags['data']='';
                        $messags['data1']='';
                        $messags['update']='';
                     
                           
                       }
                     echo json_encode($messags);
                     die; 
                    }
                elseif(isset($data['add_syllabus'] ) && $data['add_syllabus'] =='edit_example')
                {
                    $data = $request->all();
             
                    if(!empty($data['title']))
                    {
                    foreach($data['title'] as $t)
                    {
                    if(!empty($t['category_id'][0]) && count($t['category_id']) >= '1') 
                    {
                      
                      if(isset($t['example_description']))
                      {
                    for($i=0;$i<count($t['example_description']);$i++)
                    {
                    $exists=Example::where('random',$t['random'][$i])->first();
                    if(!empty($exists))
                    {
                        if(!empty($t['example_description'][$i]))
                        {
                    $query=array(
                    "category_id"=>$t['category_id'][0],
                    "name"=>$t['example_description'][$i],
                    "description"=>$t['example_description'][$i]
                    );
                    $syllabus_id=Example::where('random',$t['random'][$i])->update($query);
                        }
                    
                    }
                    else
                    {
                    $get=Activity::where('id',$t['category_id'][0])->first();
                      if(!empty($t['example_description'][$i]))
                        {
                    $dataactexp=array(
                    'lesson_id'=>'',
                    'course_id'=>$data['course_id'],
                    'syllabus_id'=>$get->syllabus_id,
                    'category_id'=>$t['category_id'][0],
                    'name'=>$t['example_description'][$i],
                    'random'=>$t['random'][$i],
                    'description'=>$t['example_description'][$i]
                    );
                    
                    $act_idexp= Example::insertoption($dataactexp); 
                        }
                    }
                    }
                    
                      }
                    }
                    else
                    { 
                    for($i=0;$i<count($t['example_description']);$i++)
                    {
                    if(!empty($t['example_description'][$i]))
                     {
                    $exists=Example::where('random',$t['random'][$i])->first();
                    if(!empty($exists))
                    {
                     $query=array(
                    "category_id"=>NULL,
                    "name"=>$t['example_description'][$i],
                    "description"=>$t['example_description'][$i]
                    );
                    $syllabus_id=Example::where('random',$t['random'][$i])->update($query);
                    
                    }else
                    {
                            
                            
                         $dataactexp=array(
                                         'lesson_id'=>'',
                                         'course_id'=>$data['course_id'],
                                         'syllabus_id'=>'',
                                         'category_id'=>'',
                                         'name'=>$t['example_description'][$i],
                                         'random'=>$t['random'][$i],
                                         'description'=>$t['example_description'][$i]
                                         );
                                         
                                        $act_idexp= Example::insertoption($dataactexp);
                        }
                        }
                    }
                    }
                    }
                    }
                    $url=url('/');
                    if(!empty($act_idexp))
                       {
                           
                        $messags['message'] = "Course updated successfully......!";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['data']='';
                           
                       }else
                       {
                         $messags['message'] = "Course updated successfully......!";
                        $messags['erro']= 101;
                        $messags['dataid']= $data['course_id'];
                        $messags['url']=$url.'/admin/courses';
                        $messags['data']=''; 
                       }
                     echo json_encode($messags);
                     die;  
                   
                   
                    }
                  
    
                  
                
                    
              
                       if(!empty($userid))
                       {
                        $messags['message'] = "Saved Successfully";
                        $messags['erro']= 101;
                        $messags['dataid']= $courseid;
                        $messags['url']=$url;
                           
                       }else
                       {
                        $messags['erro']= 102;  
                       }
                  
                }
                else{
                    $data['heading']=Syllabus::getwithidadmin($id);
                    $data['lesson']=Lesson::getlessoneithcourse($id);
                    $data['course_details']=Course::getdatawithid1($id);
                    $data['activity']=Activity::getwithcourseidad($id);
                    $data['activitys']=Activity::getwithcourseid($id);
                    $data['example']=Example::getwithcourseidgp($id);
                    $data['activity_admin'] = Activity::getdata();
               	    return view('admin/edit_course',$data);     
                }
                
        }else
        {
            return Redirect('/admin');   
            
        }
        echo json_encode($messags);
        die;
		
	
	}
	public function edit_exercise()
	{
		return view('admin/edit_exercise');
		
	}
	  public function getSignOut(Request $request)
    {
        Session::flush();
        $request->session()->forget('admin');
        $request->session()->forget('adminid');
        $request->session()->flush();
	    return Redirect('/admin'); 
    }
	
	/*Manage pages start from herer*/
	public function privacy_policy()
	{
        if(session()->exists('admin'))
        {  
            $data['options'] = Options::getoption();
            $data['page']='Privacy Policy';
            return view('/admin/privacy_policy',$data);
        }else
        {
            return Redirect('/admin');
        }
	}
	public function terms_conditions()
	{
        if(session()->exists('admin'))
        {  
            $data['options'] = Options::getoption();
            $data['page']='Terms & Conditions';
            return view('/admin/terms_conditions',$data);
        }else
        {
            return Redirect('/admin');
        }
	}
	public function Social_links()
	{
        if(session()->exists('admin'))
        {  
            $data['options'] = Options::getoption();
            $data['page']='Sociallinks';
            return view('/admin/sociallinks',$data);
        }else
        {
            return Redirect('/admin');
        }
	}
	
	public function assigned_user_list($id,Request $request)
	{
	    if(session()->exists('admin'))
        {  
            $data = array();
            
            
            $data['getassignedselected'] = DB::table('usermentor')
                                            ->join('users', 'usermentor.user_id', '=', 'users.id') 
                                            ->join('plans', 'users.package_id', '=', 'plans.id') 
                                            ->select('usermentor.id as usermentor_id','users.id', 'users.first_name', 'users.last_name','users.username','users.email','users.phone','users.image','users.package_id','plans.plan_name')
                                            ->where('usermentor.mentor_id',$id)
                                            ->get();
            return view('/admin/assigned_user_list',$data);
            
        }else
        {
            return Redirect('/admin');
        }
	}
	
	public function addoptions(Request $request)
    {
       if(session()->exists('admin')){
            $data= $request->all();
            $page= $data['pages'];
             unset($data['_token']);
             unset($data['pages']);
            
             foreach($data as $key => $d)
             {
                 $query= array('coulmn_name'=>$key);
                 $query2= array('coulmn_value'=>$d);
                 $result = Options::getbycondition($query);
                
                 if(count($result) > 0 )
                 { 
                   if(Options::updateoption2($query2,$query))
                   {
                     $messags['message'] = $page." has been updated successfully.";
                     $messags['erro']= 101;   
                   }else
                   {
                       $messags['message'] =  "Error To Update ".$page.".";
                       $messags['erro']= 202; 
                   }
                   
                 }else
                 {
                      if(Options::insertoption($query))
                       {
                            if(Options::updateoption2($query2,$query))
                            {
                                $messags['message'] = $page." has been updated successfully.";
                                $messags['erro']= 101;
                            }else
                            {
                                $messags['message'] =  "Error To Update ".$page.".";
                                $messags['erro']= 202;
                            }  
                       }else
                       {
                           $messags['message'] = "Error To Update ".$page.".";
                           $messags['erro']= 202; 
                       } 
                 }
                 
             }
         }else
         {
            return Redirect('/admin');
         }  
         echo json_encode($messags);
        die;
    }
    
	
	
	
	
}
