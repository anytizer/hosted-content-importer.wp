=== Hosted Content Importer (HCI) ===

Contributors: pbimal
Donate link: http://bimal.org.np/
Tags: cached, content, embed, external, gist, hci, hosted, import, markdown, remote, shortcode, third
Requires at least: 4.5.0
Tested up to: 4.5.2
Stable tag: 2.0.2
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html


Embeds a remotely hosted content. Contributors can edit a tiny piece of your blog text externally, without having ANY access to your website.


== Description ==

It imports third party hosted contents within WordPress blog texts. You define from which url/resource to fetch the content. The source may be editable by anyone else whom you trust. Thus, it logically empowers you to allow other users to externally edit a particular section of your blogs. And, you do not have to give them any access to your website.

After installation, use shortcode tag `[third]` with few parameters as:

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`

It will then embed remote markdown content inside your blog.
Additionally, it will convert the text into HTML using <a href="https://github.com/erusev/parsedown">Parsedown</a>.

= Parameters =

**source**: Where to seek the data (eg. Content Hosting Server). Examples:

 - markdown: &#x2714; implemented
 - file: &#x2714; implemented
 - gist: &#x2714; implemented
 - jotform: &#x2714; implemented
 - database (partially implemented, and left for developers) - [Join/Fork Development](https://goo.gl/89KgSC)
 - wikipedia (work in progress) - [Join/Fork Development](https://goo.gl/89KgSC)
 - url/api (work in progress) - [Join/Fork Development](https://goo.gl/89KgSC)
 - The list is not limited, if you expand it.

**id**: Content ID (unique identifier) of the data you want. Often, full URL as well.

**section**: Additional parameter to identify the particular section (piece) of the content.


= Example: Parsing a remote .md file =

`[third source="markdown" id="https://goo.gl/UpclKH" section=""]`

Learn to write your [.md file](http://parsedown.org/demo).


= Example: Embeding a gist code from GitHub =

`[third source="gist" id="000000000000" section="filename.php"]`

Create [your gists at GitHub](https://gist.github.com/).


= Example: Embeding a JotForm =

`[third source="jotform" id="000000000000" section=""]`

Create your own form at [JotForm website](https://jotform.com/).


= Example: Reading a server's local file =

`[third source="file" id="/tmp/readme.txt" section=""]`

It hast to be a static file for security reasons. For example, if you read the .php file, it will NOT process it, rather read its contents only. Your can contain valid HTML data, css and javascripts.


= Example: Accessing database =

`[third source="database" id="0" section="recent"]`

Some implementations are left for developers because of the nature. This plugin acts as proof of concept reference. Please feel free to modify/expand it.


= Example: Embeding a YouTube Video =

`[third source="youtube" id="v00000000000" section=""]`

Choose your video from [YouTube](https://www.youtube.com/).

You may often consider writing your own Content Processor. Refer to Custom Content Processor section in Other Notes.


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
 * Upload folder hosted-content-importer (you just unziped) to /wp-content/plugins/ directory.
 * Activate the plugin through the WP Admin > Plugins menu.


== Frequently Asked Questions ==

= How can I use it? =

Within your blog post or page, write a insert the similar snippet below:

Example:

`[third source="markdown" id="FULLURL/README.md" section=""]`

Your URL (ID) should be a full URL to your .md file on remote server.

There are several other ways to include remote contents. Each unique content is processed by its own processor. [View Source Codes](https://github.com/bimalpoudel/hosted-content-importer/tree/master/hosted-content-importer/classes/processors).


= How does it work? =

The plugin brings your contents using the defined Source's ID and Section. The parameters (source, id, section) are a stable list of names proposed to long term support the *future development*. When we add new Content Processes, they are less likely to change.


= Does it work for everyone? =

Yes, but not necessarily. The usage is very tricky. You can remotely host your .md files and embed them in your blogs. In some cases, you may consider editing this plugin and adding your own methods.


= What happens if the third party content source is down? =

We never thought of that downtime. In new release, a cache is enabled.


= Are all the content sources processors implemented fully? =

By the nature of the product, no. However, You can consider `source="markdown"` and `source="file"` as a completed codes. Any other implementation may require you to modify your plugin to suit it for yourself.


= Is it safe to embed third party contents? =

As a matter of rule, do not embed something that you do not trust at all. Implementation should be designed NOT to reveal API access details or anything else. Limit the access only to the standard parameters only. Other private details should be defined within the content processor class files. It does NOT execute PHP scripts from remote contents. But HTML yes - which means, it can consume external image, css, javascripts, media files, etc.

If you are maintainer of a portion of the content of any other websites, act responsibly; do NOT commit any unsafe contents. When you edit some file that you have access to, it may affect someone else's website that you are authorised to manage contents.

Be good, do good. **Always** import contents onlly from the sources that you trust.

Also, you can create and host your own Micro Content Services. [See an Example](https://goo.gl/UOzOGI).


= How to safeguard my remote contents? =

The answer is beyond the scope of this plugin. But, always consume content from trusted sources only. Security depends on how you use remote contents. If the remote content is distorted, it may reflect back in your website. Do not allow weak security on your remotely edited contents. Files uploaded via Dropbox, GitHub, FTP/SSH, SVN/GIT may be considered safe as they require password to upload the contents.


== Screenshots ==

1. Usage Example for "seo.md" file on a remote server with full URL. View raw [seo.md](https://goo.gl/GFgqwp) file.

2. Output inside your blog.

3. Reports on `[third]` tags usages and cached files.


== Changelog ==

Please view the original development at: https://goo.gl/89KgSC for details and further plans.

= 2.0.2 =
* YouTube added.
* View reports on cached files and delete them.

= 2.0.1 =
* JotForm added.
* SPL Autoloading the content processors.
* Embedding gists: a new gist processor introduced.

= 2.0.0 =
* Product name has HCI word in it.
* WP Admin > Posts > With `[third]` Tags: Reports on which posts/pages used this shortcode.
* Implemented caches to store once-fetched contents locally.

= 1.0.0 =
* Forced not to cache in cURL.
* Use cases explained for developers: when to use which content source processor.
* Initial release.


== Upgrade Notice ==

When this plugin is used and disabled, your blogs will show your `[third]` shortcode as it is, which may reveal your associated parameters. The precautionary design does not allow username/password and API keys in the shortcode tags.

= Safety Precaution =

If you want to discontinue using this plugin; first, find out which posts and pages have used this shortcode. WP Admin > Pages > With [third] Tags.


== Custom Content Processors ==

If you want to develop your own Content Processor, it is much easier now.
Just create a tiny class file inside **classes/processors** as like one of the existing one. Simple examples are YouTube, JotForm and Gist processors. 

= Minimum requirements =

1. File name: `class.processor_YOURNAME.inc.php`
2. Method: `public function fetch($form_id = null, $section = null)`.
  * Process your content.
  * Return HTML string.
  * For references, see `class.processor_none.inc.php`
3. Use as: `[third source="YOURNAME" section=""]`

Just that much easy drop-in replacement.
