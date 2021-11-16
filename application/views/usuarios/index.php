<main class="container">
        <?php foreach ($usuarios as $usuario): ?>
                <h3><?php echo $usuario['nome']; ?></h3>
                <main>
                        <?php echo $usuario['email']; ?>
                </main>
                <p><a href="<?php echo site_url('usuarios/'.$usuario['id_usuario']); ?>">Ver mais</a></p>
        <?php endforeach; ?>
</main>