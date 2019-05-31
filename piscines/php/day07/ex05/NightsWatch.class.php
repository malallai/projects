<?php


class NightsWatch {

    private $_motnw;

    public function recruit($who) {
        $this->_motnw[] = $who;
    }

    public function fight() {
        foreach ($this->_motnw as $fighter) {
            if ($fighter instanceof IFighter) {
                $fighter->fight();
            }
        }
    }

}