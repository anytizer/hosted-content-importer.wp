=== Hosted Content Importer ===

Contributors: pbimal
Donate link: http://bimal.org.np/
Tags: content, embed, external, hci, hosted, markdown, remote, third
Requires at least: 4.5
Tested up to: 4.5
Stable tag: 4.5
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Dynamically embeds a remotely hosted content.


== Description ==

Brings third party hosted contents within WordPress blog texts. Logically, it empowers you to allow other users externally edit a particular section of your blogs, without giving them any access to WordPress system.

After installation, it allows you to use shortcode tag [third] with few parameters.

Example:

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`

It will then embed remote markdown content inside your blog.
Additionally, it will convert to HTML using <a href="https://github.com/erusev/parsedown">Parsedown</a>.

= Parameters explained =

**source**: Where to seek the data (eg. Content Hosting Server). Examples:

 - markdown: implemented
 - file: implemented
 - database (implemented left for developers); [Join development](https://goo.gl/89KgSC)
 - wikipedia (work in progress); [Join development](https://goo.gl/89KgSC)
 - url/api (work in progress); [Join development](https://goo.gl/89KgSC)

**id**: Content ID (unique identifier) of the data you want. Often, full URL as well.

**section**: Additional parameter to identify the particular section (piece) of the content.


= Example: Reading from a remote .md file =

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`


= Example: Reading from a local file =

`[third source="file" id="/tmp/readme.txt" section=""]`


= Example: Accessing database =

`[third source="database" id="0" section="recent"]`

Some implementations are left for developers. This plugin should act as proof of concept. Please feel free to modify it.


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
* Mentioned logical concepts of allowing other users edit portion of your blog externally, without giving them any access to your WordPress system.
* Splitted the fetcher files into individual class files.
* cURL follow redirects - now can use shortened URLs.
* Added usage examples (markdown, file, database) in readme.md.


== Upgrade Notice ==

When this plugin is disabled, your blogs will show your [third] shortcode as it is, which may reveal your associated parameters.
