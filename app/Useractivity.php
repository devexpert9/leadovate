<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
class Useractivity extends Authenticatable
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
    protected $table="user_activities";  
    protected $fillable = [
        'user_id','course_id','syllabus_id','lesson_id','user_selection','name','user_input','activity_title','activity_time','participation_grade','hour_week','week_year'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
     public static function getwithuserid($id,$lid){
         
         return $updateoptions = Useractivity::where('user_id',$id)->where('course_id',$lid)->get(); 
     }
    
     public static function getwithlessonidjoin($id)
     {
         $updateoptions = Useractivity::where('lesson_id',$id)->get()->toArray();
        //$updateoptions['syllabus']['lessons']=array();
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
        $updateoptions = Useractivity::where($query);
        $updateoptions->delete();
        return back();
        }   
        public static function getwithid($id = '')
        {
          return $name= Useractivity::where(array('lesson_id' => $id ))->get();
           
        }
         public static function getwithids($id = '')
        {
          return $name= Useractivity::where(array('course_id' => $id,'user_id'=>Session::get('userid')))->get();
           
        }
         public static function getalldata($id='')
        {
        $get = DB::table('user_activities')
        ->join('courses', 'courses.id', '=', 'user_activities.course_id')
        ->join('lesson', 'lesson.id', '=', 'user_activities.lesson_id')
        ->groupby('user_activities.lesson_id')
        ->where('user_activities.user_id',$id)
        ->select('user_activities.lesson_id','lesson.name','lesson.description','courses.title', 'courses.image')
        ->get();
        return $get;
        
        }
        public static function getappsuser($id)
        {
			$get = DB::table('user_activities')
			->join('courses', 'courses.id', '=', 'user_activities.course_id')
			->where('user_activities.user_id',$id)
			->groupby('user_activities.course_id')
			->orderby('user_activities.id','desc')
			->select('user_activities.lesson_id','courses.title as name','courses.title', 'courses.image','user_activities.course_id as syllabus_id')
			->limit('6')
			->get();




			return $get;
        }
        
        public static function getuser()
        {
         return Useractivity::all();
        }
        public static function insertoption($condition='')
        {
         return Useractivity::create($condition)->id;
        }
        
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Useractivity::findOrFail($id);
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
