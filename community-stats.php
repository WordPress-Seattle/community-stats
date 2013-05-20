<?php
/*
Plugin Name: Community Stats
Plugin URI: 
Description: Utilizes the WordPress.org usernames in site user's profiles to build an overview of the WPSeattle contributions to the community
Version: 
Author: WordPress Seattle
Author URI: http://wpseattle.com
License: 
License URI: 
Text Domain: community-stats
*/

define( 'COMMUNITY_STATS_PLUGIN_DIR', trailingslashit( dirname( __FILE__) ) );
define( 'COMMUNITY_STATS_PLUGIN_URL', trailingslashit ( WP_PLUGIN_URL . "/" . basename( __DIR__  ) ) );



/**
 * @todo On activation force a refresh of transients to preheat caches 
 */





/**
 * Load libraries 
 */
require_once( 'lib/Interface.class.php' );
require_once( 'lib/Contributors.class.php' );

$cs_contributors = new CS_Contributors();



/**
 * Setup wp-cron object
 * 
 * Once per day it should run and forcibly refresh transients 
 */
