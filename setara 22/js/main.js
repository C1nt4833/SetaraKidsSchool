(function ($) {
    "use strict";

    // Initiate the wowjs
    new WOW().init();


    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            992: {
                items: 2
            }
        }
    });

    // Sidebar Toggle Logic
    $(document).ready(function () {
        const $navbarCollapse = $('#navbarCollapse');
        const $body = $('body');

        // Inject backdrop once
        if (!$('.sidebar-overlay').length) {
            $body.append('<div class="sidebar-overlay"></div>');
        }
        const $overlay = $('.sidebar-overlay');

        // Inject close button inside navbar collapse if not exists
        if ($navbarCollapse.length && !$('.sidebar-close').length) {
            $navbarCollapse.prepend('<div class="sidebar-close"><i class="fa fa-times"></i></div>');
        }

        // Use Bootstrap Events for synchronization
        $navbarCollapse.on('show.bs.collapse', function () {
            $overlay.addClass('show');
            $body.css('overflow', 'hidden');
        });

        $navbarCollapse.on('hide.bs.collapse', function () {
            $overlay.removeClass('show');
            $body.css('overflow', 'auto');
        });

        // Manual Close (Backdrop or Close Button)
        $('.sidebar-overlay, .sidebar-close').on('click', function () {
            $navbarCollapse.collapse('hide');
        });

        // Handle Dropdown Toggle in Sidebar Mode
        $('.navbar-nav .dropdown-toggle').on('click', function (e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                e.stopImmediatePropagation(); // Prevent conflict with other handlers

                const $this = $(this);
                const $targetMenu = $this.next('.dropdown-menu');

                // Toggle current
                if ($this.hasClass('show')) {
                    $this.removeClass('show');
                    $targetMenu.removeClass('show');
                } else {
                    // Close others
                    $('.navbar-nav .dropdown-toggle').removeClass('show');
                    $('.navbar-nav .dropdown-menu').removeClass('show');
                    // Open current
                    $this.addClass('show');
                    $targetMenu.addClass('show');
                }
            }
        });

        // Close sidebar when clicking a regular nav link (mobile only)
        $('.navbar-nav .nav-link').on('click', function (e) {
            if ($(window).width() < 992 && !$(this).hasClass('dropdown-toggle')) {
                $navbarCollapse.collapse('hide');
            }
        });

        // Auto-highlight and Open parent dropdown if child is active on mobile
        setTimeout(function () {
            const $activeChild = $('.dropdown-item.active');
            if ($activeChild.length && $(window).width() < 992) {
                const $parentDropdown = $activeChild.parents('.dropdown');
                const $toggle = $parentDropdown.find('.dropdown-toggle');
                const $menu = $parentDropdown.find('.dropdown-menu');

                $toggle.addClass('active show');
                $menu.addClass('show');
            } else {
                $('.dropdown-item.active').parents('.dropdown').find('.dropdown-toggle').addClass('active');
            }
        }, 100);
    });

})(jQuery);

