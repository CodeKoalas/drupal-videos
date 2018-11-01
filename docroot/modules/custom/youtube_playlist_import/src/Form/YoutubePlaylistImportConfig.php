<?php

namespace Drupal\youtube_playlist_import\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class YoutubePlaylistImportConfig.
 */
class YoutubePlaylistImportConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'youtube_playlist_import.youtubeplaylistimportconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'youtube_playlist_import_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('youtube_playlist_import.youtubeplaylistimportconfig');
    $form['oauth2_client_id'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Oauth2 Client ID'),
      '#description' => $this->t('Input the Oauth2 Client ID associated with your Google app.'),
      '#default_value' => $config->get('oauth2_client_id'),
    ];
    $form['oauth2_client_secret'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Oauth2 Client Secret'),
      '#description' => $this->t('Input the Oauth2 Client Secret associated with your Google app.'),
      '#default_value' => $config->get('oauth2_client_secret'),
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

    $this->config('youtube_playlist_import.youtubeplaylistimportconfig')
      ->set('oauth2_client_id', $form_state->getValue('oauth2_client_id'))
      ->set('oauth2_client_secret', $form_state->getValue('oauth2_client_secret'))
      ->save();
  }

}
