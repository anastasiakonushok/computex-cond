<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package computex-cond
 */

?>

<footer class="footer">
	<?php computex_cond_render_map_section_contacts(); ?>
    <div class="container footer__container">
        <div class="footer__wrapp flex">
            <nav class="nav-footer">
                <h3>Информация </h3>
                <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'Меню информации',
                            'container' => '',
                            'theme_location' => 'Info',
                            'items_wrap' => '<ul>%3$s</ul>',
                        )
                    );
                    ?>
            </nav>
            <div class="footer__contact nav-footer">
                <h3>Остальные направления</h3>
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'Меню остальных услуг',
                        'container' => '',
                        'theme_location' => 'Second',
                        'items_wrap' => '<ul>%3$s</ul>',
                    )
                );
                ?>
            </div>
            <nav class="nav-footer">
                <h3>Услуги</h3>
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'Меню услуг',
                        'container' => '',
                        'theme_location' => 'Catalog',
                        'items_wrap' => '<ul>%3$s</ul>',
                    )
                );
                ?>
            </nav>
        </div>
        <div class="button-up">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.2929 4.29289C11.6834 3.90237 12.3166 3.90237 12.7071 4.29289L18.7071 10.2929C19.0976 10.6834 19.0976 11.3166 18.7071 11.7071C18.3166 12.0976 17.6834 12.0976 17.2929 11.7071L13 7.41421V19C13 19.5523 12.5523 20 12 20C11.4477 20 11 19.5523 11 19V7.41421L6.70711 11.7071C6.31658 12.0976 5.68342 12.0976 5.29289 11.7071C4.90237 11.3166 4.90237 10.6834 5.29289 10.2929L11.2929 4.29289Z"
                    fill="currentColor" />
            </svg>
        </div>
        <div class="footer__copyright">
            <p>
                <?php the_field('kopirajt','option'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>