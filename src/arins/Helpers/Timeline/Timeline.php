<?php

namespace Arins\Helpers\Timeline;

use Arins\Helpers\Timeline\TimelineInterface;
use Arins\Facades\ConvertDate;

class Timeline implements TimelineInterface
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

    public function todayStartTime($start = null)
    {
        //'datetime' => 'DD/MM/YYYY HH:mm:ss',

        $result = null;
        $startTime = null;
        if (isset($start)) {
            $startTime = $start;
        } else {
            $startTime = now();
        }

        $dd = $startTime->format('d');
        $mm = $startTime->format('m');
        $yyyy = $startTime->format('Y');
        $datetimeString = $dd.'/'.$mm.'/'.$yyyy.' 06:00:00';
        $datetime = ConvertDate::strDatetimeToDate($datetimeString);

        $result = $datetime;

        return $result;
    }

    public function calcMillisToProgress($start, $end)
    {
        return ($end - $start)/60000;
    }


    public function progressStart($startDt1, $startDt2)
    {
        $result = 0;
        $startMillis1 = $startDt1->valueOf();
        $startMillis2 = $startDt2->valueOf();
        $result = $this->calcMillisToProgress($startMillis1, $startMillis2);

        return $result;
    }

    public function progressRun($startdt, $enddt)
    {
        $result = 0;
        $startMillis1 = $startdt->valueOf();
        $startMillis2 = $enddt->valueOf();
        $result = $this->calcMillisToProgress($startMillis1, $startMillis2);

        return $result;
    }

}
