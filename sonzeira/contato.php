<?php
$prefixoAssunto = '[Contato Sonzeira]'; // Para exibição no título da mensagem
$destinatario = '<m_sakalauskas@hotmail.com>'; // Coloque o e-mail de destino da mensagem entre < e >

// Se o formulário for acionado via método POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Pegue e trate os dados preenchidos no formulário
    $nome    = stripslashes(trim($_POST['nome']));
    $email   = stripslashes(trim($_POST['email']));
    $telefone   = stripslashes(trim($_POST['telefone']));
    $assunto = stripslashes(trim($_POST['assunto']));
    $mensagem = stripslashes(trim($_POST['mensagem']));

	// Parâmetros para o formato padrão de e-mail (NÃO ALTERE!)
	$padrao  = '/[\r\n]|Content-Type:|Bcc:|Cc:/i'; 

	// Verificação de segurança contra código malicioso (NÃO ALTERE!)
    if (preg_match($padrao, $nome) || preg_match($padrao, $email) || preg_match($padrao, $assunto)) {
        die("Injeção de código no header detectada!");
    }

	// Validação de endereços de e-mail válidos (NÃO ALTERE!)
    $emailValido = preg_match('/^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $email);

	// Se todos os campos estiverem preenchidos corretamente...
	if($nome && $email && $emailValido && $telefone && $assunto && $mensagem){
		// Monte o assunto e o corpo da mensagem
		$assunto = "$prefixoAssunto $assunto";
		$corpo = "Nome: ".$nome. "<br /> Email: ".$email. "<br /> Telefone: " .$telefone. " Mensagem: ". nl2br($mensagem);
		
		// Monte o cabeçalho da mensagem (NÃO ALTERE!)
		$headers  = 'MIME-Version: 1.1' . PHP_EOL;
		$headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
		$headers .= "From: $nome <$email>" . PHP_EOL;
		$headers .= "Return-Path: $destinatario" . PHP_EOL;
		$headers .= "Reply-To: $email" . PHP_EOL;
		$headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;

		// Envie a mensagem para o destinatario junto com o assunto, corpo e cabeçalho
		mail($destinatario, $assunto, $corpo, $headers);

		// Indique que o envio da mensagem deu certo (emailEnviado valendo true)
		$emailEnviado = true;
	} else {
		// Caso contrário, indique que houve erro (deuErro valendo true)
        $deuErro = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contato - Sonzeira!</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="images/favicon.png" sizes="64x64">
    <link href="css/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/css3-mediaqueries.js"></script>
    <![endif]-->
</head>
<body>
<div id="container">
    <header id="topo" class="clearfix">
        <h1>
            <a href="index.html">
                <img src="images/logo.svg" width="30" height="30" alt="Mão chifrada">Sonzeira!
            </a>
        </h1>
        <!-- nav>ul>(li>a)*5 -->
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="classic-rock.html">Classic Rock</a></li>
                <li><a href="heavy-metal.html">Heavy Metal</a></li>
                <li><a href="rock-progressivo.html">Rock Progressivo</a></li>
                <li><a href="contato.html">Contato</a></li>
            </ul>
        </nav>
    </header>
    
    <main id="conteudo">          
         <article id="geral">
    <article id="geral">
      <h2>Contato</h2>
      <?php // Se emailEnviado existe e for TRUE...
		if(isset($emailEnviado) && $emailEnviado){ ?>
			<p>Sua mensagem foi enviada com sucesso.</p>
   		<?php 
		} else {
			// Senão, se deuErro existe e for TRUE...
        	if(isset($deuErro) && $deuErro){ ?>
            <p>Houve um erro no envio, tente novamente mais tarde.</p>
        <?php 
			} 
		?>   
            <p>Preencha o formulário abaixo para entrar em contato conosco.</p>
            <p>Se preferir, utilize o telefone 11-2135-0300 ou o e-mail email@provedor.com.br.</p>
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <p>
          <label for="nome">Nome:</label>
          <input name="nome" type="text" required id="nome">
        </p>
        <p>
          <label for="email">E-mail:</label>
          <input type="email" name="email" id="email">
        </p>
        <p>
          <label for="telefone">Telefone:</label>
          <input type="tel" name="telefone" id="telefone">
        </p>
        <p>
          <label for="assunto">Assunto:</label>
          <input type="text" name="assunto" id="assunto">
        </p>
        <p>
          <label for="mensagem">Mensagem:</label>
          <textarea name="mensagem" cols="50" rows="6" id="mensagem"></textarea>
        </p>
        <p>
          <input name="enviar" type="submit" id="enviar" value="Enviar dados">
        </p>
      </form>
  <?php } ?>     
      <h2>Visite-nos</h2>
      <div>
      	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3658.17657698827!2d-46.5423479214134!3d-23.526150666251134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5e45de28bb23%3A0x1d2ed3122aae28a7!2sSenac+Penha!5e0!3m2!1spt-BR!2sbr!4v1471377747745" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>      
    </article>
  </main>
  <footer id="rodape">
        <p>Site desenvolvido por <b>Marcello S.A.</b> | &copy; 2016</p>
    </footer>
</div>

</body>
</html>
