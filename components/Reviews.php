<?php namespace VojtaSvoboda\Reviews\Components;

use App;
use Cms\Classes\ComponentBase;
use VojtaSvoboda\Reviews\Facades\ReviewsFacade;
use VojtaSvoboda\Reviews\Models\Category;

class Reviews extends ComponentBase
{
    private $reviews;

    public function componentDetails()
    {
        return [
            'name' => 'Reviews',
            'description' => 'Show reviews on your page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'categoryFilter' => [
                'title' => 'Category identifier',
                'description' => 'Show only reviews from some category by slug',
                'type' => 'string',
                'default' => '{{ :category }}',
            ],
        ];
    }

    public function onRun()
    {
        // category filter
        $category = null;
        if ($categorySlug = $this->property('categoryFilter')) {
            $category = $this->getCategory($categorySlug);
        }
        $this->page['category'] = $category;
        $this->page['reviews'] = $this->reviews($category);
    }

    /**
     * Get reviews.
     *
     * @param Category $category Filter by category.
     *
     * @return mixed
     */
    public function reviews($category = null)
    {
        if ($this->reviews === null) {
            $this->reviews = $this->getFacade()->getApprovedReviews($category);
        }

        return $this->reviews;
    }

    /**
     * Get category by slug.
     *
     * @param $category
     *
     * @return mixed
     */
    public function getCategory($category)
    {
        return Category::where('slug', $category)->first();
    }

    /**
     * Get Facade.
     *
     * @return ReviewsFacade
     */
    private function getFacade()
    {
        return App::make('vojtasvoboda.reviews.facade');
    }
}
