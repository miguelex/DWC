<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<?php if ($error) return; ?>

<form class="formulario" method="POST" >
    <div class="campo">
        <label for="password">Nuevo Password</label>
        <input 
            type="password" 
            id="password" 
            placeholder="Tu nuevo password" 
            name="password"
        />
    </div>
    <input type="submit" class="boton" value="Guardar nuevo password">
</form>