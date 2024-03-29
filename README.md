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

Just place component Reviews to your page.

```
[reviews]
==
{% if reviews is not empty %}
<div class="reviews">
    <h3>What our customers say about us?</h3>
    <div class="stories">
        {% component 'reviews' %}
    </div>
</div>
{% endif %}
```

## Dependencies

This plugin using [https://fontawesome.com/](https://fontawesome.com/) classes to show stars at Reviews front-end component. You have to include this library or [override Reviews component](https://octobercms.com/docs/cms/components#overriding-partials) to use your own icons.

## Public facade

You can use plugin's facade **vojtasvoboda.reviews.facade** with this public methods:

```
$facade = App::make('vojtasvoboda.reviews.facade');
$facade->storeReview(array $data);
$facade->getApprovedReviews();
$facede->getNonApprovedReviews();
$facade->findOne($value, $key);
```

When using `storeReview`, check [Review validation rules](https://github.com/vojtasvoboda/oc-reviews-plugin/blob/master/models/Review.php#L32) has to be satisfied.

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
