<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{

  public function createPost(Request $request){
    $post = new Post();
    $post->user_id=$request->input('user_id');
    $post->text=$request->input('text');
    $post->is_comment_enabled=$request->input('is_comment_enabled');

    $res=$post->save();
    if($res=true){
      $message= "Post Created Successfully";
      $status = 200;
    }else{
      $message= "Post Creation Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function getPost($id){
    return response()->json(Post::where('id', $id)->get(),200);
  }

  public function deletePost($id){
    $records = DB::delete("DELETE FROM posts WHERE id ='$id'");
    if($records>0){
      $message = "Post Deleted Successfully";
      $status = 204;
    }else{
      $message = "Post Deletion Failed";
      $status = 404;
    }

    return response()->json($message,$status);
  }

  public function editPost(Request $request,$id){
    $user_id=$request->input('user_id');
    $text=$request->input('text');
    $is_comment_enabled=$request->input('is_comment_enabled');

    $res= Post::where('id', $id)->update(array(
      'user_id'=>$user_id,
      'text'=>$text,
      'is_comment_enabled'=>$is_comment_enabled
    ));
    if($res>0){
      $message = "Post Updated Successfully";
      $status = 200;
    }else{
      $message = "Post Updated Failed";
      $status = 404;
    }
    return response()->json($message,$status);
  }

  public function getUserPosts($id){
    return response()->json(Post::where('user_id', $id)->get(),200);
  }

  // Route::get('/group/{id}/post','PostController@getGroupPosts');

}
