<?php namespace VojtaSvoboda\Reviews\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeletingTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Category extends Model
{
    use SoftDeletingTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'vojtasvoboda_reviews_categories';

    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|unique:vojtasvoboda_reviews_categories',
        'enabled' => 'boolean',
        'description' => 'max:10000',
    ];

    public $translatable = ['name', 'slug', 'description'];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attachOne = [
        'image' => ['System\Models\File'],
    ];

    public $belongsToMany = [
        'reviews' => ['VojtaSvoboda\Reviews\Models\Review',
            'table' => 'vojtasvoboda_reviews_review_category',
            'order' => 'name desc',
            'scope' => 'isEnabled',
            'timestamps' => true,
        ],
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
