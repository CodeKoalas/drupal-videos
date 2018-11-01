<?php

namespace Drupal\youtube_playlist_importer\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

require_once __DIR__ . '/vendor/autoload.php';
session_start();

// Valid section types.
$SECTION_TYPES = array("allPlaylists", "completedEvents", "likedPlaylists",
  "likes", "liveEvents", "multipleChannels", "multiplePlaylists",
  "popularUploads", "recentActivity", "recentPosts", "recentUploads",
  "singlePlaylist", "upcomingEvents");

// Valid section styles.
$SECTION_STYLES = array("horizontalRow", "verticalList");

// Replace with section title of your choice.
$SECTION_TITLE = 'YOUR_SECTION_TITLE';

// The section's position on the channel page. This property uses a 0-based index.
// If you do not specify a value for this property when inserting a channel section,
// the default behavior is to display the new section last.
$SECTION_POSITION = 0;

// A list of playlist IDs that will be featured in a channel section.
$PLAYLISTS = '';

// A list of channel IDs that will be  featured in a channel section.
$CHANNELS = '';

/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$OAUTH2_CLIENT_ID = $config->get('oauth2_client_id');
$OAUTH2_CLIENT_SECRET = $config->get('oauth2_client_secret');

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
  FILTER_SANITIZE_URL);
$client->setRedirectUri($redirect);

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);

// Check if an auth token exists for the required scopes
$tokenSessionKey = 'token-' . $client->prepareScopes();
if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    die('The session state did not match.');
  }

  $client->authenticate($_GET['code']);
  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
  header('Location: ' . $redirect);
}

if (isset($_SESSION[$tokenSessionKey])) {
  $client->setAccessToken($_SESSION[$tokenSessionKey]);
}


/**
 * Class YoutubeImporterImportForm.
 */
class YoutubeImporterImportForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'youtube_playlist_importer.youtubeimporterimport',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'youtube_importer_import_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('youtube_playlist_importer.youtubeimporterimport');
    $form['playlist_url'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Playlist URL'),
      '#description' => $this->t('Input the Youtube playlist URL to import the Youtube videos to the site.'),
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

    // Sample php code for playlistItems.list

    $service = '';

    function playlistItemsListByPlaylistId($service, $part, $params) {
      $params = array_filter($params);
      $response = $service->playlistItems->listPlaylistItems(
        $part,
        $params
      );

      print_r($response);
    }

    playlistItemsListByPlaylistId($service,
      'snippet,contentDetails',
      array('maxResults' => 25, 'playlistId' => 'PLBCF2DAC6FFB574DE'));

    $this->config('youtube_playlist_importer.youtubeimporterimport')
      ->set('playlist_url', $form_state->getValue('playlist_url'))
      ->save();
  }

}
