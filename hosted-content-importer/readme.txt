=== Hosted Content Importer ===

Contributors: pbimal
Donate link: http://bimal.org.np/
Tags: hci, third, hosted, embed, remote
Requires at least: 4.5
Tested up to: 4.5
Stable tag: 4.5
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Dynamically embeds a remotely hosted content.


== Description ==

Brings third party hosted contents within WordPress blog texts.
After installation, it allows you to use tag, [third] with few parameters.

Example:
[third source="markdown" id="https://raw.githubusercontent.com/erusev/parsedown/master/test/data/aligned_table.html" section=""]

It will then embed remote markdown content inside your blog.
Additionally, it will convert to HTML using Parsedown.

= Parameters =

source: Where to seek the data (eg. Content Hosting Server). Examples:
 - markdown
 - wikipedia (work in progress)
 - database (work in progress)
 - url/api (work in progress)
 - file (work in progress)

id: Content ID (unique identifier) of the data you want. Often, full URL as well.

section: Additional parameter to identify the particular section (piece) of the content.


== Installation ==

Method #1

 * Download the plugin as a .zip file.
 * Go to Plugins > Add new > Upload Plugin.
 * Upload the .zip file and activate the plugin.


Method #2

 * Within your plugins page, search for "hosted content importer" and install. 


== Frequently Asked Questions ==

= How can I use it? =

Define a WordPress shortcode with a full URL to your .md file on remote server.

Example:
[third source="markdown" id="FULLURL/README.md" section=""]


= Does it work for everyone? =

Not necessarily. The usage is very tricky. You can remotely host your .md files and embed them in your blogs. In some cases, you may consider editing this plugin and adding your own methods.


== Screenshots ==

1. Usage Example.

2. Output in a page.


== Upgrade Notice ==


== Changelog ==

= 1.0 =

* Added usage examples in readme.md.
