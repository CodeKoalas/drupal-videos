<?php

namespace Drupal\youtube_playlist_importer\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Youtube Video edit forms.
 *
 * @ingroup youtube_playlist_importer
 */
class YoutubeVideoForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\youtube_playlist_importer\Entity\YoutubeVideo */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Youtube Video.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Youtube Video.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.youtube_video.canonical', ['youtube_video' => $entity->id()]);
  }

}
