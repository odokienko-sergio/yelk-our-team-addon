<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Elementor_Our_Team_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'our_team';
	}

	public function get_title()
	{
		return esc_html__('Our Team', 'yelk-our-team-addon');
	}

	public function get_icon()
	{
		return 'eicon-site-identity';
	}

	public function get_categories()
	{
		return ['test-plugin']; // Change this category as needed.
	}

	protected function _register_controls()
	{
		// Customize your widget controls here
		// ...

		// Example control:
		$this->add_control(
			'number_of_blocks',
			[
				'label' => esc_html__('Number of Blocks', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			]
		);
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Render your widget HTML here based on settings
		// ...

		// Example rendering:
		echo '<div class="our-team-widget">';
		echo '<h2>Our Team</h2>';

		for ($i = 1; $i <= $settings['number_of_blocks']; $i++) {
			echo '<div class="team-member">';
			echo '<img src="team-member-' . $i . '.jpg" alt="Team Member ' . $i . '">';
			echo '<p>Team Member ' . $i . '</p>';
			echo '</div>';
		}

		echo '</div>';
	}
}

