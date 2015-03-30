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
      if ($array[$index] == FALSE) {
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

  public function csv_array_bilden($array) {

    $csv_array['kopf'] = explode(";", $array['kopf']);

    foreach ($array['zeilen'] as $value) {

      $csv_array['tabellenzeilen'][] = explode(";", $value);
      if ($value != FALSE) {
        $string = explode(";", $value);
        for ($index1 = 0; $index1 < count($string); $index1++) {
          $string_array["Stelle_$index1"][] = strlen($string[$index1]);
        }
      }
    }
    for ($index = 0; $index < count($string_array); $index++) {
      $csv_array['strings_laenge'][] = max($string_array["Stelle_$index"]);
    }
    return $csv_array;
  }

}
