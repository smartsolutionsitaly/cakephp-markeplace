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

/**
 * Apple iTunes provider for iPad.
 * @package SmartSolutionsItaly\CakePHP\Marketplace\Provider
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class AppleITunesIPadMarketplace extends AppleITunesMarketplace
{
    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::isActive()
     */
    public function isActive(): bool
    {
        return Configure::check('Apple.ipadAppId');
    }

    /**
     * {@inheritDoc}
     * @see \SmartSolutionsItaly\CakePHP\Marketplace\Marketplace::getId()
     */
    public function getId(): string
    {
        return (string)Configure::read('Apple.ipadAppId', '');
    }
}
