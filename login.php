<?php
session_start();

// Se já estiver logado, não faz sentido ver o login de novo
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'classes/usuario.php';

$erro = '';
$emailPreenchido = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $emailPreenchido = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    if ($email === '' || $senha === '') {
        $erro = 'Preencha e-mail e senha para continuar.';
    } else {
        $usuarioObj = new usuario();
        $dados = $usuarioObj->buscarPorEmail($email);

        $senhaValida = false;
        if ($dados) {
            $senhaBanco = $dados['senhau'];

            // Aceita senhas com hash (password_hash) e, apenas para os dados
            // de teste que ainda estão em texto puro, comparação direta.
            if (password_verify($senha, $senhaBanco) || $senha === $senhaBanco) {
                $senhaValida = true;
            }
        }

        if ($senhaValida) {
            session_regenerate_id(true);
            $_SESSION['usuario_id']    = $dados['idu'];
            $_SESSION['usuario_nome']  = $dados['nomeu'];
            $_SESSION['usuario_email'] = $dados['emailu'];

            header('Location: index.php');
            exit;
        }

        $erro = 'E-mail ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar · GameRate</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-wrap">
  <form class="ticket" method="post" action="login.php" novalidate>

    <div class="stamp">NOTA<br>10</div>

    <h1>GameRate</h1>
    <p class="sub">Entre para avaliar e acompanhar seus jogos</p>

    <?php if ($erro): ?>
      <div class="alert">
        <span>⚠</span>
        <span><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></span>
      </div>
    <?php endif; ?>

    <div class="field">
      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" placeholder="voce@email.com"
             value="<?= $emailPreenchido ?>" required autofocus>
    </div>

    <div class="field">
      <label for="senha">Senha</label>
      <input type="password" id="senha" name="senha" placeholder="••••••••" required>
    </div>

    <button type="submit" class="btn btn-gold auth-submit">Entrar</button>

    <div class="hint">
      Acesso de teste — <b>teste@gamerate.com</b> / senha <b>123456</b>
    </div>
  </form>
</div>

</body>
</html>
