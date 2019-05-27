<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Notification extends Authenticatable
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
    protected $table="notification";  
    protected $fillable = [
        'from_id','from','to_id','to','title','description','url','status'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
  public static function getdatawithid($id){
                return $updateoptions = Notification::where('id',$id)->first();
                 
               
           }
    public static function getdata($cond)
       {
           return Notification::where($cond)->orderBy('id','desc')->get();
       }
        public static function getdata2($cond)
       {
           return Notification::where($cond)->orderBy('id','desc')->get();
       }
       
       public static function getwithid($id = '')
       {
          return $name= Notification::where(array('name' => $id ))->first();
           
       }
  
        public static function getuser()
        {
         return Notification::all();
        }
          public static function getuser1()
        {
         return Notification::where(array('to' => "Admin"))->orderBy('id','desc')->paginate('5');
        }
          
       
        
        public static function insertNotification($condition='')
        {
         return Notification::insert($condition);
        }
        
        public static function updateUser($condition='',$id='')
        {
            $updateoptions = Admin::findOrFail($id);
            $updateoptions->update($condition);
            return back();
        }
        
        public static function getbycondition($conditiion = '')
        {
         return Notification::where($conditiion)->get();
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
