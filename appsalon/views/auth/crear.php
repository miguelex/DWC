<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Rellena el siguiente formulario para crear una cuenta</p>

<form action="/crear-cuenta" class="formualario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            id="nombre" 
            name="nombre" 
            placeholder="Tu nombre">
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            id="apellido" 
            name="apellido" 
            placeholder="Tu apellido">
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input 
            type="tel" 
            id="telefono" 
            name="telefono" 
            placeholder="Tu telefono">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password" 
            name="password" 
            placeholder="Tu password">
    </div>

    <input type="submit" class="boton" value="Crear cuenta">

</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia sesión</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>