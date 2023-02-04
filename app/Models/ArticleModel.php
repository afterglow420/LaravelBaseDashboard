<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'id_article';

    protected $fillable = [
        'article_title',
        'article_text',
        'article_photo',        
    ];

    public $timestamps = false;
}
