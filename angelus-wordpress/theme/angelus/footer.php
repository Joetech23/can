<?php
/**
 * Profile banner, site footer and closing markup.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
		</main>

		<?php acpl_c( 'profile-banner' ); ?>
		<?php acpl_c( 'site-footer' ); ?>
		<?php acpl_c( 'contact-dock' ); ?>
		<?php wp_footer(); ?>
	</body>
</html>
