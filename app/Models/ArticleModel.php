<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'article';
    protected $useTimestamps = true;

    protected $allowedFields = ['article_creator', 'article_title', 'article_image', 'article_content'];
}
