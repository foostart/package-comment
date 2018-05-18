jQuery(document).ready(function($) {
            var lastScrollTop = 300;
            var $filter = $('.navbar');
            var $filterSpacer = $('<div />', {
                "class": "vnkings-spacer",
                "height": $filter.outerHeight()
            });
            if ($filter.size())
            {
                $(window).scroll(function ()
                {
                    if (!$filter.hasClass('fix') && $(window).scrollTop() > 0)
                    {
                        $filter.before($filterSpacer);
                        $filter.addClass("fix");
                    }
                    else if ($filter.hasClass('fix')  && $(window).scrollTop() == 0)
                    {
                        $filter.removeClass("fix");
                        $filterSpacer.remove();
                    }
                    if($(window).scrollTop() > 300)
                    {
                        var st = $(this).scrollTop();
                        if (st > lastScrollTop){
                               $filter.addClass("scrolldown");
                           } else {
                                $filter.removeClass("scrolldown");
                           }
                        lastScrollTop = st;
                    }
                });
            }
            $(".search-bar").click(function () {
                if($(".search-box").hasClass("appear"))
                {
                    $(".search-box").removeClass("appear");
                    $(".search-bar").removeClass("pb");
                    $(".img-logo").removeClass("fh");
                }
                else
                {
                    $(".search-box").addClass("appear");
                    $(".search-bar").addClass("pb");
                    $(".img-logo").addClass("fh");
                }
            });
        });