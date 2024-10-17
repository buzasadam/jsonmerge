<?php

namespace buzasadam\jsonmerge;

use buzasadam\jsonmerge\CouponMergeHelper;

class JSONMerge
{

  private $array1;
  private $array2;
  private $string1;
  private $string2;
  private $result = NULL;
  private $mergehelper = NULL;

  public function __construct(String $string1, String $string2, MergeInterface $mergehelper) {
    $this->string1 = $string1;
    $this->string2 = $string2;
    $this->mergehelper = $mergehelper;
    self::prepare();
    $this->result = self::array_merge_recursive_distinct($this->array1, $this->array2);
  }

  private function prepare() {
    $this->array1 = json_decode($this->string1,true);
    $this->array2 = json_decode($this->string2,true);

    usort($this->array1['days'],function($a,$b) {
      return $a['id'] - $b['id'];
    });

    usort($this->array2['days'],function($a,$b) {
      return $a['id'] - $b['id'];
    });
  }

  public function getArray1() : Array {
    return $this->array1;
  }

  public function getArray2() : Array {
    return $this->array2;
  }

  public function getJSON1() : String {
    return $this->string1;
  }

  public function getJSON2() : String {
    return $this->string2;
  }

  public function getResult() {
    return $this->result;
  }

  /**
   * @param array $array1
   * @param array $array2
   * @return array
   */
  public function array_merge_recursive_distinct ( array &$array1 = null, array &$array2 = null )
  {
    $merged = $array1;

    foreach ( $array2 as $key => &$value )
    {
      if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) )
      {

        if ((array_key_exists('id', $merged[$key]) && array_key_exists('id', $value)) && ($merged[$key]['id'] != $value['id'])) {
          $merged[] = $value;
        } else {
          $merged [$key] = $this->array_merge_recursive_distinct ( $merged [$key], $value );
        }
      }
      else
      {
        if (isset($merged[$key])) {
            $this->mergehelper->setVal1($merged[$key]);
            $this->mergehelper->setVal2($value);
            $this->mergehelper->decide();
            $merged[$key] = $this->mergehelper->getResult();
        } else {
          $merged [$key] = $value;
        }
      }
    }

    return $merged;
  }
}