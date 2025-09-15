<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu acceso a DevWebcamp</p>

    <form action="" class="formulario">
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

        <input type="submit" class="formulario__submit" value="Recuperar Contraseña">

        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar sesión</a>
            <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Crear una</a>
        </div>

    </form>
</main>