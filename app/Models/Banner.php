<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['is_active', 'type', 'image'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getActive()
    {
        return  $this->is_active  == 0 ?  trans('admin.not_active')   : trans('admin.active');
    }
}
