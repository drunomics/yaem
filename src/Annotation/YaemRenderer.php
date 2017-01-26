<?php

namespace Drupal\yaem\Annotation;

use Drupal\Component\Annotation\Plugin;
use Drupal\yaem\Plugin\Renderer\RendererInterface;

/**
 * Annotation class for yaem renderer plugins.
 *
 * @Annotation
 */
class YaemRenderer extends Plugin {

  /**
   * The machine-name of the renderer.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the renderer.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * The weight of the plugin in relation to other plugins.
   *
   * Plugins must implement hasRenderingInterest to be selected for rendering.
   *
   * @see RendererInterface::hasRenderingInterest()
   *
   * If multiple plugins show interest, the heigher weight value will be used
   * to determine which plugin will do the rendering.
   *
   * @var int
   */
  public $weight;

  /**
   * The path where the template is located relative to the module root.
   *
   * Defaults to 'templates'.
   *
   * @var string
   */
  public $templatePath;

}
