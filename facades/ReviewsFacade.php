<?php namespace VojtaSvoboda\Reviews\Facades;

class ReviewsFacade
{
    /** @var Reviews $reviews */
    private $reviews;

    /**
     * ReviewsFacade constructor.
     *
     * @param Reviews $reviews
     */
    public function __construct(Reviews $reviews)
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
        return $this->reviews->approved()->get();
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
