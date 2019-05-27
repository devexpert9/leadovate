<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class Activity extends Authenticatable
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
    protected $table="activitytype";  
    protected $fillable = [
        'lesson_id','syllabus_id','course_id','name','random_no'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
     public static function getwithlessonidnew($id){
      return $updateoptions = Activity::where('course_id',$id)->groupBy('name')->get();  
    
     }
     public static function getwithlessonid($id){
         
         return $updateoptions = Activity::where('lesson_id',$id)->get(); 
     }
    public static function updateoption2($condition='',$query='')
    {
    $updateoptions = Activity::where($query);
    $updateoptions->update($condition);
    return back();
    }
      public static function getwithcourseid($id){
         
         return $updateoptions = Activity::where('course_id',$id)->get(); 
     }
      public static function getwithcourseid12($id){
            $updateoptions = Activity::where('course_id',$id)->groupBy('name')->get(); 
         $getp='<option value="">Select Category</option>';
        
            foreach($updateoptions as $a){
                   $getu=Activity::where('id',$a->name)->first();
                $getp=$getp."<option value=$a->name>$getu->name</option>";
                
            }
            return $getp;
      }
      public static function getwithcourseid1($id){
         
         return $updateoptions = Activity::where('course_id',$id)->groupBy('name')->get(); 
     }
     
      public static function getwithcourseidad($id){
         
         return $updateoptions = Activity::where('course_id',$id)->groupBy('lesson_id')->get(); 
     }
     public static function getwithlessonidjoin($id)
     {
         $updateoptions = Activity::where('lesson_id',$id)->get()->toArray();
       
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
            $data=Activity::where('course_id',$id)->get();
            
            
            
      /*  $data = DB::table('activitytype');
        $data =  $data->join('example', 'activitytype.id', '=', 'example.category_id');
        $data =  $data->select('activitytype.*', 'example.*');
        $data =  $data->where('activitytype.course_id','=',$id);
        $data =  $data->orderBy('activitytype.id', 'desc')->get();
        return $data;
        
        */
        }
        public static function getdata()
        {
        return Activity::where(array('course_id' => NULL,'status'=>'1'))->orderBy('id','desc')->get();
        }
        public static function deleterecord($query)
        {
        $updateoptions = Activity::where($query);
        $updateoptions->delete();
        return back();
        }   
       public static function getwithid($id = '')
       {
          return $name= Feature::where(array('name' => $id ))->first();
           
       }
        public static function getuser()
        {
         return Admin::all();
        }
        public static function insertoption($condition='')
        {
         return Activity::create($condition)->id;
        }
        
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Activity::findOrFail($id);
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
