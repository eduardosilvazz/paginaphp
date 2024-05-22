<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página da Silva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .pai {
            display: flex;
            width: 100%;
            height: 350px;
            justify-content: space-evenly;
            align-items: center;
            border: 1px solid black;
            padding: 10px;
        }
        .pai img {
            height: 100%;
        }
        .container {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 840px;
            height: 150px; /* Para usar flexbox */
        }
        .sidebar {
            width: 200px; /* Largura da barra lateral */
            background-color: #f0f0f0;
            padding: 10px;
            margin-left: 20px; /* Margem esquerda para deslocar a barra lateral para a direita */
        }
        .content {
            flex: 1; /* O conteúdo principal expande para ocupar o espaço restante */
            padding: 10px;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header p {
            margin: 0;
        }
        .imagem {
            height: 100%;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container button[name="add"] {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="pai">
        <!-- Barra lateral -->
        <div class="sidebar">
            <h2>Minha Lista</h2>
            <ul id="item-list">
                <?php
                // Inicialize a lista de itens (em uma aplicação real, você pode armazenar isso em um banco de dados)
                session_start();
                if (!isset($_SESSION['items'])) {
                    $_SESSION['items'] = ['Item 1', 'Item 2', 'Item 3'];
                }

                // Processar remoção de item
                if (isset($_POST['remove'])) {
                    $index = $_POST['index'];
                    unset($_SESSION['items'][$index]);
                    $_SESSION['items'] = array_values($_SESSION['items']); // Reindexar o array
                }

                // Processar adição de item
                if (isset($_POST['add']) && !empty($_POST['new-item'])) {
                    $newItem = $_POST['new-item'];
                    $_SESSION['items'][] = $newItem;
                }
                
                // Exibir itens

                echo "<form method='post' action='sua_pagina.php'>";
                foreach ($_SESSION['items'] as $index => $item) {
                    echo "<li><input type='checkbox' id='item-$index' name='item-$index'><label for='item-$index'>$item ";
                    echo "<input type='hidden' name='checkedItems[]' value='$index'>";
                    echo "<form method='post' style='display:inline'><input type='hidden' name='index' value='$index'><button type='submit' name='remove'>Remover</button></form></li>";
                }
                echo "</form>";
                ?>
            </ul>

            <!-- Formulário para adicionar novo item -->
            <div class="form-container">
                <form method="post">
                    <input type="text" name="new-item" placeholder="Novo item">
                    <button type="submit" name="add">Adicionar</button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="header">
                    <h1>Day Note</h1>
                    <?php
                        // Obtenha a data atual
                        $dataAtual = date('d/m/Y');
                        
                        // Exiba a data atual ao lado da palavra "Teste"
                        echo "<p><b>$dataAtual</b></p>";
                    ?>
                </div>
                <?php
                    // Defina a mensagem a ser exibida
                    $mensagem = "Teste";
                    
                    // Exiba a mensagem
                    echo "<p>$mensagem</p>";
                ?>
            </div>
        </div>
        <div class="imagem">
            <img src="https://love.doghero.com.br/wp-content/uploads/2018/12/golden-retriever-1.png" alt="cachorro">
        </div>
    </div>
    <!-- Player de Música -->
    <div class="music-player">
        <h2>Música</h2>
        <audio controls>
            <source src="musica.mp3" type="audio/mpeg">
            Seu navegador não suporta o elemento de áudio.
        </audio>
    </div>
</body>
</html>
