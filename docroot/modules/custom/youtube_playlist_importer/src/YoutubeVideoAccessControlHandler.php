<?php

namespace Drupal\youtube_playlist_importer;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Youtube Video entity.
 *
 * @see \Drupal\youtube_playlist_importer\Entity\YoutubeVideo.
 */
class YoutubeVideoAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\youtube_playlist_importer\Entity\YoutubeVideoInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished youtube video entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published youtube video entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit youtube video entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete youtube video entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add youtube video entities');
  }

}
