<?php
    if (isset($_GET)) {
        foreach ($_GET as $key => $value) {
            print $key.": ".$value."\n";
        }
    }