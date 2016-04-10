On "Templates" tab you can see default layouts and can choose anyone. But if you want more flexibility you can create new layout, it's easy

For create custom layout (different of default/list/tile) you should be create new file in folder `/constructor/layouts`. For example - **mylayout.php**:

```
<?php 
__('Mylayout', 'constructor'); // requeried for correct translation
?>
<div id="content" class="box shadow opacity">
    <div id="container" >
    <?php get_constructor_slideshow(true) ?>

    <?php if (have_posts()) : ?>
    <div id="posts">
    <?php while (have_posts()) : the_post(); $i++; ?>
        <div <?php post_class(); ?> id="post-<?php the_ID() ?>">
           <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
           <?php the_content(__('Read the rest of this entry &raquo;', 'constructor')); ?>
        </div>
    <?php endwhile; ?>
    </div>
    <div class="navigation">
        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'constructor')) ?></div>
        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'constructor')) ?></div>
        <div class="empty clear">&nbsp;</div>
    </div>
    <?php endif; ?>

    </div><!-- id='container' -->
    <?php get_constructor_sidebar(); ?>
</div><!-- id='content' -->
```

Image with name **layout-mylayout.png** (300x200px) put to folder `/constructor/admin/images`

For use custom sidebars position you can write next code (don't forget write **layout-two** class in div with `id="content"`).

Example with two sidebars:
```
<?php 
// required class with sidebars position
// one of:
//  - layout-none
//  - layout-right
//  - layout-left
//  - layout-two
//  - layout-two-right
//  - layout-two-left
//
// You can use method the_constructor_layout_class()
//  - the_constructor_layout_class('none')
//  - the_constructor_layout_class('right')
//  - the_constructor_layout_class('left')
//  - the_constructor_layout_class('two')
//  - the_constructor_layout_class('two-right')
//  - the_constructor_layout_class('two-left')
?>
<div id="content" class="box shadow opacity  <?php the_constructor_layout_class('two') ?>">
    <div id="container" >
    <!-- same code -->
    </div>
    <!-- sidebar.php -->
    <?php get_sidebar(); ?>
    <!-- sidebar-extra.php -->
    <?php get_sidebar('extra'); ?>
</div>
```

For version 1.5.11 and higher you can use more simple way:

```
<?php 
// Call method the_constructor_layout_class() with layout name
// and call get_constructor_sidebar()
?>
<div id="content" class="box shadow opacity  <?php the_constructor_layout_class('two') ?>">
    <div id="container" >
    <!-- same code -->
    </div>
    <?php get_constructor_sidebar(); ?>
</div>
```

Also you can create child theme and rewrite header.php, footer.php etc:
  1. create new folder
  1. create file style.css with follows code
  1. create custom header or smth else
```
/*  
Theme Name: My Constructor
Description: Child theme
Template: constructor
*/
@import url('../constructor/style.css');
```


You can use follows classes in your layout:
```
/* text color */
.color0 { color:#{color opacity} }

.color1 { color:#{color 1} }
.color2 { color:#{color 2} }
.color3 { color:#{color 3} }

.color4 { color:#{color text} }
.color5 { color:#{color text2} }

.color6 { color:#{color background}  }
.color7 { color:#{color background2} }

.color8 { color:#{color border}  }
.color9 { color:#{color border2}  }

/* border color */
.bcolor0 { border-color:#{color opacity} }

.bcolor1 { border-color:#{color 1} }
.bcolor2 { border-color:#{color 2} }
.bcolor3 { border-color:#{color 3} }

.bcolor4 { border-color:#{color text} }
.bcolor5 { border-color:#{color text2} }

.bcolor6 { border-color:#{color background}  }
.bcolor7 { border-color:#{color background2} }

.bcolor8 { border-color:#{color border}  }
.bcolor9 { border-color:#{color border2}  }

/* background color */
.bgcolor0 { background-color:#{color opacity} }

.bgcolor1 { background-color:#{color 1} }
.bgcolor2 { background-color:#{color 2} }
.bgcolor3 { background-color:#{color 3} }

.bgcolor4 { background-color:#{color text} }
.bgcolor5 { background-color:#{color text2} }

.bgcolor6 { background-color:#{color background}  }
.bgcolor7 { background-color:#{color background2} }

.bgcolor8 { background-color:#{color border}  }
.bgcolor9 { background-color:#{color border2}  }
```