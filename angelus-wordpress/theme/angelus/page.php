<?php
/**
 * Template: standard page (Privacy Policy, Disclaimer and any new page).
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

the_post();
$is_legal = in_array( get_post_field( 'post_name' ), array( 'privacy-policy', 'disclaimer' ), true );
$summary  = has_excerpt() ? get_the_excerpt() : get_the_title() . ' — ' . acpl( 'company.name' );
?>
<?php acpl_start( 'layouts.app', array( 'title' => get_the_title(), 'description' => $summary ) ); ?>
	<section class="relative isolate overflow-hidden bg-white pt-36 pb-20 sm:pt-44">
		<div class="brand-lines absolute inset-0 -z-10"></div>
		<div class="container-x mx-auto max-w-3xl">
			<?php if ( $is_legal ) : ?>
				<span class="eyebrow">Legal</span>
			<?php endif; ?>
			<h1 class="mt-6 font-display text-5xl text-navy-900 sm:text-6xl"><?php the_title(); ?></h1>
			<?php if ( $is_legal ) : ?>
				<p class="mt-6 text-sm text-mist">Last updated <?php echo esc_html( get_the_modified_date( 'j F Y' ) ); ?></p>
			<?php elseif ( has_excerpt() ) : ?>
				<p class="mt-6 text-lg text-mist"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>
		<?php acpl_c( 'brand-wave', array( 'class' => 'absolute inset-x-0 bottom-0 h-8 opacity-90 sm:h-12' ) ); ?>
	</section>

	<section class="bg-white py-16 sm:py-20">
		<div class="container-x mx-auto max-w-3xl space-y-6 text-lg leading-relaxed text-ink/80 [&_a]:text-gold-600 [&_a]:underline [&_h2]:pt-6 [&_h2]:font-display [&_h2]:text-3xl [&_h2]:text-navy-900 [&_h3]:pt-4 [&_h3]:font-display [&_h3]:text-2xl [&_h3]:text-navy-900 [&_img]:rounded-2xl [&_li]:ml-6 [&_ol]:list-decimal [&_ul]:list-disc">
			<?php the_content(); ?>
		</div>
	</section>
<?php acpl_end( 'layouts.app' ); ?>
