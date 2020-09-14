<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Group;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{

  public function createGroup(Request $request){
    $group = new Group();
    $group->user_id=$request->input('user_id');
    $group->connection_user_id=$request->input('connection_user_id');
    $group->name=$request->input('name');

    $res=$group->save();
    if($res=true){
      $message= "Group Created Successfully";
      $status = 200;
    }else{
      $message= "Group Creation Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function editGroup(Request $request,$id){
    $name=$request->input('name');

    $res= User::where('id', $id)->update(array(
      'name'=>$name
    ));
    if($res>0){
      $message = "Group Updated Successfully";
      $status = 200;
    }else{
      $message = "Group Update Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

    public function deleteGroup($id){
      $records = DB::delete("DELETE FROM groups WHERE id ='$id'");
      if($records>0){
        $message = "Group Deleted Successfully";
        $status = 204;
      }else{
        $message = "Group Deletion Failed";
        $status = 404;
      }

      return response()->json($message,$status);
    }

    // Route::post('/group/{id}/connection/{cid}','GroupController@addConnectionToGroup');
    
    // Route::delete('/user/{id}/connection/{cid}','ConnectionController@deleteConnectionFromGroup');
    // Route::get('/user/{id}/connection','ConnectionController@getConnectionInGroup');
}
