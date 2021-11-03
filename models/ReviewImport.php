<?php namespace VojtaSvoboda\Reviews\Models;


use Backend\Models\ImportModel;
use Carbon\Carbon;
use VojtaSvoboda\Reviews\Models\Category as CategoryModel;
use VojtaSvoboda\Reviews\Models\Review as ReviewModel;

class ReviewImport extends ImportModel
{
    public $table = 'vojtasvoboda_reviews_reviews';

    public $rules = [
        'name' => 'required',
        'content' => 'required',
        'rating' => 'required'
    ];

    public $categoryNameCache = [];


    public function importData($results, $sessionKey = null)
    {
        /*
         * Import
         */
        foreach ($results as $row => $data) {
            try {

                if (!array_get($data, 'name')) {
                    $this->logSkipped($row, 'Missing name');
                    continue;
                }

                $review = ReviewModel::make();

                if ($this->update_existing) {
                    $review = $this->findDuplicate($data) ?: $review;
                }

                $reviewExists = $review->exists;

                $except = ['id', 'categories','approved','created_at'];

                foreach (array_except($data, $except) as $attribute => $value) {

                    if (in_array($attribute, $review->getDates()) && empty($value)) {
                        continue;
                    }

                    $review->{$attribute} = $value ?: null;
                }

                $review->approved = !!array_get($data,'approved');

                if ($createdAt = array_get($data, 'created_at')) {
                    $review->created_at = Carbon::parse($createdAt);
                }

                $review->forceSave();

                if ($categoryIds = $this->getCategoryIdsForReview($data)) {
                    $review->categories()->sync($categoryIds, false);
                }

                if ($reviewExists) {
                    $this->logUpdated();
                } else {
                    $this->logCreated();
                }
            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    protected function getCategoryIdsForReview($data)
    {
        $categoryNames = $this->decodeArrayValue(array_get($data, 'categories'));

        $ids = [];

        foreach ($categoryNames as $name) {
            if (!$name = trim($name)) {
                continue;
            }

            if (isset($this->categoryNameCache[$name])) {
                $ids[] = $this->categoryNameCache[$name];
            } else {
                $category = CategoryModel::where('name', $name)->first();
                $ids[] = $this->categoryNameCache[$name] = $category->id;
            }
        }

        return $ids;
    }

    protected function findDuplicate($data)
    {
        if ($id = array_get($data, 'id')) {
            return ReviewModel::find($id);
        }

        return null;
    }
}
