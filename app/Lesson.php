<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Session;
class Lesson extends Authenticatable
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
    protected $table="lesson";  
    protected $fillable = [
        'syllabus_id','course_id','name','type','description','random_no','duration','lesson_no'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
  public static function getwithcourseid1($id){
      return $updateoptions = Lesson::where('course_id',$id)->orderBy('lesson_no','desc')->get();  
      
  }
  public static function getwithsyllabus($id){
      
      return $updateoptions = Lesson::where('syllabus_id',$id)->orderBy('lesson_no','asc')->get();  
      
  }
  
  public static function getlessoneithcoursecon1($id,$pcid,$uid){
       if($pcid!='')
        {
        $user=User::where('id',$uid)->first();
           $features = explode(',', $user->feature);
            $fea=[];
            foreach($features as $f)
            {
            $nm = Feature::getdatawithid($f);
            $fea[]=($nm=='Text')? 'Exercise':$nm;
            }
        
    
        $updateoptions=Lesson::where('course_id',$id)->wherein('type',$fea)->orderBy('lesson_no','asc')->get()->toArray();
       
        return count($updateoptions);
        
        }
        else
        {
         return  $updateoptions=array();
            
        }
      
     
  }
  
  
  
 public static function getlessoneithcoursecon($id,$pcid){
       if($pcid!='')
        {
        $user=User::where('id',Session::get('userid'))->first();
           $features = explode(',', $user->feature);
            $fea=[];
            foreach($features as $f)
            {
            $nm = Feature::getdatawithid($f);
            $fea[]=($nm=='Text')? 'Exercise':$nm;
            }
        
    
        $updateoptions=Lesson::where('course_id',$id)->wherein('type',$fea)->orderBy('lesson_no','asc')->get()->toArray();
       
        return count($updateoptions);
        
        }
        else
        {
         return  $updateoptions=array();
            
        }
      
     
  }
           
   public static function getlessoneithcourse($id){
      
      return $updateoptions = Lesson::where('course_id',$id)->get();  
      
  }
   public static function getwithcoursex($id){
       
     return $updateoptions = Lesson::where('course_id',$id)->where('type','Exercise')->get();  
         
       
   }
   public static function getwithcourse($id){
      
      return $updateoptions = Lesson::where('course_id',$id)->where('type','Video')->get();  
      
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
    public static function getdata()
       {
           return Feature::where(array('status' => '1'))->get();
       }
       
       public static function getwithid($id = '')
       {
          return $name= Lesson::where(array('id' => $id ))->first();
           
       }
   public static function deleterecord($query)
        {
        $updateoptions = Lesson::where($query);
        $updateoptions->delete();
        return back();
        }   
        public static function getuser()
        {
         return Admin::all();
        }
        
       
        
        public static function insertoption($condition='')
        {
         return Lesson::create($condition)->id;
        }
        
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Lesson::findOrFail($id);
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
