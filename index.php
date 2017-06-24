
<!DOCTYPE html>
<html lang="utf-8">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/funcoes.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">

        <title>Consulta De Produtos e Cadastro De Pedidos</title>


    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="index.php">Pedidos</a></li>
                <li role="presentation"><a href="cadastroProdutos.php">Produtos</a></li>
                <li role="presentation"><a href="cadastroFornecedores.php">Fornecedor</a></li>
            </ul>
        </nav>

        <div class="jumbotron">
            <h1>
                Consulta De Produtos e Cadastro De Pedidos
            </h1>
        </div>
        <main class="imagem servicos container">

            <h1 class="bg-titulo">CONSULTA DE PRODUTOS</h1>
            <form method="post" action="index.php"> 
                <span class="campo" id="basic-addon1" >Nome Do Produto</span>
                <input id="descricao" type="text" class="campo" id="nome123" name="teste1234"  placeholder="Nome Do Produto" required="required" aria-describedby="basic-addon1">

                <button type="submit" class="btn btn-default campo">Consultar Produto</button>


            </form>

            <?PHP
            $nome1 = array_key_exists('teste1234', $_POST) ? $_POST['teste1234'] : '';
            $nome = strtolower($nome1);
            $clientSoap = new SoapClient("http://localhost:18865/cotacao2017v2/Ws?wsdl");
            $return_produtos = $clientSoap->listarTodosProdutos();
            $produtos_result = $return_produtos->return;
            $jsonProduto = json_decode($produtos_result);
            $produtos = $jsonProduto->produtos;
            $contador = 0;
            echo "<form method='post' action='cotacao.php'>";
            echo "<div class='figuras'>";
            $cnpj = "123123";
            $formapagamento1 = "A vista";
            $formapagamento2 = "3x Sem Juros";

            foreach ($produtos as $prod) {
                if ((strpos($nome, $prod->nome) !== false) || strpos($nome, $prod->descricao) !== false) {
                    $pagina = "<figure class='figure1'> "
                            . "<a><img class='prato' src='img/" . $prod->tipoProduto . ".png' alt='...' class='img-thumbnail'></a> "
                            . "<label><input name='tipo1[]' type='checkbox' value='" . $prod->codigo_produto . "'></label>"
                            . "<figcaption class='figure-caption'>" . $prod->descricao . "</figcaption>"
                            . "<figcaption class='figure-caption'>R$ " . $prod->preco . ",00</figcaption>"
                            . "</figure>";
                    echo $pagina;

                    $contador++;
                }
            }
            echo "</div>";
            if ($contador > 0) {
                echo "<div class='produtos'>";
                echo "<input type='text' class='oculto' name='formapagamento1' value='" . $formapagamento1 . "'>";
                echo "<input type='text' class='oculto' name='formapagamento2' value='" . $formapagamento2 . "'>";
                echo "<input type='text' class='campo' name='cpf' placeholder='CPF do cliente' required='required' aria-describedby='basic-addon1'>";
                echo "<button type='submit' class='btn btn-default campo'>Solicitar Pedido</button>";
                echo "</div>";
            }
            echo "</form>";

//               echo "<input type='text' class='oculto' name='vencimento' value='".$vencimento."'>";
//               echo "<input type='text' class='oculto' name='numeroPedido' value='".$numeroPedido."'>";
//               echo "<input type='text' class='oculto' name='dataPedido' value='".$dataPedido."'>";           
//               echo "<input type='text' class='oculto' name='fornecedor' value='".$fornecedor."'>";
//               echo "<input type='text' class='oculto' name='telefone' value='".$telefone."'>";
//               echo "<input type='text' class='oculto' name='email' value='".$email."'>";
//               echo "<input type='text' class='oculto' name='numeroCotacao' value='".$numeroCotacao."'>";
            ?>

    </body>
</html>

