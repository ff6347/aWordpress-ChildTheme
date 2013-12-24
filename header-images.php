
<?php
/**
 * The template used for displaying images in pages
 *
 * @package WordPress
 * @subpackage aWordpressChildTheme
 * @since aWordpressChildTheme 0.1
 */

// define("CHILDTHEMEFOLDER", get_stylesheet_directory_uri()); // define a constante

// /**
//  * header-images.php
//  */
// function make_array($str){
//   $array_of_strings = explode(',', $str);
//   $page_ids =  array();
//     for ($i = 0; $i < count($array_of_strings); $i++) {
//         array_push($page_ids, intval($array_of_strings[$i] ));
//         // echo intval($arr_str_page_ids[$i]) . "\n";
//     }
//   return $page_ids;
// }
?>
<?php
/**
 * this shows how to get some options from the backend
 * @var [type]
 */


// $options = get_option("aWordpressChildTheme_options");//get options
// /**
//  * make an array of integer values
//  *
//  */
// $startpage = false;
// $slideshowdeployid = $options["slideshowdeployid"];
// $angebot_ids = make_array($options["angebotheaders"]);
// $unterkuenfte_ids = make_array($options["unterkuenfteheaders"]);
// $bednbread_ids = make_array($options["beadnbreadheaders"]);
// $info_ids = make_array($options["infoheaders"]);
// $contact_ids = make_array($options["contactheaders"]);
// $welcome_id = array($options["welcome"]);

// $all_ids = array($angebot_ids, $unterkuenfte_ids,$bednbread_ids, $info_ids, $contact_ids,$welcome_id);
// // echo $my_string;
// $classstring = "default-header";

// $page_id     = get_queried_object_id();
// for ($i= 0; $i < count($all_ids); $i++) {
//   for ($j=0; $j < count($all_ids[$i]); $j++) {
//     if($i == 0){
//       // angebot
//       if($page_id == $all_ids[$i][$j]){
//           $classstring = "angebot-header";
//           }
//     }else if($i == 1){
//         // unterkuenfte
//       if($page_id == $all_ids[$i][$j]){
//           $classstring = "unterkuenfte-header";
//           }
//     }else if($i == 2){
//         // bednbread
//       if($page_id == $all_ids[$i][$j]){
//           $classstring = "bednbread-header";
//           }
//     }else if($i == 3){
//         // info
//       if($page_id == $all_ids[$i][$j]){
//           $classstring = "info-header";
//           }
//     }else if($i == 4){
//         // contact
//       if($page_id == $all_ids[$i][$j]){
//           $classstring = "kontakt-header";
//           }
//     }else if($i == 5){
//       if($page_id == $all_ids[$i][$j]){
//           // $classstring = "welcome-header";
//           $classstring = "";
//           $startpage = true;
//         }
//     }
//   }
// }



// if(($page_id == 17)||($page_id == 12)||($page_id == 18)||($page_id == 19)||($page_id == 52)){
//   $classstring = "angebot-header";
// }else if(($page_id == 39)||($page_id == 23)||($page_id == 25)||($page_id == 28)) {
//   $classstring = "unterkuenfte-header";
// }else if(($page_id == 75)) {
//   $classstring = "bednbread-header";
// } else if(($page_id == 45)||($page_id == 57)||($page_id == 62)||($page_id == 55)||($page_id == 42)) {
//   $classstring = "info-header";
// } else if(($page_id == 48)) {
//   $classstring = "kontakt-header";
// } else{
// $classstring = "default-header";
// }

// echo "<h1>";
// echo $page_id;
// echo "</h1>";
 ?>

<!-- this is header-images.php start -->

<!-- this is header-images.php end -->