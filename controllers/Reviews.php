<?php namespace VojtaSvoboda\Reviews\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

/**
 * Reviews Back-end Controller
 */
class Reviews extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\ReorderController',
        'Backend\Behaviors\ImportExportController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('VojtaSvoboda.Reviews', 'reviews', 'reviews');
    }

    public function listOverrideColumnValue($record, $columnName, $definition = null)
    {
        if ($columnName == 'rating') {
            $starsCount = 5;
            $rating = intval($record->rating);

            return
                '<span style="display:inline-block;min-width:62px;">' .
                str_repeat('<i class="icon-star"></i>', $rating) .
                str_repeat('<i class="icon-star-o"></i>', $starsCount - $rating) .
                '</span>';
        }
    }
}
