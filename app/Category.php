<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

use Illuminate\Database\Eloquent\Model;

class Category extends Formable
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $table = 'categories';

    public $parent_key = 'parent_id';

    protected $fillable = ['id', 'title', 'subtitle', 'extras', 'content', 'slug', 'hlutur', 'parent_id', 'images', 'translations', 'order', 'status', 'files'];

    public function scopeNorsk($query)
    {
        return $query->where('parent_id', 2);
    }

    public function scopeIcelandic($query)
    {
        return $query->where('parent_id', 1);
    }

    public $translatable = [
        'title',
        'slug',
        'content',
    ];

    protected $modelName = 'Category';

    public function modelName() {
        return $this->modelName;
    }

    protected $pluralName = 'Flokkar';

    public function pluralName() {
        return $this->pluralName;
    }

    public function fields() {
        return $this->fields;
    }

    public function listables() {
        return $this->listables;
    }
    
    protected $fields = [
        [
            'title' => 'Titill',
            'type' => 'text',
            'name' => 'title'
        ],
        [
            'title' => 'Undirtitill',
            'type' => 'text',
            'name' => 'subtitle'
        ],
        [
            'title' => 'Slug',
            'type' => 'text',
            'name' => 'slug'
        ],
        [
            'title' => 'Efni',
            'type' => 'textarea',
            'name' => 'content',
            'args' => [
                'ckeditor' => true
            ],
        ],
    ];

    protected $listables = [
        'Titill' => 'title',
        'Slug' => 'slug',
    ];


    public function products()
    {
        return $this->hasMany(\App\Product::class);
    }


}