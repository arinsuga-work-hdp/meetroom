<?php

namespace Arins\Repositories\Roomorder;

use Arins\Repositories\BaseRepositoryInterface;

//Inherit interface to BaseRepositoryInterface
interface RoomorderRepositoryInterface extends BaseRepositoryInterface
{
    function byRoomStatusOpenOrderByIdAndStartdtDesc($id, $take=null);
    function byRoomTodayOrderByIdAndStartdtDesc($id, $take=null);
}