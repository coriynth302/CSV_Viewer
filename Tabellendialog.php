<?php

class Datenbeschaffer {

  public function dateinamen_auslesen() {

    $dateiname = $_SERVER['argv'][1];
    return $dateiname;
  }

  public function datei_laden($dateiname) {

    $laden = fopen($dateiname, "r", TRUE);

    while (!feof($laden)) {

      $zeilen[] = fgets($laden, 1024);
    }
    fclose($laden);
    $seiten_verwalter = new Seitenverwalter($zeilen);
    return $seiten_verwalter;
  }

}

class Ausgabe {

  public function tabelle_anzeigen($array) {

    $strings_laenge = self::tabelle_darstellung_body($array);

    $kopf_array = explode(";", $array['kopf']);

    echo str_pad($kopf_array[0], $strings_laenge[0], " ") . "|";
    echo str_pad($kopf_array[1], $strings_laenge[1], " ") . "|";
    echo str_pad($kopf_array[2], $strings_laenge[2], " ") . "|";
    echo $kopf_array[3];

    foreach ($array['zeilen'] as $value) {

      if ($value != FALSE){
      $string_array = explode(";", $value);
      echo str_pad($string_array[0], $strings_laenge[0], " ") . " | ";
      echo str_pad($string_array[1], $strings_laenge[1], " ") . " | ";
      echo str_pad($string_array[2], $strings_laenge[2], " ") . " | ";
      echo $string_array[3];
      }
    }
  }

  public function tabelle_darstellung_body($array) {

    foreach ($array['zeilen'] as $value) {

      if ($value != FALSE){
      $string_array = explode(";", $value);
      $strings_1[] = strlen($string_array[0]);
      $strings_2[] = strlen($string_array[1]);
      $strings_3[] = strlen($string_array[2]);
       }
    }
    $csv_array = array($strings_1, $strings_2, $strings_3);

    for ($index = 0; $index < count($csv_array); $index++) {
      $meine_strings[] = max($csv_array[$index]);
    }
    return $meine_strings;
  }

  public function menue_anzeigen() {
    echo 'N(ext Page) P(revious Page) F(irst Page) L(ast Page) eX(it)';
  }

}

class Methodenzeiger {

  private $pos_Verwalter;

  public function __construct($pos_Verwalter) {
    $this->pos_Verwalter = $pos_Verwalter;
  }

  public function kommando_erwarten($bei_f, $bei_l, $bei_n) {

    $stdin = fopen("php://stdin", "r");

    while (true) {
      $eingabe = fgetc($stdin);
      if ($eingabe == "f" OR $eingabe == "F") {
        $bei_f($this->pos_Verwalter);
      }
      if ($eingabe == "l" OR $eingabe == "L") {
        $bei_l($this->pos_Verwalter);
      }
      if ($eingabe == "n" OR $eingabe == "N") {
        $bei_n($this->pos_Verwalter);
      }
      if ($eingabe == "p" OR $eingabe == "P") {
        $bei_n($this->pos_Verwalter);
      }
      if ($eingabe == "x" OR $eingabe == "X") {
        exit();
        fclose($stdin);
      }
    }
  }

}
