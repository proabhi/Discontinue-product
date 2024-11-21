<?php
/*
Plugin Name:Custom discontinue plugin
Description:Discontinue plugin
*/


function wk_custom_product_tab( $default_tabs ) {
    $default_tabs['discontinue_tab'] = array(
        'label'   =>  __( 'Discontinue Product', 'domain' ),
        'target'  =>  'add_discontinue_function',
        'priority' => 60,
        'class'   => array()
    );
    return $default_tabs;
}	

add_filter( 'woocommerce_product_data_tabs', 'wk_custom_product_tab', 10, 1 );

add_action( 'woocommerce_product_data_panels', 'add_discontinue_function' );
function add_discontinue_function($postid) {
	  global $woocommerce, $post;
	  $post_id = $post->ID;
$discon_pro_val1 = get_post_meta($post_id, '_discontinued_product', true );
$stock_discon_pro = get_post_meta( $post_id, '_stock_discontinued_product',true);
 ?>
 <div id="add_discontinue_function" class="panel woocommerce_options_panel">
 <label>Discontinue Product</label>  
 <input type="checkbox" name="discontinue_check" class="discontinue_check" value="yes" <?php if($discon_pro_val1 =="yes" || $stock_discon_pro =="yes") { ?> checked="checked" <?php } ?>>Discontinue
 </div>  

<?php 
}
//Save the data of the Meta field
add_action( 'save_post', 'save_custom_content_meta_box', 10, 1 );


    function save_custom_content_meta_box( $post_id ) {

        // We need to verify this with the proper authorization (security stuff).

        // Check if our nonce is set.
        $discontinue_check1 = $_POST[ 'discontinue_check' ];
		if($discontinue_check1){
		$discontinue_check1=$discontinue_check1;
		}
		else{
		$discontinue_check1="";
		}
         update_post_meta( $post_id, '_discontinued_product',$discontinue_check1 );
		 update_post_meta( $post_id, '_stock_discontinued_product',$discontinue_check1 );
		 
	}
	
function plugin_assets_enqueue() {
$plugin_url = plugin_dir_url( __FILE__ );
wp_enqueue_style( 'stylefile',  $plugin_url . "css/discontinue.css");
}  
add_action( 'admin_print_styles', 'plugin_assets_enqueue');