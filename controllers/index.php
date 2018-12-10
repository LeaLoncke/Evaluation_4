<?php

// On enregistre notre autoload.
function chargerClasse($classname)
{
    if(file_exists('../models/'. $classname.'.php'))
    {
        require '../models/'. $classname.'.php';
    }
    else 
    {
        require '../entities/' . $classname . '.php';
    }
}
spl_autoload_register('chargerClasse');


$db = Database::DB();
$accountManager = new AccountManager($db);

// Add account
if (isset($_POST['new'])) {
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        $accountManager->addAccount($name);
    }
}

// Delete account
if (isset($_POST['delete'])) {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = (int) $_POST['id'];
        $accountManager->deleteAccount($id);
    }
}





include "../views/indexView.php";
