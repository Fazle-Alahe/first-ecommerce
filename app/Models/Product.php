<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    
    function rel_to_category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // function rel_to_order_products(){
    //     return $this->belongsTo(OrderProducts::class, 'id');
    // }


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
        
        // return array_slice($asscen, 0, 3);
}
}
