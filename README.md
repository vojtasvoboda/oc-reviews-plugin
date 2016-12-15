# Review plugin for OctoberCMS

Show reviews, ratings or testimonials of your customers. No other plugin dependency. Tested with latest OctoberCMS build 389.

- reviews management with **sort order** and **bulk actions**
- **rating by stars**
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
