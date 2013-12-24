<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage aWordpressChildTheme
 * @since aWordpressChildTheme 1.0
 */

define("CHILDTHEMEFOLDER", get_stylesheet_directory_uri()); // define a constante

/**
 * header-images.php
 */
function make_array($str){
  $array_of_strings = explode(',', $str);
  $page_ids =  array();
    for ($i = 0; $i < count($array_of_strings); $i++) {
        array_push($page_ids, intval($array_of_strings[$i] ));
        // echo intval($arr_str_page_ids[$i]) . "\n";
    }
  return $page_ids;
}

$options = get_option("aWordpressChildTheme_options");//get options
/**
 * make an array of integer values
 *
 */
$startpage = false;
$slideshowdeployid = $options["slideshowdeployid"];
$angebot_ids = make_array($options["angebotheaders"]);
$unterkuenfte_ids = make_array($options["unterkuenfteheaders"]);
$bednbread_ids = make_array($options["beadnbreadheaders"]);
$info_ids = make_array($options["infoheaders"]);
$contact_ids = make_array($options["contactheaders"]);
$welcome_id = array($options["welcome"]);

$all_ids = array($angebot_ids, $unterkuenfte_ids,$bednbread_ids, $info_ids, $contact_ids,$welcome_id);
// echo $my_string;
$classstring = "default-bg";

$page_id     = get_queried_object_id();
for ($i= 0; $i < count($all_ids); $i++) {
  for ($j=0; $j < count($all_ids[$i]); $j++) {
    if($i == 0){
      // angebot
      if($page_id == $all_ids[$i][$j]){
          $classstring = "angebot-bg";
          }
    }else if($i == 1){
        // unterkuenfte
      if($page_id == $all_ids[$i][$j]){
          $classstring = "unterkuenfte-bg";
          }
    }else if($i == 2){
        // bednbread
      if($page_id == $all_ids[$i][$j]){
          $classstring = "bednbread-bg";
          }
    }else if($i == 3){
        // info
      if($page_id == $all_ids[$i][$j]){
          $classstring = "info-bg";
          }
    }else if($i == 4){
        // contact
      if($page_id == $all_ids[$i][$j]){
          $classstring = "kontakt-bg";
          }
    }else if($i == 5){
      if($page_id == $all_ids[$i][$j]){
          // $classstring = "welcome-header";
          $classstring = "welcome-bg";
          $startpage = true;
        }
    }
  }
}

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!-- TypeKit -->
<script type="text/javascript" src="//use.typekit.net/gyk0xdw.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site <?php echo $classstring ?>">

		<div id="navbar" class="navbar">
			<nav id="site-navigation" class="navigation main-navigation" role="navigation">
				<h3 class="menu-toggle"><?php _e( 'Menu', 'aWordpressChildTheme' ); ?></h3>
				<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'aWordpressChildTheme' ); ?>"><?php _e( 'Skip to content', 'aWordpressChildTheme' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div><!-- #navbar -->

		<div id="main" class="site-main">
      <header id="masthead" class="site-header" role="banner">

<?php
if($startpage){
do_action('slideshow_deploy', $slideshowdeployid);
}
?>
        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
          <img class="brand distel" alt="aWordpressChildTheme-logo" src="<?php echo CHILDTHEMEFOLDER.'/assets/images/Logo_neu4_rgb.png'?>">
<!--      <div class="brand-label">
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
            <h2 class="site-description"><?php the_title(); ?> </h2>
          </div> -->
        </a>
      </header>