<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

    public function products()
    {
        // Because I defined the default naming for the tables, so there is no need to define the rest of the columns and relationship details.
        return $this->belongsToMany(Product::class);
    }


}
