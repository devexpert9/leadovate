<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Subscription;
use App\Transaction;
use App\User;
use App\Options;
use Hash;
use Mail;
use App\Notification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	 public function register_user(Request $request)
    {
        $data=$_POST;
        $subsriptions = Subscription::getbycondition34(array('status'=>'1'));
        return view('pricing_login',compact('data','subsriptions'));
        
    }
	public function pricing_login()
	{
	     $data['subsriptions'] = Subscription::getbycondition34(array('status'=>'1'));
		 return view('pricing_login',$data);
	}
	 public function checkuseremail()
   {
    $user = User::where('email',$_POST['email'])->first();
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
   
    public function privacy_policy()
    {
        $data['options'] = Options::getoption();
        $data['title']='Privacy Policy';
        return view('privacy-policy',$data);
    }
   
    public function terms_conditions()
    {
        $data['options'] = Options::getoption();
        $data['title']='Terms & Condition';
        return view('terms-conditions',$data);
    }
    public function register_user_add(Request $request)
    { 
     
        $message=array();
        if(isset($_POST) && !empty($_POST['first_name']))
        {
        $data=$_POST;
        $query= array(
                            'first_name'=>$data['first_name'],
                            'last_name'=>$data['last_name'],
                            'username'=>$data['username'],
                            'email'=>$data['email'],
                            'phone'=>$data['phone'],
                            'password'=>Hash::make($data['password']),
                            'package_id'=>$data['package_id'],
                            'feature'=>$data['feature'],
                            'school_year'=>$data['school_year'],
                    );
       
        $userid=User::insertoption($query);
        $subscription=Subscription::where('id',$data['package_id'])->first();
        $date=date('Y-m-d');
        $time = strtotime($date);
        $final = date('Y-m-d', strtotime("+$subscription->duration month", $time));
    
        $transaction= array(
                'transaction_id'=>'0',
                'user_id'=>$userid,
                'package_id'=>$data['package_id'],
                'currency'=>'USD',
                'amount'=>$subscription->price,
                'added_by'=>$userid,
                'status'=>'0',
                'start_date'=>$date,
                'end_date'=>$final,
        );
        
        $tid=Transaction::insertoption($transaction); 
        $url=url('/admin');
        $data2=array(
        "from_id"=>$userid,
        "from"=>'User',
        "to_id"=>'1',
        "to"=>'Admin',
        "title"=>'New User has been registered',
        "description"=>'New user <b>'.$data['first_name'].' '.$data['last_name'].'</b> has been registered with package '.$subscription->plan_name,
        "url"=>$url.'/view-user-progress/'.$userid,
        "status"=>'0');
        $not=Notification::insertNotification($data2);
        
        
        $message=array(
        "erro"=>'101',
        "message"=>'Registered Successfully ... ! Please login ..!',
        );
        }
        echo json_encode($message);
    }
   
}



	
