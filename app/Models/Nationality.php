<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'nationalities';
    public $timestamps = true;
    protected $fillable = ['name'] ;
    public $translatable = ['name'];

}
