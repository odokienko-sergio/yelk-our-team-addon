<?php
/**
 * Plugin Name: Yelk Our Team Addon
 * Description: Elementor addon for displaying team members.
 * Version:     1.0.0
 * Author:      Serhii Odokiienko
 * Author URI:  Your Website
 * Text Domain: yelk-our-team-addon
 */

if (!defined('ABSPATH')) {
	exit;
}

define('YELK_OT_VERSION', '1.0');
define('YELK_OT_PATH', plugin_dir_path(__FILE__));
define('YELK_OT_URL', plugin_dir_url(__FILE__));
define('YELK_OT_INC_PATH', YELK_OT_PATH . 'inc/');

require YELK_OT_PATH . 'inc/class-yelk-our-team-addon.php';

if (class_exists('Yelk_Our_Team_Addon')) {
	$our_team_addon = new Yelk_Our_Team_Addon();
	$our_team_addon->register();
}

register_activation_hook(
	__FILE__,
	array(
		$our_team_addon,
		'activation',
	)
);

register_deactivation_hook(
	__FILE__,
	array(
		$our_team_addon,
		'deactivation',
	)
);


