@extends('layouts.admin')

@section('content')

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{ __('Listado de Servicios') }} </h6>
    </div>
    <div class="card-body">
      
      {{-- <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Productos</div>
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
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Servicio</div>
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
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Producto</div>
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
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mas vendidos</div>
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
        {{-- <div class="col-md-1">
            <label class="small mb-1" for="inputCodigo">Codigo*</label>
            <input class="form-control" id="inputCodigo" type="text" placeholder="Codigo" value="">
        </div> --}}
        <!-- Form Group (first name)-->
        <div class="col-md-2">
            <label class="small mb-1" for="inputProduct">Producto*</label>
            <input class="form-control" id="inputProduct" type="text" placeholder="" value="">
        </div>
        <!-- Form Group (last name)-->
        {{-- <div class="col-md-2">
            <label class="small mb-1" for="inputDescription">Descripcion</label>
            <input class="form-control" id="inputDescription" type="text" placeholder="Descripcion" value="">
        </div> --}}
        {{-- <div class="col-md-2">
          <label class="small mb-1" for="inputTipo">Tipo</label>
          <select class="col form-control valid" id="inputTipo" name="inputTipo" aria-invalid="false">
            <option selected="selected"  value="0"> Producto </option>
            <option value="1"> Servicio </option>
        </select> 
        </div>--}}
        <input class="form-control" id="inputTipo" type="hidden" value="1">
        <input class="form-control" id="inputQuantity" type="hidden" value="0">
        <div class="col-md-1">
            <label class="small mb-1" for="inputUnitPrice">Precio U.</label>
            <input class="form-control" id="inputUnitPrice" type="email" placeholder="0.00" value="">
        </div>
        <div class="col-md-2">
          <label class="small mb-1" for="inputPercentEmployee">Procentaje Empleado</label>
          <input class="form-control" id="inputPercentEmployee" type="email" placeholder="0.00" value="">
      </div>

        <div class="col-md-2 mt-4">
          <button class="btn btn-primary a-register" type="button" > <i class="fas fa-plus"> </i> Registrar</button>
        </div>
      </div>
      <br />
      <input type="hidden" name="hddShowQuantity" id="hddShowQuantity" value="0">
      <div class="table-responsive">
        <table class="table table-reponsive table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="width:70px">Codigo</th>
              <th style="width:100px">Producto</th>
              <th style="width:80px">Precio Unitario</th>
              <th style="width:200px;display:none">Cantidad</th>
              {{-- <th style="width:90px">Tipo</th> --}}
              <th style="width:80px">Porcentaje</th>
              <th style="width:90px;display: none">Fec. Reg</th>
              <th class="text-center" style="width:50px;"> Acciones </th>
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
  <script  type="text/javascript" src="{{ asset('js/product.js') }}"></script>
@stop
