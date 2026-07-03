<?php
/**
 * Plugin Name: Hasu Soap Finder
 * Description: Asistente interactivo para recomendar jabones artesanales según tipo de piel y consumo de API.
 * Version: 1.0
 * Author: Ericka Flores
 */

defined('ABSPATH') || exit;


function hasu_enqueue_assets() {
    wp_enqueue_style(
        'hasu-style',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        [],
        '1.0'
    );

    wp_enqueue_script(
        'hasu-script',
        plugin_dir_url(__FILE__) . 'assets/js/script.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('hasu-script', 'hasu_ajax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'hasu_enqueue_assets');


function hasu_soap_finder_shortcode() {
    ob_start();
    ?>

    <div class="hasu-container">

        <h2> Encuentra tu jabón ideal</h2>

        <div class="hasu-form">

            <label>Tipo de piel</label>
            <select id="hasu-piel">
                <option value="seca">Seca</option>
                <option value="grasa">Grasa</option>
                <option value="mixta">Mixta</option>
                <option value="sensible">Sensible</option>
            </select>

            <label>Beneficio que buscas</label>
            <select id="hasu-beneficio">
                <option value="hidratacion">Hidratación</option>
                <option value="acne">Acné</option>
                <option value="exfoliacion">Exfoliación</option>
                <option value="manchas">Manchas</option>
            </select>

            <button id="hasu-buscar">Buscar recomendación</button>

        </div>

        <div id="hasu-resultado" class="hasu-resultado"></div>

    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('hasu_soap_finder', 'hasu_soap_finder_shortcode');



function hasu_get_recommendation() {

    $piel = sanitize_text_field($_POST['piel']);
    $beneficio = sanitize_text_field($_POST['beneficio']);

    // Recomendaciones
    $recomendaciones = [
        'seca' => [
            'hidratacion' => 'Avena y Miel',
            'acne' => 'Árbol de Té',
            'exfoliacion' => 'Coco',
            'manchas' => 'Lavanda'
        ],
        'grasa' => [
            'hidratacion' => 'Aloe Vera',
            'acne' => 'Árbol de Té',
            'exfoliacion' => 'Carbón Activado',
            'manchas' => 'Limón'
        ],
        'mixta' => [
            'hidratacion' => 'Aloe y Avena',
            'acne' => 'Lavanda',
            'exfoliacion' => 'Café',
            'manchas' => 'Cúrcuma'
        ],
        'sensible' => [
            'hidratacion' => 'Avena',
            'acne' => 'Manzanilla',
            'exfoliacion' => 'Caléndula',
            'manchas' => 'Lavanda'
        ]
    ];

    $ingrediente = $recomendaciones[$piel][$beneficio] ?? 'Avena';


    $beneficios = [

        'Avena y Miel' => [
            'Hidrata profundamente la piel.',
            'Alivia la resequedad.',
            'Suaviza la piel.',
            'Ideal para piel seca.'
        ],

        'Árbol de Té' => [
            'Ayuda a combatir el acné.',
            'Controla el exceso de grasa.',
            'Tiene propiedades antibacterianas.',
            'Purifica la piel.'
        ],

        'Coco' => [
            'Nutre la piel.',
            'Aporta hidratación.',
            'Deja la piel suave.',
            'Protege la barrera natural.'
        ],

        'Lavanda' => [
            'Calma la piel sensible.',
            'Reduce el enrojecimiento.',
            'Relaja la piel.',
            'Aporta un agradable aroma.'
        ],

        'Aloe Vera' => [
            'Hidrata profundamente.',
            'Favorece la regeneración de la piel.',
            'Calma irritaciones.',
            'Ideal para piel sensible.'
        ],

        'Carbón Activado' => [
            'Limpia profundamente los poros.',
            'Elimina impurezas.',
            'Controla la grasa.',
            'Deja la piel fresca.'
        ],

        'Limón' => [
            'Ayuda a iluminar la piel.',
            'Brinda sensación de frescura.',
            'Ayuda a controlar la grasa.',
            'Aporta vitamina C.'
        ],

        'Aloe y Avena' => [
            'Hidrata intensamente.',
            'Reduce la irritación.',
            'Suaviza la piel.',
            'Ideal para piel mixta.'
        ],

        'Café' => [
            'Exfolia suavemente.',
            'Estimula la circulación.',
            'Elimina células muertas.',
            'Deja la piel más suave.'
        ],

        'Cúrcuma' => [
            'Ayuda a mejorar el aspecto de manchas.',
            'Aporta antioxidantes.',
            'Favorece una piel luminosa.',
            'Contribuye a un tono uniforme.'
        ],

        'Avena' => [
            'Calma irritaciones.',
            'Hidrata la piel.',
            'Reduce la resequedad.',
            'Ideal para piel sensible.'
        ],

        'Manzanilla' => [
            'Disminuye la irritación.',
            'Calma la piel.',
            'Reduce el enrojecimiento.',
            'Ideal para piel delicada.'
        ],

        'Caléndula' => [
            'Favorece la regeneración.',
            'Calma la piel.',
            'Reduce la irritación.',
            'Protege la piel sensible.'
        ]

    ];

    $api_names = [
        'Avena y Miel' => 'Avena',
        'Árbol de Té' => 'Tea tree',
        'Coco' => 'Coco',
        'Lavanda' => 'Lavanda',
        'Aloe Vera' => 'Aloe vera',
        'Carbón Activado' => 'Carbón activado',
        'Limón' => 'Limón',
        'Aloe y Avena' => 'Aloe vera',
        'Café' => 'Café',
        'Cúrcuma' => 'Cúrcuma',
        'Avena' => 'Avena',
        'Manzanilla' => 'Manzanilla',
        'Caléndula' => 'Caléndula'
    ];

    $busqueda = $api_names[$ingrediente] ?? $ingrediente;

    $url = "https://es.wikipedia.org/api/rest_v1/page/summary/" . urlencode($busqueda);

    $descripcion = "No se encontró información para este ingrediente.";

    $response = wp_remote_get($url, [
        'timeout' => 20,
        'headers' => [
            'User-Agent' => 'Hasu Soap Finder'
        ]
    ]);

    if (!is_wp_error($response)) {

        if (wp_remote_retrieve_response_code($response) == 200) {

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (!empty($data['extract'])) {
                $descripcion = $data['extract'];
            }

        }

    }

    wp_send_json_success([
        'ingrediente' => $ingrediente,
        'descripcion' => $descripcion,
        'beneficios' => $beneficios[$ingrediente] ?? []
    ]);

}

add_action('wp_ajax_hasu_get_recommendation', 'hasu_get_recommendation');
add_action('wp_ajax_nopriv_hasu_get_recommendation', 'hasu_get_recommendation');

/**
 * Shortcode: Blog / Catálogo de jabones
 * Uso: [hasu_blog_jabones]
 */
function hasu_blog_jabones_shortcode() {

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'category_name'  => 'jabones',
        'post_status'    => 'publish'
    );

    $query = new WP_Query($args);

    ob_start();
    ?>

    <div class="hasu-blog-wrapper">
        <h2 class="hasu-blog-title">Nuestros jabones</h2>

        <div class="hasu-blog-grid">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <article class="hasu-blog-card">

                        <a href="<?php the_permalink(); ?>" class="hasu-blog-image-link">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'hasu-blog-image')); ?>
                            <?php else : ?>
                                <img class="hasu-blog-image" src="https://via.placeholder.com/600x400?text=Jab%C3%B3n" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </a>

                        <div class="hasu-blog-content">
                            <h3 class="hasu-blog-card-title"><?php the_title(); ?></h3>

                            <p class="hasu-blog-excerpt">
                                <?php
                                if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo wp_trim_words(get_the_content(), 20, '...');
                                }
                                ?>
                            </p>

                            <a class="hasu-blog-button" href="<?php the_permalink(); ?>">
                                Ver más
                            </a>
                        </div>

                    </article>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>

                <p class="hasu-blog-empty">No hay jabones publicados todavía.</p>

            <?php endif; ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('hasu_blog_jabones', 'hasu_blog_jabones_shortcode');