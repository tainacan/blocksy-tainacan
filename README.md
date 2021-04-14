# Blocksy Tainacan

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
cd blocksy-tainacan
npm install
npm run build
```

But keep in mind that the script also takes care of removing some source files not necessary for the plugin to work, such as `.scss` and `.package.json`.
