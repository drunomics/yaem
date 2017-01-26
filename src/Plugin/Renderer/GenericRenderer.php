<?php

namespace Drupal\yaem\Plugin\Renderer;
use Embed\DataInterface;

/**
 * The generic renderer renders the content directly as an inline template.
 *
 * @see RendererBase::render()
 *
 * @YaemRenderer(
 *   id = "yaem_generic",
 *   label = @Translation("Renders the content as an inline template."),
 *   weight = -100,
 * )
 */
class GenericRenderer extends RendererBase {

  /**
   * {@inheritdoc}
   */
  public static function hasRenderingInterest(DataInterface $embed) {
    return TRUE;
  }

}
