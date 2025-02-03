<?php

/**
 * Copyright (c) 2011-present Qualiteam software Ltd. All rights reserved.
 * See https://www.x-cart.com/license-agreement.html for license details.
 */

namespace Iidev\CustomUserRoles\View\Order\Statistics;

use XCart\Extender\Mapping\Extender;

/**
 * @Extender\Mixin
 */
class SalesStatistic extends \XLite\View\Order\Statistics\SalesStatistic
{
    /**
     * Check ACL permissions
     *
     * @return boolean
     */
    protected function checkACL()
    {
        return parent::checkACL()
            && !\XLite\Core\Auth::getInstance()->hasPermission('Sales Manager');
    }
}
