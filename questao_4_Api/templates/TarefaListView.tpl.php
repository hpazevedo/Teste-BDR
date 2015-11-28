<?php
	$this->assign('title','Tarefas | Tarefas');
	$this->assign('nav','tarefas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/tarefas.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Tarefas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="tarefaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Codigo">Codigo<% if (page.orderBy == 'Codigo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Titulo">Titulo<% if (page.orderBy == 'Titulo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Descricao">Descricao<% if (page.orderBy == 'Descricao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Prioridade">Prioridade<% if (page.orderBy == 'Prioridade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('codigo')) %>">
				<td><%= _.escape(item.get('codigo') || '') %></td>
				<td><%= _.escape(item.get('titulo') || '') %></td>
				<td><%= _.escape(item.get('descricao') || '') %></td>
				<td><%= _.escape(item.get('prioridade') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="tarefaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="codigoInputContainer" class="control-group">
					<label class="control-label" for="codigo">Codigo</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="codigo"><%= _.escape(item.get('codigo') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="tituloInputContainer" class="control-group">
					<label class="control-label" for="titulo">Titulo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="titulo" placeholder="Titulo" value="<%= _.escape(item.get('titulo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="descricaoInputContainer" class="control-group">
					<label class="control-label" for="descricao">Descricao</label>
					<div class="controls inline-inputs">
						<textarea class="input-xlarge" id="descricao" rows="3"><%= _.escape(item.get('descricao') || '') %></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="prioridadeInputContainer" class="control-group">
					<label class="control-label" for="prioridade">Prioridade</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="prioridade" placeholder="Prioridade" value="<%= _.escape(item.get('prioridade') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTarefaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTarefaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Tarefa</button>
						<span id="confirmDeleteTarefaContainer" class="hide">
							<button id="cancelDeleteTarefaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTarefaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="tarefaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Tarefa
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="tarefaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTarefaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="tarefaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTarefaButton" class="btn btn-primary">Add Tarefa</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
