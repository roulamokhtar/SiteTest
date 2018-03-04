<?php include_once("template/vueHeader.php"); ?>

  <body>

    <?php include_once("template/vueNavbar.php"); ?>

    <div class="container">
      
      <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 main">
          <h1 class="page-header"><?php echo $titre ?></h1>

          <h2 class="sub-header"></h2>
          
          <div class="form">
				<form method="post" action="contact.php" class="form-horizontal formContact" role="form">
				<?php if (isset($message)){	echo $message;	} ?>
					<div class="form-group">
						<label for="inputNom" class="col-sm-2 control-label">Nom :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPrenom" class="col-sm-2 control-label">Prenom :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Prenom">
						</div>
					</div>
					<div class="form-group">
						<label for="inputMail" class="col-sm-2 control-label">Mail :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="inputMail" name="email" placeholder="Mail">
						</div>
					</div>
					<div class="form-group">
						<label for="inputSujet" class="col-sm-2 control-label">Sujet :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="inputSujet" name="sujet" placeholder="Sujet">
						</div>
					</div>
					<div class="form-group">
						<label for="inputMessage" class="col-sm-2 control-label">Message :</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="message" placeholder="Message" rows="3"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Envoyer</button>
						</div>
					</div>
				</form>
			</div>
			
			<div class="clearfix"></div>
          
        </div>
      </div>
    </div>

    </div><!-- /.container -->

	<?php include_once("template/vueFooter.php"); ?>
