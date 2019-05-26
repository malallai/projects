<?php

    function get_users() {
        return (unserialize("../private/accounts"));
    }

    function get_products() {
        return (unserialize("../private/products"));
    }

    function get_history($user_id) {
        $orders = get_all_history();
        $user_orders = array();
        $user = get_user($user_id);

    }

    function get_user($user_id) {

    }

    function get_all_history() {
        return (unserialize(file_get_contents("../private/orders")));
    }

    function auth($login, $password) {

    }

    function change_password($login, $old_password, $new_password) {

    }

    function delete_user($login) {

    }

    function create_user($infos) {

    }

    function confirm_order($login) {

    }

    function delete_product($id) {

    }

    function create_product($infos) {

    }

    function search_item($value) {

    }