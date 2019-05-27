<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Session;
class Syllabus extends Authenticatable
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
    protected $table="syllabus";  
    protected $fillable = [
        'title','status','course_id','random_no'
    ];
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    
  public static function getdatawithid($id){
                return $updateoptions = Syllabus::where('course_id',$id)->get();
                 
           }
           
    public static function getdata($id)
       {
           return Syllabus::where(array('id' => $id))->first();
       }
       
       
       
       
       public static function getwithidadmin($id = '',$pcid='')
       {
          
            
        $updateoptions=Syllabus::where('course_id',$id)->get()->toArray();
         foreach($updateoptions as $us=>$val)
        {
            
           
           $updateoptions[$us]['lesson']=Lesson::where('syllabus_id',$val['id'])->get()->toArray();
        
           
         
       
       }
        return $updateoptions;
        
       
       }
       public static function getwithid($id = '',$pcid='')
       {
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
        
        $updateoptions=Syllabus::where('course_id',$id)->get()->toArray();
         foreach($updateoptions as $us=>$val)
        {
        $updateoptions[$us]['lesson']=Lesson::where('syllabus_id',$val['id'])->wherein('type',$fea)->orderBy('lesson_no','asc')->get()->toArray();
        }
        //print_r($updateoptions);
        
        //array_multisort(array_column($updateoptions, 'lesson_no'), SORT_ASC, $updateoptions);
        return $updateoptions;
        
        }
        else
        {
         return  $updateoptions=array();
            
        }
       }
  
        public static function getuser()
        {
         return Admin::all();
        }
         public static function deleterecord($query)
        {
        $updateoptions = Syllabus::where($query);
        $updateoptions->delete();
        return back();
        }   
       
        
        public static function insertoption($condition='')
        {
         return Syllabus::create($condition)->id;
        }
        
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Syllabus::findOrFail($id);
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
