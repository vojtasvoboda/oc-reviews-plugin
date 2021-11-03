<?php namespace VojtaSvoboda\Reviews\Models;

use Backend\Models\ExportModel;


class CategoryExport extends ExportModel
{
    public $table = 'vojtasvoboda_reviews_categories';

    public function exportData($columns, $sessionKey = null)
    {
        return self::make()
            ->get()
            ->toArray();
    }
}
