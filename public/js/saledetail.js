// Init 
var dataSaleDetail = []

Date.prototype.toDateInputValue = (function () {
  var local = new Date(this);
  local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
  return local.toJSON().slice(0, 10);
});


$(async function() {

  // Reporte Venta
  await initReportSale();
  
})


// Venta

async function initReportSale() {
  configData()
  // configAction()
  dataSaleDetail = await getListsSales()
  await showData(dataSaleDetail)
}

function configData() {
  $('#dateBegin').val(new Date().toDateInputValue());
  $('#dateEnd').val(new Date().toDateInputValue());
}


function getSales() {


  // $("#tbody").append(`\
  //   <tr id="tr-1">\   
  //     <td> V000001 </td>\
  //     <td> 13/03/2022 </td>\
  //     <td> 18:50 </td>\
  //     <td> 47680674 </td>\
  //     <td> Sabina Vargas </td>\
  //     <td> Corte Cabello </td>\
  //     <td style="width:50px;text-align:right"> 20.00 </td>\
  //   </tr>\
  // `)

  // $('#dataTable').DataTable({
  //     order : [[1, 'asc']],
  //     language : {                    
  //         "sProcessing": "Procesando...",
  //         "sLengthMenu": "Mostrar _MENU_ registros",
  //         "sZeroRecords": "No se encontraron resultados",
  //         "sEmptyTable": "Ningún dato disponible en esta tabla",
  //         "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  //         "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
  //         "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
  //         "sInfoPostFix": "",
  //         "sSearch": "Buscar:",
  //         "sUrl": "",
  //         "sInfoThousands": ",",
  //         "sLoadingRecords": "Cargando...",
  //         "oPaginate": {
  //             "sFirst": "Primero",
  //             "sLast": "Último",
  //             "sNext": "Siguiente",
  //             "sPrevious": "Anterior"
  //         },
  //         "oAria": {
  //             "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
  //             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  //         }                
  //     },
  //     dom: 'Bfrtip',
  //     buttons: [
  //         'copy', 'csv', 'excel', 'pdf', 'print'
  //     ],
  //     "initComplete": function (settings, json) {
  //         $(".dt-button").each(function (index, item) {
  //             item.classList.add("btn");
  //             item.classList.add("btn-success");
  //         });
  //     }
  // })
}

function configAction() {
  $('.finpenfing').click( function() {
    
  })
}

// Ajax
async function getListsSales() {
  return new Promise ( (resolve, reject) => {
        $.ajax({
              url: '/sale/all',
              type: 'post',
              dataType: 'json',
              data: {
                    begin: dateBegin.value,
                    end: dateEnd.value,
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

    // $("#tbody").append(`\
    //   <tr id="tr-1">\   
    //     <td> V000001 </td>\
    //     <td> 13/03/2022 </td>\
    //     <td> 18:50 </td>\
    //     <td> 47680674 </td>\
    //     <td> Sabina Vargas </td>\
    //     <td> Corte Cabello </td>\
    //     <td style="width:50px;text-align:right"> 20.00 </td>\
    //   </tr>\
    // `)

    let idDocument = 0;
    
    let total = 0;
    let totalEmpleado = 0;
    $.each(data.data, function (i, item) {

      totalEmpleado += (((item.unit_price * item.quantity) * item.percent_employee) / 100)

      if(idDocument != item.id) {
        idDocument = item.id
        total += item.total * 1

        let res = dataSaleDetail.data.filter( itemdetails => {
          return itemdetails.id == item.id
        })

        let listProducts = ''
        res.forEach( it => {
          listProducts +=`<span> Producto: <b>${it.product}</b> - Cant.: <b>${it.quantity}</b>  - Precio U.: <b>${it.unit_price}</b>  </span> </br>`
        })

        
    console.log('totalEmpleado', totalEmpleado)

        text += ` <tr data-id="${item.id}" id="tr-${item.id}">\  
                    <td class="text-center"> 
                      <i class="fa-solid fa-calendar text-primary icon-td mr-2"></i>\
                      <i class="fas fa-trash icon-td text-red a-delete" data-id="${item.id}"></i>\
                    </td>\ 
                    <td> V${ item.id.toString().padStart(8, "0") } </td>\
                    <td> ${ item.created_at.toString().substring(0, 10) } </td>\
                    <td> ${ item.document != null ? item.document : '' } </td>\
                    <td> ${ item.first_name != null ? item.first_name : '' }  ${ item.last_name != null ? item.last_name : '' } </td>\
                    <td> ${ listProducts } </td>\
                    <td> ${ item.note != null ? item.note : '' } </td>\
                    <td style="text-align: right;"> ${ item.total != null ? item.total : '' } </td>\
                    
                  </tr>`;
      }

    }); 

    text += ` <tr>\  
                <td class="text-center"> </td>\ 
                <td> </td>\
                <td> </td>\
                <td> </td>\
                <td> </td>\
                <td> </td>\
                <td> <div class="text-uppercase">Importe Total:</div> </td>\
                <td style="text-align: right;"> <div class="h6 mb-0 fw-700 text-green">S/. ${Number(total).toFixed(2)} </div> </td>\
              </tr>`;
      text += ` <tr>\  
              <td class="text-center"> </td>\ 
              <td> </td>\
              <td> </td>\
              <td> </td>\
              <td> </td>\
              <td> </td>\
              <td> <div class="text-uppercase">Importe Empleado:</div> </td>\
              <td style="text-align: right;"> <div class="h6 mb-0 fw-700">S/. ${Number(totalEmpleado).toFixed(2)} </div> </td>\
            </tr>`;

    configTable(text)         
  }


  function configTable(text) {
    $('#dataTable').DataTable().clear();
    $('#dataTable').DataTable().destroy();
    $("#tbody").append(text)
  
    $('#dataTable').DataTable({
          // order : [[3, 'desc']],
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

    // $('.a-delete').click( function() {
  
    //   Swal.fire({
    //     title: 'Esta Seguro de eliminar al cliente?',
    //     text: "No podr\u00E1 revertir la acci\u00F3n!",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#0061f2',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'S\u00ED, Eliminar!',
    //     cancelButtonText: 'Cancelar'
    //   }).then((result) => {
    //     // debugger
    //     if (result.value) {
    //       let id = this.dataset.id
    //       $.ajax({
    //         url: "/customer/update",
    //         type: "post",
    //         dataType: "json",
    //         data: {
    //           id,
    //           label: 'status',
    //           value: 0,
    //           _token: tokenLaravel
    //         },
    //         success: async function (resp) {
    //           let notifier = new Notifier();
    //           notifier.success('Cliente eliminado con éxito.', 'Cliente Eliminado!');
    //           showData(await getListsCustomer())
    //         },
    //         error: function (XMLHttpRequest, textStatus, errorThrown) {
    //           console.log(XMLHttpRequest);
    //         },
    //       });
    //     }
    //   })
    // })
  }