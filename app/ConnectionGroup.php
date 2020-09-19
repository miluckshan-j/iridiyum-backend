<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectionGroup extends Model
{
  protected $table = 'connection_groups';

  protected $fillable = [
      'group_id', 'connection_user_id'
  ];
}
