<?php

/**
 * @file
 * Contains youtube_video.page.inc.
 *
 * Page callback for Youtube Video entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Youtube Video templates.
 *
 * Default template: youtube_video.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_youtube_video(array &$variables) {
  // Fetch YoutubeVideo Entity Object.
  $youtube_video = $variables['elements']['#youtube_video'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
