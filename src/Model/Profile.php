<?php

namespace Iidev\CustomUserRoles\Model;
use XLite\InjectLoggerTrait;

use XCart\Extender\Mapping\Extender;
/**
 * @Extender\Mixin
 */
class Profile extends \XLite\Model\Profile
{
    use InjectLoggerTrait;
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
