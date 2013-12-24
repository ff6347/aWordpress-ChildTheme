<?php
/**
 * This is fucntions.php
 *
 */

define("CHILDTHEMEFOLDER", get_stylesheet_directory_uri()); // define a constante

/**
 * This adds the theme options
 */
// require_once ( CHILDTHEMEFOLDER . '/theme-options.php' );
require_once ( get_stylesheet_directory() . '/theme-options.php' );
$options = get_option('aWordpressChildTheme_options');
/**
 * ADD THE JS
 */
add_action('wp_enqueue_scripts','add_main_js',100);
/**
 * ADD THE CSS
 */
add_action('init', 'add_styles');

/* add excerpt function for pages */
add_action('init', 'add_excerpt_to_pages');

// turn the function into a shortcode
add_shortcode('subpage_peek', 'subpage_peek');

// in your Child Theme's functions.php
// http://codex.wordpress.org/Function_Reference/remove_theme_support
// Use the after_setup_theme hook with a priority of 11 to load after the
// parent theme, which will fire on the default priority of 10
add_action( 'after_setup_theme', 'remove_custom_header_from_child_theme', 11 );


//add placeholder text to comment forms
add_filter('comment_form_default_fields','aWordpressChildTheme_comment_placeholders');
 //
 //
 //
/**
 * wordpress automatically adds p tags
 * disable that
 */

// remove_filter ('the_content',  'wpautop');
 /**
  * Remove ellioses
  *
  */
// add_filter('excerpt_more','__return_false');
/**
 * THIS IS JUST FOR DEV PURPOSE
 * remove the admin bar
 */


// add feed links to header
if (function_exists('automatic_feed_links')) {
  automatic_feed_links();
} else {
  return;
}

// add a favicon to your
function blog_favicon() {
  echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

if($options['debugger'] == true){

  add_filter('show_admin_bar', '__return_false');
}


function aWordpressChildTheme_comment_placeholders( $fields ){
  $fields['author'] = str_replace(
    '<input',
    '<input placeholder="'
    . _x(
      'Vor- und Nachname *',
      'comment form placeholder',
      'aWordpressChildTheme'
      )
    . '"',
    $fields['author']
    );

  $fields['email'] = str_replace(
    '<input',
    '<input placeholder="'
    . _x(
      'meine@e-mail.de *',
      'comment form placeholder',
      'aWordpressChildTheme'
      )
    . '"',

    $fields['email']
    );
  $fields['url'] = str_replace(
    '<input',
    '<input placeholder="'
    . _x(
      'http://mein-webseite.de',
      'comment form placeholder',
      'aWordpressChildTheme'
      )
    . '"',
    $fields['url']
    );


  return $fields;
}



/**
 * This calls my  JS
 *
 */
function add_main_js(){
/**
 * Do this only if we are not in the admin area
 */
  if( !is_admin() ){

    // wp_deregister_script( 'jquery' );

    wp_register_script( 'map-script', CHILDTHEMEFOLDER . '/assets/js/map-ck.js', array( 'jquery' ),'1.0', true );
    wp_enqueue_script( 'map-script' );
    wp_register_script( 'main-script', CHILDTHEMEFOLDER . '/assets/js/main-ck.js', array( 'jquery','map-script'),'1.0', true );
    wp_enqueue_script( 'main-script' );
  }
}

/**
 * all the css files
 *
 */
function add_styles() {
/**
 * Do this only if we are not in the admin area
 */
if( !is_admin() ){
  wp_register_style( 'additional', CHILDTHEMEFOLDER . '/assets/css/additional.css' );
  wp_enqueue_style( 'additional' );
  // wp_register_style( 'style-2013', CHILDTHEMEFOLDER . '/assets/css/style-2013.css' );
  //   wp_enqueue_style( 'style-2013' );

    /**
     * GALLERY CSS OVERWRITE
     * This is for checking if the easy_image_gallery exists
     * if so we have an additional css we include to overwrite some settings of
     * pretty photo
     *
     */
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $plugin = "easy-image-gallery/easy-image-gallery.php"; // this is the plugin we are looking for

    if(is_plugin_active($plugin)){
      /**
       * we found the plugin
       * now lets make a list of the css files it uses
       * we have to check if the user uses fancybox or prettyphoto
       * the first in the list is always the same
       */
      $styles = array(0 => 'easy-image-gallery',1=>'pretty-photo');

      // the following could lead to an error we need to get the info from the gallery plugin
      //
      //
      //
      // if(wp_style_is('pretty-photo')){
      //   // we are using pretty photo
      //  $styles[] = 'pretty-photo';
      // }elseif (wp_style_is('fancybox')) {
      //   // we are using fancybox.
      //   // ts ts ts this is commercial ;)
      // $styles[] = 'fancybox';
      // }else{

      // }
      // now we register our overwrite style with the right list of styles
      wp_register_style(
        'gallery-overwrite',
        CHILDTHEMEFOLDER . '/assets/css/gallery-overwrite.css',
        $styles
        );

       wp_enqueue_style('gallery-overwrite'); // adn enque the style

     }
   }else if(is_admin()){

    wp_register_style( 'theme_options', CHILDTHEMEFOLDER . '/assets/css/theme-options.css' );
    wp_enqueue_style( 'theme_options' );
  }

}

/**
 *Plugin Name: Subpage Peek
 *Plugin URL: http://wp.tutsplus.com/tutorials/quick-tip-display-excerpts-of-child-pages-with-a-shortcode/
*
*
*
* short code is [subpage_peek type="2"]
*
*
*/

// <ul class="houses">
//   <li class="house">
//     <img src="" alt="" class="house-image">
//     <h3 class="house-headline"></h3>
//     <p class="house-price"></p>
//   <p class="house-excerpt">excerpt</p>
//     <a href="" class="house-link-more">Weiter ...</a>
//   </li>
// </ul>

// subpage_peek
function subpage_peek($atts) {
  $options = get_option('aWordpressChildTheme_options');

  global $post;
  extract(
    shortcode_atts(
      array(
        'type' => '0',
        'foo' => 'something else',
        ),
      $atts
      )
    );
  //query subpages
  $args = array(
    'post_parent' => $post->ID,
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );

  $subpages = new WP_query($args);
  $output = "";
  // create output
  if ($subpages->have_posts()){
    if(intval($type) == 1){
      /**
       * This is type 1 of subpage peek
       */
      $output.= '<ul class="houses type-one">';
    }else{
      $output.= '<ul class="page-excerpt not-type-one">';
    }
    $count = 0;
    while ($subpages->have_posts()) : $subpages->the_post();
    if (intval($type) == 1) {
      /**
       * This is type 1 of subpage peek
       */
      $output .= '<li class="house">';

      $src = "";
      if ( function_exists('has_post_thumbnail') && has_post_thumbnail($post->ID) ) {
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "large" );
        if (!$thumbnail[0]){
          $src = "http://lorempixel.com/output/abstract-q-g-1024-768-1.jpg";
        } else {
          $src = $thumbnail[0];
        }
      }

      $output.=   '<div class="house-image" style="background-image:url(' . $src . ');"></div>' ;

      $output .= '<h3 class="house-headline">'.get_the_title() .'</h3>';
      if($post->ID == intval($options['scheuneid'])){
        // $output .= '<p class="house-price">' . preis_scheune() .'</p>';
      }else if($post->ID == intval($options['stallid'])){
        // $output .= '<p class="house-price">' . preis_stall().'</p>';
      }else if($post->ID == intval($options['rothausid'])){
        // $output .= '<p class="house-price">' . preis_roteshaus() .'</p>';
      }else{

      // $output .= '<p class="house-price">' . 'The price' .'</p>';
      }
      $output .= '<p class="house-excerpt">'. get_the_excerpt().'</p>';

      $output .= '<a href="'.get_permalink().'" class="house-link-more">Mehr erfahren &hellip;</a></li>';

    } else {
  /**
   * This is all other types
   */
  $output .= '<li class="page-peek">';
  $output .= '<h3 class="page-headline">'.get_the_title() .'</h3>';
  $output .=  get_the_post_thumbnail($post->ID, 'large',array('class' => 'page-peek-image')) ;
  $output .= '<p class="page-text-excerpt">'. get_the_excerpt().'</p>';
  $output .= '<a href="'.get_permalink().'" class="peek-link-more">Mehr erfahren &hellip;</a></li>';

}


endwhile;
    if(intval($type) == 1){
  $output .= '</ul><img class="lageplan" alt="aWordpressChildTheme-lageplan" src="' .  CHILDTHEMEFOLDER .'/assets/images/lageplan_aWordpressChildTheme1.png">';
  }else{
  $output .= '</ul>';

}
}else{

  $output = '<p>Es existieren keine Unterseiten.</p>';
}



  // reset the query
wp_reset_postdata();

  // return something
return $output;
}

// function build_price_element($postid, $pageid , $price){

//   $output = "";
//   if($postid== intval($pageid)){
//   $output = '<p class="house-price">' . $price .',-&euro;</p>';
//   }else{

//   $output = '<p class="house-price">' . 'The price' .'</p>';
//   }
// return $output;
// }

/**
 * Testing shortcodes with attributes
 * [bartag foo="foo-value"]
 *
 */

function bartag_func( $atts ) {

  extract(
    shortcode_atts(
      array(
        'foo' => 'something',
        'bar' => 'something else',
        ),
      $atts
      )
    );

  if(intval( $foo) == 2){
    return "<p>Housten we got number 2</p>";
  }else{
    return "foo = {$foo} bar = {$bar}";
  }

}

add_shortcode( 'bartag', 'bartag_func' );



function address_what(){
  $options = get_option('aWordpressChildTheme_options');
  return $options['addresstextwhat'];
// return "{$what}";
}
function address_who(){
  $options = get_option('aWordpressChildTheme_options');
  return $options['addresstextwho'];
// return "{$what}";
}
function address_street(){
  $options = get_option('aWordpressChildTheme_options');
  return $options['addresstextstreet'];
// return "{$what}";
}

function address_place(){
  $options = get_option('aWordpressChildTheme_options');
  return $options['addresstextplace'];
// return "{$what}";
}
function phone(){
  $options = get_option('aWordpressChildTheme_options');
  return clean_number($options['phone']);
// return "{$what}";
}
function fax(){
  $options = get_option('aWordpressChildTheme_options');
  return clean_number($options['fax']);
// return "{$what}";
}
function e_mail(){
  $options = get_option('aWordpressChildTheme_options');
  return "<a href='mailto:". $options['e_mail'] . "'>". $options['e_mail'] ."</a>";
// return "{$what}";
}

/**
 * This is price display
 *
 */
function price_template($var){
  return  "<br /><span>ab</span><br />&euro; " .$var .",-";
}
function preis_scheune(){
  $options = get_option('aWordpressChildTheme_options');
  return price_template($options['scheuneprice']);
// return "{$what}";
}
function preis_stall(){
  $options = get_option('aWordpressChildTheme_options');
  return price_template($options['stallprice']);
// return "{$what}";
}

function preis_roteshaus(){
  $options = get_option('aWordpressChildTheme_options');
  return price_template($options['rothausprice']);
// return "{$what}";
}


function clean_number($str){

  preg_match_all('!\d+!', $str, $matches);
//    print_r($matches);
  $var = implode(' ', $matches[0]);
  return $var;
}

// function make_link_list($str){
//   $array_of_strings = explode(',', $str);
//   $result =  array();
//     for ($i = 0; $i < count($array_of_strings); $i++) {
//         array_push($result, $array_of_strings[$i]);
//         // echo intval($arr_str_result[$i]) . "\n";
//     }
//   return $result;
// }

function full_address(){
    // $options = get_option('aWordpressChildTheme_options');
    // $linkslist = $options['addlinks'];
    // $linkarr = make_array($linklist);

  $var = '<address>';
  $var .= address_what()  .'<br>';
  $var .= address_who()  .'<br>';
  $var .= get_bloginfo('name') .'<br>';
  $var .= address_street()  .'<br>';
  $var .= address_place()  .'<br>';
  $var .= 'Tel.: <a href="tel://+'. ltrim(phone(), "00")  .'"> '. phone() .'</a><br>';
  $var .= 'Fax: '.fax()  .'<br>';
  $var .= e_mail()  .'<br>';
// for($j = 0; $j < count($linkarr);$j++){
//   $var .= '<a href="http://' . $linkarr[$j] . '>'.$linkarr[$j].'</a><br>';
// }

  $var .= '</address>';

  return $var;
}

/**
 * [add_excerpt_to_pages description]
 * http://codex.wordpress.org/Function_Reference/add_post_type_support
 */
function add_excerpt_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}



function remove_custom_header_from_child_theme() {

    // This will remove support for post thumbnails on ALL Post Types
  remove_theme_support( 'custom-header' );

    // Add this line in to re-enable support for just Posts
    // add_theme_support( 'post-thumbnails', array( 'post' ) );
}

// custom image size

// function custom_image_sizes() {
//   add_theme_support('post-thumbnails');
//   add_image_size('banner', 960, 355, true);
//   add_image_size('thumb', 120, 120, true);
//   add_image_size('widget', 170, 400, false);
// }
// add_action('after_setup_theme', 'custom_image_sizes');

// function add_custom_sizes( $imageSizes ) {
//   $my_sizes = array(
//     'banner' => 'Banner'
//   );
//   return array_merge( $imageSizes, $my_sizes );
// }
// add_filter( 'image_size_names_choose', 'add_custom_sizes' );

// function wpmayor_filter_image_sizes( $sizes) {

//     // unset( $sizes['thumbnail']);
//     unset( $sizes['medium']);
//     unset( $sizes['large']);
//         unset( $sizes['wysija-newsletters-max']);

//     return $sizes;
// }
// add_filter('intermediate_image_sizes_advanced', 'wpmayor_filter_image_sizes');

// function wpmayor_custom_image_sizes($sizes) {
//        $myimgsizes = array(
//               "new-size" => __( "New Size"),
//               "image-in-post" => __( "Image in Post" ),
//               "full" => __( "Original size" ),
//               "thumbnail" => __( "a bit smaller" )
//        );
//        return $myimgsizes;
// }
// add_filter('image_size_names_choose', 'wpmayor_custom_image_sizes');


add_shortcode( 'what_tag', 'address_what' );
add_shortcode( 'who_tag', 'address_who' );
add_shortcode( 'street_tag', 'address_street' );
add_shortcode( 'place_tag', 'address_place' );
add_shortcode( 'phone_tag', 'phone' );
add_shortcode( 'fax_tag', 'fax' );
add_shortcode( 'mail_tag', 'e_mail' );
add_shortcode( 'full_address_tag', 'full_address' );

add_shortcode( 'scheune_preis_tag', 'preis_scheune' );
add_shortcode( 'pferdestall_preis_tag', 'preis_stall' );
add_shortcode( 'roteshaus_preis_tag', 'preis_roteshaus' );

?>
