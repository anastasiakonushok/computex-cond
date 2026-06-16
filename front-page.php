<?php

/**
 * Template name: Главная страница
 */

get_header('main'); ?>
<main class="main">
    <?php
    $computex_cond_hits_slider_rendered = false;
    $computex_cond_front_stranicza_id = function_exists('computex_cond_get_front_page_stranicza_post_id')
        ? computex_cond_get_front_page_stranicza_post_id()
        : (int) get_option('page_on_front');
    $computex_cond_front_has_hits_layout = function_exists('computex_cond_front_page_has_popular_products_layout')
        ? computex_cond_front_page_has_popular_products_layout($computex_cond_front_stranicza_id)
        : false;

    if ($computex_cond_front_stranicza_id && have_rows('stranicza', $computex_cond_front_stranicza_id)) :
        while (have_rows('stranicza', $computex_cond_front_stranicza_id)) :
            the_row();
    ?>
            <?php if (get_row_layout() == 'главный_блок'): ?>
                <section class="hero"
                    style="background-image: linear-gradient(rgb(19 21 23 / 53%), rgb(46 53 60 / 14%)), url('<?php the_sub_field('fon_izobrazhenie'); ?>'); ">
                    <div class="container hero__container">
                        <div class="hero__content">
                            <h1><?php the_sub_field('zagolovok'); ?></h1>
                            <h2><?php the_sub_field('podzagolovok'); ?></h2>
                            <p><?php the_sub_field('tekst'); ?></p>
                            <?php
                            $ssylka = get_sub_field('ssylka');
                            ?>
                            <a class="button-primary hero__catalog-btn" href="<?php echo esc_url($ssylka['url']); ?>"
                                target="<?php echo esc_attr($ssylka['target']); ?>">
                                <?php echo esc_html($ssylka['title']); ?>
                            </a>
                        </div>
                    </div>
                </section>
            <?php elseif (get_row_layout() == 'популярные_бренды'): ?>
                <section class="popular-brand">
                    <div class="popular-brand__container">
                        <div class="swiper swiper-brand-chanel">
                            <div class="swiper-wrapper">
                                <?php if (have_rows('logo_brenda', 'option')):
                                    while (have_rows('logo_brenda', 'option')):
                                        the_row();
                                        $logo = get_sub_field('foto');
                                ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                if (
                    !$computex_cond_front_has_hits_layout
                    && function_exists('computex_cond_render_front_page_hits_block')
                ) {
                    $computex_cond_hits_slider_rendered = computex_cond_render_front_page_hits_block();
                }
                ?>
            <?php elseif (get_row_layout() == 'популярные_товары') : ?>
                <?php
                if (function_exists('computex_cond_render_front_page_hits_block')) {
                    $computex_cond_hits_slider_rendered = computex_cond_render_front_page_hits_block();
                }
                ?>
                <?php get_template_part('template-parts/front', 'directions'); ?>
            <?php elseif (get_row_layout() == 'услуги') : ?>
                <section class="services-section services-section-main"
                    style="background-image: linear-gradient(rgba(43, 60, 77, 0.89), rgba(43, 60, 77, 0.89)), url('<?php the_field('fon_dlya_uslug', 'option'); ?>'); ">
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
            <?php elseif (get_row_layout() == 'лучшие_предложения'): ?>
                <section class="info-section info-section--offers">
                    <div class="container info-section__container">
                        <div class="info-section__grid">
                            <?php if (have_rows('blok_skidki')) : ?>
                                <?php while (have_rows('blok_skidki')) :
                                    the_row();
                                    $foto_sale = get_sub_field('izobrazhenie_sale');
                                    $link = get_sub_field('ssylka');
                                    $card_url = !empty($link['url']) ? $link['url'] : '#';
                                    $card_target = !empty($link['target']) ? $link['target'] : '_self';
                                    $fon_sale = get_sub_field('fon_izobrazhenie');
                                    $card_style = $fon_sale ? ' style="background-image: url(\'' . esc_url($fon_sale) . '\');"' : '';
                                ?>
                                    <a class="info-section__card info-section__card--1 info-section__card--sale" href="<?php echo esc_url($card_url); ?>"
                                        target="<?php echo esc_attr($card_target); ?>" <?php echo $card_style; ?>>
                                        <div class="info-section__body">
                                            <div class="info-section__content">
                                                <h2><?php echo esc_html(get_sub_field('zagolovok')); ?></h2>
                                                <p><?php echo esc_html(get_sub_field('tekst')); ?></p>
                                                <span class="info-offer-card__btn">Подробнее</span>
                                            </div>
                                            <?php if (!empty($foto_sale['url'])) : ?>
                                                <div class="info-section__media">
                                                    <img src="<?php echo esc_url($foto_sale['url']); ?>"
                                                        alt="<?php echo esc_attr($foto_sale['alt'] ?? ''); ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if (have_rows('blok_oplaty')) : ?>
                                <?php while (have_rows('blok_oplaty')) :
                                    the_row();
                                    $foto_sale = get_sub_field('izobrazhenie_oplat');
                                    $link = get_sub_field('ssylka');
                                    $card_url = !empty($link['url']) ? $link['url'] : '#';
                                    $card_target = !empty($link['target']) ? $link['target'] : '_self';
                                    $btn_label = !empty($link['title']) ? $link['title'] : 'Подробнее';
                                ?>
                                    <a class="info-section__card info-section__card--2 info-section__card--tall" href="<?php echo esc_url($card_url); ?>"
                                        target="<?php echo esc_attr($card_target); ?>">
                                        <div class="info-section__content computex-if-installment__content">
                                            <div class="computex-if-eyebrow computex-if-installment__badge"><span class="computex-if-pulse"></span> Рассрочка 0%</div>
                                            <h2><?php echo esc_html(get_sub_field('zagolovok')); ?></h2>
                                            <p><?php echo esc_html(get_sub_field('tekst')); ?></p>
                                        </div>
                                        <?php if (!empty($foto_sale['url'])) : ?>
                                            <div class="info-section__media info-section__media--center">
                                                <img src="<?php echo esc_url($foto_sale['url']); ?>"
                                                    alt="<?php echo esc_attr($foto_sale['alt'] ?? ''); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <span class="info-offer-card__btn"><?php echo esc_html($btn_label); ?></span>
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if (have_rows('blok_bolshih_ploshhadej')) : ?>
                                <?php while (have_rows('blok_bolshih_ploshhadej')) :
                                    the_row();
                                    $foto_sale = get_sub_field('izobrazhenie');
                                    $link = get_sub_field('ssylka');
                                    $card_url = !empty($link['url']) ? $link['url'] : '#';
                                    $card_target = !empty($link['target']) ? $link['target'] : '_self';
                                ?>
                                    <a class="info-section__card info-section__card--3" href="<?php echo esc_url($card_url); ?>"
                                        target="<?php echo esc_attr($card_target); ?>">
                                        <div class="info-section__body">
                                            <div class="info-section__content">
                                                <h2><?php echo esc_html(get_sub_field('zagolovok')); ?></h2>
                                                <p><?php echo esc_html(get_sub_field('tekst')); ?></p>
                                                <span class="info-offer-card__btn">Подробнее</span>
                                            </div>
                                            <?php if (!empty($foto_sale['url'])) : ?>
                                                <div class="info-section__media">
                                                    <img src="<?php echo esc_url($foto_sale['url']); ?>"
                                                        alt="<?php echo esc_attr($foto_sale['alt'] ?? ''); ?>">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
    <?php
        endwhile;
    endif;

    if (empty($computex_cond_hits_slider_rendered) && function_exists('computex_cond_render_front_page_hits_block')) {
        $computex_cond_hits_slider_rendered = computex_cond_render_front_page_hits_block();
    }

    do_action('computex_cond_front_page_before_news');
    ?>
    <section class="news">
        <div class="container news__container flex">
            <div class="news__info">
                <h2><?php the_field('zagolovok_novosti', 'option'); ?></h2>
                <p><?php the_field('tekst_novosti', 'option'); ?></p>
                <?php
                $link = get_field('ssylka_novosti', 'option');
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class="news__link" href="<?php echo esc_url($link_url); ?>"
                        target="<?php echo esc_attr($link_target); ?>">
                        <?php echo esc_html($link_title); ?>
                    </a>
                <?php endif; ?>
                <div class="news__nav flex">
                    <div class="swiper-news-prev swiper-nav-hover">
                        <svg width="55" height="55" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="65" height="65" rx="8" fill="currentColor"></rect>
                            <path
                                d="M36.5816 41.5816C36.0744 42.0888 35.2808 42.1349 34.7215 41.7199L34.5613 41.5816L25.9898 33.0102C25.4827 32.503 25.4366 31.7093 25.8515 31.1501L25.9899 30.9898L34.5613 22.4184C35.1192 21.8605 36.0237 21.8605 36.5816 22.4184C37.0888 22.9256 37.1349 23.7192 36.7199 24.2785L36.5816 24.4387L29.0203 32L36.5816 39.5613C37.1395 40.1192 37.1395 41.0237 36.5816 41.5816Z"
                                fill="white"></path>
                        </svg>
                    </div>
                    <div class="swiper-news-next swiper-nav-hover">
                        <svg width="55" height="55" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="65" height="65" rx="8" fill="currentColor"></rect>
                            <path
                                d="M28.4184 23.4184C28.9256 22.9112 29.7192 22.8651 30.2785 23.2801L30.4387 23.4184L39.0102 31.9898C39.5173 32.497 39.5634 33.2907 39.1485 33.8499L39.0102 34.0102L30.4387 42.5816C29.8808 43.1395 28.9763 43.1395 28.4184 42.5816C27.9112 42.0744 27.8651 41.2808 28.2801 40.7215L28.4184 40.5613L35.9797 33L28.4184 25.4387C27.8605 24.8808 27.8605 23.9763 28.4184 23.4184Z"
                                fill="white"></path>
                        </svg>
                    </div>
                    <div class="swiper-news-pagination"></div>
                </div>
            </div>
            <div class="swiper swiper-news">
                <div class="swiper-wrapper swiper-news__wrapp">
                    <?php
                    $posts = new WP_Query(
                        array(
                            'post_type' => 'post',
                            'posts_per_page' => 10
                        )
                    );
                    if ($posts->have_posts()): ?>
                        <?php while ($posts->have_posts()):
                            $posts->the_post(); ?>
                            <div class="swiper-slide swiper-news__slide">
                                <div class="news-single__content">
                                    <div class="info">
                                        <h3><?php the_title(); ?></h3>
                                        <span><?php echo get_the_date('j F Y'); ?></span>
                                    </div>
                                    <p><?php the_excerpt(); ?>
                                    </p>
                                    <a class="button-primary" href="<?php the_permalink(); ?>">Подробнее</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif;
                    wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer() ?>