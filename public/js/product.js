$(async function() {
  clearInputs()
  await initCustomer();
  
})


async function initCustomer() {
  configAction()
  const response = await getListsCustomer()
  await showData(response)
}


function clearInputs() {
  // inputCodigo.value = '',
  inputProduct.value = '',
  // inputDescription.value = '',
  inputQuantity.value = '0',
  inputUnitPrice.value = ''
}

function configAction() {
$('.a-register').click( function() {
  if( inputProduct.value != '' ) {
    const data = {
      id: 0,
      code: '',//inputCodigo.value,
      product: inputProduct.value,
      description: '', //inputDescription.value,
      type: inputTipo.value,
      unit_price: inputUnitPrice.value,
      quantity: inputQuantity.value,
      percent_employee: inputPercentEmployee.value,
      _token: tokenLaravel
    }
    clearInputs()
    $.ajax({
      url: "/product/store",
      type: "post",
      dataType: "json",
      data,
      success: async function (resp) {
        let notifier = new Notifier();
        notifier.success('Producto registrado con éxito.', 'Producto registrado!');
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
            url: '/product/all',
            type: 'post',
            dataType: 'json',
            data: {
              "type": inputTipo.value,
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
let showQuantity = $('#hddShowQuantity').val()
let styleTdQuantity = showQuantity == '0' ? 'none' : 'show' ;
$.each(data.data, function (i, item) {
  // const strTdSexo = !!item.type ? '<span class="badge bg-primary-soft text-primary">Producto</span>' : '<span class="badge bg-red-soft text-red">Servicio</span>'
  // ${ showQuantity == '1' ? `<td> S/. ${ item.unit_price != null ? item.unit_price : '' } </td>` : ''  } 
  // debugger
  text += ` <tr data-id="${item.id}" id="tr-${item.id}">\   
              <td> ${ item.code != null ? item.code : '' } </td>\
              <td> ${ item.product != null ? item.product : '' } </td>\
              <td> ${ item.unit_price != null ? item.unit_price : '' } </td>\
              <td style="display:${styleTdQuantity}"> ${ item.quantity != null ? Number(item.quantity) : '' } </td>\
              <td> ${ item.percent_employee != null ? item.percent_employee : '' } </td>\
              <td style="display: none"> ${ item.created_at } </td>\
              <td class="text-center"> 
                <i class="fa-solid fa-timeline text-green icon-td mr-2"></i>\
                <i class="fas fa-trash icon-td text-red a-delete" data-id="${item.id}"></i>\
              </td>\
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
  code: '',
  product: '',
  // description: '',
  // type: '',
  unit_price: '',
  quantity:'',
  percent_employee: '',
})[numberLabel]
}

function handleCustomerUpdateRow() {

customerTd.innerHTML = customerValNew
if( customerValOld != customerValNew ) {
  $.ajax({
    url: "/product/update",
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
      notifier.success('Campo actualizado con éxito.', 'Producto Actualizado!');
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

$('#dataTable').on( 'click', 'tbody td:not(:last-child)', function (e) {
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
      order : [[5, 'desc']],
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
    title: 'Esta Seguro de eliminar el prodcuto?',
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
        url: "/product/update",
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
          notifier.success('Producto eliminado con éxito.', 'Producto Eliminado!');
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

// function toPercent(point){
//   var percent = Number(point*100).toFixed(1);
//   percent+=" %";
//   return percent;
// }