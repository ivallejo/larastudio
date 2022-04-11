$(async function() {

    await initCustomer();
  
})


async function initCustomer() {
  configAction()
  const response = await getListsCustomer()
  await showData(response)
}


function clearInputs() {
  inputDocument.value = '',
  inputFirstName.value = '',
  inputLastName.value = '',
  inputPhone.value = '',
  inputEmail.value = '',
  inputBirthday.value = '',
  inputAddress.value = '',
  inputGender.value = '0'
  inputNote.value = ''
}

function configAction() {
  $('.a-register').click( function() {
    if( inputDocument.value != '' && inputFirstName.value != '' && inputLastName.value != '' ) {
      const data = {
        id: 0,
        document: inputDocument.value,
        first_name: inputFirstName.value,
        last_name: inputLastName.value,
        phone: inputPhone.value,
        email: inputEmail.value,
        birthday:  inputBirthday.value,
        address: inputAddress.value,
        gender: inputGender.value,
        note: inputNote.value,
        _token: tokenLaravel
      }
      clearInputs()
      $.ajax({
        url: "/customer/store",
        type: "post",
        dataType: "json",
        data,
        success: async function (resp) {
          let notifier = new Notifier();
          notifier.success('Cliente registrado con éxito.', 'Cliente registrado!');
          showData(await getListsCustomer())
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(XMLHttpRequest);
        },
      });
    } else {
      let notifier = new Notifier();
      notifier.info('Ingrese los campos minimos para el registro.', 'Atencion!');
    }
  });
  // a-nuevo
  $('.a-nuevo').click( function() {
    ($("#divNuevo").is(":visible")) ? $('#divNuevo').fadeOut() : $('#divNuevo').fadeIn()
  })
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

function showData(data) {
  let text = ''
  $.each(data.data, function (i, item) {
    const strTdSexo = !!item.gender ? '<span class="badge bg-primary-soft text-primary">Masculino</span>' : '<span class="badge bg-red-soft text-red">Femenino</span>'
  
    text += ` <tr data-id="${item.id}" id="tr-${item.id}">\  
                <td class="text-center"> 
                  <i class="fa-solid fa-calendar text-primary icon-td mr-2"></i>\
                  <i class="fa-solid fa-timeline text-green icon-td mr-2"></i>\
                  <i class="fas fa-trash icon-td text-red a-delete" data-id="${item.id}"></i>\
                </td>\ 
                <td> ${ item.document != null ? item.document : '' } </td>\
                <td> ${ item.first_name != null ? item.first_name : '' } </td>\
                <td> ${ item.last_name != null ? item.last_name : '' } </td>\
                <td> ${ strTdSexo } </td>\
                <td> ${ item.phone != null ? item.phone : '' } </td>\
                <td> ${ item.email != null ? item.email : '' } </td>\
                <td> ${ item.birthday != null ? item.birthday : '' } </td>\
                <td> ${ item.address != null ? item.address : '' } </td>\
                <td> ${ item.note != null ? item.note : '' } </td>\
                <td style="display: none"> ${ item.created_at } </td>\
                
              </tr>`;
    
  });   
  configTable(text)         
}

var customerTdIndexLabel = -1;
var customerValOld = '';
var customerValNew = '';
var customerTd = null;

function getPropertyByLabel(numberLabel){
  return Object.keys({
    acciones: '',
    document: '',
    first_name: '',
    last_name: '',
    gender: '',
    phone: '',
    email: '',
    birthday:  '',
    address: '',
    note: '',
  })[numberLabel]
}

function handleCustomerUpdateRow() {
  
  customerTd.innerHTML = customerValNew
  if( customerValOld != customerValNew ) {
    $.ajax({
      url: "/customer/update",
      type: "post",
      dataType: "json",
      data: {
        id: customerTd.parentElement.dataset.id,
        label: getPropertyByLabel(customerTdIndexLabel),
        value: customerValNew,
        _token: tokenLaravel
      },
      success: async function (resp) {
        let notifier = new Notifier();
        notifier.success('Campo actualizado con éxito.', 'Cliente Actualizado!');
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest);
      },
    });
  }

}

function configTable(text) {
  $('#dataTable').DataTable().clear();
  $('#dataTable').DataTable().destroy();
  $("#tbody").append(text)

  $('#dataTable').on( 'click', 'tbody td:not(:first-child)', function (e) {
    if(e.target.innerHTML.includes('<input')) return
    if(e.target.nodeName == 'TD') {
      customerTdIndexLabel  = e.target._DT_CellIndex.column
      customerTd = e.target;
      customerValOld = e.target.innerHTML.trim();
      customerValNew = e.target.innerHTML.trim();
      e.target.innerHTML = `<input class="form-control" type="text" value="${customerValOld}">`
      
      e.target.children[0].addEventListener("keyup",function (e) {
        customerValNew = e.target.value
      })

      e.target.children[0].addEventListener("focusout",function (e) {
        handleCustomerUpdateRow()
      })

      e.target.children[0].select()

    }
  });

  $('#dataTable').DataTable({
        order : [[9, 'desc']],
        language : {                    
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }                
        },
        dom: 'lBfrtip',
        "buttons": [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "drawCallback": function( settings ) {
              configActionTable()
        }
  })
}

function configActionTable() {
  $('.a-delete').click( function() {
        

    Swal.fire({
      title: 'Esta Seguro de eliminar al cliente?',
      text: "No podr\u00E1 revertir la acci\u00F3n!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#0061f2',
      cancelButtonColor: '#d33',
      confirmButtonText: 'S\u00ED, Eliminar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      // debugger
      if (result.value) {
        let id = this.dataset.id
        $.ajax({
          url: "/customer/update",
          type: "post",
          dataType: "json",
          data: {
            id,
            label: 'status',
            value: 0,
            _token: tokenLaravel
          },
          success: async function (resp) {
            let notifier = new Notifier();
            notifier.success('Cliente eliminado con éxito.', 'Cliente Eliminado!');
            showData(await getListsCustomer())
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          },
        });
      }
      
    })

    

  })
}