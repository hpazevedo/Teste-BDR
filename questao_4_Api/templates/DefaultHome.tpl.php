<?php
	$this->assign('title','Tarefas | Home');
	$this->assign('nav','home');

	$this->display('_Header.tpl.php');
?>

	<div class="modal hide fade" id="getStartedDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>Api Rest Tarefas</h3>
		</div>
		<div class="modal-body" style="max-height: 300px">
			<p>API Rest para um sistema gerenciador de tarefas (inclusão/alteração/exclusão). As tarefas consistem em título e descrição, ordenadas por prioridade.</p>

			<h4>UI Controls</h4>

			<h4>Controllers</h4>

			<h4>Models</h4>


		</div>
	</div>

	<div class="container">

		<!-- Main hero unit for a primary marketing message or call to action -->

		<!-- Example row of columns -->
		<div class="row">
			<div class="span3">
				<h2><i class="icon-cogs"></i>API REST</h2>
				 <p>Utilizamos Phreeze MVC+ORM framework for PHP <br><a href="tarefas">Veja Questao 4</a></p>
			</div>
		</div>

	</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>