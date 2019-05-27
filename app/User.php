<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_year','first_name','last_name', 'email', 'password','image','username','phone','package_id','address','city','country','zip_code','feature'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function getUsermatchdb($condition)
        {
         return User::where($condition)->pluck('fb_id');
        }
     public static function insertUser($condition='')
        {
         return User::insert($condition);
        }
         public static function getdetailsuserret2($conditiion='',$field='')
			{
			    $data= User::where($conditiion)->orderBy('id', 'desc')->first();
			    return $data->$field;
			}
        public static function getbycondition($conditiion = '')
        {
         return User::where($conditiion)->get();
        }
    public static function getnamewithid($id)
    {
        
        $get=User::where('id',$id)->first();
        if($get->status=='1')
        {
            $st=' (Active)';
        }else
        {
             $st=' (Inactive)';
        }
        
        return $get->username.$st;
    }
    public static function getrecent()
    {
         return $get=User::take(5)->orderby('id','desc')->get();
    }
    public static function getall()
    {
      return $get=User::orderby('id','desc')->get(); 
        
    }
    
    public static function updateUser($condition='',$id='')
    {
        $updateoptions = User::findOrFail($id);
        $updateoptions->update($condition);
        return back();
    }
    
     public static function updateoption2($condition='',$query='')
   {
            $updateoptions = User::where($query);
            $updateoptions->update($condition);
            return back();
   }
   public static function deleterecord($query)
   {
    $updateoptions = User::where($query);
    $updateoptions->delete();
    return back();
       
   }
    public static function insertoption($data)
    {
        return User::create($data)->id;
    }
    public static function getdatawithid($id)
    {
      return $get=User::where('id',$id)->first(); 
    }
      public static function getdatawithpackid($id)
    {
      return $get=User::where('package_id',$id)->where('status','1')->get(); 
    }
    
        public static function getUsermatch($condition)
        {
        return User::where($condition)->pluck('email');
        }
        public static function getUsermatch2($condition)
        {
        return User::where($condition)->pluck('username');
        }
}
