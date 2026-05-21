<?php

/**

 * Shop archive template.

 *

 * @package computex-cond

 */



defined('ABSPATH') || exit;



get_header();

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

		<h1 class="catalog__h1"><?php woocommerce_page_title(); ?></h1>



		<div class="container catalog__container">

			<aside class="sidebar">

				<?php wc_get_template('sidebar-filters.php'); ?>

			</aside>



			<div class="catalog__grid">

				<?php if (woocommerce_product_loop()) : ?>

					<?php

					while (have_posts()) :

						the_post();

						wc_get_template_part('content', 'product');

					endwhile;

					?>

				<?php else : ?>

					<?php do_action('woocommerce_no_products_found'); ?>

				<?php endif; ?>

			</div>

		</div>



		<div class="flex pagination-wrapp">
			<div class="pagination">
				<?php computex_cond_render_catalog_pagination(); ?>
			</div>
			<div class="total-products">
				<?php
				global $wp_query;
				echo '<p>Всего товаров: ' . esc_html($wp_query->found_posts) . '</p>';
				?>
			</div>
		</div>

	</section>

</main>



<?php

get_footer();

