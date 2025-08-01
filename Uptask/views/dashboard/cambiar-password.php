<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver al perfil</a>

    <form method="post" class="formulario" action="/cambiar-password">
        <div class="campo">
            <label for="nombre">Password Actual</label>
            <input 
                type="password"  
                name="password_actual"   
                placeholder="Tu password actual" 
            />
        </div>
        <div class="campo">
            <label for="email">Nuevo Password</label>
            <input 
                type="password"  
                name="password_nuevo"   
                placeholder="Tu nuevo password" 
            />
        </div>
        <input type="submit" value="Guardar Cambios" />
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
