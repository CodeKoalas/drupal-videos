<?php

namespace Drupal\youtube_playlist_import\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class YoutubePlaylistImporterForm.
 */
class YoutubePlaylistImporterForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'youtube_playlist_import.youtubeplaylistimporter',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'youtube_playlist_importer_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('youtube_playlist_import.youtubeplaylistimporter');
    $form['playlist_url'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Playlist URL'),
      '#description' => $this->t('Input the Youtube playlist URL to import.'),
      '#default_value' => $config->get('playlist_url'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('youtube_playlist_import.youtubeplaylistimporter')
      ->set('playlist_url', $form_state->getValue('playlist_url'))
      ->save();
  }

}
