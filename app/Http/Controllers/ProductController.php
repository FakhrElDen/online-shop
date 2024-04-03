<?php

namespace App\Http\Controllers;

use App\Status;
use App\Product;
use App\ProductCategory;

class ProductController extends Controller
{
    public function listProductAttachedToCategory($category_id)
    {
        $products = Product::listProductAttachToCategory($category_id);
        $category = ProductCategory::find($category_id);

        return Status::mergeStatus([
            'categoryName' => $category->name,
            'categoryImage' => $category->image,
            'data' => $products,
        ], 200);
    }

    public function productDetails($product_id)
    {
        $product = Product::find($product_id);
        $relatedProducts = Product::relatedProduct($product->product_category_id);

        return Status::mergeStatus([
            'data' => [
                'product_details' => $product,
                'related_product' => $relatedProducts,
            ],
        ], 200);
    }

    public function listFeatureProduct()
    {
        $featuredProducts = Product::listFeatureProduct();

        return Status::mergeStatus(['data' => $featuredProducts], 200);
    }

    public function getProducts()
    {
        $products = Product::getProducts();

        return Status::mergeStatus(['data' => $products], 200);
    }
}
