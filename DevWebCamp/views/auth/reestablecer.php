<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Colocia tu nuevo password</p>

    <?php 
        include_once __DIR__ . '/../templates/alertas.php';
    ?> 

    <?php if($token_valido) { ?>
    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Nuevo password</label>
            <input 
                type="password"
                id="password"
                class="formulario__input"
                placeholder="Tu nuevo password"
                name="password"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Guardar password">

    </form>
    <?php } ?>

     <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Crear una</a>
    </div>
</main>