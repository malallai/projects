<link href="/Public/assets/css/form.css" rel="stylesheet">
<script src='/Public/assets/js/form.js'></script>
<div id="form-row" class="row">
    <div class="row-content">
        <div class="nav-content">
            <div class="nav">
                <a id="global-button global-content" class="nav-form-button active">
                    <span class="text active">Profile</span>
                    <span class="icon"><i class="fas fa-id-card"></i></span>
                </a>
                <a id="edit-pwd-button edit-pwd-content" class="nav-form-button">
                    <span class="text active">Modifier le mot de passe</span>
                    <span class="icon"><i class="fas fa-edit"></i></span>
                </a>
            </div>
        </div>
        <div id="global-content" class="form-content content content-global active">
            <h2 class="title">Modifier vos informations</h2>
            <form method="POST" action="/user/edit">
                <input type="hidden" name="token" value="<?= \Core\Security::getToken() ?>">
                <input type="hidden" name="type" value="global">
                <input type="hidden" name="old_username" value="<?=\Core\Security::convertChars($params['user']['username'])?>">
                <div class="inline-flex">
                    <input type="text" name="last_name" id="last_name" class="form-control" value="<?=\Core\Security::convertChars($params['user']['last_name'])?>" autofocus>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="<?=\Core\Security::convertChars($params['user']['first_name'])?>">
                </div>
                <input type="email" name="mail" id="mail" class="form-control" value="<?=\Core\Security::convertChars($params['user']['email'])?>">
                <input type="text" name="username" id="username" class="form-control" value="<?=\Core\Security::convertChars($params['user']['username'])?>">
                <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
                <div class="inline-flex">
                    <div class="select-box">
                        <span>Notifications</span>
                        <a href="#" class="link checkbox"><i id="notifications" class="<?= $params['user']['notifications'] ? "fas fa-toggle-on green" : "fas fa-toggle-off red" ?>"></i></a>
                        <input type="text" name="notifications" id="input notifications" value="<?=$params['user']['notifications'] ? "true" : "false"?>" hidden required>
                    </div>
                </div>
                <input class="c-button-input button-blue" name="update" value="Mettres à jour" type="submit">
            </form>
        </div>
        <div id="edit-pwd-content" class="form-content content content-edit-pwd">
            <h2 class="title">Édition du mot de passe</h2>
            <form method="POST" action="/user/edit">
                <input type="hidden" name="token" value="<?= \Core\Security::getToken() ?>">
                <input type="hidden" name="type" value="password">
                <input type="hidden" name="username" value="<?=\Core\Security::convertChars($params['user']['username'])?>">
                <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nouveau mot de passe *" required>
                <input type="password" name="repeat" id="repeat" class="form-control" placeholder="Répéter *" required>
                <input class="c-button-input button-blue" name="update" value="Mettres à jour" type="submit">
            </form>
            <div class="infos">
                * : 8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.
            </div>
        </div>
    </div>
</div>