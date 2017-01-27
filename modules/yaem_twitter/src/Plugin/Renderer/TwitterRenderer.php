<?php

namespace Drupal\yaem_twitter\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_twitter",
 *   label = @Translation("Twitter"),
 *   weight = 10,
 * )
 */
class TwitterRenderer extends RendererBase {

  protected static $urlPattern = [
    '/twitter\.com\/(?<user>[a-z0-9_-]+)\/(status(es){0,1})\/(?<id>[\d]+)/',
  ];

  protected static $libraries = [
    'yaem_twitter/twitter',
  ];

  protected static $theme = [
    'yaem_twitter_tweet' => [
      'variables' => ['path' => NULL, 'attributes' => []],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function render($url) {
    return array(
      '#theme' => 'yaem_twitter_tweet',
      '#path' => $url,
      '#attributes' => [
        'class' => ['twitter-tweet', 'element-hidden'],
        'data-conversation' => 'none',
        'lang' => 'en',
      ],
      '#attached' => [
        'library' => $this->getLibraries(),
      ],
    );
  }

}
