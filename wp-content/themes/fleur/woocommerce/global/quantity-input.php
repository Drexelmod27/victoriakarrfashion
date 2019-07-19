<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) { ?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
    </div>
<?php } else {
    /* translators: %s: Quantity. */
	$labelledby = ! empty( $args['product_name'] ) ? sprintf( esc_attr__( '%s quantity', 'fleur' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_attr__( 'Quantity', 'fleur' );
?>
    <div class="quantity mkd-quantity-buttons">
        <span class="mkd-quantity-minus"><span class="lnr lnr-chevron-down"></span></span>
        <input type="text" step="<?php echo esc_attr($step); ?>"
        <?php if(is_numeric($min_value)) : ?> min="<?php echo esc_attr($min_value); ?>" <?php endif; ?>
        <?php if(is_numeric($max_value)) : ?> max="<?php echo esc_attr($max_value); ?>"<?php endif; ?>
            id="<?php echo esc_attr( $input_id ); ?>"
            name="<?php echo esc_attr($input_name); ?>"
            value="<?php echo esc_attr($input_value); ?>"
            title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'fleur') ?>"
            class="input-text qty text mkd-quantity-input"
            size="4"
            pattern="<?php echo esc_attr( $pattern ); ?>"
            inputmode="<?php echo esc_attr( $inputmode ); ?>"
            aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" />
        <span class="mkd-quantity-plus"><span class="lnr lnr-chevron-up"></span></span>
    </div>
<?php } ?>
