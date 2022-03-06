<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Profession extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'remarks',
        'remarks_text'
    ];

    public static function setUserTime($row) {

        $row["created_by"] = User::select('name','lastname','email')->where('id', $row["created_by"])->first();
        $row["created_diff"] = Carbon::parse($row["created_at"])->diffForHumans();

        $row["updated_by"] = User::select('name','lastname','email')->where('id', $row["updated_by"])->first();
        $row["updated_diff"] = Carbon::parse($row["updated_at"])->diffForHumans();

        return $row;
    }


    public static function getItemById($id) {
        return Profession::setUserTime(Profession::find($id));
    }


    public static function getLatestItem() {
        return Profession::setUserTime(Profession::latest()->first());
    }
}
