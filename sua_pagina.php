<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página da Silva</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-color: #333333;
            color: #ffffff;
        }
        .pai {
            display: flex;
            width: 100%;
            justify-content: space-evenly;
            align-items: center;
            border: 1px solid black;
            padding: 10px;
            font-family: 'Courier New', monospace;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 840px;
        }
        .sidebar {
            width: 200px;
            background-color: #333333;
            padding: 10px;
            margin-left: 20px;
            font-family: 'Courier New', monospace;
            list-style-type: none;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .content {
            flex: 1;
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
            height: 350px;
        }
        .imagem img {
            height: 100%;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container button[name="add"] {
            margin-top: 10px;
            display: block;
            width: 100%;
        }
        .music-player {
            width: 150px;
            margin-left: 15px;
        }
        .music-player h2 {
            text-align: center;
            margin-left: 70px;
        }
       
        .notes-textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }
        .save-button {
            margin-top: 20px;
            padding: 10px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #666;
            color: #fff;
            cursor: pointer;
        }
        .save-button:hover {
            background-color: #555;
        }
        .todo-form {
            display: flex;
            flex-direction: column;
        }
        .todo-form input[type="text"] {
            flex: 1;
            padding: 5px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .todo-form button {
            padding: 10px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #666;
            color: #fff;
            cursor: pointer;
        }
        .todo-form button:hover {
            background-color: #555;
        }
        .gif-image{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .gif-image img{
            margin-left: 35px;
            margin-top: 50px;
            height: 100%;
        }
        
        </style>
        <link href="calendar.css" type="text/css" rel="stylesheet" />

    </head>
    <body>
    <?php
        session_start();
    // Se o formulário foi enviado, salvar o conteúdo na sessão
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['notes'] = $_POST['notes'];
    }

    // Recuperar o conteúdo salvo na sessão
    $notes = isset($_SESSION['notes']) ? $_SESSION['notes'] : '';
?>
<div class="pai">
    <!-- Barra lateral -->
    <div class="sidebar">
        <h2>To-do List</h2>
        <ul id="item-list">
            <?php
            if (!isset($_SESSION['items'])) {
                $_SESSION['items'] = ['Item 1', 'Item 2', 'Item 3'];
            }

            if (isset($_POST['remove'])) {
                $index = $_POST['index'];
                unset($_SESSION['items'][$index]);
                $_SESSION['items'] = array_values($_SESSION['items']);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }

            if (isset($_POST['add']) && !empty($_POST['new-item'])) {
                $newItem = $_POST['new-item'];
                $_SESSION['items'][] = $newItem;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
            ?>
            <form method='post' action=''>
                <?php
                foreach ($_SESSION['items'] as $index => $item) {
                    echo "<li><input type='checkbox' id='item-$index' name='item-$index'><label for='item-$index'>$item </label>";
                    echo "<form method='post' style='display:inline'><input type='hidden' name='index' value='$index'><button type='submit' name='remove'>Remover</button></form></li>";
                }
                ?>
            </form>
        </ul>

        <div class="form-container">
            <form method="post" class="todo-form">
                <input type="text" name="new-item" placeholder="Novo item">
                <button type="submit" name="add">Adicionar</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="header">
                <h1>Notes</h1>
                <?php
                    $dataAtual = date('d/m/Y');
                    echo "<p><b>$dataAtual</b></p>";
                ?>
            </div>
            <form method="post">
                <textarea class="notes-textarea" name="notes" placeholder="Digite suas notas aqui..."><?php echo htmlspecialchars($notes); ?></textarea>
                <button type="submit" class="save-button">Salvar</button>
            </form>
        </div>
    </div>
    <div class="imagem">
        <img src="https://love.doghero.com.br/wp-content/uploads/2018/12/golden-retriever-1.png" alt="cachorro">
    </div>
</div>

<div class="music-player">
    <h2>Música</h2>
    <audio controls>
        <source src="musica.mp3" type="audio/mpeg">
        Seu navegador não suporta o elemento de áudio.
    </audio>
</div>
<div class="gif-image">

<img src="https://steamuserimages-a.akamaihd.net/ugc/446238782551007626/C229EF34B6B62AE2087EBDB3159F67E8E6442F06/?imw=5000&imh=5000&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false">
<iframe width="560" height="315" src="https://www.youtube.com/embed/tYzMYcUty6s?si=O0Wwq2WUvYMyYth7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div id="calendar">
    <?php
    include 'calendar.php';
    $calendar = new Calendar();
    echo $calendar->show();
    ?>
</div>
</body>
</html>
