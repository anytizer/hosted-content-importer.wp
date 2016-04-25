=== Hosted Content Importer (HCI) ===

Contributors: pbimal
Donate link: http://bimal.org.np/
Tags: cached, content, embed, external, hci, hosted, import, markdown, remote, third
Requires at least: 4.5
Tested up to: 4.5
Stable tag: 2.0.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html


Embeds a remotely hosted content. Maintainers can edit a tiny piece of your blog text externally, without having ANY access to your website.


== Description ==

It imports third party hosted contents within WordPress blog texts. You define from which url/resource to fetch the content. The source may be editable by anyone else whom you trust. Thus, it logically empowers you to allow other users to externally edit a particular section of your blogs. And, you do not have to give them any access to your website.

After installation, use shortcode tag `[third]` with few parameters as:

Example:

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`

It will then embed remote markdown content inside your blog.
Additionally, it will convert the text into HTML using <a href="https://github.com/erusev/parsedown">Parsedown</a>.

= Parameters explained =

**source**: Where to seek the data (eg. Content Hosting Server). Examples:

 - markdown: implemented
 - file: implemented
 - database (implemented, and left for developers) - [Join development](https://goo.gl/89KgSC)
 - wikipedia (work in progress) - [Join development](https://goo.gl/89KgSC)
 - url/api (work in progress) - [Join development](https://goo.gl/89KgSC)
 - The list is not limited, if you expand it.

**id**: Content ID (unique identifier) of the data you want. Often, full URL as well.

**section**: Additional parameter to identify the particular section (piece) of the content.


= Example: Reading from a remote .md file =

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`


= Example: Reading from a local file =

`[third source="file" id="/tmp/readme.txt" section=""]`


= Example: Accessing database =

`[third source="database" id="0" section="recent"]`

Some implementations are left for developers because of the nature. This plugin should act as proof of concept in such cases. Please feel free to modify it.


== Installation ==


= Method #1 =

 * Go to your WP Admin > Plugins > Add New page.
 * Search for "Hosted Content Importer".
 * Click install. Click activate.


= Method #2 =

 * Download this plugin as a .zip file.
 * Go to WP Admin > Plugins > Add new > Upload Plugin.
 * Upload the .zip file and activate the plugin.


= Method #3 =

 * Download the file hosted-content-importer.zip.
 * Unzip the file on your computer.
 * Upload folder correct-me (you just unziped) to /wp-content/plugins/ directory.
 * Activate the plugin through the WP Admin > Plugins menu.


== Frequently Asked Questions ==

= How can I use it? =

Write a WordPress shortcode with a full URL to your .md file on remote server.

Example:

`[third source="markdown" id="FULLURL/README.md" section=""]`


= How does it work =

The plugin brings your content using the defined Source with ID and Section. The parameters is a stable list of names proposed for *future development* in order to include more sources like WikiPedia, File, API, URL and Database.


= Does it work for everyone? =

Yes, but not necessarily. The usage is very tricky. You can remotely host your .md files and embed them in your blogs. In some cases, you may consider editing this plugin and adding your own methods.


= Are all the content sources processors implemented fully? =

By the nature of the product, no. However, You can consider `source="markdown"` and `source="file"` as a complete. Any other implementation may require you to modify your plugin to suit it for yourself.


= Is it safe to embed third party contents? =

As a matter of rule, do not embed something that you do not trust at all. Implementation should be designed NOT to reveal API access details or anything else. Limit the access only to the standard parameters only. Other private details should be defined within the content processor class files. It does NOT execute PHP scripts from remote contents. But HTML yes - which means, it can consume external image, css, javascripts, media files, etc.

If you are maintainer of a portion of the content of any website, act responsibly; NOT to commit any unsafe contents. When you edit some file that you have access to, it may affect someone else's website that you are authorised to manage contents.

Behavioural policy: Be good, do good. Always import contents from trusted source only.


= How to safeguard my remote contents? =

The answer is beyond the scope of this plugin. But, always consume content from trusted sources only. Security depends on how you use remote contents. If the remote content is distorted, it may reflect back in your website. Do not allow weak security on your remotely edited contents. Sources like Dropbox, GitHub, FTP may be considered safe as they require password to upload the contents.


== Screenshots ==

1. Usage Example for "seo.md" file on a remote server with full URL. View raw [seo.md](https://goo.gl/GFgqwp) file.

2. Output inside your blog.


== Changelog ==

Please view the original development at: https://goo.gl/89KgSC for details, further plans, and todos.

= 2.0.0 =
* Product name has HCI word in it.
* WP Admin > Pages > Pages with [third] Tags as menu option.
* Implemented caches to store them locally.
* Relocated assets.

= 1.0.0 =
* Forced not to cache in cURL.
* Use cases explained for developers: when to use which content source processor.
* Initial release.


== Upgrade Notice ==

When this plugin is disabled, your blogs will show your `[third]` shortcode as it is, which may reveal your associated parameters.
