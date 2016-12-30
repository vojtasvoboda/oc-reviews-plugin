<?php namespace VojtaSvoboda\Reviews\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\ReorderController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'vojtasvoboda.reviews.categories',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('VojtaSvoboda.Reviews', 'reviews', 'categories');
    }
}
