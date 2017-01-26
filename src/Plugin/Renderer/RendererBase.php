<?php

namespace Drupal\yaem\Plugin\Renderer;

use Drupal\Component\Plugin\PluginBase;
use Embed\DataInterface;

/**
 * {@inheritdoc}
 */
abstract class RendererBase extends PluginBase implements RendererInterface {

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
   * {@inheritdoc}
   */
  public function render(DataInterface $embed) {
    return [
      '#type' => 'inline_template',
      '#template' => $embed->getCode(),
    ];
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
  public static function hasRenderingInterest(DataInterface $embed) {
    return FALSE;
  }

}
