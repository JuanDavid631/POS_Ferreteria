<div class="content-header">
 <div class="container-fluid">
  <div class="row mb-2">
   <div class="col-sm-6">
    <h1 class="m-0">Administrar Usuarios</h1>
   </div>
  </div>
 </div>
</div>

<div class="content">
 <div class="row">
  <div class="col-12 ">
   <div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
     <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
      <!-- TAB LISTADO DE USUARIOS -->
      <li class="nav-item">
       <a class="nav-link active my-0" id="listado-usuarios-tab" data-toggle="pill" href="#listado-usuarios" role="tab"
        aria-controls="listado-usuarios" aria-selected="true"><i class="fas fa-list"></i> Listado de Usuarios</a>
      </li>
      <!-- TAB REGISTRO DE USUARIOS -->
      <li class="nav-item">
       <a class="nav-link my-0" id="registrar-usuarios-tab" data-toggle="pill" href="#registrar-usuarios" role="tab"
        aria-controls="registrar-usuarios" aria-selected="false"><i class="fas fa-file-signature"></i> Registro de
        Usuario</a>
      </li>
     </ul>
    </div>

    <div class="card-body">
     <div class="tab-content" id="custom-tabs-four-tabContent">
      <!-- TAB CONTENT LISTADO DE USUARIOS -->
      <div class="tab-pane fade active show" id="listado-usuarios" role="tabpanel"
       aria-labelledby="listado-usuarios-tab">
       <div class="row">
        <!--LISTADO DE USUARIOS -->
        <div class="col-md-12">
         <table class="display nowrap table-striped w-100 shadow rounded" id="tbl_usuarios">
          <thead class="bg-info text-left">
           <th> </th> <!-- 0 -->
           <th></th>
           <th>id</th>
           <th>Nombres</th>
           <th>Apellidos</th>
           <th>Usuario</th>
           <th>Id. Perfil</th>
           <th>Perfil</th>
           <th>Estado</th><!-- 8 -->
          </thead>
          <tbody class="small text left">
         </tbody>
         </table>
        </div>
       </div>
      </div>

      <!-- TAB CONTENT REGISTRO DE USUARIOS -->
      <div class="tab-pane fade" id="registrar-usuarios" role="tabpanel" aria-labelledby="registrar-usuarios-tab">
       <form id="frm-datos-usuarios" class="needs-validation-usuarios" novalidate>
        <div class="row">
         <!-- NOMBRES -->
         <div class="col-4 mb-2">
          <input type="hidden" name="id_usuario" id="id_usuario" value="0">
          <label class="mb-0 ml-1 text-sm my-text-color"><i
            class="fas fa-user-alt mr-1 my-text-color"></i>Nombres</label>
          <input type="text" style="border-radius: 20px;" placeholder="Ingrese los nombres del nuevo usuario"
           class="form-control form-control-sm " id="nombres" name="nombres" aria-label="Small"
           aria-describedby="inputGroup-sizing-sm" required>
          <div class="invalid-feedback">Ingrese el nombre del nuevo usuario</div>
         </div>

         <!-- APELLIDOS -->
         <div class="col-4 mb-2">
          <label class="mb-0 ml-1 text-sm my-text-color"><i
            class="fas fa-user-alt mr-1 my-text-color"></i>Apellidos</label>
          <input type="text" style="border-radius: 20px;" placeholder="Ingrese los apellidos del nuevo usuario"
           class="form-control form-control-sm " id="apellidos" name="apellidos" aria-label="Small"
           aria-describedby="inputGroup-sizing-sm" required>
          <div class="invalid-feedback">Ingrese el apellidos del nuevo usuario</div>
          <!-- </div> -->

         </div>

         <!-- USUARIO DEL SISTEMA -->
         <div class="col-4 mb-2">
          <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Usuario del
           Sistema</label>
          <input type="text" style="border-radius: 20px;" placeholder="Ingrese el tipo del usuario del sistema"
           class="form-control form-control-sm" id="usuario" name="usuario" aria-label="Small" id_usuario="0"
           aria-describedby="inputGroup-sizing-sm" onchange="validateJS(event, 'usuario_sistema')" required>
          <div class="invalid-feedback">Ingrese tipo de usuario del sistema</div>
         </div>

         <!-- PASSWORD -->
         <div class="col-4 mb-2">
          <label class="mb-0 ml-1 text-sm my-text-color"><i
            class="fas fa-lock mr-1 my-text-color"></i>Contraseña</label>
          <input type="password" style="border-radius: 20px;" placeholder="Ingrese la contraseña"
           class="form-control form-control-sm" id="password" name="password" aria-label="Small"
           aria-describedby="inputGroup-sizing-sm" required>
          <div class="invalid-feedback">Ingrese la contraseña</div>
         </div>

         <!-- CONFIRMAR PASSWORD -->
         <div class="col-4 mb-2">
          <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-lock mr-1 my-text-color"></i>Confirmar
           Contraseña</label>
          <input type="password" style="border-radius: 20px;" placeholder="Ingrese la confirmacion de contraseña"
           class="form-control form-control-sm" id="confirmar_password" name="confirmar_password" aria-label="Small"
           aria-describedby="inputGroup-sizing-sm" required>
          <div class="invalid-feedback">Ingrese la confirmación de la contraseña</div>
         </div>

         <!-- PERFIL -->
         <div class="col-2 mb-2">
          <label class="mb-0 ml-1 text-sm my-text-color"><i
            class="fas fa-id-card-alt mr-1 my-text-color"></i>Perfil</label>
          <select class="form-select" id="perfil" name="perfil" aria-label="Floating label select example" required>
          </select>
          <div class="invalid-feedback">Seleccione el Perfil</div>
         </div>

         <!-- ESTADO -->
         <div class="col-2 mb-2">
          <label class="mb-0 ml-1 text-sm my-text-color"><i
            class="fas fa-toggle-on mr-1 my-text-color"></i>Estado</label>
          <select class="form-select" id="estado" name="estado" aria-label="Floating label select example" required>
           <option value="" disabled>-- Seleccione un estado --</option>
           <option value="1" selected>Activo</option>
           <option value="0">Inactivo</option>
          </select>
          <div class="invalid-feedback">Seleccione el estado</div>
         </div>

         <div class="col-12 mt-2">
          <div class="float-right">
           <button type="button" class="btn btn-danger fw-bold" id="btnCancelarUsuario">Limpiar<span
             class="btn fw-bold icon-btn-danger ">
             <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
            </span></button>
           <button type="button" class="btn btn-success fw-bold" id="btnRegistrarUsuario">Guardar<span
             class="btn fw-bold icon-btn-success ">
             <i class="fas fa-save fs-5 text-white m-0 p-0"></i></span></button>
          </div>
         </div>
        </div>
       </form>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>

<script>
var Toast = Swal.mixin({
 toast: true,
 position: 'top',
 showConfirmButton: false,
 timer: 2000
});

$(document).ready(function() {
 var tbl_usuarios;
 $.ajax({
  url: "ajax/usuarios.ajax.php",
  type: "POST",
  data: {
   'accion': 1
  },
  dataType: 'json',
  success: function(respuesta) {
   console.log("🚀 ~ $ ~ respuesta:", respuesta)
  }
 })
 cargarDataTables();
 CargarSelects();







 //fnc_CargarDatatableUsuarios();


 $("#confirmar_password").change(function() {
  if ($("#confirmar_password").val() != $("#password").val()) {

   $("#confirmar_password").parent().addClass("was-validated")
   $("#confirmar_password").parent().children(".invalid-feedback").html("Las contraseñas no coinciden");
   $("#confirmar_password").val("") //limpiar el valor para que se muestre el mensaje de validación
   return;
  }
 })

 $("#password").change(function() {

  if ($("#password").val().length < 6) {
   $("#password").parent().addClass("was-validated")
   $("#password").parent().children(".invalid-feedback").html("Mínimo 6 caracteres");
   $("#password").val("") //limpiar el valor para que se muestre el mensaje de validación
   return;
  }
 })


 $("#btnCancelarUsuario").on('click', function() {
  fnc_LimpiarFomulario();
 });

 $("#registrar-usuarios-tab").on('click', function() {
  fnc_LimpiarFomulario();
 })

 $("#listado-usuarios-tab").on('click', function() {
  fnc_LimpiarFomulario();
 })

 $("#btnRegistrarUsuario").on('click', function() {
  fnc_GuardarDatosUsuario();
 });

 $('#tbl_usuarios tbody').on('click', '.btnEditarUsuario', function() {
  fnc_IrFormularioActualizarUsuario($(this));
 });

})

function cargarDataTables() {
 tbl_usuarios = $("#tbl_usuarios").DataTable({
  ajax: {
   async: false,
   url: 'ajax/usuarios.ajax.php',
   type: 'POST',
   dataType: 'json',
   dataSrc: "",
   data: {
    accion: 1
   }
  },
  pageLength: [10, 15, 30],
  pageLength: 10,
  responsive: {
   details: {
    type: 'column'
   }
  },
  columnDefs: [{
    className: 'control',
    orderable: false,
    targets: 0
   },
   {
    targets: 6,
    visible: false
   },
   {
    targets: 8,
    createdCell: function(td, cellData, rowData, row, col) {
     if (rowData[8] != 'Activo') {
      $(td).parent().css('background', '#F2D7D5')
      $(td).parent().css('color', 'black')
     }
    }
   },
   {
    targets: 1,
    orderable: false,
    createdCell: function(td, cellData, rowData, row, col) {
     $(td).html("<span class='btnEditarUsuario text-primary px-1' style='cursor:pointer;'>" +
      "<i class='fas fa-pencil-alt fs-6'></i>" +
      "</span>")
    }
   }
  ],
  language: {
   "url": '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json'
  }
 });
}

function CargarSelects() {
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
}






function fnc_GuardarDatosUsuario() {

 let accion = '';
 form_usuarios_validate = validarFormulario('needs-validation-usuarios');

 //INICIO DE LAS VALIDACIONES
 if (!form_usuarios_validate) {
  mensajeToast("error", "complete los datos obligatorios");
  return;
 }

 Swal.fire({
  title: 'Está seguro(a) de guardar los datos del Usuario?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si!',
  cancelButtonText: 'No',
 }).then((result) => {

  if (result.isConfirmed) {

   if ($("#id_usuario").val() > 0) accion = 'actualizar_usuario'
   else accion = 'registrar_usuario'

   var formData = new FormData();

   formData.append('accion', accion);
   formData.append('datos_usuario', $("#frm-datos-usuarios").serialize());

   response = SolicitudAjax('ajax/usuarios.ajax.php', 'POST', formData);

   Swal.fire({
    position: 'top-center',
    icon: response['tipo_msj'],
    title: response['msj'],
    showConfirmButton: true,
    timer: 2000
   });

   $("#tbl_usuarios").DataTable().ajax.reload();
   fnc_LimpiarFomulario();

  }

 })
}

function fnc_IrFormularioActualizarUsuario(fila_actualizar) {

 if (fila_actualizar.parents('tr').hasClass('selected')) {
  fnc_LimpiarFomulario();
 } else {


  //ACTIVAR PANE REGISTRO DE PROVEEDORES:
  $("#registrar-usuarios-tab").addClass('active')
  $("#registrar-usuarios-tab").attr('aria-selected', true)
  $("#registrar-usuarios").addClass('active show')

  //DESACTIVAR PANE LISTADO DE PROVEEDORES:
  $("#listado-usuarios-tab").removeClass('active')
  $("#listado-usuarios-tab").attr('aria-selected', false)
  $("#listado-usuarios").removeClass('active show');

  // $("#registrar-proveedores-tab").html('Actualizar Proveedor')
  $("#registrar-usuarios-tab").html('<i class="fas fa-sync-alt"></i> Actualizar Usuario')

  var data = (fila_actualizar.parents('tr').hasClass('child')) ?
   $("#tbl_usuarios").DataTable().row(fila_actualizar.parents().prev('tr')).data() :
   $("#tbl_usuarios").DataTable().row(fila_actualizar.parents('tr')).data();

  // CUANDO ES ACTUALIZA NO ES OBLIGATORIO ENVIAR LA CONTRASEÑA
  $("#password").removeAttr('required')
  $("#password").prop('disabled', true)
  $("#confirmar_password").removeAttr('required')
  $("#confirmar_password").prop('disabled', true)

  $("#id_usuario").val(data['2']);
  $("#nombres").val(data['3']);
  $("#apellidos").val(data['4']);
  $("#usuario").val(data['5']);
  $("#usuario").attr('id_usuario', data['2'])
  $("#perfil").val(data['6']);
  $("#caja").val((data['8']));
  if (data['10'] == "ACTIVO") $("#estado").val("1")
  else $("#estado").select2.val("0");


 }

}

function fnc_LimpiarFomulario() {

 //LIMPIAR MENSAJES DE VALIDACION
 $(".needs-validation-usuarios").removeClass("was-validated");
 $(".form-floating").removeClass("was-validated");

 CargarSelects();
 $("#id_usuario").val('');
 $("#nombres").val('');
 $("#apellidos").val('');
 $("#usuario").val('')
 $("#usuario").attr('id_usuario', -1)

 $("#password").val('')
 $("#password").prop('required', true)
 $("#password").prop('disabled', false)

 $("#confirmar_password").val('')
 $("#confirmar_password").prop('required', true)
 $("#confirmar_password").prop('disabled', false)


 $("#listado-usuarios-tab").prop('disabled', false)

 $("#listado-usuarios-tab").addClass('active')
 $("#listado-usuarios-tab").attr('aria-selected', true)
 $("#listado-usuarios").addClass('active show')

 //DESACTIVAR PANE LISTADO DE PROVEEDORES:
 $("#registrar-usuarios-tab").removeClass('active')
 $("#registrar-usuarios-tab").attr('aria-selected', false)
 $("#registrar-usuarios").removeClass('active show')

 $("#registrar-usuarios-tab").html('<i class="fas fa-file-signature"></i> Registrar')


}

// function ajustarHeadersDataTables(element) {

//     var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
//         entries.forEach(function(entry) {
//             $(entry.target).DataTable().columns.adjust();
//         });
//     }) : null;

//     // Function to add a datatable to the ResizeObserver entries array
//     resizeHandler = function($table) {
//         if (observer)
//             observer.observe($table[0]);
//     };

//     // Initiate additional resize handling on datatable
//     resizeHandler(element);

// }
</script>