<?php

namespace App\Http\Controllers;

use App\Status;
use App\ProductCategory;

class CategoryController extends Controller
{
    public function listCategory()
    {
        $objCategory = new ProductCategory();
        $arrCategories = $objCategory->listCategory();
        
        return Status::mergeStatus(['data' => $arrCategories], 200);
    }
}
