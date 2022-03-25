<main>
    <h2 class="mt-3">Excluir Livro</h2>
    <form method="post">

        <div class="form-group">
           <p>Deseja realmente excluir o livro <strong><?=$obLivro->titulo?></strong>?</p>
        </div>
        
        <div class="form-group mt-3">
        <a href="index.php">
            <button type="button" class="btn btn-success">Cancelar</button>
        </a>
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>

    </form>
</main>