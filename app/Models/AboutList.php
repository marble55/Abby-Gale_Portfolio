<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsMultiSource;
use Orchid\Screen\AsSource;

class AboutList extends Model
{
    use HasFactory;
    use AsSource;
    

    protected $fillable = [
        'category',
        'title',
        'description',
        'icon',
        'image_path',
    ];

    public $timestamps = false;
}
