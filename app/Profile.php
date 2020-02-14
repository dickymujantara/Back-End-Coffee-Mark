<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'id_user','no_hp','address','tgl_lahir','jenis_kelamin','img_path'
    ];
}
