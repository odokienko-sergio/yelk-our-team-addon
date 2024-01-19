<?php
if (!defined('ABSPATH')) {
	exit;
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
		return ['test-plugin'];
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Our Team Items', 'yelk-our-team-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'team_members',
			[
				'label' => esc_html__('Team Members', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'member_Image',
						'label' => esc_html__( 'Choose Image', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' => 'member_text',
						'label' => esc_html__('Text', 'yelk-our-team-addon'),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__('Team Member', 'yelk-our-team-addon'),
					],
				],
				'default' => [
					[
						'member_image' => '',
						'member_text' => esc_html__('Team Member', 'yelk-our-team-addon'),
					],
				],
				'title_field' => '{{{ member_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style', 'yelk-our-team-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_of_blocks',
			[
				'label' => esc_html__('Number of Blocks', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
			]
		);

		$this->add_control(
			'blocks_per_row_desktop',
			[
				'label' => esc_html__('Blocks Per Row (Desktop)', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->add_control(
			'blocks_per_row_tablet',
			[
				'label' => esc_html__('Blocks Per Row (Tablet)', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'blocks_per_row_mobile',
			[
				'label' => esc_html__('Blocks Per Row (Mobile)', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2,
			]
		);

		$this->add_control(
			'use_slider',
			[
				'label' => esc_html__('Use Slider', 'yelk-our-team-addon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'yelk-our-team-addon'),
				'label_off' => esc_html__('No', 'yelk-our-team-addon'),
				'default' => 'no',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="our-team-widget">';

		echo '<div class="team-row">';
		foreach ($settings['team_members'] as $member) {
			echo '<div class="team-member">';

			echo '<img src="' . esc_url($member['member_Image']['url']) . '" alt="' . esc_attr($member['member_text']) . '">';
			echo '<p>' . esc_html($member['member_text']) . '</p>';
			echo '</div>';
		}
		echo '</div>';

		echo '</div>';
	}

}
