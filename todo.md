# @todo
 * Cached folders to become NOT browsable

 * Warnings:
	source="file" could be risky on a compromised server

 * DynaTable: JSON to HTML Table may be handy.
 * On deactivate, clear the cached files.
 * While writing a cache file, refresh the filemtime.
 * Analytics output should go into wp_footer(): add_action('wp_footer, 'analytics');
	- https://generatewp.com/easy-custom-mobile-chrome-address-bar-colors-wordpress/
 * Put link to Reports (in plugin listing).
 * In a table, record which cache file was used in which post?
 * Produce a corresponding log file to trace caches into posts.
 * Document QR Code usage, properly.
 * Remove unfinished classes.
 * On a too big amount of files, pages or posts, it may slow down (admin report pages).
 * Supply testing scripts with various reasons.
 * Auto code formatting has merged array key/values in one single line.
 * Download Parsedown on demand on first installation.
 * If undefined parameters are passed, pass them as separate array.
	eg. YouTube: Height, Width
 * Show reports in tabbed pages.
	- https://jqueryui.com/tabs/#default
 * When cache file is used, mention it as HTML Comments.
 * When plugin is uninstalled, remove the cache files.


## Others

 * Give URLs from a central configuration
 * If remote fectching failed:
    - reuse the expired cache once
    - do not write over the cache with empty contents
 * Cache the output for 2 reasons; plan to have cache="true|false" 
    - It may not be good to communicate over servers for each page serving
    - Contents are generally static
    - Configurable cache duration
    - Some caches may remain permanently as is.

 * Replace curl with (HTTP_API](https://codex.wordpress.org/HTTP_API)
 * Write an article around it
 * Make it installable via composer
 * Free the HTML output (`<div>`) from being wrapped inside `<p>` tags
 * Import contents from local (mysql) database (Examples needed)
 * Import contents from URL Calls, API Calls
 * Import contents from Wikipedia section
 * Check if HCI constants are pre-defined and configured:
   - HCI_WIKIPEDIA_API_URL
   - HCI_CUSTOM_API_URL
 * Shortcode tag [third] may collide with some other third party plugins (not sure)


## Important changes

 * Multiple content processors added
 * Reports page created
 * cURL allows shortened URLs
 * Standardized the parameters across multiple sources
   - source
   - id
   - section
  * Published the plugin (4/17/2016): https://wordpress.org/plugins/hosted-content-importer/
