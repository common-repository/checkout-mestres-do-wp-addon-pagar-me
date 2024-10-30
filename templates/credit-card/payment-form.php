<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php echo "<script type='text/javascript' src='".CWMP_PAGARME_PLUGIN_URL."assets/js/card.js'></script>"; ?>
<div class="card-container jp-card-container" style="width:100% !important;"></div>
<fieldset id="pagarme-credit-cart-form">
	<p class="form-row">
		<label for="pagarme-card-holder-name">Nome do Titular<span class="required">*</span></label>
		<input id="pagarme-card-holder-name" class="input-text" type="text" autocomplete="off" style="font-size: 1.5em; padding: 8px;" />
	</p>
	<p class="form-row">
		<label for="pagarme-card-number">Número do Cartão <span class="required">*</span></label>
		<input id="pagarme-card-number" class="input-text wc-credit-card-form-card-number" type="text" maxlength="20" autocomplete="off" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" style="font-size: 1.5em; padding: 8px;" />
	</p>
	<div class="clear"></div>
	<p class="form-row form-row-first">
		<label for="pagarme-card-expiry">Vencimento <span class="required">*</span></label>
		<input id="pagarme-card-expiry" class="input-text wc-credit-card-form-card-expiry" type="text" autocomplete="off" placeholder="<?php esc_html_e( 'MM / YY', 'woocommerce-pagarme' ); ?>" style="font-size: 1.5em; padding: 8px;" />
	</p>
	<p class="form-row form-row-last">
		<label for="pagarme-card-cvc">CVV <span class="required">*</span></label>
		<input id="pagarme-card-cvc" class="input-text wc-credit-card-form-card-cvc" type="text" autocomplete="off" placeholder="<?php esc_html_e( 'CVC', 'woocommerce-pagarme' ); ?>" style="font-size: 1.5em; padding: 8px;" />
	</p>
	<div class="clear"></div>
	<?php if ( apply_filters( 'wc_pagarme_allow_credit_card_installments', 1 < $max_installment ) ) : ?>
		<p class="form-row form-row-wide">
			<label for="pagarme-card-installments">Parcelas <span class="required">*</span></label>
			<select name="pagarme_installments" id="pagarme-installments" style="font-size: 1.5em; padding: 8px; width: 100%;">
				<option value="0">Escolha o número de parcelas</option>
				<?php
				foreach ( $installments as $number => $installment ) :
					if ( 1 !== $number && $smallest_installment > $installment['installment_amount'] ) {
						break;
					}

					$interest           = ( ( $cart_total * 100 ) < $installment['amount'] ) ? sprintf( __( '(total of %s)', 'woocommerce-pagarme' ), strip_tags( wc_price( $installment['amount'] / 100 ) ) ) : __( 'Parcelas', 'woocommerce-pagarme' );
					$installment_amount = strip_tags( wc_price( $installment['installment_amount'] / 100 ) );
					?>
				<option value="<?php echo absint( $installment['installment'] ); ?>"><?php printf( esc_html__( '%1$dx of %2$s %3$s', 'woocommerce-pagarme' ), absint( $installment['installment'] ), esc_html( $installment_amount ), esc_html( $interest ) ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
	<?php endif; ?>
</fieldset>
<script type="text/javascript">
var card = new Card({
    form: 'form.checkout',
    container: '.card-container',
    formSelectors: {
        numberInput: 'input#pagarme-card-number',
		expiryInput: 'input#pagarme-card-expiry',
        cvcInput: 'input#pagarme-card-cvc',
        nameInput: 'input#pagarme-card-holder-name'
    }
});
</script>
