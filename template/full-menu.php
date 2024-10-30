<?php 
/*
Template Name: CRM Full Menu
*/

get_header();
?>

<div class="container py-1">
    <div class="row">
        
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
            <?php if( is_active_sidebar( 'CRMenu_list_left' ) ) : ?>
                <?php dynamic_sidebar( 'CRMenu_list_left' ); ?>
            <?php endif; ?>
        </div>
        
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
            <?php if( is_active_sidebar( 'CRMenu_list_right' ) ) : ?>
                <?php dynamic_sidebar( 'CRMenu_list_right' ); ?>
            <?php endif; ?>
        </div>
        
    </div>
</div>

<?php get_footer(); ?>