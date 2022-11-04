<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'my_parents';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    public $translatable = ['father_name', 'father_job', 'mother_name', 'mother_job'];

}
