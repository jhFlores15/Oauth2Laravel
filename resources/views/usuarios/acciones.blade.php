<!-- Button trigger modal -->
<button type="button" onclick="modalEliminar({{ $id }})" class="btn btn-primary ">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar a este Administrador?
       <!--<input type="text" id="labelid">-->

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarUsuario()" class="btn btn-primary">Si</button>
      </div>
    </div>
  </div>
</div>
<script >
	var user; // se vuelve global
	function modalEliminar(id){
		var id = id;
		document.getElementById('okDelete').value = id;
		$('#deleteModal').modal('show');
		console.log(id);
		location.reload();
	}
	function eliminarUsuario(){
		var id = document.getElementById('okDelete').value;
		console.log("eliminando " + id);
		$('#deleteModal').modal('hide');
		// $.ajax({
		// 	method:"GET",
		// 	url:'/api/user',
		// 	headers : {
		// 		'Content-Type': 'application/json',
		// 		'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
		// 	},
		// 	success:function(resp){				
		// 		user = resp
		// 		console.log(user);
		// 	}
		// });

		$.ajax({
			method:"DELETE",
			url:'/api/usuarios/'+ id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					location.reload();
				}
			}
		});
		
	}
</script>
