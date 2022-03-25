<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>
    <form method="post">

        <div class="form-group mb-2">
            <label class="mb-1">Código do Livro</label>
            <input type="number" class="form-control" name="codigo" value="<?=$obLivro->codigo?>">
        </div>

        <div class="form-group mb-2">
            <label class="mb-1">Título do Livro</label>
            <input type="text" class="form-control" name="titulo" value="<?=$obLivro->titulo?>">
        </div>

        <div class="form-group mb-2">
            <label class="mb-1">Autor do Livro</label>
            <input type="text" class="form-control" name="autor" value="<?=$obLivro->autor?>">
        </div>
       
        <div class="form-group mb-2">
            <label class="mb-1">Sinopse</label>
            <textarea class="form-control" name="sinopse" rows="3"><?=$obLivro->sinopse?></textarea>
        </div>

        <div class="form-group my-4 "> 
            Tipo de Capa
            <div class="form-group col-2 my-2">
                <label class="form-control">
                    <input type="radio" name="ativo" value="Y" checked> Dura
                </label>
                </div>
                
                <div class="form-group col-2">
                    <label  class="form-control">
                        <input type="radio" name="ativo" value="N" <?=$obLivro->ativo === 'N' ? 'checked' : ''?>> Cartonada
                    </label>
                </div>
            </div>

        <div class="form-group mb-2">
            <label class="mb-1">Código ISBN</label>
            <input type="number" class="form-control" name="isbn" value="<?=$obLivro->isbn?>">
        </div>

        <div class="form-group mb-2">
            <label class="mb-1">Preço</label>
            <input type="value" class="form-control" name="valor" value="<?=$obLivro->valor?>">
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>