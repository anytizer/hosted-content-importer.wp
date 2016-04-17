=== Hosted Content Importer ===

Contributors: pbimal
Donate link: http://bimal.org.np/
Tags: embed, hci, hosted, remote, third, content, markdown
Requires at least: 4.5
Tested up to: 4.5
Stable tag: 4.5
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Dynamically embeds a remotely hosted content.


== Description ==

Brings third party hosted contents within WordPress blog texts.
After installation, it allows you to use shortcode tag [third] with few parameters.

Example:

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`

It will then embed remote markdown content inside your blog.
Additionally, it will convert to HTML using <a href="https://github.com/erusev/parsedown">Parsedown</a>.

= Parameters explained =

**source**: Where to seek the data (eg. Content Hosting Server). Examples:

 - markdown
 - wikipedia (work in progress); [Join development](https://goo.gl/89KgSC)
 - database (work in progress); [Join development](https://goo.gl/89KgSC)
 - url/api (work in progress); [Join development](https://goo.gl/89KgSC)
 - file (work in progress); [Join development](https://goo.gl/89KgSC)

**id**: Content ID (unique identifier) of the data you want. Often, full URL as well.

**section**: Additional parameter to identify the particular section (piece) of the content.


== Installation ==

= Method #1 =

 * Download this plugin as a .zip file.
 * Go to WP Admin > Plugins > Add new > Upload Plugin.
 * Upload the .zip file and activate the plugin.


= Method #2 =

 * Go to your WP Admin > Plugins > Add New page.
 * Search for "hosted content importer".
 * Click install. 


== Frequently Asked Questions ==

= How can I use it? =

Write a WordPress shortcode with a full URL to your .md file on remote server.

Example:

`[third source="markdown" id="FULLURL/README.md" section=""]`


= How does it work =

The plugin brings your content using the defined Source with ID and Section. The parameters is a stable list of names proposed for *future development* in order to include more sources like WikiPedia, File, API, URL and Database.


= Does it work for everyone? =

Yes, but not necessarily. The usage is very tricky. You can remotely host your .md files and embed them in your blogs. In some cases, you may consider editing this plugin and adding your own methods.


== Screenshots ==

1. Usage Example for "seo.md" file on a remote server with full URL. View raw [seo.md](https://goo.gl/GFgqwp) file.

2. Output inside your blog.


== Changelog ==

Please view the original development at: https://goo.gl/89KgSC for details, further plans and todos.

= 1.0 =
* cURL follow redirects - now can use shortened URLs.
* Added usage examples in readme.md.


== Upgrade Notice ==

When this plugin is disabled, your blogs will show your [third] shortcode as it is, which may reveal your associated parameters.
