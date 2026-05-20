<?php
defined( 'ABSPATH' ) || exit;

$content = get_post_field( 'post_content', get_the_ID() );

if ( ! is_string( $content ) || '' === trim( $content ) ) {
	if ( function_exists( 'get_field' ) ) {
		$acf = get_field( 'story_text' );
		if ( is_string( $acf ) && '' !== trim( $acf ) ) {
			$content = $acf;
		}
	}
}

if ( ! is_string( $content ) || '' === trim( $content ) ) {
	return;
}
?>

<section class="product-story">
	<div class="product-story-inner">
		<div class="product-story-content">
			<?php echo apply_filters( 'the_content', $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
