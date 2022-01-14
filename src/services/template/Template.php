<?php


namespace services\template;

use basic\BaseManager;
use think\facade\Config;

/**
 * Class Template
 * @package services\template
 * @mixin \services\template\storage\Wechat
 * @mixin \services\template\storage\Subscribe
 */
class Template extends BaseManager
{

    /**
     * 空间名
     * @var string
     */
    protected $namespace = '\\\services\\template\\storage\\';

    /**
     * 设置默认
     * @return mixed
     */
    protected function getDefaultDriver()
    {
        return Config::get('template.default', 'wechat');
    }
}
