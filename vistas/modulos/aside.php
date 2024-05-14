<?php
 $menuUsuario = UsuarioControlador::ctrObtenerMenuUsuario($_SESSION["usuario"] -> id_usuario);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
 <a href="#" class="brand-link">
  <img src="vistas/assets/dist/img/puerta.png" alt="Logo" class="brand-image img-circle elevation-3"
   style="opacity: .8">
  <span class="brand-text font-weight-light">Ferreteria POS</span>
 </a>

 <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
   <img src="vistas/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
   <h6 class="text-warning"><?php echo $_SESSION["usuario"] -> nombre_usuario. ' ' . $_SESSION["usuario"] -> apellido_usuario ?></h6>
  </div>
 </div>

 <div class="sidebar">
  <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
    data-accordion="false">
    <?php foreach($menuUsuario as $menu) : ?>
    <li class="nav-item">
     <a style="cursor: pointer;" class="nav-link <?php if($menu -> vista_inicio == 1) : ?>
                                                  <?php echo 'active'; ?> 
                                                 <?php endif; ?>" <?php if(!empty($menu -> vista)) : ?>
      onclick="CargarContenido('vistas/<?php echo $menu -> vista; ?>', 'content-wrapper')" <?php endif; ?>>
      <i class="nav-icon <?php echo $menu -> icon_menu ?>"></i>
      <p>
       <?php echo $menu -> modulo ?>
       <?php if(empty($menu -> vista)) : ?>
       <i class="right fas fa-angle-left"></i>
       <?php endif; ?>
      </p>
     </a>
     <?php if(empty($menu -> vista)) : ?>
     <?php $subMenuUsuario = UsuarioControlador::ctrObtenerSubMenuUsuario($menu -> id); ?>
     <ul class="nav nav-treeview">
      <?php foreach($subMenuUsuario as $subMenu) : ?>
      <li class="nav-item">
       <a style="cursor: pointer;" class="nav-link"
        onclick="CargarContenido('vistas/<?php echo $subMenu -> vista; ?>', 'content-wrapper')">
        <i class="<?php echo $subMenu -> icon_menu; ?> nav-icon"></i>
        <p><?php echo $subMenu -> modulo; ?></p>
       </a>
      </li>
      <?php endforeach; ?>
     </ul>
     <?php endif; ?>
    </li>
    <?php endforeach; ?>

    <li class="nav-item">
     <a style="cursor: pointer;" class="nav-link" href="http://localhost/POS_Ferreteria?cerrar_sesion=1">
      <i class="nav-icon fas fa-sign-out-alt"></i>
      <p>
       Cerrar Sesión
      </p>
     </a>
    </li>
   </ul>
  </nav>
 </div>
</aside>

<script>
$(".nav-link").on('click', function() {
 $(".nav-link").removeClass('active');
 $(this).addClass('active');
})
</script>