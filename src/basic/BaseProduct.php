<?php


namespace basic;

use services\AccessTokenServeService;

/**
 * Class BaseProduct
 * @package basic
 */
abstract class BaseProduct extends BaseStorage
{

    /**
     * access_token
     * @var null
     */
    protected $accessToken = NULL;

    /**
     * BaseProduct constructor.
     * @param string $name
     * @param AccessTokenServeService $accessTokenServeService
     * @param string $configFile
     */
    public function __construct(string $name, AccessTokenServeService $accessTokenServeService, string $configFile)
    {
        parent::__construct($name, [], $configFile);
        $this->accessToken = $accessTokenServeService;
    }

    /**
     * 初始化
     * @param array $config
     * @return mixed|void
     */
    protected function initialize(array $config = [])
    {
//        parent::initialize($config);
    }

    /**
     * 开通服务
     * @return mixed
     */
    abstract public function open();

    /**复制商品
     * @return mixed
     */
    abstract public function goods(string $url);
}
