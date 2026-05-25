<?php
/**
 * Блок контактов (жёлтая полоса): адрес, телефон, время, соцсети.
 *
 * @package computex-cond
 *
 * @var array $args {
 *     @type bool $show_map      Показывать #map (по умолчанию true).
 *     @type bool $wrap_section  Оборачивать в <section class="map-section"> (по умолчанию true).
 * }
 */

$show_map = !isset($args['show_map']) || $args['show_map'];
$wrap_section = !isset($args['wrap_section']) || $args['wrap_section'];

if ($wrap_section) {
    echo '<section class="map-section">';
}
if ($show_map) {
    echo '<div id="map"></div>';
}
?>
        <div class="map-section__wrapp">
            <div class="container map-section__container">
                <div class="map-section__info flex">
                    <div class="map-section__card">
                        <h3>Адрес</h3>
                        <?php
                        $adres = get_field('adres', 'option');

                        if ($adres) {
                            $url = esc_url($adres['url']);
                            $title = esc_html($adres['title']);
                            $target = !empty($adres['target']) ? esc_attr($adres['target']) : '_self';
                            echo '<a class="map-section__local flex map-section__row" href="' . $url . '" target="' . $target . '">';
                            echo '<span class="icon flex map-section__icon">' . computex_cond_map_section_icon('location') . '</span>';
                            echo '<span class="text">' . $title . '</span>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                    <div class="map-section__card">
                        <h3>Телефоны</h3>
                        <div class="map-section__phons flex">
                            <?php
                            $telefon = get_field('telefon', 'option');
                            if ($telefon) :
                                ?>
                            <a href="tel:<?php echo esc_attr($telefon); ?>"
                                class="map-section__phon flex map-section__row">
                                <span class="icon flex map-section__icon"><?php echo computex_cond_map_section_icon('phone'); ?></span>
                                <span class="text"><?php echo esc_html($telefon); ?></span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="map-section__card">
                        <h3>Время работы</h3>
                        <div class="map-section__time flex map-section__row">
                            <span class="icon flex map-section__icon"><?php echo computex_cond_map_section_icon('clock'); ?></span>
                            <?php
                            $work_hours = get_field('raspisanie_raboty', 'option');
                            if ($work_hours) {
                                echo '<span class="text">' . wp_kses_post($work_hours) . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php get_template_part('template-parts/map-section', 'social'); ?>
                </div>
            </div>
        </div>
<?php
if ($wrap_section) {
    echo '</section>';
}
