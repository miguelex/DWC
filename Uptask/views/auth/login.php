<div class="contenedor">
    <h1>UpTask</h1>
    <p class="tagline">Crea y administra tus proyectos</p>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar sesión</p>
        <form action="/" class="formulario" method="post">
            <div class="campo">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Tu Email"
                >
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Tu Password"
                >
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? Crea una</a>
            <a href="/olvide">Olvidé mi password</a>
        </div>
    </div>
</div>