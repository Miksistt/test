<?php

namespace App\Models;

class Article
{
    protected array $articles;

    public function __construct(int $id, string $title, string $content, string $slug, string $description, string $date)
    {

        /*
        $this->articles = [
            ['id'=>'id1','title'=>'title1', 'slug'=>'slug1', 'content'=>'content1', 'description'=>'description1', 'data'=>'data1'],
            ['id'=>'id2','title'=>'title2', 'slug'=>'slug2', 'content'=>'content2', 'description'=>'description1', 'data'=>'data1'],
            ['id'=>'id3','title'=>'title3', 'slug'=>'slug3', 'content'=>'content3', 'description'=>'description1', 'data'=>'data1'],
            ['id'=>'id4','title'=>'title4', 'slug'=>'slug4', 'content'=>'content4', 'description'=>'description1', 'data'=>'data1'],
            ['id'=>'id5','title'=>'title5', 'slug'=>'slug5', 'content'=>'content5', 'description'=>'description1', 'data'=>'data1'],
            ['id'=>'id6','title'=>'title6', 'slug'=>'slug6', 'content'=>'content6', 'description'=>'description1', 'data'=>'data1'],
            ['id'=>'id7','title'=>'title7', 'slug'=>'slug7', 'content'=>'content7', 'description'=>'description1', 'data'=>'data1'],
            ];*/
    }

    public function all()
    {
        return $this->articles;
    }
}