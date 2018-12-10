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

// Debit
if (isset($_POST['debit'])) {
    if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = (int) $_POST['id'];
        $account = $accountManager->getAccount($id);

        if (isset($_POST['balance']) && !empty($_POST['balance'])) {
            $balance = (int) $_POST['balance'];
            $actualBalance = $account->debit($balance);
            $accountManager->updateAccount($id, $actualBalance);

            header('Location: index.php');
        }
    }
}

// Credit
if (isset($_POST['payment'])) {
    if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = (int) $_POST['id'];
        $account = $accountManager->getAccount($id);

        if (isset($_POST['balance']) && !empty($_POST['balance'])) {
            $balance = (int) $_POST['balance'];
            $actualBalance = $account->credit($balance);
            $accountManager->updateAccount($id, $actualBalance);

            header('Location: index.php');
        }
    }
}

// Transfer
if (isset($_POST['transfer'])) {
    if (isset($_POST['balance']) && !empty($_POST['balance'])) {
        $balance = (int) $_POST['balance'];

        if (isset($_POST['idDebit']) && !empty($_POST['idDebit'])) {
            $idDebit = (int) $_POST['idDebit'];

            $accountDebit = $accountManager->getAccount($idDebit);
            $balanceDebit = $accountDebit->debit($balance);

            if (isset($_POST['idPayment']) && !empty($_POST['idPayment'])) {
                $idCredit = (int) $_POST['idPayment'];

                $accountCredit = $accountManager->getAccount($idCredit);
                $balanceCredit = $accountCredit->credit($balance);

                $accountManager->updateAccount($idDebit, $balanceDebit);
                $accountManager->updateAccount($idCredit, $balanceCredit);
                
                header('Location: index.php');
            }
        }
    }
}



include "../views/indexView.php";
