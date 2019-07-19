<?php
$pages = $params['pages'];
$page = $params['page'];
?>
<div class="pagination">
    <div class="inputs">
        <a class="input arrow <?=$page == 1 ? "disable" : "" ?>" <?=$page == 1 ? "" : "href='/page/" . ($page - 1) . "'" ?>><i class="fas fa-angle-left"></i></a>
        <?php
        $s = ($page == 1 || $page == $pages ? ($page == $pages ? $page - 2 : $page) : $page - 1);
        $x = $page == $pages ? 1 : ($pages < 3 ? $pages : 3);
        for ($i = $s; $i < $s + $x; $i++) {
            ?>
            <a class="input page <?=$i == $page ? "active" : "" ?>" href="/page/<?=$i ?>"><?=$i ?></a>
            <?php
        }
        ?>
        <a class="input arrow <?=$page == $pages ? "disable" : "" ?>" <?=$page == $pages ? "" : "href='/page/" . ($page + 1) . "'" ?>><i class="fas fa-angle-right"></i></a>
    </div>
</div>
