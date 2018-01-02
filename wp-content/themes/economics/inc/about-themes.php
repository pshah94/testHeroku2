<?php
/**
 *economics About Theme
 *
 * @package Economics
 */

//about theme info
add_action( 'admin_menu', 'economics_abouttheme' );
function economics_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'economics'), __('About Theme Info', 'economics'), 'edit_theme_options', 'economics_guide', 'economics_mostrar_guide');   
} 

//guidline for about theme
function economics_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <h3><?php _e('About Theme Info', 'economics'); ?></h3>
		   </div>
          <p><?php _e('Economics is a multipurpose, clean and minimal free WordPress theme. It is very easy to install and customize and comes powerful features. It is perfect for corporate companies,business organizations, travel agency and online services providers. This theme is compatible with WooCommerce, Nextgen gallery ,Contact Form 7 and many popular WordPress  plugins.','economics'); ?></p>
<div class="heading-gt"> <?php _e('Theme Features', 'economics'); ?></div>
 

<div class="col-2">
  <h4><?php _e('Theme Customizer', 'economics'); ?></h4>
  <div class="description"><?php _e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'economics'); ?></div>
</div>

<div class="col-2">
  <h4><?php _e('Responsive Ready', 'economics'); ?></h4>
  <div class="description"><?php _e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'economics'); ?></div>
</div>

<div class="col-2">
<h4><?php _e('Cross Browser Compatible', 'economics'); ?></h4>
<div class="description"><?php _e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'economics'); ?></div>
</div>

<div class="col-2">
<h4><?php _e('E-commerce', 'economics'); ?></h4>
<div class="description"><?php _e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'economics'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
	<div class="gt-right">			
			<div>				
				<a href="<?php echo esc_url( economics_LIVE_DEMO ); ?>" target="_blank"><?php _e('Live Demo', 'economics'); ?></a> | 
				<a href="<?php echo esc_url( economics_PROTHEME_URL ); ?>"><?php _e('Purchase Pro', 'economics'); ?></a> | 
				<a href="<?php echo esc_url( economics_THEME_DOC ); ?>" target="_blank"><?php _e('Documentation', 'economics'); ?></a>
              
				<hr />  
                <ul>
                 <li><?php _e('Theme Customizer', 'economics'); ?></li>
                 <li><?php _e('Responsive Ready', 'economics'); ?></li>
                 <li><?php _e('Cross Browser Compatible', 'economics'); ?></li>
                 <li><?php _e('E-commerce', 'economics'); ?></li>
                 <li><?php _e('Contact Form 7 Plugin Compatible', 'economics'); ?></li>  
                 <li><?php _e('User Friendly', 'economics'); ?></li> 
                 <li><?php _e('Translation Ready', 'economics'); ?></li>
                 <li><?php _e('Many Other Plugins  Compatible', 'economics'); ?></li>   
                </ul>              
               
			</div>		
	</div><!-- .gt-right-->
    <div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>