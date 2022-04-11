@extends('layouts.admin')

@section('content')

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{ __('Listado de Citas') }} </h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <div id='calendar'></div>
        </div>
      </div>
    </div>

</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Registrar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="row">

            <div class="col-12">
              <label class="small mb-1" for="inputDocument">DNI</label>
              <input class="form-control" id="inputDocument" type="text" placeholder="" value="" >
          </div>
          <!-- Form Group (first name)-->
          <div class="col-12">
              <label class="small mb-1" for="inputFirstName">Nombres</label>
              <input class="form-control" id="inputFirstName" type="text" placeholder="" value="" >
          </div>
          <!-- Form Group (last name)-->
          <div class="col-12">
              <label class="small mb-1" for="inputLastName">Apellidos</label>
              <input class="form-control" id="inputLastName" type="text" placeholder="" value="" >
          </div>

          <div class="col-12">
              <label class="small mb-1" for="inputObservaciones">Observaciones</label>
              <textarea class="form-control" id="inputObservaciones" placeholder="" value="">
              </textarea>
          </div>
      
          <div class="col-12">
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


<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="row">

            <div class="col-12">
                <label class="small mb-1" for="inputDocument2">DNI</label>
                <input class="form-control" id="inputDocument2" type="text" placeholder="" value=""  disabled>
            </div>
            <!-- Form Group (first name)-->
            <div class="col-12">
                <label class="small mb-1" for="inputFirstName2">Nombres</label>
                <input class="form-control" id="inputFirstName2" type="text" placeholder="" value=""  disabled>
            </div>
            <!-- Form Group (last name)-->
            <div class="col-12">
                <label class="small mb-1" for="inputLastName2">Apellidos</label>
                <input class="form-control" id="inputLastName2" type="text" placeholder="" value=""  disabled>
            </div>

            <div class="col-12">
                <label class="small mb-1" for="inputObservaciones2">Observaciones</label>
                <textarea class="form-control" id="inputObservaciones2" placeholder="" value="" disabled>
                </textarea>
            </div>
        
            <div class="col-12">
                <label class="small mb-1" for="inputEvent2">Cita</label>
                <input class="form-control" id="inputEvent2" type="date" value="" disabled>
            </div>

            <div class="col-12">
              <label class="small mb-1"  for="inputEventTime2">Hora: </label>
              <input class="form-control" id="inputEventTime2" type="time" value="" disabled>
            </div>
  

            <div class="col-12">
                <div class="form-group">
                    <label class="small mb-1" for="txtProduct">Producto : </label>
                    <input type="text" class="col form-control" id="txtProduct" aria-describedby="Prueba" placeholder="" disabled>
                </div>
            </div>
              
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar </button>
      </div>
    </div>
  </div>
</div>


{{-- <div id='calendar'></div> --}}

@endsection

@section('javascript')
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}
  <script  type="text/javascript" src="{{ asset('js/events.js') }}"></script>
@stop