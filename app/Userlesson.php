<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Userlesson extends Authenticatable
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
    protected $table="user_lessons";  
    protected $fillable = [
        'user_id','lesson_id'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
     public static function getwithuserid($id,$lid){
         
         return $updateoptions = Useractivity::where('user_id',$id)->where('lesson_id',$lid)->get(); 
     }
    
     public static function getviewedlessons($uid,$cid)
     {
          $get = DB::table('user_lessons')
        ->Join('lesson', 'lesson.id', '=', 'user_lessons.lesson_id')
        ->where('user_lessons.user_id',$uid)
        ->where('lesson.course_id',$cid)
        ->select('user_lessons.*')
        ->get();
        return count($get);
         
     }
     public static function getwithlessonidjoin($id)
     {
         $updateoptions = Useractivity::where('lesson_id',$id)->get()->toArray();
       
        foreach($updateoptions as $us=>$val)
        {
           $updateoptions[$us]['example']=Example::where('category_id',$val['id'])->get()->toArray();
        }        
        return $updateoptions;
     }
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
           
        public static function getactivitiesexamples($id)
        {
            $data=Userlesson::where('course_id',$id)->get();
        }
        public static function getdata()
        {
        return Userlesson::where(array('status' => '1'))->get();
        }
        public static function deleterecord($query)
        {
        $updateoptions = Userlesson::where($query);
        $updateoptions->delete();
        return back();
        }   
        public static function getwithid($id = '')
        {
          return $name= Userlesson::where(array('lesson_id' => $id ))->get();
           
        }
         public static function getalldata()
        {
        $get = DB::table('user_activities')
        ->join('courses', 'courses.id', '=', 'user_activities.course_id')
        ->join('lesson', 'lesson.id', '=', 'user_activities.lesson_id')
        ->groupby('user_activities.lesson_id')
        ->select('user_activities.lesson_id','lesson.name','lesson.description','courses.title', 'courses.image')
        ->get();
        return $get;
        
        }
        public static function getappsuser($id)
        {
            $get = DB::table('user_activities')
            ->join('courses', 'courses.id', '=', 'user_activities.course_id')
             ->join('lesson', 'lesson.id', '=', 'user_activities.lesson_id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('user_activities.user_id',$id)
            ->groupby('user_activities.lesson_id')
            ->select('user_activities.lesson_id','lesson.name','lesson.description','courses.title', 'courses.image')
            ->limit('3')
            ->get();
            
            
            
           // $get=Useractivity::where('user_id',$id)->groupBy('course_id')->get();
            return $get;
        }
        
        public static function getuser()
        {
         return Userlesson::all();
        }
        public static function insertcourse($condition)
        {
         return Userlesson::create($condition)->id;
        }
        
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Useractivity::findOrFail($id);
            $updateoptions->update($condition);
            return $id;
        }
        
        public static function getbycondition($conditiion = '')
        {
         return Userlesson::where($conditiion)->get();
        }
        
        public static function getbycondition2($conditiion = '')
        {
         return Useractivity::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }
        
        public static function getbycondition3($conditiion = '')
        {
         return Useractivity::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }
        
        public static function getdetailsuserret2($conditiion='',$field='')
        {
        $data= Useractivity::where($conditiion)->orderBy('id', 'desc')->first();
        return $data->$field;
        }
}
