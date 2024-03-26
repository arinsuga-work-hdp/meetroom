<?php
namespace Arins\Helpers\Meetroom\Orderstatus;

interface OrderstatusInterface
{
    function statusDone($orderStatus, $enddt, $currdt);
}
