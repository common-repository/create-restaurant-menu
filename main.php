<?php
/*
    Plugin Name: Create Restaurant Menu
    Plugin URI: https://nextcool.app/wordpress-restaurant-menu-cart-payment-plugin/
    Description: WordPress plugin to create simplest restaurant menu. Create menu blocks and main menu for your recipe easily. <a href="https://restaurant.nextcool.app/menu/" target="_blank">Checkout Premium Plugin with Cart and Payment System</a>
    Version: 0.1
    Author: Ryan Mahato
    Author URI: http://mauriya.me
    License: GPL2
*/
defined('ABSPATH') || exit;
include(plugin_dir_path(__FILE__).'inc/config.php');
include(plugin_dir_path(__FILE__).'template/add_plugin_template.php');
include(plugin_dir_path(__FILE__).'widgets/restaurant_menu.php');
require_once plugin_dir_path( __FILE__ ) . 'restaurant-block/src/init.php';

// Admin Page
add_action('admin_menu', 'CRMenu_admin_menu');
function CRMenu_admin_menu(){
    add_menu_page( 'Create Restaurant Menu', 'Restaurant Menu', 'edit_posts', 'mainpage_create_restaurant_menu', 'CRMenu_create_restaurant_menu', plugins_url( 'img/resticon.png', __FILE__ ), 10 );
}

function CRMenu_create_restaurant_menu() {
    if(isset($_POST['storename'])) {
        update_option('storename', sanitize_text_field($_POST['storename']));
        $storename = sanitize_text_field($_POST['storename']);
    }
    $storename = get_option('storename', 'Store Name');
    if(isset($_POST['menuotherfontsize'])) {
        update_option('menuotherfontsize', absint($_POST['menuotherfontsize']));
        $menuotherfontsize = absint($_POST['menuotherfontsize']);
    }
    $menuotherfontsize = get_option('menuotherfontsize', '20');
    if(isset($_POST['menutitlefontsize'])) {
        update_option('menutitlefontsize', absint($_POST['menutitlefontsize']));
        $menutitlefontsize = absint($_POST['menutitlefontsize']);
    }
    $menutitlefontsize = get_option('menutitlefontsize', '24');
    if(isset($_POST['otherbuttonbgcolor'])) {
        update_option('otherbuttonbgcolor', sanitize_hex_color($_POST['otherbuttonbgcolor']));
        $otherbuttonbgcolor = sanitize_hex_color($_POST['otherbuttonbgcolor']);
    }
    $otherbuttonbgcolor = get_option('otherbuttonbgcolor', '#000000');
    if(isset($_POST['currencysymb'])) {
        update_option('currencysymb', sanitize_text_field($_POST['currencysymb']));
        $currencysymb = sanitize_text_field($_POST['currencysymb']);
    }
    $currencysymb = get_option('currencysymb', '€');
    if(isset($_POST['allergens'])) {
        update_option('allergens', sanitize_text_field($_POST['allergens']));
        $allergens = sanitize_text_field($_POST['allergens']);
    }
    $allergens = get_option('allergens', "Peanuts,SO2,Fish,Mustard,Lupin,Tree Nuts,Sesame,Molasses,Celery,Cereals with Gluten,Egg,Dairy,Crustaceans,Soybeans");
    if(isset($_POST['allergensfontsize'])) {
        update_option('allergensfontsize', absint($_POST['allergensfontsize']));
        $allergensfontsize = absint($_POST['allergensfontsize']);
    }
    $allergensfontsize = get_option('allergensfontsize', "14");
    if(isset($_POST['allergensfontcolor'])) {
        update_option('allergensfontcolor', sanitize_hex_color($_POST['allergensfontcolor']));
        $allergensfontcolor = sanitize_hex_color($_POST['allergensfontcolor']);
    }
    $allergensfontcolor = get_option('allergensfontcolor', "#6e0700");
    if(isset($_POST['jquery'])) {
        update_option('jquery', sanitize_text_field($_POST['jquery']));
        $jquery = sanitize_text_field($_POST['jquery']);
    }
    $jquery = get_option('jquery', 'false');
    if(isset($_POST['bootstrapminjs'])) {
        update_option('bootstrap_minjs', sanitize_text_field($_POST['bootstrapminjs']));
        $bootstrapminjs = sanitize_text_field($_POST['bootstrapminjs']);
    }
    $bootstrapminjs = get_option('bootstrap_minjs', 'false');
    if(isset($_POST['fontawesomemincss'])) {
        update_option('fontawesome_mincss', sanitize_text_field($_POST['fontawesomemincss']));
        $fontawesomemincss = sanitize_text_field($_POST['fontawesomemincss']);
    }
    $fontawesomemincss = get_option('fontawesome_mincss', 'false');
    if(isset($_POST['bootstrapmincss'])) {
        update_option('bootstrap_mincss', sanitize_text_field($_POST['bootstrapmincss']));
        $bootstrapmincss = sanitize_text_field($_POST['bootstrapmincss']);
    }
    $bootstrapmincss = get_option('bootstrap_mincss', 'false');

    include 'page/setting.php';
}

// if Selected
function CRMenu_ifselected($entry,$value) {
    if($entry === $value) {
        echo 'selected';
    }
}

// Admin Color Picker
add_action('admin_enqueue_scripts', 'CRMenu_Color_Picker');
function CRMenu_Color_Picker() {
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style( 'wp-color-picker' );
}

// Add Bootstrap, jQuery, and Fontawesome to the site.
function CRMenu_addscripts() {
    global $stripedtl;
    if($stripedtl['jquery'] === 'true') {
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', plugin_dir_url(__FILE__).'js/jquery.min.js', array(), '3.5.1', false);
    }
    if($stripedtl['bootstrapminjs'] === 'true') {
        wp_deregister_script('bootstrap');
        wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__).'js/bootstrap.min.js', array(), '4.5.0', false);
    }

    if($stripedtl['fontawesomemincss'] === 'true') {
        wp_deregister_style('fontawesome');
        wp_enqueue_style('fontawesome', plugin_dir_url(__FILE__) . 'style/font-awesome.min.css', array(), '4.7.0', false);
    }
    if($stripedtl['bootstrapmincss'] === 'true') {
        wp_deregister_style('bootstrap');
        wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'style/bootstrap.min.css', array(), '4.5.0', false);
    }
    wp_enqueue_style('createrestaurantmenu_css', plugin_dir_url(__FILE__) . 'style/addtocart.css', array(), '1.0.0', false);
    wp_enqueue_script('createrestaurantmenu_js', plugin_dir_url(__FILE__).'js/addtocart.js', array('jquery'), '1.0.0', false );
}
add_action('wp_enqueue_scripts', 'CRMenu_addscripts');


//Registering a Widget
function CRMenu_register_custom_widget() {
    register_widget( 'CRMenu_restaurant_item' );
}
add_action( 'widgets_init', 'CRMenu_register_custom_widget' );

// Sidebars
function CRMenu_menulist_sidebar() {
    register_sidebar( array(
        'name' => 'CR Menu List Right',
        'id' => 'crmenu_list_right',
        'class' => '',
        'description'   => 'Right menu column for main restaurant menu.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar( array(
        'name' => 'CR Menu List Left',
        'id' => 'crmenu_list_left',
        'class' => '',
        'description'   => 'Left menu column for main restaurant menu.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
}
add_action( 'widgets_init', 'CRMenu_menulist_sidebar' );

// Deactivate Sidebars
function deactivate_menu_list_sidebars_CRMenu() {
    unregister_sidebar( 'crmenu_list_right' );
    unregister_sidebar( 'crmenu_list_left' );
}
register_deactivation_hook(__FILE__, 'deactivate_menu_list_sidebars_CRMenu');


// Setting updated.
add_action( 'admin_notices', 'CRMenu_setting_notice_success' );
function CRMenu_setting_notice_success() {
     if(isset($_POST['storename']) || isset($_POST['bootstrapmincss']) || isset($_POST['menutitlefontsize'])) {
    ?>
    <div class="notice notice-success is-dismissible">
        <p>Plugin Setting Updated!</p>
    </div>
    <?php
     }
}



// inline scripts for gloabl variable
function CRMenu_global_scripts() {
	global $wpdb;
    global $stripedtl;
	?>	
<script>
	var msymbol = '<?php echo $stripedtl["symb"]; ?>';
	var allergens = '<?php echo $stripedtl["allergens"]; ?>';
    var spicypng = '<?php echo plugin_dir_url(__FILE__); ?>img/spicy.png';
</script>
<?php
}
add_action('wp_enqueue_scripts', 'CRMenu_global_scripts');
add_action('admin_enqueue_scripts', 'CRMenu_global_scripts');