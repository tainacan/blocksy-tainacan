# Blocksy Tainacan

## What's this about?

This project contains the source code necessary for integrating Tainacan pages to Blocksy theme. It allows you to choose betweent two strategies: either having a child theme or a plugin that does the job.

### But wait, what is Tainacan?

Tainacan is an open-source, flexible and powerful tool for creating digital repositories on WordPress. It allows you to create and manage collections with a variety of metadata types, rich search and filtering of items and much more. You can learn about it in our official website:

https://tainacan.org

### And how about Blocksy?

Blocksy is one of the many WordPress themes available outhere. But it is not just another theme, it offers rich controls to customize your site with so many features that you won't miss a page builder. This projects uses their customizer controls to offer options to set different layout settings to Tainacan pages such as the collection itens list and the items page.

## After all, a Child Theme or a Plugin?

While the most traditional strategy for creating themes compatible to Tainacan is to add some pages to the theme directly or using a child theme, this project offers another option, which is to use it as plugin. The reason is clear: developers might prefer to create child themes of Blocksy by their own, without creating forks of this project. It is althougt a not very canonical approach, so you might be more confortable using it as child theme.

## How to use it?

### As a child theme:

Just go to `functions.php` file and set the constant as you prefer:

```php
const BLOCKSY_TAINACAN_IS_PLUGIN = false;
```

Then move all files to a folder inside WordPress themes folder (`wp-content/themes`);

Donwload the parent theme Blocksy;

Go ahead, enable the child theme and have fun ;)

### As a plugin:

Just go to `functions.php` file and set the constant as you prefer:

```php
const BLOCKSY_TAINACAN_IS_PLUGIN = true;
```

Then move all files to a folder inside WordPress plugins folder (`wp-content/plugins`);

Donwload and activate the theme Blocksy;

Go ahead, enable Blocksy theme and have fun ;)
