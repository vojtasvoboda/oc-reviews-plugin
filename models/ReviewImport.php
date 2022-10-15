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
        'rating' => 'required|numeric'
    ];

    public $categoryNameCache = [];

    public $categoryIdCache = [];

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

                $except = ['id', 'category_names', 'category_ids','approved', 'created_at'];

                foreach (array_except($data, $except) as $attribute => $value) {
                    $review->{$attribute} = $value ?: null;
                }

                $review->approved = !!array_get($data, 'approved');

                if ($createdAt = array_get($data, 'created_at')) {
                    $review->created_at = Carbon::parse($createdAt);
                }

                $review->save();

                if (array_get($data, 'category_ids')) {
                    if ($categoryIds = $this->getCategoryIdsForReviewUsingIds($data)) {
                        $review->categories()->sync($categoryIds, false);
                    }
                }

                if (array_get($data, 'category_names') && !array_get($data, 'category_ids')) {
                    if ($categoryIds = $this->getCategoryIdsForReviewUsingNames($data)) {
                        $review->categories()->sync($categoryIds, false);
                    }
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

    protected function getCategoryIdsForReviewUsingIds($data)
    {
        $categoryIds = $this->decodeArrayValue(array_get($data, 'category_ids'));

        $ids = [];

        foreach ($categoryIds as $id) {
            if (!$id = trim($id)) {
                continue;
            }

            if (isset($this->categoryIdCache[$id])) {
                $ids[] = $this->categoryIdCache[$id];
            } else {
                $category = CategoryModel::find($id);
                if($category) {
                    $ids[] = $this->categoryIdCache[$id] = $category->id;
                }
            }
        }

        return $ids;
    }

    protected function getCategoryIdsForReviewUsingNames($data)
    {
        $categoryNames = $this->decodeArrayValue(array_get($data, 'category_names'));

        $ids = [];

        foreach ($categoryNames as $name) {
            if (!$name = trim($name)) {
                continue;
            }

            if (isset($this->categoryNameCache[$name])) {
                $ids[] = $this->categoryNameCache[$name];
            } else {
                $category = CategoryModel::where('name', $name)->first();
                if($category) {
                    $ids[] = $this->categoryNameCache[$name] = $category->id;
                }
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
