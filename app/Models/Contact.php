<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'message',
        'image',
        'user_id',
    ];

    public function user(){
      return  $this->belongsTo('App\Models\User','user_id');
    }
}
