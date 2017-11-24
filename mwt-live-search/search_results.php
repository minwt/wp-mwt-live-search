<?php 
$max_result_number = 10;
if ($_GET['s'] != '') {
    $_SERVER['REQUEST_URI'] = str_replace("wp-content/plugins/mwt-live-search/search_results.php", 
                                          "", $_SERVER['REQUEST_URI']);
    $posts_per_page = $max_result_number + 1;
    global $table_prefix;
    require('../../../wp-blog-header.php');
    if (count($posts) > 0) {
        echo '<ul>';
        foreach (array_slice($posts, 0, $max_result_number) as $post) {
        the_post(); ?>
        <li>
          <a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <div class="left"><img src="<?php echo mwt_getPostImg($post->ID);?>"></div>
            <div class="left"><?php the_title(); ?></div>
          </a>
        </li>
<?php
        }    
        if (count($posts) > $max_result_number) {
            echo'<li class="resultlistitem"><a href="' .  get_bloginfo(url) . "?s=" . $_GET['s'] .
              '" style="font-weight: bold" rel="bookmark" onclick="ls_form.submit(); return false;" >&gt;&gt; ' .
              __('Show all results') . "</a></li>";
        }

        echo '</ul>';
    } else {
        echo '<p>' . __("找不到相關文章.") . '</p>';
    }

}
function mwt_getPostImg($postId){
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($postId),'lage');
    if($thumbnail[0]!=null){    
        return $thumbnail[0];
    }else{
        $content_post = get_post($postId);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        preg_match_all("/<img.*? *>/s", $content, $img);
        preg_match('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $img[0][0], $imgsrc);  

        return $imgsrc[3];
    }
}
?>
