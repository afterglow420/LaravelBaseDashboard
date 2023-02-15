<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MediaModel extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'media_model';
    protected $primaryKey = 'id_media';
    protected $guarded = [];

    public $timestamps = false;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('mediaImages')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }
}
