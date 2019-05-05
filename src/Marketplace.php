<?php
/**
 * cakephp-marketplace (https://www.dressfinder.it)
 * Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  cakephp-plugin
 * @package   cakephp-marketplace
 * @author    Lucio Benini <dev@smartsolutions.it>
 * @copyright 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://smartsolutions.it Smart Solutions S.r.l.
 * @since     1.0.0
 */

namespace SmartSolutionsItaly\CakePHP\Marketplace;

/**
 * Represents the base class for mobile marketplace helper.
 * @package SmartSolutionsItaly\CakePHP\Marketplace
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
abstract class Marketplace
{
    /**
     * Constructor.
     * @since 1.0.0
     */
    public function __construct()
    {
    }

    /**
     * Creates an object.
     * @param string $provider The provider to load.
     * @return SmartSolutionsItaly\CakePHP\Marketplace\Marketplace The instance created.
     * @since 1.0.0
     */
    public static function create(string $provider)
    {
        $object = '\\SmartSolutionsItaly\\CakePHP\\Marketplace\\Provider\\' . $provider . 'Marketplace';

        if (class_exists($object)) {
            return new $object();
        } else {
            return null;
        }
    }

    /**
     * Gets the download button size.
     * @return array An array which contains an "height" and a "width" element.
     * @since 1.0.0
     */
    abstract public function getButtonSize(): array;

    /**
     * Gets the URL of the download button.
     * @return string The URL of the download button.
     * @since 1.0.0
     */
    abstract public function getButtonUrl(): string;

    /**
     * Gets the button label.
     * @return string The button label.
     */
    public function getButtonLabel(): string
    {
        return '';
    }

    /**
     * Gets the URL of the marketplace.
     * @return array The URL of the marketplace.
     */
    public function getManifest(): array
    {
        return [
            'platform' => $this->getPlatform(),
            'id' => $this->getId(),
            'url' => $this->getMarketplaceLink()
        ];
    }

    /**
     * Gets the platform name.
     * @return string The platform name.
     * @since 1.0.0
     */
    abstract public function getPlatform(): string;

    /**
     * Gets the marketplace ID.
     * @return string The marketplace ID.
     * @since 1.0.0
     */
    abstract public function getId(): string;

    /**
     * Gets the URL of the marketplace.
     * @param bool $suffix A value indicating whether the URL has to include a query string suffix from the configuration.
     * @return string The URL of the marketplace.
     * @since 1.0.0
     */
    abstract public function getMarketplaceLink(bool $suffix = false): string;

    /**
     * Gets a value indicating whether the provider is active.
     * @return bool A value indicating whether the provider is active.
     * @since 1.0.0
     */
    abstract public function isActive(): bool;
}
