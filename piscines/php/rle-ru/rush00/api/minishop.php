<?php

    $private_folder = "../private";
    $users_file = $private_folder."/accounts";
    $products_file = $private_folder."/products";
    $orders_file = $private_folder."/orders";

    function get_users() {
        return (unserialize($users_file));
    }

    function get_products() {

    }

    function get_history($user) {

    }

    function get_all_history() {

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