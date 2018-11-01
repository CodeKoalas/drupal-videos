<?php

namespace Drupal\youtube_playlist_importer\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Youtube Video entities.
 */
class YoutubeVideoViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
