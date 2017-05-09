<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/*Remove Post and Page in Search*/

function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
  return $query;
}
add_filter('pre_get_posts','SearchFilter');

/*Remove HTML Tags in Comment*/

function remove_html($comment) {
   return strip_tags($comment, '<strong><b><em><p>');
}
add_filter('get_comment_text', 'remove_html');