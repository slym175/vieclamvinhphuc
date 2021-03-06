!function (e, a, i) {
    "use strict";
    i(a).ready(function () {
        function n(e, a) {
            e.children(".submenu-content").show().slideUp(200, function () {
                i(this).css("display", ""), i(this).find(".menu-item").removeClass("is-shown"), e.removeClass("open"), a && a()
            })
        }

        var t = i(".app-sidebar"), s = i(".sidebar-content"), l = i(".wrapper"),
            o = a.querySelector(".sidebar-content");
        o && new PerfectScrollbar(o, {
            wheelSpeed: 10,
            wheelPropagation: !0,
            minScrollbarLength: 5
        }), s.on("click", ".navigation-main .nav-item a", function () {
            var e = i(this).parent(".nav-item");
            if (e.hasClass("has-sub") && e.hasClass("open")) n(e); else {
                if (e.hasClass("has-sub") && function (e, a) {
                    var n = e.children(".submenu-content"), t = n.children(".menu-item").addClass("is-hidden");
                    e.addClass("open"), n.hide().slideDown(200, function () {
                        i(this).css("display", "")
                    }), setTimeout(function () {
                        t.addClass("is-shown"), t.removeClass("is-hidden")
                    }, 0)
                }(e), s.data("collapsible")) return !1;
                n(e.siblings(".open")), e.siblings(".open").find(".nav-item.open").removeClass("open")
            }
        }), i(".nav-toggle").on("click", function () {
            var e = i(this).find(".toggle-icon");
            "expanded" === e.attr("data-toggle") ? (l.addClass("nav-collapsed"), i(".nav-toggle").find(".toggle-icon").removeClass("ik-toggle-right").addClass("ik-toggle-left"), e.attr("data-toggle", "collapsed")) : (l.removeClass("nav-collapsed menu-collapsed"), i(".nav-toggle").find(".toggle-icon").removeClass("ik-toggle-left").addClass("ik-toggle-right"), e.attr("data-toggle", "expanded"))
        }), t.on("mouseenter", function () {
            if (l.hasClass("nav-collapsed")) {
                l.removeClass("menu-collapsed");
                var e = i(".navigation-main .nav-item.nav-collapsed-open");
                e.children(".submenu-content").hide().slideDown(300, function () {
                    i(this).css("display", "")
                }), s.find(".nav-item.active").parents(".nav-item").addClass("open"), e.addClass("open").removeClass("nav-collapsed-open")
            }
        }).on("mouseleave", function (e) {
            if (l.hasClass("nav-collapsed")) {
                l.addClass("menu-collapsed");
                var a = i(".navigation-main .nav-item.open"), n = a.children(".submenu-content");
                a.addClass("nav-collapsed-open"), n.show().slideUp(300, function () {
                    i(this).css("display", "")
                }), a.removeClass("open")
            }
        }), i(e).width() < 992 && (t.addClass("hide-sidebar"), l.removeClass("nav-collapsed menu-collapsed")), i(e).resize(function () {
            i(e).width() < 992 && (t.addClass("hide-sidebar"), l.removeClass("nav-collapsed menu-collapsed")), i(e).width() > 992 && (t.removeClass("hide-sidebar"), "collapsed" === i(".toggle-icon").attr("data-toggle") && l.not(".nav-collapsed menu-collapsed") && l.addClass("nav-collapsed menu-collapsed"))
        }), i(a).on("click", ".navigation li:not(.has-sub)", function () {
            i(e).width() < 992 && t.addClass("hide-sidebar")
        }), i(a).on("click", ".logo-text", function () {
            i(e).width() < 992 && t.addClass("hide-sidebar")
        }), i(".mobile-nav-toggle").on("click", function (e) {
            e.stopPropagation(), t.toggleClass("hide-sidebar")
        }), i("html").on("click", function (a) {
            i(e).width() < 992 && (t.hasClass("hide-sidebar") || 0 !== t.has(a.target).length || t.addClass("hide-sidebar"))
        }), i("#sidebarClose").on("click", function () {
            t.addClass("hide-sidebar")
        }), i('[data-toggle="tooltip"]').tooltip(), i("#checkbox_select_all").on("click", function () {
            for (var e = a.getElementsByName("item_checkbox"), n = 0; n < e.length; n++) "checkbox" == e[n].type && (e[n].checked = !0), i(e).parent().parent().addClass("selected")
        }), i("#checkbox_deselect_all").on("click", function () {
            for (var e = a.getElementsByName("item_checkbox"), n = 0; n < e.length; n++) "checkbox" == e[n].type && (e[n].checked = !1), i(e).parent().parent().removeClass("selected")
        }), i("#quick-search").keyup(function () {
            var e = i(this).val().trim().toLowerCase();
            i(".app-item").hide().filter(function () {
                return -1 != i(this).html().trim().toLowerCase().indexOf(e)
            }).show()
        }), i(".list-item input:checkbox").change(function () {
            i(this).is(":checked") ? i(this).parent().parent().addClass("selected") : i(this).parent().parent().removeClass("selected")
        }), i("#navbar-fullscreen").on("click", function (e) {
            "undefined" != typeof screenfull && screenfull.enabled && screenfull.toggle()
        }), i("#selectall").click(function () {
            i(this).is(":checked") ? i(".select_all_child:checkbox").attr("checked", !0) : i(".select_all_child:checkbox").attr("checked", !1)
        }), i(".list-item-wrap .list-item .list-title a").on("click", function (e) {
            i(".list-item.quick-view-opened").not(this).removeClass("quick-view-opened"), i(this).parents().parent(".list-item").toggleClass("quick-view-opened")
        }), i(a).on("click", function (e) {
            i(e.target).closest(".list-item").length || i(".list-item").removeClass("quick-view-opened")
        }), "undefined" != typeof screenfull && screenfull.enabled && i(a).on(screenfull.raw.fullscreenchange, function () {
            screenfull.isFullscreen ? i("#navbar-fullscreen").find("i").toggleClass("ik-minimize ik-maximize") : i("#navbar-fullscreen").find("i").toggleClass("ik-maximize ik-minimize")
        }), i(".minimize-widget").on("click", function () {
            var e = i(this), a = i(e.parents(".widget"));
            i(a).children(".widget-body").slideToggle(), i(this).toggleClass("ik-minus").fadeIn("slow"), i(this).toggleClass("ik-plus").fadeIn("slow")
        }), i(".remove-widget").on("click", function () {
            var e = i(this);
            e.parents(".widget").animate({
                opacity: "0",
                "-webkit-transform": "scale3d(.3, .3, .3)",
                transform: "scale3d(.3, .3, .3)"
            }), setTimeout(function () {
                e.parents(".widget").remove()
            }, 800)
        }), i(".card-header-right .card-option .action-toggle").on("click", function () {
            var e = i(this);
            e.hasClass("ik-chevron-right") ? e.parents(".card-option").animate({width: "28px"}) : e.parents(".card-option").animate({width: "90px"}), i(this).toggleClass("ik-chevron-right").fadeIn("slow")
        }), i(".card-header-right .close-card").on("click", function () {
            var e = i(this);
            e.parents(".card").animate({
                opacity: "0",
                "-webkit-transform": "scale3d(.3, .3, .3)",
                transform: "scale3d(.3, .3, .3)"
            }), setTimeout(function () {
                e.parents(".card").remove()
            }, 800)
        }), i(".card-header-right .minimize-card").on("click", function () {
            var e = i(this), a = i(e.parents(".card"));
            i(a).children(".card-body").slideToggle(), i(this).toggleClass("ik-minus").fadeIn("slow"), i(this).toggleClass("ik-plus").fadeIn("slow")
        }), i(".task-list").on("click", "li.list", function () {
            i(this).toggleClass("completed")
        }), i(".search-btn").on("click", function () {
            i(".header-search").addClass("open"), i(".header-search .form-control").animate({width: "200px"})
        }), i(".search-close").on("click", function () {
            i(".header-search .form-control").animate({width: "0"}), setTimeout(function () {
                i(".header-search").removeClass("open")
            }, 300)
        });
        var c;
        var rs = a.querySelector(".right-sidebar");
        if (rs) new PerfectScrollbar(rs, {
            wheelSpeed: 10,
            wheelPropagation: !0,
            minScrollbarLength: 5
        });
        var ms = a.querySelector(".messages");
        if (ms) new PerfectScrollbar(ms, {wheelSpeed: 10, wheelPropagation: !0, minScrollbarLength: 5});
        ($(".right-sidebar-toggle").on("click", function (e) {
            return this.classList.toggle("active"), $(".wrapper").toggleClass("right-sidebar-expand"), !1
        }), document.addEventListener("click", function (e) {
            var a = document.getElementsByClassName("right-sidebar")[0],
                i = document.getElementsByClassName("chat-panel")[0];
            if (!(a.contains(e.target) || i.contains(e.target))) {
                document.body.classList.remove("right-sidebar-expand");
                for (var n = document.getElementsByClassName("right-sidebar-toggle"), t = 0; t < n.length; t++) n[t].classList.remove("active");
                i.hidden = "hidden"
            }
        }), (c = $('[data-plugin="chat-sidebar"]')).length) && (c.find(".chat-list").each(function (e) {
            var a = $(this);
            $(this).find(".list-group a").on("click", function () {
                a.find(".list-group a.active").removeClass("active"), $(this).addClass("active");
                var e = $(".chat-panel");
                if (e.length) {
                    e.removeAttr("hidden");
                    var i = e.find(".messages");
                    i[0].scrollTop = i[0].scrollHeight, i[0].classList.contains("scrollbar-enabled") && i.perfectScrollbar("update"), e.find(".user-name").html($(this).data("chat-user"))
                }
            })
        }), (c = $(".chat-panel")).length && (c.find(".close").on("click", function () {
            c.attr("hidden", !0), c.find(".panel-body").removeClass("hide")
        }), c.find(".minimize").on("click", function () {
            c.find(".card-block").attr("hidden", !c.find(".card-block").attr("hidden")), "hidden" === c.find(".card-block").attr("hidden") ? $(this).find(".material-icons").html("expand_less") : $(this).find(".material-icons").html("expand_more")
        })))
    })
}(window, document, jQuery);
