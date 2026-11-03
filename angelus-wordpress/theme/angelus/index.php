<?php
/**
 * Fallback template (archives and search results).
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php acpl_start( 'layouts.app', array( 'title' => wp_strip_all_tags( get_the_archive_title() ) ) ); ?>
	<?php acpl_c( 'page-hero', array( 'eyebrow' => __( 'News & insights', 'angelus' ), 'title' => esc_html( wp_strip_all_tags( get_the_archive_title() ) ) ) ); ?>

	<section class="bg-ivory py-24">
		<div class="container-x grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php $article = acpl_article( get_post() ); ?>
				<a href="<?php echo esc_url( $article['url'] ); ?>" class="card-light group flex flex-col p-8 transition duration-500 hover:-translate-y-1.5">
					<p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase"><?php echo esc_html( $article['category'] ); ?></p>
					<h2 class="mt-4 font-display text-2xl leading-snug text-navy-900 transition group-hover:text-gold-600"><?php echo esc_html( $article['title'] ); ?></h2>
					<p class="mt-4 flex-1 leading-relaxed text-mist"><?php echo esc_html( $article['excerpt'] ); ?></p>
				</a>
			<?php endwhile; ?>
			<?php if ( ! have_posts() ) : ?>
				<p class="text-mist"><?php esc_html_e( 'Nothing found.', 'angelus' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
<?php acpl_end( 'layouts.app' ); ?>
