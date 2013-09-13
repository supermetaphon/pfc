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
		$tpl = new Template("estrutura_inserir_atividade.html"); 

		require 'Atividade.php';
		
		// Tentando acessar variável que não existe 
		try { 

		if (isset($_POST["BtInserir"])){
			//para alterar registo
			$result = new Atividade(0);
			$result->setPergunta($_POST["Pergunta"]);
			$result->setLinkAudio($_POST["LinkAudio"]);
			$result->setLinkImagemPergunta($_POST["LinkImagemPergunta"]);
			$result->setLinkAudioImagemPergunta($_POST["LinkAudioImagemPergunta"]);
			$result->setIdNivel($_POST["IdNivel"]);
			$result->setIdTipoAtividade($_POST["IdTipoAtividade"]);
			$result->insertById();
			$tpl->PERGUNTA = $result->getPergunta(); 
			$tpl->LINKAUDIO = $result->getLinkAudio();
			$tpl->LINKIMAGEMPERGUNTA = $result->getLinkImagemPergunta();
			$tpl->LINKAUDIOIMAGEMPERGUNTA = $result->getLinkAudioImagemPergunta();
			$tpl->IDNIVEL = $result->getIdNivel();
			$tpl->IDTIPOATIVIDADE = $result->getIdTipoAtividade();
			$tpl->INFO = $result->getInfo();
			$tpl->block("BLOCK_DADOS"); 
			
			$quantidade = count($result);
			if($quantidade > 0){ 
						$tpl->block("BLOCK_REGISTOS"); 
			}			
			// Caso não exista nenhum registo, exibimos a mensagem de vazio 
			else { 
				$tpl->block("BLOCK_VAZIO"); 
			}
		}
		else 
		{
			//para o editar registo!! 
			$result = new Atividade(0);
			$result->loadById(0);
			$tpl->PERGUNTA = $result->getPergunta(); 
			$tpl->LINKAUDIO = $result->getLinkAudio();
			$tpl->LINKIMAGEMPERGUNTA = $result->getLinkImagemPergunta();
			$tpl->LINKAUDIOIMAGEMPERGUNTA = $result->getLinkAudioImagemPergunta();
			$tpl->IDNIVEL = $result->getIdNivel();
			$tpl->IDTIPOATIVIDADE = $result->getIdTipoAtividade();
			$tpl->block("BLOCK_DADOS"); 
			
			$quantidade = count($result);
			
			if($quantidade > 0){ 
						$tpl->block("BLOCK_REGISTOS"); 
			}  
			 
			// Caso não exista nenhum registo, exibimos a mensagem de vazio 
			else { 
				$tpl->block("BLOCK_VAZIO"); 
			}
		}
	 } catch (Exception $e){ 
					 
			echo "há variaveis k não existem! <br /><br />". $e; 
		} 	
		
		$tpl->show();
		
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