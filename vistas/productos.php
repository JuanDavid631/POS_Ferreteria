<div class="content-header">
 <div class="container-fluid">
  <div class="row mb-2">
   <div class="col-sm-6">
    <h1 class="m-0">Inventario / Productos</h1>
   </div>
  </div>
 </div>
</div>

<div class="content">
 <div class="container-fluid">
  <!-- Criterios de busqueda -->
  <div class="row">
   <div class="col-lg-12">
    <div class="card card-info">
     <div class="card-header">
      <h3 class="card-title">Búsqueda Personalizada</h3>
      <div class="card-tools">
       <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
       </button>
       <button type="button" class="btn btn-tool text-danger" id="btnLimpiarBusqueda">
        <i class="fas fa-times"></i>
       </button>
      </div>
     </div>
     <div class="card-body">
      <div class="row">
       <div class="col-lg-12 d-lg-flex">
        <div style="width: 20%" class="form-floating mx-1">
         <input type="text" id="iptCodigoBarras" class="form-control" placeholder="Codigo de barras ..." data-index="2">
         <label for="iptCodigoBarras">Código de barras</label>
        </div>
        <div style="width: 20%" class="form-floating mx-1">
         <input type="text" id="iptCategoria" class="form-control" placeholder="Categoria" data-index="4">
         <label for="iptCategoria">Categoría</label>

        </div>
        <div style="width: 20%" class="form-floating mx-1">
         <input type="text" id="iptProducto" class="form-control" placeholder="Producto" data-index="5">
         <label for="iptProducto">Producto</label>

        </div>
        <div style="width: 20%" class="form-floating mx-1">
         <input type="text" id="iptPrecioVentaDesde" class="form-control" placeholder="P. Ventas desde">
         <label for="iptPrecioVentaDesde">P. Venta desde</label>

        </div>
        <div style="width: 20%" class="form-floating mx-1">
         <input type="text" id="iptPrecioVentaHasta" class="form-control" placeholder="P. Venta hasta">
         <label for="iptPrecioVentaHasta">P. Venta hasta</label>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>

  <!-- Tabla de productos -->
  <div class="row">
   <div class="col-lg-12">
    <table id="tbl_productos" class="table table-striped w-100 shadow">
     <thead class="bg-info">
      <tr style="font-size: 15px;">
       <th></th>
       <th>id</th>
       <th>Codigo</th>
       <th>Id Categoria</th>
       <th>Categoría</th>
       <th>Producto</th>
       <th>Precio Compra</th>
       <th>Precio Venta</th>
       <th>Utilidad</th>
       <th>Stock</th>
       <th>Min. Stock</th>
       <th>Ventas</th>
       <th>Fecha Creación</th>
       <th>Fecha Actualización</th>
       <th class="text-center">Opciones</th>
      </tr>
     </thead>
     <tbody class="text-small">
     </tbody>
    </table>
   </div>
  </div>
 </div>
</div>

<!-- Modal agregacion productos -->
<div class="modal fade" id="mdlGestionarProducto" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-gray py-1 align-items-center">
    <h5 class="modal-title">Agregar producto</h5>
    <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" id="btnCerrarModal"
     data-bs-dismiss="modal">
     <i class="far fa-times-circle"></i>
    </button>
   </div>

   <div class="modal-body">
    <form novalidate class="needs-validation">
     <div class="row">
      <!-- Columna registro codigo de barras -->
      <div class="col-lg-6">
       <div class="form-group mb-2">
        <label class="" for="iptCodigoReg">
         <i class="fas fa-barcode fs-6"></i>
         <span class="small">Código de Barras</span>
         <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" id="iptCodigoReg" name="iptCodigoReg"
         placeholder="Código de barras" required>
        <div class="invalid-feedback">Campo requerido</div>

       </div>
      </div>

      <!-- Columna categoria de productos -->
      <div class="col-lg-6">
       <div class="form-group mb-2">
        <label for="selCategoriaReg" class="">
         <i class="fas fa-dumpster fs-6"></i>
         <span class="small">Categoría</span>
         <span class="text-danger">*</span>
        </label>
        <select id="selCategoriaReg" class="form-select form-select-sm" aria-label=".form-select-sm example"
         required></select>
        <div class="invalid-feedback">Campo requerido</div>
       </div>
      </div>

      <!-- Columna registro descripcion del producto -->
      <div class="col-12">
       <div class="form-group mb-2">
        <label for="iptDescripcionReg" class="">
         <i class="fas fa-file-signature fs-6"></i>
         <span class="small">Descripción</span>
         <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" id="iptDescripcionReg" placeholder="Descripción"
         required>
        <div class="invalid-feedback">Campo requerido</div>
       </div>
      </div>

      <!-- Columna registro precio de compra del producto -->
      <div class="col-lg-4">
       <div class="form-group mb-2">
        <label for="iptPrecioCompraReg" class="">
         <i class="fas fa-dollar-sign fs-6"></i>
         <span class="small">Precio de compra</span>
         <span class="text-danger">*</span>
        </label>
        <input type="number" min="0" class="form-control form-control-sm" id="iptPrecioCompraReg"
         placeholder="Precio Compra" required>
        <div class="invalid-feedback">Campo requerido</div>
       </div>
      </div>

      <!-- Columna registro precio de venta del producto -->
      <div class="col-lg-4">
       <div class="form-group mb-2">
        <label for="iptPrecioVentaReg" class="">
         <i class="fas fa-dollar-sign fs-6"></i>
         <span class="small">Precio de venta</span>
         <span class="text-danger">*</span>
        </label>
        <input type="number" min="0" class="form-control form-control-sm" id="iptPrecioVentaReg"
         placeholder="Precio Venta" required>
        <div class="invalid-feedback">Campo requerido</div>
       </div>
      </div>

      <!-- Columna registro Utilidad del producto -->
      <div class="col-lg-4">
       <div class="form-group mb-2">
        <label for="iptUtilidadReg" class="">
         <i class="fas fa-dollar-sign fs-6"></i>
         <span class="small">Utilidad</span>
        </label>
        <input type="number" min="0" class="form-control form-control-sm" id="iptUtilidadReg" placeholder="Utilidad"
         disabled>
       </div>
      </div>

      <!-- Columna registro Stock del producto -->
      <div class="col-lg-6">
       <div class="form-group mb-2">
        <label for="iptStockReg" class="">
         <i class="fas fa-plus-circle fs-6"></i>
         <span class="small">Stock</span>
         <span class="text-danger">*</span>
        </label>
        <input type="number" min="0" class="form-control form-control-sm" id="iptStockReg" placeholder="Stock" required>
        <div class="invalid-feedback">Campo requerido</div>
       </div>
      </div>

      <!-- Columna registro Minimo Stock del producto -->
      <div class="col-lg-6">
       <div class="form-group mb-2">
        <label for="iptMinimoStockReg" class="">
         <i class="fas fa-minus-circle fs-6"></i>
         <span class="small">Mínimo Stock</span>
         <span class="text-danger">*</span>
        </label>
        <input type="number" min="0" class="form-control form-control-sm" id="iptMinimoStockReg"
         placeholder="Mínimo Stock" required>
        <div class="invalid-feedback">Campo requerido</div>
       </div>
      </div>

      <!-- Creacion de botones -->
      <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal"
       id="btnCancelarRegistro">Cancelar</button>
      <button type="button" class="btn btn-primary mt-3 mx-2" style="width:170px;" id="btnGuardarProducto">Guardar
       Producto</button>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>

<!-- Modal actualizacion de stock de los productos -->
<div class="modal fade" id="mdlGestionarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">

   <div class="modal-header bg-gray py-2">
    <h6 class="modal-title" id="titulo-modal-stock"> Stock</h6>
    <button type="button" class="btn-close text-white fs-6" data-bs-dismiss="modal" aria-label="Close"
     id="btnCerrarModalStock"></button>
   </div>

   <div class="modal-body">
    <div class="row">
     <div class="col-12 mb-3">
      <label for="" class="form-label text-primary d-block">Código: <span class="text-secondary"
        id="stock_codigoProducto"></span></label>
      <label for="" class="form-label text-primary d-block">Producto: <span class="text-secondary"
        id="stock_Producto"></span></label>
      <label for="" class="form-label text-primary d-block">Stock: <span class="text-secondary"
        id="stock_Stock"></span></label>
     </div>
     <div class="col-12">
      <div class="from-grop mb-2">
       <label for="iptStockSumar" class="">
        <i class="fas fa-plus-circle fs-6"></i> <span class="small" id="titulo_modal_label">Agregar al stock</span>
       </label>
       <input type="number" id="iptStockSumar" min="0" class="form-control form-contol-sm"
        placeholder="Ingrese la cantidad a agregar">
      </div>
     </div>
     <div class="col-12">
      <label for="" class="form-label text-danger">Nuevo stock:
       <span class="text-secondary" id="stock_NuevoStock"></span>
      </label><br>
     </div>
    </div>
   </div>

   <div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
     id="btnCancelarRegistroStock">Cancelar</button>
    <button type="button" class="btn btn-primary btn-sm" id="btnGuardarNuevoStock">Guardar</button>
   </div>
  </div>
 </div>
</div>

<script>
var accion;
var table;
var operacion_stock = 0;
var Toast = Swal.mixin({
 toast: true,
 position: 'top',
 showConfirmButton: false,
 timer: 2000
});

$(document).ready(function() {
 $.ajax({
  url: "ajax/productos.ajax.php",
  type: "POST",
  data: {
   'accion': 1
  },
  dataType: 'json',
  success: function(respuesta) {
   console.log("Respuesta: " + respuesta);
  }
 })

 /*===================================================================*/
 // CARGAR LISTADO DE CATEGORIAS EN LA AGREGACION DE NUEVOS PRODUCTO
 /*===================================================================*/
 $.ajax({
  url: "ajax/categorias.ajax.php",
  cache: false,
  contentType: false,
  processData: false,
  dataType: 'json',
  success: function(respuesta) {
   var options = '<option selected value="0" required>Seleccione una categoría</option>';
   for (let index = 0; index < respuesta.length; index++) {
    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][1] + '</option>';
   }
   $("#selCategoriaReg").html(options);
  }
 });

 /*===================================================================*/
 // CARGAR LISTADO EN LA TABLA DATATABLE JS DE LA VISTA DEL MODULO
 /*===================================================================*/
 table = $("#tbl_productos").DataTable({
  dom: 'Bfrtip',
  buttons: [{
    text: 'Agregar Producto',
    className: 'addNewRecord',
    action: function(e, dt, node, config) {
     $("#mdlGestionarProducto").modal('show');
     accion = 2;
    }
   },
   'excel', 'print', 'pageLength'
  ],
  pageLength: [5, 10, 15, 30, 50, 100],
  pageLength: 10,
  ajax: {
   url: "ajax/productos.ajax.php",
   dataSrc: '',
   type: "POST",
   data: {
    'accion': 1
   }
  },
  responsive: {
   details: {
    type: 'column'
   }
  },
  columnDefs: [{
    className: 'dtr-control',
    orderable: false,
    targets: 0
   },
   {
    targets: 1,
    visible: false
   },
   {
    targets: 3,
    visible: false
   },
   {
    targets: 9,
    createdCell: function(td, cellData, rowData, row, col) {
     if (parseFloat(rowData[9]) <= parseFloat(rowData[10])) {
      $(td).parent().css('background', '#FF5733')
     }
    }
   },
   {
    targets: 12,
    visible: false
   },
   {
    targets: 13,
    visible: false
   },
   {
    targets: 14,
    orderable: false,
    render: function(datqa, type, full, meta) {
     return "<center>" +
      "<span class='btnEditarProducto text-primary px-1' style='cursor:pointer;'>" +
      "<i class='fas fa-pencil-alt fs-5'></i>" +
      "</span>" +
      "<span class='btnAumentarStock text-success px-1' style='cursor:pointer;'>" +
      "<i class='fas fa-plus-circle fs-5'></i>" +
      "</span>" +
      "<span class='btnDisminuirStock text-warning px-1' style='cursor:pointer;'>" +
      "<i class='fas fa-minus-circle fs-5'></i>" +
      "</span>" +
      "<span class='btnEliminarProducto text-danger px-1' style='cursor:pointer;'>" +
      "<i class='fas fa-trash fs-5'></i>" +
      "</span>" +
      "</center>"
    }
   }
  ],
  language: {
   url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json',
  }
 });

 /*===================================================================*/
 // CRITERIOS DE BUSQUEDA PARA CAMPOS (CODIGO, CATEGORIA PRODUCTO)
 /*===================================================================*/
 $("#iptCodigoBarras").keyup(function() {
  table.column($(this).data('index')).search(this.value).draw();
 });

 $("#iptCategoria").keyup(function() {
  table.column($(this).data('index')).search(this.value).draw();
 });

 $("#iptProducto").keyup(function() {
  table.column($(this).data('index')).search(this.value).draw();
 });

 $("#iptPrecioVentaDesde, #iptPrecioVentaHasta").keyup(function() {
  table.draw();
 });

 // FILTRO DE VALORES ENTRE DOS CAMPOS DE BUSQUEDA
 $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
  var precioDesde = parseFloat($("#iptPrecioVentaDesde").val());
  var precioHasta = parseFloat($("#iptPrecioVentaHasta").val());
  var col_venta = parseFloat(data[7]);

  if ((isNaN(precioDesde) && isNaN(precioHasta)) ||
   (isNaN(precioDesde) && col_venta <= precioHasta) ||
   (precioDesde <= col_venta && isNaN(precioHasta)) ||
   (precioDesde <= col_venta && col_venta <= precioHasta)) {
   return true;
  }
  return false;
 });

 /*===================================================================*/
 // LIMPIEZA DE INPUTS DENTRO DE LOS FORMULARIOS O CAMPOS RESPECTIVOS
 /*===================================================================*/
 $("#btnLimpiarBusqueda").on('click', function() {
  $("#iptCodigoBarras").val('')
  $("#iptCategoria").val('')
  $("#iptProducto").val('')
  $("#iptPrecioVentaDesde").val('')
  $("#iptPrecioVentaHasta").val('')
  table.search('').columns().search('').draw();
 });

 $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {
  $("#validate_codigo").css('display', 'none');
  $("#validate_categoria").css('display', 'none');
  $("#validate_descripcion").css('display', 'none');
  $("#validate_precio_compra").css('display', 'none');
  $("#validate_precio_venta").css('display', 'none');
  $("#validate_stock").css('display', 'none');
  $("#validate_min_stock").css('display', 'none');

  $("#iptCodigoReg").val('');
  $("#iptDescripcionReg").val('');
  $("#iptPrecioCompraReg").val('');
  $("#iptPrecioVentaReg").val('');
  $("#iptUtilidadReg").val('');
  $("#iptStockReg").val('');
  $("#iptMinimoStockReg").val('');
 });

 $("#iptPrecioCompraReg, #iptPrecioVentaReg").keyup(function() {
  calcularUtilidad();
 });

 $("#iptPrecioCompraReg, #iptPrecioVentaReg").change(function() {
  calcularUtilidad();
 });

 $("#btnCancelarRegistroStock, #btnCerrarModalStock").on('click', function() {
  $("#iptStockSumar").val("");
 });

 /*===================================================================*/
 // VENTANA AUMENTAR STOCK EN LA TABLA DATATABLE
 /*===================================================================*/
 $('#tbl_productos tbody').on('click', '.btnAumentarStock', function() {
  operacion_stock = 1;
  $("#mdlGestionarStock").modal('show');
  $("#titulo-modal-stock").html('Aumentar Stock');
  $("#titulo_modal_label").html('Agregar al Stock');
  $("#iptStockSumar").attr("placeholder", "Ingrese la cantidad a agregar");

  var data = table.row($(this).parents('tr')).data();
  console.log(data);
  $("#stock_codigoProducto").html(data[2]);
  $("#stock_Producto").html(data[5]);
  $("#stock_Stock").html(data[9]);

  $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
 });

 /*===================================================================*/
 // AUMENTAR STOCK AL MOMENTO DE DIGITALIZAR
 /*===================================================================*/
 $("#iptStockSumar").keyup(function() {
  if (operacion_stock == 1) {
   if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {
    var stockActual = parseFloat($("#stock_Stock").html());
    var cantidadAgregar = parseFloat($("#iptStockSumar").val());
    $("#stock_NuevoStock").html(stockActual + cantidadAgregar);
   } else {
    Toast.fire({
     icon: 'warning',
     title: 'Ingrese un valor mayor a 0'
    });
    $("#iptStockSumar").val("");
    $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
   }
  } else {
   if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {
    var stockActual = parseFloat($("#stock_Stock").html());
    var cantidadAgregar = parseFloat($("#iptStockSumar").val());
    $("#stock_NuevoStock").html(stockActual - cantidadAgregar);
    if (parseInt($("#stock_NuevoStock").html()) < 0) {
     Toast.fire({
      icon: 'warning',
      title: 'La cantidad a disminuir no puede ser mayor al stock actual.'
     });
     $("#iptStockSumar").val("");
     $("#iptStockSumar").focus();
     $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
    }
   } else {
    Toast.fire({
     icon: 'warning',
     title: 'Ingrese un valor mayor a 0'
    });
    $("#iptStockSumar").val("");
    $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
   }
  }
 });

 /*===================================================================*/
 // DISMINUIR STOCK EN LA TABLA DATATABLE
 /*===================================================================*/
 $('#tbl_productos tbody').on('click', '.btnDisminuirStock', function() {
  operacion_stock = 2;
  $("#mdlGestionarStock").modal('show');
  $("#titulo-modal-stock").html('Disminuir Stock');
  $("#titulo_modal_label").html('Disminuir al Stock');
  $("#iptStockSumar").attr("placeholder", "Ingrese la cantidad a disminuir");

  var data = table.row($(this).parents('tr')).data();
  console.log(data);
  $("#stock_codigoProducto").html(data[2]);
  $("#stock_Producto").html(data[5]);
  $("#stock_Stock").html(data[9]);

  $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
 });

 /*===================================================================*/
 // AUMENTAR O DISMINUIR STOCK EN LA BASE DE DATOS
 /*===================================================================*/
 $("#btnGuardarNuevoStock").on('click', function() {
  if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {
   var nuevoStock = parseFloat($("#stock_NuevoStock").html()),
    codigo_producto = $("#stock_codigoProducto").html();
   var datos = new FormData();
   datos.append('accion', 3);
   datos.append('nuevoStock', nuevoStock);
   datos.append('codigo_producto', codigo_producto);

   $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    processData: false,
    contentType: false,
    dataType: 'json',
    success: function(respuesta) {
     $("#stock_NuevoStock").html("");
     $("#iptStockSumar").html("");
     $("#mdlGestionarStock").modal('hide');
     table.ajax.reload();
     Swal.fire({
      position: 'center',
      icon: 'success',
      title: respuesta,
      showConfirmButton: false,
      timer: 1500
     })
    }
   });
  } else {
   Toast.fire({
    icon: 'warning',
    title: 'Debe ingresar la cantidad respectiva'
   })
  }
 });

 /*========================================================================*/
 // EDITAR PRODUCTO EN LA BASE DE DATOS - MUESTRA DE INFORMACION EN TABLE
 /*========================================================================*/
 $("#tbl_productos tbody").on('click', '.btnEditarProducto', function() {
  accion = 4;
  $("#mdlGestionarProducto").modal('show');
  var data = table.row($(this).parents('tr')).data();
  $("#iptCodigoReg").val(data["codigo_producto"]);
  $("#selCategoriaReg").val(data["id_categoria"]);
  $("#iptDescripcionReg").val(data[5]);
  $("#iptPrecioCompraReg").val((data[6]).replace('$ ', ''));
  $("#iptPrecioVentaReg").val((data[7]).replace('$ ', ''));
  $("#iptUtilidadReg").val((data[8]).replace('$ ', ''));
  $("#iptStockReg").val((data["stock"]).replace(' Und(s)', ''));
  $("#iptMinimoStockReg").val(data[10].replace(' Und(s)', ''));
 });

 /*========================================================================*/
 // ELIMINAR PRODUCTO EN LA BASE DE DATOS
 /*========================================================================*/
 $("#tbl_productos tbody").on('click', '.btnEliminarProducto', function() {
  accion = 5;
  var data = table.row($(this).parents('tr')).data();
  var codigo_producto = data["codigo_producto"];
  Swal.fire({
   title: '¿Está seguro de eliminar el producto?',
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Si, deseo eliminarlo!',
   cancelButtonText: 'Cancelar'
  }).then((result) => {
   if (result.isConfirmed) {
    var datos = new FormData();
    datos.append("accion", accion);
    datos.append("codigo_producto", codigo_producto);
    $.ajax({
     url: "ajax/productos.ajax.php",
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     dataType: 'json',
     success: function(respuesta) {
      if (respuesta == "OK") {
       table.ajax.reload();
       Toast.fire({
        icon: 'success',
        title: 'El producto se eliminó correctamente!'
       });
      } else {
       Toast.fire({
        icon: 'error',
        title: 'El producto no se pudo eliminar'
       });
      }
     }
    });
   }
  });
 });
})

/*===================================================================*/
// CALCULA LA UTILIDA AL AGREGA NUEVO PRODUCTO
/*===================================================================*/
function calcularUtilidad() {
 var iptPrecioCompraReg = $("#iptPrecioCompraReg").val();
 var iptPrecioVentaReg = $("#iptPrecioVentaReg").val();
 var utilidad = iptPrecioVentaReg - iptPrecioCompraReg;
 $("#iptUtilidadReg").val(utilidad.toFixed(2));
}

/*===================================================================*/
// VALIDACIONES DE CAMPOS VACIOS Y AGREGACION DE UN NUEVO PRODUCTO
/*===================================================================*/
document.getElementById("btnGuardarProducto").addEventListener("click", function() {
 var forms = document.getElementsByClassName('needs-validation');
 var validation = Array.prototype.filter.call(forms, function(form) {
  if (form.checkValidity() === true) {
   console.log("Listo para registrar el producto")
   Swal.fire({
    title: '¿Está seguro de registrar el producto?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, deseo registrarlo!',
    cancelButtonText: 'Cancelar'
   }).then((result) => {
    if (result.isConfirmed) {
     var datos = new FormData();
     datos.append("accion", accion);
     datos.append("codigo_producto", $("#iptCodigoReg").val());
     datos.append("id_categoria_producto", $("#selCategoriaReg").val());
     datos.append("descripcion_producto", $("#iptDescripcionReg").val());
     datos.append("precio_compra_producto", $("#iptPrecioCompraReg").val());
     datos.append("precio_venta_producto", $("#iptPrecioVentaReg").val());
     datos.append("utilidad", $("#iptUtilidadReg").val());
     datos.append("stock_producto", $("#iptStockReg").val());
     datos.append("minimo_stock_producto", $("#iptMinimoStockReg").val());
     datos.append("ventas_producto", 0);

     if (accion == 2) {
      var titulo_msj = "El producto se registró correctamente!"
     }

     if (accion == 4) {
      var titulo_msj = "El producto se actualizó correctamente!"
     }

     $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(respuesta) {
       if (respuesta == "OK") {
        Toast.fire({
         icon: 'success',
         title: titulo_msj
        });
        table.ajax.reload();
        $("#mdlGestionarProducto").modal('hide');
        $("#iptCodigoReg").val("");
        $("#selCategoriaReg").val();
        $("#iptDescripcionReg").val("");
        $("#iptPrecioCompraReg").val("");
        $("#iptPrecioVentaReg").val("");
        $("#iptUtilidadReg").val("");
        $("#iptStockReg").val("");
        $("#iptMinimoStockReg").val("");
       } else {
        Toast.fire({
         icon: 'error',
         title: 'El producto no se pudo registrar'
        });
       }
      }
     });
    }
   });
  } else {
   console.log("No paso la validacion")
  }
  form.classList.add('was-validated');
 })
});

document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
 $(".needs-validation").removeClass("was-validated");
});

document.getElementById("btnCerrarModal").addEventListener("click", function() {
 $(".needs-validation").removeClass("was-validated");
});
</script>