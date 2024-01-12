<?php

namespace WWPElementorBreadcrumbs;

/*
    Plugin Name: Breadcrumbs for Elementor
    Plugin URI: https://workingwithpixels.com/breadcrumbs-for-elementor
    Description: Allows you to easily add breadcrumbs using Elementor page builder.
    Version: 1.1
    Author: WWP
    Author URI: https://workingwithpixels.com/
    Copyright: WWP, 2019
    Text Domain: wwp-elementor-addons
*/

// If WordPress not installed, kill the page.
if (!function_exists('add_action'))
{
    die('WordPress not Installed');
}

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

if(!class_exists('WWP_ELEMENTOR_BREADCRUMBS'))
{
    class WWP_ELEMENTOR_BREADCRUMBS
    {
        private static $instance = null;

        public static function instance()
        {
            if(self::$instance == null)
            {
                self::$instance = new self;
            }

            return self::$instance;
        }

        function defines()
        {
            defined('wwp_elementor_breadcrumbs_name')  ||  define('wwp_elementor_breadcrumbs_name', 'Breadcrumbs for Elementor');
            defined('wwp_elementor_breadcrumbs_dir')  ||  define('wwp_elementor_breadcrumbs_dir', plugin_dir_path( __FILE__ ));
        }

        public function __construct()
        {
            $this->defines();

            add_action('plugins_loaded', [$this, 'init']);
            add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        }

        public function init()
        {
            if (!did_action('elementor/loaded'))
            {
                add_action('admin_notices', [$this, 'wwp_admin_notice_missing_elementor']);

                return;
            }

            add_action('init', [$this, 'register_wwp_elementor_breadcrumbs_styles']);
            add_action('wp_head', [$this, 'print_wwp_elementor_breadcrumbs_styles']);
            add_action('elementor/elements/categories_registered', [$this, 'add_wwp_elementor_category']);
        }

        public function add_wwp_elementor_category($elements_manager)
        {
            $elements_manager->add_category(
                'wwp-elements',
                [
                    'title' => 'WWP'
                ]
            );
        }

        public function register_wwp_elementor_breadcrumbs_styles()
        {
            wp_register_style('wwp-elementor-breadcrumbs', plugins_url('assets/css/wwp-elementor-breadcrumbs.css', __FILE__ ));
        }

        public function print_wwp_elementor_breadcrumbs_styles()
        {
            wp_print_styles('wwp-elementor-breadcrumbs');
        }

        private function include_widgets_files()
        {
            require_once(wwp_elementor_breadcrumbs_dir . 'widgets/DynamicBreadcrumbs.php');
            require_once(wwp_elementor_breadcrumbs_dir . 'widgets/StaticBreadcrumbs.php');
        }

        public static function wwp_elementor_hex_to_rgba($hex, $alpha = 1)
        {
            $hex = str_replace('#', '', $hex);

            $r = $g = $b = 0;

            switch(strlen($hex))
            {
                case 3:
                    list($r, $g, $b) = str_split($hex);
                    $r = hexdec($r.$r);
                    $g = hexdec($g.$g);
                    $b = hexdec($b.$b);
                    break;
                case 6:
                    list($r1, $r2, $g1, $g2, $b1, $b2) = str_split($hex);
                    $r = hexdec($r1.$r2);
                    $g = hexdec($g1.$g2);
                    $b = hexdec($b1.$b2);
                    break;
                default:
                    break;
            }

            return 'rgba('.$r.', '.$g.', '.$b.', '.$alpha.')';
        }

        public function register_widgets()
        {
            $this->include_widgets_files();

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\DynamicBreadcrumbs() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\StaticBreadcrumbs() );
        }

        public function wwp_admin_notice_missing_elementor()
        {
            if(isset($_GET['activate'])) unset($_GET['activate']);

            $message = sd_elementor_testimonials_name . ': Please check if Elementor plugin is active on your website.';

            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }
    }
}

WWP_ELEMENTOR_BREADCRUMBS::instance();