<?php

namespace buzasadam\jsonmerge;

class SecondMergeHelper extends StandardMergeHelper implements MergeInterface
{
  public function decide(){
    $this->result = $this->val2;
  }
}