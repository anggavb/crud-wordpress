<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

<!-- <div class="address_container_left" id="address_container_left_1"> -->
    <div class="address" max-width: 460px; style="float:left;margin-bottom:10px" counter-label="1">
        <div class="watermark">
        </div>
        <table style="width:390px;  min-height: 300px; border: solid 1px #424242">
            <tbody>
                <tr>
                    <td style="vertical-align: top;">
                        <div class="header_wrapper header_with_cod">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="logo" colspan="2" rowspan="2">
																	<?php
																	if( $this->has_header_logo() ) {
																		$this->header_logo();
																	} else {
																		echo $this->get_title();
																	}
																	?>
                                </td>
                                <td class="label_wrapper" colspan="2">
                                  <b>LABEL PENGIRIMAN</b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>

                        <!-- Table barcode image -->
                        <?php do_action( 'csm_wpo_get_text_resi_otomatis', $this->type, $this->order); ?>
                        <!-- End table barcode image -->

                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="width: 25%;">
                                        <img src="<?php do_action( 'csm_wpo_get_text_kurir_logo', $this->type, $this->order); ?>" alt="" width="80%;">
                                    </td>
                                    <td style="width: 25%;vertical-align: middle;">
                                        <div style="font-size: 12px; font-weight: bold; color: #333333;">Kurir</div>
                                        <div style="font-size: 12px; color: #333333;"><?php $this->shipping_method(); ?></div>
                                    </td>
                                    <td style="width: 25%;vertical-align: middle;">
                                        <div style="font-size: 12px; color: #808080;"><b>Nomor Invoice</b></div>
                                        <div style="font-size: 12px; color: #333333;">#<?php $this->order_number(); ?></div>
                                    </td>
																    <td style="width: 25%;vertical-align: middle;">
                                        <div style="font-size: 12px; color: #333333;"><b>Tanggal Order</b></div>
                                        <div style="font-size: 12px; color: #333333;"><?php $this->order_date(); ?></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="width: 25%;">
                                        <div style="padding-bottom: 5px; padding-left: 10px; font-size: 12px; font-weight: normal; color: #666666;">Administrasi</div>
                                        <div style="padding-left: 10px; font-size: 12px; color: #333333;">+ Rp 0</div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div style="padding-bottom: 5px; font-size: 12px; font-weight: normal; color: #666666;">Asuransi</div>
                                        <div style="font-size: 12px; color: #333333;text-decoration: line-through;">+ Rp 0</div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div style="padding-bottom: 5px; font-size: 12px; color: #333333;">Estimasi Ongkir</div>
                                        <div style="font-size: 16px; font-weight: bold; color: #333333;">
                                            <?php $this->order_shipping(); ?>
                                        </div>
                                    </td>
                                    <td style="width: 25%; padding-right: 10px;">
                                        <div style="padding-bottom: 5px; font-size: 12px; color: #333333;">Berat</div>
                                        <div style="font-size: 16px; font-weight: bold; color: #333333;">
                                            <?php do_action( 'csm_wpo_get_total_weight', $this->type, $this->order); ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width: 100%;padding: 0 8px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="textbox_wrapper">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/pdf/print-format/asset/images/icon-money-alt.png" alt=""> Paket ini tidak menggunakan asuransi pihak logistik.
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <div class="additional_info_wrapper">
                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <th>Kepada</th>
                                <td>
                                    <div class="text-head">
                                        <b>
                                            <?php $this->custom_field('billing_first_name'); ?>
                                        </b>
                                    </div>
                                    <div class="text-content">
																			<b><?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?></b>
                                      <?php do_action( 'csm_wpo_full_address', $this->type, $this->order); ?>
																			<?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
																			<?php if ( isset($this->settings['display_email']) ) { ?>
																			<div class="billing-email"><?php $this->billing_email(); ?></div>
																			<?php } ?>
																			<?php if ( isset($this->settings['display_phone']) ) { ?>
																			<div class="billing-phone">Telp. <?php $this->billing_phone(); ?></div>
																			<?php } ?>
                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <th>Dari</th>
                                <td>
                                    <div class="text-head">
                                      <?php do_action( 'csm_wpo_get_sender_details', $this->type, $this->order, $this->get_shop_address()); ?>
																		</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <td colspan="2" style="position: relative; padding: 5px 0;">
                                    <div style="border-top: dashed 1px #BDBDBD;"></div>
                                    <div style="position: absolute; top: -5px; right: 0;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/pdf/print-format/asset/images/icon-cut.png" width="14px;" alt=""></div>
                                </td>
                            </tr>

                            <?php $items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
                            <tr>
                                <td style="width: 25%; padding-left: 10px; vertical-align: top;">
                                    <div style="font-size: 12px; color: #333333;"><?php echo $item['quantity']; ?> Pcs</div>
                                </td>
                                <td style="padding-right: 10px;">
                                    <div style="padding-bottom: 10px;">
                                        <div style="font-size: 12px; color: #333333;"><?php echo $item['name']; ?></div>

                                        <div style="font-size: 10px; color: #333333">
                                          <?php if( !empty( $item['sku'] ) ) : ?><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?><?php echo $item['sku']; ?><?php endif; ?>
                                          <?php if( !empty( $item['weight'] ) ) : ?><?php _e( ' / Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?><?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; ?>

                            <?php if ( $this->get_shipping_notes() ) : ?>
                            <tr>
                                <td colspan="2" style="position: relative; padding: 5px 0;">
                                    <div style="border-top: dashed 1px #BDBDBD;"></div>
                                    <div style="position: absolute; top: -5px; right: 0;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/pdf/print-format/asset/images/icon-cut.png" width="14px;" alt=""></div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                  <?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
                                </td>
                            </tr>

                            <tr>
                            <td style="width: 25%; padding-left: 10px; vertical-align: top;">
                                  <div style="font-size: 12px; color: #333333;"><?php _e( 'Catatan', 'woocommerce-pdf-invoices-packing-slips' ); ?></div>
                            </td>
                            <td style="padding-right: 10px;">
                                <div style="padding-bottom: 10px;">
                                    <div style="font-size: 12px; color: #333333;"><?php $this->shipping_notes(); ?></div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2">
                              <?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>
                            </td>
                        </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                </tbody>
            </table>
    </div>

  <!-- </div> -->

<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>
