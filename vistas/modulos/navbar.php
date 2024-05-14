<?php
 $menuUsuario = UsuarioControlador::ctrObtenerMenuUsuario($_SESSION["usuario"] -> id_usuario);
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
 <ul class="navbar-nav">
  <li class="nav-item">
   <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
  </li>
  <?php foreach($menuUsuario as $menu) : ?>
  <li class="nav-item d-none d-sm-inline-block">
   <a style="cursor: pointer;" class="nav-link <?php if($menu -> vista_inicio == 1) : ?>
                                                 <?php echo 'active'; ?> 
                                                <?php endif; ?>" <?php if(!empty($menu -> vista)) : ?>
    onclick="CargarContenido('vistas/<?php echo $menu -> vista; ?>', 'content-wrapper')" <?php endif; ?>>
    <p>
     <?php echo $menu -> modulo ?>
     <?php if(empty($menu -> vista)) : ?>
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
 </ul>
</nav>