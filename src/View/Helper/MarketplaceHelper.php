<?php
/**
 * cakephp-marketplace (https://github.com/smartsolutionsitaly/cakephp-marketplace)
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

namespace SmartSolutionsItaly\CakePHP\Marketplace\View\Helper;

use Cake\View\Helper;
use SmartSolutionsItaly\CakePHP\Marketplace\Marketplace;

/**
 * Provides features for marketplaces.
 * @package SmartSolutionsItaly\CakePHP\Helper
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class MarketplaceHelper extends Helper
{
    public $helpers = [
        'Html'
    ];

    /**
     * Returns an HTML button link for a marketplace.
     * @param string $provider Name of the provider.
     * @return string An HTML button link for marketplace.
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::create()
     */
    public function button(string $provider): string
    {
        $provider = Marketplace::create($provider);

        if ($provider->isActive()) {
            return $this->Html->image($provider->getButtonUrl(), [
                    'alt' => $provider->getButtonLabel(),
                    'url' => $provider->getMarketplaceLink(true)
                ] + $provider->getButtonSize());
        } else {
            return '';
        }
    }
}
