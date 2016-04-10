# CSS hacks #

**What is CSS?**

CSS is Cascading Style Sheets - read manual for beginners http://www.w3schools.com/css/, but you can use follows hacks w/out knowledge about CSS.

**How can I remove the border around the post title?**
```
.hentry .title {
    border:0 !important;
}
```

**How can I use header image as clickable logo**
  * Open "Header" tab on "Customize" page
  * Check "hide title by CSS" option

**How do I remove/change the dotted line underneath the entry post title?**
```
# remove line
.hentry .title a, .hentry .title span {
    border-bottom:0 !important;
}
# change to small black line
.hentry .title a, .hentry .title span {
    border-bottom:1px solid #000000 !important;
}
```

**How do I remove the border between the sidebar and the content?**
```
#container {
    border:0 !important;
}
```


**How can I remove the border surrounding the whole post area? (so there are no borders around at all)**
```
#wrapper {
    border:0 !important;
}
```

**I'd like to remove the automatic color highlighting of the first letter in each paragraph. How do I do that?**
```
.hentry .entry p:first-letter {
    color:black !important;
}
```

**How do I remove the auto-indent at the beginning of the paragraph?**
```
.hentry .entry p{
    text-indent:0px !important;
}
```

**How can I remove the border around inserted photographs**
```
.hentry .entry img {
    border-style: none !important;
}
```

**How do I change the size of the font in the header menu?
```
#menu li a, #menu li span{
    font-size:1.2em;
}
```**

**How can I change font size for title (deprecated, use setting)
```
#header h1 {
    font-size: 2.0em !important; /* default */
}
#header h2 {
    font-size: 1.8em !important; /* default */
}
```**

**How can I hide title in header
```
#header h1 { /*title*/
    text-indent: -9999% !important;
}
#header h2 { /*description*/
    text-indent: -9999% !important;
}
```**

**How can I hide title in header, but leave link (deprecated, use setting)
```
#header h1 a{
    text-indent: -9999% !important;
    display:block;
}
```**

**How can I change style for footer line
```
/* Example from Black Urban Theme */
.hentry .footer {
   /* set height */
   height:64px !important;
   /* remove borders */
   border: 0;
   /* set background image - center by horizontally and top by vertically */
   background: url(barbed-wire.jpg) 50% top no-repeat;
}
```**

