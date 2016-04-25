# @todo

 * When source="" is missing; use none.
 * caches/ needs to have processor folder.
 * Relocate the cache path to make plugin skinny.
 * Include HTTP Referer using Blog Info (Calculated)
 * Cache the output for 2 reasons; plan to have cache="true|false" 
    - It may not be good to communicate over servers for each page serving
    - Contents are generally static
    - Configurable cache duration

 * Replace curl with (HTTP_API](https://codex.wordpress.org/HTTP_API)
 * Merge the class files for optimization purpose.
 * Write article around it
 * Make it installable via composer
 * Support multiple sources of contents and their fetchers.
 * Support tailored parameters per fetcher.
 * Make each fetcher as an independent class file.
 * Free the HTML output (`<div>`) from being wrapped inside `<p>` tags.
 * Auto calculate and use: Slug, Post ID, Post Title
 * Import contents from Wikipedia section
 * Import contents from local (mysql) database
 * Import contents from URL Calls, API Calls
 * Import contents from local files
 * Check if HCI constants are pre-defined and configured:
   - HCI_WIKIPEDIA_API_URL
   - HCI_CUSTOM_API_URL
 * Shortcode tag [third] may collide with some other plugins (not sure)
 * A report on which pages and posts utilised [third] shortcode tags


# Important changes

 * Allows shortened URLs
 * Standardized the parameters across multiple sources
   - source
   - id
   - section
  * Published the plugin (4/17/2016): https://wordpress.org/plugins/hosted-content-importer/
