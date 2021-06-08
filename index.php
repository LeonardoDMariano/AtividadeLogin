<?php
	session_start();
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<title>Sistema de Login</title>
	<meta name="description" content="sistema de login">
  	<meta name="keywords" content="PHP, aula, login">
  	<meta name="author" content="Leonardo Duarte Mariano">
    <link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<main id="main">

        <p id="titulo">LOGIN</p>

        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <p class="pform" id="email">Email</p>
            <input class="barras" id="email" type="email" name="email">
            <p class="pform">Senha:</p>
            <input class="barras" id="senha" type="password" name="password" pattern="^[a-zA-Z0-9]+$">
            <br>
            <input id="enviar" type="submit" name="enviar" value="Entrar">
        </form>

        <?php
            if (isset($_POST['enviar'])) {

                function checaCaractere($input) {
                    $regex = '/^[a-zA-Z0-9]+$/i';
                    return preg_match($regex, $input);
                }

                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];

                $email = $_SESSION['email'];
                $senha = $_SESSION['password'];

                if (checaCaractere($senha)) {
                    $senha = md5($senha);
                    $loginMd5 = true;
                }

                $elementos = fopen('dados.txt', 'r');

                if ($elementos == false) {
                    die("<h2>Não foi possível acessar</h2>");
                }

                $testes = file('dados.txt');

                foreach ($testes as $espaco) {
                    $espaco = trim($espaco);
                    $valor = explode('|', $espaco);

                    for ($i = 0;$i < count($valor);$i++) {
                        if ("$email$senha" == "$valor[$i]" and $loginMd5 == true) {
                            echo "<h2 id='logado'>Logado com sucesso!</h2>";
                            break;
                        }
                        else if ("$email$senha" != "$valor[$i]" and isset($_POST['enviar'])){
                            echo "<div id='deslogado'></div>";
                            break;
                        }
                    }
                }

                if ($loginMd5 == true) {
                    fclose($elementos);
                }
            }
        ?>

	</main>

	<footer>
        © Leonardo Duarte Mariano. 2021.
	</footer>

	<script type="text/javascript">
		

		var enviar = document.getElementById("enviar");


		var email = document.getElementById("email");
		var inputPasswordLogin = document.getElementById("senha");


		var desLogado = document.getElementById("deslogado");
		var logado = document.getElementById("logado");


		setTimeout(function () {
			logado.style.display = 'none';
		},2000);

	</script>
</body>
</html>