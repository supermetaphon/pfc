<?php 
    class Atividade { 

        protected $idAtividade = 0; 
        protected $pergunta; 
        protected $linkAudio; 
		protected $linkImagemPergunta; 
		protected $linkAudioImagemPergunta;
		protected $idNivel;
		protected $idTipoAtividade;
		protected $info = "";

        public function __construct($idAtividade){ 
           // if(0!=$idAtividade) $this->loadById($idAtividade);
		   return true;
        } 
		
		public function load($tpl) {
		// conneccao bd
		$con = mysql_connect("localhost", "root", "");
		if(!$con)
		{
			die('Could not connect: ' . mysql_error());
		}

			// seleccao da bd
			mysql_select_db("supermetaphon", $con);

			// query de listagem de dados
			$sql = mysql_query("SELECT * FROM atividade") or die(mysql_error());

			$output = array();
		
			// Tentando acessar variável que não existe 
			try { 
			
				while($result = mysql_fetch_assoc($sql))
				{
					$output[] = array_map('utf8_encode', $result);
					
					$tpl->IDATIVIDADE = $result["IdAtividade"]; 
					$tpl->PERGUNTA = $result["Pergunta"]; 
					$tpl->LINKAUDIO = $result["LinkAudio"];
					$tpl->LINKIMAGEMPERGUNTA = $result["LinkImagemPergunta"];
					$tpl->LINKAUDIOIMAGEMPERGUNTA = $result["LinkAudioImagemPergunta"];
					$tpl->IDNIVEL = $result["IdNivel"];
					$tpl->IDTIPOATIVIDADE = $result["IdTipoAtividade"];
					$tpl->block("BLOCK_DADOS"); 
				}

				mysql_close($con);
				return true;
			} catch (Exception $e){ 		 
				echo "há variaveis k não existem! <br /><br />". $e; 
				return false;
			} 

		}
		
        public function loadById($idAtividade){ 
            $db = new PDO('mysql:host=localhost;dbname=supermetaphon', 'root', ''); 
            $result = $db->query("SELECT * FROM atividade WHERE IdAtividade = ".intval($idAtividade)); 
            if($row = $result->fetch()){ 
                $this->setIdAtividade($row['IdAtividade']); 
                $this->setPergunta($row['Pergunta']); 
                $this->setLinkAudio($row['LinkAudio']); 
				$this->setLinkImagemPergunta($row['LinkImagemPergunta']); 
				$this->setLinkAudioImagemPergunta($row['LinkAudioImagemPergunta']); 
				$this->setIdNivel($row['IdNivel']); 
				$this->setIdTipoAtividade($row['IdTipoAtividade']); 
                return true; 
            } 
            return false; 
        } 
		
		public function insertById(){ 
            $db = new PDO('mysql:host=localhost;dbname=supermetaphon', 'root', ''); 
            $result = $db->exec("INSERT INTO atividade(IdAtividade, Pergunta, LinkAudio, LinkImagemPergunta, 
								 LinkAudioImagemPergunta, IdNivel, IdTipoAtividade) 
								 VALUES 
								 (NULL, '$this->pergunta', '$this->linkAudio', '$this->linkImagemPergunta', 
								 '$this->linkAudioImagemPergunta', '$this->idNivel', '$this->idTipoAtividade')"); 		
			if ($result>0)
			{
				$this->setInfo("Registo inserido com sucesso"); 
				return true; 
			}
			else 
			{
				$this->setInfo("Registo não inserido"); 
				return false;
			}
				
						
        }
		
		
		public function updateById($idAtividade){ 
            $db = new PDO('mysql:host=localhost;dbname=supermetaphon', 'root', ''); 
            $result = $db->exec("UPDATE atividade SET ".
								 "Pergunta = '$this->pergunta', ".
								 "LinkAudio = '$this->linkAudio', ".
								 "LinkImagemPergunta = '$this->linkImagemPergunta', ".
								 "LinkAudioImagemPergunta = '$this->linkAudioImagemPergunta', ".
								 "IdNivel = '$this->idNivel', ".
								 "IdTipoAtividade = '$this->idTipoAtividade' ". 
								 "WHERE IdAtividade = '".intval($idAtividade) . "'"); 
			if ($result>0)
			{
				$this->setInfo("Registo alterado com sucesso"); 
				return true; 
			}
			else 
			{
				$this->setInfo("Registo não alterado"); 
				return false;
			}	
        } 
		
		public function deleteById($idAtividade){ 
            $db = new PDO('mysql:host=localhost;dbname=supermetaphon', 'root', ''); 
            $result1 = $db->exec("SELECT FROM atividaderesposta WHERE IdAtividade = '".intval($idAtividade) . "'"); 
			if($result1>0){ 
				$this->setInfo("Existe uma Resposta para esta Atividade!!"); 
				return false;
			}
			else 
			{
				$result2 = $db->exec("SELECT FROM sessaoatividade WHERE IdAtividade = '".intval($idAtividade) . "'"); 
				if($result2>0){ 
					$this->setInfo("Existe uma Sessao de jogo para esta Atividade!!"); 
					return false;
				}
				else 
				{
					$result3 = $db->exec("DELETE FROM atividade WHERE IdAtividade = '".intval($idAtividade) . "'"); 
					if ($result3>0)
					{
						$this->setInfo("Registo apagado com sucesso"); 
						return true; 
					}
					else 
					{
						$this->setInfo("Registo não apagado"); 
						return false;
					}
				}
			}			
        }

        public function getIdAtividade(){ 
            return $this->idAtividade; 
        } 

        public function setIdAtividade($idAtividade){ 
            $this->idAtividade = intval($idAtividade); 
        } 

        public function getPergunta(){ 
            return $this->pergunta; 
        } 

        public function setPergunta($pergunta){ 
            $this->pergunta = $pergunta; 
        } 

        public function getLinkAudio(){ 
            return $this->linkAudio; 
        } 

        public function setLinkAudio($linkAudio){ 
            $this->linkAudio = $linkAudio; 
        } 

		public function getLinkImagemPergunta(){ 
            return $this->linkImagemPergunta; 
        } 

        public function setLinkImagemPergunta($linkImagemPergunta){ 
            $this->linkImagemPergunta = $linkImagemPergunta; 
        } 
		
		public function getLinkAudioImagemPergunta(){ 
            return $this->linkAudioImagemPergunta; 
        } 

        public function setLinkAudioImagemPergunta($linkAudioImagemPergunta){ 
            $this->linkAudioImagemPergunta = $linkAudioImagemPergunta; 
        } 

		public function getIdNivel(){ 
            return $this->idNivel; 
        } 

        public function setIdNivel($idNivel){ 
            $this->idNivel = intval($idNivel); 
        } 
		
		public function getIdTipoAtividade(){ 
            return $this->idTipoAtividade; 
        } 

        public function setIdTipoAtividade($idTipoAtividade){ 
            $this->idTipoAtividade = intval($idTipoAtividade); 
        } 
		
		public function getInfo(){ 
            return $this->info; 
        } 
		
		public function setInfo($info) {
			$this->info = $info; 
		}
    } 

?>