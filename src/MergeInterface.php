<?php

namespace buzasadam\jsonmerge;

interface MergeInterface
{
    public function getResult();
    public function decide();
    public function setVal1($val);
    public function setVal2($val);
}