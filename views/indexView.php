<?php

include('includes/header.php');

?>

<div class="container">

	<header class="flex">
		<p class="margin-right">Bienvenue sur l'application Comptes Bancaires</p>
	</header>

	<h1>Mon application bancaire</h1>

	<form class="newAccount" action="index.php" method="post">
		<label>Sélectionner un type de compte</label>
		<select class="" name="name" required>
			<option disabled>Choisissez le type de compte à ouvrir</option>
			<?php
			$arrayOfAccountTypes = ["Compte Courant", "Livret A", "PEL", "Compte Joint"];
			foreach ($arrayOfAccountTypes as $arrayOfAccountType) { 
			?> <option value="<?php echo $arrayOfAccountType; ?>"><?php echo $arrayOfAccountType; ?></option> <?php
			}
			?>
		</select>
		<input type="submit" name="new" value="Ouvrir un nouveau compte">
	</form>

	<?php 
		if (!empty($message)) {
			?><p class="error-message"><?php echo $message; ?></p><?php
		}
	?>

	<hr>

	<div class="main-content flex">

	<!-- Pour chaque compte enregistré en base de données, il faudra générer le code ci-dessous -->

	<?php // ######### DEBUT DU CODE A GENERER A CHAQUE TOUR DE BOUCLE ######### 
	
	$dataAccounts = $accountManager->getAccounts();
	foreach ($dataAccounts as $dataAccount) {
	
	?>

		<div class="card-container">

			<div class="card">
				<h3><strong><?php echo $dataAccount->getName(); ?></strong></h3>
				<div class="card-content">

					<?php  
					if ($dataAccount->getBalance() <= 0) {
						?><p class="alert">Somme disponible : <?php echo $dataAccount->getBalance(); ?> €</p><?php
					} else {
						?><p>Somme disponible : <?php echo $dataAccount->getBalance(); ?> €</p><?php
					}
					?>

					<!-- Formulaire pour dépot/retrait -->
					<h4>Dépot / Retrait</h4>
					<form action="index.php" method="post">
						<input type="hidden" name="id" value="<?php echo $dataAccount->getId(); ?>"  required>
						<label>Entrer une somme à débiter/créditer</label>
						<input type="number" name="balance" placeholder="Ex: 250" required>
						<input type="submit" name="payment" value="Créditer">
						<input type="submit" name="debit" value="Débiter">
					</form>


					<!-- Formulaire pour virement -->
			 		<form action="index.php" method="post">

						<h4>Transfert</h4>
						<label>Entrer une somme à transférer</label>
						<input type="number" name="balance" placeholder="Ex: 300"  required>
						<input type="hidden" name="idDebit" value="<?php echo $dataAccount->getId(); ?>" required>
						<label>Sélectionner un compte pour le virement</label>
						<select name="idPayment" required>
							<option value="" disabled>Choisir un compte</option>
							<?php
							$dataTransferAccounts = $accountManager->getAccounts();
							foreach ($dataTransferAccounts as $dataTransferAccounts) {
								if ($dataTransferAccounts->getName() !== $dataAccount->getName()) {
									?> <option value="<?php echo $dataTransferAccounts->getId(); ?>"><?php echo $dataTransferAccounts->getName(); ?></option> <?php
								}
							}
							?>
						</select>
						<input type="submit" name="transfer" value="Transférer l'argent">
					</form>

					<!-- Formulaire pour suppression -->
			 		<form class="delete" action="index.php" method="post">
				 		<input type="hidden" name="id" value="<?php echo $dataAccount->getId(); ?>"  required>
				 		<input type="submit" name="delete" value="Supprimer le compte">
			 		</form>

				</div>
			</div>
		</div>

	<?php // ######### FIN DU CODE A GENERER A CHAQUE TOUR DE BOUCLE ######### 
	}
	
	?>

	</div>

</div>

<?php

include('includes/footer.php');

 ?>
