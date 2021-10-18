<?php
/**
 * Plugin Name:     The Movie Db Data
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     the-movie-db-data
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         The_Movie_Db_Data
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

include (  __DIR__ . '/inc/the-movie-db/class-TheMovieDBQuery.php' );
include (  __DIR__ . '/inc/template-tags.php' );