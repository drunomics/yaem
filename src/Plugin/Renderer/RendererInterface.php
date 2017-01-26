<?php

namespace Drupal\yaem\Plugin\Renderer;

use Embed\DataInterface;

/**
 * A renderer.
 */
interface RendererInterface {

  /**
   * Gets an render array for the given url.
   *
   * @param DataInterface $embed
   *   The data interface.
   *
   * @return array
   *   The render array.
   */
  public function render(DataInterface $embed);

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
   * @param DataInterface $embed
   *   The data interface.
   *
   * @return bool
   *   TRUE if this plugin has an interest in rendering the data.
   */
  public static function hasRenderingInterest(DataInterface $embed);

}
