$(document).ready(function() {
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
    var page = 1; // What page we are on.
    var ppp = 2; // Post per page

    init();

    function init() {
        $("#fullpage").fullpage({
            // navigation: true,
            // scrollBar: false,
            // lazyLoading: false,
            // continuousVertical: false,
            // continuousHorizontal: false,
            // loopHorizontal: false,
            // dragAndMove: true,
            // scrollingSpeed: 400,
            scrollOverflow: true,
            autoScrolling: true,
            normalScrollElements: '.card_detail_content',
            afterLoad: function(origin, destination, direction) {
                var params = {
                    origin: origin,
                    destination: destination,
                    direction: direction,
                };

                if (destination.isLast == true) {
                    //La llamada AJAX
                    $.ajax({
                        type: "post",
                        url: MyAjax.url, // Pon aquí tu URL
                        data: {
                            action: "more_post_ajax",
                            offset: page * ppp + 1,
                            ppp: ppp,
                        },
                        beforeSend: function() {
                            $("#infinite").css("display", "flex");
                        },
                        error: function(response) {
                            console.log(response);
                        },
                        success: function(response) {
                            page++;
                            // console.log('Pagina' + page);

                            // Actualiza el mensaje con la respuesta
                            // console.log(response);
                            $("#fullpage").append(response);

                            //remembering the active section / slide
                            var activeSectionIndex = $(".fp-section.active").index();
                            var activeSlideIndex = $(".fp-section.active")
                                .find(".slide.active")
                                .index();

                            $.fn.fullpage.destroy("all");

                            //setting the active section as before
                            $(".section").eq(activeSectionIndex).addClass("active");

                            //were we in a slide? Adding the active state again
                            if (activeSlideIndex > -1) {
                                $(".section.active")
                                    .find(".slide")
                                    .eq(activeSlideIndex)
                                    .addClass("active");
                            }

                            init();

                            $("#txtMessage").text("oka");
                            $("#infinite").css("display", "none");
                        },
                    });
                }
                // $(params.destination.item).find('video')[0].css('opacity', '0.9');
                if ($(params.destination.item).find("video")[0]) {
                    $(params.destination.item).find("video")[0].play();
                }
                // console.log("--- afterLoad ---");
                // console.log(params);
                // console.log('===============');
            },
        });
    }
});