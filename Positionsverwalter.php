<?php

class Positionsverwalter {

  public $position = 0;

  public function berechne_startposition() {
    $this->position = 0;
    return $this->position;
  }

  public function berechne_endposition($limit, $array_zeilen) {
    $this->position = count($array_zeilen) - $limit;
    return $this->position;
  }
  
  public function berechne_position_vor($limit, $array_zeilen) {

    $neue_position = $this->position + $limit;
    if ($neue_position > $array_zeilen) {
      return $this->position;
    } else {
      $this->position = $this->position + $limit;
      return $this->position;
    }
  }
  
    public function berechne_position_zurueck($limit, $array_zeilen) {

    $neue_position = $this->position - $limit;
    if ($neue_position < $array_zeilen) {
      return $this->position;
    } else {
      $this->position = $this->position - $limit;
      return $this->position;
    }
  }

}
