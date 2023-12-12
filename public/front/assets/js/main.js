// header random description start

if ($('.descripton').length>=1) {
    let lastRandom = -1;
    function descriptons() {
        let number = $('.descripton').length / 2;
        let random;
        do {
            random = Math.floor(Math.random() * number);
        } while (random === lastRandom);
        lastRandom = random;
        $('.descripton').hide().eq(random).show();
    }

    descriptons();

    setInterval(function () {
        descriptons();
    }, 3000);
} 

// header random description end

// Header menu open start

$('.menu-icon').click(function () {
    $('body header').toggleClass('open');
});

// Header menu close

// Filter start

$(".view-options span").click(function () {
    $(".view-options span").removeClass("current-view");
    $(this).addClass("current-view");
    let viewClass = $(this).data("view");
    $(".project-cards-group").removeClass("grid list").addClass(viewClass);
});

$(document).on('mouseenter', '.grid .project-card', function () {
    $(this).find('.project-card-caption').slideDown(400);
    $(this).find('.project-card-subtitle').animate({ opacity: 1 }, 500);
});
$(document).on('mouseleave', '.grid .project-card', function () {
    $(this).find('.project-card-caption').slideUp(400);
    $(this).find('.project-card-subtitle').animate({ opacity: 0 }, 300,);
});

// Filter end

// Header scroll start

$(window).scroll(function () {
    let scrollTop = $(window).scrollTop();
    if (scrollTop > 40) {
        $('header').addClass('at-top');
    } else {
        $('header').removeClass('at-top');
    }
})

// Header scroll end

//Family member start

let memberOpen = false;

$('.close-family-member').click(function () {
    $(this).parents('.family-member').removeClass('current-member');
    $('.family-member-description', $(this).parents('.family-member')).slideUp();
    memberOpen = false;
});

$('.family-member-link').click(function (e) {
    let that = $(this);
    let member = that.parents('.family-member');
    if (member.hasClass('current-member')) {
        // If already open then close it
        member.removeClass('current-member');
        $('.family-member-description', member).slideUp();
        memberOpen = false;
    } else {
        // This one isn't open
        // If one is open
        if (memberOpen === true) {
            $('.current-member .family-member-description').slideUp(400, function () {
                $('.family-member').removeClass('current-member');
                let memberImg = $('.family-member-image img', member);
                memberImg.attr('src', memberImg.data('src'));
                $('.family-member').removeClass('current-member');
                $('.family-member-description', member).slideDown(400, function () {
                    member.addClass('current-member');
                });
                $('body,html').animate({ scrollTop: $('.family-member-description', member).offset().top - $(window).height() / 4 }, 400);
            });
        } else {
            memberOpen = true;
            let memberImg = $('.family-member-image img', member);
            memberImg.attr('src', memberImg.data('src'));
            $('.family-member').removeClass('current-member');
            $('.family-member-description', member).slideDown(400, function () {
                member.addClass('current-member');
            });
            $('body,html').animate({ scrollTop: $('.family-member-description', member).offset().top - $(window).height() / 4 }, 400);
        }

    }
    e.preventDefault();
});

//Family member end

// Single Page Read more button start

let textHeight = 0;
let initialScroll = 0;
let moreOpen = false;

$('.read-more').click(function (e) {
    if ($(this).text() === '(Read more)') {
        $(this).text('(Read less)');
        $('body').addClass('read-more-open');
    } else {
        $(this).text('(Read more)');
        $('body').removeClass('read-more-open');
    }
    $('header .project-description').stop().slideToggle(300, function () {
        textHeight = $('header .project-description').height();
        moreOpen = moreOpen === true ? false : true;
        $('.read-more-cover').scrollTop(0);
        $('.read-more-cover-inner').height($(window).height() + textHeight);
    });

    e.preventDefault();
});

// Single Page Read more button end

// Gallery start

let currentOffset = 0;
let gutter = 10;
if ($(window).width() > 575) {
    $('.gallery-prev, .gallery-next').mouseenter(function (e) {
        currentOffset = $(this).offset().top;
    }).mousemove(function (e) {
        $(this).next('.gallery-arrow').css({
            top: e.pageY - currentOffset + gutter * 3 + 15
        });
    }).mouseleave(function (e) {
        $(this).next('.gallery-arrow').stop(true, true).animate({
            top: '50%'
        }, 200);
    });
}


$('.locations-gallery .gallery-prev').click(function (e) {
    e.preventDefault();
    let gallery = $(this).parents('.locations-gallery');

    if ($('.current-slide', gallery).is(':first-child')) {
        newSlide = $('.locations-image:last-child', gallery).index();
    } else {
        newSlide = $('.current-slide', gallery).index() - 1;
    }
    $('.locations-image', gallery).removeClass('current-slide').eq(newSlide).addClass('current-slide');
});

$('.locations-gallery .gallery-next').click(function (e) {
    e.preventDefault();
    let gallery = $(this).parents('.locations-gallery');

    if ($('.current-slide', gallery).is(':last-child')) {
        newSlide = 0;
    } else {
        newSlide = $('.current-slide', gallery).index() + 1;
    }
    $('.locations-image', gallery).removeClass('current-slide').eq(newSlide).addClass('current-slide');
});

// Gallery end

// Sinle Project Container start

if($('.project-row') && $(window).width() > 760){
    $('.project-row').each(function() {
        let containerCount = $(this).find('.project-image-container').length;
        
        if (containerCount === 2) {
          $(this).find('.project-image-container').css('width', '50%');
        } else if (containerCount === 1) {
          $(this).find('.project-image-container').css('width', '100%');
        }
      });
}

// Single Project Container end


