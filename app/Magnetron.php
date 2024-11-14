<?php
// Magnetron.php

// Description: Class for managing the microwave with power and time settings.

require_once 'Apparaat.php';

class Magnetron extends Apparaat {
    // Properties for power level and time
    private $vermogen;
    private $tijd;

    // Constructor to initialize microwave settings
    public function __construct() {
        parent::__construct();
        $this->vermogen = 5; // Default power level
        $this->tijd = 30; // Default time in seconds
    }

    // Method to set the power level
    public function stelVermogenIn($vermogen) {
        $this->vermogen = $vermogen;
    }

    // Method to set the time
    public function stelTijdIn($tijd) {
        $this->tijd = $tijd;
    }

    // Display the current settings
    public function toonHuidigeInstellingen() {
        return "Vermogen: {$this->vermogen}, Tijd: {$this->tijd} seconden";
    }
}
?>
