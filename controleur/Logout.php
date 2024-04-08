<?php
include_once "$racine/modele/auth.php";
(new Auth)->logout();
header("Location: /");