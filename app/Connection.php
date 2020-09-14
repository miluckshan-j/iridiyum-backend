<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
  protected $table = 'connections';

  protected $fillable = [
      'user_id', 'connection_user_id'
  ];

}
