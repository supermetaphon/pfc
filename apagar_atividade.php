<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SuperMetaphon - Atividades</title>
<meta name="keywords" content="supermetaphon, serious game, terapia da fala" />
<meta name="description" content="Sobre SuperMetaphon" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div id="templatemo_wrapper"> 

	<?php include 'header.php'; ?>
    
    <div id="templatemo_content_wrapper">
    	<div id="templatemo_content_top"></div>
        <div id="templatemo_content">

		<?php

		require("Template.class.php");
		$tpl = new Template("estrutura_apagar_atividade.html"); 

		require 'Atividade.php';
		
		// Tentando acessar variável que não existe 
		try { 
				//para apagar registo
				$result = new Atividade($_GET['id']); 
				$result->deleteById($_GET['id']);
				$info = $result->getInfo();			
				$tpl->INFO = $info;
				$tpl->block("BLOCK_DADOS"); 
			
				$quantidade = count($result);
				if($quantidade > 0){ 
					$tpl->block("BLOCK_REGISTOS"); 
				}			
				// Caso não exista nenhum registo, exibimos a mensagem de vazio 
				else { 
					$tpl->block("BLOCK_VAZIO"); 
				}		
				$tpl->show(); 

				 // Pega o conteúdo final do template 
				$conteudo = $tpl->parse(); 
				// Salva em um arquivo 
				file_put_contents("atividade.txt", $conteudo); 
	 } catch (Exception $e){ 
					 
			echo "há variaveis k não existem! <br /><br />". $e; 
		} 	
		?>
		</div>
        <div id="templatemo_content_bottom"></div>
	</div>
    
    <?php include 'footer.php' ?>
    
</div> <!-- end of templatemo_wrapper -->    


<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>