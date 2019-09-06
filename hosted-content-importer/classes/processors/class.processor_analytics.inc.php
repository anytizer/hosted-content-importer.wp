<?php

/**
 * Google Analytics
 * Seems to be odd to process with shortcode, but works to track specific pages
 * Normally expected to be at the end of theme's footer only.
 *
 * Usage Example: [third source="analytics" id="UA-XXXXXXXX-X" section=""]
 */
class processor_analytics extends hosted_content_interface
{
	protected $as_is = true;
	protected $development_completed = true;

	public function fetch($tracking_code = 'UA-XXXXXXXX-X', $section = null, $others=array())
	{
		$tracking_code = esc_attr($tracking_code);
		$analytics = "
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', '{$tracking_code}', 'auto');
  ga('send', 'pageview');
</script>";

		return $analytics;
	}
}
