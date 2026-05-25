<?php
get_header();
?>

<div class="main-wrapper">
    <main class="site-main">
        <section class="section-breadcrumb-black">
            <div class="container">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </section>
        <section class="news-single-page inner-content">
            <div class="container">
                <?php
                if (is_singular()):
                    the_title('<h1 class="entry-title">', '</h1>');
                else:
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                endif;
                ?>
                <?php the_content(); ?>
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
    </main><!-- #main -->

    <?php get_footer(); ?>
</div><!-- .main-wrapper -->