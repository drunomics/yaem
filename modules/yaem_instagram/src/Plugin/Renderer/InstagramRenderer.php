<?php

namespace Drupal\yaem_instagram\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_instagram",
 *   label = @Translation("Instagram"),
 *   weight = 10,
 * )
 */
class InstagramRenderer extends RendererBase {

  protected static $urlPattern = [
    '@instagram\.com/p/(?<id>[a-z0-9_-]+)@i',
    '@instagr\.am/p/(?<id>[a-z0-9_-]+)@i',
  ];

  /**
   * {@inheritdoc}
   */
  public function render($url) {
    $matches = self::getFirstMatch($url);

    return [
      '#type' => 'html_tag',
      '#tag' => 'iframe',
      '#attributes' => [
        'allowtransparency' => 'true',
        'frameborder' => 0,
        'position' => 'absolute',
        'scrolling' => 'no',
        'src' => '//instagram.com/p/' . $matches['id'] . '/embed/',
        'width' => '480',
        'height' => '640',
      ],
    ];
  }

}
