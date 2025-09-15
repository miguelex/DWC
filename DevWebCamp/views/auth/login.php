<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia sesión en DevWebcamp</p>

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

        <input type="submit" class="formulario__submit" value="Iniciar Sesión">

        <div class="acciones">
            <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Crear una</a>
            <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
        </div>

    </form>
</main>