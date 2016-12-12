<?php namespace VojtaSvoboda\Reviews\Components;

use App;
use Cms\Classes\ComponentBase;
use VojtaSvoboda\Reviews\Facades\ReviewsFacade;

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
        return [];
    }

    public function onRun()
    {
        $this->page['reviews'] = $this->reviews();
    }

    /**
     * Get reviews.
     *
     * @return mixed
     */
    public function reviews()
    {
        if ($this->reviews === null) {
            $this->reviews = $this->getFacade()->getApprovedReviews();
        }

        return $this->reviews;
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
