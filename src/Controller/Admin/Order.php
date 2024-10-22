<?php

namespace Iidev\CustomUserRoles\Controller\Admin;

use XLite\Core\Auth;
use XCart\Extender\Mapping\Extender;
/**
 * @Extender\Mixin
 */
class Order extends \XLite\Controller\Admin\Order
{
    public function checkACL()
    {
        return parent::checkACL() || Auth::getInstance()->hasPermission('Virtual assistant');
    }

    public function getPages()
    {
        $list = parent::getPages();
        if (
            $this->getOrder()
            && Auth::getInstance()->hasPermission('Virtual assistant')
        ) {
            $list['default'] = static::t('General info');
            $list['invoice'] = static::t('Invoice');
        }

        return $list;
    }

    protected function doActionUpdate()
    {
        if (Auth::getInstance()->hasPermission('Virtual assistant')) {
            \XLite\Core\TopMessage::addError('Access denied!');
            
            return;
        }

        parent::doActionUpdate();
    }
}
