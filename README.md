# Review plugin for OctoberCMS

Show reviews and ratings of your customers. No other plugin dependency.

## Show reviews

Just place component Reviews to your page. You can also use `reviews.reviews` to access component data. Example of page 
with customers reviews:

```
[reviews]
==
{% if reviews.reviews is not empty %}
<div class="reviews">
    <h3>{{ 'What our customers say about us?' | _ }}</h3>
    <div class="stories">
        {% component 'reviews' %}
    </div>
</div>
{% endif %}
```

## TODO

- [ ] create Rating form widget (and push it to October Core)
- [ ] avarage reviews graph (above the listing)
- [ ] graph of non approved reviews
- [ ] email when new review created and needs to be approved
- [ ] config for number of stars
