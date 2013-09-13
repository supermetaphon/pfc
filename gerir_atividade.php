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
				$tpl = new Template("estrutura_atividade.html"); 

				require 'Atividade.php';
			
			// Tentando acessar variável que não existe 
			try { 
				$result = new Atividade(0); 
				$result->load($tpl); 	
			
				$quantidade = count($result);
				if($quantidade > 0){ 
					$tpl->block("BLOCK_REGISTOS"); 
				}			
				// Caso não exista nenhum registo, exibimos a mensagem de vazio 
				else { 
					$tpl->block("BLOCK_VAZIO"); 
				}	
			
				$tpl->show(); 
			} catch (Exception $e){ 
								 
						echo "há variaveis k não existem! <br /><br />". $e; 
					} 	
				 // Pega o conteúdo final do template 
				$conteudo = $tpl->parse(); 
				// Salva em um arquivo 
				file_put_contents("atividade.txt", $conteudo); 
								
			?>
	
 <!--          <div class="cleaner_h40"></div>
        
           
<!--
		   <div class="col_w340 float_l">
                <h3>Our Team</h3>
                <p>Suspendisse sed odio ut mi auctor blandit. Duis luctus nulla metus, a vulputate mauris. Ut sed accumsan nisl. Donec malesuada augue ac nisl sagittis quis cursus dolor scelerisque.</p>
  <ul class="tmo_list">
                    <li>Est cursus suscipit eu ac lectus.</li>
                    <li>Nibh nisi, sed eleifend dolor. </li>
                    <li>Sollicitudin sapien nec aliquet. </li>
                    <li>Cras rutrum  consectetur dolor </li>
                </ul>
                <div class="button"><a href="#"><span>+</span> More</a></div>
            </div>
        
            <div class="col_w340 float_r">
                <h3>Testimonial</h3>
                <blockquote>
                <p>Nunc aliquam, dolor vitae sollicitudin lacinia, nibh orci sagittis diam, dignissim sodales dui erat nec eros. Fusce quis enim. Aenean eleifend, neque hendrerit elementum sodales, odio erat sagittis quam, sed tempor orci magna.</p>
                <p>Proin dui mauris, tempor eget, pulvinar sed, pretium sit amet, dui. Proin vulputate justo et quam. Cras nisl eros, elementum eu, iaculis vitae, viverra ut, ligula. Pellentesque metus.</p>
                <cite>John - <span>Web Designer</span></cite>
                </blockquote>
            </div>
            
            <div class="cleaner"></div>
-->
			</div>
        <div id="templatemo_content_bottom"></div>
	</div>
    
    <?php include 'footer.php' ?>
    
</div> <!-- end of templatemo_wrapper -->    


<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>