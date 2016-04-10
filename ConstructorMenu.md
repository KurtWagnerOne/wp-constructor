# Custom items #
Open file header.php and change get\_constructor\_menu options
```
<?php get_constructor_menu(
          // before other items
          array(
                '<a href="/home/" title="Custom page">Home</a>'
               ),
          // after all items
          array(
                '<a href="/forum/" title="Forum">Forum</a>',
                '<a href="mailto:AntonShevchuk@gmail.com" title="Mail to me">Send Email</a>'
               )
          ) ?>

```