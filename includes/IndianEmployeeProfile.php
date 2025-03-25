<?php
// Define the class for the plugin
class IndianEmployeeProfile
{

    // Constructor to initialize hooks
    public function __construct()
    {
        // Register the custom roles on init
        add_action('init', [$this, 'add_custom_roles']);

        add_action('show_user_profile', [$this, 'add_verified_user_field']);
        add_action('edit_user_profile', [$this, 'add_verified_user_field']);
        add_action('personal_options_update', [$this, 'save_verified_user_field']);
        add_action('edit_user_profile_update', [$this, 'save_verified_user_field']);

        add_action('show_user_profile', [$this, 'add_profile_image_field']);
        add_action('edit_user_profile', [$this, 'add_profile_image_field']);
        add_action('personal_options_update', [$this, 'save_profile_image_field']);
        add_action('edit_user_profile_update', [$this, 'save_profile_image_field']);

        add_action('admin_enqueue_scripts', [$this, 'enqueue_media_uploader']);

        add_shortcode('user_profile', [$this, 'display_verified_user_profile']);
    }

    // Add custom roles like Writer, Reporter, and other content roles
    public function add_custom_roles()
    {
        // Add "Writer" role
        add_role('writer', __('Writer'), [
            'read' => true,
            'edit_posts' => true,
            'edit_published_posts' => true,
            'publish_posts' => true,
            'delete_posts' => false,
            'upload_files' => true,
        ]);

        // Add "Reporter" role
        add_role('reporter', __('Reporter'), [
            'read' => true,
            'edit_posts' => true,
            'edit_published_posts' => true,
            'publish_posts' => false,
            'delete_posts' => false,
            'upload_files' => true,
        ]);

        // Add "Editor Assistant" role
        add_role('editor_assistant', __('Editor Assistant'), [
            'read' => true,
            'edit_posts' => true,
            'edit_published_posts' => true,
            'delete_posts' => false,
            'upload_files' => true,
            'moderate_comments' => true, // Can moderate comments
        ]);
        // Add "Content Manager" role
        add_role('content_manager', __('Content Manager'), [
            'read' => true,
            'edit_posts' => true,
            'edit_others_posts' => true,
            'publish_posts' => true,
            'delete_posts' => true,
            'manage_categories' => true,
            'moderate_comments' => true,
        ]);

        // Add "Copywriter" role
        add_role('copywriter', __('Copywriter'), [
            'read' => true,
            'edit_posts' => true,
            'upload_files' => true,
            'publish_posts' => false, // Can write but cannot publish
            'delete_posts' => false,
        ]);

        // Add "Proofreader" role
        add_role('proofreader', __('Proofreader'), [
            'read' => true,
            'edit_posts' => true, // Can edit drafts or review content
            'edit_published_posts' => true,
            'delete_posts' => false,
            'upload_files' => false,
        ]);

        // Add "SEO Specialist" role
        add_role('seo_specialist', __('SEO Specialist'), [
            'read' => true,
            'edit_posts' => true,
            'edit_others_posts' => false,
            'manage_categories' => true, // Can manage SEO-related categories/tags
            'delete_posts' => false,
            'upload_files' => true,
        ]);

        // Add "Social Media Manager" role
        add_role('social_media_manager', __('Social Media Manager'), [
            'read' => true,
            'edit_posts' => true,
            'publish_posts' => true, // Can publish content for social sharing
            'delete_posts' => false,
            'upload_files' => true,
            'edit_others_posts' => false,
        ]);

        // Add "Photographer/Videographer" role
        add_role('photographer_videographer', __('Photographer/Videographer'), [
            'read' => true,
            'edit_posts' => true,
            'upload_files' => true, // Can upload media files (photos/videos)
            'delete_posts' => false,
            'publish_posts' => true,
        ]);

        // Add "Graphic Designer" role
        add_role('graphic_designer', __('Graphic Designer'), [
            'read' => true,
            'edit_posts' => true,
            'upload_files' => true, // Can upload media files (graphics)
            'publish_posts' => false,
            'delete_posts' => false,
        ]);
    }


    // Remove custom roles when the plugin is deactivated
    public function remove_custom_roles()
    {
        // Remove the custom roles on deactivation
        remove_role('writer');
        remove_role('reporter');
        remove_role('editor_assistant');
    }

    // Add 'Verified User' field in user profile
    public function add_verified_user_field($user)
    {
        if (!in_array('administrator', $user->roles) && current_user_can('administrator')) {
            $is_verified = get_user_meta($user->ID, 'is_verified_user', true);
            ?>
            <h3><?php _e("User Verification", "blank"); ?></h3>
            <table class="form-table">
                <tr>
                    <th><label for="is_verified"><?php _e("Verified User"); ?></label></th>
                    <td>
                        <input type="checkbox" name="is_verified" id="is_verified" <?php checked($is_verified, 'yes'); ?> />
                        <span class="description"><?php _e("Check to verify this user."); ?></span>
                    </td>
                </tr>
            </table>
            <?php
        }
    }

    // Save 'Verified User' field
    public function save_verified_user_field($user_id)
    {
        $user = get_userdata($user_id);

        if (in_array('administrator', $user->roles)) {
            update_user_meta($user_id, 'is_verified_user', 'yes');
        } elseif (current_user_can('administrator')) {
            update_user_meta($user_id, 'is_verified_user', isset($_POST['is_verified']) ? 'yes' : 'no');
        }
    }

    // Add profile image upload field with option to remove
    public function add_profile_image_field($user)
    {
        $profile_image = get_user_meta($user->ID, 'profile_image', true);
        ?>
        <h3><?php _e("Profile Image", "blank"); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="profile_image"><?php _e("Upload Profile Image"); ?></label></th>
                <td>
                    <?php if ($profile_image): ?>
                        <img src="<?php echo esc_url($profile_image); ?>" id="profile_image_preview"
                            style="width:100px;height:100px;" /><br />
                        <input type="button" class="button" id="remove_profile_image_button"
                            value="<?php _e('Remove Profile Image'); ?>" /><br />
                    <?php endif; ?>
                    <input type="hidden" name="profile_image" id="profile_image"
                        value="<?php echo esc_url($profile_image); ?>" />
                    <input type="button" class="button" id="upload_profile_image_button"
                        value="<?php _e('Upload Profile Image'); ?>" />
                    <span class="description"><?php _e("Select a profile image from the media library."); ?></span>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var mediaUploader;

                $('#upload_profile_image_button').click(function (e) {
                    e.preventDefault();

                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }

                    mediaUploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Profile Image',
                        button: { text: 'Choose Image' },
                        multiple: false
                    });

                    mediaUploader.on('select', function () {
                        var attachment = mediaUploader.state().get('selection').first().toJSON();
                        $('#profile_image').val(attachment.url);
                        $('#profile_image_preview').remove();
                        $('#upload_profile_image_button').before('<img src="' + attachment.url + '" id="profile_image_preview" style="width:100px;height:100px;" />');
                        $('#remove_profile_image_button').show();
                    });

                    mediaUploader.open();
                });

                $('#remove_profile_image_button').click(function (e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to remove the profile image?')) {
                        $('#profile_image').val('');
                        $('#profile_image_preview').remove();
                        $('#remove_profile_image_button').hide();
                    }
                });
            });
        </script>
        <?php
    }

    // Save profile image
    public function save_profile_image_field($user_id)
    {
        if (isset($_POST['profile_image'])) {
            if (empty($_POST['profile_image'])) {
                delete_user_meta($user_id, 'profile_image');
            } else {
                update_user_meta($user_id, 'profile_image', esc_url_raw($_POST['profile_image']));
            }
        }
    }

    // Enqueue the media uploader script
    public function enqueue_media_uploader()
    {
        if (is_admin()) {
            wp_enqueue_media();
        }
    }

    // Shortcode to display user profile with verified badge
    public function display_verified_user_profile($atts)
    {
        $user_id = get_current_user_id();
        $is_verified = get_user_meta($user_id, 'is_verified_user', true);
        $profile_image = get_user_meta($user_id, 'profile_image', true);
        $user_info = get_userdata($user_id);

        $user_roles = $user_info->roles;
        $role_label = '';

        if (in_array('administrator', $user_roles)) {
            $role_label = 'Admin';
        } elseif (in_array('editor', $user_roles)) {
            $role_label = 'Editor';
        } elseif (in_array('author', $user_roles)) {
            $role_label = 'Author';
        } elseif (in_array('contributor', $user_roles)) {
            $role_label = 'Contributor';
        } elseif (in_array('subscriber', $user_roles)) {
            $role_label = 'Subscriber';
        } elseif (in_array('writer', $user_roles)) {
            $role_label = 'Writer';
        } elseif (in_array('reporter', $user_roles)) {
            $role_label = 'Reporter';
        } elseif (in_array('editor_assistant', $user_roles)) {
            $role_label = 'Editor Assistant';
        } elseif (in_array('content_manager', $user_roles)) {
            $role_label = 'Content Manager';
        } elseif (in_array('copywriter', $user_roles)) {
            $role_label = 'Copywriter';
        } elseif (in_array('proofreader', $user_roles)) {
            $role_label = 'Proofreader';
        } elseif (in_array('seo_specialist', $user_roles)) {
            $role_label = 'SEO Specialist';
        } elseif (in_array('social_media_manager', $user_roles)) {
            $role_label = 'Social Media Manager';
        } elseif (in_array('photographer_videographer', $user_roles)) {
            $role_label = 'Photographer/Videographer';
        } elseif (in_array('graphic_designer', $user_roles)) {
            $role_label = 'Graphic Designer';
        } else {
            $role_label = 'User';
        }


        ob_start();

        echo '<div style="display: flex;">';
        if ($profile_image) {
            echo '<a href="' . esc_url(get_author_posts_url($user_info->ID)) . '"><img src="' . esc_url($profile_image) . '" alt="Profile Image" class="profile-pic" /></a>';
        } else {
            echo get_avatar($user_id, 50, '', 'Profile Image', array('extra_attr' => 'style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; object-fit: cover;"'));
        }

        echo '<div>';
        // echo '<p class="user-name">' . esc_html($user_info->display_name) . '</p>';
        echo '<p class="user-name"><a href="' . esc_url(get_author_posts_url($user_info->ID)) . '">' . esc_html($user_info->display_name) . '</a></p>';

        // echo '<p style="margin: 0;">' . esc_html($role_label) . '</p>';
        if ($is_verified == 'yes') {
            $user_details = '<p class="verified-txt"><span class="verified-icon"><svg aria-hidden="true" class="e-font-icon-svg e-fas-check" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg></span>  ';
            if($role_label == 'Admin'){
                $user_details .= '';
            }else{
                $user_details .= 'Verified ';
            }
            
            $user_details .= esc_html($role_label);
            $user_details .= '</p>';
            echo $user_details;
        }
        echo '</div></div>';

        return ob_get_clean();
    }
}

// Instantiate the plugin class
if (class_exists('IndianEmployeeProfile')) {
    $indian_employee_profile = new IndianEmployeeProfile();
}

// Register activation and deactivation hooks
register_activation_hook(__FILE__, ['IndianEmployeeProfile', 'add_custom_roles']);
register_deactivation_hook(__FILE__, ['IndianEmployeeProfile', 'remove_custom_roles']);

