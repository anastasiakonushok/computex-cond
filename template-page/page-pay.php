<?php

/**
 * Template name: шаблон страницы оплата и гарантия
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
    <?php elseif (get_row_layout() == 'оплата_и_гарантия'): ?>
    <section class="services-tab">
        <div class="container">
            <div class="tabs">
                <ul class="tab-links">
                    <li class="active"><a href="#tab1">Оплата</a></li>
                    <li><a href="#tab2">Гарантия</a></li>
                    <li><a href="#tab3">Рассрочка</a></li>
                </ul>
                <div class="tab-content">
                    <?php if (have_rows('oplata')):
                                    while (have_rows('oplata')):
                                        the_row();
                                ?>
                    <div class="tab active inner-content" id="tab1">
                        <h2><?php the_sub_field('zagolovok'); ?></h2>
                        <div class="inner-content"><?php the_sub_field('tekst_o_oplate'); ?> </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if (have_rows('garantiya')):
                                    while (have_rows('garantiya')):
                                        the_row();
                                ?>
                    <div class="tab inner-content" id="tab2">
                        <h2><?php the_sub_field('zagolovok'); ?></h2>
                        <div class="inner-content"><?php the_sub_field('tekst_o_garantii'); ?> </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if (have_rows('rassrochka')):
                                    while (have_rows('rassrochka')):
                                        the_row();
                                ?>
                    <div class="tab inner-content" id="tab3">
                        <h2><?php the_sub_field('zagolovok'); ?></h2>
                        <div class="inner-content"><?php the_sub_field('tekst_o_rassrochke'); ?> </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
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
    <?php computex_cond_render_hits_slider_from_options(); ?>
</main><!-- #main -->

<?php
get_footer();