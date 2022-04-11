// Init 
var dataCustomer = []

Date.prototype.toDateInputValue = (function () {
  var local = new Date(this);
  local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
  return local.toJSON().slice(0, 10);
});


var postData = []

$(async function() {

  // Venta
  initSale();
  await configCustomers();
  await configProducts();
  await configEmployee();
  configActions()

  addProduct();
  registrarVenta();



  // Reporte Venta
  initReportSale();

})


// Venta

function initSale() {
  $('#inputBirthday').val(new Date().toDateInputValue());
}

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
            $("#inputPhone").val(phone).trigger("change");
            $("#inputEmail").val(email).trigger("change");
            $("#inputGender").val(gender).trigger("change");
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
            $("#inputPhone").val(phone).trigger("change");
            $("#inputEmail").val(email).trigger("change");
            $("#inputGender").val(gender).trigger("change");
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
            $("#inputPhone").val(phone).trigger("change");
            $("#inputEmail").val(email).trigger("change");
            $("#inputGender").val(gender).trigger("change");
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


// Products
async function configProducts() {
  const data = await getListsProduct()
  // dataCustomer = data.data;
  let optionsProduct = {
    data: data.data,
    getValue: "product",
    list: {
        match: {
            enabled: true
        },
        onChooseEvent: function () {
            const _product = $("#txtProduct").getSelectedItemData()
            // debugger
            const { id, code, product, description, type, unit_price, quantity,  percent_employee } = _product
            
            const strType = type == 0 ? 'Producto' : 'Servicio'
            $("#txtProduct").attr('data-id', id)
            $("#txtTypeProduct").val(strType).trigger("change");
            $("#txtPriceProduct").val(unit_price).trigger("change");
        }
    },
  };

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


  $("#txtProduct").easyAutocomplete(optionsProduct);
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


// gEmployee
async function configEmployee() {
  const employee = await getEmployee()
  console.log('employee', employee)
  
  const { data } = employee;
  var html = '';

  for (var i = 0, len = data.length; i < len; ++i) {
      html+= '<option value="' + data[i]['id'] + '">' + data[i]['first_name'] + '</option>';
  }           

  $('#inputEmployee').append(html);
  // dataCustomer = data.data;

}
async function getEmployee() {
  return new Promise ( (resolve, reject) => {
        $.ajax({
              url: '/sale/employee',
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


function addProduct() {
  $('.addProduct').click(function () {
      let id = $("#txtProduct").attr('data-id')
    if(id !=  undefined) {
      let obj = postData.find(x => x.ProductId == id);
      if (obj == undefined) {
     
          // let code = $("#txtCodeProduct").val()
          let exam = $("#txtProduct").val()
          // let type = $("#txtTypeProduct").val()
          let quantity = ($('#txtQuantitytProduct').val() != '') ? $('#txtQuantitytProduct').val() : '1'
          let price = $("#txtPriceProduct").val()
          // let discount = $("#txtDiscountProduct").val()
          // let _import = $("#txtImportProduct").val()

          postData.push({ ProductId: id, Quantity: quantity, Price: price})

          // <td> ${code} </td>\
          // <td> ${discount} </td>\
          // <td> ${_import} </td>\
          // <td> ${type} </td>\
          $("#tbProductBody").append(`\
                      <tr id="tr-${id}" data-id="${id}">\
                          <td> ${exam} </td>\
                          <td> ${quantity} </td>\
                          <td> ${price} </td>\
                          <td class="text-center">\
                            <i class="fas fa-trash icon-delete removeProduct"></i>\
                          </td>\
                      </tr>\
                      `)
          $("#tfTotal").html('')
          $("#tfTotal").append(postData.reduce((a, b) => a + ( (parseFloat(b['Quantity']) * parseFloat(b['Price']) ) || 0), 0).toFixed(2))

          removeProduct()

          // $("#txtCodeProduct").val("")
          $("#txtProduct").val("")
          $("#txtTypeProduct").val("")
          $("#txtQuantitytProduct").val("1")
          $("#txtPriceProduct").val("0.00")
          // $("#txtDiscountProduct").val("0.00")
          // $("#txtImportProduct").val("0.00")
      }
      $("#txtProduct").focus()
    }   
  })

  $('.save').click(async function () {
          let data_details = ''
            postData.forEach( item => {
              data_details += `${item.ProductId}_${item.Quantity}_${item.Price}|`
            })
            data_details = data_details.substring(0, data_details.length-1)
  
  
            const data = {
              id_customer: inputDocument.dataset.id,
              id_employee: inputEmployee.value,
              total: Number(tfTotal.innerHTML),
              note: inputObservaciones.value,
              cita: inputEvent.value,
              time: inputEventTime.value,
              id_product: txtProduct2.dataset.id,
              detail: data_details,
              _token: tokenLaravel
            }
            
            if( data.id_customer == -1 ) {
              const { id } = await saveCustomer()
              if( id > -1 ) {
                data.id_customer = id
              } else {
                let notifier = new Notifier();
                notifier.error('Error al registrar al cliente.', 'Error!');
                return
              }
            }
            
            $.ajax({
              url: "/sale/store",
              type: "post",
              dataType: "json",
              data,
              success: async function (resp) {
                let notifier = new Notifier();
                notifier.success('Venta registrada con éxito.', 'Venta registrada!');
                setTimeout(() => {
                  document.location.href = hddUrl.value + '/reportdetail';
                },  1000);
                // showData(await getListsCustomer())
              },
              error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
              },
            });
  })
}

function removeProduct() {
  $('.removeProduct').click(function () {
      let tr = $(this).parent().parent()
      let id = $(tr).attr('data-id')
      for (var i = 0; i < postData.length; i++) {
          if (postData[i].ProductId == id) {
              postData.splice(i, 1);
              break
          }
      }

      $(tr).remove()
      $("#tfTotal").html('')
      $("#tfTotal").append(postData.reduce((a, b) => a + (parseFloat(b['Import']) || 0), 0).toFixed(2))
  })
}

function registrarVenta() {
  $("#btnRegistrarVenta").click(function () {
    if( postData.length > 0 ) {

      $('#exampleModalCenter').modal('show');

      // Swal.fire({
      //   title: 'Esta Seguro de registrar la venta?',
      //   html: modal.innerHTML,
      //   focusConfirm: false,
      //   preConfirm: () => {
      //     // debugger
      //     return [
      //       document.getElementById('swal-input1').value,
      //       document.getElementById('swal-input2').value
      //     ]
      //   },
      //   // input: 'date',
      //   // inputAttributes: {
      //   //   autocapitalize: 'off'
      //   // },
      //   text: "Ingrese la observación!",
      //   type: 'warning',
      //   showCancelButton: true,
      //   confirmButtonColor: '#0061f2',
      //   cancelButtonColor: '#d33',
      //   confirmButtonText: 'S\u00ED, Registrar!',
      //   cancelButtonText: 'Cancelar',
      //   showClass: {
      //     popup: 'animate__animated animate__fadeInDown'
      //   },
      //   hideClass: {
      //     popup: 'animate__animated animate__fadeOutUp'
      //   }
      // }).then((result) => {
      //   // TODO: Grabar en BD
      //   debugger
      //   if(  result.dismiss != 'cancel') {
      //     debugger
      //     // if (result.value) {

      //       let data_details = ''
      //       postData.forEach( item => {
      //         data_details += `${item.ProductId}_${item.Quantity}_${item.Price}|`
      //       })
      //       data_details = data_details.substring(0, data_details.length-1)
  
  
      //       const data = {
      //         id_customer: inputDocument.dataset.id,
      //         total: Number(tfTotal.innerHTML),
      //         note: result.value[0],
      //         cita: result.value[1],
      //         detail: data_details,
      //         _token: tokenLaravel
      //       }
            
      //       $.ajax({
      //         url: "/sale/store",
      //         type: "post",
      //         dataType: "json",
      //         data,
      //         success: async function (resp) {
      //           let notifier = new Notifier();
      //           notifier.success('Venta registrada con éxito.', 'Venta registrada!');
      //           setTimeout(() => {
      //             document.location.href = hddUrl.value + '/reportdetail';
      //           },  1000);
      //           // showData(await getListsCustomer())
      //         },
      //         error: function (XMLHttpRequest, textStatus, errorThrown) {
      //           console.log(XMLHttpRequest);
      //         },
      //       });
  
      //     // }
      //   }
        
      // })
    } else {
      let notifier = new Notifier();
      notifier.error('Ingrese los productos de la venta.', 'Atencion!');
    }
  })
}

// Reporte Venta

function initReportSale() {
  $('#dateBegin').val(new Date().toDateInputValue());
  $('#dateEnd').val(new Date().toDateInputValue());
  $('.finpenfing').click(function () {
    getSales()
  });
}

function getSales() {


  $("#tbody").append(`\
    <tr id="tr-1">\   
      <td> V000001 </td>\
      <td> 13/03/2022 </td>\
      <td> 18:50 </td>\
      <td> 47680674 </td>\
      <td> Sabina Vargas </td>\
      <td> Corte Cabello </td>\
      <td style="width:50px;text-align:right"> 20.00 </td>\
    </tr>\
  `)

    $('#dataTable').DataTable({
        order : [[1, 'asc']],
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
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "initComplete": function (settings, json) {
            $(".dt-button").each(function (index, item) {
                item.classList.add("btn");
                item.classList.add("btn-success");
            });
        }
    })
}


function configActions() {
  $('#inputDocument').blur( function (e) {
    setTimeout(() => {
      const customerIndex = dataCustomer.findIndex( item => item.document == inputDocument.value)
      if( customerIndex == -1 ) {
        inputDocument.dataset.id = '-1'
        $('#spNuevo').show()
        $('#spRegistrado').hide()
      } else {
        $('#spNuevo').hide()
        $('#spRegistrado').show()
      }

    }, 100);
  })
  $('#inputFirstName').blur( function (e) {
    setTimeout(() => {
      const customerIndex = dataCustomer.findIndex( item => item.first_name == inputFirstName.value)
      if( customerIndex == -1 ) {
        inputDocument.dataset.id = '-1'
        $('#spNuevo').show()
        $('#spRegistrado').hide()
      } else {
        $('#spNuevo').hide()
        $('#spRegistrado').show()
      }

    }, 100);
  })
  $('#inputLastName').blur( function (e) {
    setTimeout(() => {
      const customerIndex = dataCustomer.findIndex( item => item.last_name == inputLastName.value)
      if( customerIndex == -1 ) {
        inputDocument.dataset.id = '-1'
        $('#spNuevo').show()
        $('#spRegistrado').hide()
      } else {
        $('#spNuevo').hide()
        $('#spRegistrado').show()
      }

    }, 100);
  })
}

function saveCustomer() {

  return new Promise ( (resolve, reject) => {

    if( inputDocument.value != '' && inputFirstName.value != '' && inputLastName.value != '' ) {
      const data = {
        id: 0,
        document: inputDocument.value,
        first_name: inputFirstName.value,
        last_name: inputLastName.value,
        phone: inputPhone.value,
        email: inputEmail.value,
        // birthday:  inputBirthday.value,
        // address: inputAddress.value,
        gender: inputGender.value,
        // note: inputNote.value,
        _token: tokenLaravel
      }    

      $.ajax({
        url: "/customer/store",
        type: "post",
        dataType: "json",
        data,
        success: async function (id) {
          console.log('id', id)
          resolve(id);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(XMLHttpRequest);
          reject(-1)
        }
      });

      
    } else {
      let notifier = new Notifier();
      notifier.info('Ingrese los campos minimos para el registro.', 'Atencion!');
      reject(-1)
    }

  });
}