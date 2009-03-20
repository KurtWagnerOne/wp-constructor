<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */

/**
 * @todo:
 *      - remove images from disk (use AJAX)
 *      - translate to Ukrainian
 *
 *      - slideshow based on jquery (use feed as source? feedburner cheat?)
 *
 *      - export curent theme to zip
 *      - preview (live?)
 */

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name'=>'sidebar',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name'=>'extra',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name'=>'footer',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));    
}

$template_uri = get_template_directory_uri();

load_theme_textdomain('constructor', get_template_directory().'/lang');


if (!is_admin()) {    
    wp_enqueue_script( 'constructor-theme',     $template_uri.'/js/constructor.js', array('jquery'));
    wp_enqueue_script( 'constructor-slideshow', $template_uri.'/js/jquery.wp-slideshow.js', array('jquery'));
    
    wp_enqueue_style( 'constructor-style', $template_uri.'/css.php');
    
    $constructor = get_option('constructor');
    
    if (!$constructor) {
        $constructor = require 'themes/default/config.php';
        wp_enqueue_style( 'constructor-theme', $template_uri.'/themes/default/styles.css');
    } else {
        if (file_exists(get_template_directory() .'/themes/'.$constructor['theme'].'/styles.css'))
            wp_enqueue_style( 'constructor-theme', $template_uri.'/themes/'.$constructor['theme'].'/styles.css');
    }

    if ($constructor['menu']['type'] > 2) {
        wp_enqueue_script( 'constructor-hover',     $template_uri.'/js/hoverIntent.js', array('jquery'));
        wp_enqueue_script( 'constructor-bgiframe',  $template_uri.'/js/jquery.bgiframe.min.js', array('jquery'));
        wp_enqueue_script( 'constructor-superfish', $template_uri.'/js/superfish.js', array('jquery'));
        
        wp_enqueue_style( 'constructor-superfish', $template_uri.'/css/superfish.css');
    }

    /**
     * get_constructor_slideshow
     *
     * @access  public
     * @return  rettype  return
     */
    function get_constructor_slideshow()
    {
        global $constructor;

        if (!isset($constructor['slideshow']['id']) or $constructor['slideshow']['id'] == '' or !function_exists('nggShowSlideshow')) return false;

        if (is_page()   && !$constructor['slideshow']['onpage'])   return false;
        if (is_single() && !$constructor['slideshow']['onsingle']) return false;

        echo '<div id="header-slideshow" style="height:'.$constructor['slideshow']['height'].'px;">';
        // switch statement for $constructor['sidebar']
        switch ($constructor['sidebar']) {
            case 'none':
                echo nggShowSlideshow((int)$constructor['slideshow'], '1020' , $constructor['slideshow']['height']);
                break;
            case 'two':
                echo nggShowSlideshow((int)$constructor['slideshow'], '543' , $constructor['slideshow']['height']);
                break;
            case 'two-right':
            case 'two-left':
                echo nggShowSlideshow((int)$constructor['slideshow'], '558' , $constructor['slideshow']['height']);
                break;
            default:
                echo nggShowSlideshow((int)$constructor['slideshow'], '774' , $constructor['slideshow']['height']);
                break;
        }
        echo '</div>';
    }

    /**
     * get_constructor_layout
     *
     * @return string
     */
    function get_constructor_layout()
    {
        global $constructor;

        if (!isset($constructor['layout'])) return include_once 'layout-index.php';

        switch ($constructor['layout']) {
            case 'tile':
                include_once 'layout-tile.php';
                break;

            default:
                include_once 'layout-index.php';
                break;
        }
        return true;
    }

    /**
     * get_constructor_links
     *
     * @return string
     */
    function get_constructor_menu()
    {
        global $constructor;

        if (!isset($constructor['menu']['type']) or $constructor['menu']['type'] == 1) return false;
        if ($constructor['menu']['type'] == 2) {
            $params = 'depth=1&title_li=';
        } elseif ($constructor['menu']['type'] == 3) {
            $params = 'depth=2&title_li=';
        } elseif ($constructor['menu']['type'] == 4) {
            $params = 'depth=3&title_li=';
        }

        echo '<div id="header-links" class="opacity shadow"><ul class="opacity">';
        if ($constructor['menu']['home']) echo '<li id="home"><a href="'.get_option('home').'/" title="'.get_bloginfo('name').'">'.__('Home', 'constructor').'</a></li>';
        wp_list_pages($params);
        if ($constructor['menu']['rss'])  echo '<li id="rss"><a href="'.get_bloginfo('rss2_url').'"  title="'.__('RSS Feed', 'constructor').'">'. __('RSS Feed', 'constructor').'</a></li>';
        if ($constructor['menu']['size']) echo '<li id="size"><a href="#" class="big">A</a><a href="#" class="normal">A</a><a href="#" class="small">A</a></li>';
        echo '</ul></div>';
    }

    /**
     * get_constructor_sidebar
     *
     * @access  public
     * @return  string
     */
    function get_constructor_sidebar()
    {
        global $constructor;
        if (isset($constructor['sidebar']) && $constructor['sidebar'] == 'none') return false;
        
        ?>
            <div id="sidebar" class="sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php
        
        if (isset($constructor['sidebar']) && 
            ($constructor['sidebar'] == 'two' or $constructor['sidebar'] == 'two-right' or $constructor['sidebar'] == 'two-left' )) {
        ?>
            <div id="extra" class="sidebar">
                <ul>
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('extra') ) : ?>
		            <?php wp_list_pages('title_li=<h2>'.__('Pages', 'constructor').'</h2>' ); ?>
                    <?php endif; ?>
                </ul>
            </div>
        <?php
        }
    }


    /**
     * get_constructor_footer
     *
     * @access public
     * @return string
     */
    function get_constructor_footer()
    {
        global $constructor;
        if ($constructor['footer']['text']) {
            echo $constructor['footer']['text'];
        } else {
            echo '&copy; '.date('Y') .' '. sprintf(__('%1$s is proudly powered by %2$s', 'constructor'), get_bloginfo('name'), '<a href="http://wordpress.org/">WordPress</a>') .
                 ' | <a href="http://anton.shevchuk.name/">'. __('Constructor Theme', 'constructor') .'</a><br />'.
                 sprintf(__('%1$s and %2$s.', 'constructor'), '<a href="' . get_bloginfo('rss2_url') . '">' . __('Entries (RSS)', 'constructor') . '</a>', '<a href="' . get_bloginfo('comments_rss2_url') . '">' . __('Comments (RSS)', 'constructor') . '</a>');
        }
    }

    /**
     * get_constructor_tile_image
     *
     * @return string
     */
    function get_constructor_tile_image()
    {
        global $template_uri;
        if ($img = _get_post_image()) {
            echo '<img src="' .$template_uri. "/timthumb.php?src=".urlencode($img).'&amp;h=312&amp;w=312&amp;zc=1&amp;q=95" alt="' .get_the_title(). '"/>';
        } else {
            echo '<img src="' .$template_uri. '/images/noimage.png" alt="' .__('No Image', 'constructor'). '"/>';
        }
    }

    /**
     * _get_post_image
     *
     * @see    wordpress loop
     * @return string
     */
    function _get_post_image()
    {
        global $post;
        $home = addcslashes(get_bloginfo('siteurl'), '.-/');
        $pattern = "/\<\s*img.*src\s*=\s*[\"\']?(?:$home|\/)([^\"\'\ >]*)[\"\']?.*\/\>/i";
        preg_match_all($pattern, $post->post_content, $images);

        if (!isset($images[1][0])) {
            return false;
        } else {
            return $images[1][0];
        }
    }

} else {
    require_once 'admin/settings.php';
}