<?php

namespace Drupal\yaem_facebook\Plugin\Renderer;

use Drupal\yaem\Plugin\Renderer\RendererBase;
use Embed\DataInterface;

/**
 * {@inheritdoc}
 *
 * @YaemRenderer(
 *   id = "yaem_facebook",
 *   label = @Translation("Renders a facebook post."),
 *   weight = 10,
 * )
 */
class FacebookRenderer extends RendererBase {

  protected static $urlPattern = [
    'facebook\.com',
  ];

  /**
   * {@inheritdoc}
   */
  public function renderEmbed(DataInterface $embed) {
    return [
      '#type' => 'inline_template',
      '#template' => $embed->getCode(),
    ];
  }

}
