<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>
    <form method="post">
        <div class="form-group mb-2">
            <label class="mb-1">Título da vaga</label>
            <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
        </div>

        <div class="form-group mb-2">
            <label class="mb-1">Descrição da vaga</label>
            <textarea class="form-control" name="descricao" rows="5"><?=$obVaga->descricao?></textarea>
        </div>

        <div class="form-group my-1"> 
            Status
            <div class="form-check col-2">
                <label class="form-control">
                    <input class="form-group" type="radio" name="ativo" value="Y" checked> Ativo
                </label>
                </div>
                
                <div class="form-check col-2">
                    <label  class="form-control">
                        <input type="radio" name="ativo" value="N" <?=$obVaga->ativo === 'N' ? 'checked' : ''?>> Inativo
                    </label>
                </div>
            </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>