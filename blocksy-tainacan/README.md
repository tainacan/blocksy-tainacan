# Blocksy Tainacan

## What is this about?

This project contains the source code necessary for integrating Tainacan pages to Blocksy theme. It allows you to choose between two strategies: either having a child theme or a plugin that does the job.

### But wait, what is Tainacan?

Tainacan is an open-source, flexible and powerful tool for creating digital repositories on WordPress. It allows you to create and manage collections with a variety of metadata types, rich search and filtering of items and much more. You can learn about it on our official website:

https://tainacan.org

### And how about Blocksy?

Blocksy is one of the many WordPress themes available out there. But it is not just another theme, it offers rich controls to customize your site with so many features that you won't miss a page builder:

https://creativethemes.com/blocksy/

This project uses their customizer controls to offer options for setting different layouts to Tainacan pages such as the collection items list and the items page.

## After all, a Plugin or a Child Theme?

By default, it is a plugin. While the most traditional strategy for creating themes compatible to Tainacan is to add some pages to the theme directly or using a child theme, this project goes the other way, which is to use it as plugin. The reason is clear: developers might prefer to create child themes of Blocksy by their own, without creating forks of this project. It is although a not-very-canonical approach, so you might be more comfortable using it as child theme.

## How to use it?

### As a plugin:

Just move all files to a folder inside WordPress plugins folder (`wp-content/plugins`);

Download and activate the Blocksy. And Tainacan, of course;

Then you just have to enable Blocksy theme and have fun ;)

### As a child theme:

Just go to `functions.php` file and set the constant as you prefer:

```php
const BLOCKSY_TAINACAN_IS_CHILD_THEME = true;
```

Then move all files to a folder inside WordPress themes folder (`wp-content/themes`);

Download the Blocksy parent theme. And Tainacan, of course;

Go ahead, enable the child theme and have fun ;)
