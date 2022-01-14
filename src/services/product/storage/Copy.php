<?php


namespace services\product\storage;

use basic\BaseProduct;


/**
 * Class Copy
 * @package services\product\storage
 */
class Copy extends BaseProduct
{

    /**
     * 是否开通
     */
    const PRODUCT_OPEN = 'copy/open';
    /**
     * 获取详情
     */
    const PRODUCT_GOODS = 'copy/goods';

    /** 初始化
     * @param array $config
     */
    protected function initialize(array $config = [])
    {
        parent::initialize($config);
    }

    /** 是否开通复制
     * @return mixed
     */
    public function open()
    {
        return $this->accessToken->httpRequest(self::PRODUCT_OPEN, []);
    }

    /** 复制商品
     * @return mixed
     */
    public function goods(string $url)
    {
        $param['url'] = $url;
        return $this->accessToken->httpRequest(self::PRODUCT_GOODS, $param);
    }


}
