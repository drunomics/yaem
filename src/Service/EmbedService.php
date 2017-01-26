<?php

namespace Drupal\yaem\Service;

use Drupal\yaem\Form\EmbedSettingsForm as Settings;

use Embed\DataInterface;
use Embed\Embed;
use Drupal\Core\Config\ConfigFactory;

/**
 * A service class for handling URL embeds.
 */
class EmbedService implements EmbedServiceInterface {

  /**
   * Configuration.
   *
   * @var array
   */
  public $config;

  /**
   * Factory to get the renderer plugin.
   *
   * @var RendererPluginManagerInterface
   */
  protected $rendererManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactory $configFactory, RendererPluginManagerInterface $rendererManager) {
    $this->rendererManager = $rendererManager;
    $settings = $configFactory->get(YAEM_SETTINGS);

    $config = [
      'oembed' => [
        'parameters' => [],
      ],
      'google' => [],
    ];

    if (!empty($settings->get(Settings::OEMBED_EMBEDLY_KEY))) {
      $config['oembed']['embedly_key'] = $settings->get(Settings::OEMBED_EMBEDLY_KEY);
    }

    if (!empty($settings->get(Settings::OEMBED_IFRAMELY_KEY))) {
      $config['oembed']['iframely_key'] = $settings->get(Settings::OEMBED_IFRAMELY_KEY);
    }

    if (!empty($settings->get(Settings::GOOGLE_KEY))) {
      $config['google']['key'] = $settings->get(Settings::GOOGLE_KEY);
    }

    $this->config = $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig() {
    return $this->config;
  }

  /**
   * {@inheritdoc}
   */
  public function setConfig(array $config) {
    $this->config = $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getEmbed($request) {
    $embed = NULL;

    try {
      $embed = Embed::create($request, $this->config);
    }
    catch (\Exception $e) {
      watchdog_exception(YAEM, $e);
    }

    return $embed;
  }

  /**
   * {@inheritdoc}
   */
  public function getRenderer(DataInterface $embed) {
    return $this->rendererManager->getInstance(['embed' => $embed]);
    // return $this->rendererFactory->getRenderer($embed);
  }

  /**
   * {@inheritdoc}
   */
  public function render(DataInterface $embed) {
    return $this->getRenderer($embed)->render($embed);
  }

  /**
   * {@inheritdoc}
   */
  public function renderUrl($url) {
    if ($embed = $this->getEmbed($url)) {
      return $this->render($embed);
    }

    return [];
  }

}
