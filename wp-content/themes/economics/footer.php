<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Economics
 */
?>

<div class="footer-copyright">
        	<div class="container">
            	<div class="copyright-txt">
					<?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'economics');?>           
                </div>
                <div class="design-by">
				  <a href="<?php echo esc_url( __( 'https://gracethemes.com/themes/economics/', 'economics' ) ); ?>"><?php printf( __( 'Theme by %s', 'economics' ), 'Grace Themes' ); ?></a>
                </div>
                 <div class="clear"></div>
            </div>           
        </div>        
</div><!--#end site-holder-->

<?php wp_footer(); ?>
</body>
</html>