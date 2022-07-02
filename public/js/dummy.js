$(function() {
        "use strict";
        initSparkline(), skinChanger(), setTimeout(function() {
            $(".page-loader-wrapper").fadeOut()
        }, 1000)
    }),

    $(document).ready(function() {
        $(".sidebar").metisMenu(),
            $(".btn-toggle-fullwidth").on("click", function() {
                $("body").hasClass("layout-fullwidth") ? $("body").removeClass("layout-fullwidth") : $("body").addClass("layout-fullwidth"),
                    $(this).find(".fa").toggleClass("fa-arrow-left fa-arrow-right")
            }),
            $(".btn-toggle-offcanvas").on("click", function() {
                $("body").toggleClass("offcanvas-active")
            }),
            $(".right_setting").on("click", function() {
                $(".setting_div").toggleClass("open")
            }),
            $(".btn-toggle-offcanvas").on("click", function() {
                $(".sidebar").toggleClass("open")
            }),
            $(".theme-rtl input").on("change", function() {
                this.checked ? $("body").addClass("rtl_mode") : $("body").removeClass("rtl_mode")
            }),
            $("#main-content").on("click", function() {
                $("body").removeClass("offcanvas-active")
            }),
            $(".right_icon_btn").on("click", function() {
                $("body").toggleClass("right_icon_toggle")
            }),
            $(".dropdown").on("show.bs.dropdown", function() {
                $(this).find(".dropdown-menu").first().stop(!0, !0).animate({ top: "100%" }, 200)
            }),
            $(".dropdown").on("hide.bs.dropdown", function() {
                $(this).find(".dropdown-menu").first().stop(!0, !0).animate({ top: "80%" }, 200)
            }),
            $('.navbar-form.search-form input[type="text"]').on("focus", function() {
                $(this).animate({ width: "+=50px" }, 300)
            }).on("focusout", function() {
                $(this).animate({ width: "-=50px" }, 300)
            }), 0 < $('[data-toggle="tooltip"]').length && $('[data-toggle="tooltip"]').tooltip(), 0 < $('[data-toggle="popover"]').length && $('[data-toggle="popover"]').popover(),

            $(window).on("load", function() {
                $("#main-content").height() < $("#left-sidebar").height() && $("#main-content").css("min-height", $("#left-sidebar").innerHeight() - $("footer").innerHeight())
            }),

            $(window).on("load resize", function() {
                $(window).innerWidth() < 1280 ? $("body").addClass("layout-fullwidth sidebar_toggle") : $("body").removeClass("layout-fullwidth sidebar_toggle")
            })
    });