<?php

namespace buzasadam\jsonmerge;

class FirstMergeHelper extends StandardMergeHelper implements MergeInterface
{
    public function decide(){
     $this->result = $this->val1;
    }
}