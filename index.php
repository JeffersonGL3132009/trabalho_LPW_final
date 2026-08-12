<?php
session_start();

// Página interna: exige login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'classes/itens.php';
require_once 'classes/catalogo.php';
require_once 'classes/info.php';

$itensObj = new itens();
$catalogo    = $itensObj->listar() ?: [];

$catalogoObj = new catalogo(0, 0, $_SESSION['usuario_id']);
$minhaColecao   = $catalogoObj->listar() ?: [];

$infoObj = new info();
$fichas  = $infoObj->listar() ?: [];

function stampCode($tipo) {
    return $tipo === 'videogame' ? 'VG' : 'JG';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel · GameRate</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="topbar">
  <div class="brand">
    <span class="mark">Game<span>Rate</span></span>
    <span class="tag">Análise &amp; avaliação de jogos</span>
  </div>
  <div class="nav-actions">
    <span class="nav-user">Logado como <strong><?= htmlspecialchars($_SESSION['usuario_nome'], ENT_QUOTES, 'UTF-8') ?></strong></span>
    <a href="logout.php" class="btn btn-ghost">Sair</a>
  </div>
</header>

<main class="page">

  <section class="hero">
    <div>
      <span class="eyebrow">Painel do crítico</span>
      <h1>Sua estante de jogos</h1>
      <p>Acompanhe o catálogo geral, sua coleção pessoal e as fichas técnicas já registradas na plataforma.</p>
    </div>
    <div class="stat-row">
      <div class="stat">
        <span class="n"><?= count($catalogo) ?></span>
        <span class="l">Itens no catálogo</span>
      </div>
      <div class="stat">
        <span class="n"><?= count($minhaColecao) ?></span>
        <span class="l">Na sua coleção</span>
      </div>
      <div class="stat">
        <span class="n"><?= count($fichas) ?></span>
        <span class="l">Fichas técnicas</span>
      </div>
    </div>
  </section>

  <section style="margin-bottom: 46px;">
    <h2 style="font-size:1.2rem; margin-bottom:18px;">Minha coleção</h2>

    <?php if (empty($minhaColecao)): ?>
      <div class="empty">
        <span class="eyebrow">Coleção vazia</span>
        <p>Você ainda não adicionou nenhum jogo à sua coleção. Assim que o cadastro estiver disponível, os itens avaliados por você aparecerão aqui.</p>
      </div>
    <?php else: ?>
      <div class="grid">
        <?php foreach ($minhaColecao as $item): ?>
          <article class="card">
            <div class="stamp"><?= stampCode($item['tipo']) ?></div>
            <span class="kind <?= htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8') ?>
            </span>
            <h3><?= htmlspecialchars($item['nomei'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="desc">Na sua coleção pessoal</p>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>

  <section>
    <h2 style="font-size:1.2rem; margin-bottom:18px;">Catálogo geral</h2>

    <?php if (empty($catalogo)): ?>
      <div class="empty">
        <span class="eyebrow">Nada por aqui ainda</span>
        <p>Nenhum jogo ou videogame foi cadastrado no sistema até o momento.</p>
      </div>
    <?php else: ?>
      <div class="grid">
        <?php foreach ($catalogo as $item): ?>
          <article class="card">
            <div class="stamp"><?= stampCode($item['tipo']) ?></div>
            <span class="kind <?= htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars($item['tipo'], ENT_QUOTES, 'UTF-8') ?>
            </span>
            <h3><?= htmlspecialchars($item['nomei'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="desc">&nbsp;</p>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<footer class="site">GameRate — projeto acadêmico de LPW II</footer>

</body>
</html>
