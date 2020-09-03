(function ($) {
  "use strict";

  _.mixin({
    escapeHtml: function (attribute) {
      return attribute.replace('&amp;', /&/g)
        .replace(/&gt;/g, ">")
        .replace(/&lt;/g, "<")
        .replace(/&quot;/g, '"')
        .replace(/&#039;/g, "'");
    },
    getFormData: function ($form) {
      return $form.serializeJSON();
    }
  });

  // Spinner
  // -------------------------------------------------------------------------

  function ig_change_spinner(link) {
    if (link) {
      if (!$('#qligg-save-settings .insta-gallery-spinner img').length) {
        var img = '<img src="' + link + '" class="ig-spin" />';
        $('#qligg-save-settings .insta-gallery-spinner').append(img);
      } else {
        $('#qligg-save-settings .insta-gallery-spinner img').attr('src', link);
      }
      $('#qligg-save-settings .insta-gallery-spinner .ig-spin').hide();
      $('#qligg-save-settings .insta-gallery-spinner img').show();
    } else {
      $('#qligg-save-settings .insta-gallery-spinner .ig-spin').show();
      $('#qligg-save-settings .insta-gallery-spinner img').remove();
    }

  }

  var $igs_image_id = $('input[name=insta_spinner_image_id]'),
    $igs_reset = $('#ig-spinner-reset');

  $('#qligg-save-settings').on('submit', function (e) {
    e.preventDefault();

    var $form = $(this),
      $spinner = $form.find('.spinner');

    $.ajax({
      url: ajaxurl,
      type: 'post',
      dataType: 'JSON',
      data: {
        action: 'qligg_save_settings',
        nonce: qligg_settings.nonce.qligg_save_settings,
        settings_data: $form.serialize(),
      },
      beforeSend: function () {
        $spinner.addClass('is-active');
      },
      success: function (response) {
      },
      complete: function () {
        $spinner.removeClass('is-active');
      },
      error: function (jqXHR, textStatus) {
        console.log(textStatus);
      }
    });
  });

  // reset spinner to default
  $igs_reset.on('click', function () {
    $igs_image_id.val('');
    ig_change_spinner();
    $(this).hide();
  });

  if ($igs_image_id.val() == '')
    $igs_reset.hide();
  if ($igs_image_id.data('misrc') != '')
    ig_change_spinner($igs_image_id.data('misrc'));

  // Upload media image
  // ---------------------------------------------------------------------------
  $('#ig-spinner-upload').on('click', function (e) {
    e.preventDefault();
    var image_frame;

    if (image_frame) {
      image_frame.open();
    }
    // Define image_frame as wp.media object
    image_frame = wp.media({
      title: 'Select Media',
      multiple: false,
      library: {
        type: 'image',
      }
    });

    image_frame.on('close', function () {
      // On close, get selections and save to the hidden input
      // plus other AJAX stuff to refresh the image preview
      var selection = image_frame.state().get('selection');

      if (selection.length) {

        var gallery_ids = new Array();
        var i = 0, attachment_url;

        selection.each(function (attachment) {
          gallery_ids[i] = attachment['id'];
          attachment_url = attachment.attributes.url;
          i++;
        });
        var ids = gallery_ids.join(",");
        $igs_image_id.val(ids);
        ig_change_spinner(attachment_url)
      }

      // toggle reset button
      if ($igs_image_id.val() == '') {
        $igs_reset.hide();
      } else {
        $igs_reset.show();
      }

    });

    image_frame.on('open', function () {
      // On open, get the id from the hidden input
      // and select the appropiate images in the media manager
      var selection = image_frame.state().get('selection');
      var ids = $igs_image_id.val().split(',');

      ids.forEach(function (id) {
        attachment = wp.media.attachment(id);
        attachment.fetch();
        selection.add(attachment ? [attachment] : []);
      });

    });

    image_frame.open();
  });

})(jQuery);