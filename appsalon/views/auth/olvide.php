<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Escribe tu email para recuperar tu password</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="Tu email">
    </div>
    <input type="submit" class="boton" value="Recuperar Password">
</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Registrate</a>
</div>