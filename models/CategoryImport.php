<?php namespace VojtaSvoboda\Reviews\Models;


use Backend\Models\ImportModel;
use VojtaSvoboda\Reviews\Models\Category as CategoryModel;

class CategoryImport extends ImportModel
{
    public $table = 'vojtasvoboda_reviews_categories';

    public $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    public function importData($results, $sessionKey = null)
    {
        /*
         * Import
         */
        foreach ($results as $row => $data) {
            try {

                if (!array_get($data, 'name')) {
                    $this->logSkipped($row, 'Missing category name');
                    continue;
                }

                $category = CategoryModel::make();

                if ($this->update_existing) {
                    $category = $this->findDuplicate($data) ?: $category;
                }

                $categoryExists = $category->exists;

                /*
                 * Set attributes
                 */

                $except = [
                    'id',
                    'enabled'
                ];

                foreach (array_except($data, $except) as $attribute => $value) {
                    $category->{$attribute} = $value ?: null;
                }

                $category->enabled = !!array_get($data,'enabled');

                $category->save();

                if ($categoryExists) {
                    $this->logUpdated();
                } else {
                    $this->logCreated();
                }
            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    protected function findDuplicate($data)
    {
        if ($id = array_get($data, 'id')) {
            return CategoryModel::find($id);
        }

        return null;
    }
}
