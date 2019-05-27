<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

                class Admin extends Authenticatable
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
                protected $table="admin";  
                protected $fillable = [
                'first_name','last_name','email', 'password','country','state','city'
                ];
                /**
                * The attributes that should be hidden for arrays.
                *
                * @var array
                */
                public static function getdatawithid($id){
                $updateoptions = Admin::where('id',$id)->first();
                if(!empty($updateoptions->profile))
                {
                echo $pro=$updateoptions->profile;
                }else
                {
                echo $pro='user1.png';
                }
                
                }
                public static function updateoption($condition='',$query='')
                {
                $updateoptions = Admin::where($query);
                $updateoptions->update($condition);
                return back();
                }
                public static function getUserDetail($id = '')
                {
                return Admin::where(array('id' => $id ))->get();
                }
                
                public static function getname($id = '')
                {
                $name= Admin::where(array('id' => $id ))->first();
                echo $name->name;
                }
                
                public static function getuser()
                {
                return Admin::all();
                }
                
                
                
                public static function insertUser($condition='')
                {
                return Admin::insert($condition);
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
