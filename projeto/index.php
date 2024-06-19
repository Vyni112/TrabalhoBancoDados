<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Game</title>
  <style>
        body {
            background-color: #f0f0f0;
            padding-top: 20px;
        }

        .quiz-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .quiz-title {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .quiz-question {
            margin-bottom: 20px;
        }

        .quiz-options button {
            width: 100%;
            margin-bottom: 10px;
        }

        .quiz-score {
            text-align: center;
            margin-top: 20px;
        }

        .quiz-modal {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="quiz-container">
            <div id="quiz">
                <a href="inicial.html" class="btn btn-primary mb-3">Sair</a>
                <h1 class="quiz-title">Quiz Game</h1>
                <div id="question"></div>
                <div id="options"></div>
                <div id="score" class="mb-3">Score: <span id="scoreValue">0</span></div>

                <div id="errorModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Erro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Você atingiu o número máximo de erros.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="redirectButton" class="btn btn-primary"
                                    onclick="window.location.href='login.html';">Voltar para tela de
                                    login</button>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="scoreForm" action="salvar_score.php" method="POST">
                    <input type="hidden" id="usernameInput" name="username"
                        value="<?php echo htmlspecialchars($username); ?>">
                    <input type="hidden" id="scoreInput" name="score">
                </form>
            </div>
        </div>
    </div>

  <?php
$questions = [
    [
        'question' => "O que significa 'HTML'?",
        'options' => [
            ['id' => 'option1', 'text' => 'Linguagem de Marcação de Hipertexto'],
            ['id' => 'option2', 'text' => 'Links e Linguagem de Marcação de Texto'],
            ['id' => 'option3', 'text' => 'Linguagem de Ferramenta Doméstica'],
            ['id' => 'option4', 'text' => 'Hiper Ferramenta de Multi Linguagem']
        ],
        'answer' => 'option1'
    ],
    [
      'question' => "Qual é a função principal do CSS?",
        'options' => [
            ['id' => 'option5', 'text' => "Definir a estrutura de uma página da web"],
            ['id' => 'option6', 'text' => "Criar elementos dinâmicos e interativos"],
            ['id' => 'option7', 'text' => "Estilizar a aparência de uma página da web"],
            ['id' => 'option8', 'text' => "Gerenciar operações do lado do servidor"]
        ],
        'answer' => "option7"
    ],
    [
      'question' => "O que significa 'HTTP'?",
      'options' => [
          ['id' => 'option9', 'text' => "Protocolo de Transferência de Hipertexto"],
          ['id' => 'option10', 'text' => "Hipertexto Protocolo de Texto de Link"],
          ['id' => 'option11', 'text' => "Protocolo de Transferência de Ferramenta Doméstica"],
          ['id' => 'option12', 'text' => "Hiper Ferramenta de Multi Protocolo"]
      ],
      'answer' => "option9"
  ],
  [
    'question' => "Qual é o propósito do JavaScript?",
    'options' => [
        ['id' => 'option13', 'text' => "Definir a estrutura de uma página da web"],
        ['id' => 'option14', 'text' => "Criar elementos dinâmicos e interativos"],
        ['id' => 'option15', 'text' => "Estilizar a aparência de uma página da web"],
        ['id' => 'option16', 'text' => "Gerenciar operações do lado do servidor"]
    ],
    'answer' => "option14"
],
[
    'question' => "Qual é a diferença entre os operadores '==' e '===' em JavaScript?",
    'options' => [
        ['id' => 'option17', 'text' => "'==' compara tanto valor quanto tipo, '===' compara apenas valor"],
        ['id' => 'option18', 'text' => "'==' compara apenas valor, '===' compara tanto valor quanto tipo"],
        ['id' => 'option19', 'text' => "'==' é usado para atribuição, '===' é usado para comparação"],
        ['id' => 'option20', 'text' => "Não há diferença entre eles"]
    ],
    'answer' => "option18"
],
[
    'question' => "Qual é o propósito do SQL?",
    'options' => [
        ['id' => 'option21', 'text' => "Definir a estrutura de uma página da web"],
        ['id' => 'option22', 'text' => "Criar elementos dinâmicos e interativos"],
        ['id' => 'option23', 'text' => "Gerenciar operações de banco de dados"],
        ['id' => 'option24', 'text' => "Estilizar a aparência de uma página da web"]
    ],
    'answer' => "option23"
],
[
    'question' => "O que significa 'API'?",
    'options' => [
        ['id' => 'option25', 'text' => "Interface de Programação Automatizada"],
        ['id' => 'option26', 'text' => "Interface de Programação Avançada"],
        ['id' => 'option27', 'text' => "Interface de Programação de Aplicativos"],
        ['id' => 'option28', 'text' => "Integração de Protocolo Automatizado"]
    ],
    'answer' => "option27"
],
[
    'question' => "O que significa 'CSS'?",
    'options' => [
        ['id' => 'option29', 'text' => "Cascading Style Sheets"],
        ['id' => 'option30', 'text' => "Código de Segurança de Software"],
        ['id' => 'option31', 'text' => "Computação Simbólica e Simulação"],
        ['id' => 'option32', 'text' => "Central de Serviços de Segurança"]
    ],
    'answer' => "option29"
],
[
    'question' => "Qual é o objetivo do CSS?",
    'options' => [
        ['id' => 'option33', 'text' => "Criar elementos dinâmicos e interativos"],
        ['id' => 'option34', 'text' => "Estilizar a aparência de uma página da web"],
        ['id' => 'option35', 'text' => "Definir a estrutura de uma página da web"],
        ['id' => 'option36', 'text' => "Gerenciar operações do lado do servidor"]
    ],
    'answer' => "option34"
],
[
    'question' => "O que é uma 'tag' em HTML?",
    'options' => [
        ['id' => 'option37', 'text' => "Um elemento de estilo"],
        ['id' => 'option38', 'text' => "Um tipo de arquivo"],
        ['id' => 'option39', 'text' => "Uma unidade de medida"],
        ['id' => 'option40', 'text' => "Um elemento de marcação"]
    ],
    'answer' => "option40"
],
[
    'question' => "Qual é o objetivo do JavaScript?",
    'options' => [
        ['id' => 'option41', 'text' => "Estilizar a aparência de uma página da web"],
        ['id' => 'option42', 'text' => "Criar elementos dinâmicos e interativos"],
        ['id' => 'option43', 'text' => "Definir a estrutura de uma página da web"],
        ['id' => 'option44', 'text' => "Gerenciar operações do lado do servidor"]
    ],
    'answer' => "option42"
],
[
    'question' => "O que significa 'HTTP'?",
    'options' => [
        ['id' => 'option45', 'text' => "Protocolo de Transferência de Hipertexto"],
        ['id' => 'option46', 'text' => "Hiper Termo Textual Padrão"],
        ['id' => 'option47', 'text' => "Host para Transferência de Protocolo"],
        ['id' => 'option48', 'text' => "Hipertexto de Transmissão de Dados"]
    ],
    'answer' => "option45"
],
[
    'question' => "Qual é o propósito do SQL?",
    'options' => [
        ['id' => 'option49', 'text' => "Definir a estrutura de uma página da web"],
        ['id' => 'option50', 'text' => "Criar elementos dinâmicos e interativos"],
        ['id' => 'option51', 'text' => "Gerenciar operações de banco de dados"],
        ['id' => 'option52', 'text' => "Estilizar a aparência de uma página da web"]
    ],
    'answer' => "option51"
],
[
    'question' => "O que significa 'API'?",
    'options' => [
        ['id' => 'option53', 'text' => "Interface de Programação Automática"],
        ['id' => 'option54', 'text' => "Interface de Programação Avançada"],
        ['id' => 'option55', 'text' => "Interface de Programação de Aplicações"],
        ['id' => 'option56', 'text' => "Integração de Protocolo de Aplicações"]
    ],
    'answer' => "option55"
],
[
    'question' => "O que significa 'CSS'?",
    'options' => [
        ['id' => 'option57', 'text' => "Cascading Style Sheets"],
        ['id' => 'option58', 'text' => "Código de Segurança de Software"],
        ['id' => 'option59', 'text' => "Computação Simbólica e Simulação"],
        ['id' => 'option60', 'text' => "Central de Serviços de Segurança"]
    ],
    'answer' => "option57"
]
];

$currentQuestion = isset($_POST['currentQuestion']) ? $_POST['currentQuestion'] : 0;
$score = isset($_POST['score']) ? $_POST['score'] : 0;
$errorCount = isset($_POST['errorCount']) ? $_POST['errorCount'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedOptionId'])) {
    $selectedOptionId = $_POST['selectedOptionId'];
    $isCorrect = $selectedOptionId === $questions[$currentQuestion]['answer'];

    if ($isCorrect) {
        $score++;
    } else {
        $errorCount++;
    }

    $currentQuestion++;

    if ($errorCount >= 3) {
        echo "<script>window.location.href = 'login.html';</script>";
        exit;
    }

    if ($currentQuestion >= count($questions)) {
        echo "<form id='scoreForm' action='process_score.php' method='POST'>";
        echo "<input type='hidden' id='scoreInput' name='score' value='$score'>";
        echo "</form>";
        echo "<script>document.getElementById('scoreForm').submit();</script>";
        exit;
    }
}

$currentQuestionObj = $questions[$currentQuestion];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
  
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #ccc;
        width: 80%;
        max-width: 500px; 
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
    }

   
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
    }
    </style>

</head>
<body>
    <div id="question" class="container mt-4">
        <h2><?php echo $currentQuestionObj['question']; ?></h2>
    </div>
    <div id="options" class="container mt-2">
        <form method="post">
            <?php foreach ($currentQuestionObj['options'] as $option): ?>
                <button type="submit" class="btn btn-primary btn-block mb-2" name="selectedOptionId" value="<?php echo $option['id']; ?>"><?php echo $option['text']; ?></button>
            <?php endforeach; ?>
            <input type="hidden" name="currentQuestion" value="<?php echo $currentQuestion; ?>">
            <input type="hidden" name="score" value="<?php echo $score; ?>">
            <input type="hidden" name="errorCount" value="<?php echo $errorCount; ?>">
        </form>
    </div>

    <div id="score" class="container mt-4">
        <h3>Score: <?php echo $score; ?></h3>
    </div>

    <div id="errorModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Erro</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Você excedeu o número máximo de erros permitidos.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="redirectButton">Ir para a página de login</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        
        const errorModal = document.getElementById('errorModal');

     
        <?php if ($errorCount >= 3): ?>
            $(document).ready(function(){
                $('#errorModal').modal('show');
            });
        <?php endif; ?>

        document.getElementById('redirectButton').onclick = function () {
            window.location.href = 'login.html';
        };
    </script>
</body>
</html>


