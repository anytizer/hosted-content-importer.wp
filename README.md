# HCI: Hosted Content Importer

WordPress plugin to fetch programmed (dynamic) contents from third party resources.

This plugin is a for a solution to specific problem.
WordPress developers should expand the *hci_* interface to make work for their application.
It just shows some guidelines on how to implement.

It is NOT for common purpose.


## Usage examples

 * [third id="0"]
 * [third id="0" section="0"]
 * [third source="database" id="0" section="0"]
 * [third source="url" id="0" section="0"]
 * [third source="wikipedia" id="PHP" section="Security"]
 * [third source="file" id="dynamic.php"]

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
