<div class="wrap about-wrap full-width-layout">
  <form id="qligg-save-settings" method="post">
    <table class="widefat form-table">
      <tbody>
        <tr>
          <td colspan="100%">
            <table>
              <tbody>
                <tr>
                  <th scope="row"><?php esc_html_e('Feeds cache', 'insta-gallery'); ?></th>
                  <td>
                    <input name="insta_reset" type="number" min="1" max="168" value="<?php echo esc_attr($settings['insta_reset']); ?>" />
                    <span class="description">
                      <?php esc_html_e('Reset your Instagram feeds cache every x hours.', 'insta-gallery'); ?>
                    </span>
                  </td>
                </tr>
                <tr>
                  <th><?php esc_html_e('Remove data', 'insta-gallery'); ?></th>
                  <td>
                    <input type="checkbox" name="insta_flush" value="1" <?php checked(1, $settings['insta_flush']); ?> />
                    <span class="description">
                      <?php esc_html_e('Check this box to remove all data related to this plugin on uninstall.', 'insta-gallery'); ?>
                    </span>
                  </td>
                </tr>
                <tr>
                  <th><?php esc_html_e('Replace loader', 'insta-gallery'); ?></th>
                  <td>
                    <?php 
                    $mid = '';
                    $misrc = '';
                    if (isset($settings['insta_spinner_image_id'])) {
                      $mid = $settings['insta_spinner_image_id'];
                      $image = wp_get_attachment_image_src($mid, 'full');
                      if ($image) {
                        $misrc = $image[0];
                      }
                    }
                    ?>
                    <input type="hidden" name="insta_spinner_image_id" value="<?php echo esc_attr($mid); ?>" data-misrc="<?php echo esc_attr($misrc); ?>" />
                    <a href="javascript:;" id="ig-spinner-upload" class="button button-primary"><?php esc_html_e('Upload', 'insta-gallery'); ?></a>
                    <a href="javascript:;" id="ig-spinner-reset" class="button button-secondary"><?php esc_html_e('Reset Spinner', 'insta-gallery'); ?></a> 
                    <p>
                      <span class="description">
                        <?php esc_html_e('Select an image from media library to replace the default loader icon.', 'insta-gallery'); ?>
                      </span>
                    </p>
                  </td>
                  <td rowspan="2">
                    <div class="insta-gallery-spinner">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">
            <span class="spinner"></span>
            <button type="submit" class="button button-primary secondary"><?php esc_html_e('Save', 'insta-gallery'); ?></button>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>