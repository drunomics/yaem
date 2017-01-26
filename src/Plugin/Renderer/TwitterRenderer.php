<?php

namespace Drupal\yaem\Plugin\Renderer;

use Embed\DataInterface;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_twitter",
 *   label = @Translation("Renders a twitter tweet."),
 *   weight = 1,
 *   templatePath = "templates/twitter",
 * )
 */
class TwitterRenderer extends RendererBase {

  protected static $libraries = [
    'yaem/twitter',
  ];

  protected static $theme = [
    'yaem_tweet' => [
      'variables' => ['path' => NULL, 'attributes' => []],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function render(DataInterface $embed) {
    return array(
      '#theme' => 'yaem_tweet',
      '#path' => $embed->getUrl(),
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

  /**
   * {@inheritdoc}
   */
  public static function hasRenderingInterest(DataInterface $embed) {
    return preg_match('@((http|https):){0,1}//(www\.){0,1}twitter\.com/(?<user>[a-z0-9_-]+)/(status(es){0,1})/(?<id>[\d]+)@i', $embed->getUrl());
  }

}
