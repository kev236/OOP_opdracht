<?php
// Koffieapparaat.php

// Description: Derived class for a coffee machine with strength and size settings.

require_once 'Apparaat.php';

class Koffieapparaat extends Apparaat {
    // Properties for strength and size
    private $sterkte;
    private $grootte;

    // Constructor to initialize coffee machine settings
    public function __construct() {
        parent::__construct();
        $this->sterkte = 'Medium'; // Default strength
        $this->grootte = 'Regulier'; // Default size
    }

    // Method to set the coffee strength
    public function stelSterkteIn($sterkte) {
        $this->sterkte = $sterkte;
    }

    // Method to set the coffee size
    public function stelGrootteIn($grootte) {
        $this->grootte = $grootte;
    }

    // Display the current settings
    public function toonHuidigeInstellingen() {
        return "Koffie Sterkte: {$this->sterkte}, Koffie Grootte: {$this->grootte}";
    }
}
?>
