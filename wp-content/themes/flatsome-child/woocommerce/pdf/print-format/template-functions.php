<?php
/**
 * Use this file for all your template filters and actions.
 * Requires WooCommerce PDF Invoices & Packing Slips 1.4.13 or higher
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'csm_wpo_full_address', 'csm_get_full_address', 10, 2 );
function csm_get_full_address($template_type, $order){
    if ($template_type == 'packing-slip' || $template_type == 'invoice') {
        $order_data = $order->get_data();
        $order_billing_address_1 = $order_data['billing']['address_1'];
        $order_billing_city = $order_data['billing']['city'];
        $order_billing_state = $order_data['billing']['state'];
        $order_billing_country = $order_data['billing']['country'];
        $order_billing_postcode = $order_data['billing']['postcode'];
        $state_name = WC()->countries->get_states( $order_billing_country )[$order_billing_state];
        $address = "$order_billing_address_1<br>$order_billing_city<br>$state_name - $order_billing_state ($order_billing_postcode)";

        echo $address;
    }
}

add_action( 'csm_wpo_get_sender_details', 'csm_get_sender_details', 10, 3 );
function csm_get_sender_details($template_type, $order, $shop_address){
    if ($template_type == 'packing-slip') {
        // get meta order
        $dropship_name = $order->get_meta('billing_dropship_name');
        $dropship_telp = $order->get_meta('billing_dropship_telp');
        $shop_name = get_bloginfo( 'name' );

        if(!empty($dropship_name) && !empty($dropship_telp)){
            echo "$dropship_name - $dropship_telp";
        } else echo "$shop_name $shop_address";
    }
}

add_action( 'csm_wpo_get_total_weight', 'csm_get_total_weight', 10, 2 );
function csm_get_total_weight($template_type, $order){
    if ($template_type == 'packing-slip') {
        $total_weight = 0;
        $items = $order->get_items();
        if( sizeof( $items ) > 0 ) {
          foreach ( $items as $item_id => $item ) {
              $weight = 0;
              $quantity = $item['qty'];
              $product = $order->get_product_from_item( $item );
              $weight = $product->get_weight() ? $product->get_weight() : 0;
              $total_weight += floatval( $weight * $quantity );
          }
        }

        $weight_unit = get_option('woocommerce_weight_unit');
        echo "$total_weight $weight_unit";
    }
}

add_action( 'csm_wpo_get_text_resi_otomatis', 'csm_get_text_resi_otomatis', 10, 2 );
function csm_get_text_resi_otomatis($template_type, $order){
    if ($template_type == 'packing-slip') {
      $kurir = $order->get_meta('billing_pengiriman_kurir');
      $resi = $order->get_meta('billing_pengiriman_resi');

      if(!empty($kurir) && !empty($resi)){
        echo '<table style="width: 100%;">
            <tbody>
            <tr>
                <td style="padding-bottom: 0px; text-align: center;">
                    <div style="margin: 0; text-align: center;">
                        <img id="barcode-printout-1" width="98%" height="60" alt="'.$resi.'" src="http://barcodes4.me/barcode/c39/'.$resi.'.jpg">
                    </div>
                    <span style="font-size: 12px; color: #808080;">Kode Booking '.strtoupper($kurir).' <b>'.$resi.'</b></span>
                </td>
            </tr>
            </tbody>
        </table>';
      } else echo "";
    }
}

add_action( 'csm_wpo_get_text_kurir_logo', 'csm_get_text_kurir_logo', 10, 2 );
function csm_get_text_kurir_logo($template_type, $order){
    if ($template_type == 'packing-slip') {
      $kurir = $order->get_meta('billing_pengiriman_kurir');
      $resi = $order->get_meta('billing_pengiriman_resi');

      if(!empty($kurir) && !empty($resi)){
          echo get_kurir_logo_images($kurir);
      } else {
          echo get_kurir_logo_images('jne');
      }
    }
}

function get_kurir_logo_images($kurir){
    switch($kurir){
        case "jne" :
          $logo_is = get_stylesheet_directory_uri()."/woocommerce/pdf/print-format/asset/images/logo-jne.jpg";
        break;
        case "jnt" :
          $logo_is = get_stylesheet_directory_uri()."/woocommerce/pdf/print-format/asset/images/logo-jnt.jpg";
        break;
        case "pos" :
          $logo_is = get_stylesheet_directory_uri()."/woocommerce/pdf/print-format/asset/images/logo-pos.jpg";
        break;
        case "anteraja" :
          $logo_is = get_stylesheet_directory_uri()."/woocommerce/pdf/print-format/asset/images/logo-anteraja.jpg";
        break;
        case "sicepat" :
          $logo_is = get_stylesheet_directory_uri()."/woocommerce/pdf/print-format/asset/images/logo-sicepat.jpg";
        break;
        default : $logo_is = "";
    }

    return $logo_is;
}

add_filter('woocommerce_thankyou_order_received_text', 'wpo_wcpdf_thank_you_link', 10, 2);
function wpo_wcpdf_thank_you_link( $text, $order ) {
    if ( is_user_logged_in() ) {
        $order_id = method_exists($order, 'get_id') ? $order->get_id() : $order->id;
        $pdf_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=generate_wpo_wcpdf&template_type=invoice&order_ids=' . $order_id . '&my-account'), 'generate_wpo_wcpdf' );
        $text .= '<p><a href="'.esc_attr($pdf_url).'">Download a printable invoice / payment confirmation (PDF format)</a></p>';
    }
    return $text;
}
