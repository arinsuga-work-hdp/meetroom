<?php
namespace Arins\Helpers\Timeline;

interface TimelineInterface
{

    function todayStartTime($start = null);
    function calcMillisToProgress($start, $end);
    function progressStart($startDt1, $startDt2);
    function progressRun($startdt, $enddt);
    
}
