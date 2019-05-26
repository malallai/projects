<?php

    function get_users() {
        $users = unserialize(file_get_contents("private/accounts"));
        return ($users);
    }

    function get_products() {
        return unserialize(file_get_contents("private/products"));
    }

    function get_orders_user($user_id) {
        $user = get_user($user_id);
        return ($user['orders']);
    }

    function get_user($user_id) {
        $users = get_users();
        foreach ($users as $value) {
            if ($value['login'] == $user_id)
                return ($value);
        }
    }

    function get_orders() {
        return (unserialize(file_get_contents("private/orders")));
    }

    function auth($login, $password) {
        $user = get_user($login);
        print_r($user);
        if ($user) {
            print("test\n");
            if (hash('whirlpool', $password) === $user['pass'])
                return true;
        }
        return false;
    }

    function change_password($login, $old_password, $new_password) {
        if (auth($login, $old_password)) {
            $users = get_users();
            $user = get_user($login);
            $user['pass'] = hash('whirlpool', $new_password);
            $users[get_user($login)] = $user;
            file_put_contents("private/accounts", serialize($users));
            return true;
        }
        return false;
    }

    function delete_user($login) {
        $user = get_user($login);
        if ($user) {
            $users = get_users();
            unset($users, $user);
            file_put_contents("private/accounts", serialize($users));
        }
        return false;
    }

    function create_user($infos) {
        if (get_user($infos['login']))
            return false;
        $users = get_users();
        $users[] = $infos;
        file_put_contents("private/accounts", serialize($users));
        return true;
    }

    function update_user($user) {
        $users = get_users();
        foreach ($users as $key => $value) {
            if ($value['login'] === $user['login']) {
                $users[$key] = $user;
                file_put_contents("private/accounts", serialize($users));
                return true;
            }
        }
        return false;
    }

    function confirm_order($login) {
        $orders = get_orders();
        $n = rand(0, 100000);
        $orders[$n] = $_SESSION['items'];
        file_put_contents("private/orders", serialize($orders));
        unset($_SESSION['items']);
        $_SESSION['items_count'] = 0;
        $user = get_user($login);
        $user['orders'][] = $n;
        update_user($user);
        return true;
    }

    function delete_product($id) {
        $products = get_products();
        foreach($products as $k => $f)
        {
            if ($f['id'] == $id) {
                unset($products[$k]);
                file_put_contents("private/products", serialize($products));
                return true;
            }
        }
        return false;
    }

    function get_product($name) {
        $products = get_products();
        foreach($products as $k => $f)
        {
            if ($f['name'] == $name) {
                return ($f['id']);
            }
        }
        return false;
    }

    function create_product($infos) {
        $orders = get_products();
        $orders[] =  $infos;
        file_put_contents("private/products", serialize($orders));
    }

    function search_item($search) {
        $products = get_products();
        $searched = array();
        foreach ($products as $value) {
            if ($value['name'] == $search || $value['year'] == $search) {
                $searched[] = $value;
            }
        }
        return $searched;
    }








































