<?php

namespace Drupal\yaem_examples\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_examples_metadata",
 *   label = @Translation("Renders metadata fetched from a homepage."),
 *   weight = 1,
 * )
 */
class CustomMetaDataRenderer extends RendererBase {

  protected static $theme = [
    'yaem_examples_custom_metadata' => [
      'variables' => ['path' => NULL],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function renderUrl($url) {
    return array(
      '#theme' => 'yaem_examples_custom_metadata',
      '#path' => $url,
    );
  }

}
