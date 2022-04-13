<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    protected $fillable = [
        'is_active', 'featured', 'slug', 'sku', 'price', 'main_image', 'video', 'quantity',
        'special_price', 'start_date', 'end_date', 'added_by', 'brand_id', 'country_id'
    ];
    protected $translatedAttributes = ['name', 'summary', 'description'];
    protected $hidden = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    public function getActive()
    {
        return  $this->is_active  == 0 ?  trans('admin.not_active')   : trans('admin.active');
    }
    public function featured()
    {
        return  $this->featured  == 0 ?  trans('admin.not_featured')   : trans('admin.featured');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }
}
