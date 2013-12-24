<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage aWordpressChildTheme
 * @since aWordpressChildTheme 0.1.0
 */

$options = get_option("aWordpressChildTheme_options");
$impressum_id = $options["impressum"];
?>


    </div><!-- #main -->
    <footer id="colophon" class="site-footer" role="contentinfo">

      <div id="imprint">
        <a href="<?php echo get_permalink( intval($impressum_id) ); ?>"> Impressum </a>

        <?php
        $dashboardlink = admin_url();
        $logoutlink =  wp_logout_url( get_permalink() );
        $loginlink =  wp_login_url( get_permalink() );
       if ( is_user_logged_in() ) {
        echo ' <a href="' . $dashboardlink . '"> Dashboard  </a> <a href="' . $logoutlink . '">Ausloggen </a>' ;

        // echo ' <a href="' . $dashboardlink . '"> Dashboard  <i class="icon-wrench"></i></a> <a href="' . $logoutlink . '">Ausloggen <i class="icon-signout"></i></a>' ;
        }else{
        // echo '<a href="' . $loginlink . '"> Einloggen <i class="icon-signin"></i></a>';

                        }
         ?>

      </div>
    </footer><!-- #colophon -->
  </div><!-- #page -->

  <?php wp_footer(); ?>
</body>
</html>