<?php namespace VojtaSvoboda\Reviews\Facades;

use VojtaSvoboda\Reviews\Models\Review;

/**
 * Main plugin facade. You should call this methods a priority.
 *
 * @package VojtaSvoboda\Reviews\Facades
 */
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

    /**
     * Create new review.
     *
     * @param array $data
     *
     * @return array
     */
    public function storeReview(array $data)
    {
        return $this->reviews->create($data);
    }

    /**
     * Get approved reviews (for displaying at frontend).
     *
     * @return array
     */
    public function getApprovedReviews()
    {
        return $this->reviews->isApproved()->orderBy('sort_order')->get();
    }

    /**
     * Get non approved reviews (for admin approval).
     *
     * @return array
     */
    public function getNonApprovedReviews()
    {
        return $this->reviews->notApproved()->orderBy('sort_order')->get();
    }

    /**
     * Find one review.
     *
     * @param $value
     * @param string $key
     *
     * @return Review
     */
    public function findOne($value, $key = 'id')
    {
        return $this->reviews->where($key, $value)->first();
    }
}
