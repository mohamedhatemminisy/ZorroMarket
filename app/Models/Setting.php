<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translatedAttributes = ['website_title', 'meta_title', 'meta_description', 'meta_keywords', 'address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['logo', 'facebook', 'twitter', 'instagram', 'email', 'phone', 'whatsapp'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
