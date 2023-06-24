<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';

    protected $fillable = ['domain_name', 'id_user', 'id_group', 'type',  'created_at', 'updated_at'];
}
