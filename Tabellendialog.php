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

    $csv_array = Seitenverwalter::csv_array_bilden($array);
    Seitenverwalter::header_bauen($csv_array);
    Seitenverwalter::tabelle_bauen($csv_array, $array);

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
