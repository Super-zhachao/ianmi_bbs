<?php
/**
 * Ianmi_bbs 模板使用到的方法
 */

namespace Model;

use Model\Forum;
use think\Model;

class IanmiBBS extends Model
{
    /**
     * 获取首页帖子统计信息
     */
    public static function getIndexStastic()
    {
        //       总贴
        $total = Forum::count();
        //        昨日
        $yesterday = Forum::where('create_time', '>', date('y-m-d 00:00:00', strtotime("-1 day")))
            ->where('create_time', '<', date('y-m-d 00:00:00'))->count();
        //        今日
        $today = Forum::where('create_time', '>', date('y-m-d 00:00:00'))->count();
        //        浏览
        $read_count = Forum::sum('read_count');

        return [
            'total' => $total,
            'yesterday' => $yesterday,
            'today' => $today,
            'read_count' => $read_count,
        ];

    }
}
