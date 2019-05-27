<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usermentor extends Authenticatable
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
    protected $table="usermentor";  
    protected $fillable = [
        'mentor_id','user_id'
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
   
    public static function getdatawithmentorid($id)
       {
           return Usermentor::where('mentor_id',$id)->pluck('user_id');
       }
       
       public static function getuserwithmentor($id = '')
       {
           return $get= Usermentor::where(array('mentor_id' => $id ))->get();
           
       }
       public static function getwithid($id = '')
       {
          return $name= Feature::where(array('name' => $id ))->first();
           
       }
  
        public static function getuser()
        {
         return Admin::all();
        }
        
       
        
        public static function insertUser($condition='')
        {
         return Usermentor::insert($condition);
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
    
    
    public static function deleterecord($query)
    {
        $updateoptions = Usermentor::where($query);
        $updateoptions->delete();
        return back();
    }
}
