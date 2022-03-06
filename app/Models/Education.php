<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}



