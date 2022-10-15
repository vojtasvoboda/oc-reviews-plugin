<?php namespace VojtaSvoboda\Reviews\Models;

use Backend\Models\ExportModel;

class ReviewExport extends ExportModel
{

    public $table = 'vojtasvoboda_reviews_reviews';

    protected $appends = [
        'category_names',
        'category_ids',
    ];

    public $belongsToMany = [
        'review_categories' => [
            'VojtaSvoboda\Reviews\Models\Category',
            'table' => 'vojtasvoboda_reviews_review_category',
            'key' => 'review_id',
            'otherKey' => 'category_id'
        ]
    ];

    public function exportData($columns, $sessionKey = null)
    {
        $result = self::make()
            ->with([
                'review_categories',
            ])
            ->get()
            ->toArray();

        return $result;
    }

    public function getCategoryNamesAttribute()
    {
        if (!$this->review_categories) {
            return '';
        }

        return $this->encodeArrayValue($this->review_categories->lists('name'));
    }

    public function getCategoryIdsAttribute()
    {
        if (!$this->review_categories) {
            return '';
        }

        return $this->encodeArrayValue($this->review_categories->lists('id'));
    }
}
