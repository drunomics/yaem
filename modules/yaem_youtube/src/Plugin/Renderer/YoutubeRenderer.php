<?php

namespace Drupal\yaem_youtube\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_youtube",
 *   label = @Translation("Renders youtube videos."),
 *   weight = 10,
 * )
 */
class YoutubeRenderer extends RendererBase {

  protected static $urlPattern = [
    'youtube\.com',
  ];

  protected static $theme = [
    'yaem_youtube' => [
      'variables' => ['path' => NULL],
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function render() {
    $url = $this->getEmbedUrl();

    if (!$url) {
      // Couldn't generate url, use embed as fallback.
      return parent::render();
    }

    return array(
      '#theme' => 'yaem_youtube',
      '#path' => $url,
    );
  }

  /**
   * Gets the rewritten url so it can be embedded via iframe.
   *
   * @return bool|string
   *    The embed url.
   */
  private function getEmbedUrl() {
    if (preg_match('/v=([\w_-]+)/', $this->url, $m)) {
      return "https://www.youtube.com/embed/" . $m[1] . "?feature=oembed";
    }

    return FALSE;
  }

}
