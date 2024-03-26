<?php

namespace Arins\Repositories\Roomorder;

use Arins\Repositories\BaseRepositoryInterface;

//Inherit interface to BaseRepositoryInterface
interface RoomorderRepositoryInterface extends BaseRepositoryInterface
{
    function byRoomOrderByIdDesc($id);
    function byRoomStatusOpenOrderByIdAndStartdtDesc($id, $take=null);
    function byRoomStatusCancelOrderByIdAndStartdtDesc($id, $take=null);

    function byRoomTodayOrderByStartdt($id, $take=null);
    function byRoomTodayOrderByIdAndStartdtDesc($id, $take=null);

    function byRoomCustom($id, $filter, $take=null);
    function existRoomStartEnd($room_id, $meetingdt, $startdt, $enddt, $id = null);
    function byRoomWeekOrderByIdAndStartdtDesc($id, $take=null);
    function byRoomWeekOrderByIdAndStartdt($id, $take=null);

}