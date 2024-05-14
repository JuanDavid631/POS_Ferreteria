<div class="content-header">
 <div class="container-fluid">
  <div class="row mb-2">
   <div class="col-sm-6">
    <h1 class="m-0">Administrar Módulos y Perfiles</h1>
   </div>
  </div>
 </div>
</div>

<div class="content">
 <div class="container-fluid">
  <ul class="nav nav-tabs" id="tabs-asignar-modulos-perfil" role="tablist">
   <li class="nav-item">
    <a href="#content-perfiles" id="content-perfiles-tab" data-toggle="pill" class="nav-link" role="tab"
     aria-controls="content-perfiles" aria-selected="false">Perfiles</a>
   </li>
   <li class="nav-item">
    <a href="#content-modulos" id="content-perfiles-tab" data-toggle="pill" class="nav-link" role="tab"
     aria-controls="content-modulos" aria-selected="false">Módulos</a>
   </li>
   <li class="nav-item">
    <a href="#content-modulo-perfil" id="content-perfiles-tab" data-toggle="pill" class="nav-link active" role="tab"
     aria-controls="content-modulo-perfil" aria-selected="false">Asignar Módulo a Perfil</a>
   </li>
  </ul>

  <div class="tab-content" id="tabsContent-asignar-modulos-perfil">
   <div class="tab-pane fade mt-4 px-4" id="content-perfiles" role="tabpanel" aria-labelledby="content-modulos-tab">
    <div class="row">
     <div class="col-md-12">
      <div class="card card-primary card-outline shadow">
       <div class="card-header">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
         <!-- TAB LISTADO DE TIPOS DE DOCUMENTO -->
         <li class="nav-item">
          <a class="nav-link active my-0" id="listado-perfiles-tab" data-toggle="pill" href="#listado-perfiles"
           role="tab" aria-controls="listado-perfiles" aria-selected="true"><i class="fas fa-list"></i> Listado de
           Perfiles</a>
         </li>

         <!-- TAB REGISTRO DE TIPO DE DOCUMENTO -->
         <li class="nav-item">
          <a class="nav-link my-0" id="registrar-perfiles-tab" data-toggle="pill" href="#registrar-perfiles" role="tab"
           aria-controls="registrar-perfiles" aria-selected="false"><i class="fas fa-file-signature"></i> Registro de
           Perfil</a>
         </li>
        </ul>
       </div>

       <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
         <div class="tab-pane fade active show" id="listado-perfiles" role="tabpanel"
          aria-labelledby="listado-perfiles-tab">
          <!--LISTADO DE CATEGORIAS -->
          <table class="display nowrap table-striped w-100 shadow rounded" id="tbl_perfiles_data">
           <thead class="bg-info text-left">
            <th>id Perfil</th>
            <th>Perfil</th>
            <th>Estado</th>
           </thead>
           <tbody class="small text left">
           </tbody>
          </table>
         </div>
         <div class="tab-pane fade" id="registrar-perfiles" role="tabpanel" aria-labelledby="registrar-perfiles-tab">
          <form id="frm-datos-perfiles" class="needs-validation-perfiles" method="post" novalidate>
           <div class="row">
            <div class="col-8">
             <div class="form-floating mb-2">
              <input type="text" id="descripcion" class="form-control" name="descripcion" required>
              <label for="descripcion">Descripción</label>
              <div class="invalid-feedback">Ingrese la descripción</div>
             </div>
            </div>

            <!-- Estado Pefil -->
            <div class="col-4">
             <div class="form-floating mb-2">
              <select class="form-select select2" id="estado" name="estado" aria-label="Floating label select example"
               required>
               <option value="" disabled>-- Seleccione un estado de perfil --</option>
               <option value="1" selected>Activo</option>
               <option value="0">Inactivo</option>
              </select>
              <label for="estado">Estado</label>
             </div>
            </div>
            <div class="col-12 mt-2">
             <div class="float-right">
              <button type="button" class="btn btn-danger mx-1" id="btnCancelarPerfil">
               Limpiar
               <span class="btn fw-bold icon-btn-danger ">
                <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
               </span>
              </button>
              <button type="button" class="btn btn-success mx-1" id="btnRegistrarPerfil">
               Guardar
               <span class="btn fw-bold icon-btn-success ">
                <i class="fas fa-save fs-5 text-white m-0 p-0"></i></span>
              </button>
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

   <div class="tab-pane fade mt-4 px-4" id="content-modulos" role="tabpanel" aria-labelledby="content-modulos-tab">
    <div class="row">
     <!--LISTADO DE MODULOS -->
     <div class="col-md-6">
      <div class="card card-info card-outline shadow">
       <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list"> </i> Listado de Módulos</h3>
       </div>
       <div class="card-body">
        <table id="tblModulos" class="display nowrap table-striped shadow rounded" style="width:100%">
         <thead class="bg-info text-left">
          <th class="text-center">Acciones</th>
          <th>id</th>
          <th>orden</th>
          <th>Módulo</th>
          <th>Módulo Padre</th>
          <th>Vista</th>
          <th>Icono</th>
          <th>F. Creación</th>
          <th>F. Actualización</th>
         </thead>
         <tbody class="small text left"></tbody>
        </table>
       </div>
      </div>
     </div>
     <!--FORMULARIO PARA REGISTRO Y EDICION -->
     <div class="col-md-3">
      <div class="card card-info card-outline shadow">
       <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit"> </i> Registro de Módulos</h3>
       </div>
       <div class="card-body">
        <form method="post" class="needs-validation-registro-modulo" novalidate id="frm_registro_modulo">
         <div class="row">
          <div class="col-md-12">
           <div class="form-group mb-2">
            <label for="iptModulo" class="m-0 p-0 col-sm-12 col-form-label-sm"><span class="small">Módulo</span><span
              class="text-danger">*</span></label>
            <div class="input-group  m-0">
             <input type="text" class="form-control form-control-sm" name="iptModulo" id="iptModulo" required>
             <div class="input-group-append">
              <span class="input-group-text bg-primary"><i class="fas fa-laptop text-white fs-6"></i></span>
             </div>
             <div class="invalid-feedback">Debe ingresar el módulo</div>
            </div>
           </div>
          </div>
          <div class="col-md-12">
           <div class="form-group mb-2">
            <label for="iptVistaModulo" class="m-0 p-0 col-sm-12 col-form-label-sm"><span class="small">Vista
              PHP</span></label>
            <div class="input-group  m-0">
             <input type="text" class="form-control form-control-sm" name="iptVistaModulo" id="iptVistaModulo">
             <div class="input-group-append">
              <span class="input-group-text bg-primary"><i class="fas fa-code text-white fs-6"></i></span>
             </div>
            </div>
           </div>
          </div>
          <div class="col-md-12">
           <div class="form-group mb-2">
            <label for="iptIconoModulo" class="m-0 p-0 col-sm-12 col-form-label-sm"><span
              class="small">Icono</span><span class="text-danger">*</span></label>
            <div class="input-group  m-0">
             <input type="text" placeholder="<i class='far fa-circle'></i>" name="iptIconoModulo"
              class="form-control form-control-sm" id="iptIconoModulo" required>
             <div class="input-group-append">
              <span class="input-group-text bg-primary" id="spn_icono_modulo"><i
                class="far fa-circle fs-6 text-white"></i></span>
             </div>
             <div class="invalid-feedback">Debe ingresar el ícono del módulo</div>
            </div>
           </div>
          </div>
          <div class="col-md-12">
           <div class="form-group m-0 mt-2">
            <button type="button" class="btn btn-success w-100" id="btnRegistrarModulo">
             Guardar Módulo
             <span class="btn fw-bold icon-btn-success ">
              <i class="fas fa-save fs-5 text-white m-0 p-0"></i></span>
            </button>
           </div>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>
     <!--ARBOL DE MODULOS PARA REORGANIZAR -->
     <div class="col-md-3">
      <div class="card card-info card-outline shadow">
       <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit"></i> Organizar Módulos</h3>
       </div>
       <div class="card-body">
        <div class="">
         <div>Modulos del Sistema</div>
         <div class="" id="arbolModulos"></div>
        </div>
        <hr>
        <div class="row">
         <div class="col-md-12">
          <div class="text-center">
           <button id="btnReordenarModulos" class="btn btn-success mt-3 " style="width: 45%;">Organizar Módulos</button>
           <button id="btnReiniciar" class="btn btn-warning mt-3 " style="width: 45%;">Estado Inicial de los
            módulos</button>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>

   <div class="tab-pane fade active show mt-4 px-4" id="content-modulo-perfil" role="tabpanel"
    aria-labelledby="content-modulo-perfil-tab">
    <div class="row">
     <div class="col-md-8">
      <div class="card card-info card-outline shadow">
       <div class="card-header">
        <h3 class="card-title">
         <i class="fas fa-list"></i> Listado de Perfiles para los módulos
        </h3>
       </div>
       <div class="card-body">
        <table class="display nowrap table-striped w-100 shadow rounded" id="tbl_perfiles_asignar">
         <thead class="bg-info text-left">
          <th>id Perfil</th>
          <th>Perfil</th>
          <th>Estado</th>
          <th>F. Creación</th>
          <th>F. Actualización</th>
          <th class="text-center">Opciones</th>
         </thead>
         <tbody class="small text left">
         </tbody>
        </table>
       </div>
      </div>
     </div>
     <div class="col-md-4">
      <div class="card card-info card-outline shadow" style="display:block" id="card-modulos">
       <div class="card-header">
        <h3 class="card-title">
         <i class="fas fa-laptop"></i> Módulos del Sistema
        </h3>
       </div>
       <div class="card-body" id="card-body-modulos">
        <div class="row m-2">
         <div class="col-md-6">
          <button class="btn btn-success btn-small m-o p-0 w-100" id="marcar_modulos">Marcar Todo</button>
         </div>
         <div class="col-md-6">
          <button class="btn btn-danger btn-small m-o p-0 w-100" id="desmarcar_modulos">Desmarcar Todo</button>
         </div>
        </div>
        <div class="demo" id="modulos"></div>
        <div class="row m-2">
         <div class="col-md-12">
          <div class="form-group">
           <label>Seleccione el módulo de inicio</label>
           <select id="select_modulos" class="custom-select"></select>
          </div>
         </div>
        </div>
        <div class="row m-2">
         <div class="col-md-12">
          <button class="btn btn-success btn-small w-50 text-center" id="asignar_modulos">
           Asignar
           <span class="btn fw-bold icon-btn-success ">
            <i class="fas fa-save fs-5 text-white m-0 p-0"></i></span>
          </button>
         </div>
        </div>
       </div>
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
var tbl_perfiles_asignar, tbl_modulos, modulos_usuario, modulos_sistema, tbl_perfiles_data;

$(document).ready(function() {
 var idPerfil = 0;
 var selectedElmsIds = [];
 cargarDataTables();
 cargarDataTables2();
 ajustarHeadersDataTables($('#tblModulos'));
 iniciarArbolModulos();

 $('#tbl_perfiles_asignar tbody').on('click', '.btnSeleccionarPerfil', function() {
  var data = tbl_perfiles_asignar.row($(this).parents('tr')).data();
  if ($(this).parents('tr').hasClass('selected')) {
   $(this).parents('tr').removeClass('selected');
   $('#modulos').jstree("deselect_all", false);
   $("#select_modulos option").remove();
   idPerfil = 0;
  } else {
   tbl_perfiles_asignar.$('tr.selected').removeClass('selected');
   $(this).parents('tr').addClass('selected');
   idPerfil = data[0];
   $("#card-modulos").css("display", "block");
   $.ajax({
    async: false,
    url: "ajax/modulo.ajax.php",
    method: 'POST',
    data: {
     accion: 2,
     id_perfil: idPerfil
    },
    dataType: 'json',
    success: function(respuesta) {
     console.log(respuesta);
     modulos_usuario = respuesta;
     seleccionarModulosPerfil(idPerfil);
    }
   });
  }
 });

 $("#modulos").on("changed.jstree", function(evt, data) {
  $("#select_modulos option").remove();
  var selectedElms = $('#modulos').jstree("get_selected", true);
  $.each(selectedElms, function() {
   for (let i = 0; i < modulos_sistema.length; i++) {
    if (modulos_sistema[i]["id"] == this.id && modulos_sistema[i]["vista"]) {
     $('#select_modulos').append($('<option>', {
      value: this.id,
      text: this.text
     }));
    }
   }
  })
  if ($("#select_modulos").has('option').length <= 0) {
   $('#select_modulos').append($('<option>', {
    value: 0,
    text: "-- No hay modulos seleccionados --"
   }));
  }
 });

 /* =============================================================
      EVENTO PARA MARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
 ============================================================== */
 $("#marcar_modulos").on('click', function() {
  $('#modulos').jstree('select_all');
 })

 /* =============================================================
     EVENTO PARA DESMARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
  ============================================================= */
 $("#desmarcar_modulos").on('click', function() {
  $('#modulos').jstree("deselect_all", false);
  $("#select_modulos option").remove();
  $('#select_modulos').append($('<option>', {
   value: 0,
   text: "-- No hay modulos seleccionados --"
  }));
 })

 /* =============================================================
   REGISTRO EN BASE DE DATOS DE LOS MODULOS ASOCIADOS AL PERFIL 
  ============================================================= */
 $("#asignar_modulos").on('click', function() {
  selectedElmsIds = []
  var selectedElms = $('#modulos').jstree("get_selected", true);
  $.each(selectedElms, function() {
   selectedElmsIds.push(this.id);
   if (this.parent != "#") {
    selectedElmsIds.push(this.parent);
   }
  });
  let modulosSeleccionados = [...new Set(selectedElmsIds)];
  let modulo_inicio = $("#select_modulos").val();
  if (idPerfil != 0 && modulosSeleccionados.length > 0) {
   registrarPerfilModulos(modulosSeleccionados, idPerfil, modulo_inicio);
  } else {
   Swal.fire({
    position: 'center',
    icon: 'warning',
    title: 'Debe seleccionar el perfil y módulos a registrar',
    showConfirmButton: false,
    timer: 3000
   })
  }
 });

 fnCargarArbolModulos();
 /* =============================================================
    REORGANIZAR MODULOS DEL SISTEMA
 ============================================================= */
 $("#btnReordenarModulos").on('click', function() {
  fnOrganizarModulos();
 });

 /* =============================================================
					REINICIALIZAR MODULOS DEL SISTEMA EN EL JSTREE
 ============================================================= */
 $("#btnReiniciar").on('click', function() {
  actualizarArbolModulos();
 });

 /*=============================================================
						VISTA PREVIA DEL ICONO DE LA VISTA
 ==============================================================*/
 $("#iptIconoModulo").change(function() {
  $("#spn_icono_modulo").html($("#iptIconoModulo").val())
  if ($("#iptIconoModulo").val().length === 0) {
   $("#spn_icono_modulo").html("<i class='far fa-circle fs-6 text-white'></i>")
  }
 });

 /*===================================================================
					EVENTO QUE GUARDA LOS DATOS DEL MODULO y PERFIL
 ===================================================================*/
 document.getElementById("btnRegistrarModulo").addEventListener("click", function() {
  fnRegistrarModulo();
 });

 document.getElementById("btnRegistrarPerfil").addEventListener("click", function() {
  fnc_GuardarPerfil();
 });

 document.getElementById("btnCancelarPerfil").addEventListener("click", function() {
  fnc_LimpiarFomulario();
 });
})

function cargarDataTables() {
 tbl_perfiles_asignar = $("#tbl_perfiles_asignar").DataTable({
  ajax: {
   async: false,
   url: 'ajax/perfil.ajax.php',
   type: 'POST',
   dataType: 'json',
   dataSrc: "",
   data: {
    accion: 1
   }
  },
  columnDefs: [{
    targets: 2,
    sortable: false,
    createdCell: function(td, cellData, rowData, row, col) {
     if (parseInt(rowData[2]) == 1) {
      $(td).html("Activo")
     } else {
      $(td).html("Inactivo")
     }
    }
   },
   {
    targets: 5,
    sortable: false,
    render: function(data, type, full, meta) {
     return "<center>" +
      "<span class='btnSeleccionarPerfil text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Seleccionar perfil'> " +
      "<i class='fas fa-check fs-5'></i> " +
      "</span> " +
      "</center>";
    }
   }
  ],
  language: {
   "url": '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json'
  }
 });

 tbl_modulos = $('#tblModulos').DataTable({
  ajax: {
   async: false,
   url: 'ajax/modulo.ajax.php',
   type: 'POST',
   dataType: 'json',
   dataSrc: "",
   data: {
    accion: 3
   }
  },
  columnDefs: [{
    targets: 7,
    visible: false
   },
   {
    targets: 8,
    visible: false
   },
   {
    targets: 6,
    visible: false
   },
   {
    targets: 2,
    visible: false
   },
   {
    targets: 0,
    sortable: false,
    render: function(data, type, full, meta) {
     return "<center>" +
      "<span class='fas fa-edit fs-6 btnSeleccionarModulo text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Seleccionar Módulo'> " +
      "</span> " +
      "<span class='fas fa-trash fs-6 btnEliminarModulo text-danger px-1' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Módulo'> " +
      "</span>" +
      "</center>";
    }
   }
  ],
  scrollX: true,
  order: [
   [2, 'asc']
  ],
  lengthMenu: [0, 5, 10, 15, 20, 50],
  pageLength: 20,
  language: {
   "url": '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json'
  }
 });
}

function cargarDataTables2() {
 tbl_perfiles_data = $("#tbl_perfiles_data").DataTable({
  ajax: {
   async: false,
   url: 'ajax/perfil.ajax.php',
   type: 'POST',
   dataType: 'json',
   dataSrc: "",
   data: {
    accion: 3
   }
  },
  columnDefs: [{
   targets: 2,
   sortable: false,
   createdCell: function(td, cellData, rowData, row, col) {
    if (parseInt(rowData[2]) == 1) {
     $(td).html("Activo")
    } else {
     $(td).html("Inactivo")
    }
   }
  }],
  language: {
   "url": '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json'
  }
 });
}

function ajustarHeadersDataTables(element) {
 var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
  entries.forEach(function(entry) {
   $(entry.target).DataTable().columns.adjust();
  });
 }) : null;
 // Function to add a datatable to the ResizeObserver entries array
 resizeHandler = function($table) {
  if (observer)
   observer.observe($table[0]);
 };
 // Initiate additional resize handling on datatable
 resizeHandler(element);
}

function iniciarArbolModulos() {
 $.ajax({
  async: false,
  url: "ajax/modulo.ajax.php",
  method: 'POST',
  data: {
   accion: 1
  },
  dataType: 'json',
  success: function(respuesta) {
   modulos_sistema = respuesta;
   console.log(respuesta);
   $('#modulos').jstree({
    'core': {
     "check_callback": true,
     'data': respuesta
    },
    "checkbox": {
     "keep_selected_style": false
    },
    "types": {
     "default": {
      "icon": "fas fa-laptop text-primary"
     }
    },
    "plugins": ["wholerow", "checkbox", "types", "changed"]
   }).bind("loaded.jstree", function(event, data) {
    $(this).jstree("open_all");
   });
  }
 })
}

function seleccionarModulosPerfil(pin_idPerfil) {
 $('#modulos').jstree('deselect_all');
 for (let i = 0; i < modulos_sistema.length; i++) {
  if (parseInt(modulos_sistema[i]["id"]) == parseInt(modulos_usuario[i]["id"]) && parseInt(modulos_usuario[i][
    "sel"
   ]) == 1) {
   $("#modulos").jstree("select_node", modulos_sistema[i]["id"]);
  }
 }

 if (pin_idPerfil == 1) { //Solo para el perfil del administrador
  $("#modulos").jstree(true).hide_node(13);
 } else {
  $('#modulos').jstree(true).show_all();
 }
}

function registrarPerfilModulos(modulosSeleccionados, idPerfil, idModulo_inicio) {
 $.ajax({
  async: false,
  url: "ajax/perfil_modulo.ajax.php",
  method: 'POST',
  data: {
   accion: 1,
   id_modulosSeleccionados: modulosSeleccionados,
   id_Perfil: idPerfil,
   id_modulo_inicio: idModulo_inicio
  },
  dataType: 'json',
  success: function(respuesta) {
   if (respuesta > 0) {
    Swal.fire({
     position: 'center',
     icon: 'success',
     title: 'Se registro correctamente',
     showConfirmButton: false,
     timer: 2000
    })
    $("#select_modulos option").remove();
    $('#modulos').jstree("deselect_all", false);
    tbl_perfiles_asignar.ajax.reload();
    $("#card-modulos").css("display", "none");
   } else {
    Swal.fire({
     position: 'center',
     icon: 'error',
     title: 'Error al registrar',
     showConfirmButton: false,
     timer: 3000
    })
   }
  }
 });
}

function actualizarArbolModulosPerfiles() {
 $.ajax({
  async: false,
  url: "ajax/modulo.ajax.php",
  method: 'POST',
  data: {
   accion: 1
  },
  dataType: 'json',
  success: function(respuesta) {
   modulos_sistema = respuesta;
   $('#modulos').jstree(true).settings.core.data = respuesta;
   $('#modulos').jstree(true).refresh();
  }
 });
}

function fnCargarArbolModulos() {
 var dataSource;
 $.ajax({
  async: false,
  url: "ajax/modulo.ajax.php",
  method: 'POST',
  data: {
   accion: 1
  },
  dataType: 'json',
  success: function(respuesta) {
   dataSource = respuesta;
  }
 });

 /* $.jstree.defaults.core.check_callback:
			Determina lo que sucede cuando un usuario intenta modificar la estructura del árbol .
			Si se deja como false se impiden todas las operaciones como crear, renombrar, eliminar, mover o copiar.
			Puede configurar esto en true para permitir todas las interacciones o usar una función para tener un mejor control.
 */
 $('#arbolModulos').jstree({
  "core": {
   "check_callback": true,
   "data": dataSource
  },
  "types": {
   "default": {
    "icon": "fas fa-laptop"
   },
   "file": {
    "icon": "fas fa-laptop"
   }
  },
  "plugins": ["types", "dnd"]
 }).bind('ready.jstree', function(e, data) {
  $('#arbolModulos').jstree('open_all')
 })
}

function actualizarArbolModulos() {
 $.ajax({
  async: false,
  url: "ajax/modulo.ajax.php",
  method: 'POST',
  data: {
   accion: 1
  },
  dataType: 'json',
  success: function(respuesta) {
   $('#arbolModulos').jstree(true).settings.core.data = respuesta;
   $('#arbolModulos').jstree(true).refresh();
  }
 });
}

function fnOrganizarModulos() {
 var array_modulos = [];
 var reg_id, reg_padre_id, reg_orden;
 var v = $("#arbolModulos").jstree(true).get_json('#', {
  'flat': true
 });
 for (i = 0; i < v.length; i++) {
  var z = v[i];
  reg_id = z["id"];
  reg_padre_id = z["parent"];
  reg_orden = i;
  array_modulos[i] = reg_id + ';' + reg_padre_id + ';' + reg_orden;
 }
 console.log("🚀 ~ fnOrganizarModulos ~ array_modulos:", array_modulos)

 /*REGISTRAMOS LOS MODULOS CON EL NUEVO ORDENAMIENTO */
 $.ajax({
  async: false,
  url: "ajax/modulo.ajax.php",
  method: 'POST',
  data: {
   accion: 4,
   modulos: array_modulos
  },
  dataType: 'json',
  success: function(respuesta) {
   if (respuesta > 0) {
    Swal.fire({
     position: 'center',
     icon: 'success',
     title: 'Se registró correctamente',
     showConfirmButton: false,
     timer: 1500
    })
    tbl_modulos.ajax.reload();
    actualizarArbolModulosPerfiles();
   } else {
    Swal.fire({
     position: 'center',
     icon: 'error',
     title: 'Error al registrar',
     showConfirmButton: false,
     timer: 1500
    })
   }
  }
 });
}

function fnRegistrarModulo() {
 var forms = document.getElementsByClassName('needs-validation-registro-modulo');
 var validation = Array.prototype.filter.call(forms, function(form) {
  if (form.checkValidity() === true) {
   console.log("Listo para registrar el producto");
   Swal.fire({
    title: 'Está seguro de registrar el producto?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, deseo registrarlo!',
    cancelButtonText: 'Cancelar',
   }).then((result) => {
    if (result.isConfirmed) {
     $("#iptIconoModulo").val($('#spn_icono_modulo i').attr('class'));
     $.ajax({
      async: false,
      url: "ajax/modulo.ajax.php",
      method: 'POST',
      data: {
       accion: 5,
       datos: $('#frm_registro_modulo').serialize()
      },
      dataType: 'json',
      success: function(respuesta) {
       console.log("🚀 ~ validation ~ respuesta:", respuesta);
       Swal.fire({
        position: 'center',
        icon: 'success',
        title: respuesta,
        showConfirmButton: false,
        timer: 1500
       })
       tbl_modulos.ajax.reload();

       //recargamos arbol de modulos - MANTENIMIENTO MODULOS
       actualizarArbolModulos();

       //recargamos arbol de modulos - MANTENIMIENTO MODULOS ASIGNADOS A PERFILES                                
       actualizarArbolModulosPerfiles();

       $("#iptModulo").val("");
       $("#iptVistaModulo").val("");
       $("#iptIconoModulo").val("");
       $(".needs-validation-registro-modulo").removeClass("was-validated");
      }
     })
    }
   });
  }
  form.classList.add('was-validated');
 })
}

function fnc_GuardarPerfil() {
 var forms = document.getElementsByClassName('needs-validation-perfiles');
 var validation = Array.prototype.filter.call(forms, function(form) {
  if (form.checkValidity() === true) {
   console.log("Listo para registrar el perfil");
   Swal.fire({
    title: 'Está seguro de registrar el perfil nuevo?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, deseo registrarlo!',
    cancelButtonText: 'Cancelar',
   }).then((result) => {
    if (result.isConfirmed) {
     $.ajax({
      async: false,
      url: "ajax/perfil.ajax.php",
      method: 'POST',
      data: {
       accion: 2,
       datos: $('#frm-datos-perfiles').serialize()
      },
      dataType: 'json',
      success: function(respuesta) {
       console.log("🚀 ~ validation ~ respuesta:", respuesta);
       Swal.fire({
        position: 'center',
        icon: 'success',
        title: respuesta,
        showConfirmButton: false,
        timer: 1500
       })
       $("#descripcion").val("");
       $(".needs-validation-perfiles").removeClass("was-validated");
      }
     })
    }
   })
  }
  form.classList.add('was-validated');
 })
}

function fnc_LimpiarFomulario() {
 $("#descripcion").val('')
 $("#estado").val('1');
 $(".needs-validation-perfiles").removeClass("was-validated");
}
</script>