<?php

include 'Tabellendialog.php';
include 'Positionsverwalter.php';
include 'Seitenverwalter.php';

function erste_seite_aufrufen($pos_Verwalter) {
  $dateiname = Datenbeschaffer::dateinamen_auslesen();
  $seiten_verwalter = Datenbeschaffer::datei_laden($dateiname);
  $aktuelle_position = $pos_Verwalter->berechne_startposition();
  $tabelle = $seiten_verwalter->seite_bilden($aktuelle_position);
  Ausgabe::tabelle_anzeigen($tabelle);
  Ausgabe::menue_anzeigen();
}

function letzte_seite_aufrufen($pos_Verwalter) {
  $dateiname = Datenbeschaffer::dateinamen_auslesen();
  $seiten_verwalter = Datenbeschaffer::datei_laden($dateiname);
  $aktuelle_position = $pos_Verwalter->berechne_endposition($seiten_verwalter->limit, $seiten_verwalter->tabellenzeilen);
  $tabelle = $seiten_verwalter->seite_bilden($aktuelle_position);
  Ausgabe::tabelle_anzeigen($tabelle);
  Ausgabe::menue_anzeigen();
}

function naechste_Seite_aufrufen($pos_Verwalter) {
  $dateiname = Datenbeschaffer::dateinamen_auslesen();
  $seiten_verwalter = Datenbeschaffer::datei_laden($dateiname);
  $aktuelle_position = $pos_Verwalter->berechne_position_vor($seiten_verwalter->limit, $seiten_verwalter->tabellenzeilen);
  $tabelle = $seiten_verwalter->seite_bilden($aktuelle_position);
  Ausgabe::tabelle_anzeigen($tabelle);
  Ausgabe::menue_anzeigen();
}

function vorherige_seite_aufrufen($pos_Verwalter) {
  $dateiname = Datenbeschaffer::dateinamen_auslesen();
  $seiten_verwalter = Datenbeschaffer::datei_laden($dateiname);
  $aktuelle_position = $pos_Verwalter->berechne_position_zurueck($seiten_verwalter->limit, $seiten_verwalter->tabellen_stellen);
  $tabelle = $seiten_verwalter->seite_bilden($aktuelle_position);
  Ausgabe::tabelle_anzeigen($tabelle);
  Ausgabe::menue_anzeigen();
}

function main() {
  $pos_Verwalter = new Positionsverwalter();
  $system = new Methodenzeiger($pos_Verwalter);

  erste_seite_aufrufen($pos_Verwalter);

  $system->kommando_erwarten("erste_seite_aufrufen", "letzte_seite_aufrufen", "naechste_Seite_aufrufen", "vorherige_seite_aufrufen");
}

main();
