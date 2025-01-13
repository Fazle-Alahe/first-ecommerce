<?php

namespace App\Helpers;

use App\Models\OrderProducts;
use App\Models\Product;

class Main{
    public static function ProductShow($product_quantity)
    {
        $products = Product::latest()->take($product_quantity)->get();
        return $products;
    }

    public static function topReview(){
        $productRatings = [];

        $products = Product::all();
        foreach($products as $product){
            $total_reviews = OrderProducts::where('product_id', $product->id)->whereNotNull('review')->count();
            $total_stars = OrderProducts::where('product_id', $product->id)->whereNotNull('review')->sum('star');
            
            $avg = '';
            if($total_reviews == 0){
                $avg = 0;
            }
            else{
                $avg = round($total_stars/$total_reviews);
            }

            $productRatings[] = [
                'product_id' => $product->id,
                'average_rating' => $avg,
            ];
        }
        return $productRatings;
        // print_r($productRatings);
    }
}

?>