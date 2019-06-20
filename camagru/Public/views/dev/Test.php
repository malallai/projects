<div onclick="new_snackbar('Snack 1')">Snack 1</div>
<div onclick="new_snackbar('Snack 2')">Snack 2</div>
<div onclick="new_snackbar('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ')">Lorem</div>
<div onclick="new_snackbar('<span style=\'color:red;\'>Red</span>')" style="color:red;">Red</div>
<div onclick="new_snackbar('<span style=\'color:deepskyblue;\'>Blue</span>')" style="color: deepskyblue">Blue</div>
<?php
use Core\Mail;

$link = "https://camagru.malallai.fr/user/confirm";
Mail::create_mail("malallai@student.42.fr", "Confirmation d'inscription",
    "Merci de t'être inscrit sur Camagru.".
    "</br>".
    "Afin de pouvoir te connecter, merci de confirmer ton inscription cliquant <a href='$link'>ici</a>.".
    "</br></br>".
    "Merci de ta confiance et à bientôt sur Camagru.".
    "</br></br>".
    "<span style='color:#999'>Si le lien ne fonctionne pas voici le lien direct: $link</span>"
);