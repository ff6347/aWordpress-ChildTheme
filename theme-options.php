<?php
/**
 * @package WordPress
 * @subpackage aWordpressChildTheme
 * @since aWordpressChildTheme 0.1
 */
define("CHILDTHEMEFOLDER", get_stylesheet_directory_uri()); // define a constante

// based on this tutorial
// http://www.webdesignerdepot.com/2012/02/creating-a-custom-wordpress-theme-options-page/
add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
  register_setting( 'aWordpressChildTheme_options', 'aWordpressChildTheme_options' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
  add_theme_page( __( 'Theme Options', 'aWordpressChildTheme' ), __( 'Theme Options', 'aWordpressChildTheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


/**
 * Create arrays for our select and radio options
 */


/**
 * Create the options page
 */
function theme_options_do_page() {
  global $select_options, $radio_options;

  if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;

  ?>
  <div class="wrap">
    <?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'aWordpressChildTheme' ) . "</h2>"; ?>

    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
    <div class="updated fade"><p><strong><?php _e( 'Options saved', 'aWordpressChildTheme' ); ?></strong></p></div>
    <?php endif; ?>
    <h3><?php __("Achtung! Nur editieren wenn du weisst was du tust. ;)","aWordpressChildTheme") ?></h3>
    <form method="post" action="options.php">
      <?php settings_fields( 'aWordpressChildTheme_options' ); ?>
      <?php $options = get_option( 'aWordpressChildTheme_options' ); ?>

      <table class="form-table">

        <tr valign="top"><th scope="row"><?php _e( 'Men&uuml;leiste deaktivieren?', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[debugger]" name="aWordpressChildTheme_options[debugger]" type="checkbox" value="1" <?php checked( '1', $options['debugger'] ); ?> />
            <label class="description" for="aWordpressChildTheme_options[debugger]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        </tr>



        <!-- Variablen fuer preise und seiten  -->
        <tr>
          <th scope="row"></th>
          <td class="infoline">
            <h2><?php _e( 'Preise für Unterk&uuml;nfte', 'aWordpressChildTheme' ); ?></h2>
          <p>Preise bitte ohne Zusatz eitntragen. <br>Bsp.: <em>23</em> wird zu <em>ab € 23,-</em></p>

          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
          <?php _e( 'Alte Scheune', 'aWordpressChildTheme' ); ?>
          </th>
          <td >
            <input id="aWordpressChildTheme_options[scheuneid]" class="regular-text" type="text" name="aWordpressChildTheme_options[scheuneid]" value="<?php esc_attr_e( $options['scheuneid'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[scheuneid]"><?php _e( 'Seiten ID', 'aWordpressChildTheme' ); ?></label>
            <input id="aWordpressChildTheme_options[scheuneprice]" class="regular-text" type="text" name="aWordpressChildTheme_options[scheuneprice]" value="<?php esc_attr_e( $options['scheuneprice'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[scheuneprice]"><?php _e( 'Preis in &euro;', 'aWordpressChildTheme' ); ?></label>
          </td>
          <td> Shortcode f&uuml;r Preis [scheune_preis_tag] </td>
        </tr>
        <tr valign="top">
          <th scope="row">
          <?php _e( 'Alter Pferdestall', 'aWordpressChildTheme' ); ?>
          </th>
          <td >
            <input id="aWordpressChildTheme_options[stallid]" class="regular-text" type="text" name="aWordpressChildTheme_options[stallid]" value="<?php esc_attr_e( $options['stallid'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[stallid]"><?php _e( 'Seiten ID', 'aWordpressChildTheme' ); ?></label>
            <input id="aWordpressChildTheme_options[stallprice]" class="regular-text" type="text" name="aWordpressChildTheme_options[stallprice]" value="<?php esc_attr_e( $options['stallprice'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[stallprice]"><?php _e( 'Preis in &euro;', 'aWordpressChildTheme' ); ?></label>
          </td>
                    <td> Shortcode f&uuml;r Preis [pferdestall_preis_tag] </td>

        </tr>
        <tr valign="top">
          <th scope="row">
          <?php _e( 'Rotes Haus', 'aWordpressChildTheme' ); ?>
          </th>
          <td >
            <input id="aWordpressChildTheme_options[rothausid]" class="regular-text" type="text" name="aWordpressChildTheme_options[rothausid]" value="<?php esc_attr_e( $options['rothausid'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[rothausid]"><?php _e( 'Seiten ID', 'aWordpressChildTheme' ); ?></label>
            <input id="aWordpressChildTheme_options[rothausprice]" class="regular-text" type="text" name="aWordpressChildTheme_options[rothausprice]" value="<?php esc_attr_e( $options['rothausprice'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[rothausprice]"><?php _e( 'Preis in &euro;', 'aWordpressChildTheme' ); ?></label>
          </td>
                    <td> Shortcode f&uuml;r Preis [roteshaus_preis_tag] </td>

        </tr>
        <!-- Variablen fuer user  -->
        <tr>
          <th scope="row"></th>
          <td class="infoline">
            <h2><?php _e( 'Adress Variablen', 'aWordpressChildTheme' ); ?></h2>
          </td>
        </tr>

          <tr valign="top"><th scope="row"><?php _e( 'Adresse Was:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[addresstextwhat]" class="regular-text" type="text" name="aWordpressChildTheme_options[addresstextwhat]" value="<?php esc_attr_e( $options['addresstextwhat'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[addresstextwhat]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        <td> Shortcode [what_tag] </td>
        </tr>

          <tr valign="top"><th scope="row"><?php _e( 'Adresse Wer:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[addresstextwho]" class="regular-text" type="text" name="aWordpressChildTheme_options[addresstextwho]" value="<?php esc_attr_e( $options['addresstextwho'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[addresstextwho]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
                  <td> Shortcode [who_tag] </td>


        </tr>
                  <tr valign="top"><th scope="row"><?php _e( 'Adresse Strasse:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[addresstextstreet]" class="regular-text" type="text" name="aWordpressChildTheme_options[addresstextstreet]" value="<?php esc_attr_e( $options['addresstextstreet'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[addresstextstreet]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        <td> Shortcode [street_tag] </td>

        </tr>

        <tr valign="top"><th scope="row"><?php _e( 'Adresse PLZ Ort:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[addresstextplace]" class="regular-text" type="text" name="aWordpressChildTheme_options[addresstextplace]" value="<?php esc_attr_e( $options['addresstextplace'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[addresstextplace]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
                  <td> Shortcode [place_tag] </td>

        </tr>
                  <tr valign="top"><th scope="row"><?php _e( 'Telefon:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[phone]" class="regular-text" type="text" name="aWordpressChildTheme_options[phone]" value="<?php esc_attr_e( $options['phone'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[phone]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        <td> Shortcode [phone_tag] </td>

        </tr>
                          <tr valign="top"><th scope="row"><?php _e( 'Telefax:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[fax]" class="regular-text" type="text" name="aWordpressChildTheme_options[fax]" value="<?php esc_attr_e( $options['fax'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[fax]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        <td> Shortcode [fax_tag] </td>

        </tr>
         <tr valign="top"><th scope="row"><?php _e( 'E-Mail:', 'aWordpressChildTheme' ); ?></th>
          <td class="large-td">
            <input id="aWordpressChildTheme_options[e_mail]" class="regular-text" type="text" name="aWordpressChildTheme_options[e_mail]" value="<?php esc_attr_e( $options['e_mail'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[e_mail]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        <td> Shortcode [mail_tag] </td>
        </tr>

        <tr>
          <th scope="row"></th>
          <td class="infoline">
            <p><?php _e( 'Die gesamte Adresse kann mit [full_address_tag] eingebettet werden.', 'aWordpressChildTheme' ); ?></p>
          </td>
        </tr>
          <!-- Zwischen headline -->
        <tr>
          <th scope="row"></th>
          <td class="infoline">
            <h2><?php _e( 'Seiten IDs für die Bereichs-Header ', 'aWordpressChildTheme' ); ?></h2>
            <p>Bitte Seiten IDs mit "," trennen. <br>Bsp.: 23, 40, 100, 10, 144</p>
          </td>
        </tr>

<!-- search terms -->
        <tr valign="top"><th scope="row"><?php _e( 'Seiten ID für Willkommen', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[welcome]" class="regular-text" type="text" name="aWordpressChildTheme_options[welcome]" value="<?php esc_attr_e( $options['welcome'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[welcome]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        </tr>


        <tr valign="top"><th scope="row"><?php _e( 'Seiten ID f&uuml;r "Impressum"', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[impressum]" class="regular-text" type="text" name="aWordpressChildTheme_options[impressum]" value="<?php esc_attr_e( $options['impressum'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[impressum]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        </tr>


        <tr valign="top"><th scope="row"><?php _e( 'Seiten ID f&uuml;r "G&auml;stebuch"', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[guestbook]" class="regular-text" type="text" name="aWordpressChildTheme_options[guestbook]" value="<?php esc_attr_e( $options['guestbook'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[guestbook]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e( 'Angebot Header Seiten IDs', 'aWordpressChildTheme' ); ?></th>
          <td class="inputs">
            <input id="aWordpressChildTheme_options[angebotheaders]" class="regular-text" type="text" name="aWordpressChildTheme_options[angebotheaders]" value="<?php esc_attr_e( $options['angebotheaders'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[angebotheaders]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>

            <td>
              <div class="image-wrap">
              <img src="<?php echo CHILDTHEMEFOLDER . '/assets/images/header/thumbs/angebot-header.png' ?>"  alt="" >
              </div>
            </td>

        </tr>



        <tr valign="top"><th scope="row"><?php _e( 'Unterk&uuml;nfte Header Seiten IDs', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[unterkuenfteheaders]" class="regular-text" type="text" name="aWordpressChildTheme_options[unterkuenfteheaders]" value="<?php esc_attr_e( $options['unterkuenfteheaders'] ); ?>" />
          </td>
          <td>
              <div class="image-wrap">
              <img src="<?php echo CHILDTHEMEFOLDER . '/assets/images/header/thumbs/unterkuenfte-header.png' ?>"  alt="" >
              </div>
            </td>
        </tr>



        <tr valign="top"><th scope="row"><?php _e( 'Bed n Bread Header Seiten IDs', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[beadnbreadheaders]" class="regular-text" type="text" name="aWordpressChildTheme_options[beadnbreadheaders]" value="<?php esc_attr_e( $options['beadnbreadheaders'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[beadnbreadheaders]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
                      <td>
              <div class="image-wrap">
              <img src="<?php echo CHILDTHEMEFOLDER . '/assets/images/header/thumbs/bednbread-header.png' ?>"  alt="" >
              </div>
            </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e( 'info Header Seiten IDs', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[infoheaders]" class="regular-text" type="text" name="aWordpressChildTheme_options[infoheaders]" value="<?php esc_attr_e( $options['infoheaders'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[infoheaders]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
             <td>
              <div class="image-wrap">
              <img src="<?php echo CHILDTHEMEFOLDER . '/assets/images/header/thumbs/info-header.png' ?>"  alt="" >
              </div>
            </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e( 'Kontakt Header Seiten IDs', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[contactheaders]" class="regular-text" type="text" name="aWordpressChildTheme_options[contactheaders]" value="<?php esc_attr_e( $options['contactheaders'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[contactheaders]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>
        <td>
              <div class="image-wrap">
              <img src="<?php echo CHILDTHEMEFOLDER . '/assets/images/header/thumbs/kontakt-header.png' ?>"  alt="" >
              </div>
            </td>

        </tr>
                <!-- Zwischen headline -->
        <tr>
          <th scope="row"></th>
          <td class="infoline">
            <h2><?php _e( 'Slideshow deploy ID', 'aWordpressChildTheme' ); ?></h2>
            <p>Plugin Slideshow <a href="http://wordpress.org/plugins/slideshow-jquery-image-gallery/" target="blank">description</a></p>
          </td>
        </tr>
        <tr valign="top"><th scope="row"><?php _e( 'Slideshow ID Startseite', 'aWordpressChildTheme' ); ?></th>
          <td>
            <input id="aWordpressChildTheme_options[slideshowdeployid]" class="regular-text" type="text" name="aWordpressChildTheme_options[slideshowdeployid]" value="<?php esc_attr_e( $options['slideshowdeployid'] ); ?>" />
            <label class="description" for="aWordpressChildTheme_options[slideshowdeployid]"><?php _e( '', 'aWordpressChildTheme' ); ?></label>
          </td>


        </tr>
      </table>

      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e( 'Speichern', 'aWordpressChildTheme' ); ?>" />
      </p>
    </form>
  </div>
  <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
// function theme_options_validate( $input ) {
//   global $select_options, $radio_options;

//   // Our checkbox value is either 0 or 1
//   if ( ! isset( $input['option1'] ) )
//     $input['option1'] = null;
//   $input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

//   // Say our text option must be safe text with no HTML tags
//   $input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

//   // Our select option must actually be in our array of select options
//   if ( ! array_key_exists( $input['selectinput'], $select_options ) )
//     $input['selectinput'] = null;

//   // Our radio option must actually be in our array of radio options
//   if ( ! isset( $input['radioinput'] ) )
//     $input['radioinput'] = null;
//   if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
//     $input['radioinput'] = null;

//   // Say our textarea option must be safe text with the allowed tags for posts
//   $input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

//   return $input;
// }

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>