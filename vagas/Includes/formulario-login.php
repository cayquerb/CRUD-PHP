<?php
    $alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>' : '';
    $alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">'.$alertaCadastro.'</div>' : '';
?>

<div class="jumbotron text-dark bg-light">
    <div class="row m-4 bg-white">
        <div class="col">
            <form method="post">

                <h1 class="container mt-3">Login</h1>
                <?=$alertaLogin?>

                <div class="container form-group">
                    <label for="">E-mail</label>
                    <input type="email" name="email" id="" class="form-control mb-3" required>
                </div>

                <div class="container form-group">
                    <label for="">Senha</label>
                    <input type="password" name="senha" id="" class="form-control mb-3" required>
                </div>

                <div class="container form-group mt-3">
                    <button type="submit" name="acao" value="logar" class="btn btn-primary" required>Entrar</button>
                </div>
            </form>
        </div>

        <div class="col mb-4">
            <form method="post">

                <h1 class="container mt-3">Cadastre-se</h1>
                <?=$alertaCadastro?>

                <div class="form-group container">
                    <label>Nome</label>
                    <input type="text" name="nome" id="" class="form-control mb-3" required>
                </div>

                <div class="container form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" id="" class="form-control mb-3" required>
                </div>

                <div class="container form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" id="" class="form-control mb-3" required>
                </div>

                <div class="container form-group mt-3">
                    <button type="submit" name="acao" value="cadastrar" class="btn btn-primary" required>Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>