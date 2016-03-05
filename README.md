# HCI: Hosted Content Importer

WordPress plugin to fetch programmed (dynamic) contents from third party resources.

This plugin is a solution to specific problem and it is NOT really for common purpose.
WordPress developers should expand the *hci_* interface to make it suitable for their usage.
It just shows some guidelines on how to do so.


## Usage examples

 * [third id="0"]
 * [third id="0" section="0"]
 * [third source="database" id="0" section="0"]
 * [third source="url" id="0" section="0"]
 * [third source="wikipedia" id="PHP" section="Security"]
 * [third source="file" id="dynamic.php"]


## Settings

In wp-settings.php file, add and configure the below lines.

```
define('HCI_WIKIPEDIA_API_URL', 'https://en.wikipedia.org/w/api.php');
define('HCI_CUSTOM_API_URL', 'http://SERVER/PATH/URL.php');
```
