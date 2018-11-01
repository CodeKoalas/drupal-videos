<?php

namespace Drupal\youtube_playlist_importer;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Youtube Video entities.
 *
 * @ingroup youtube_playlist_importer
 */
class YoutubeVideoListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Youtube Video ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\youtube_playlist_importer\Entity\YoutubeVideo */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.youtube_video.edit_form',
      ['youtube_video' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
