<?php

	//	This class writes the SVG file.
	class SVGWriter {
	
		public function WriteFile($fpath, $contents){
			
			try {
				
				$fw = fopen($fpath, 'w');
					
				fwrite($fw, $contents);
					
				fclose($fw);
				
			} catch (Exception $ex) {
			
				echo "Error: There was an error with the writing of the file.";
				
			}
			
		}
		
	}
	
?>