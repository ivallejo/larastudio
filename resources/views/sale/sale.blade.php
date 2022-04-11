@extends('layouts.admin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Registrar Venta </h6>
    </div>
    
    <div class="card-body">

        <form>

            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2"> 
                CLIENTE 
                <span id="spRegistrado" class="badge bg-primary mx-2" style="display: none">REGISTRADO</span>
                <span id="spNuevo" class="badge bg-red mx-2" style="display: none">NUEVO</span>
            </div>
            {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-2"> Registrado </div> --}}
            
            <!-- Form Row-->
            <div class="row gx-3 mb-3">

                {{-- <form action="" autocomplete="off" > --}}

                    <div class="col-md-2">
                        <label class="small mb-1" for="inputDocument">DNI</label>
                        <input class="form-control" id="inputDocument" type="text" placeholder="" value="" >
                    </div>
                    <!-- Form Group (first name)-->
                    <div class="col-md-2">
                        <label class="small mb-1" for="inputFirstName">Nombres</label>
                        <input class="form-control" id="inputFirstName" type="text" placeholder="" value="" >
                    </div>
                    <!-- Form Group (last name)-->
                    <div class="col-md-2">
                        <label class="small mb-1" for="inputLastName">Apellidos</label>
                        <input class="form-control" id="inputLastName" type="text" placeholder="" value="" >
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1" for="inputPhone">Número</label>
                        <input class="form-control" id="inputPhone" type="text" placeholder="" value="" >
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1" for="inputEmail">Correo</label>
                        <input class="form-control" id="inputEmail" type="email" placeholder="" value="" >
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1" for="inputGender">Género</label>
                        <select class="col form-control valid" id="inputGender" name="inputGender" aria-invalid="false">
                            {{-- <option selected="selected" value="0">Género</option> --}}
                            <option selected="selected"  value="0"> Mujer </option>
                            <option value="1"> Hombre </option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-2">
                        <a class="stretched-link ver-mas">
                            <div class="text-xs d-flex align-items-center justify-content-between">
                                Ver más campos
                            </div>
                        </a>
                    </div>

                {{-- </form> --}}
                {{-- <div class="col-md-2">
                    <label class="small mb-1" for="inputBirthday">Fecha Nacimiento</label>
                    <input class="form-control" id="inputBirthday" type="date" value="">
                </div>
                <div class="col-md-2">
                    <label class="small mb-1" for="inputEmailAddress">Dirección</label>
                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="" value="">
                </div> --}}
            </div>


            <div class="text-xs font-weight-bold text-danger text-uppercase mb-2"> 
                EMPLEADO
            </div>

            <div class="row gx-3 mb-3">                    
                <div class="col-md-2">
                    <label class="small mb-1" for="inputEmployee">Nombres</label>
                    <select class="col form-control valid" id="inputEmployee" name="inputEmployee" aria-invalid="false">
                        
                    </select>
                </div>
            </div>

            {{-- <div class="mb-3">
                <label class="small mb-1" for="inputDescription">Descripción</label>
                <textarea class="form-control" id="inputDescription" type="text" placeholder="Descripción" value=""> </textarea>
            </div> --}}

            {{-- <div class="row">
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <a href="#" class="btn btn-success-site btn-icon-split col addService" data-id="10852" style="justify-content: left;">
                            <span class="icon">
                                <i class="fas fa-check align-middle"></i>
                            </span>
                            <span class="text text-left">Corte de Cabello</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <a href="#" class="btn btn-success-site btn-icon-split col addService" data-id="10" style="justify-content: left;">
                            <span class="icon">
                                <i class="fas fa-check align-middle"></i>
                            </span>
                            <span class="text text-left">Peinado</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <a href="#" class="btn btn-success-site btn-icon-split col addService" data-id="8" style="justify-content: left;">
                            <span class="icon">
                                <i class="fas fa-check align-middle"></i>
                            </span>
                            <span class="text text-left">Maquillaje</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <a href="#" class="btn btn-success-site btn-icon-split col addService" data-id="9" style="justify-content: left;">
                            <span class="icon">
                                <i class="fas fa-check align-middle"></i>
                            </span>
                            <span class="text text-left">Maniquiure</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <a href="#" class="btn btn-success-site btn-icon-split col addService" data-id="10854" style="justify-content: left;">
                            <span class="icon">
                                <i class="fas fa-check align-middle"></i>
                            </span>
                            <span class="text text-left">Limpiezas</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <a href="#" class="btn btn-success-site btn-icon-split col addService" data-id="10853" style="justify-content: left;">
                            <span class="icon">
                                <i class="fas fa-check align-middle"></i>
                            </span>
                            <span class="text text-left">Depilaciones</span>
                        </a>
                    </div>
                </div>
            </div> --}}

            <div class="text-xs font-weight-bold text-info text-uppercase mb-2"> DETALLE VENTA </div>

            <div class="row  mb-3">

                {{-- <div class="col-lg-1 col-sm-6">
                    <div class="form-group">
                        <label class="small mb-1" for="txtCodeProduct">Cód: </label>
                        <input type="text" data-id="" class="col form-control" id="txtCodeProduct" placeholder="">
                    </div>
                </div> --}}

                <div class="col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label class="small mb-1" for="txtProduct">Producto : </label>
                        <input type="text" class="col form-control" id="txtProduct" aria-describedby="Prueba" placeholder="">
                        <small id="Prueba" class="form-text text-muted">Se mostrarán las conincidencias del valor a buscar</small>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-12">
                    <div class="form-group">
                        <label class="small mb-1" for="Nombres">Tipo : </label>
                        <input type="text" class="col form-control" disabled id="txtTypeProduct" placeholder="">
                    </div>
                </div>

                <div class="col-lg-1 col-sm-6">
                    <div class="form-group">
                        <label class="small mb-1" for="Nombres">Cant: </label>
                        <input type="text" class="cal col form-control " id="txtQuantitytProduct" placeholder="" value="1">
                    </div>
                </div>

                <div class="col-lg-1 col-sm-6">
                    <div class="form-group">
                        <label class="small mb-1" for="Nombres">Precio : </label>
                        <input type="text" class="cal col form-control " id="txtPriceProduct" placeholder="0.00">
                    </div>
                </div>

                {{-- <div class="col-lg-1 col-sm-12">
                    <div class="form-group">
                        <label class="small mb-1" for="Nombres">Desc :</label>
                        <input type="text" class="cal col form-control " id="txtDiscountProduct" placeholder="0.00">
                    </div>
                </div>

                <div class="col-lg-1 col-sm-6">
                    <div class="form-group">
                        <label class="small mb-1" for="Nombres">Imp: </label>
                        <input type="text" class="cal col form-control " id="txtImportProduct" placeholder="0.00">
                    </div>
                </div> --}}

                <div class="col-lg-1 col-sm-6 text-right mt-4">
                    <button type="button" class="btn btn-primary addProduct">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>

            </div>

            
            <div class="row mx-1">
                <table class="table table-bordered" id="tbProduct" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- <th style="width:95px">Código</th> --}}
                            <th>Producto</th>
                            {{-- <th style="width:100px">Tipo</th> --}}
                            <th style="width:40px">Cnt.</th>
                            <th style="width:60px">Precio</th>
                            {{-- <th style="width:60px">Descuento</th>
                            <th style="width:60px">Importe</th> --}}
                            <th style="width:70px"></th>
                        </tr>
                    </thead>
                    <tbody id="tbProductBody">
                        {{-- <tr id="tr-ProductId" data-id="ProductId">
                            <td>A0001</td>
                            <td>Corte de Cabello</td>
                            <td>Servicio</td>
                            <td>1</td>
                            <td>20.00</td>
                            <td>0.00</td>
                            <td>20.00</td>
                            <td class="text-center">
                            </td>
                        </tr> --}}

                        {{-- <tr id="tr-ProductId" data-id="ProductId">
                            <td>Product.Code</td>
                            <td>Product.Description</td>
                            <td>Product.Specialty.Description</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Discount</td>
                            <td>Import</td>
                            <td>
                                <button title="Eliminar" data-id="ProductId" class="btn btn-danger my-sm-1 removeProduct">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr> --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <th style="width:95px"></th> --}}
                            {{-- <th></th> --}}
                            <th style="width:130px"></th>
                            {{-- <th style="width:40px"></th>
                            <th style="width:60px"></th> --}}
                            <th style="width:60px">TOTAL</th>
                            <th style="width:60px" id="tfTotal">0.00</th>
                            <th style="width:70px"></th>
                        </tr>
                    </tfoot>
                </table>

            </div>

            <!-- Save changes button-->
            <div class="row mx-1">
                <button class="btn btn-primary" type="button" id="btnRegistrarVenta" >Registrar</button>
            </div>
        </form>
        
    </div>

</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Esta Seguro de registrar la venta?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="row">

                <div class="col-md-12">
                    <label class="small mb-1" for="inputObservaciones">Observaciones</label>
                    <textarea class="form-control" id="inputObservaciones" type="text" placeholder="" value="">
                    </textarea>
                </div>
            
                <div class="col-md-12">
                    <label class="small mb-1" for="inputEvent">Cita</label>
                    <input class="form-control" id="inputEvent" type="date" value="">
                </div>
                <div class="col-12">
                    <label class="small mb-1"  for="inputEventTime">Hora: </label>
                    <input class="form-control" id="inputEventTime" type="time" value="">
                  </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="small mb-1" for="txtProduct2">Producto : </label>
                        <input type="text" class="col form-control" id="txtProduct2" aria-describedby="Prueba" placeholder="">
                        <small id="Prueba" class="form-text text-muted">Se mostrarán las conincidencias del valor a buscar</small>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar </button>
          <button type="button" class="btn btn-primary save">Si, Registrar!</button>
        </div>
      </div>
    </div>
</div>




<input type="hidden" name="hddUrl" id="hddUrl" value="{{ url('') }}">
@endsection


@section('javascript')

    <script  type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@stop