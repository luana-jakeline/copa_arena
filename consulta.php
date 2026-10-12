<?php
require_once 'conexao.php';

$r = $conexao->query("SELECT * FROM jogadores");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogadores Cadastrados</title>
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
            font-family: "Brush Script MT", cursive;
        }

        .logo-texto {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .logo-texto strong {
            font-size: 30px;
            letter-spacing: 1px;
            font-family: Verdana, Arial, sans-serif;
        }

        .logo-texto small {
            color: #aeb9d4;
            font-size: 9px;
            letter-spacing: 1px;
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

        .cabecalho nav a:hover,
        .cabecalho nav .link-ativo {
            color: #8e84e4;
        }

        .pagina {
            min-height: calc(100vh - 100px);
            padding: 45px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 35px;
            background: #100d4987;
            border: 1px solid #b9b5e059;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0 18px 50px #00000045;
            overflow-x: auto;
        }

        h1 {
            margin: 0 0 10px;
            color: #ffffff;
            font-size: 30px;
            font-family: Verdana, Arial, sans-serif;
        }

        .subtitulo {
            margin: 0 0 30px;
            color: #c1c4e8;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 16px;
            color: #e7e3ff;
            background: #251c50b8;
            border-bottom: 2px solid #5539f6;
            font-size: 13px;
            font-family: Verdana, Arial, sans-serif;
        }

        td {
            padding: 15px 16px;
            color: #f0efff;
            border-bottom: 1px solid #ffffff20;
            font-size: 14px;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #7660ff20;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .link-voltar {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 20px;
            color: #ffffffe4;
            background: #3d25c7db;
            border: 1px solid #7365c3db;
            border-radius: 7px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            box-shadow: 0 0 10px #b1a5f6a4;
            transition: all 0.3s ease;
        }

        .link-voltar:hover {
            background: #262574;
            box-shadow: 0 0 20px #5539f680;
        }

        @media (max-width: 600px) {
            .cabecalho {
                padding: 14px 5%;
                flex-wrap: wrap;
            }

            .logo-texto strong {
                font-size: 22px;
            }

            .logo-texto small {
                font-size: 8px;
            }

            .cabecalho nav {
                gap: 18px;
            }

            .pagina {
                padding: 25px 14px;
            }

            .container {
                padding: 22px 16px;
            }

            h1 {
                font-size: 24px;
            }

            th,
            td {
                padding: 12px 10px;
                font-size: 12px;
                white-space: nowrap;
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
            <a href="index.php">Início</a>
            <a href="consulta.php" class="link-ativo">Jogadores</a>
        </nav>
    </header>

    <main class="pagina">

        <div class="container">

            <h1>Jogadores cadastrados</h1>

            <p class="subtitulo">
                Confira os jogadores que fazem parte da Copa Arena.
            </p>

            <table>
                <thead>
                    <tr>
                        <th>Nickname</th>
                        <th>Nome completo</th>
                        <th>Jogo</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($linha = $r->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($linha["nickname"]); ?></td>
                            <td><?php echo htmlspecialchars($linha["nome_completo"]); ?></td>
                            <td><?php echo htmlspecialchars($linha["jogo"]); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <a href="index.php" class="link-voltar">
                ← Voltar ao cadastro
            </a>
        </div>
    </main>
</body>
</html>
