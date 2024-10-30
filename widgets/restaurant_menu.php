<?php
/**
 * Created by PhpStorm.
 * User: rmahato
 * Date: 08/08/19
 * Time: 9:30 AM
 */
defined('ABSPATH') || exit;
global $stripedtl;
$stripe = $stripedtl;
class CRMenu_restaurant_item extends WP_Widget {
    // Widget name and description
    private $stripe;
    public function __construct() {
        global $stripe;
        $this->stripe = $stripe;
        $widget_options = array( 'classname' => 'crmenu_main_widget', 'description' => 'Restaurant menu items with title, description, prices, options, extra.' );
        parent::__construct( 'crmenu_main_widget', 'Restaurant Menu Item', $widget_options );
    }

    // Create the widget output.
    public function widget( $args, $instance ) {
        ob_start();
        $url = plugin_dir_url(__FILE__);
        $title = $instance['title'];
        $title1 = $instance['title1'];
        $desc1 = $instance['desc1'];
        $spicylevel = $instance['spicylevel'];
        $breakimginfo = $this->stripe['menutitlefontsize'];
        $spicywidth = floatval(intval($breakimginfo)*3.39);
        $spicywidthmax = intval($spicywidth).'px';
        $spicylevel = floatval(floatval($spicylevel)*0.20);
        $spicywidth = (intval($spicywidth*$spicylevel)).'px';
        $price1 = explode(",",$instance['price1']);
        $caloriesfont = $instance['caloriesfont'].'px';
        if($instance['calories']) {
            $calories = explode(",",$instance['calories']);
        } else {
            $calories = $instance['calories'];
        }
        $calories_list = '';
        if(is_array($calories)) {
            foreach($calories as $calorie){
                if(!$calories_list) {
                    $calories_list = '<span style="font-size: '.$caloriesfont.';">'.$calorie.' Cal.';
                } else {
                    $calories_list .= ' || '.$calorie.' Cal.';
                }
            }
            $calories_list .= '</span>';
        }
        
        
        if($instance['options']) {
            $options = explode(",",$instance['options']);
        } else {
            $options = $instance['options'];
        }
        if($instance['allergens']) {
            $allergens = explode(",",$instance['allergens']);
        } else {
            $allergens = $instance['allergens'];
        }
        if($instance['extras']) {
            $extras = explode(",",$instance['extras']);
        } else {
            $extras = $instance['extras'];
        }

        $optionsprice = explode(",",$instance['optionsprice']);
        $extrasprice = explode(",",$instance['extrasprice']);
        $name = preg_replace('/\s+/', '-', $title1);
        $fontcolor = $instance['fontcolor'];
        $menubgcolor = $instance['menubgcolor'];
        $buttonbgcolor = $instance['buttonbgcolor'];
        $buttontextcolor = $instance['buttontextcolor'];
        
        if($this->stripe['allergens']) {
            $gallergens = explode(",",$this->stripe['allergens']);
        } else {
            $gallergens = $this->stripe['allergens'];
        }
        $list_allergens = '';
        if(is_array($allergens) && is_array($gallergens)) {
            foreach($allergens as $allergen){
                if($list_allergens) {
                    $list_allergens = $list_allergens.', '.$gallergens[(int)$allergen-1];
                } else {
                    $list_allergens = $gallergens[(int)$allergen-1];
                }
            }
        }

        ?>
<style>
.<?php echo $name; ?> {
   background-color: <?php echo $buttonbgcolor; ?>;
   color: <?php echo $buttontextcolor; ?>;
   font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;
   border-color: <?php echo $buttonbgcolor; ?>;"     
}
</style>
        <?php if($title): ?>
        <br /><br />
            <div class="eltd-section-title-outer-holder" style="font-weight: bold; text-align: center;">
                <div class="eltd-section-title-title-holder">
                    <h2 class="eltd-section-title" style="font-weight:600;color:<?php echo $fontcolor; ?>;">
                        <?php echo $title; ?>
                    </h2>
                </div>
            </div>
            <br />
        <?php endif; ?>
<?php if($title1) { ?>
<div class="container py-1">
    <div class="row" style="color: <?php echo $fontcolor; ?>;">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mr-0">
            <div class="main-content py-1" style="background-color: <?php echo $menubgcolor; ?>;">
                <div class="col-12 clearfix" id="<?php echo $name; ?>-title" <?php $i = 1; foreach ($price1 as &$price) { ?> base-price<?php echo $i; ?>="<?php echo number_format(floatval($price),2); ?>" <?php $i++; } ?> currency="<?php echo $this->stripe['symb']; ?>">
                    <h4 style="font-size: <?php echo $this->stripe['menutitlefontsize']; ?>px;margin-top:5px;" title="<?php echo $title1; ?>">
                        <?php echo $title1; ?> <span style="height:<?php echo $this->stripe['menutitlefontsize']; ?>px;display:inline-block;width:<?php echo $spicywidth; ?>;background-image: url('<?php echo $url; ?>../img/spicy.png');background-size: contain;background-position:left top;background-repeat: no-repeat;background-size: <?php echo $spicywidthmax; ?> <?php echo $this->stripe['menutitlefontsize']; ?>px;"></span> <?php echo $calories_list; ?>
                    </h4>
                </div>
                <div class="col-12"><p style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;"><?php echo $desc1; ?></p></div>
                <?php if($list_allergens) { ?>
                    <div class="col-12">
                        <p style="font-size:<?php echo $this->stripe['allergensfontsize']; ?>px;color:<?php echo $this->stripe['allergensfontcolor']; ?>;font-weight:bold;">
                        <?php echo 'Allergens: <i>'.$list_allergens.'</i>'; ?>
                        </p>
                    </div>
                <?php } ?>
                <?php if($options !== '' || $extras !== '') { ?>
                <div class="col-12">
                    <div class="row">
                        <?php if($options) { ?>
                        <div class="col-lg-6 col-md-9 col-sm-7 col-xs-7 col-10">
                            <div class="input-group" style="margin-bottom:5px;">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelectprimary" style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;"><b>Select *</b></label>
                              </div>
                              <select class="custom-select" id="<?php echo $name; ?>-primary" onchange="updatesitemamount('<?php echo $name; ?>'); return false;" style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;">
                                <option value="" selected>Choose Option</option>
                              <?php $i=0; foreach($options as &$option){ ?>
                                <option value="<?php echo $option; ?>" data-price="<?php echo number_format(floatval($optionsprice[$i]),2); ?>"><?php echo $option; ?></option>
                              <?php $i++; } ?>
                              </select>
                            </div>
                            <div id="<?php echo $name; ?>-12" class="col-12 close" data-dismiss="alert" style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;"></div>
                        </div>
                        <?php } ?>
                        <?php if($extras) { ?>
                        <div class="col-lg-6 col-md-9 col-sm-7 col-xs-7 col-10">
                            <div class="input-group" style="margin-bottom:5px;">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelectsecondary" style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;"><b>Extra</b></label>
                              </div>
                              <select class="custom-select" style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;" id="<?php echo $name; ?>-secondary" onchange="updatesitemamount('<?php echo $name; ?>'); return false;">
                                <option style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;" value="" selected>Add Extra</option>
                                <?php $i=0; foreach($extras as &$extra){ ?>  
                                <option style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;" value="<?php echo $extra; ?>" data-price="<?php echo number_format(floatval($extrasprice[$i]),2); ?>"><?php echo $extra; ?></option>
                                <?php $i++; } ?>
                              </select>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <div class="col-12 close" data-dismiss="alert" id="<?php echo $name; ?>-added" style="font-size: <?php echo $this->stripe['menuotherfontsize']; ?>px;"></div>
            </div>
        </div>
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
            <div class="row">
                <?php $i = 1; foreach ($price1 as &$price) { ?>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 col-6">
                    <i class="btn btn-primary btn-block m-1 <?php echo $name; ?>" role="button" id="<?php echo $name; ?>-btn<?php echo $i; ?>" data-price="<?php echo number_format(floatval($price),2); ?>"> <strong><?php echo $this->stripe['symb']; ?><?php echo number_format(floatval($price),2); ?></strong></i>
                </div>
                <?php $i++; } ?>
            </div>
        </div>
        
    </div>
</div>
<br/>
<?php }
    ob_end_flush();
    }

    // Create the admin area widget settings form.
    public function form( $instance ) {
        $title = $instance['title'];
        $title1 = $instance['title1'];
        $desc1 = $instance['desc1'];
        $price1 = $instance['price1'];
        $options = $instance['options'];
        $optionsprice = $instance['optionsprice'];
        $extras = $instance['extras'];
        $extrasprice = $instance['extrasprice'];
        $fontcolor = $instance['fontcolor'];
        $menubgcolor = $instance['menubgcolor'];
        $buttonbgcolor = $instance['buttonbgcolor'];
        $buttontextcolor = $instance['buttontextcolor'];
        $spicylevel = $instance['spicylevel'];
        $allergens = $instance['allergens'];
        $calories = $instance['calories'];
        $caloriesfont = $instance['caloriesfont'];
        
        if($this->stripe['allergens']) {
            $gallergens = explode(",",$this->stripe['allergens']);
        } else {
            $gallergens = $this->stripe['allergens'];
        }
        $list_allergens = '';
        if(is_array($gallergens)) {
            $i = 1;
            foreach($gallergens as $gallergen){
                if($list_allergens) {
                    $list_allergens = $list_allergens.', ('.$i.') <i>'.$gallergen.'</i>';
                } else {
                    $list_allergens = '('.$i.') <i>'.$gallergen.'</i>';
                }
                $i++;
            }
        }
        
        ?>
    <style>
      label {
        display: inline-block;
        float: left;
        min-width: 150px;
      }
    </style>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                jQuery('.upload_image_button').on('click',function(){
                    $(".button-primary").prop('value', 'Save');
                    $(".button-primary").prop('disabled', false);
                });
                jQuery('.color-picker').each(function(){
                    $(".color-picker").wpColorPicker();
                });
                jQuery('.iris-picker').on('hover',function(){
                    $(".button-primary").prop('value', 'Save');
                    $(".button-primary").prop('disabled', false);
                });
            });
        </script>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input class="widefat" type="text" id="wounder <?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p class="entityseparate">
            <label for="<?php echo $this->get_field_name( 'title1' ); ?>"><?php _e( 'Item:' ); ?> (Required)</label>
            <input id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $title1 ); ?>" /><br/>
            <label for="<?php echo $this->get_field_name( 'desc1' ); ?>"><?php _e( 'Description:' ); ?></label><br/>
            <textarea id="<?php echo $this->get_field_id( 'desc1' ); ?>" name="<?php echo $this->get_field_name( 'desc1' ); ?>" class="widefat"><?php echo esc_attr( $desc1 ); ?></textarea>
            <br/>
            <label for="<?php echo $this->get_field_name( 'spicylevel' ); ?>"><?php _e( 'Spicy Level: <b>(e.g 4)</b> of 4/5' ); ?></label>
            <input style="width:50px;" id="<?php echo $this->get_field_id( 'spicylevel' ); ?>" name="<?php echo $this->get_field_name( 'spicylevel' ); ?>" class="widefat" type="number" placeholder="0" value="<?php echo esc_attr( $spicylevel ); ?>" /><b> /5</b>
            <br/>
            <label for="<?php echo $this->get_field_name( 'price1' ); ?>"><?php _e( 'Price <b>(e.g: 5.99,7.00,0.75)</b> for three servings:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'price1' ); ?>" name="<?php echo $this->get_field_name( 'price1' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $price1 ); ?>" />
            <br/>
            <label for="<?php echo $this->get_field_name( 'calories' ); ?>"><?php _e( 'Calories: (e.g: 350,700) for two servings' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'calories' ); ?>" name="<?php echo $this->get_field_name( 'calories' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $calories ); ?>" />
            <br/>
            <label for="<?php echo $this->get_field_name( 'caloriesfont' ); ?>"><?php _e( 'Calories Font in Pixel: (e.g:14)' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'caloriesfont' ); ?>" name="<?php echo $this->get_field_name( 'caloriesfont' ); ?>" class="widefat" type="number" value="<?php echo esc_attr( $caloriesfont ); ?>" />
            <br/>
            <label for="<?php echo $this->get_field_name( 'allergens' ); ?>"><?php _e( 'Allergens: (e.g: 1,6,12)' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'allergens' ); ?>" name="<?php echo $this->get_field_name( 'allergens' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $allergens ); ?>" />
            <?php if($list_allergens) { ?>
                <p>Allergens: <b><?php echo $list_allergens; ?></b></p>
            <?php } ?>
            <br/>
            <label for="<?php echo $this->get_field_name( 'options' ); ?>"><?php _e( 'Options: (e.g: Chicken,Lamb,Pork) for three options' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'options' ); ?>" name="<?php echo $this->get_field_name( 'options' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $options ); ?>" /><br/>
            <label for="<?php echo $this->get_field_name( 'optionsprice' ); ?>"><?php _e( 'Options Price: (e.g: 0.50,1.25,0.00) for three serving options' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'optionsprice' ); ?>" name="<?php echo $this->get_field_name( 'optionsprice' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $optionsprice ); ?>" /><br/>
            <label for="<?php echo $this->get_field_name( 'extras' ); ?>"><?php _e( 'Extras: (e.g: Prawns,Fish) for two extras' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'extras' ); ?>" name="<?php echo $this->get_field_name( 'extras' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $extras ); ?>" /><br/>
            <label for="<?php echo $this->get_field_name( 'extrasprice' ); ?>"><?php _e( 'Extras Price: (e.g: 1.99,1.25) for two extras' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'extrasprice' ); ?>" name="<?php echo $this->get_field_name( 'extrasprice' ); ?>" class="widefat" type="text" value="<?php echo esc_attr( $extrasprice ); ?>" /><br/>
        </p>
        <p class="entityseparate">
            <label for="<?php echo $this->get_field_id( 'fontcolor' ); ?>" style="display:block;"><?php _e( 'Font Color: ' ); ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'fontcolor' ); ?>" name="<?php echo $this->get_field_name( 'fontcolor' ); ?>" type="color" value="<?php echo esc_attr( $fontcolor ); ?>" /><br/>
            <label for="<?php echo $this->get_field_id( 'menubgcolor' ); ?>" style="display:block;"><?php _e( 'Menu Bg Color: ' ); ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'menubgcolor' ); ?>" name="<?php echo $this->get_field_name( 'menubgcolor' ); ?>" type="color" value="<?php echo esc_attr( $menubgcolor ); ?>" /><br/>
            <label for="<?php echo $this->get_field_id( 'buttonbgcolor' ); ?>" style="display:block;"><?php _e( 'Button Bg Color: ' ); ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'buttonbgcolor' ); ?>" name="<?php echo $this->get_field_name( 'buttonbgcolor' ); ?>" type="color" value="<?php echo esc_attr( $buttonbgcolor ); ?>" /><br/>
            <label for="<?php echo $this->get_field_id( 'buttontextcolor' ); ?>" style="display:block;"><?php _e( 'Button Text Color: ' ); ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'buttontextcolor' ); ?>" name="<?php echo $this->get_field_name( 'buttontextcolor' ); ?>" type="color" value="<?php echo esc_attr( $buttontextcolor ); ?>" /><br/>
        </p>
        <?php
    }

    // Apply settings to the widget instance.
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['title1'] = sanitize_text_field($new_instance['title1']);
        $instance['desc1'] = sanitize_text_field($new_instance['desc1']);
        $instance['price1'] = sanitize_text_field($new_instance['price1']);
        $instance['options'] = sanitize_text_field($new_instance['options']);
        $instance['optionsprice'] = sanitize_text_field($new_instance['optionsprice']);
        $instance['extras'] = sanitize_text_field($new_instance['extras']);
        $instance['extrasprice'] = sanitize_text_field($new_instance['extrasprice']);
        $instance['fontcolor'] = sanitize_hex_color($new_instance['fontcolor']);
        $instance['menubgcolor'] = sanitize_hex_color($new_instance['menubgcolor']);
        $instance['buttonbgcolor'] = sanitize_hex_color($new_instance['buttonbgcolor']);
        $instance['buttontextcolor'] = sanitize_hex_color($new_instance['buttontextcolor']);
        $instance['spicylevel'] = absint($new_instance['spicylevel']);
        $instance['allergens'] = sanitize_text_field($new_instance['allergens']);
        $instance['calories'] = sanitize_text_field($new_instance['calories']);
        $instance['caloriesfont'] = absint($new_instance['caloriesfont']);
        return $instance;
    }

}