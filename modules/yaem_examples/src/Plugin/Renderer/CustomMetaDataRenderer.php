<?php

namespace Drupal\yaem_examples\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;
use Embed\DataInterface;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_examples_metadata",
 *   label = @Translation("Renders metadata fetched from a homepage."),
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
  public function render(DataInterface $embed) {
    return array(
      '#theme' => 'yaem_examples_custom_metadata',
      '#path' => $embed->getUrl(),
    );
  }

}
