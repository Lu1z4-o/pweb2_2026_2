
<div class="row">
    <?php actionMessage($success, $actionError) ?>
    <?php showValidationError($errors) ?>

    <form action="UsuarioForm.php" method="post">
        <h3> Formulário Usuário</h3>
        <div class="row">
            <div class=" col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'nome') ?>">
            </div>
            <div class="col-6">
                <label for="email">Email</label>
                <input type="mail" name="email" class="form-control" value="<?php echo getFormValue($data, 'email') ?>">
            </div>

            <div class=" col-6">
                <label for="telefone">Telefone</label>
                <input type="number" name="telefone" class="form-control" value="<?php echo getFormValue($data, 'telefone') ?>">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="./UsuarioList.php" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>