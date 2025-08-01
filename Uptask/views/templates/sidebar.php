<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2>UpTask</h2>
        <div class="cerrar-menu">
            <img id="cerrar-menu" src="build/img/cerrar.svg" alt="imagen cerrar">
        </div>
    </div>
    <nav class="sidebar-nav">
        <a class="<?php echo $titulo === 'Proyectos' ? 'activo' : ''; ?>" href="/dashboard" class="nav-link">Proyectos</a>
        <a class="<?php echo $titulo === 'Crear Proyecto' ? 'activo' : ''; ?>" href="/crear-proyecto" class="nav-link">Crear Proyecto</a>
        <a class="<?php echo $titulo === 'Perfil' ? 'activo' : ''; ?>" href="/perfil" class="nav-link">Perfil</a>
    </nav>

    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>
    </div>
</aside>