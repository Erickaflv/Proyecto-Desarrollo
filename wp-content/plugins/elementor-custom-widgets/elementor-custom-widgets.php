<?php
/**
 * Plugin Name:       Widgets de Elementor Personalizados
 * Description:       Agrega múltiples widgets avanzados al constructor de Elementor.
 * Version:           1.0.0
 * Author:            Raúl Venegas
 * Text Domain:       elementor-custom-widgets
 */
if ( ! defined( 'ABSPATH' ) ) { exit;}

final class Elementor_Custom_Widgets_Extension {
    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        // Registrar widgets al cargar Elementor
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
        // Registrar categoría personalizada en el panel lateral de Elementor
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_category' ] );
    }

    public function add_widget_category($elements_manager){
        $elements_manager->add_category(
            'custom_widgets_category',
            [
                'title' => 'Widgets Personalizados',
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function register_widgets( $widgets_manager ) {
        // Asegurarse de que Elementor esté activo
        if ( ! did_action( 'elementor/loaded' ) ) {
            return;
        }

        
        // Registrar cada widget personalizado 
        require_once __DIR__ . '/widgets/widget-hero/widget-hero.php';

        $widgets_manager->register( new \Elementor_Widget_Seccion_Hero() );

    }

}


add_action( 'plugins_loaded', function() {
    Elementor_Custom_Widgets_Extension::instance();
} );


