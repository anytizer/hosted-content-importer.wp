# Hosted Content Importer (HCI)

Includes a third-party content within WordPress blog texts.

This plugin is a for a solution to a specific problem. WordPress developers should expand the **$processor->fetch()** interface to make it work for their application.

**Built On, using**

 * WordPress: Version 4.5.2
 * MariaDB Version 10.1.13
 * PHP: Version 7.0.5
 * Apache: Version: 2.4.18


Others

 * [Gist](https://gist.github.com/) - for embeding gist snippets
 * [JotForm](https://jotform.com/) - for embeding web forms
 * [Parsedown](https://github.com/erusev/parsedown) - for rendering .md files


## Experimental Work

 * It is an experimental and proof-of-concept work.
 * This work may not suit your purpose, by its nature.


## Usage examples

 * `[third source="PROCESSOR" id="ID/URL" section="" cache="true|false"]`


### Implemented

 * [third source="analytics" id="UA-00000000-0" section=""]
 * [third source="database" id="0" section="0"] - partially developed, left for developers
 * [third source="file" id="/tmp/static.txt" section=""]
 * [third source="gist" id="0000000000" section="file.php"]
 * [third source="jotform" id="0000000000" section=""]
 * [third source="markdown" id="https://.../readme.md" section=""]
 * [third source="youtube" id="v0000000000" section=""]


### Work|Concepts in Progress

 * [third source="api" id="0" section="0"]
 * [third source="url" id="0" section="0"]
 * [third source="wikipedia" id="PHP" section="Security"]
 * [third source="wikipedia" id="At_sign" section="Programming"]


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

 * Published publicly as a [WordPress Plugin](https://wordpress.org/plugins/hosted-content-importer/)
 * [View SVN Repository](https://plugins.svn.wordpress.org/hosted-content-importer/)
 * Active development takes in [GitHub](https://github.com/bimalpoudel/hosted-content-importer) only
