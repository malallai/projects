#!/usr/bin/php
<?php
    $handle = fopen ("php://stdin","r");
    while ($handle && !feof($handle)) {
        echo "Entrez un nombre: ";
        $nbr = fgets($handle);
        if ($nbr) {
            $nbr = str_replace("\n", "", $nbr);
            if (is_numeric($nbr)) {
                if ($nbr % 2 == 0)
                    echo "Le chiffre ".$nbr." est Pair\n";
                else
                    echo "Le chiffre ".$nbr." est Impair\n";
            } else
                echo "'".$nbr."' n'est pas un chiffre\n";
        }
    }
    fclose($handle);
    echo "\n";
?>