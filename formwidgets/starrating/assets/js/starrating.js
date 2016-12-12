$(document).ready(function() {

    $(".rateyo").each(function() {

        $(this).rateYo({
            rating: typeof $(this).data("input-id") !== "undefined" ? parseInt($("#" + $(this).data("input-id")).val()) : 0,
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
