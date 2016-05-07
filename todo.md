## @todo

 * Remove unfinished classes
 * On a too big amout of files, pages or posts, it may be slower.

## Others

 * Give URLs from a central configuration
 * Create a link in admin area to purge caches
 * If remote fectching failed:
    - reuse the expired cache once
    - do not write over the cache with empty contents
 * Cache the output for 2 reasons; plan to have cache="true|false" 
    - It may not be good to communicate over servers for each page serving
    - Contents are generally static
    - Configurable cache duration

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
 * Shortcode tag [third] may collide with some other plugins (not sure)
 * A report on which pages and posts utilised [third] shortcode tags


## Important changes

 * Allows shortened URLs
 * Standardized the parameters across multiple sources
   - source
   - id
   - section
  * Published the plugin (4/17/2016): https://wordpress.org/plugins/hosted-content-importer/
