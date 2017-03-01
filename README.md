#List Posts Multisite Plugin

Easily list links to posts from any site across your multisite network with a shortcode.

##Usage

`[lpm_list_posts blog_id=3 cat=7 order=ASC post__not_in=27 posts_per_page=5 class=no-bullets]`

*blog_id* –– ID of the blog in the network  
*cat* –– ID of the category of posts that I need  
*order* –– order of the of the articles  
*posts_per_page* –– number of posts to display  
*post__not_in* –– comma-separated IDs of posts to exclude from the list  
*class* –– a CSS class to apply to the list  
*before_link* –– string added before the link

##Changelog##

**1.0.1**

* Added 'before_link' parameter

**1.0.0**

* Initial Release
