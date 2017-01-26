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
   * The url to embed.
   *
   * @var string
   */
  protected $url;

  /**
   * RendererBase constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    /** @var EmbedServiceInterface $embedService */
    $this->embedService = \Drupal::service(YAEM_EMBED_SERVICE);
    $this->url = $configuration['url'];
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * @var DataInterface|NULL
   */
  protected $embed;

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
   * @return DataInterface|NULL
   */
  protected function getEmbed() {
    if (!isset($this->embed)) {
      $this->embed = $this->embedService->getEmbed($this->url);
    }

    return $this->embed;
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
  public function render() {
    if ($embed = $this->getEmbed()) {
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
    if (!empty(static::$urlPattern)) {
      $pattern = '/' . implode("|", static::$urlPattern) . '/';
      return preg_match($pattern, $url);
    }

    return FALSE;
  }

}
