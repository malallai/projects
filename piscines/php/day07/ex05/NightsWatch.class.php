<?php


class NightsWatch {

    private $motnw;

    public function recruit($who) {
        $this->motnw[] = $who;
    }

    public function fight() {
        foreach ($this->motnw as $fighter) {
            if ($fighter instanceof IFighter) {
                $fighter->fight();
            }
        }
    }

}