# HCI: Hosted Content Importer

WordPress plugin to fetch and insert dynamically programmed contents from third party sources.

This plugin is a for a solution to specific problem and it is NOT for common purpose.
WordPress developers should expand the *hci_* interface to make it work for their application.
It just shows some guidelines on how to implement.


## Experimental Work

This work cannot suit your purpose, by its nature.
It is an experimental and proof of concept work.
Please do NOT use it in your production environment.


## Usage examples

 * [third id="0"]
 * [third id="0" section="0"]
 * [third source="database" id="0" section="0"]
 * [third source="api" id="0" section="0"]
 * [third source="url" id="0" section="0"]
 * [third source="wikipedia" id="PHP" section="Security"]
 * [third source="file" id="dynamic.php"]
 * [third source="markdown" id="https://raw.githubusercontent.com/bimalpoudel/hosted-content-importer/master/README.md" section=""]


### Meanings

 * **Source**: Where to seek the data.
 * **ID**: Content ID of the data you want.
 * **Section**: Additional parameter to identify the part of content being fetched


## Settings

In wp-settings.php file, add and configure the below lines.

```
define('HCI_WIKIPEDIA_API_URL', 'https://en.wikipedia.org/w/api.php');
define('HCI_CUSTOM_API_URL', 'http://SERVER/PATH/URL.php');
```

## Inspirations

The following application(s) inspired the birth of this Plugin:

Gist GitHub Shortcode by Claudio Sanches.
 * http://claudiosmweb.com/
 * https://wordpress.org/plugins/gist-github-shortcode/
 * https://github.com/claudiosmweb/gist-github-shortcode

Adds GitHub Gists in your posts via shortcode.

```
[gist id="0000000"]
[gist id="0000000" file="index.php"]
```
