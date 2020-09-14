<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

  //Route::get('/login','UserController@login');

  public function register(Request $request){
    $user = new User();
    $user->name=$request->input('name');
    $user->username=$request->input('username');
    $user->email=$request->input('email');
    $password=$request->input('password');
    $hash_password=Hash::make($password);
    $user->password=$hash_password;
    $user->bio=$request->input('bio');
    $user->date_of_birth=$request->input('date_of_birth');
    $user->gender=$request->input('gender');
    $user->university=$request->input('university');
    $user->degree=$request->input('degree');
    //CHECK IMAGE UPLOAD
    $user->profile_picture=$request->input('profile_picture');
    $user->banner_picture=$request->input('banner_picture');
    $user->is_online=$request->input('is_online');

    $res=$user->save();
    if($res=true){
      $message= "Registered Successfully";
      $status = 200;
    }else{
      $message= "Registration Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function editUserDetails(Request $request, $id){
    $name=$request->input('name');
    $username=$request->input('username');
    $email=$request->input('email');
    $password=$request->input('password');
    $hash_password=Hash::make($password);
    $bio=$request->input('bio');
    $date_of_birth=$request->input('date_of_birth');
    $gender=$request->input('gender');
    $university=$request->input('university');
    $degree=$request->input('degree');
    //CHECK IMAGE UPLOAD
    $profile_picture=$request->input('profile_picture');
    $banner_picture=$request->input('banner_picture');
    $is_online=$request->input('is_online');

    $res= User::where('id', $id)->update(array(
      'name'=>$name,
      'username'=>$username,
      'email'=> $email,
      'password'=> $hash_password,
      'bio'=> $bio,
      'date_of_birth'=>$date_of_birth,
      'gender'=>$gender,
      'university'=>$university,
      'degree'=>$degree,
      'profile_picture'=>$profile_picture,
      'banner_picture'=>$banner_picture
      'is_online'=>$is_online
    ));
    if($res>0){
      $message = "Updated Successfully";
      $status = 200;
    }else{
      $message = "Update Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function changePassword(Request $request, $id){
    $password=$request->input('password');
    $hash_password=Hash::make($password);

    $res= User::where('id', $id)->update(array(
      'password'=> $hash_password
    ));
    if($res>0){
      $message = "Password Changed Successfully";
      $status = 200;
    }else{
      $message = "Password Change Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }


  // Route::get('/search','UserController@searchUser');

}
