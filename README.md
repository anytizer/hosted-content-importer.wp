# HCI: Hosted Content Importer

Include a third-party content within WordPress blog texts.

This plugin is a for a solution to a specific problem.
WordPress developers should expand the **hosted_content_importer::*hci_SOURCE*()** interface to make it work for their application.


## Experimental Work

 * This work maynot suit your purpose, by its nature.
 * But it is an experimental and proof-of-concept work.
 * Please do NOT use it in your production environment.


## Usage examples

 * [third source="database" id="0" section="0"]
 * [third source="api" id="0" section="0"]
 * [third source="url" id="0" section="0"]
 * [third source="wikipedia" id="PHP" section="Security"]
 * [third source="wikipedia" id="At_sign" section="Programming"]
 * [third source="file" id="dynamic.php" section=""]
 * [third source="markdown" id="https://raw.githubusercontent.com/bimalpoudel/hosted-content-importer/master/README.md" section=""]


### Parameters

 * **Source**: Where to seek the data.
 * **ID**: Content ID (unique identifier) of the data you want.
 * **Section**: Additional parameter to identify the particular part of the content being fetched


## Dependency

 * Uses [Parsedown](http://parsedown.org) to mark down the HTML output.
