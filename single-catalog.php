<?php

/**
 * шаблон страница товара
 *
 */

get_header();
?>

<main>
    <main class="main">
        <section class="section-breadcrumb-black">
            <div class="container">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </section>
        <section class="catalog-single">
            <div class="container catalog-single__container">
                <div class="catalog-single__body flex">
                    <a class="catalog-single__img"
                        href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" data-fancybox>
                        <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('full'); ?>
                        <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/img-card.jpg" alt="">
                        <?php endif; ?>
                    </a>
                    <div class="catalog-single__content">
                        <h1><?php the_title(); ?></h1>
                        <div class="catalog-single__price flex">
                            <span class="price"><?php echo esc_html(get_post_meta(get_the_ID(), 'czena', true)); ?>
                                BYN</span>
                            <?php
                            $link = get_field('ssylka_na_straniczu_kontaktov', 'option');
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button-primary" href="<?php echo esc_url($link_url); ?>"
                                target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($link_title); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <a class="all-desc" href="#info">Все
                            характеристики</a>
                        <div class="inner-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="catalog-single__block flex" id="info">
                    <div class="catalog-single__description">
                        <ul class="tab-links flex">
                            <li class="active"><a href="#tab1">Характеристики</a></li>
                            <li><a href="#tab2">О производителе</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab active" id="tab1">
                                <h3>Характеристики</h3>
                                <div class=" catalog-single__table">
                                    <table>
                                        <tbody>
                                            <?php if (have_rows('harakteristiki')): ?>
                                            <?php while (have_rows('harakteristiki')):
                                                    the_row(); ?>
                                            <tr>
                                                <td><?php echo esc_html(get_sub_field('nazvanie')); ?>: </td>
                                                <td><?php echo esc_html(get_sub_field('svojstvo')); ?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab" id="tab2">
                                <?php
                                // Получаем выбранный бренд
                                $selected_brand = get_field('brand_selection');

                                // Проверяем и удаляем лишние пробелы (на всякий случай)
                                $selected_brand = trim($selected_brand);

                                // Подтягиваем описание бренда из ACF Options
                                $description = '';

                                if ($selected_brand === 'LG') {
                                    $description = get_field('lg_opisanie', 'option');
                                } elseif ($selected_brand === 'AlpicAir') {
                                    $description = get_field('alpicair_opisanie', 'option');
                                } elseif ($selected_brand === 'Gree') {
                                    $description = get_field('gree_opisanie', 'option');
                                } elseif ($selected_brand === 'Ultima') {
                                    $description = get_field('ultima_opisanie', 'option');
                                } elseif ($selected_brand === 'General') {
                                    $description = get_field('general_opisanie', 'option');
                                }
								elseif ($selected_brand === 'TLC') {
                                    $description = get_field('tlc_opisanie', 'option');
                                }

                                // Выводим описание на странице
                                if ($description) {
                                    echo '<div class="inner-content">' . $description . '</div>';
                                } else {
                                    echo '<p>Описание бренда не найдено.</p>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="catalog-single__info guarantee">
                        <div class="guarantee__block flex">
                            <div class="guarantee__row flex">
                                <svg width="60" height="60" viewBox="0 0 80 80" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="80" height="80" rx="40" fill="#35495F" />
                                    <g clip-path="url(#clip0_416_4323)">
                                        <path
                                            d="M37.945 53.1523C36.1907 54.7735 33.7643 55.1365 31.6122 54.1003C30.8342 53.7256 30.1776 53.2083 29.6636 52.5887L26.7333 59.0701C26.6 59.365 26.7488 59.5872 26.819 59.6691C26.8891 59.7508 27.0861 59.9318 27.3977 59.8451L29.531 59.2513C29.7741 59.1837 30.0199 59.1511 30.2622 59.1511C31.2844 59.1511 32.2466 59.7297 32.7098 60.6885L33.6733 62.6823C33.814 62.9737 34.078 63.0028 34.1878 63.0006C34.2956 62.9992 34.5606 62.9642 34.6939 62.6693L39.355 52.3594C38.8429 52.5068 38.3579 52.7707 37.945 53.1523Z"
                                            fill="white" />
                                        <path
                                            d="M54.2664 59.0701L51.3361 52.5887C50.8221 53.2084 50.1655 53.7257 49.3875 54.1003C47.2353 55.1365 44.809 54.7735 43.0547 53.1523C42.6418 52.7707 42.1568 52.5068 41.6445 52.3594L46.3056 62.6693C46.439 62.9643 46.704 62.9992 46.8117 63.0006C46.9216 63.0028 47.1855 62.9737 47.3262 62.6823L48.2897 60.6885C48.7529 59.7297 49.7151 59.1511 50.7373 59.1511C50.9797 59.1511 51.2255 59.1837 51.4685 59.2513L53.6018 59.8451C53.9134 59.9319 54.1105 59.7509 54.1805 59.6691C54.2509 59.5871 54.3997 59.3649 54.2664 59.0701Z"
                                            fill="white" />
                                        <path
                                            d="M56.5683 36.2629C54.1346 34.5965 53.3794 31.2878 54.8491 28.7305C55.7325 27.1932 55.2728 25.6741 54.5479 24.765C53.823 23.8562 52.4442 23.0701 50.749 23.5891C47.9292 24.4528 44.8712 22.9804 43.788 20.2368C43.1369 18.5876 41.6626 18 40.5 18C39.3375 18 37.8631 18.5876 37.212 20.2369C36.1289 22.9806 33.0712 24.4528 30.251 23.5891C28.5557 23.0702 27.1771 23.8562 26.4521 24.7651C25.7273 25.6742 25.2675 27.1931 26.1509 28.7306C27.6206 31.2878 26.8655 34.5966 24.4318 36.263C22.9687 37.2648 22.724 38.8329 22.9825 39.9663C23.2411 41.0998 24.1422 42.4063 25.895 42.6741C28.8107 43.1195 30.9265 45.7727 30.7122 48.7145C30.5832 50.483 31.6566 51.6521 32.704 52.1566C33.7514 52.661 35.3347 52.7714 36.6369 51.5679C37.7199 50.5671 39.1102 50.0665 40.4999 50.0665C41.8902 50.0665 43.2797 50.5668 44.3629 51.5679C45.6653 52.7715 47.2486 52.6611 48.296 52.1566C49.3434 51.6522 50.4167 50.4831 50.2878 48.7146C50.0734 45.7728 52.1893 43.1196 55.105 42.6741C56.8578 42.4063 57.7587 41.0997 58.0174 39.9663C58.2761 38.8327 58.0311 37.2647 56.5683 36.2629ZM40.5 47.5245C34.1214 47.5245 28.932 42.3351 28.932 35.9564C28.932 29.5777 34.1213 24.3882 40.5 24.3882C46.8788 24.3882 52.0681 29.5777 52.0681 35.9563C52.068 42.335 46.8787 47.5245 40.5 47.5245Z"
                                            fill="white" />
                                        <path
                                            d="M40.4991 26.5469C35.3097 26.5469 31.0879 30.7688 31.0879 35.9581C31.0879 41.1474 35.3096 45.3694 40.4991 45.3694C45.6886 45.3694 49.9104 41.1474 49.9104 35.9581C49.9104 30.7688 45.6885 26.5469 40.4991 26.5469ZM45.3221 35.0456L39.4649 39.3237C39.279 39.4595 39.056 39.5313 38.8289 39.5313C38.7703 39.5313 38.7115 39.5266 38.653 39.5169C38.3674 39.4697 38.1127 39.3096 37.9463 39.0727L36.1942 36.5782C35.8519 36.0907 35.9696 35.418 36.457 35.0757C36.9444 34.7334 37.6169 34.851 37.9594 35.3384L39.08 36.934L44.05 33.3039C44.531 32.9528 45.2058 33.0575 45.557 33.5387C45.9083 34.0196 45.8031 34.6942 45.3221 35.0456Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_416_4323">
                                            <rect width="45" height="45" fill="white" transform="translate(18 18)" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <p><?php echo esc_html(get_post_meta(get_the_ID(), 'tekst_pro_garantiyu', true)); ?>
                                </p>
                            </div>
                            <div class="guarantee__row flex">
                                <svg width="60" height="60" viewBox="0 0 80 80" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="80" height="80" rx="40" fill="#35495F" />
                                    <path
                                        d="M23.625 38.625V47.6254C23.625 49.7256 23.625 50.7752 24.0337 51.5773C24.3932 52.2829 24.9665 52.8572 25.6721 53.2166C26.4735 53.625 27.5231 53.625 29.6192 53.625H51.3808C53.4769 53.625 54.525 53.625 55.3264 53.2166C56.0319 52.8572 56.6072 52.2829 56.9666 51.5773C57.375 50.7759 57.375 49.7278 57.375 47.6318V38.625M23.625 38.625V34.875M23.625 38.625H57.375M57.375 38.625V34.875M23.625 34.875V33.3754C23.625 31.2752 23.625 30.2243 24.0337 29.4221C24.3932 28.7165 24.9665 28.1432 25.6721 27.7837C26.4743 27.375 27.5252 27.375 29.6254 27.375H51.3754C53.4756 27.375 54.5243 27.375 55.3264 27.7837C56.0319 28.1432 56.6072 28.7165 56.9666 29.4221C57.375 30.2235 57.375 31.2731 57.375 33.3692V34.875M23.625 34.875H57.375M31.125 46.125H38.625"
                                        stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <p><?php echo esc_html(get_post_meta(get_the_ID(), 'tekst_pro_rassrochku', true)); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            style="background-image: linear-gradient(rgba(43, 60, 77, 0.89), rgba(43, 60, 77, 0.89)), url('<?php the_field('fon_dlya_uslug', 'option'); ?>');"
            class="
            services-section">
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
        <?php
        if (function_exists('computex_cond_render_hits_slider')) {
            computex_cond_render_hits_slider(null, array('fallback_random_catalog' => true));
        }
        ?>
    </main>
    <?php
    get_footer();