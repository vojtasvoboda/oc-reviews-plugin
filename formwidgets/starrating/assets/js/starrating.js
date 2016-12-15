$(document).ready(function() {

    $(".rateyo").each(function() {

        var rating = 0;
        if (typeof $(this).data("input-id") !== "undefined") {
            rating = 0 + $("#" + $(this).data("input-id")).val();
        }

        $(this).rateYo({
            rating: rating,
            numStars: 5,
            minValue: 1,
            maxValue: 5,
            fullStar: true,
            readOnly: typeof $(this).data("readonly") !== "undefined" ? $(this).data("readonly") : false

        }).on("rateyo.set", function (e, data) {
            var input = $(this).data("input-id");
            if (typeof input !== "undefined") {
                $("#" + input).val(data.rating);
            }
        });
    });
});
