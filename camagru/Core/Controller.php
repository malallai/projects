<?php


namespace Core;


class Controller {

    protected $_sql;

    /**
     * @return mixed
     */
    public function getSql() {
        return $this->_sql;
    }

}