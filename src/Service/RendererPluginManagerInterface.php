<?php

namespace Drupal\yaem\Service;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Interface for the data filter manager.
 */
interface RendererPluginManagerInterface extends PluginManagerInterface {

  /**
   * Gets the theme info from all registered plugins.
   *
   * @return array
   *   Theme hook info.
   */
  public function getThemeHookInfo();

}
