<!DOCTYPE html>
<html lang="utf-8">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Cadastro De Fornecedor</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/funcoes.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="index.php">Pedidos</a></li>
                <li role="presentation"><a href="cadastroProdutos.php">Produtos</a></li>
                <li role="presentation" class="active"><a href="cadastroFornecedores.php">Fornecedor</a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h1>
                <th class="align-center">Cadastro De Fornecedor</th>
            </h1>
        </div>
        <br>

        <form method="post" action="cadastroFornecedores.php">
            <span class="campo" id="basic-addon1" >CNPJ</span>
            <input type="text" class="campo" name="cnpj"  placeholder="XX.XXX.XXX/YYYY-ZZ" required="required" aria-describedby="basic-addon1">

            <span class="campo" id="basic-addon1" >Nome Do Fornecedor</span>
            <input type="text" class="campo" name="nome"  placeholder="Fulano" required="required" aria-describedby="basic-addon1">

            <span class="campo" id="basic-addon1" >Endereço</span>
            <input type="text" class="campo" name="endereco"  placeholder="Endereço" required="required" aria-describedby="basic-addon1">

            <span class="campo" id="basic-addon1" >Email</span>
            <input type="text" class="campo" name="email"  placeholder="Fulano" required="required" aria-describedby="basic-addon1">

            <span class="campo" id="basic-addon1" >Telefone</span>
            <input type="text" class="campo" name="telefone"  placeholder="Fulano" required="required" aria-describedby="basic-addon1">

            <input  type="text" class="oculto" name="tipo" value="fornecedor">

            <input  type="text" class="oculto" name="operacao" value="cadastro">

            <button type="submit" class="btn btn-default campo">Cadastrar</button>            

            
        </form>
        <?php
            $cnpj = array_key_exists('cpnj', $_POST) ? $_POST['cnpj'] : '';
            $nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : '';
            $endereco = array_key_exists('endereco', $_POST) ? $_POST['endereco'] : '';
            $email = array_key_exists('email', $_POST) ? $_POST['email'] : '';
            $telefone = array_key_exists('telefone', $_POST) ? $_POST['telefone'] : '';
            $client = new SoapClient("http://localhost:18865/fornecedor/Ws?WSDL");
            $parans = array('cnpj' => $cnpj, 'nome' => $nome, 'endereco' => $endereco, 'email' => $email,'telefone' => $telefone);
            $result = (boolean)$client->salvarFornecedor($parans);
            if($result){
                echo "<div class='alert'>";
                echo "<h3 class='mensagem'>Fornecedor Cadastrado Com Sucesso</h3>";
                echo "</div>";
            }
            
        ?>
        <br>
        <br>
    </body>
</html>