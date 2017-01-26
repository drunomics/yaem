<?php

namespace Drupal\yaem\Service;

use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\yaem\Annotation\YaemRenderer;
use Drupal\yaem\Plugin\Renderer\RendererInterface;
use Embed\DataInterface;

/**
 * Class RendererPluginManager.
 *
 * @package Drupal\yaem
 */
class RendererPluginManager extends DefaultPluginManager implements RendererPluginManagerInterface {

  /**
   * List of already instantiated render plugins.
   *
   * @var array
   */
  protected $instances = array();

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, ModuleHandlerInterface $module_handler, $annotation = YaemRenderer::class) {
    $this->alterInfo('yaem_renderer');
    parent::__construct('Plugin/Renderer', $namespaces, $module_handler, RendererInterface::class, $annotation);
  }

  /**
   * {@inheritdoc}
   */
  public function getInstance(array $options) {
    $plugin_id = NULL;

    /** @var DataInterface $embed */
    $embed = $options['embed'];

    if ($embed instanceof DataInterface) {
      $interests = [];

      foreach ($this->getDefinitions() as $definition) {
        /** @var RendererInterface $class */
        $class = $definition['class'];

        if ($class::hasRenderingInterest($embed)) {
          $weight = isset($definition['weight']) ? $definition['weight'] : 0;
          $interests[$weight] = $definition['id'];
        }
      }

      if (!empty($interests)) {
        $plugin_id = $interests[max(array_keys($interests))];
      }
    }

    try {
      $this->getDefinition($plugin_id);
    }
    catch (PluginNotFoundException $e) {
      $plugin_id = 'yaem_generic';
    }

    if (empty($this->instances[$plugin_id])) {
      $this->instances[$plugin_id] = $this->createInstance($plugin_id);
    }

    return $this->instances[$plugin_id];
  }

  /**
   * {@inheritdoc}
   */
  public function getThemeHookInfo() {
    $info = [];

    foreach ($this->getDefinitions() as $id => $definition) {
      /** @var RendererInterface $class */
      $class = $definition['class'];
      $plugin_info = $class::getTheme();

      foreach ($plugin_info as $theme => $theme_info) {
        if (!isset($theme_info['path'])) {
          $template_path = !empty($definition['templatePath']) ? $definition['templatePath'] : 'templates';
          $plugin_info[$theme]['path'] = drupal_get_path('module', $definition['provider']) . '/' . $template_path;
        }
      }

      $info += $plugin_info;
    }

    return $info;
  }

}
