<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title_en',
        'title_tr',
        'desc_en',
        'desc_tr',
        'desc_en_text',
        'desc_tr_text',
        'created_by',
        'updated_by'
    ];

    public static function processItem($row) {

        $row["category"] = Category::getItemById($row["category"]);

        $row["created_by"] = User::select('id','name','lastname','email')->where('id', $row["created_by"])->first();
        $row["created_diff"] = Carbon::parse($row["created_at"])->diffForHumans();

        $row["updated_by"] = User::select('id','name','lastname','email')->where('id', $row["updated_by"])->first();
        $row["updated_diff"] = Carbon::parse($row["updated_at"])->diffForHumans();

        return $row;
    }


    public static function getItemById($id) {
        return Role::processItem(Role::find($id));
    }


    public static function getLatestItem() {
        return Role::processItem(Role::latest()->first());
    }

}
