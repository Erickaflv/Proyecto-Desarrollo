<?php
/**
 * Plugin Name: Mi Bloque Gutenberg Demo
 * Description: Un plugin demostrativo que añade un bloque simple a Gutenberg.
 * Version: 1.0
 * Author: Alejandro Ulate
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function cargar_scripts_mi_bloque() {
    // Registramos y cargamos el archivo JavaScript del bloque
    wp_enqueue_script(
        'mi-bloque-script',
        plugins_url( 'bloque.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' ), // Dependencias clave de Gutenberg
        '1.0',
        true
    );
}


add_action( 'enqueue_block_editor_assets', 'cargar_scripts_mi_bloque' );