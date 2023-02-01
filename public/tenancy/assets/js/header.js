$(document).ready(function () {
    $(".navbar-nav>li>a.anchor").on("click", function () {
      $(".navbar-collapse").collapse("hide");
    });
    $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
        $("header").addClass("fixed");
      } else {
        $("header").removeClass("fixed");
      }
    });
    $("a.anchor")
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function (event) {
        if (
          location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
          location.hostname == this.hostname
        ) {
          var target = $(this.hash);
          target = target.length
            ? target
            : $("[name=" + this.hash.slice(1) + "]");
          if (target.length) {
            console.log(target);
            event.preventDefault();
            $("html, body").animate(
              {
                scrollTop: target.offset().top,
              },
              1500,
              function () {
                var $target = $(target);
                $target.focus();
                if ($target.is(":focus")) {
                  return !1;
                } else {
                  $target.attr("tabindex", "-1");
                  $target.focus();
                }
              }
            );
          }
        }
      });
    var target = window.location.hash,
      target = target.replace("#", "");
    window.location.hash = "";
    $(window).on("load", function () {
      if (target) {
        $("html, body").animate(
          {
            scrollTop: $("#" + target).offset().top,
          },
          1500,
          "swing",
          function () {}
        );
      }
    });
  });

  // $(".navbar-collapse").collapse("hide");
  //   $(window).scroll(function () {
  //     if ($(this).scrollTop() > 50) {
  //       $("header").addClass("fixed");
  //     } else {
  //       $("header").removeClass("fixed");
  //     }
  //   });
