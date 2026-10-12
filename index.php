<?php
$nickname = "";
$nome_completo = "";
$email = "";
$telefone = "";
$usuario_discord = "";
$cidade = "";
$plataforma = "";
$jogo = "";
$mensagem = "";

require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nickname = $_POST["nickname"];
    $nome_completo = $_POST["nome_completo"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $usuario_discord = $_POST["usuario_discord"];
    $cidade = $_POST["cidade"];
    $plataforma = $_POST["plataforma"];
    $jogo = $_POST["jogo"];

    if($nickname === "" || $nome_completo === "" || $email === "" || 
    $telefone === "" || $usuario_discord === "" || $cidade === "" ||
    $plataforma === "" || $jogo === ""){
        $mensagem = "Preencha todos os campos.";

    } else{
        $verificar = $conexao->query("SELECT * FROM jogadores WHERE email = '$email'");

    if($verificar->num_rows > 0){
        $mensagem = "Este e-mail já está cadastrado.";
    } else {
    
        $sql = "INSERT INTO jogadores
        (nickname, nome_completo, email, telefone, usuario_discord, cidade, plataforma, jogo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->bind_param("ssssssss",
            $nickname,
            $nome_completo,
            $email,
            $telefone,
            $usuario_discord,
            $cidade,
            $plataforma,
            $jogo
        );

        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";

            $nickname = "";
            $nome_completo = "";
            $email = "";
            $telefone = "";
            $usuario_discord = "";
            $cidade = "";
            $plataforma = "";
            $jogo = "";
        } else {
            $mensagem = "Erro ao cadastrar jogador.";
        }

        $stmt->close();
        
    }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copa Arena | Cadastro de Jogadores</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: #f4f6ff;
            background:
                linear-gradient( #12082edd, #240876e0),
                url("imagem/fundo.jpg") center / cover fixed;
        }

        .cabecalho {
            min-height: 100px;
            padding: 14px 7%;
            display: flex;
            align-items: center;
            gap: 30px;
            background: #040f2ccc;
            border-bottom: 1px solid #ffffff1c;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            text-decoration: none;
        }

        .logo-simbolo {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: #4639f6;
            font-size: 25px;
            font-weight: bold;
            font-family: Brush Script MT, Brush Script Std, cursive;
        }

        .logo-texto {
            display: flex;
            flex-direction: column;
            gap: 10px;
            
        }

        .logo-texto strong {
            font-size: 30px;
            letter-spacing: 1px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .logo-texto small {
            color: #aeb9d4;
            font-size: 9px;
            letter-spacing: 1px;
        }

        .cabecalho nav {
            display: flex;
            gap: 28px;
        }

        .cabecalho nav a {
            color: #c5cce0;
            text-decoration: none;
            font-size: 14px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .cabecalho nav .link-ativo {
            color: #7270ff;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }
        
        .cabecalho nav {
            display: flex;
            gap: 28px;
            margin-left: auto;
        }

        .cabecalho nav a {
            color: #c5cce0;
            text-decoration: none;
            font-size: 14px;
            font-family: Verdana, Arial, sans-serif;
        }

        .pagina {
            padding: 45px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .painel {
            width: 100%;
            max-width: 1260px;
            display: grid;
            grid-template-columns: 1.05fr 1.55fr;
            overflow: hidden;
            border: 1px solid #948cde59;
            border-radius: 10px;
            background: #150a2c1e;
            backdrop-filter: blur(6px);
            box-shadow: 0 18px 50px #00000035;
        }

        .apresentacao {
            padding: 55px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(145deg, #1b2f64a8, #331663a3);
            border-right: 1px solid #ffffff25;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .marca-grande {
            width: 90px;
            height: 90px;
            display: grid;
            place-items: center;
            margin-bottom: 30px;
            border: 2px solid #ffffff9a;
            border-radius: 22px 6px 22px 6px;
            color: #bfb5f1;
            font-size: 35px;
            font-weight: 550;
            letter-spacing: 3px;
            background: #86080812;
            font-family: Brush Script MT, Brush Script Std, cursive;
            color: #fff; 
  
            text-shadow: 
                0 0 5px #fff,
                0 0 10px #b3acf7,
                0 0 20px #3700ff,
                0 0 40px #6200ff,
                0 0 80px #6f00ff,
                0 0 90px #1900ff,
                0 0 100px #4c00ff,
                0 0 140px #6200ff;
        }

        .apresentacao h1 {
            margin: 0 0 14px;
            letter-spacing: 1px;
            color: #ffffff; 
            font-size: 4rem;
            font-family: sans-serif;
            text-transform: uppercase;
            

            text-shadow: 
                0 0 5px #fff,
                0 0 10px #d2c4f3,
                0 0 20px #4c00ff,
                0 0 40px #6200ff,
                0 0 80px #6f00ff,
                0 0 90px #4f12f8,
                0 0 100px #6b1beb,
                0 0 140px #7a1ef3;
        }

        .frase {
            margin: 0 0 15px;
            color: #8c8ef1;
            font-size: 19px;
            line-height: 1.5;
        }

        .descricao {
            max-width: 340px;
            color: #d6d7f5;
            font-size: 14px;
            line-height: 1.8;
        }

        .legenda {
            margin-top: 28px;
            color: #b1c8ecbe;
            font-size: 10px;
            letter-spacing: 2px;
        }

        .area-formulario {
            padding: 40px;
            background: #0404254f;
            
        }

        .area-formulario h2 {
            margin: 0 0 8px;
            font-size: 27px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .subtitulo {
            margin: 0 0 26px;
            color: #aab6cf;
            font-size: 14px;
        }

        .campos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 16px;
        }

        .campo {
            min-width: 0;
        }

        .campo label {
            display: block;
            margin-bottom: 8px;
            color: #f5f4fc;
            font-size: 13px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .campo input,
        .campo select {
            width: 100%;
            min-height: 44px;
            padding: 11px 12px;
            color: #ffffff;
            background: #0b1120b8;
            border: 1px solid #8d9fbe55;
            border-radius: 7px;
            outline: none;
            font: inherit;
            font-size: 13px;
        }

        .campo input::placeholder {
            color: #8592ad;
        }

        .campo input:focus,
        .campo select:focus {
            border-color: #78a7ff;
            box-shadow: 0 0 0 2px #3978f630;
        }

        .mensagem {
            padding: 12px;
            margin: 0 0 20px;
            border: 1px solid #8aaeff70;
            border-radius: 7px;
            background: #3978f620;
            color: #dce7ff;
            font-size: 13px;
            line-height: 1.5;
        }

        button {
        width: 100%;
        margin-top: 26px;
        padding: 14px;
        border: 2px solid #5444ac;
        border-radius: 7px;
        background: #5539f6;
        color: #ffffff;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-shadow: 0 0 8px #ffffff;
        box-shadow:
        0 0 10px #5539f6,
        0 0 20px #5444ac,
        inset 0 0 5px #ffffff;
        }
        button:hover {
        background: #5553c0e3;
        border-color: #5452bde5;
        box-shadow:
        0 0 15px #3e24cedc,
        0 0 35px #3f26cce1,
        0 0 50px #43378ae0;
        }

        .link-consulta {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #8e84e4;
            font-size: 13px;
            text-decoration: none;
        }

        .link-consulta:hover {
            color: #ffffff;
        }

        @media (max-width: 800px) {
            .painel {
                max-width: 600px;
                grid-template-columns: 1fr;
            }

            .apresentacao {
                padding: 35px;
            }

            .marca-grande {
                width: 65px;
                height: 65px;
                margin-bottom: 20px;
                font-size: 25px;
            }

            .area-formulario {
                padding: 30px;
            }
        }

        @media (max-width: 520px) {
            .cabecalho {
                padding: 14px 5%;
                flex-wrap: wrap;
            }

            .cabecalho nav {
                gap: 18px;
            }

            .pagina {
                padding: 25px 14px;
            }

            .apresentacao,
            .area-formulario {
                padding: 25px 20px;
            }

            .campos {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <header class="cabecalho">
        <a href="index.php" class="logo">
            <span class="logo-simbolo">CA</span>
            <span class="logo-texto">
                <strong>COPA ARENA</strong>
                <small>COMPETIÇÃO • COMUNIDADE • GAMES</small>
            </span>
        </a>

        <nav>
            <a href="index.php" class="link-ativo">Início</a>
            <a href="consulta.php">Jogadores</a>
        </nav>
    </header>

    <main class="pagina">
        <section class="painel">
            <div class="apresentacao">
                <div class="marca-grande">CA</div>

                <h1>COPA ARENA</h1>

                <p class="frase">
                    Sua próxima partida começa aqui.
                </p>

                <p class="descricao">
                    Faça seu cadastro, conecte-se com outros jogadores
                    e prepare-se para entrar na competição.
                </p>

                <p class="legenda">JOGUE. CONECTE-SE. COMPITA.</p>
            </div>

            <div class="area-formulario">

                <h2>Faça sua inscrição</h2>
                <p class="subtitulo">
                    Preencha seus dados para participar.
                </p>

                <form method="POST">

                    <?php if ($mensagem !== "") { ?>
                        <p class="mensagem">
                            <?php echo htmlspecialchars($mensagem); ?>
                        </p>
                    <?php } ?>

                    <div class="campos">
                        <div class="campo">
                            <label>Nickname</label>
                            <input type="text" name="nickname" placeholder = "Digite seu nickname"
                                value="<?php echo htmlspecialchars($nickname); ?>">
                        </div>

                        <div class="campo">
                            <label>Nome completo</label>
                            <input type="text" name="nome_completo" placeholder = "Digite seu nome completo"
                                value="<?php echo htmlspecialchars($nome_completo); ?>">
                        </div>

                        <div class="campo">
                            <label>E-mail</label>
                            <input type="email" name="email"
                                placeholder="seu@email.com"
                                value="<?php echo htmlspecialchars($email); ?>">
                        </div>

                        <div class="campo">
                            <label>Telefone / WhatsApp</label>
                            <input type="text" name="telefone"
                                placeholder="Ex: +55 (11) 99999-9999"
                                value="<?php echo htmlspecialchars($telefone); ?>">
                        </div>

                        <div class="campo">
                            <label>Usuário do Discord</label>
                            <input type="text" name="usuario_discord" placeholder = "exemplo_usuario"
                                value="<?php echo htmlspecialchars($usuario_discord); ?>">
                        </div>

                        <div class="campo">
                            <label>Cidade</label>
                            <input type="text" name="cidade" placeholder = "Ex: São Paulo"
                                value="<?php echo htmlspecialchars($cidade); ?>">
                        </div>

                        <div class="campo">
                            <label>Plataforma</label>
                            <select name="plataforma">
                                <option value="">Selecione uma plataforma</option>
                                <option value="PC" <?php if ($plataforma === "PC") echo "selected"; ?>>PC</option>
                                <option value="Console" <?php if ($plataforma === "Console") echo "selected"; ?>>Console</option>
                                <option value="Celular" <?php if ($plataforma === "Celular") echo "selected"; ?>>Celular</option>
                            </select>
                        </div>

                        <div class="campo">
                            <label>Jogo</label>
                            <input type="text" name="jogo"
                                placeholder="Ex.: Valorant, League of Legends ou EA FC"
                                value="<?php echo htmlspecialchars($jogo); ?>">
                        </div>
                    </div>

                    <button type="submit">Cadastrar jogador</button>

                    <a href="consulta.php" class="link-consulta">
                        Ver jogadores cadastrados
                    </a>

                </form>
            </div>
        </section>
    </main>
</body>
</html>