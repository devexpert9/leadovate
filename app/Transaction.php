<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Transaction extends Authenticatable
{
     use Notifiable;
// The authentication guard for admin
    protected $guard = 'admins';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      * 
      */
    protected $table="transaction";  
    protected $fillable = [
        'transaction_id','user_id','package_id','currency','amount','added_by','status'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
  public static function getdatawithid($id){
                 $updateoptions = Subscription::where('id',$id)->first();
                 if(!empty($updateoptions->plan_name))
                 {
                     echo $pro=$updateoptions->plan_name;
                 }else
                 {
                     echo $pro='No name';
                 }
               
           }
           
       public static function deleterecord($query)
   {
    $updateoptions = Transaction::where($query);
    $updateoptions->delete();
    return back();
       
   }    
    public static function getdata()
       {
           return Country::where(array('parent' => '0'))->get();
       }
       
       public static function getwithid($id = '')
       {
           return $name= Transaction::where(array('user_id' => $id ))->where('status','1')->get();
         
       }
         public static function get_active_payment_details($id)
    {
          return $details= Transaction::where(array('user_id' => $id,'status'=>'0'))->first();
        
    }
       
        public static function getuser()
        {
         return Admin::all();
        }
        
        public static function updateoptions($condition='',$id='')
        {
            $updateoptions = Transaction::where('user_id',$id);
            $updateoptions->update($condition);
            return back(); 
        }
       
        
        public static function insertoption($condition='')
        {
         return Transaction::insert($condition);
        }
        
        public static function updateUser($condition='',$id='')
        {
            $updateoptions = Admin::findOrFail($id);
            $updateoptions->update($condition);
            return back();
        }
        
        public static function getbycondition($conditiion = '')
        {
         return Admin::where($conditiion)->get();
        }
        
        public static function getbycondition2($conditiion = '')
        {
         return Admin::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }
        
        public static function getbycondition3($conditiion = '')
        {
         return Admin::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }
        
        public static function getdetailsuserret2($conditiion='',$field='')
    {
        $data= Admin::where($conditiion)->orderBy('id', 'desc')->first();
        return $data->$field;
    }
}
