<?php
/**
 * Dress Finder (https://www.dressfinder.it)
 * Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  cakephp-plugin
 * @package   cakephp-markeplace
 * @author    Lucio Benini <dev@smartsolutions.it>
 * @copyright 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://smartsolutions.it Smart Solutions S.r.l.
 * @since     1.0.0
 */

namespace SmartSolutionsItaly\CakePHP\Marketplace\Provider;

use Cake\Core\Configure;
use SmartSolutionsItaly\CakePHP\Marketplace\Marketplace;

/**
 * Apple iTunes provider.
 * @package SmartSolutionsItaly\CakePHP\Marketplace\Provider
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class AppleITunesMarketplace extends Marketplace
{
    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getButtonSize()
     */
    public function getButtonSize(): array
    {
        return [
            'width' => 135,
            'height' => 40
        ];
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getButtonLabel()
     */
    public function getButtonLabel(): string
    {
        return __('Download on the AppStore');
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getButtonUrl()
     */
    public function getButtonUrl(): string
    {
        return 'app-store/' . $this->getLanguage() . '.svg';
    }

    /**
     * Gets the language formatted for URLs.
     * @return string The language formatted for URLs
     */
    protected function getLanguage(): string
    {
        $language = strtolower(Configure::read('App.language', 'en'));

        return $language ? $language : 'en';
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getMarketplaceLink()
     */
    public function getMarketplaceLink(bool $suffix = false): string
    {
        $language = $this->getLanguage();
        $qs = '';

        if ($suffix) {
            $qs = http_build_query(Configure::read('Apple.marketplace.suffix', []));

            if ($qs) {
                $qs = '?' . $qs;
            }
        }

        return sprintf('https://itunes.apple.com/%1sapp/id%2s%3s', $language == 'en' ? '' : ($language . '/'), $this->getId(), $qs);
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getId()
     */
    public function getId(): string
    {
        return (string)Configure::read('Apple.iphoneAppId', '');
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getPlatform()
     */
    public function getPlatform(): string
    {
        return 'itunes';
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::isActive()
     */
    public function isActive(): bool
    {
        return Configure::check('Apple.iphoneAppId');
    }
}
