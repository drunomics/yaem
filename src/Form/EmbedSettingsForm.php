<?php

namespace Drupal\yaem\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General configuration for the liveblog embeds.
 */
class EmbedSettingsForm extends ConfigFormBase {

  /**
   * Config names.
   */
  const OEMBED_EMBEDLY_KEY  = 'oembed_embedly_key';
  const OEMBED_IFRAMELY_KEY = 'oembed_iframely_key';
  const GOOGLE_KEY          = 'google_key';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return YAEM;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      YAEM_SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(YAEM_SETTINGS);

    $form[self::OEMBED_EMBEDLY_KEY] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Oembed: Embedly key'),
      '#default_value' => $config->get(self::OEMBED_EMBEDLY_KEY),
      '#description' => t('If it\'s defined, use embed.ly api as fallback oembed provider.'),
    );

    $form[self::OEMBED_IFRAMELY_KEY] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Oembed: Iframely key'),
      '#default_value' => $config->get(self::OEMBED_IFRAMELY_KEY),
      '#description' => t('If it\'s defined, use iframe.ly api as fallback oembed provider.'),
    );

    $form[self::GOOGLE_KEY] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Google: Key'),
      '#default_value' => $config->get(self::GOOGLE_KEY),
      '#description' => t('Used only for google maps to generate the embed code.'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config(YAEM_SETTINGS)
      ->set(self::OEMBED_EMBEDLY_KEY, $form_state->getValue(self::OEMBED_EMBEDLY_KEY))
      ->set(self::OEMBED_IFRAMELY_KEY, $form_state->getValue(self::OEMBED_IFRAMELY_KEY))
      ->set(self::GOOGLE_KEY, $form_state->getValue(self::GOOGLE_KEY))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
