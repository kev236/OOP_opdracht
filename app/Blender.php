<?php
// app/Blender.php

require_once 'Apparaat.php';  // Zorg ervoor dat Apparaat wordt geïmporteerd

class Blender extends Apparaat {
    private $snelheid;
    private $tijd;

    public function __construct() {
        parent::__construct();  // Oproep van de constructor van de parent klasse (Apparaat)
        $this->snelheid = 5;    // Standaard snelheid
        $this->tijd = 30;       // Standaard tijd in seconden
    }

    // Stel de snelheid in
    public function stelSnelheidIn($snelheid) {
        $this->snelheid = $snelheid;
    }

    // Stel de tijd in
    public function stelTijdIn($tijd) {
        $this->tijd = $tijd;
    }

    // Toon de huidige instellingen
    public function toonInstellingen() {
        return "Snelheid: {$this->snelheid}, Tijd: {$this->tijd} seconden";
    }

    // Zorg ervoor dat de blender aan blijft staan als hij aan was
    public function zetAan() {
        parent::zetAan();  // Aanroepen van de zetAan methode uit de parent klasse
    }

    // Zorg ervoor dat de blender uitgaat
    public function zetUit() {
        parent::zetUit();  // Aanroepen van de zetUit methode uit de parent klasse
    }
}
?>
