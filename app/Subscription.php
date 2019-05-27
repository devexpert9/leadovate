<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subscription extends Authenticatable
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
protected $table="plans";  
protected $fillable = [
'plan_name','plan_img','price','duartion','features','status','detailed_features'
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

public static function getoptionswithfeature($id)
{
    
return $get=Subscription::whereRaw("FIND_IN_SET($id,features)")->get();   
    
}
public static function getdata()
{
return Country::where(array('parent' => '0'))->get();
}

public static function getwithid($id = '')
{
return $name= Subscription::where(array('id' => $id ))->first();

}

 public static function updateoption2($condition='',$query='')
{
 $updateoptions = Subscription::where($query);
 $updateoptions->update($condition);
 return back();
}
public static function getuser()
{
return Admin::all();
}



public static function insertUser($condition='')
{
return Subscription::insert($condition);
}

public static function updateUser($condition='',$id='')
{
$updateoptions = Subscription::findOrFail($id);
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

public static function getall()
{
return Subscription::orderBy('id', 'desc')->get();
    
}

public static function getbycondition34($conditiion = '')
{
return Subscription::where($conditiion)->orderBy('id', 'asc')->get();
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
