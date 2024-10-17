<?php

namespace buzasadam\jsonmerge;

class StandardMergeHelper
{
  public $result = NULL;
  public $val1;
  public $val2;

  public function __construct($val1 = NULL, $val2 = NULL){
    $this->val1 = $val1;
    $this->val2 = $val2;
    $result = NULL;
    self::decide();
  }

  public function getResult(){
    return $this->result;
  }

  public function decide(){
  }

  public function setVal1($val) {
    $this->val1 = $val;
  }

  public function setVal2($val) {
    $this->val2 = $val;
  }

}