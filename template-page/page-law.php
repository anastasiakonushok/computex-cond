<?php

/**
 * Template name: шаблон страницы юр лица
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
    <?php elseif (get_row_layout() == 'блок_с_текстом'): ?>
    <section class="services-text inner-content">
        <div class="container">
            <?php the_sub_field('tekst_s_opisaniem'); ?>
        </div>
    </section>
    <?php elseif (get_row_layout() == 'блок_с_картинкой'): ?>
    <section class="law-page">
        <div class="container flex law-page__container">
            <div class="law-page__img">
                <?php
                            $image = get_sub_field('izobrazhenie'); // Получаем данные изображения

                            if (!empty($image)): // Проверяем, есть ли изображение
                                $image_url = esc_url($image['url']); // URL изображения
                                $image_alt = esc_attr($image['alt']); // Текст для атрибута alt
                            ?>
                <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                <?php else: ?>
                <img src="./img/law-img.png" alt="">
                <?php endif; ?>
            </div>
            <div class="law-page__content inner-content">
                <?php the_sub_field('tekst_s_opisaniem'); ?>
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