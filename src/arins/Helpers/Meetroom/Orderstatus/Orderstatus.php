<?php

namespace Arins\Helpers\Meetroom\Orderstatus;

use Arins\Helpers\Meetroom\Orderstatus\OrderstatusInterface;

class Orderstatus implements OrderstatusInterface
{
    protected $result;

    /**
     * Comment template.
     *
     * @param  boolean     $par1
     * @param  int         $par2
     * @param  string      $par3
     * @param  string|null $par4
     * @param  mixed|null  $par5
     * @return array|string|int|boolean
     */


    public function __construct()
    {
    }

    public function statusDone($orderStatus, $enddt, $currdt)
    {
        if ($orderStatus == 1) {
            
            if ($enddt < $currdt) {
                return 5;
            } else {
                return $orderStatus;
            } //end if

        } else {

            return $orderStatus;

        } //end if
    } //end method


}
