<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mentor extends Authenticatable
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
protected $table="mentor";  
protected $fillable = [
'first_name','last_name','email','phone','image','status'
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
public static function getdata()
{
return Country::where(array('parent' => '0'))->get();
}

public static function getwithid($id = '')
{
return $name= Transaction::where(array('user_id' => $id ))->where('status','1')->get();

}
public static function updateoption2($condition='',$query='')
{
$updateoptions = Mentor::where($query);
$updateoptions->update($condition);
return back();
}
public static function getmentor()
{
return Mentor::orderby('id','desc')->get();
}

public static function getdatawithid1($id)
{
return $get=Mentor::where('id',$id)->first(); 
}

public static function insertoption($condition='')
{
return Mentor::create($condition)->id;
}

public static function deleterecord($query)
   {
    $updateoptions = Mentor::where($query);
    $updateoptions->delete();
    return back();
       
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


   
}
