<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'name',
        'price',
        'quantity',
        'fake_quantity',
        'images',
        'long_desc',
        'short_desc',
        'is_feature'
    ];

    public function listProductAttachtoCategory($category_id)
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $arrProduct = $this->where('product_category_id', $category_id)->paginate(3);
        foreach ($arrProduct as $images => $value) {
            $value['images'] = $App_URL_MEDIA . $value['images'];
        }
        return $arrProduct;
    }

    public function relatedProduct($category_id)
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $arrProduct = $this->where('product_category_id', $category_id)->get();
        foreach ($arrProduct as $images => $value) {
            $value['images'] = $App_URL_MEDIA . $value['images'];
        }
        return $arrProduct;
    }

    public function productDetails($product_id)
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $product = $this->where('id', $product_id)->get();
        foreach ($product as $images => $value) {
            $value['images'] = $App_URL_MEDIA . $value['images'];
        }
        return $product;
    }

    public function listFeatureProduct()
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $arrProduct = $this->where('is_feature', 1)->get();
        foreach ($arrProduct as $images => $value) {
            $value['images'] = $App_URL_MEDIA . $value['images'];
        }
        return $arrProduct;
    }

    public function updateProductQuantity($arrProduct)
    {
        foreach ($arrProduct as $key) {
            $productQuantity = $this->select('quantity')->where('id', $key['product_id'])->get('quantity');
            $newQuantity = $productQuantity - $key['quantity'];
            $updatedQuantity = $this->where('id', $key['product_id'])->update(array('quantity' => $newQuantity));
            return $updatedQuantity;
        }
    }

    public function getProductName($product_id)
    {
        return $this->where('id', $product_id)->get('name');
    }

    public function checkProductQuantity($arrProduct)
    {
        foreach ($arrProduct as $key) {
            $product = $this->select('quantity')->where('id', $key['id'])->first();
            return $product;
        }
    }

    public function getProducts()
    {
        return $this->all();
    }
}
