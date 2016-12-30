# Review plugin for OctoberCMS

[![Build Status](https://scrutinizer-ci.com/g/vojtasvoboda/oc-reviews-plugin/badges/build.png?b=master)](https://scrutinizer-ci.com/g/vojtasvoboda/oc-reviews-plugin/build-status/master)
[![Codacy](https://img.shields.io/codacy/60a4250bf80740808d007c3338e3f745.svg)](https://www.codacy.com/app/vojtasvoboda/oc-reservations-plugin)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/vojtasvoboda/oc-reviews-plugin/blob/master/LICENSE)

Show reviews, ratings or testimonials of your customers. No other plugin dependency. Tested with latest OctoberCMS build 389.

- reviews management with **sort order** and **bulk actions**
- **rating by stars**, sorting to **categories**
- component build with **HTML5 markup** using \<figure\> and \<cite\>
- internal methods for creating new reviews, get approved reviews etc.

## Show reviews

Just place component Reviews to your page. You can also use `reviews.reviews` to access component data.

```
[reviews]
==
{% if reviews.reviews is not empty %}
<div class="reviews">
    <h3>What our customers say about us?</h3>
    <div class="stories">
        {% component 'reviews' %}
    </div>
</div>
{% endif %}
```

## Public facade

You can use plugin's facade **vojtasvoboda.reviews.facade** with this public methods:

```
$facade = App::make('vojtasvoboda.reviews.facade');
$facade->storeReview(array $data);
$facade->getApprovedReviews();
$facede->getNonApprovedReviews();
$facade->findOne($value, $key);
```

## TODO

- [ ] frontend form for adding new review
- [ ] config for stars order (ltr, rtl)
- [ ] config for number of stars
- [ ] avarage reviews graph (above the reviews listing)
- [ ] graph of non approved reviews
- [ ] email when new review created and needs to be approved

## Contributing

Please send Pull Request to the master branch.

## License

Reviews plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) same as OctoberCMS platform.
