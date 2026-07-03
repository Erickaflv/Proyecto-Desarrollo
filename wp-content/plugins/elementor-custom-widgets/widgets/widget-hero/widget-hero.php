<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Elementor_Widget_Seccion_Hero extends Widget_Base {

    public function get_name() {
        return 'seccion_hero';
    }

    public function get_title() {
        return 'Sección Hero Horizontal';
    }

    public function get_icon() {
        return 'eicon-header';
    }

    public function get_categories() {
        return ['custom_widgets_category'];
    }

    protected function register_controls() {
        
        // --- SECCIÓN DE CONTENIDO ---
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Contenido',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'titulo',
            [
                'label' => 'Título Principal (H1)',
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Escribe el título aquí',
            ]
        );

        $this->add_control(
            'descripcion',
            [
                'label' => 'Descripción',
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'texto_boton',
            [
                'label' => 'Texto del Botón',
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Escribe el texto del botón aquí',

            ]
        );

        $this->add_control(
            'enlace_boton',
            [
                'label' => 'Enlace del Botón',
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://tudominio.com',
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'imagen',
            [
                'label' => 'Imagen Lateral',
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();


        // --- SECCIÓN DE ESTILOS ---
        $this->start_controls_section(
            'style_section',
            [
                'label' => 'Estilo',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_fondo_hero',
            [
                'label' => 'Color de Fondo del Hero',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contenedor-hero' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_titulo',
            [
                'label' => 'Color del Título',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-titulo' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_fondo_boton',
            [
                'label' => 'Color de Fondo del Botón',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-boton' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_texto_boton',
            [
                'label' => 'Color del Texto del Botón',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-boton' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Manejo nativo de Elementor para configurar atributos de enlaces externos/nofollow
        if ( ! empty( $settings['enlace_boton']['url'] ) ) {
            $this->add_link_attributes( 'boton_link', $settings['enlace_boton'] );
        }
        ?>
        
        <div class="contenedor-hero">
            <div class="hero-col-texto">
                <?php if ( ! empty( $settings['titulo'] ) ) : ?>
                    <h1 class="hero-titulo"><?php echo esc_html( $settings['titulo'] ); ?></h1>
                <?php endif; ?>

                <?php if ( ! empty( $settings['descripcion'] ) ) : ?>
                    <div class="hero-descripcion">
                        <?php echo wp_kses_post( $settings['descripcion'] ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $settings['texto_boton'] ) && ! empty( $settings['enlace_boton']['url'] ) ) : ?>
                    <a class="hero-boton" <?php echo $this->get_render_attribute_string( 'boton_link' ); ?>>
                        <?php echo esc_html( $settings['texto_boton'] ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="hero-col-imagen">
                <?php if ( ! empty( $settings['imagen']['url'] ) ) : ?>
                    <img src="<?php echo esc_url( $settings['imagen']['url'] ); ?>" alt="<?php echo esc_attr( $settings['titulo'] ); ?>" class="hero-img">
                <?php endif; ?>
            </div>
        </div>

        <style>
            .contenedor-hero {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 60px 40px;
                gap: 40px;
                width: fit-content;
                box-sizing: border-box;
            }

            .hero-col-texto {
                flex: 1;
                min-width: 300px;
            }

            .hero-col-imagen {
                flex: 1;
                min-width: 300px;
                display: flex;
                justify-content: center;
            }

            .hero-titulo {
                font-size: 3rem;
                margin-top: 0;
                margin-bottom: 20px;
                line-height: 1.2;
            }

            .hero-descripcion {
                font-size: 1.2rem;
                margin-bottom: 30px;
                line-height: 1.6;
            }

            .hero-boton {
                display: inline-block;
                padding: 14px 28px;
                font-size: 1rem;
                font-weight: 600;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .hero-boton:hover {
                transform: translateY(-2px);
            }

            .hero-img {
                width: 100%;
                max-width: 550px;
                height: auto;
                object-fit: cover;
                border-radius: 8px;
            }

            /* Responsive: Se apilan verticalmente en pantallas móviles */
            @media (max-width: 768px) {
                .contenedor-hero {
                    flex-direction: column-reverse;
                    text-align: center;
                    padding: 40px 20px;
                }
                .hero-titulo {
                    font-size: 2.2rem;
                }
            }
        </style>

        <?php
    }
}