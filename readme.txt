=== Z-URL Preview ===
Tags: link preview, post, excerpt, Facebook type preview, linkedin type preview
Requires at least: 4.2
Tested up to: 4.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin to embed a preview of a link, similar to facebook

== Description ==
This plugin fetches an excerpt of an external website link. The excerpt contains the title, description and image.

The options page allows the following to be set:

- CSS to change the look and feel of the generated links.

- The article source label. (Default "Source:")

- Control of new window opening. Options are 'target="_blank"', 'target="newwindow"', 'rel="external"' and opening in the same window. (Default 'target="_blank"')

The defaults are designed to suit most people.

Added the cacert.pem which CURL uses for https sites from http://curl.haxx.se/ca/cacert.pem (the home of CURL).

ToDo: Longer term, configurable options for sites without an image and selecting from multiple OG images.

Thank you to Abhishek Saha for publishing the original URL Preview at https://wordpress.org/plugins/link-preview/ which this is based on and for the WP review team for their help in conforming to coding rules.

== Screenshots ==

1. Select the "add preview link" button.
2. Enter the URL in the pop-up.
3. Preview and edit, where needed, the contents.
4. Default presentation client-side.
5. Settings screen.

== Changelog ==

= 1.4.4 =
* Adjusted title detection (due to issue with BBC News site)

= 1.4.3 =
* Added option to control how/if the link opens a new window

= 1.4.2 =
* Added source / link label option into settings

= 1.4.1 =
* Corrected css path

= 1.4 =
* First published version

= 1.3 =
* Fixes / Corrections to WP guidelines

= 1.2 =
* Fixes / Corrections

= 1.1 =
* Fixes / Corrections

= 1.0 =
* First version / Fork
