# Tainacan Support for Blocksy

This plugin integrates Tainacan pages with Blocksy theme.

Tainacan is an open-source, flexible and powerful tool for creating digital repositories on WordPress. It allows you to create and manage collections with a variety of metadata types, rich search and filtering of items and much more. You can learn about it on our official website: https://tainacan.org

Blocksy is one of the many WordPress themes available out there. But it is not just another theme, it offers rich controls to customize your site with so many features that you won't miss a page builder: https://creativethemes.com/blocksy/

This project uses their customizer controls to offer options for setting different layouts to Tainacan pages such as the collection items list and the items page.

## Build it!

Make the script executable:

```sh
chmod u+x build.sh
```

We use sass to build create our css files, so it needs to be compiled. To simply build the necessary `.scss` files into bundled `.css`:

```sh
./build.sh
```

To, besides that, move the necessary plugin files to your wordpress plugin directory:

```sh
./build.sh /var/www/html/wp-content/plugins/
```

If you don't like the script you can bundle things by yourself:

```sh
cd tainacan-blocksy
npm install
npm run build
```

But keep in mind that the script also takes care of removing some source files not necessary for the plugin to work, such as `.scss` and `.package.json`.

## After all, a Plugin or a Child Theme?

By default, it is a plugin. While the most traditional strategy for creating themes compatible to Tainacan is to add some pages to the theme directly or using a child theme, this project goes the other way, which is to use it as plugin. The reason is clear: developers might prefer to create child themes of Blocksy by their own, without creating forks of this project. It is although a not-very-canonical approach, so you might be more comfortable using it as child theme.

## How to use it?

### As a plugin:

Just move all files to a folder inside WordPress plugins folder (`wp-content/plugins`) (which is what the script does);

Download and activate the Blocksy. And Tainacan, of course;

Then you just have to enable Blocksy theme and have fun ;)

### As a child theme:

Just go to `functions.php` file and set the constant as you prefer:

```php
const TAINACAN_BLOCKSY_IS_CHILD_THEME = true;
```

Then move all files to a folder inside WordPress themes folder (`wp-content/themes`);

Download the Blocksy parent theme. And Tainacan, of course;

Go ahead, enable the child theme and have fun ;)
