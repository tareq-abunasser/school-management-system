<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'status',
        'grade_id',
        "stage_id"
    ];
    public $translatable = [
        'name'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

}
