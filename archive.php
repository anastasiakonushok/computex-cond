<?php
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
            </div>
        </section>

        <section class="section-archive">
            <div class="container section-archive__grid">
                <?php if (have_posts()): ?>
                <header class="archive-header">
                    <h1 class="archive-title">
                        <?php the_archive_title(); ?>
                    </h1>
                    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                </header>

                <?php while (have_posts()):
						the_post(); ?>
                <div class="archive-item">
                    <h3><?php the_title(); ?></h3>
                    <span><?php echo get_the_date('j F Y'); ?></span>
                    <p><?php the_excerpt(); ?></p>
                    <a class="button-primary" href="<?php the_permalink(); ?>">Подробнее</a>
                </div>
                <?php endwhile; ?>

                <!-- Пагинация -->
                <div class="pagination">
                    <?php
						the_posts_pagination(array(
							'prev_text' => __('&laquo; Назад', 'your-theme-textdomain'),
							'next_text' => __('Вперед &raquo;', 'your-theme-textdomain'),
						));
						?>
                </div>
                <?php else: ?>
                <p><?php esc_html_e('Извините, записи не найдены.', 'your-theme-textdomain'); ?></p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();