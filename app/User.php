<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';

  protected $fillable = [
      'name', 'username', 'email', 'password', 'bio', 'date_of_birth', 'gender', 'university', 'degree', 'profile_picture', 'banner_picture', 'is_online'
  ];

}
