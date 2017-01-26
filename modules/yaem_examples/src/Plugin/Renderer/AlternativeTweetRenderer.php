<?php

namespace Drupal\yaem_examples\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_examples_tweet",
 *   label = @Translation("Renders a twitter tweet."),
 *   weight = 1,
 * )
 */
class AlternativeTweetRenderer extends RendererBase {

  protected static $urlPattern = [
    'twitter\.com\/(?<user>[a-z0-9_-]+)\/(status(es){0,1})\/(?<id>[\d]+)',
  ];

  protected static $theme = [
    'yaem_examples_alternative_tweet' => [
      'variables' => ['path' => NULL, 'attributes' => []],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function render() {
    return array(
      '#theme' => 'yaem_examples_alternative_tweet',
      '#path' => $this->url,
      '#attributes' => [
        'class' => ['twitter-tweet', 'element-hidden'],
        'data-conversation' => 'none',
        'lang' => 'en',
      ],
    );
  }

}
