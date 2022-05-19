<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'sub_category_name',
        'status'
    ];
    public static function GetAll(){
        $result = DB::table('sub_category')->get();
        return $result;
    }
}
