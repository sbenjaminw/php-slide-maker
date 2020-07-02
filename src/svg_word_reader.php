<?php
	//	This class reads the words and returns sentances.
	class SVGWordReader {
	
		private $sentances;
		private $fpath;
		
		public function __construct($fpath){
			$this->sentances = array();
			$this->fpath = $fpath;
		}
		
		public function ReadWordFile(){
			
			try {
				
				$file = fopen($this->fpath, "r");
			
				while($line = fgets($file)){
					if(strlen($line) > 2){
						array_push($this->sentances, $line);
					}

				}
			
				fclose($file);
				
			} catch (Exception $ex){
				var_dump($ex);
			}
			
		}
		
		public function GetSentances(){
			return $this->sentances;
		}
		
	}
?>