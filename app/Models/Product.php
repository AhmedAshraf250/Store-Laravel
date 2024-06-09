<?php

namespace App\Models;

use App\Models\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'store_id',
        'price',
        'compare_price',
        'status',
    ];




    // GLOBAL SCOPE
    public static function booted()
    {
        // static::addGlobalScope('store', function (Builder $builder) {
        //     $user = Auth::user();
        //     if ($user->store_id) {
        //         $builder->where('store_id', '=', $user->store_id);
        //     }
        // });

        // > php artisan make:scope ProductScope
        static::addGlobalScope('store', new ProductScope());

    }





    // foreach($products as $product) {
    //     $product->category->name // OR // $product->category()->first()->name
    //     $product->store->name // OR // $product->store()->first()->name
    //
    //                   $product->category() => (return object form the relationship 'belongsTo')
    //                   $product->category => (return object form the model)
    // }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // related Model
            'product_tag',  // Pivot table name
            'product_id',   // FK in Pivot table for the Current Model
            'tag_id',       // FK in Pivot table for the Related Model
            'id',           // PK Current Model
            'id'            // PK Related Model
        );
        // In Laravel IF Making Names with Default Just short this Code In => [return $this->belongsToMany(Tag::class);] ||| Laravel will do the rest auto
    }
}
