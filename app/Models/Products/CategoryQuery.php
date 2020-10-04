<?php

namespace App\Models\Products;

use App\Models\Products\Category;

class CategoryQuery
{
    public function getCategoryPluck()
    {
        return Category::where('is_active',1)->whereNotNull('parent_id')->pluck('name','id');
    }
    public function getCategory()
    {
        return Category::where('is_active',1)->whereNotNull('parent_id')->get();
    }

}
