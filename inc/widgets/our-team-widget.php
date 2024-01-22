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
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'team_members',
			[
				'label'  => esc_html__('Team Members', 'yelk-our-team-addon'),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name'    => 'member_Image',
						'label'   => esc_html__('Choose Image', 'textdomain'),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'name'    => 'member_text',
						'label'   => esc_html__('Text', 'yelk-our-team-addon'),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__('Team Member', 'yelk-our-team-addon'),
					],
				],
				'default'     => [
					[
						'member_image' => '',
						'member_text'  => esc_html__('Team Member', 'yelk-our-team-addon'),
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
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'quantity',
			[
				'label'      => esc_html__('Quantity', 'yelk-our-team-addon'),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'default'    => 6,
				'selectors'  => [
					'{{WRAPPER}} .our-team-widget .team-row' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
				],
				'range'      => [
					'desktop' => [
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					],
					'tablet'  => [
						'min'  => 1,
						'max'  => 4,
						'step' => 1,
					],
					'mobile'  => [
						'min'  => 1,
						'max'  => 3,
						'step' => 1,
					],
				],
				'condition'  => [
					'quantity!' => '',
				],
				'render_type' => 'template',
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$quantity = $settings['quantity'];

		$tablet = isset($settings['tablet']) && $settings['tablet'] > 0 ? $settings['tablet'] : 4;
		$mobile = isset($settings['mobile']) && $settings['mobile'] > 0 ? $settings['mobile'] : 3;

		$inline_css = "
        .team-member {
            flex: 0 0 calc(16.666666666667% - 20px);
            margin: 10px;
        }

        @media (min-width: 992px) {
            .team-member {
                flex: 0 0 calc(" . (100 / $quantity) . "% - 20px);
                margin: 10px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .team-member {
                flex: 0 0 calc(" . (100 / $tablet) . "% - 20px);
                margin: 10px;
            }
        }

        @media (max-width: 767px) {
            .team-member {
                flex: 0 0 calc(" . (100 / $mobile) . "% - 20px);
                margin: 10px;
            }
        }
    ";

		echo '<style>' . $inline_css . '</style>';

		echo '<div class="our-team-widget">';

		echo '<div class="team-row" style="display: flex; flex-wrap: wrap;">';
		foreach ($settings['team_members'] as $index => $member) {
			echo '<div class="team-member">';

			echo '<img src="' . esc_url($member['member_Image']['url']) . '" alt="' . esc_attr($member['member_text']) . '">';
			echo '<p>' . esc_html($member['member_text']) . '</p>';
			echo '</div>';
		}
		echo '</div>';

		echo '</div>';
	}
}