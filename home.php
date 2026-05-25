<?php

/**
 * Template name: Страница всех новостей
 */
get_header(); ?>
<div class="main-wrapper">
    <main class="site-main">
        <section class="section-breadcrumb-black">
            <div class="container">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
				<h1>
					Новости и статьи компании
				</h1>
            </div>
        </section>
        <section class="section-all-news">
            <div class="container section-all-news__grid">
                <?php
                global $post;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => '100',
                    'posts_per_archive_page' => '100',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => $paged
                );
                $query = new WP_Query($args);
                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post(); ?>
                <div class="news-single__content section-all-news__content">
                    <div class="info">
                        <h3><?php the_title(); ?></h3><span><?php echo get_the_date('j F Y'); ?></span>
                    </div>
                    <p><?php the_excerpt(); ?></p><a class="button-primary" href="<?php the_permalink(); ?>">Подробнее
                    </a>
                </div>
                <?php endwhile; ?>
                <?php endif;
                ?>
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
</div>
<?php get_footer() ?>