<?php
/**
 * Template single para mostrar el detalle de cada jabón
 */

get_header();
?>

<main class="hasu-single-wrapper">
    <div class="hasu-single-container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="hasu-single-card">

                <?php if (has_post_thumbnail()) : ?>
                    <div class="hasu-single-image-wrap">
                        <?php the_post_thumbnail('large', array('class' => 'hasu-single-image')); ?>
                    </div>
                <?php endif; ?>

                <div class="hasu-single-content">
                    <h1 class="hasu-single-title"><?php the_title(); ?></h1>

                    <div class="hasu-single-text">
                        <?php the_content(); ?>
                    </div>

                    <a class="hasu-single-back" href="<?php echo esc_url(home_url('/Nuestros jabones')); ?>">
                        Volver al blog
                    </a>
                </div>

            </article>

        <?php endwhile; endif; ?>

    </div>
</main>

<?php
get_footer();