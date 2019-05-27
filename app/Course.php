<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;
use Auth;
class Course extends Authenticatable
{
use Notifiable;
protected $guard = 'admins';
/**
* The attributes that are mass assignable.
*
* @var array
* 
*/

protected $table="courses";  
protected $fillable = [
'type','title','image','description','course_overview','status','enroled_ids','order'
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/

public static function joinresultssearch($text)
{
$get = DB::table('courses')
->Join('lesson', 'lesson.course_id', '=', 'courses.id')
->Join('syllabus', 'syllabus.course_id', '=', 'courses.id')
->Where('courses.title', 'like', '%'.$text.'%')
->orwhere('syllabus.title', 'like', '%'.$text.'%')
->orwhere('lesson.name', 'like', '%'.$text.'%')
->orderby('courses.id','desc')
->groupby('lesson.course_id')
->groupby('syllabus.course_id')
->select('courses.*')
->get()
->toArray();

$get1 = DB::table('users')
->Where('users.first_name', 'like', '%'.$text.'%')
->select('users.*')
->get()
->toArray();

if(empty($get))
{
$get=array();
}

$res = array_merge($get, $get1); 
return $res;

}
public static function getactiveall()
{
$get = DB::table('courses')
->Join('lesson', 'lesson.course_id', '=', 'courses.id')
->leftJoin('usercourses', 'courses.id', '=', 'usercourses.course_id')
->groupby('lesson.course_id')
->where('usercourses.status','0')
->where('courses.status','0')
->orwhere('usercourses.status', NULL)
->orderby('courses.order','asc')

->orderby('courses.updated_at','desc')
->select('courses.*')
->get();
return $get;

}
public static function getcompleted($id)
{
$get = DB::table('courses')
->join('usercourses','courses.id', '=', 'usercourses.course_id')
->where('usercourses.status','1')
->where('courses.status','0')
->where('usercourses.user_id',$id)
->select('courses.*','usercourses.viewed_lesson','usercourses.total_lessons')
->orderby('courses.id','desc')
->limit('6')
->get();
return $get;
}
public static function getcompletedall($id)
{
$get = DB::table('courses')
->join('usercourses','courses.id', '=', 'usercourses.course_id')
->where('usercourses.status','1')
->where('usercourses.user_id',$id)
->where('courses.status','0')
->select('courses.*','usercourses.viewed_lesson','usercourses.total_lessons')
->orderby('courses.id','desc')
->get();
return $get;
}
public static function getactiveusercourses($id)
{
$get = DB::table('courses')
->Join('lesson', 'lesson.course_id', '=', 'courses.id')
->leftJoin('usercourses', 'courses.id', '=', 'usercourses.course_id')
->groupby('lesson.course_id')
->where('courses.status','0')
->where('usercourses.user_id',$id)
->orderby('courses.id','desc')
->select('courses.*')
->get();
return $get;
}
public static function getactive()
{
$get = DB::table('courses')
->Join('lesson', 'lesson.course_id', '=', 'courses.id')
->leftJoin('usercourses', 'courses.id', '=', 'usercourses.course_id')
->groupby('lesson.course_id')
->where('usercourses.status','0')
->where('courses.status','0')
->orwhere('usercourses.status', NULL)
->orderby('courses.id','desc')
->limit('6')
->select('courses.*','usercourses.status as ustatus','usercourses.user_id')
->get();
return $get;
}
public static function getallactive()
{
$get = DB::table('courses')
->Join('lesson', 'lesson.course_id', '=', 'courses.id')
->leftJoin('usercourses', 'courses.id', '=', 'usercourses.course_id')
->groupby('lesson.course_id')
->where('usercourses.status','0')
->where('courses.status','0')
->orwhere('usercourses.status', NULL)
->orderby('courses.order','asc')

->orderby('courses.updated_at','desc')
->limit('20')
->select('courses.*','usercourses.status as ustatus','usercourses.user_id')
->get();
return $get;
}
public static function getdatawithid($id){
$updateoptions = Course::where('id',$id)->first();
return $updateoptions;
}
public static function deleterecord($query)
{
$updateoptions = Course::where($query);
$updateoptions->delete();
return back();
}    
public static function getdatawithid1($id){
$updateoptions = Course::where('id',$id)->first()->toArray();
$updateoptions['syllabus']=Syllabus::where('course_id',$id)->get()->toArray();

foreach($updateoptions['syllabus'] as $us=>$val)
{
$updateoptions['syllabus'][$us]['lesson']=Lesson::where('syllabus_id',$val['id'])->get()->toArray();
foreach($updateoptions['syllabus'][$us]['lesson'] as $l=>$m)
{
$updateoptions['syllabus'][$us]['lesson'][$l]['activity']=Activity::where('lesson_id',$m['id'])->get()->toArray();
foreach(  $updateoptions['syllabus'][$us]['lesson'][$l]['activity'] as $a=>$s)
{
$updateoptions['syllabus'][$us]['lesson'][$l]['activity'][$a]['example_description']=Example::where('category_id',$s['id'])->get()->toArray();
}

}
}        
return $updateoptions;
}
public static function getdata()
{
return Course::orderBy('order','asc')->orderBy('updated_at','desc')->where('status','0')->get();
}
public static function getdatapageinate_archive()
{
return Course::where('status','2')->orderBy('id','desc')->paginate('10');  
}
public static function getdatapageinate()
{
return Course::orderBy('updated_at','desc')->where('status','0')->orderBy('order','asc')->paginate('10');
}

public static function getwithid($id = '')
{
return $name= Course::where(array('id' => $id ))->first();

}

public static function getuser()
{
return Admin::all();
}



public static function insertoption($condition='')
{
return Course::create($condition)->id;
}

public static function updateoption($condition='',$id='')
{
$updateoptions = Course::findOrFail($id);
$updateoptions->update($condition);
return $id;
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
