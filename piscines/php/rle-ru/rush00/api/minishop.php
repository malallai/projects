<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    function is_installed() {
        if (!file_exists("private") || !file_exists("private/accounts") || !file_exists("private/products")
            || !file_exists("private/orders"))
            return false;
        return true;
    }

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
    
    function get_categories() {
        return (unserialize(file_get_contents("private/categories")));
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
        $users = get_users();
        foreach ($users as $key => $value) {
            if ($value['login'] === $login) {
                unset($users[$key]);
                file_put_contents("private/accounts", serialize($users));
                return true;
            }
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
            if ($f['uid'] == $id) {
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
                return ($f['uid']);
            }
        }
        return false;
    }

    function create_product($infos) {
        $orders = get_products();
        $orders[] =  $infos;
        file_put_contents("private/products", serialize($orders));
    }

    function create_category($name) {
        $categories = get_categories();
        $categories[$name] = array();
        file_put_contents("private/categories", serialize($categories));
    }

    function delete_category($name) {
        $categories = get_categories();
        unset($categories[$name]);
        file_put_contents("private/categories", serialize($categories));
    }

    function add_item_category($name, $item) {
        $categories = get_categories();
        array_push($categories[$name], $item);
        file_put_contents("private/categories", serialize($categories));
    }

    function delete_item_category($name, $item) {
        $categories = get_categories();
        array_pop($categories[$name], $item);
        file_put_contents("private/categories", serialize($categories));
    }

    function search_item_by_name($search) {
        $products = get_products();
        $searched = array();
        foreach ($products as $value) {
            if ($value['name'] == $search) {
                if (!in_array($searched, $value))
                    $searched[] = $value;
            }
        }
        return $searched;
    }

    function search_item_by_category($products, $category, $search) {
        $searched = array();
        foreach ($products as $value) {
            foreach ($search as $val) {
                if ($value['categories'][$category] === $val)
                    $searched[] = $value;
            }
        }
        return $searched;
    }

    function search_item_by_categories($products, $args) {
        $searched = $products;
        foreach($args as $key => $value) {
            $searched = search_item_by_category($searched, $key, $value);
        }
        return $searched;
    }

    function logout()
    {
        $_SESSION = array();
        session_destroy();
        return true;
    }

    function add_item_to_cart($item) {
        $items = array();
        if (isset($_SESSION['items'])) {
            $items = $_SESSION['items'];
        }
        if (isset($items[$item])) {
            $items[$item] = $items[$item] + 1;
        } else {
            $items[$item] = 1;
        }
        $_SESSION['items'] = $items;
        $_SESSION['items_count'] =  isset($_SESSION['items_count']) ? $_SESSION['items_count'] + 1 : 1;
    }

    function remove_item_from_cart($item) {
        $items = array();
        if (isset($_SESSION['items'])) {
            $items = $_SESSION['items'];
        }
        if (isset($items[$item]) && $items[$item] > 1) {
            $items[$item] = $items[$item] - 1;
        } else {
            unset($items[$item]);
        }
        $_SESSION['items'] = $items;
        $_SESSION['items_count'] -= 1;
    }







































