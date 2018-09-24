<?php namespace VojtaSvoboda\Reviews;

use Backend;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{
    public function boot()
    {
        $this->app->bind('vojtasvoboda.reviews.facade', 'VojtaSvoboda\Reviews\Facades\ReviewsFacade');
    }

    public function registerNavigation()
    {
        return [
            'reviews' => [
                'label' => 'Reviews',
                'url' => Backend::url('vojtasvoboda/reviews/reviews'),
                'icon' => 'icon-star-half-o',
                'permissions' => ['vojtasvoboda.reviews.*'],
                'order' => 510,
                'sideMenu' => [
                    'reviews' => [
                        'label' => 'Reviews',
                        'url' => Backend::url('vojtasvoboda/reviews/reviews'),
                        'icon' => 'icon-star-half-o',
                        'permissions' => ['vojtasvoboda.reviews.reviews'],
                        'order' => 100,
                    ],
                    'categories' => [
                        'permissions' => ['vojtasvoboda.reviews.categories'],
                        'label' => 'Categories',
                        'icon' => 'icon-folder',
                        'url' => Backend::url('vojtasvoboda/reviews/categories'),
                        'order' => 200,
                    ],
                ],
            ],
        ];
    }

    public function registerSettings() {
        return [
            'config' => [
                'label'       => 'Reviews',
                'description' => 'Add customers reviews and testimonials to your sites.',
                'category'    => SettingsManager::CATEGORY_CMS,
                // 'icon'        => 'icon-bolt',
                'class'       => 'VojtaSvoboda\Reviews\Models\Settings',
                'permissions' => ['vojtasvoboda.reviews.settings'],
                'order'       => 500
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'vojtasvoboda.reviews.settings' => [
                'tab'   => 'vojtasvoboda.reviews::lang.menu.reviews',
                'label' => 'vojtasvoboda.reviews::lang.permission.reviews',
                'order' => 100,
                'roles' => ['publisher']
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'VojtaSvoboda\Reviews\Components\Reviews' => 'reviews',
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'VojtaSvoboda\Reviews\FormWidgets\StarRating' => 'starrating',
        ];
    }
}
