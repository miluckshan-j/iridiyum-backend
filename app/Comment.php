<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comments';

  protected $fillable = [
      'post_id', 'connection_user_id', 'comment'
  ];

}
