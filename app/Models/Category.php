<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $fillable =[
        
    ];
    public function GetAll(){
        $categories = DB::select('select * from category');
        return $categories;
    }
    
}
