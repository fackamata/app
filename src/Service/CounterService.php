<?php

namespace App\Service;

class CounterService
{
public function countView(int $nbVue): int
    {   
        $nbVueAfter = $nbVue + 1;
        return $nbVueAfter;
    }
}
