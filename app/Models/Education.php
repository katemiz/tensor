<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Education extends Model
{
    use HasFactory;

    protected $parentColumn = 'parent_id';

    protected $fillable = [
        'title',
        'remarks',
        'remarks_text'
    ];

    public function parent()
    {
        return $this->belongsTo(Education::class,$this->parentColumn);
    }

    public function children()
    {
        return $this->hasMany(Education::class, $this->parentColumn);
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }



    public static function getItemById($id) {
        return Education::processItem(Education::find($id));
    }


    public static function getLatestItem() {
        return Education::processItem(Education::latest()->first());
    }


    public static function processItem($item) {

        $item["created_by"] = User::select('name','lastname','email')->where('id', $item["created_by"])->first();
        $item["created_diff"] = Carbon::parse($item["created_at"])->diffForHumans();

        $item["updated_by"] = User::select('name','lastname','email')->where('id', $item["updated_by"])->first();
        $item["updated_diff"] = Carbon::parse($item["updated_at"])->diffForHumans();

        return $item;
    }




}



