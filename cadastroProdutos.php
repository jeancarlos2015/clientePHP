<!DOCTYPE html>
<html lang="utf-8">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/funcoes.js"></script>
        <title>Cadastro De Pedidos</title>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="index.php">Pedidos</a></li>
                <li role="presentation" class="active"><a href="cadastroProdutos.php">Produtos</a></li>
                <li role="presentation"><a href="cadastroFornecedores.php">Fornecedor</a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h1>
                <th class="align-center">Cadastro De Produtos</th>
            </h1>
        </div>

        <form method="post" action="CadastroProdutos.php">
            <span class="campo" id="basic-addon1" >Nome</span>
            <input id="codigo" type="text" class="campo" name="nome"  placeholder="Fulano" required="required" aria-describedby="basic-addon1" value="Feijao">

            <span class="campo" id="basic-addon1" >Descrição</span>
            <input id="descricao" type="text" class="campo" name="descricao"  placeholder="Feijao" required="required" aria-describedby="basic-addon1" value="Feijao Rio Doce">

            <span class="campo" id="basic-addon1">Marca</span>
            <input id="marca" type="text" class="campo" name="marca"  placeholder="Rio doce" required="required" aria-describedby="basic-addon1" value="Rio doce">

            <span class="campo" id="basic-addon1">Preço</span>
            <input id="marca" type="text" class="campo" name="preco"  placeholder="Rio doce" required="required" aria-describedby="basic-addon1" value="20">

            <span class="campo" id="basic-addon1">Quantidade Unitaria</span>
            <input id="quantidade" type="text" class="campo" name="quantidade_unitaria"  placeholder="0" required="required" aria-describedby="basic-addon1" value="10">

            <span class="campo" id="basic-addon1">Quantidade Estoque</span>
            <input id="quantidade" type="text" class="campo" name="quantidade_estoque"  placeholder="0" required="required" aria-describedby="basic-addon1" value="20">

            <input  type="text" class="oculto" name="tipo" value="produto">

            <input  type="text" class="oculto" name="operacao" value="cadastro">
            <span class="campo" id="basic-addon1">Fornecedor</span>
            <select class="selectpicker campo" name="opcao">
                <option value="1231234" selected>Rio Doce</option>
                <option value="89048392043" >Santa Maria</option>
                <option value="432443243" >Feltrin</option>
                <option value="574857485" >Coca-Cola</option>
            </select>

            <div class="opcoes  radio">
                <label><input type="radio" name="optradio" value="tropeiro" checked="">Tropeiro</label>
                <label><input type="radio" name="optradio" value="salada">Salada</label>
                <label><input type="radio" name="optradio" value="prato">Prato</label>
                <label><input type="radio" name="optradio" value="espaguete">Espaguete</label>
                <label><input type="radio" name="optradio" value="refrigerante">Refrigerante</label>
            </div>
            <button type="submit" class="btn btn-default campo" onclick="verifica()">Cadastrar</button>

        </form>
        <?php
            $nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : '';
            $descricao = array_key_exists('descricao', $_POST) ? $_POST['descricao'] : '';
            $marca = array_key_exists('marca', $_POST) ? $_POST['marca'] : '';
            $preco = array_key_exists('preco', $_POST) ? $_POST['preco'] : '';
            $quantidade_unit = array_key_exists('quantidade_unitaria', $_POST) ? $_POST['quantidade_unitaria'] : '';
            $quantidade_estoq = array_key_exists('quantidade_estoque', $_POST) ? $_POST['quantidade_estoque'] : '';
            $cnpj = array_key_exists('opcao', $_POST) ? $_POST['opcao'] : '';
            $tipoProduto = array_key_exists('optradio', $_POST) ? $_POST['optradio'] : '';
            
            $client = new SoapClient("http://localhost:18865/fornecedor/Ws?WSDL");
            $parans = array('nome' => $nome, 'descricao' => $descricao, 'cnpj' => $cnpj, 'quantidade_unit' => $quantidade_unit,
                            'quantidade_estoq' => $quantidade_estoq, 'marca' => $marca, 'preco' => floatval($preco), 'tipo' => $tipoProduto);
            $result = (boolean)$client->salvarProduto($parans);
            
            if($result){
                echo "<div class='alert'>";
                echo "<h3 class='mensagem'>Produto Cadastrado Com Sucesso</h3>";
                echo "</div>";
            }
            
        ?>
        <br>
        <br>
    </body>
</html>