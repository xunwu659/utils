<?php


namespace services\product;

use basic\BaseManager;
use services\AccessTokenServeService;
use think\facade\Config;
use think\Container;


/**
 * Class Product
 * @package services\product
 * @mixin \services\product\storage\Copy
 */
class Product extends BaseManager
{
    /**
     * 空间名
     * @var string
     */
    protected $namespace = '\\\services\\product\\storage\\';

    /**
     * 默认驱动
     * @return mixed
     */
    protected function getDefaultDriver()
    {
        return Config::get('product.default', 'copy');
    }

    /**
     * 获取类的实例
     * @param $class
     * @return mixed|void
     */
    protected function invokeClass($class)
    {
        if (!class_exists($class)) {
            throw new \RuntimeException('class not exists: ' . $class);
        }
        $this->getConfigFile();

        if (!$this->config) {
            $this->config = Config::get($this->configFile . '.stores.' . $this->name, []);
        }
        $handleAccessToken = new AccessTokenServeService($this->config['account'] ?? '', $this->config['secret'] ?? '');
        $handle = Container::getInstance()->invokeClass($class, [$this->name, $handleAccessToken, $this->configFile]);
        $this->config = [];
        return $handle;
    }

}
