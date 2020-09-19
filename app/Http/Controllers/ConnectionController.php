<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Connection;
use Illuminate\Support\Facades\Hash;

class ConnectionController extends Controller
{

  public function addConnection($id, $cid){
    $connection = new Connection();
    $connection->user_id=$id;
    $connection->connection_user_id=$cid;

    $res=$connection->save();
    if($res=true){
      $message= "Connection Sent Successfully";
      $status = 200;
    }else{
      $message= "Connection Request Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function getConnections($id){
    return response()->json(Connection::where('user_id', $id)->get(),200);
  }


  public function deleteConnection($id, $cid){
    $records = DB::delete("DELETE FROM connections WHERE user_id ='$id' AND connection_user_id ='$cid'");
    if($records>0){
      $message = "Connection Removed Successfully";
      $status = 200;
    }else{
      $message = "Connection Removal Failed";
      $status = 404;
    }

    return response()->json($message,$status);
  }




}
