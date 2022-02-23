=== Tainacan Support for Blocksy ===
Author: tainacan
Contributors: wetah, vnmedeiros, leogermani, tainacan
Tags: museums, libraries, archives, GLAM, collections, repository, tainacan, blocksy
Requires at least: 5.0
Tested up to: 5.8.2
Requires PHP: 5.6
Stable tag: 0.1.14
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html


A plugin for integrating Tainacan plugin pages with the amazing Blocksy theme.


== Description ==

[Tainacan](https://tainacan.org/) is an open-source, flexible and powerful tool for creating digital repositories on WordPress. It allows you to create and manage collections with a variety of metadata types, rich search and filtering of items and much more.

[Blocksy](https://creativethemes.com/blocksy/) is one of the many WordPress themes available out there. But it is not just another theme, it offers rich controls to customize your site with so many features that you won't miss a page builder. This project uses their customizer controls to offer options for setting different layouts to Tainacan pages such as the collection items list and the items page.

This project uses their customizer controls to offer options for setting different layouts to Tainacan pages such as the collection items list and the items page.


== Installation ==

Upload the files to the plugins directory and activate it. You can also install and activate directly from the admin panel.

Once activated, go to the theme customizer and play around with Tainacan-related options for each of your collections.

This plugin will only work with [Tainacan plugin](https://wordpress.org/plugins/tainacan/) active, preferably at version 0.17.4 or newer;

Also, this plugin will only work with [Blocksy theme](https://wordpress.org/themes/blocksy/) active, preferably at version 1.7.0 or newer;


== Find out more ==

* Visit our official website: [https://tainacan.org/](https://tainacan.org/)
* Check our documentation Wiki: [https://wiki.tainacan.org/](https://wiki.tainacan.org/)
* Source code on GitHub: [https://github.com/tainacan/blocksy-tainacan](https://github.com/tainacan/blocksy-tainacan)
* Blocksy official website: [https://creativethemes.com/blocksy/](https://creativethemes.com/blocksy/)
* Blocksy Companion plugin: [https://wordpress.org/plugins/blocksy-companion/](https://wordpress.org/plugins/blocksy-companion/)


== Copyright ==

Tainacan Support for Blocksy, Copyright 2021 Tainacan.org
Tainacan Support for Blocksy plugin is distributed under the terms of the GNU GPLv3
License details: https://github.com/tainacan/blocksy-tainacan/blob/master/LICENSE


== Screenshots ==

1. With the plugin enabled, your customizer will offer options for each Tainacan collection items list and item page, besides the repository and term items list page;
2. The single item page can be customized for different layouts, so you can decide how to display the document, attachments and metadata;
3. Besides that, Blocksy offers different title banners, post navigation and related post features that can also be used in your single item page;


== Changelog ==

= 0.1.14 =
* Fixes advanced search layout

= 0.1.13 =
* Redirects search to items list if only Tainacan items post types are enabled

= 0.1.12 =
* Fixes lack of --background-color variable due to recent versions of Blocksy

= 0.1.11 =
* Compatibility with Tainacan 0.18.5 and its display of related metadata
* New option to use a light color scheme on the image gallery of the item

= 0.1.10 =
* "Items related to this" section and Zoom to single Document

= 0.1.9 =
* Fixes collection description style

= 0.1.8 =
* Fixes several issues with archive header elements

= 0.1.7 =
* Fixes child theme detection logic when customizer is on

= 0.1.6 =
* Fixes global enqueue and updates to inline logic for Blocksy 1.8.0

= 0.1.5 =
* Fixes navigation file issue with PHP opening tag

= 0.1.4 =
* Clean up some unecessary build-related files

= 0.1.3 =
* Changes name to avoid trademark issues

= 0.1.2 =
* First release on the WordPress.org plugins repository
