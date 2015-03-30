<?php

class Seitenverwalter {

  public $kopfzeile;
  public $tabellenzeilen;
  public $tabellen_stellen;
  public $limit;

  public function __construct($array) {
    $this->kopfzeile = $array[0];
    $this->tabellen_stellen = count($array);
    $this->limit = 10;
    for ($index = 1; $index < count($array); $index++) {
      $this->tabellenzeilen[] = $array[$index];
      if ($array[$index] == FALSE){
        break;
      }
    }
  }

  public function seite_bilden($aktuelle_position) {
    
    $aktuelle_tabelle['kopf'] = $this->kopfzeile;
    for ($index = 0; $index < count($this->tabellenzeilen); $index++) {
      if ($index == 10) {
        break;
      }
      $aktuelle_tabelle['zeilen'][] = $this->tabellenzeilen[$aktuelle_position];
      $aktuelle_position ++;
    }
    return $aktuelle_tabelle;
  }

}
