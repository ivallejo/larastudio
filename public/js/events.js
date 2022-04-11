var events = []
$(async function() {

  inputObservaciones.value = ''
  
  await getEvents();
  await configCustomers();
  await configProducts();
  configEvents()

  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    initialDate: '2022-03-07',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events, 
    // [
      // {
      //   title: 'All Day Event',
      //   start: '2022-03-01'
      // },
      // {
      //   title: 'Luis Vallejo',
      //   start: '2022-03-12T10:30:00'
      // },
      // {
      //   title: 'Luis Vallejo',
      //   start: '2022-03-12T12:30:00',
      //   rendering: 'background'
      // },
      // {
      //   title: 'Lunch',
      //   start: '2022-03-12T13:30:00'
      // },
      // {
      //   title: 'Lunch',
      //   start: '2022-03-12T14:30:00'
      // },
      // {
      //   title: 'Lunch',
      //   start: '2022-03-12T15:30:00'
      // },
      // {
      //   title: 'Lunch',
      //   start: '2022-03-12T16:30:00'
      // }
    // ],
    dateClick: function( e ) {
      inputEvent.value = e.dateStr
      $('#exampleModalCenter').modal('show');
    },
    eventClick: function (info) {
      let _event = info.event._def.extendedProps.event

      inputDocument2.value = _event.document
      inputFirstName2.value = _event.first_name
      inputLastName2.value = _event.last_name
      inputObservaciones2.value = _event.note
      inputEvent2.value = _event.date_event
      inputEventTime2.value = _event.time_event
      txtProduct.value = _event.product

      $('#exampleModalCenter2').modal('show');
      // alert('a event has been clicked!');

      // document.getElementById('id').value = info.event.id;
      // document.getElementById('title').value = info.event.title;
      // document.getElementById('start').value = info.event.startStr;
      // document.getElementById('color').value = info.event.backgroundColor;
      // document.getElementById('btnAccion').textContent = 'Modificar';
      // document.getElementById('titulo').textContent = 'Actualizar Evento';
      // eliminar.classList.remove('d-none');
      // myModal.show();
  },
  });
  calendar.setOption('locale', 'pe');
  calendar.render();

  // var calendar = $('#calendar').fullCalendar({
  //   editable: true,
  //   header: {
  //     left: 'prev,next,today',
  //     center: 'title',
  //     right: 'month, agendaWeek, agendaDay'
  //   }
  // })

})


// Customer
async function configCustomers() {
  const data = await getListsCustomer()
  dataCustomer = data.data
  console.log('customers', data)

  let optionsCustomerDocument = {
    data: data.data,
    getValue: "document",
    list: {
        match: {
            enabled: true
        },
        onChooseEvent: function () {
            const customer = $("#inputDocument").getSelectedItemData()
            // debugger
            const { id, document, first_name, last_name, phone, email,  birthday, address, gender } = customer
            
            $("#inputDocument").attr('data-id', id)
            $("#inputFirstName").val(first_name).trigger("change");
            $("#inputLastName").val(last_name).trigger("change");
            // $("#inputPhone").val(phone).trigger("change");
            // $("#inputEmail").val(email).trigger("change");
            // $("#inputGender").val(gender).trigger("change");
        }
    },
  };

  let optionsCustomerFirstName = {
    data: data.data,
    getValue: "first_name",
    list: {
        match: {
            enabled: true
        },
        onChooseEvent: function () {
            const customer = $("#inputFirstName").getSelectedItemData()
            // debugger
            const { id, document, first_name, last_name, phone, email,  birthday, address, gender } = customer
            
            $("#inputDocument").attr('data-id', id)
            $("#inputDocument").val(document).trigger("change");
            $("#inputLastName").val(last_name).trigger("change");
            // $("#inputPhone").val(phone).trigger("change");
            // $("#inputEmail").val(email).trigger("change");
            // $("#inputGender").val(gender).trigger("change");
        }
    },
  };

  let optionsCustomerLastName = {
    data: data.data,
    getValue: "last_name",
    list: {
        match: {
            enabled: true
        },
        onChooseEvent: function () {
            const customer = $("#inputLastName").getSelectedItemData()
            // debugger
            const { id, document, first_name, last_name, phone, email,  birthday, address, gender } = customer
            
            $("#inputDocument").attr('data-id', id)
            $("#inputDocument").val(document).trigger("change");
            $("#inputFirstName").val(first_name).trigger("change");
            // $("#inputPhone").val(phone).trigger("change");
            // $("#inputEmail").val(email).trigger("change");
            // $("#inputGender").val(gender).trigger("change");
        }
    },
  };

  $("#inputDocument").easyAutocomplete(optionsCustomerDocument);
  $("#inputFirstName").easyAutocomplete(optionsCustomerFirstName);
  $("#inputLastName").easyAutocomplete(optionsCustomerLastName);

  $(".easy-autocomplete").removeAttr("style");

}

async function getListsCustomer() {
  return new Promise ( (resolve, reject) => {
        $.ajax({
              url: '/customer/all',
              type: 'post',
              dataType: 'json',
              data: {
                    "_token": tokenLaravel
              },
              success: function(resp) {
                    resolve(resp);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log('Error')
                    reject(XMLHttpRequest.responseText)
              }
        });
  });
}

// Events

async function getEvents() {
  return new Promise ( (resolve, reject) => {
        $.ajax({
              url: '/event/all',
              type: 'post',
              dataType: 'json',
              data: {
                    "_token": tokenLaravel
              },
              success: function(resp) {
                // console.log('events', resp)
                events = resp.data.map(  function (event) {
                  return {
                    title: `${event.first_name} ${event.last_name}`,
                    start: event.date_event + 'T' + event.time_event,
                    extendedProps: {
                      event,
                    }
                  }
                })
                // console.log('events', events)
                resolve(resp);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log('Error')
                    reject(XMLHttpRequest.responseText)
              }
        });
  });
}

// Products
async function configProducts() {
  const data = await getListsProduct()

  let optionsProduct2 = {
    data: data.data,
    getValue: "product",
    list: {
        match: {
            enabled: true
        },
        onChooseEvent: function () {
            const _product = $("#txtProduct2").getSelectedItemData()
            // debugger
            const { id, code, product, description, type, unit_price, quantity,  percent_employee } = _product
            
            // const strType = type == 0 ? 'Producto' : 'Servicio'
            $("#txtProduct2").attr('data-id', id)
            // $("#txtTypeProduct").val(strType).trigger("change");
            // $("#txtPriceProduct").val(unit_price).trigger("change");
        }
    },
  };


  $("#txtProduct2").easyAutocomplete(optionsProduct2);

  $(".easy-autocomplete").removeAttr("style");

}


async function getListsProduct() {
  return new Promise ( (resolve, reject) => {
        $.ajax({
              url: '/product/all',
              type: 'post',
              dataType: 'json',
              data: {
                    "_token": tokenLaravel
              },
              success: function(resp) {
                    resolve(resp);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log('Error')
                    reject(XMLHttpRequest.responseText)
              }
        });
  });
}


function configEvents() {

  $('.save').click(function () {
          
    const data = {
      id_customer: inputDocument.dataset.id,
      note: inputObservaciones.value,
      cita: inputEvent.value,
      time: inputEventTime.value,
      id_product: txtProduct2.dataset.id,
      _token: tokenLaravel
    }
    
    $.ajax({
      url: "/event/store",
      type: "post",
      dataType: "json",
      data,
      success: async function (resp) {
        let notifier = new Notifier();
        notifier.success('Evento registrado con éxito.', 'Evento registrado!');
        setTimeout(() => {
          $('#exampleModalCenter').modal('hide')
        },  1000);
        await getEvents()
        listEvents()
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest);
      },
    });
  })
}

function listEvents() {

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    initialDate: '2022-03-07',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events,
    dateClick: function( e ) {
      inputEvent.value = e.dateStr
      $('#exampleModalCenter').modal('show');
    },
    eventClick: function (info) {
      let _event = info.event._def.extendedProps.event

      inputDocument2.value = _event.document
      inputFirstName2.value = _event.first_name
      inputLastName2.value = _event.last_name
      inputObservaciones2.value = _event.note
      inputEvent2.value = _event.date_event
      inputEventTime2.value = _event.time_event
      txtProduct.value = _event.product

      $('#exampleModalCenter2').modal('show');
  },
  });
  calendar.setOption('locale', 'pe');
  calendar.render();

}