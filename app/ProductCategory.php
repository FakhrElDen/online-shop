<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name', 'image'
    ];

    public function listCategory()
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $arrCategory = $this->all();
        foreach ($arrCategory as $image => $value) {
            $value['image'] = $App_URL_MEDIA . $value['image'];
        }
        $arrCategory = $arrCategory->toArray();
        return $arrCategory;
    }

    public function getCategoryName($category_id)
    {
        return $this->where('id', $category_id)->get('name');
    }

    public function getCategoryImage($category_id)
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $category_image = $this->where('id', $category_id)->first();
        $category_image =  $App_URL_MEDIA . $category_image->image;
        return $category_image;
    }
}
