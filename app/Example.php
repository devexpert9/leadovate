<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Example extends Authenticatable
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
    protected $table="example";  
    protected $fillable = [
        'lesson_id','course_id','syllabus_id','category_id','name','random','description'
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
           
       public static function getwithlessonidjoin1($id)
       {
           $result=Example::where('course_id',$id)->get();
         
        
        return $result;
           
       }
       public static function getwithlessonidjoin($id,$id1)
     {
       $result = Example::join('activitytype', 'activitytype.id', '=', 'example.category_id')
    ->select('example.description', 'activitytype.name')
    ->where('example.course_id',$id)
     ->where('example.lesson_id',$id1)
    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
    ->get();
         
        
        return $result;
         
     }    
           
           
    public static function getdata()
       {
           return Example::where(array('status' => '1'))->get();
       }
       
       public static function getwithid($id = '')
       {
          return $name= Example::where(array('name' => $id ))->first();
           
       }
        public static function getwithcourseid($id = '')
       {
          return $name= Example::where(array('course_id' => $id ))->get();
           
       }
        public static function getwithcourseidgp($id = '')
       {
          return $name= Example::where(array('course_id' => $id ))->groupBy('category_id')->get();
           
       }
  
        public static function getuser()
        {
         return Example::all();
        }
        
        public static function deleterecord($query)
        {
        $updateoptions = Example::where($query);
        $updateoptions->delete();
        return back();
        }   
        
        public static function insertoption($condition='')
        {
         return Example::create($condition)->id;
        }
        
        public static function updateoption($condition='',$id='')
        {
            $updateoptions = Example::findOrFail($id);
            $updateoptions->update($condition);
            return $id;
        }
        
        public static function getbycondition($conditiion = '')
        {
         return Example::where($conditiion)->get();
        }
        
        public static function getbycondition2($conditiion = '')
        {
         return Example::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }
        
        public static function getbycondition3($conditiion = '')
        {
         return Example::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }
        
        public static function getdetailsuserret2($conditiion='',$field='')
    {
        $data= Example::where($conditiion)->orderBy('id', 'desc')->first();
        return $data->$field;
    }
}
