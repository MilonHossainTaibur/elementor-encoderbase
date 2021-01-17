<?php


class BasicElementWidget_Development
{

	private static $instance = null;

	public static function get_instance()
	{
		if (!self::$instance)
			self::$instance = new self;
		return self::$instance;
	}

	public function init()
	{
		add_action('elementor/widgets/widgets_registered', array($this, 'elementorwidgets_registered'));
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
	}
	
	public function widget_styles(){
		wp_register_style( 'widgettes', plugins_url( 'css/widgettest.css', __FILE__ ) );
	}

	public function elementorwidgets_registered()
	{
 
      // We check if the Elementor plugin has been installed / activated.
		if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
 
         // We look for any theme overrides for this custom Elementor element.
         // If no theme overrides are found we use the default one in this plugin.

			$widget_file = get_template_directory() . '/widgets/test-widget.php';
			$template_file = locate_template($widget_file);
			if (!$template_file || !is_readable($template_file)) {
				$template_file = get_template_directory() . '/widgets/test-widget.php';
			}
			if ($template_file && is_readable($template_file)) {
				require_once $template_file;
			}
		}
	}
}

BasicElementWidget_Development::get_instance()->init();
