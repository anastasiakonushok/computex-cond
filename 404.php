<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package computex-cond
 */

get_header();
?>

<main>

    <section class="section-404">
        <div class="container flex section-404__container">
            <div class="section-404__card">
                <h1>404</h1>
                <p>Страница не найдена</p><a class="button-primary" href="<?php echo esc_url(home_url()); ?>">Главная
                    страница </a>
            </div>
        </div>
    </section>

    <?php computex_cond_maybe_render_hits_slider(); ?>

</main>

<?php
get_footer();