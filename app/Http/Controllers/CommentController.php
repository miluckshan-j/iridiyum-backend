<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
  public function addComment(Request $request, $id){
    $comment = new Comment();
    $comment->post_id=$id;
    $comment->user_id=$request->input('user_id');
    $comment->text=$request->input('text');

    $res=$comment->save();
    if($res=true){
      $message= "Comment Added Successfully";
      $status = 200;
    }else{
      $message= "Comment Sent Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function editComment(Request $request,$id,$cid){
    $comment=$request->input('comment');

    $res= Comment::where('post_id', $id)->update(array(
      'post_id'=>$id,
      'connection_user_id'=>$cid,
      'comment'=>$comment
    ));
    if($res>0){
      $message = "Comment Updated Successfully";
      $status = 200;
    }else{
      $message = "Comment Updated Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function deleteComment($id,$cid){
    $records = DB::delete("DELETE FROM comments WHERE post_id ='$id' AND id = '$cid'");
    if($records>0){
      $message = "Comment Deleted Successfully";
      $status = 204;
    }else{
      $message = "Comment Deletion Failed";
      $status = 404;
    }

    return response()->json($message,$status);
  }

  public function getCommentsForPost($id){
    return response()->json(Comment::where('post_id', $id)->get(),200);
  }

}
