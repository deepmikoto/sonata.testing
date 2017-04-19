/**
 * Created by alexandru.vasileniuc on 19.04.2017.
 */
jQuery(document).ready(function(o) {
    var s = 1170;
    if (o(window).width() > s) {
        var i = o(".navbar-custom").height();
        o(window).on("scroll", {
            previousTop: 0
        }, function() {
            var s = o(window).scrollTop();
            s < this.previousTop ? s > 0 && o(".navbar-custom").hasClass("is-fixed") ? o(".navbar-custom").addClass("is-visible") : o(".navbar-custom").removeClass("is-visible is-fixed") : s > this.previousTop && (o(".navbar-custom").removeClass("is-visible"),
            s > i && !o(".navbar-custom").hasClass("is-fixed") && o(".navbar-custom").addClass("is-fixed")),
                this.previousTop = s
        })
    }
});