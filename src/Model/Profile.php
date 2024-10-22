<?php

namespace Iidev\CustomUserRoles\Model;

use XCart\Extender\Mapping\Extender;
/**
 * @Extender\Mixin
 */
class Profile extends \XLite\Model\Profile
{
    public function hasPermission($code)
    {
        $result = false;

        foreach ($this->getRoles() as $role) {
            if ($role->getName() === $code) {
                $result = true;

                break;
            }
        }

        return $result;
    }
}
