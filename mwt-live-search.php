<?php
/*
Plugin Name: MWT-Live Search
Plugin URI: https://www.minwt.com
Description: 即時顯示搜尋結果，<?php echo do_shortcode("[mwtlive_search]"); ?> or <a href="#" class="open-sarch"><i class="fa fa-search"></i></a>
Author: Minwt
Version: 1.0.0
Author URI: https://www.minwt.com
*/
function add_liveSearch_css(){
  echo '<link type="text/css" href="'.plugins_url("css/live_search.css",__FILE__).'" rel="stylesheet" />' . "\n";
  echo '<link type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />' . "\n";
}
function add_liveSearch_script(){
  echo "<script>jQuery.noConflict();</script>";
  echo "<script src=\"".plugins_url("js/prototype.js",__FILE__)."\"></script>". "\n";
  echo "<script src=\"".plugins_url("js/live_search.js",__FILE__)."\"></script>". "\n";
  echo '<script type="text/javascript">
          ls.url = "' .plugins_url("search_results.php",__FILE__).'";
        </script>';
}
function add_liveSearch_code() {
  $livesarch = "<a href=\"#\" class=\"open-sarch\"><i class=\"fa fa-search\"></i></a>";

  return $livesarch;
}
function add_liveSearch_box() {
  $livesarch = "<div id=\"searchbox\" style=\"display: none;\"><div class=\"livesearchpopup\">".
    "<div class=\"box\">".
      "<a href=\"#\" class=\"close-btn\"><i class=\"fa fa-times-circle\"></i></a>".
       "<form name=\"ls_form\" class=\"form\" id=\"searchform\" method=\"get\" action=\"".get_bloginfo("url")."\">".
          "<div class=\"editbox\">".
            "<input class=\"edit\" type=\"text\" name=\"s\" id=\"s\" autocomplete=\"off\" placeholder=\"站內搜尋\">".
            "<input type=\"submit\" value=\"搜尋\" class=\"btn\">".
          "</div>".
       "</form>".
       "<div id=\"livesearchpopup_box\" style=\"display: none;\">".
         "<h2>搜尋結果</h2>".
         "<div id=\"livesearchpopup_results\"></div>".
       "</div>".
     "</div>".
    "</div>".
  "</div>";

  echo $livesarch;
}
add_action('wp_head', 'add_liveSearch_css');
add_action('wp_footer', 'add_liveSearch_script' );
add_action('wp_footer', 'add_liveSearch_box' );
add_shortcode("mwtlive_search", "add_liveSearch_code");
?>