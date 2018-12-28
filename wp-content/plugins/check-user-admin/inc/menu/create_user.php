<?php

add_action( 'admin_menu', 'my_remove_menu_pages', 999 );

function my_remove_menu_pages() {
    /*remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings
    remove_menu_page( 'plugins.php' );*/
};

// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

    //create new top-level menu
    $link_our_new_CPT = 'edit.php?post_type=user_admin_post_type';
    add_menu_page('User Manager',
        'User Manager',
        'administrator',
        'user_admin',
        'function_user_admin',
        'dashicons-admin-users'
    );

    //Create user

    add_submenu_page(
        'user_admin',
        'Create User',
        'Create User',
        'administrator',
        'user_admin_create_user',
        'func_user_option_page'
    );

    //call register settings function
    add_action( 'admin_init', 'update_option_page' );
}

function function_user_admin(){
    if ( $users = get_users( array(
        'orderby'             => 'nicename',
        'order'               => 'ASC',
        'has_published_posts' => array( 'post' ),
        'blog_id'             => absint( get_current_blog_id() )
    ) ) ) {
        print_r( $users );
    }
}


function update_option_page() {
    //register our settings
    register_setting( 'baw-settings-group', 'new_option_name' );
    register_setting( 'baw-settings-group', 'some_other_option' );
    register_setting( 'baw-settings-group', 'option_etc' );
}


function func_user_option_page() {
    $role = get_role( 'administrator' );
    $role->add_cap( 'edit_advanced_travel_settings' );
    var_dump($role);
    ?>
    <div class="wrap">
        <h2>Your Plugin Name</h2>

        <form method="post" action="options.php">
            <?php settings_fields( 'baw-settings-group' ); ?>
            <?php do_settings_sections( 'baw-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">New Option Name</th>
                    <td><input type="text" name="new_option_name" value="<?php echo get_option('new_option_name'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Some Other Option</th>
                    <td><input type="text" name="some_other_option" value="<?php echo get_option('some_other_option'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Options, Etc.</th>
                    <td><input type="text" name="option_etc" value="<?php echo get_option('option_etc'); ?>" /></td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>
<?php }