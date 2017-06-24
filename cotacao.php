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
        <title>Cotacao Do Pedido</title>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <ul class="nav nav-pills">
                <li role="presentation"><a href="index.php">Pedidos</a></li>
                <li role="presentation" ><a href="cadastroProdutos.php">Produtos</a></li>
                <li role="presentation"><a href="cadastroFornecedores.php">Fornecedor</a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h1>
                <th class="align-center">Cotação</th>
            </h1>
        </div>
        <?php
        $clientSoap = new SoapClient("http://localhost:18865/cotacao2017v2/Ws?wsdl");
        $parans = array('');

        $return_fornecedores = $clientSoap->listarTodosFornecedores();
        $return_pedidos = $clientSoap->listarTodosPedidos();
        $return_produtos = $clientSoap->listarTodosProdutos();
        
        
        $fornecedores_result = $return_fornecedores->return;
        $pedidos_result = $return_pedidos->return;
        $produtos_result = $return_produtos->return;

        $jsonFornecedor = json_decode($fornecedores_result);
        $jsonPedido = json_decode($pedidos_result);
        $jsonProduto = json_decode($produtos_result);
        
        $fornecedores = $jsonFornecedor->fornecedores;
        $produtos = $jsonProduto->produtos;
        $pedidos = $jsonPedido->pedidos;
        date_default_timezone_set('America/Sao_Paulo');
        $dataPedido = date('d-m-Y');
        $numeroCotacao = 0;
        $numeroPedido="123123";
        $telefone="0000-0000";
        $vencimento=date('d-m-Y', strtotime("+4 days",strtotime($dataPedido)));
        $fornecedor="fulano";
        $email="teste@gmail.com";
        $valorTotal=0;
        $codigoProdutos = array_key_exists('tipo1', $_POST) ? $_POST['tipo1'] : '';
        $formaPagamento1 = array_key_exists('formapagamento1', $_POST) ? $_POST['formapagamento1'] : '';
        $formaPagamento2 = array_key_exists('formapagamento2', $_POST) ? $_POST['formapagamento2'] : '';
        $cpf = array_key_exists('cpf', $_POST) ? $_POST['cpf'] : '';
        $cnpj="";
        foreach ($codigoProdutos as $codigo) {
            foreach ($pedidos as $ped){
                if(strcmp($codigo, $ped->codigo_produto)){
                    $numeroCotacao+=$ped->codigo_pedido;
                }
            }
            foreach ($produtos as $prod){
                if(strcasecmp($codigo, $prod->codigo_produto)==0){
                    $valorTotal= $valorTotal + floatval($prod->preco);
                    $cnpj = $prod->cnpj;
                }
            }
        }
        
        foreach ($fornecedores as $forn){
            if(strcmp($cnpj, $forn->cnpj)){
                $fornecedor = $forn->nome;
                $telefone = $forn->telefone;
                $email = $forn->email;
            }
        }
        ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Fornecedor   
                        </th>
                        <th>
                            Telefone
                        </th>
                        <th>
                            Email
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <?php
                            echo $fornecedor;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $telefone;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $email;
                            ?>
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>
                            Numero Da Cotacao
                        </th>
                        <th>
                            Forma De Pagamento 1
                        </th>
                        <th>
                            Forma De Pagamento 2
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            echo $numeroCotacao;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $formaPagamento1;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $formaPagamento2;
                            ?>
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>
                            vencimento
                        </th>
                        <th>
                            Código Do Pedido
                        </th>
                        <th>
                            Data Do Pedido
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            echo $vencimento;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $numeroPedido;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $dataPedido;
                            ?>
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>
                            Valor Total Da Compra
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            echo $valorTotal;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form class="confirmacao" method="post" action="index.php"> 
            <button type="submit" class="btn btn-default campo">Cofirmar Cotacao</button>
            <button type="submit" class="btn btn-default campo">Cancelar Cotacao</button>
        </form>
    </body>
</html>