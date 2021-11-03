<?php namespace VojtaSvoboda\Reviews\Models;

use Backend\Models\ExportModel;


class CategoryExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        return self::make()
            ->get()
            ->toArray();
    }
}
