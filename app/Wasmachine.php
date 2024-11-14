<?php
// Wasmachine.php

require_once 'Apparaat.php';

class Wasmachine extends Apparaat {
    private $wasProgramma;
    private $programmaOpties = ["Katoen", "Synthetisch", "Fijn", "Eco"];
    private $aanUit; // Declare the property

    public function __construct() {
        parent::__construct();
        $this->wasProgramma = null; // Geen programma ingesteld bij aanmaken
        $this->aanUit = false; // Default value for aanUit
    }

    // Zet de status van de wasmachine in de sessie
    public function setStatus($status) {
        $this->aanUit = ($status === 'on');
    }

    // Kies een programma
    public function kiesProgramma($programma) {
        if (in_array($programma, $this->programmaOpties)) {
            $this->wasProgramma = $programma;
        } else {
            $this->wasProgramma = "Geen geldig programma";
        }
    }

    // Toon het huidige programma
    public function toonHuidigProgramma() {
        return $this->wasProgramma ?? "Geen programma ingesteld";
    }
}
?>
