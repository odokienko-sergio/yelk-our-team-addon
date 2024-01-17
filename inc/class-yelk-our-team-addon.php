<?php
if (!class_exists('Yelk_Our_Team_Addon')) {
	class Yelk_Our_Team_Addon
	{
		public function register()
		{
			add_action(
				'elementor/widgets/widgets_registered',
				array($this, 'register_our_team_widget')
			);
		}

		public function activation()
		{
			flush_rewrite_rules();
		}

		public function deactivation()
		{
			flush_rewrite_rules();
		}

		public function register_our_team_widget()
		{
			// Include the widget file
			require_once(YELK_OT_INC_PATH . 'widgets/our-team-widget.php');

			// Register the widget
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Our_Team_Widget());
		}
	}
}

