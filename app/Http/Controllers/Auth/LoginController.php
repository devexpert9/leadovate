<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Hash;
use Session;
use Redirect;
use DB;
use App\Transaction; 
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/all-cources';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        if(session()->exists('user'))
        { 
            return redirect()->action('HomeController@index');

       //  $userid =Session()->get('userid');
       //$data['user'] = User::getbycondition(array('id'=>$userid));
       // return redirect('/home',$data);
        //$userid =Session()->get('userid');
       // $data['user'] = User::getbycondition(array('id'=>$userid));
        // return view('/user/home',$data);
        }else{
          return view('auth.login');
        }
    
    }

    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
        return redirect('/auth/login');
    }
    
    public function authenticate(\Illuminate\Http\Request $request)
    {    $request['status'] = 1;
        $credentials = $request->only('email', 'password', 'status');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }
    public function login(\Illuminate\Http\Request $request)
{
  
       $email = $request->email;
       $password = $request->password;
      

       $where = [['email','=', $email],['status','!=', '2']];
       $vendors = User::where($where)->get();
       if (count($vendors) > 0) {
            $wereh= [['email','=',$email],['status','=','1']];
           $users =  User::getbycondition($wereh);
           if(count($users) > 0 )
           { 
                $hashedPassword= User::getdetailsuserret2($wereh,'password');
                if(!empty($hashedPassword))
                {
                    if (Hash::check($password, $hashedPassword)) 
                    {  $where = [['email','=',$email],['status','=','1']];
                        $vendors = User::where($where)->first();
                       /* if($vendors->package_id == '1')
                        {
                            $expiry = DB::table('users_hours')->where('user_id',$vendors->id)->select('expiry')->first();
                            if(date('Y-m-d') >= date('Y-m-d',strtotime($expiry->expiry))){
                                $start_date =date('Y-m-d');  
                                $date = strtotime($start_date);
                                $date = date('Y-m-d',strtotime("+7 day", $date));  
                                 
                                $update_question_count=array(
                                'total_hours'=>'00:30:00',
                                'package_id'=>'1',
                                'expiry'=>$date,
                                'current_question_count'=>'0',
                                );
                                Hours::updateoption2($update_question_count,array('user_id'=>$vendors->id));
                                
                                $transaction_data=array(
                                'transaction_id'=>'0',
                                'user_id'=>$vendors->id,
                                'package_id'=>'1',
                                'status'=>'completed',
                                'currency'=>"",
                                'amount'=>'0',
                                'walletuse'=>'0',
                                'exp'=>$date
                                );
                                Transaction::insertUser($transaction_data);
                            }
                        }*/
                        if (!empty($vendors)) {
                            $userdata = array(
                            'id'=> $vendors->id ,
                            'first_name' => $vendors->first_name ,
                            'last_name' => $vendors->last_name ,
                            'email' => $vendors->email ,
                            );
    
                            Session::put('user',$userdata);
                            Session::put('userid', $vendors->id);
                            Session::save();
                            return  redirect(url('all-cources'));
                        }else
                        { 
                            return Redirect::to('/login')->withInput($request->only($this->username(), 'remember'))->with('error', 'The selected email is invalid or the account has been disabled.');

                        }
                    }else
                    {
                        return Redirect::to('/login')->withInput($request->only($this->username(), 'remember'))->with('error', "Your credentials doesn't match with our record.");
                    }
                }else
                {  
                     return Redirect::to('/login')->withInput($request->only($this->username(), 'remember'))->with('error', 'The selected email is invalid or the account has been disabled.');
                }
           }else
           { 
                return Redirect::to('/login')->withInput($request->only($this->username(), 'remember'))->with('error', 'The selected email is invalid or the account has been disabled.');
           }
       }else
       {  
            return Redirect::to('/login')->withInput($request->only($this->username(), 'remember'))->with('error', "Your credentials doesn't match with our record.");
       }
}
    
   protected function validateLogin(\Illuminate\Http\Request $request)
{
      

    $this->validate($request, [
        $this->username() => 'required|exists:users,' . $this->username() . ',status,1',
        'password' => 'required',
    ], [
        $this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.'
    ]);
    
}
}
