<?php

namespace Drupal\yaem\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\yaem\Service\EmbedServiceInterface;
use Drupal\yaem\Yaem;
/**
 * Plugin implementation of the 'yaem_link' formatter.
 *
 * @FieldFormatter(
 *   id = "yaem_embed",
 *   label = @Translation("Yaem embed"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class LinkEmbedFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    /** @var EmbedServiceInterface $embedService */
    $embedService = \Drupal::service(Yaem::YAEM_EMBED_SERVICE);

    $element = array();

    foreach ($items as $delta => $item) {
      $url = $item->getUrl()->toString();
      $element[$delta] = $embedService->renderUrl($url);
    }

    return $element;
  }

}
