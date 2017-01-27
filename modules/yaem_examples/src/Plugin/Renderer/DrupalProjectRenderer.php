<?php

namespace Drupal\yaem_examples\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_examples_drupal_project",
 *   label = @Translation("Example Drupal Project"),
 *   weight = 10,
 * )
 */
class DrupalProjectRenderer extends RendererBase {

  protected static $urlPattern = [
    '/drupal.org\/project\//',
  ];

  protected static $theme = [
    'yaem_examples_drupal_project' => [
      'variables' => [
        'path' => NULL,
        'title' => NULL,
        'description' => NULL,
      ],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function render($url) {
    $embed = $this->getEmbed($url);
    return array(
      '#theme' => 'yaem_examples_drupal_project',
      '#path' => $url,
      '#title' => $embed->getTitle(),
      '#description' => $embed->getDescription(),
    );
  }

}
