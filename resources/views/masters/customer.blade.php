@extends('layouts.admin')

@section('content')

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{ __('Listado de Clientes') }} </h6>
    </div>
    <div class="card-body">
      
      {{-- <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Clientes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> 120</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mujeres</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> 80</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-venus fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hombres</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> 20</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-mars fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Clientes Con Reserva</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> 20</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-venus-mars fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div> --}}

      
      <div class="row gx-3 mb-3">
        <div class="col-12">
          <button type="button" id="btnAddProduct" class="btn btn-outline-primary a-nuevo"><i class="fas fa-eye"></i> Nuevo </button>
        </div>
      </div>
      
      <div class="row gx-3 mb-3" id="divNuevo" style="display: none">
        <div class="col-md-2">
            <label class="small mb-1" for="inputDocument">DNI*</label>
            <input class="form-control" id="inputDocument" type="text" placeholder="" value="">
        </div>
        <!-- Form Group (first name)-->
        <div class="col-md-2">
            <label class="small mb-1" for="inputFirstName">Nombres*</label>
            <input class="form-control" id="inputFirstName" type="text" placeholder="" value="">
        </div>
        <!-- Form Group (last name)-->
        <div class="col-md-2">
            <label class="small mb-1" for="inputLastName">Apellidos*</label>
            <input class="form-control" id="inputLastName" type="text" placeholder="" value="">
        </div>
        <div class="col-md-2">
            <label class="small mb-1" for="inputPhone">Número</label>
            <input class="form-control" id="inputPhone" type="text" placeholder="" value="">
        </div>
        <div class="col-md-2">
            <label class="small mb-1" for="inputEmail">Correo</label>
            <input class="form-control" id="inputEmail" type="email" placeholder="" value="">
        </div>
        <div class="col-md-2">
            <label class="small mb-1" for="inputBirthday">Fecha Nacimiento</label>
            <input class="form-control" id="inputBirthday" type="date" value="">
        </div>
        <div class="col-md-2">
            <label class="small mb-1" for="inputAddress">Dirección</label>
            <input class="form-control" id="inputAddress" type="email" placeholder="" value="">
        </div>
        <div class="col-md-2">
            <label class="small mb-1" for="inputGender">Género</label>
            <select class="col form-control valid" id="inputGender" name="inputGender" aria-invalid="false">
              {{-- <option selected="selected" value="0">Género</option> --}}
              <option selected="selected"  value="0"> Mujer </option>
              <option value="1"> Hombre </option>
          </select>
        </div>
        <div class="col-md-7">
            <label class="small mb-1" for="inputNote">Nota</label>
            <input class="form-control" id="inputNote" type="email" placeholder="" value="">
        </div>
        
        <div class="col-md-1 mt-4">
          <button class="btn btn-primary a-register" type="button" > <i class="fas fa-plus"> </i> </button>
        </div>
      </div>
      <br />

      <div class="table-responsive">
        <table class="table table-reponsive table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" style="width:50px;"> Acciones </th>
              <th style="width:70px">Doc.</th>
              <th style="width:100px">Nombres</th>
              <th style="width:100px">Apellidos</th>
              <th style="width:50px">Género</th>
              <th style="width:80px">Numero</th>
              <th style="width:150px">Correo</th>
              <th style="width:90px">Fecha Nac.</th>
              <th style="width:200px;">Dirección</th>
              <th style="width:200px;">Nota</th>
              <th style="width:90px;display: none">Fec. Reg</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
      </div>

    </div>

</div>

@endsection

@section('javascript')
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
  <script  type="text/javascript" src="{{ asset('js/customer.js') }}"></script>
@stop