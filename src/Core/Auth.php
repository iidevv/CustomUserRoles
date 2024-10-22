<?php

namespace Iidev\CustomUserRoles\Core;

use XCart\Extender\Mapping\Extender;

/**
 * @Extender\Mixin
 */
class Auth extends \XLite\Core\Auth
{
    public function hasPermission($code)
    {
        $profile = $this->getProfile();

        return $profile && $profile->hasPermission($code);
    }
}
