<?php

namespace Drupal\yaem_examples\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;
use Drupal\yaem\Plugin\Renderer\TwitterRenderer;
use Embed\DataInterface;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_examples_tweet",
 *   label = @Translation("Renders a twitter tweet."),
 *   weight = -10,
 * )
 */
class AlternativeTweetRenderer extends RendererBase {

  protected static $libraries = [
    'yaem_examples/twitter',
  ];

  protected static $theme = [
    'yaem_examples_alternative_tweet' => [
      'variables' => ['path' => NULL, 'attributes' => []],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function render(DataInterface $embed) {
    return array(
      '#theme' => 'yaem_examples_alternative_tweet',
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
    return TwitterRenderer::hasRenderingInterest($embed);
  }

}
