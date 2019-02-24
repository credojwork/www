<?php
/*
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.1.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $product, $post;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
if(  $rating_count > 0 ) :
?>

<div class="reviews-content" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<div class="star">
		<?php echo '<span style="width:'. ( $average*13 ) .'px"></span>'; ?>
		<div class="rating-hidden">
			<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'onemall' ), '<span itemprop="bestRating">', '</span>' ); ?>
			<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'onemall' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
		</div>
	</div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s Review', '%s Review(s)', $rating_count, 'onemall' ), '<span itemprop="ratingCount" class="count">' . $rating_count . '</span>' ); ?></a>
</div>

<?php else : ?>

<div class="reviews-content">
	<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s Review', '%s Review(s)', $rating_count, 'onemall' ), '<span class="count">' . $rating_count . '</span>' ); ?></a>
</div>
<?php endif; ?>

<?php if( !onemall_mobile_check() && $product->get_type() != 'variable' ) :?>
<?php $stock = ( $product->is_in_stock() )? 'in-stock' : 'out-stock' ; ?>
	<div class="product-stock <?php echo esc_attr( $stock ); ?>">
		<span class="availability"><?php esc_html_e( 'Availability:', 'onemall' ) ?></span>
		<span><i class="fa fa-check-square-o" aria-hidden="true"></i><?php echo ( $product->is_in_stock() )? esc_html__( 'in stock', 'onemall' ) : esc_html__( 'Out stock', 'onemall' ); ?></span>
	</div>
<?php endif; ?>
