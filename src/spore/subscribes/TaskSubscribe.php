<?php

namespace subscribes;

use app\services\activity\StorePinkServices;
use app\services\agent\AgentManageServices;
use app\services\live\LiveGoodsServices;
use app\services\live\LiveRoomServices;
use app\services\order\StoreOrderServices;
use app\services\order\StoreOrderTakeServices;
use app\services\system\attachment\SystemAttachmentServices;
use think\facade\Log;

/**
 * 定时任务类
 * Class TaskSubscribe
 * @package subscribes
 */
class TaskSubscribe
{
    public function handle()
    {

    }

    /**
     * 2秒钟执行的方法
     */
    public function onTask_2()
    {
    }

    /**
     * 6秒钟执行的方法
     */
    public function onTask_6()
    {
    }

    /**
     * 10秒钟执行的方法
     */
    public function onTask_10()
    {
    }

    /**
     * 30秒钟执行的方法
     */
    public function onTask_30()
    {
        //自动取消
        /** @var StoreOrderServices $orderServices */
        $orderServices = app()->make(StoreOrderServices::class);
        $orderServices->orderUnpaidCancel();
    }

    /**
     * 60秒钟执行的方法
     */
    public function onTask_60()
    {
        //拼团失败处理
        /** @var StorePinkServices $storePinkServices */
        $storePinkServices = app()->make(StorePinkServices::class);
        $storePinkServices->statusPink();
        //自动解绑上级绑定
        try {
            /** @var AgentManageServices $agentManage */
            $agentManage = app()->make(AgentManageServices::class);
            $agentManage->removeSpread();
        } catch (\Throwable $e) {
            Log::error('自动解除上级绑定失败,失败原因:' . $e->getMessage());
        }
    }

    /**
     * 180秒钟执行的方法
     */
    public function onTask_180()
    {
        //更新直播商品状态
        try {
            /** @var LiveGoodsServices $liveGoods */
            $liveGoods = app()->make(LiveGoodsServices::class);
            $liveGoods->syncGoodStatus();
        } catch (\Throwable $e) {
            Log::error('更新直播商品状态失败,失败原因:' . $e->getMessage());
        }
        //更新直播间状态
        try {
            /** @var LiveRoomServices $liveRoom */
            $liveRoom = app()->make(LiveRoomServices::class);
            $liveRoom->syncRoomStatus();
        } catch (\Throwable $e) {
            Log::error('更新直播间状态失败,失败原因:' . $e->getMessage());
        }
    }

    /**
     * 300秒钟执行的方法
     */
    public function onTask_300()
    {
        //自动收货
        /** @var StoreOrderTakeServices $services */
        $services = app()->make(StoreOrderTakeServices::class);
        $services->autoTakeOrder();
        //清除昨日海报
        /** @var SystemAttachmentServices $attach */
        $attach = app()->make(SystemAttachmentServices::class);
        $attach->emptyYesterdayAttachment();
    }
}
