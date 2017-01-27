<?php

namespace Drupal\yaem\Plugin\Renderer;

/**
 * A renderer.
 */
interface RendererInterface {

  /**
   * Gets an render array.
   *
   * @param string $url
   *   The url.
   *
   * @return array
   *   The render array.
   */
  public function render($url);

  /**
   * Gets the library keys for the renderer.
   *
   * @return array
   *   An array containing the library keys.
   */
  public static function getLibraries();

  /**
   * Gets the theme configuration for this plugin.
   *
   * @see hook_theme()
   *
   * @return array
   *   The theme config according to hook_theme().
   */
  public static function getTheme();

  /**
   * Whether the plugin is interested in rendering the given data.
   *
   * @param string $url
   *   The url.
   *
   * @return bool
   *   TRUE if this plugin has an interest in rendering the data.
   */
  public static function hasRenderingInterest($url);

}
