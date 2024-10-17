<?php

namespace buzasadam\jsonmerge;

Use Yii;

/**
 * CouponMergeHelper
 *
 * Kuponok összevonásakor kezeli az összehasonlítandó különféle típusú értékeket, típustól megfelelően
 * kalkulálja az összefűzött értéket.
 */
class CouponMergeHelper extends StandardMergeHelper implements MergeInterface{

  const LUNCHTYPE = array('n' => 1, 'v' => 2, 'm' => 3);

  public function decide(){
    if (is_bool($this->val1) && is_bool($this->val2)) {
      self::decideBool();
    }
    if (is_string($this->val1) && is_string($this->val2)) {
      self::decideString();
    }
    if (is_numeric($this->val1) && is_numeric($this->val2)) {
      self::decideNumeric();
    }
  }

  private function decideBool() {
    $this->result = $this->val1 ? $this->val1 : $this->val2;
  }

  private function decideString(){
    $this->result = self::LUNCHTYPE[$this->val1] > self::LUNCHTYPE[$this->val2] ? $this->val1 : $this->val2;
  }

  private function decideNumeric() {
    $this->result = $this->val1;
  }

}