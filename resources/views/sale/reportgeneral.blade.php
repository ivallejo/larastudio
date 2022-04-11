@extends('layouts.admin')

@section('content')

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{ __('Listado de Ventas') }} </h6>
    </div>
    <div class="card-body">
      <div class="row">

          <div class="col-lg-2 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="Fecha">Fecha Inicio</label>
              <input class="col form-control" id="dateBegin" type="date">
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="Fecha">Fecha Fin</label>
              <input class="col form-control" id="dateEnd" type="date">
            </div>
          </div>
          <div class="col-lg-2 col-sm-12 mt-4">
            <div class="form-group mt-2">
              <button type="button" id="btnFindPending" class="btn btn-primary finpenfing"><i class="fas fa-search"></i> Buscar </button>
            </div>
          </div>
            
      </div>
       
       

        <br />

        <table class="table table-reponsive table-bordered" 
        id="dataTable" 
        width="100%" 
        cellspacing="0"
        style="font-size: 13px;"
        >
          <thead>
            <tr>
              <th style="width:30px">  </th>
              <th style="width:10px">Venta</th>
              <th style="width:80px">Fecha</th>
              <th style="width:50px">Doc. Cli.</th>
              <th style="width:150px">Cliente</th>
              {{-- <th style="width:350px">Detalle</th> --}}
              <th style="width:50px;text-align: right;">Total</th>
              {{-- <th style="width:150px">Nota</th> --}}
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>

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
  <script  type="text/javascript" src="{{ asset('js/salegeneral.js') }}"></script>
@stop