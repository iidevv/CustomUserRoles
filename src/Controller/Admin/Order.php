<?php

namespace Iidev\CustomUserRoles\Controller\Admin;

use XLite\Core\Auth;
use \XLite\Core\Database;
use XCart\Extender\Mapping\Extender;
/**
 * @Extender\Mixin
 */
class Order extends \XLite\Controller\Admin\Order
{

    private function checkOrderViewLimit()
    {
        $orderViewsRepo = Database::getRepo('Iidev\CustomUserRoles\Model\OrderViews');
        $order = $this->getOrder();
        $profile = $this->getProfile();

        $limit = \XLite\Core\Config::getInstance()->Iidev->CustomUserRoles->order_limit;
        $now = time();
        $dayAgo = $now - (24 * 60 * 60);

        $qb = $orderViewsRepo->createQueryBuilder('ov');
        $qb->where('ov.order = :order')
            ->andWhere('ov.profile = :profile')
            ->andWhere('ov.date >= :dayAgo')
            ->setParameter('order', $order)
            ->setParameter('profile', $profile)
            ->setParameter('dayAgo', $dayAgo);

        $recentView = $qb->getQuery()->getResult();

        if (!empty($recentView)) {

            return true;
        }

        $qb = $orderViewsRepo->createQueryBuilder('ov');
        $qb->select('COUNT(ov.id)')
            ->where('ov.profile = :profile')
            ->andWhere('ov.date >= :dayAgo')
            ->setParameter('profile', $profile)
            ->setParameter('dayAgo', $dayAgo);

        $remainingLimit = $qb->getQuery()->getSingleScalarResult();

        if ($remainingLimit >= $limit) {
            \XLite\Core\TopMessage::addError('Access denied! You have reached the view limit.');

            return false;
        }

        $this->handleOrderView($order, $profile, $now);

        return true;
    }

    private function handleOrderView($order, $profile, $now): void
    {
        $orderView = new \Iidev\CustomUserRoles\Model\OrderViews();
        $orderView->setOrder($order);
        $orderView->setProfile($profile);
        $orderView->setDate($now);

        Database::getEM()->persist($orderView);
        Database::getEM()->flush();
    }


    public function checkACL()
    {
        if (Auth::getInstance()->hasPermission('Virtual assistant')) {
            return $this->checkOrderViewLimit();
        }

        return parent::checkACL();
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
