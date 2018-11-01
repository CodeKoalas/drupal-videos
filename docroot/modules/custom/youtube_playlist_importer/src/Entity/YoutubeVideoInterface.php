<?php

namespace Drupal\youtube_playlist_importer\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Youtube Video entities.
 *
 * @ingroup youtube_playlist_importer
 */
interface YoutubeVideoInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Youtube Video name.
   *
   * @return string
   *   Name of the Youtube Video.
   */
  public function getName();

  /**
   * Sets the Youtube Video name.
   *
   * @param string $name
   *   The Youtube Video name.
   *
   * @return \Drupal\youtube_playlist_importer\Entity\YoutubeVideoInterface
   *   The called Youtube Video entity.
   */
  public function setName($name);

  /**
   * Gets the Youtube Video creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Youtube Video.
   */
  public function getCreatedTime();

  /**
   * Sets the Youtube Video creation timestamp.
   *
   * @param int $timestamp
   *   The Youtube Video creation timestamp.
   *
   * @return \Drupal\youtube_playlist_importer\Entity\YoutubeVideoInterface
   *   The called Youtube Video entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Youtube Video published status indicator.
   *
   * Unpublished Youtube Video are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Youtube Video is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Youtube Video.
   *
   * @param bool $published
   *   TRUE to set this Youtube Video to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\youtube_playlist_importer\Entity\YoutubeVideoInterface
   *   The called Youtube Video entity.
   */
  public function setPublished($published);

}
