<?php

namespace AntiPatternInc\Saasus\Api;

class Lib
{

    public static function findUpperCountByMeteringUnitName($planresult, $metering_unit_name)
    {
        $upper = 0;
        foreach ($planresult['pricing_menus'] as $menus) {
            foreach ($menus['units'] as $units) {
                if ($units['metering_unit_name'] == $metering_unit_name) {
                    $upper = $units['upper_count'];
                    break;
                }
            }
        }
        return $upper;
    }
}
