

@extends('layouts.app')

@section('content')
 <!-- Font Awesome -->
  <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <style>
   .no-arrow {
	  -moz-appearance: textfield;
	}
	.no-arrow::-webkit-inner-spin-button {
	  display: none;
	}
	.no-arrow::-webkit-outer-spin-button,
	.no-arrow::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}
   </style>
<div class="container" style="margin-top: 20px;">
	<div class="row">
		<div class="col-2">
			<div class="card">
				<a href="#" data-toggle='modal' data-target="#new_contact" class="btn btn-block btn-outline-success btn-sm" > <font size="3px"> <b>+</b> </font> Novo Contato</a>
			</div>
		</div>
	</div>
			
    <div class="row justify-content-left">
	
		<div class="col-12">
			<form action="{{ url( 'home' ) }}" method="get">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Contatos</h3>
				
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 190px;">
					
                     <input type="text" class="form-control float-right" placeholder="Pesquisar" style="height:30px;" name="nome" value="<?php if(isset($_GET["nome"])) echo $_GET["nome"]; ?>" >

						<div class="input-group-append">
						  <button type="submit" class="btn btn-default" style="height:30px;">&#128269;</button>
						</div>
					
                  </div>
                </div>
              </div>
			  </form>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Número</th>
					  <th style="width:10%;">Editar</th>
					  <th style="width:10%;">Remover</th>
                    </tr>
                  </thead>
                  <tbody>
					@foreach($lista_agenda as $contato)
					<tr>
                      <td>{{ $contato->first_name }} {{ $contato->last_name }}</td>
                      <td>{{ $contato->email }}</td>
                      <td>{{ $contato->phone }}</td>
                      <td><a href="#" data-toggle='modal' data-target="#up{{ $contato->id }}" ><img src="img/pencil.png" style="width:30%;"></a></td>
					  <td><a href="{{ url( 'deletar' ) }}?u={{ $contato->id }}" onClick="return confirm('Deseja mesmo remover o contato?');"><img src="img/del.png" style="width:30%;"></a></td>
                    </tr>
					@endforeach
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
	
    </div>
</div>




		<div class="modal fade" id="new_contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Novo Contato </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<form role="form" method="post" action="{{ url( 'cadastrar' ) }}" enctype="multipart/form-data" >
						<div class="modal-body">
							
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="card-body">
									<div class="form-group">
										<label for="exampleInputEmail1">Primeiro Nome</label>
										<input type="text" class="form-control" placeholder="Primeiro Nome" name="first_name" required>
									</div>
									
									<div class="form-group">
										<label for="exampleInputEmail1">Último Nome</label>
										<input type="text" class="form-control" placeholder="Último Nome" name="last_name" required>
									</div>

									<div class="form-group">
										<label for="exampleInputEmail1">E-mail</label>
										<input type="email" class="form-control" placeholder="E-mail" name="email" required>
									</div>
									
									<div class="form-group">
										<label for="exampleInputEmail1">Telefone</label>
										<input type="text" class="form-control no-arrow" placeholder="Telefone" name="phone" id="phone" data-inputmask="'mask': '9999 9999 9999 9999'" required>
									</div>

								</div>

							

						</div>
						

						<div class="modal-footer">
							<a class="btn btn-danger" data-dismiss="modal" style="color:#FFF;" >Fechar</a>
							<button type="bumit" class="btn btn-success" value='Atualizar' name="atualizar" > Salvar  </button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		@foreach($lista_agenda as $contato)
		<div class="modal fade" id="up{{ $contato->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Alterar Contato </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<form role="form" method="post" action="{{ url( 'atualizar' ) }}" enctype="multipart/form-data" >
						<div class="modal-body">
							
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="card-body">
									<div class="form-group">
										<label for="exampleInputEmail1">Primeiro Nome</label>
										<input type="text" class="form-control" placeholder="Primeiro Nome" name="first_name" value="{{ $contato->first_name }}" required >
									</div>
									
									<div class="form-group">
										<label for="exampleInputEmail1">Último Nome</label>
										<input type="text" class="form-control" placeholder="Último Nome" name="last_name" value="{{ $contato->last_name }}" required>
									</div>

									<div class="form-group">
										<label for="exampleInputEmail1">E-mail</label>
										<input type="email" class="form-control" placeholder="E-mail" name="email" value="{{ $contato->email }}" required>
									</div>
									
									<div class="form-group">
										<label for="exampleInputEmail1">Telefone</label>
										<input type="text" class="form-control no-arrow" placeholder="Telefone" name="phone" value="{{ $contato->phone }}" id="phone" data-inputmask="'mask': '9999 9999 9999 9999'" required >
									</div>

								</div>

							

						</div>
						

						<div class="modal-footer">
							<a class="btn btn-danger" data-dismiss="modal" style="color:#FFF;" >Fechar</a>
							<button type="bumit" class="btn btn-success" value='Atualizar' name="atualizar" > Salvar  </button>
						</div>
					</form>
				</div>
			</div>
		</div>
		@endforeach

@endsection
