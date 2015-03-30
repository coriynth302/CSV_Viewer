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

  public function header_bauen($csv_array) {

    for ($index = 0; $index < count($csv_array['kopf']); $index++) {
      if ($index == count($csv_array['kopf']) - 1) {
        echo $csv_array['kopf'][$index];
        break;
      }
      echo str_pad($csv_array['kopf'][$index], $csv_array['strings_laenge'][$index], " ") . "|";
    }
  }

  public function tabelle_bauen($csv_array) {

    foreach ($csv_array['tabellenzeilen'] as $value) {
      for ($index1 = 0; $index1 < count($value); $index1++) {
        if ($index1 == count($value) - 1) {
          echo $value[$index1];
          break;
        }
        echo str_pad($value[$index1], $csv_array['strings_laenge'][$index1], " ") . " | ";
      }
    }
  }

}
