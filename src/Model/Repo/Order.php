<?php

namespace Iidev\CustomUserRoles\Model\Repo;

use XLite\Core\Auth;
use XCart\Extender\Mapping\Extender;

/**
 * @Extender\Mixin
 */
class Order extends \XLite\Model\Repo\Order
{
    /**
     *
     * @param \XLite\Core\CommonCell $cnd Search condition
     *
     * @return array
     */
    public function getSearchTotal(\XLite\Core\CommonCell $cnd)
    {
        if (Auth::getInstance()->hasPermission('Virtual assistant')) {
            return [0];
        }

        return parent::getSearchTotal($cnd);
    }
}
