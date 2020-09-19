<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Group;
use App\ConnectionGroup;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{

  public function createGroup(Request $request){
    $group = new Group();
    $group->user_id=$request->input('user_id');
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

    $res= Group::where('id', $id)->update(array(
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
        $status = 200;
      }else{
        $message = "Group Deletion Failed";
        $status = 404;
      }

      return response()->json($message,$status);
    }

    // Route::post('/group/{id}/connection/{cid}','GroupController@addConnectionToGroup');
    public function addConnectionToGroup($id, $cid){
      $connectiongroup = new ConnectionGroup();
      $connectiongroup->group_id=$id;
      $connectiongroup->connection_user_id=$cid;

      $res=$connectiongroup->save();
      if($res=true){
        $message= "Connection Added to Group Successfully";
        $status = 200;
      }else{
        $message= "Connection Adding to Group Failed";
        $status = 404;
      }
      return response()->json($message,$status);
    }

    // Route::delete('/group/{id}/connection/{cid}','ConnectionController@deleteConnectionFromGroup');
    public function deleteConnectionFromGroup($id, $cid){
      $records = DB::delete("DELETE FROM connection_groups WHERE group_id ='$id' AND connection_user_id ='$cid'");
      if($records>0){
        $message = "Connection Removed from Group Successfully";
        $status = 200;
      }else{
        $message = "Connection Removal from Group Failed";
        $status = 404;
      }

      return response()->json($message,$status);
    }
    
    // Route::get('/group/{id}/connection','ConnectionController@getConnectionInGroup');
    public function getConnectionInGroup($id){
      $res = DB::table('users')
      ->join('connection_groups', 'users.id', '=', 'connection_groups.connection_user_id')
      ->select('users.id', 'users.username')
      ->where('connection_groups.group_id', $id)
      ->get();

      return response()->json($res,200);
    }




}
