<?php

namespace Drupal\yaem\Plugin\Renderer;

use Drupal\Component\Plugin\PluginBase;
use Drupal\yaem\Service\EmbedServiceInterface;
use Embed\DataInterface;

/**
 * {@inheritdoc}
 */
abstract class RendererBase extends PluginBase implements RendererInterface {

  /**
   * Embed Service.
   *
   * @var EmbedServiceInterface
   */
  protected $embedService;

  /**
   * RendererBase constructor.
   *
   * @param array $configuration
   *   Config containing:
   *    - embedService: EmbedServiceInterface.
   * @param string $plugin_id
   *   The plugin id.
   * @param mixed $plugin_definition
   *   Plugin definistions.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    $this->embedService = $configuration['embedService'];
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * The libraries the plugin uses.
   *
   * @var array
   */
  protected static $libraries = [];

  /**
   * The theme for the plugin.
   *
   * @var array
   */
  protected static $theme = [];

  /**
   * Url patterns that the Plugin should be used for.
   *
   * @var array
   */
  protected static $urlPattern = [];

  /**
   * Gets the embed for the urls.
   *
   * @return DataInterface|NULL
   *   The embed datainterface or NULL.
   */
  protected function getEmbed($url) {
    return $this->embedService->getEmbed($url);
  }

  /**
   * {@inheritdoc}
   */
  protected function renderEmbed(DataInterface $embed) {
    return [
      '#type' => 'inline_template',
      '#template' => $embed->getCode(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render($url) {
    if ($embed = $this->getEmbed($url)) {
      return $this->renderEmbed($embed);
    }

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public static function getLibraries() {
    return static::$libraries;
  }

  /**
   * {@inheritdoc}
   */
  public static function getTheme() {
    return static::$theme;
  }

  /**
   * {@inheritdoc}
   */
  public static function hasRenderingInterest($url) {
    $matches = static::getFirstMatch($url);
    return !empty($matches);
  }

  /**
   * Gets the first match from the urlPattern property for the given url.
   *
   * @param string $url
   *   The url.
   *
   * @return null|array
   *   The match array.
   */
  protected static function getFirstMatch($url) {
    foreach (static::$urlPattern as $pattern) {
      if (preg_match($pattern, $url, $m)) {
        return $m;
      };
    }

    return NULL;
  }

}
