<div onclick="new_snackbar('Snack 1')">Snack 1</div>
<div onclick="new_snackbar('Snack 2')">Snack 2</div>
<div onclick="new_snackbar('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ')">Lorem</div>
<div onclick="new_snackbar('<span style=\'color:red;\'>Red</span>')" style="color:red;">Red</div>
<div onclick="new_snackbar('<span style=\'color:deepskyblue;\'>Blue</span>')" style="color: deepskyblue">Blue</div>
<?php

\Core\Session::startSession();
var_dump($params['posts']);
