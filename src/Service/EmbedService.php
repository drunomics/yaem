<?php

namespace Drupal\yaem\Service;

use Drupal\yaem\Form\EmbedSettingsForm as Settings;
use Drupal\yaem\Yaem;
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
   * Embed objects.
   *
   * @var array|DataInterface[]
   */
  protected $embeds = [];

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactory $configFactory, RendererPluginManagerInterface $rendererManager) {
    $this->rendererManager = $rendererManager;
    $settings = $configFactory->get(Yaem::YAEM_SETTINGS);

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
  public function getEmbed($url) {
    $key = md5($url);

    if (isset($this->embeds[$key])) {
      return $this->embeds[$key];
    }

    $embed = NULL;

    try {
      $embed = Embed::create($url, $this->config);
    }
    catch (\Exception $e) {
      watchdog_exception(Yaem::YAEM, $e);
    }

    $this->embeds[$key] = $embed;

    return $embed;
  }

  /**
   * {@inheritdoc}
   */
  public function getRenderer($url) {
    return $this->rendererManager->getInstance(['url' => $url, 'embedService' => $this]);
  }

  /**
   * {@inheritdoc}
   */
  public function renderUrl($url) {
    return $this->getRenderer($url)->render($url);
  }

}
