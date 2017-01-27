<?php

namespace Drupal\yaem_facebook\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_facebook",
 *   label = @Translation("Facebook"),
 *   weight = 10,
 * )
 */
class FacebookRenderer extends RendererBase {

  protected static $urlPattern = [
    '/facebook\.com/',
  ];

}
