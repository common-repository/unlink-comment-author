<?php

/**
 * Plugin Name:         Unlink Comment Author - Disable Author Link from Comments
 * Plugin URI:          https://wordpress.org/plugins/unlink-comment-author
 * Description:         Unlink the author link from comments.
 * Version:             1.3.2
 * Requires at least:   4.4
 * Requires PHP:        7.0
 * Tested up to:        6.4.2
 * Author:              Ranzuni
 * Author URI:          https://profiles.wordpress.org/ranzuni/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         unlink-comment-author
 * Domain Path:         /languages
 */

/**
 * Unlink Comment Author is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation, either version 3 of the License, or (at your 
 * option) any later version.
 * 
 * Unlink Comment Author is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for 
 * more details.
 * 
 * You should have received a copy of the GNU General Public License along with 
 * this program.  If not, see <https://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load the text-domain
function unlink_comment_author_load_textdomain() {
    load_plugin_textdomain( 'unlink-comment-author', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'unlink_comment_author_load_textdomain' );

function unlink_comment_author_option_page() {

    add_menu_page( 'Hide Comment Author Link Option', 'Hide Comment Author Links', 'manage_options', 'unlink-comment-author', 'unlink_comment_author_create_page', 'dashicons-admin-plugins', 101 );
}
add_action( 'admin_menu', 'unlink_comment_author_option_page' );

function unlink_comment_author_style_settings() {

    wp_enqueue_style( 'unlink-comment-author-settings', plugins_url( 'css/unlink-comment-author-settings.css', __FILE__ ), false, "1.0.0" );
}
add_action( 'admin_enqueue_scripts', 'unlink_comment_author_style_settings' );

function unlink_comment_author_create_page() {
    ?>
    <div class="unlink_comment_author_main">
        <div class="unlink_comment_author_body unlink_comment_author_common">
            <h1 id="page-title"><?php esc_attr_e( 'Settings', 'unlink-comment-author' ); ?></h1>
            <form action="options.php" method="post">
                <?php wp_nonce_field( 'update-options' ); ?>

                <!-- Hide Titles -->
                <label for="unlink-comment-author-option"><?php esc_attr_e( 'Hide Comment Author Links Option', 'unlink-comment-author' ); ?></label>

                <label class="radios">
                    <input type="radio" name="unlink-comment-author-option" id="unlink-comment-author-option-no" value="no" <?php if( get_option( 'unlink-comment-author-option' ) == 'no' ) { echo 'checked="checked"'; } ?>>
                    <span><?php _e( 'Don\'t Hide Comment Author Links', 'unlink-comment-author' ); ?></span>
                </label>

                <label class="radios">
                    <input type="radio" name="unlink-comment-author-option" id="unlink-comment-author-option-yes" value="yes" <?php if( get_option( 'unlink-comment-author-option' ) == 'yes' ) { echo 'checked="checked"'; } ?>>
                    <span><?php _e( 'Hide Comment Author Links', 'unlink-comment-author' ); ?></span>
                </label>

                <!--  -->
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="unlink-comment-author-option">
                <br>
                <input class="button button-primary" type="submit" name="submit" value="<?php _e( 'Save Changes', 'unlink-comment-author' ) ?>">
            </form>
        </div>
        <div class="unlink_comment_author_aside unlink_comment_author_common">
            <!-- about plugin author -->
            <h2 class="aside-title"><?php esc_attr_e( 'About Plugin Author', 'unlink-comment-author' ); ?></h2>
            <div class="author-card">
                <a class="link" href="https://profiles.wordpress.org/mehrazmorshed/" target="_blank">
                    <img class="center" src="<?php print plugin_dir_url( __FILE__ ) . '/img/author.png'; ?>" width="128px">
                    <h3 class="author-title"><?php esc_attr_e( 'Mehraz Morshed', 'unlink-comment-author' ); ?></h3>
                    <h4 class="author-title"><?php esc_attr_e( 'WordPress Developer', 'unlink-comment-author' ); ?></h4>
                </a>
                <h1 class="author-title">
                    <a class="link" href="https://www.facebook.com/mehrazmorshed" target="_blank"><span class="dashicons dashicons-facebook"></span></a>
                    <a class="link" href="https://twitter.com/mehrazmorshed" target="_blank"><span class="dashicons dashicons-twitter"></span></a>
                    <a class="link" href="https://www.linkedin.com/in/mehrazmorshed" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>
                    <a class="link" href="https://www.youtube.com/@mehrazmorshed" target="_blank"><span class="dashicons dashicons-youtube"></span></a>
                </h1>
            </div>
            <!-- other useful plugins -->
            <h3 class="aside-title"><?php esc_attr_e( 'Other Useful Plugins', 'unlink-comment-author' ); ?></h3>
            <div class="author-card">
                <a class="link" href="https://wordpress.org/plugins/turn-off-comments/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Turn Off Comments', 'unlink-comment-author' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/hide-admin-navbar/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Hide Admin Navbar', 'unlink-comment-author' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/tap-to-top/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Tap To Top', 'unlink-comment-author' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/customized-login/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Custom Login Page', 'unlink-comment-author' ) ?></b>
                </a>
            </div>
            <!-- donate to this plugin -->
            <h3 class="aside-title"><?php esc_attr_e( 'Hide Comment Author Links', 'unlink-comment-author' ); ?></h3>
            <a class="link" href="https://www.buymeacoffee.com/mehrazmorshed" target="_blank">
                <button class="button button-primary btn"><?php esc_attr_e( 'Donate To This Plugin', 'unlink-comment-author' ); ?></button>
            </a>
        </div>
    </div>
    
    <?php
}

/****/

if( get_option( 'unlink-comment-author-option' ) == 'yes' ) {

    if( !function_exists( 'disable_comment_author_links' )){

        function disable_comment_author_links( $author_link ){

            return strip_tags( $author_link );
        }

        add_filter( 'get_comment_author_link', 'disable_comment_author_links' );
    }

    if( !function_exists( 'hide_comment_author_links' )) {

        function hide_comment_author_links() {
            ?>
            <style>
                div.wp-block-comment-author-name a {
                    color: currentColor;
                    cursor: not-allowed;
                    pointer-events: none;
                    text-decoration: none;
                }
            </style>
            <?php
        }
        add_action( 'wp_head', 'hide_comment_author_links' );
    }
}

/****/

function unlink_comment_author_plugin_activation() {

    add_option( 'unlink_comment_author_plugin_do_activation_redirect', true );
}
register_activation_hook( __FILE__, 'unlink_comment_author_plugin_activation' );

function unlink_comment_author_plugin_redirect() {

    if( get_option( 'unlink_comment_author_plugin_do_activation_redirect', false ) ) {

        delete_option( 'unlink_comment_author_plugin_do_activation_redirect' );

        if ( !isset( $_GET['active-multi'] ) ) {

            wp_safe_redirect( admin_url( 'admin.php?page=unlink-comment-author' ) );
            exit;
        }
    }
}
add_action( 'admin_init', 'unlink_comment_author_plugin_redirect' );
