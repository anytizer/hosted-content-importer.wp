# HCI: Hosted Content Importer

Includes a third-party content within WordPress blog texts.

This plugin is a for a solution to a specific problem.
WordPress developers should expand the **hosted_content_importer::*hci_SOURCE*()** interface to make it work for their application.


## Experimental Work

 * This work maynot suit your purpose, by its nature.
 * It is an experimental and proof-of-concept work.
 * Please do NOT use it in your production environment.
 * Enable caches.


## Usage examples

 * [third source="database" id="0" section="0"]
 * [third source="api" id="0" section="0"]
 * [third source="url" id="0" section="0"]
 * [third source="wikipedia" id="PHP" section="Security"]
 * [third source="wikipedia" id="At_sign" section="Programming"]
 * [third source="file" id="dynamic.php" section=""]
 * [third source="markdown" id="https://raw.githubusercontent.com/bimalpoudel/hosted-content-importer/master/README.md" section=""]


### Parameters

 * **Source**: Where to seek the data (eg. Content Hosting Server). Examples:
    - markdown
    - wikipedia
    - database
    - url/api
    - file
 * **ID**: Content ID (unique identifier) of the data you want. Often, full URL as well.
 * **Section**: Additional parameter to identify the particular section (piece) of the content.


## Dependency

 * Uses [Parsedown](http://parsedown.org) to mark down the HTML output.


## Deployment

 * This work is published publicly at WordPress as a plugin | [Download](https://wordpress.org/plugins/hosted-content-importer/)
 * [View SVN Repository](https://plugins.svn.wordpress.org/hosted-content-importer/)
 * Active development takes in [GitHub](https://github.com/bimalpoudel/hosted-content-importer) only
