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
        <?php
        if (function_exists('computex_cond_render_hits_slider_from_options')) {
            computex_cond_render_hits_slider_from_options();
        }
        ?>
    </main><!-- #main -->

    <?php get_footer(); ?>
</div><!-- .main-wrapper -->