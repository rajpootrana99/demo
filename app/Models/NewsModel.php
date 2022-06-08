<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $allowedFields = ['title', 'slug', 'body'];

    public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function news_insert($data){
        $db = \Config\Database::connect();
        $builder = $db->table('news');
        $builder->insert($data);
    }

    public function news_delete($id){
        return $this->delete($id);
    }

    public function news_update($id, $data){
        return $this->update($id, $data);
    }
}