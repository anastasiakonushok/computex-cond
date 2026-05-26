<?php

/**
 * Template name: шаблон страницы услуг
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
                <section class="services-img services-img--styled-panel">
                    <div class="container flex services-img__container">
                        <div class="services-img__img">
                            <?php
                            $image = get_sub_field('izobrazhenie');

                            if (!empty($image)) {
                                $image_url = esc_url($image['url']);
                                $image_alt = esc_attr($image['alt']);
                                ?>
                                <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                            <?php } else { ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/law-img.png'); ?>" alt="">
                            <?php } ?>
                        </div>
                        <div class="services-img__content services-img__content--styled computex-if-warranty computex-if-warranty--compact inner-content">
                            <div class="computex-if-warranty__content">
                                <div class="computex-if-eyebrow computex-if-warranty__badge">
                                    <span class="computex-if-pulse"></span> Гарантия 3 года
                                </div>
                                <?php
                                echo computex_cond_format_services_checklist_html(
                                    (string) get_sub_field('tekst_s_opisaniem'),
                                    'services-img__list'
                                ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php elseif (get_row_layout() == 'блок_с_ценой'): ?>
                <section class="services-price">
                    <div class="container">
                        <h2><?php the_sub_field('zagolovok'); ?></h2>
                        <p class="services-price__text"><?php the_sub_field('tekst_opisanie_o_czene'); ?></p>
                        <div class="services-price__table">
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <td>Услуга</td>
                                        <td>Цена</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (have_rows('tablicza_s_czenami')):
                                        while (have_rows('tablicza_s_czenami')):
                                            the_row();
                                            ?>
                                            <tr>
                                                <td><?php the_sub_field('usluga'); ?></td>
                                                <td><?php the_sub_field('czena'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            <?php elseif (get_row_layout() == 'блок_с_популярными_вопросами'): ?>
                <section class="reference">
                    <div class="container">
                        <h2><?php the_sub_field('zagolovok'); ?></h2>
                        <div class="accordion-wrapp">
                            <?php if (have_rows('voprosy')):
                                while (have_rows('voprosy')):
                                    the_row();
                                    ?>
                                    <div class="accordion">
                                        <div class="accordion__title">
                                            <h3><?php the_sub_field('vopros'); ?></h3>
                                        </div>
                                        <div class="accordion__body inner-content">
                                            <?php the_sub_field('otvet_na_vopros'); ?>
                                        </div>
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
    <?php computex_cond_render_hits_slider_from_options(); ?>
</main><!-- #main -->

<?php
get_footer();
