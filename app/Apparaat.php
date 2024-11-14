<?php
// app/Apparaat.php

class Apparaat {
    private $status;  // Aan/uit status van het apparaat

    public function __construct() {
        $this->status = 'off'; // Standaard status is uit
    }

    // Zet het apparaat aan
    public function zetAan() {
        $this->status = 'on';
    }

    // Zet het apparaat uit
    public function zetUit() {
        $this->status = 'off';
    }

    // Controleer of het apparaat aan is
    public function isAan() {
        return $this->status === 'on';
    }

    // Zet de status van het apparaat
    public function setStatus($status) {
        $this->status = $status;
    }

    // Verkrijg de huidige status van het apparaat
    public function getStatus() {
        return $this->status;
    }
}
?>
