<?php

namespace services\easywechat\open3rd;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * 注册第三方平台
 * Class ProgramProvider
 * @package utils
 */
class ProgramProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['mini_program.component_access_token'] = function ($pimple) {
            return new AccessToken(
                $pimple['config']['open3rd']['component_appid'],
                $pimple['config']['open3rd']['component_appsecret'],
                $pimple['config']['open3rd']['component_verify_ticket'],
                $pimple['config']['open3rd']['authorizer_appid']
            );
        };

        $pimple['mini_program.open3rd'] = function ($pimple) {
            return new ProgramOpen3rd($pimple['mini_program.component_access_token']);
        };
    }
}
