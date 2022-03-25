<?php
    $mensagem = '';
    if(isset($_GET['status'])) 
    {
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;
            
            case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
        }
    }

    $resultados = '';
    foreach($livros as $livro) {
        $resultados .= 
            '<tr>  
                <td>'.$livro->id.'</td>
                <td>'.$livro->codigo.'</td>
                <td>'.$livro->titulo.'</td>
                <td>'.$livro->autor.'</td>
                <td>'.$livro->sinopse.'</td>
                <td>'.($livro->ativo === 'Y' ? 'Dura' : 'Cartonada').'</td>
                <td>'.$livro->valor.'</td>
                <td>'.$livro->isnb.'</td>



               
                <td>'.date('d/m/y à\s H:i:s', strtotime($livro->data)).'</td>
                <td>
                    <a href="editar.php?id= '.$livro->id.'">
                        <button type="button" class="btn btn-primary">Editar</button>
                    </a>
                    <a href="excluir.php?id= '.$livro->id.'">
                        <button type="button" class="btn btn-danger">Excluir</button>
                    </a>
                </td>
            </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : 
        '<tr>
            <td colspan="9" class="text-center">Nenhum livro encontrado</td> 
        </tr>'; # <-- colspan remete a quantidade de colunas na tabelas, foi definido 8 para ficar ao centro do card.
    
    // GETS
    unset($_GET['status']);
    unset($_GET['pagina']);
    $gets = http_build_query($_GET); # <--constroi uma url especifica.

    // PAGINAÇÃO
    $paginacao = '';
    $paginas = $obPagination->getPages();
    foreach ($paginas as $key => $pagina) 
    {
        $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
        $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.'">
                            <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                        </a>';
    }
?>

<main>  
    <?=$mensagem?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Novo livro</button>
        </a>
    </section>

    <section>
        <form method="get">
            <div class="row my-2">

                <div class="col-6">
                    <label class="mb-1">Buscar por título</label>
                    <input type="text" name="busca" class="form-control"<?=$busca?>>
                </div>

                <div class="col-2">
                    <label class="mb-1">Tipo de Capa</label>
                    <select name="filtroCapa" class="form-select" id="">
                        <option value="">Dura/Cartonada</option>
                        <option value="Y" <?= $filtroStatus == 'Y' ? 'selected' : '' ?>>Dura</option>
                        <option value="N" <?= $filtroStatus == 'N' ? 'selected' : '' ?>>Cartonada</option>
                    </select>
                </div>

                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

            </div>
        </form>
    </section>
    
    <section>
        <table class="table bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Código do Livro</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Sinopse</th>
                    <th>Tipo de Capa</th>
                    <th>Valor</th>
                    <th>ISBN</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </thead>
        </table>

        <section>
            <?=$paginacao?>
        </section>
    </section>
</main>