<?php

namespace services\upload;

use basic\BaseManager;
use think\facade\Config;

/**
 * Class Upload
 * @package services\upload
 * @mixin \services\upload\storage\Local
 * @mixin \services\upload\storage\OSS
 * @mixin \services\upload\storage\COS
 * @mixin \services\upload\storage\Qiniu
 */
class Upload extends BaseManager
{
    /**
     * 空间名
     * @var string
     */
    protected $namespace = '\\\services\\upload\\storage\\';

    /**
     * 设置默认上传类型
     * @return mixed
     */
    protected function getDefaultDriver()
    {
        return Config::get('upload.default', 'local');
    }


}
