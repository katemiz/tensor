<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $parentColumn = 'parent_id';

    protected $fillable = [
        'parent_id',
        'title_en',
        'title_tr',
        'desc_en',
        'desc_tr',
        'created_by',
        'updated_by'
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class,$this->parentColumn);
    }

    public function children()
    {
        return $this->hasMany(Category::class, $this->parentColumn);
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }



    public static function convertToTree(array $array)
    {
        $indexed = array();
        // first pass - get the array indexed by the primary id
        foreach ($array as $row) {
            $row["level"] = 0;
            $indexed[$row["id"]]             = $row;
            $indexed[$row["id"]]['children'] = array();
        }

        // second pass
        $root = array();
        foreach ($indexed as $id => $row) {

            $pid = $indexed[$id]['parent_id'];

            if ($pid == 0) {
                $indexed[$id]["level"] = 0;
            } else {
                $indexed[$id]["level"] = $indexed[$pid]["level"]+1;
            }

            $indexed[$row['parent_id']]['children'][] = &$indexed[$id];

            if (!$row['parent_id']) {
                $root[] = &$indexed[$id];
            }
        }
        return $root;
    }



    public static function getTreeData() {

        $records = Category::orderBy('parent_id')->orderBy('title_en')->get()->toArray();

        $items = array();

        foreach ($records as $row) {            
            $items[]  = Category::setUserTime($row);
        }

        return Category::convertToTree($items);
    }

    public static function getLatestItem() {
        return Category::setUserTime(Category::latest()->first());
    }



    public static function getItemById($id) {
        return Category::setUserTime(Category::find($id));
    }



    public static function setUserTime($item) {

        $item["created_by"] = User::select('name','lastname','email')->where('id', $item["created_by"])->first();
        $item["created_diff"] = Carbon::parse($item["created_at"])->diffForHumans();

        $item["updated_by"] = User::select('name','lastname','email')->where('id', $item["updated_by"])->first();
        $item["updated_diff"] = Carbon::parse($item["updated_at"])->diffForHumans();

        return $item;
    }



}
