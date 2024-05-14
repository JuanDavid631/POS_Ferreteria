<div class="content-header">
 <div class="container-fluid">
  <div class="row mb-2">
   <div class="col-sm-6">
    <h1 class="m-0">Carga Masiva de Productos</h1>
   </div>
  </div>
 </div>
</div>

<!-- Main content -->
<div class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-lg-12">
    <div class="card card-info">
     <div class="card-header">
      <h3 class="card-title">Seleccionar Archivo de carga (Excel)</h3>
      <div class="card-tools">
       <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
       </button>
      </div>
     </div>
     <div class="card-body">
      <form method="POST" enctype="multipart/form-data" id="form_carga_productos">
       <div class="row">
        <div class="col-lg-10">
         <input type="file" name="fileProductos" id="fileProductos" class="form-control" accept=".xls, .xlsx">
        </div>
        <div class="col-lg-2">
         <input type="submit" value="Cargar Productos" class="btn btn-primary" id="btnCargar">
        </div>
       </div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>

 <!-- FILA PARA IMAGEN DEL GIF -->
 <div class="row mx-0">
  <div class="col-lg-12 mx-0 text-center">
   <img src="vistas/assets/imagenes/loading.gif" id="img_carga" style="display:none;">
  </div>
 </div>
</div>

<script>
$(document).ready(function() {
 $("#form_carga_productos").on('submit', function(e) {
  e.preventDefault();
  /*===================================================================*/
  //VALIDAR QUE SE SELECCIONE UN ARCHIVO
  /*===================================================================*/
  if ($("#fileProductos").get(0).files.length == 0) {
   Swal.fire({
    position: 'center',
    icon: 'warning',
    title: 'Debe seleccionar un archivo (Excel) para cargarlo en el sistema',
    showConfirmButton: false,
    timer: 2500
   })
  } else {
   /*===================================================================*/
   //VALIDAR QUE EL ARCHIVO SELECCIONADO SEA EN EXTENSION XLS O XLSX
   /*===================================================================*/
   var extensiones_permitidas = [".xls", ".xlsx"];
   var input_file_productos = $("#fileProductos");
   var exp_reg = new RegExp("([a-zA-Z0-9\s_\\-.\:])+(" + extensiones_permitidas.join('|') + ")$");

   if (!exp_reg.test(input_file_productos.val().toLowerCase())) {
    Swal.fire({
     position: 'center',
     icon: 'error',
     title: 'Debe seleccionar un archivo con extensión .xls o .xlsx que son archivos de Excel.',
     showConfirmButton: false,
     timer: 2500
    })
    return false;
   }
  }

  var datos = new FormData($(form_carga_productos)[0]);
  $("#btnCargar").prop("disabled", false);
  $("#img_carga").attr("style", "display:inline-block");
  $("#img_carga").attr("style", "height:200px");
  $("#img_carga").attr("style", "width:200px");

  $.ajax({
   url: "ajax/productos.ajax.php",
   type: "POST",
   data: datos,
   cache: false,
   contentType: false,
   processData: false,
   dataType: 'json',
   success: function(respuesta) {
    if (respuesta['totalCategorias'] > 0 && respuesta['totalProductos'] > 0) {
     Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Se registraron ' + respuesta['totalCategorias'] + ' categorías y ' + respuesta[
       'totalProductos'] + ' productos correctamente!',
      showConfirmButton: false,
      timer: 2500
     })

     $("#btnCargar").prop("disabled", true);
     $("#img_carga").attr("style", "display:none");
    } else {
     Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'Se presento un error al momento de realizar el registro de categorías y/o productos!',
      showConfirmButton: false,
      timer: 2500
     })
     $("#btnCargar").prop("disabled", false);
     $("#img_carga").attr("style", "display:none");


    }
   }
  });
 })
})
</script>