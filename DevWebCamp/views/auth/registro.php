<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebcamp</p>

    <form action="" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text"
                id="nombre"
                class="formulario__input"
                placeholder="Tu Nombre"
                name="nombre"
            >
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text"
                id="apellido"
                class="formulario__input"
                placeholder="Tu Apellido"
                name="apellido"
            >
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                id="email"
                class="formulario__input"
                placeholder="Tu Email"
                name="email"
            >
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input 
                type="password"
                id="password"
                class="formulario__input"
                placeholder="Tu Password"
                name="password"
            >
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Password</label>
            <input 
                type="password"
                id="password2"
                class="formulario__input"
                placeholder="Repite tu Password"
                name="password2"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Crear Cuenta">

        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar sesión</a>
            <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
        </div>

    </form>
</main>