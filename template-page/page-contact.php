<?php

/** * Template name: шаблон страницы контактов 
 * */
get_header(); ?>

<main class="main">
    <section class="hero-services"
        style="background-image: linear-gradient(rgba(43, 60, 77, 0.74), rgba(43, 60, 77, 0.74)), url('<?php the_field('fon_kartinka'); ?>'); ">
        <div class="container">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
            <h1><?php the_title(); ?></h1>
        </div>
    </section>
    <section class="contact-section">
        <div class="container contact-section__container">
            <div class="contact-section__wrapp flex">
                <div class="contact-section__info flex">
                    <div class="contact-section__card">
                        <h3>Адрес</h3>
                        <?php
                        $adres = get_field('adres', 'option');

                        if ($adres) {
                            $url = esc_url($adres['url']);
                            $title = esc_html($adres['title']);
                            $target = !empty($adres['target']) ? esc_attr($adres['target']) : '_self';
                            echo '<a class="contact-section__local flex contact-section__row" href="' . $url . '" target="' . $target . '">';
                            echo '<span class="icon flex">' . computex_cond_map_section_icon('location') . '</span>';
                            echo '<span class="text">' . $title . '</span>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                    <div class="contact-section__card">
                        <h3>Телефоны</h3>
                        <div class="contact-section__phons flex">
                            <?php
                            $telefon = get_field('telefon', 'option');
                            if ($telefon) :
                                ?>
                            <a href="tel:<?php echo esc_attr($telefon); ?>" class="contact-section__phon flex contact-section__row">
                                <span class="icon flex"><?php echo computex_cond_map_section_icon('phone'); ?></span>
                                <span class="text"><?php echo esc_html($telefon); ?></span>
                            </a>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <div class="contact-section__card">
                        <h3>Время работы</h3>
                        <div class="contact-section__time flex contact-section__row">
                            <span class="icon flex"><?php echo computex_cond_map_section_icon('clock'); ?></span>
                            <?php
                            $work_hours = get_field('raspisanie_raboty', 'option');

                            if ($work_hours) {
                                echo '<span class="text">' . wp_kses_post($work_hours) . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="conatact-section__card"> </div>
                </div>
                <div class="contact-section__info flex">
                    <div class="conatact-section__card">
                        <h3>Почта </h3>

                        <div class="flex contact-section__row">
                            <?php
                            $mail = get_field('pochta', 'option');
                            if ($mail) :
                                ?>
                            <a class="contact-section__phon flex contact-section__row" href="mailto:<?php echo esc_attr($mail); ?>">
                                <span class="icon flex"><?php echo computex_cond_map_section_icon('mail'); ?></span>
                                <span class="text"><?php echo esc_html($mail); ?></span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="conatact-section__card">
                        <h3>Реквизиты </h3>
                        <div class="flex contact-section__row">
                            <span class="icon flex"><?php echo computex_cond_map_section_icon('doc'); ?></span>
                            <?php
                            $rekvizity = get_field('rekvizity_kompanii', 'option');
                            if ($rekvizity) {
                                echo '<span class="text">' . wp_kses_post($rekvizity) . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="contact-section__card">
                        <h3>Соцсети</h3>
                        <?php
                        get_template_part(
                            'template-parts/map-section',
                            'social',
                            array(
                                'wrap_card' => false,
                                'social_class' => 'contact-section__social map-section__social',
                                'socials_class' => 'contact-section__socials',
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
</main>

<?php
get_footer();
