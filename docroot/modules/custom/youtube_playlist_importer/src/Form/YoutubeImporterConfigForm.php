<?php

namespace Drupal\youtube_playlist_importer\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class YoutubeImporterConfigForm.
 */
class YoutubeImporterConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'youtube_playlist_importer.youtubeimporterconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'youtube_importer_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('youtube_playlist_importer.youtubeimporterconfig');
    $form['oauth2_client_id'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Oauth2 Client ID'),
      '#description' => $this->t('Input the Client ID given via the youtube/google app associated with this account.'),
      '#default_value' => $config->get('oauth2_client_id'),
    ];
    $form['oauth2_client_secret'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Oauth2 Client Secret'),
      '#description' => $this->t('Inpu the Client Secret key given via the youtube/google app associated with this account.'),
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

    $this->config('youtube_playlist_importer.youtubeimporterconfig')
      ->set('oauth2_client_id', $form_state->getValue('oauth2_client_id'))
      ->set('oauth2_client_secret', $form_state->getValue('oauth2_client_secret'))
      ->save();
  }

}
