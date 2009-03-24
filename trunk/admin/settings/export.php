<?php __('Export', 'constructor'); // requeried for correct translation ?>
<b><?php _e('Export Current Theme', 'constructor') ?></b>
<p><?php _e('Use this is options for export your changes', 'constructor') ?> (<em><?php _e('save changes before export', 'constructor'); ?></em>)</p>

<p>
    <a href="<?php echo attribute_escape($_SERVER['REQUEST_URI']); ?>&action=export" id="export-link" class="button-secondary"><?php _e('click here and save file', 'constructor'); ?></a>
</p>

<p><?php
    $theme_loc = str_replace(WP_CONTENT_DIR, '', get_theme_root()).'/'.get_template();
    printf(
        __('For import theme - use your FTP access and create new folder in folder <code>%s/themes</code> and upload <code>config.php</code>', 'constructor'),
        $theme_loc
        ) ?>
</p>