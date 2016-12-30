<?php namespace VojtaSvoboda\Reviews\Models;

use App;
use Carbon\Carbon;
use Config;
use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use Request;
use Str;

/**
 * Reviews class.
 *
 * @package VojtaSvoboda\Reviews\Models
 */
class Review extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /** @var string $table The database table used by the model */
    public $table = 'vojtasvoboda_reviews_reviews';

    /** @var array Rules */
    public $rules = [
        'name' => 'required|max:300',
        'email' => 'email',
        'rating' => 'numeric',
        'approved' => 'boolean',
        'content' => 'required|min:6|max:3000',
    ];

    public $translatable = ['name', 'title', 'content'];

    public $fillable = [
        'email', 'name', 'title', 'rating', 'content', 'approved',
    ];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $belongsToMany = [
        'categories' => [
            'VojtaSvoboda\Reviews\Models\Category',
            'table' => 'vojtasvoboda_reviews_review_category',
            'order' => 'name asc',
            'scope' => 'isEnabled',
            'timestamps' => true,
        ]
    ];

    /**
     * Before create review.
     */
    public function beforeCreate()
    {
        $this->hash = $this->getUniqueHash();
        $this->locale = App::getLocale();

        $this->ip = Request::server('REMOTE_ADDR');
        $this->ip_forwarded = Request::server('HTTP_X_FORWARDED_FOR');
        $this->user_agent = Request::server('HTTP_USER_AGENT');
    }

    /**
     * Scope for getting approved reviews.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeIsApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * Scope for getting non approved reviews.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeNotApproved($query)
    {
        return $query->where('approved', false);
    }

    /**
     * Set machine scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeMachine($query)
    {
        $ip = Request::server('REMOTE_ADDR');
        $ip_forwarded = Request::server('HTTP_X_FORWARDED_FOR');
        $user_agent = Request::server('HTTP_USER_AGENT');

        return $query->whereIp($ip)->whereIpForwarded($ip_forwarded)->whereUserAgent($user_agent);
    }

    /**
     * If some message exists in last 30 seconds.
     *
     * @return bool
     */
    public function isExistInLastTime()
    {
        // protection time
        $time = Config::get('vojtasvoboda.reviews::config.protection_time', '-30 seconds');
        $timeLimit = Carbon::parse($time)->toDateTimeString();

        // try to find some message
        $item = self::machine()->where('created_at', '>', $timeLimit)->first();

        return $item !== null;
    }

    /**
     * Generate unique hash for each review.
     *
     * @return string|null
     */
    public function getUniqueHash()
    {
        $length = Config::get('vojtasvoboda.reviews::config.hash', 32);
        if ($length == 0) {
            return null;
        }

        return substr(md5('reviews-' . Str::random($length)), 0, $length);
    }
}
