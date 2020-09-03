(function ($) {
  "use strict";

  var swiper_index = 0, $swipers = {};

  // Ajax load
  // ---------------------------------------------------------------------------

  function qligg_load_item_images($item, next_max_id) {

    var $wrap = $('.insta-gallery-list', $item),
      $spinner = $('.insta-gallery-spinner', $item),
      feed = $item.data('feed');

    $.ajax({
      url: qligg.ajax_url,
      type: 'post',
      timeout: 30000,
      data: {
        action: 'qligg_load_item_images',
        next_max_id: next_max_id,
        feed: JSON.stringify(feed)
      },
      beforeSend: function () {
        $spinner.show();
      },
      success: function (response) {

        if (response.success !== true) {
          $wrap.append($(response.data));
          $spinner.hide();
          return;
        }
        var $images = $(response.data);

        $wrap.append($images).trigger('qligg.loaded', [$images]);

      },
      complete: function () {
      },
      error: function (jqXHR, textStatus) {
        $spinner.hide();
        console.log(textStatus);
      }
    });

  }

  // Images
  // ---------------------------------------------------------------------------

  $('.insta-gallery-feed').on('qligg.loaded', function (e, images) {

    var $item = $(e.delegateTarget),
      $wrap = $('.insta-gallery-list', $item),
      $spinner = $('.insta-gallery-spinner', $item),
      $button = $('.insta-gallery-button.load', $item),
      options = $item.data('feed'),
      total = $(images).length,
      loaded = 0;

    if (total) {
      $wrap.find('.insta-gallery-image').load(function (e) {
        loaded++;
        if (loaded >= total) {
          $wrap.trigger('qligg.imagesLoaded', [images]);
        }
      });
    }

    if (total < options.limit) {
      $spinner.hide();
      setTimeout(function () {
        $button.fadeOut();
      }, 300);
    }

  });

  // Spinner
  // ---------------------------------------------------------------------------

  $('.insta-gallery-feed').on('qligg.imagesLoaded', function (e) {

    var $item = $(e.delegateTarget),
      $spinner = $('.insta-gallery-spinner', $item);

    $spinner.hide();

  });

  // Gallery
  // ---------------------------------------------------------------------------

  $('.insta-gallery-feed[data-feed_layout=gallery]').on('qligg.imagesLoaded', function (e, images) {

    var $item = $(e.delegateTarget);

    $item.addClass('loaded');

    $(images).each(function (i, item) {
      setTimeout(function () {
        $(item).addClass('ig-image-loaded');
      }, 150 + (i * 30));

    });
  });

  // Carousel
  // ---------------------------------------------------------------------------

  $('.insta-gallery-feed[data-feed_layout=carousel]').on('qligg.imagesLoaded', function (e, images) {

    var $item = $(e.delegateTarget);

    $item.addClass('loaded');

    $(images).each(function (i, item) {
      //setTimeout(function () {
      $(item).addClass('ig-image-loaded');
      //}, 500 + (i * 50));

    });
  });

  $('.insta-gallery-feed[data-feed_layout=carousel]').on('qligg.imagesLoaded', function (e, images) {

    var $item = $(e.delegateTarget),
      $swiper = $('.swiper-container', $item),
      options = $item.data('feed');
    options.carousel.slides = options.carousel.slidespv;
    ///  options.carousel.interval = options.carousel.autoplay_interval;
    swiper_index++;

    $swipers[swiper_index] = new Swiper($swiper, {
      //direction: 'vertical',
      //wrapperClass: 'insta-gallery-list',
      //slideClass: 'insta-gallery-item',
      loop: true,
      autoHeight: true,
      observer: true,
      observeParents: true,
      slidesPerView: 1,
      spaceBetween: 2,
      autoplay: options.carousel.autoplay ? {
        delay: parseInt(options.carousel.autoplay_interval),
      } : false,
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
        type: 'bullets',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 1,
        },
        480: {
          spaceBetween: parseInt(options.spacing),
          slidesPerView: Math.min(2, parseInt(options.carousel.slides))
        },
        768: {
          spaceBetween: parseInt(options.spacing),
          slidesPerView: Math.min(3, parseInt(options.carousel.slides))
        },
        1024: {
          spaceBetween: parseInt(options.spacing),
          slidesPerView: parseInt(options.carousel.slides)
        },
      }
    });
  });

  // Masonry
  // ---------------------------------------------------------------------------

  $('.insta-gallery-feed[data-feed_layout=masonry]').on('qligg.imagesLoaded', function (e, images) {

    var $item = $(e.delegateTarget),
      $wrap = $('.insta-gallery-list', $item);

    if (!$wrap.data('masonry')) {
      $wrap.masonry({
        itemSelector: '.insta-gallery-item',
        isResizable: true,
        isAnimated: false,
        transitionDuration: 0,
        percentPosition: true,
        columnWidth: '.insta-gallery-item:last-child'
      });
    } else {
      $wrap.masonry('appended', images, false);
    }
  });


  $('.insta-gallery-feed[data-feed_layout=masonry]').on('layoutComplete', function (e, items) {

    var $item = $(e.delegateTarget);

    $item.addClass('loaded');

    $(items).each(function (i, item) {
      //      setTimeout(function () {
      $(item.element).addClass('ig-image-loaded');
      //      }, 500 + (i * 50));

    });
  });

  // Popup
  // ---------------------------------------------------------------------------
  $('.insta-gallery-feed').on('qligg.loaded', function (e) {

    var $item = $(e.delegateTarget),
      $wrap = $('.insta-gallery-list', $item),
      options = $item.data('feed');

    // Redirect
    // -------------------------------------------------------------------------
    $('.insta-gallery-item .insta-gallery-icon.qligg-icon-instagram', $wrap).on('click', function (e) {
      e.stopPropagation();
    });

    // Carousel
    // -------------------------------------------------------------------------
    //$('.insta-gallery-item', $wrap).on('mfpOpen', function (e) {
    //});

    if (!options.popup.display) {
      return;
    }

    $('.insta-gallery-item', $wrap).magnificPopup({
      type: 'inline',
      callbacks: {
        beforeOpen: function () {
          this.st.mainClass = this.st.mainClass + ' ' + 'qligg-mfp-wrap';
        },
        elementParse: function (item) {

          var media = '', profile = '', counter = '', caption = '', info = '', likes = '', date = '', comments = '';

          media = '<img src="' + item.el.data('item').images.standard + '"/>'
       
          counter = '<div class="mfp-icons"><div class="mfp-counter">' + (item.index + 1) + ' / ' + $('.insta-gallery-item', $wrap).length + '</div><a class="mfp-link" href="' + item.el.data('item').link + '" target="_blank" rel="noopener"><i class="qligg-icon-instagram"></i>Instagram</a></div>';

          if (options.popup.profile) {
            profile = '<div class="mfp-user"><img src="' + options.profile.profile_picture_url + '"><a href="https://www.instagram.com/' + options.profile.username + '" title="' + options.profile.name + '" target="_blank" rel="noopener">' + options.profile.username + '</a></div>';
          }

          if (options.popup.caption) {
            caption = '<div class="mfp-caption">' + item.el.data('item').caption + '</div>';
          }

          if (item.el.data('item').date) {
            date = '<div class="mfp-date">' + item.el.data('item').date + '</div>';
          }

          if (item.el.data('item').comments && options.popup.comments) {
            comments = '<div class="mfp-comments"><i class="qligg-icon-comment"></i>' + item.el.data('item').comments + '</div>';
          }

          if (item.el.data('item').likes && options.popup.likes) {
            likes = '<div class="mfp-likes"><i class="qligg-icon-heart"></i>' + item.el.data('item').likes + '</div>';
          }

          if (options.popup.likes || options.popup.comments) {
            info = '<div class="mfp-info">' + likes + comments + date + '</div>';
          }

          item.src = '<div class="mfp-figure ' + options.popup.align + '">' + media + '<div class="mfp-close"></div><div class="mfp-bottom-bar"><div class="mfp-title">' + profile + counter + caption + info + '</div></div></div>';
        }
      },
      gallery: {
        enabled: true
      }
    });

  });

  // Init
  // ---------------------------------------------------------------------------

  $('.insta-gallery-feed').on('click', '.insta-gallery-button.load', function (e) {
    e.preventDefault();

    var $item = $(e.delegateTarget);

    if (!$item.hasClass('loaded')) {
      return false;
    }

    var next_max_id = $('.insta-gallery-list .insta-gallery-item:last-child', $item).data('item').i;

    qligg_load_item_images($item, next_max_id);

  });

  $('.insta-gallery-feed').each(function (index, item) {

    var $item = $(item);

    if ($item.hasClass('loaded')) {
      return false;
    }

    qligg_load_item_images($item, 0);

  });  

  // IE8
  // ---------------------------------------------------------------------------

  if (navigator.appVersion.indexOf("MSIE 8.") != -1) {
    document.body.className += ' ' + 'instagal-ie-8';
  }
  if (navigator.appVersion.indexOf("MSIE 9.") != -1) {
    document.body.className += ' ' + 'instagal-ie-9';
  }

})(jQuery);
