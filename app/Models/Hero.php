<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Hero extends Model
{
    use HasFactory, AsSource, Attachable;
    protected $fillable = [
        'name', 'subtitle','description', 'cv_path',
        'email', 'picture_path', 'telephone'
    ];


    // Many-to-Many (no foreign id on table, should be uploaded with groups() function)
    public function documents()
    {
        return $this->hasMany(Attachment::class)->where('group','documents');
    }

}
