<?php

/**
 * Template name: шаблон страницы о компании
 *
 */

get_header();
?>

<main>
    <?php if (have_rows('stranicza')): ?>
    <?php while (have_rows('stranicza')):
            the_row(); ?>
    <?php if (get_row_layout() == 'главный_блок'): ?>
    <section class="hero-services"
        style="background-image: linear-gradient(rgba(43, 60, 77, 0.74), rgba(43, 60, 77, 0.74)), url('<?php the_sub_field('fon_kartinka'); ?>'); ">
        <div class="container">
            <?php
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                        }
                        ?>
            <h1><?php the_title(); ?></h1>
        </div>
    </section>
    <?php elseif (get_row_layout() == 'о_компании_блок'): ?>
    <section class="section-about">
        <div class="container section-about__container">
            <article class="section-about__article">
                <h2><?php the_sub_field('zagolovok'); ?></h2>
                <p><?php the_sub_field('czitata'); ?></p>
            </article>
            <div class="section-about__content flex">
                <div class="section-about__text">
                    <p> <span>Computex </span>- <?php the_sub_field('tekst_o_kompanii'); ?></p>
                </div>
                <div class="section-about__number">
                    <?php if (have_rows('czifry_1')):
                                    while (have_rows('czifry_1')):
                                        the_row();
                                ?>
                    <div class="section-about__counter"> <span>+</span><span class="counter"
                            data-number="<?php the_sub_field('czifry'); ?>"><?php the_sub_field('czifry'); ?></span>
                        <p><?php the_sub_field('tekst'); ?></p>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if (have_rows('czifry_2')):
                                    while (have_rows('czifry_2')):
                                        the_row();
                                ?>
                    <div class="section-about__counter"> <span>></span><span class="counter"
                            data-number="<?php the_sub_field('czifry'); ?>"><?php the_sub_field('czifry'); ?></span>
                        <p><?php the_sub_field('tekst'); ?></p>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php elseif (get_row_layout() == 'наши_партнеры'): ?>
    <section class="section-partners">
        <div class="container section-partners__container">
            <h2><?php the_sub_field('zagolovok'); ?>
            </h2>
            <div class="section-partners__grid">
                <?php if (have_rows('logotipy')):
                                while (have_rows('logotipy')):
                                    the_row();
                            ?>
                <?php
                                    // Получаем данные изображения
                                    $image = get_sub_field('izobrazhenie');
                                    $image_url = $image['url']; // URL изображения
                                    $image_alt = $image['alt']; // ALT текст изображения
                                    ?>

                <div class="section-partners__block">
                    <img src=" <?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif;
        endwhile; ?>
    <?php endif; ?>
    <section class="services-section"
        style="background-image: linear-gradient(rgba(43, 60, 77, 0.89), rgba(43, 60, 77, 0.89)), url('<?php the_field('fon_dlya_uslug', 'option'); ?>');">
        <div class="container services-section__container flex">
            <?php if (have_rows('uslugi_blok', 'option')):
                while (have_rows('uslugi_blok', 'option')):
                    the_row();
                    $ssylka = get_sub_field('ssylka');
            ?>
            <div class="services-section__card"><span><?php the_sub_field('nomer'); ?></span>
                <h2><?php the_sub_field('zagolovok'); ?></h2>
                <p><?php the_sub_field('tekst'); ?></p>
                <a class="button-primary" href="<?php echo esc_url($ssylka['url']); ?>"
                    target="<?php echo esc_attr($ssylka['target']); ?>">
                    <?php echo esc_html($ssylka['title']); ?>
                </a>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php computex_cond_render_hits_slider(); ?>
</main><!-- #main -->

<?php
get_footer();