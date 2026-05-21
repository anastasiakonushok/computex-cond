<?php
/**
 * Template name: Шаблон страницы каталог
 */

get_header(); ?>
<?php

// Определение текущей страницы и категории
$current_category_slug = get_query_var('term', '');
$current_category = get_queried_object();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Параметры WP_Query
$args = array(
    'post_type' => 'catalog',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => $paged,
);

if (!empty($current_category_slug)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'catalog-cat',
            'field' => 'slug',
            'terms' => $current_category_slug,
        ),
    );
}

$query = new WP_Query($args);
?>

<main>
    <section class="section-breadcrumb-black">
        <div class="container">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div>
    </section>

    <section class="catalog">
        <h1 class="catalog__h1">Каталог кондиционеров от Computex – широкий выбор моделей</h1>
        <div class="container catalog__container">
            <!-- Форма фильтрации -->
            <div class="sidebar">
                <div class="sidebar__wrapp">
                    <h3>Категории</h3>
                    <form method="GET" action="<?php echo esc_url(home_url('/catalog-category/')); ?>" class="sidebar__form" id="categoryForm">
                        <?php
                        // Получаем список категорий
                        $terms = get_terms(array(
                            'taxonomy' => 'catalog-cat',
                            'hide_empty' => true,
                        ));
                        ?>

                        <label>
                            <input type="radio" name="category" value=""
                                <?php echo empty($current_category_slug) ? 'checked' : ''; ?>
                                onclick="document.location.href='<?php echo esc_url(home_url('/catalog-category/')); ?>';">
                            Все
                        </label>

                        <?php foreach ($terms as $term): ?>
                        <label>
                            <input type="radio" name="category" value="<?php echo esc_attr($term->slug); ?>"
                                <?php echo ($current_category_slug === $term->slug) ? 'checked' : ''; ?>
                                onclick="document.location.href='<?php echo esc_url(get_term_link($term)); ?>';">
                            <?php echo esc_html($term->name); ?>
                        </label>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>

            <!-- Список товаров -->
            <div class="catalog__grid">
                <?php if ($query->have_posts()): ?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <article class="product-card">
                            <div class="product-card__row">
                                <div class="product-card__img">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail(); ?>
                                    <?php else: ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/img-card.jpg" alt="">
                                    <?php endif; ?>
                                </div>
                                <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <hr>
                                <ul>
                                    <?php if (have_rows('svojstva')): ?>
                                        <?php while (have_rows('svojstva')): the_row(); ?>
                                            <li class="flex">
                                                <p><?php echo esc_html(get_sub_field('zagolovok')); ?>:</p>
                                                <p><?php echo esc_html(get_sub_field('znachenie')); ?></p>
                                            </li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="product-card__info flex">
                                <span class="price"><?php echo get_post_meta(get_the_ID(), 'czena', true); ?> BYN</span>
                                <a class="button-gray" href="<?php the_permalink(); ?>">Подробнее</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Нет товаров для отображения.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Пагинация -->
        <div class="flex pagination-wrapp">
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'prev_text' => '<span class="custom-arrow custom-arrow--prev">←</span>',
                    'next_text' => '<span class="custom-arrow custom-arrow--next">→</span>',
                ));
                ?>
            </div>
            <div class="total-products">
                <?php
                $total_products = $query->found_posts;
                echo '<p>Всего товаров: ' . esc_html($total_products) . '</p>';
                ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<?php
get_footer();?>