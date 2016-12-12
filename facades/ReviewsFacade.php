<?php namespace VojtaSvoboda\Reviews\Facades;

use VojtaSvoboda\Reviews\Models\Review;

class ReviewsFacade
{
    /** @var Review $reviews */
    private $reviews;

    /**
     * ReviewsFacade constructor.
     *
     * @param Review $reviews
     */
    public function __construct(Review $reviews)
    {
        $this->reviews = $reviews;
    }

    public function storeReview(array $data)
    {
        // TODO
    }

    /**
     * Get approved reviews (for displaying at frontend).
     *
     * @return mixed
     */
    public function getApprovedReviews()
    {
        return $this->reviews->isApproved()->get();
    }

    /**
     * Get non approved reviews (for admin approval).
     *
     * @return mixed
     */
    public function getNonApprovedReviews()
    {
        return $this->reviews->notApproved()->get();
    }
}
