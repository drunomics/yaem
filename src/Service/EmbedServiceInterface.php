<?php

namespace Drupal\yaem\Service;

use Drupal\Core\Config\ConfigFactory;
use Embed\DataInterface;

/**
 * A service class for handling URL embeds.
 */
interface EmbedServiceInterface {

  /**
   * EmbedServiceInterface constructor.
   *
   * @param ConfigFactory $config_factory
   *   The config factory.
   * @param RendererPluginManagerInterface $rendererManager
   *   Overrides the configuration from the embed settings.
   */
  public function __construct(ConfigFactory $config_factory, RendererPluginManagerInterface $rendererManager);

  /**
   * Gets the configuration which will be applied when fetching the embed.
   *
   * @return array
   *   The configuration.
   */
  public function getConfig();

  /**
   * Sets the configuration which will be applied when fetching the embed.
   *
   * @param array $config
   *   The configruation.
   */
  public function setConfig(array $config);

  /**
   * Gets an embed data interface.
   *
   * @param string|\Embed\Request $request
   *   The url or a request with the url.
   *
   * @throws \Embed\Exceptions\InvalidUrlException
   *   If the urls is not valid.
   * @throws \InvalidArgumentException
   *   If any config argument is not valid.
   *
   * @return NULL|\Embed\DataInterface
   *   The interface.
   */
  public function getEmbed($request);

  /**
   * Gets a renderer for the datainterface.
   *
   * @return RendererInterface
   *   The renderer.
   */
  public function getRenderer(DataInterface $embed);

  /**
   * Renders the given data interface.
   *
   * @param DataInterface $embed
   *   The data interface.
   *
   * @return array
   *   A drupal render array.
   */
  public function render(DataInterface $embed);

  /**
   * Renders a given url.
   *
   * @param string $url
   *   A url.
   *
   * @return array
   *   A drupal render array.
   */
  public function renderUrl($url);

}
