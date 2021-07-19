<?php

define('skygate_THEME_VER', '1.1.7');

// Child theme textdomain
function skygate_child_theme_setup() {
	load_child_theme_textdomain( 'skygate', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'skygate_child_theme_setup' );


function skygate_scripts_styles () {

	wp_register_script( 'faq-accordion', get_stylesheet_directory_uri() . '/assets/js/faq-accordion.js', array( 'jquery' ), skygate_THEME_VER, true );

	if ( is_front_page() ) {
		wp_enqueue_script( 'faq-accordion' );
	}

}
add_action( 'wp_enqueue_scripts', 'skygate_scripts_styles' );


require 'shortcode-calculator.php';


function skygate_scripts_head() { ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NKLR5NP');</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Ads: 666638924 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-666638924"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'AW-666638924');
</script>

<?php }
add_action( 'wp_head', 'skygate_scripts_head', 10 );


function skygate_scripts_body() { ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKLR5NP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php }
add_action( 'wp_body_open', 'skygate_scripts_body', 10 );


// Get most expensive variable and tag this for remarketing in Google Ads
function skygate_dynamic_remarketing() {
	if ( is_product() ) {
		global $product;

		$id = $product->get_id();

		if ( $product->is_type( 'variable' ) ) {

			$prices = $product->get_variation_prices();

			// get the most expensive variation
			$variation_id = array_key_last( $prices['price'] );
			$variation_price = end( $prices['price'] );

			echo "<script>
			gtag('event', 'page_view', {
				'send_to': 'AW-666638924',
				'value': " . $variation_price . ",
				'items': [{
					'id': '" . $variation_id . "',
					'google_business_vertical': 'retail'
				}]
			});
			</script>";

		}
	}
}
add_action( 'wp_footer', 'skygate_dynamic_remarketing', 10 );


// Conversion tracking
function skygate_track_conversion( $order_id ) {

	if ( ! $order_id ) {
		return;
	}

	// Getting an instance of the order object
	$order = wc_get_order( $order_id );

	if ( $order->is_paid() ) {
		echo "<!-- Event snippet for Aankoop skygate.nl conversion page -->
		<script>
		  gtag('event', 'conversion', {
			  'send_to': 'AW-666638924/dbfGCMrB_PYBEMy08L0C',
			  'value': " . $order->get_total() . ",
			  'currency': 'EUR',
			  'transaction_id': '" . $order_id . "'
		  });
		</script>";

	}
}
add_action('woocommerce_thankyou', 'skygate_track_conversion', 10, 1);


// Add backend styles for Gutenberg.
function skygate_add_gutenberg_assets() {
	wp_enqueue_style( 'skygate-gutenberg', get_theme_file_uri( '/gutenberg-editor-style.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'skygate_add_gutenberg_assets' );


function skygate_storefront_header_content() {
	echo '<h2>Skygate</h2>';
}
//add_action( 'storefront_header', 'skygate_storefront_header_content', 40 );


function skygate_remove_actions() {
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
}
//add_action( 'init', 'skygate_remove_actions' );


if ( ! function_exists( 'storefront_credit' ) ) {
	function storefront_credit() {
		?>
		<div class="flex">
			<select class="jump-menu" onchange="javascript:location.href = this.value;">
				<option value="https://skygate.nl/">Snelmenu</option>
				<option value="https://skygate.nl/product/schelpen/">Schelpen</option>
				<option value="https://skygate.nl/product/betonzand/">Betonzand</option>
				<option value="https://skygate.nl/product/voegzand/">Voegzand</option>
				<option value="https://skygate.nl/product/zilverzand/">Zilverzand</option>
				<option value="https://skygate.nl/product/tuingrind-8-16/">Tuingrind 8-16</option>
				<option value="https://skygate.nl/product/dakgrind-16-32/">Dakgrind 16-32</option>
				<option value="https://skygate.nl/tuingrind/">Tuingrind</option>
				<option value="https://skygate.nl/product/ophoogzand/">Ophoogzand</option>
				<option value="https://skygate.nl/product/metselzand/">Metselzand</option>
				<option value="https://skygate.nl/product/brekerzand/">Brekerzand</option>
				<option value="https://skygate.nl/product/speelzand/">Speelzand</option>
				<option value="https://skygate.nl/product/straatzand/">Straatzand</option>
				<option value="https://skygate.nl/zandbakzand/">Zandbakzand</option>
				<option value="https://skygate.nl/bigbag-betonzand/">Bigbag betonzand</option>
				<option value="https://skygate.nl/siergrind/">Siergrind</option>
				<option value="https://skygate.nl/big-bag-siergrind/">Big bag siergrind</option>
				<option value="https://skygate.nl/dakgrind/">Dakgrind</option>
				<option value="https://skygate.nl/bigbag-ophoogzand/">Bigbag ophoogzand</option>
				<option value="https://skygate.nl/bigbag-metselzand/">Bigbag metselzand</option>
				<option value="https://skygate.nl/bigbag-brekerzand/">Bigbag brekerzand </option>
			</select>
			<div class="site-info">
				<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
				<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
				<br />
				<?php
					if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span><a href="https://thewebworks.nl/">The Web Works</a>' );
					}
				?>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}


function skygate_checkout_bezorgdatum( $checkout ) {
	echo '<div id="bezorgdatum"><h2>' . __('Gewenste bezorgdatum') . '</h2>';
	echo '<p>Het is niet mogelijk minder dan 24 uur vooruit te bestellen, wilt u uw bestelling eerder ontvangen, neem dan telefonisch contact met ons op voor de mogelijkheden.</p>';

	woocommerce_form_field( 'bezorgdatum', array(
		'type'          => 'date',
		'class'         => array('bezorgdatum form-row-wide'),
		'label'         => __('Kies uw gewenste bezorgdatum'),
		'placeholder'   => __('Datum'),
		'required'      => true,
		), $checkout->get_value( 'bezorgdatum' ));

		woocommerce_form_field( 'bezorgtijd', array(
		'type'          => 'time',
		'class'         => array('bezorgtijd form-row-wide'),
		'label'         => __('Kies uw gewenste bezorgtijd'),
		'placeholder'   => __('Tijd'),
		), $checkout->get_value( 'bezorgtijd' ));

	echo '</div>';
}
//add_action( 'woocommerce_before_order_notes', 'skygate_checkout_bezorgdatum' );


function skygate_order_meta_keys( $keys ) {
	$keys[] = 'bezorgdatum';
	$keys[] = 'bezorgtijd';
	return $keys;
}
//add_filter('woocommerce_email_order_meta_keys', 'skygate_order_meta_keys');


function skygate_remove_menu_items(){
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'skygate_remove_menu_items', 999 );


function skygate_variation_price_format( $price, $product ) {
	// Main prices
	$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
	$price = $prices[0] !== $prices[1] ? sprintf( __( '<span class="woofrom">Vanaf: </span>%1$s', 'show-only-lowest-prices-in-woocommerce-variable-products' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
	// Sale price
	$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
	sort( $prices );
	$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<span class="woofrom">Vanaf: </span>%1$s', 'show-only-lowest-prices-in-woocommerce-variable-products' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
	if ( $price !== $saleprice ) {
		$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
	}
	return $price;
}
add_filter( 'woocommerce_variable_sale_price_html', 'skygate_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'skygate_variation_price_format', 10, 2 );


function rekenhulp_tab( $tabs ) {
	$terms = wp_get_post_terms( get_the_ID(), 'product_tag' );
	if ( $terms ) {
		$tabs['rekenhulp'] = array(
			'title'     => __( 'Rekenhulp', 'skygate' ),
			'priority'  => 50,
			'callback'  => 'rekenhulp_tab_callback'
		);
	}
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'rekenhulp_tab' );


function rekenhulp_tab_callback() {
	global $product;

	echo '<h2>Rekenhulp' . ' ' . $product->get_name() . '</h2>';
	echo '<p>Met behulp van onderstaande rekenhulp kunt u eenvoudig berekenen hoeveel ';
	echo strtolower($product->get_name());
	echo ' u nodig heeft voor uw toepassing.</p>';

	//$shortcodes = get_post_meta( get_the_ID(), 'rekenhulp', false );
	$shortcodes = wp_get_post_terms( get_the_ID(), 'product_tag' );
	foreach ( $shortcodes as $shortcode ) {
		echo do_shortcode( '[' . $shortcode->slug . ']' );
	}
}


function skygate_seo_description_product_tab() {
	global $product;
	return __('Productbeschrijving', 'skygate') . ' ' . $product->get_name();
}
add_filter( 'woocommerce_product_description_heading', 'skygate_seo_description_product_tab' );


function skygate_seo_add_to_cart_button() {
	global $product;
	return __('Bestel', 'skygate') . ' ' . $product->get_name();
}
add_filter( 'woocommerce_product_add_to_cart_text','skygate_seo_add_to_cart_button' );


// Fix search console errors
function filter_woocommerce_structured_data_product( $markup, $product ) {
	$markup['brand'] = get_bloginfo( 'name' );
	$markup['itemCondition'] = 'new';
	$markup['mpn'] = $markup['sku'];
	return $markup;
};
//add_filter( 'woocommerce_structured_data_product', 'filter_woocommerce_structured_data_product', 10, 2 );


// Search box placeholder
function skygate_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Zoek producten&hellip;' :
			$translated_text = __( 'Waar bent u naar op zoek?', 'woocommerce' );
			break;
	}
	return $translated_text;
}
add_filter( 'gettext', 'skygate_text_strings', 20, 3 );