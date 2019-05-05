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
use Cake\I18n\I18n;
use SmartSolutionsItaly\CakePHP\Database\Locale;
use SmartSolutionsItaly\CakePHP\Marketplace\Marketplace;

/**
 * Google Play provider.
 * @package SmartSolutionsItaly\CakePHP\Marketplace\Provider
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class GooglePlayMarketplace extends Marketplace
{
    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getButtonSize()
     */
    public function getButtonSize(): array
    {
        return [
            'width' => 155,
            'height' => 60
        ];
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getButtonLabel()
     */
    public function getButtonLabel(): string
    {
        return __('Get it on Google Play');
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getButtonUrl()
     */
    public function getButtonUrl(): string
    {
        $locale = Locale::parse(I18n::getLocale());

        return sprintf('https://play.google.com/intl/%1s/badges/images/generic/%2s_badge_web_generic.png', strtolower($locale->toString()), strtolower($locale->getLanguage()));
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getMarketplaceLink()
     */
    public function getMarketplaceLink(bool $suffix = false): string
    {
        $qs = '';

        if ($suffix) {
            $qs = http_build_query(['hl' => Configure::read('App.language')] + Configure::read('Google.marketplace.suffix', []));

            if ($qs) {
                $qs = '&' . $qs;
            }
        }

        return 'https://play.google.com/store/apps/details?id=' . $this->getId() . $qs;
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getId()
     */
    public function getId(): string
    {
        return (string)Configure::read('Google.playAppId', '');
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getPlatform()
     */
    public function getPlatform(): string
    {
        return 'play';
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::isActive()
     */
    public function isActive(): bool
    {
        return Configure::check('Google.playAppId');
    }
}
