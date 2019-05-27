<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Usercourse extends Authenticatable
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
    protected $table="usercourses";  
    protected $fillable = [
        'course_id','user_id','total_lessons','viewed_lesson','status'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
     public static function getwithuserid($id,$lid){
         
         return $updateoptions = Useractivity::where('user_id',$id)->where('lesson_id',$lid)->get(); 
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
            $data=Useractivity::where('course_id',$id)->get();
        }
        public static function getdata()
        {
        return Useractivity::where(array('status' => '1'))->get();
        }
        public static function deleterecord($query)
        {
        $updateoptions = Usercourse::where($query);
        $updateoptions->delete();
        return back();
        }   
        public static function getwithid($id = '')
        {
          return $name= Useractivity::where(array('lesson_id' => $id ))->get();
           
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
         return Useractivity::all();
        }
        public static function insertcourse($condition='')
        {
         return Usercourse::create($condition)->id;
        }
        
          public static function updateoptionwithcid($condition='',$id='')
        {
            $updateoptions = Usercourse::where('course_id',$id);
            $updateoptions->update($condition);
            return $id;
        }
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Usercourse::findOrFail($id);
            $updateoptions->update($condition);
            return $id;
        }
        
        public static function getbycondition($conditiion = '')
        {
         return Useractivity::where($conditiion)->get();
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
