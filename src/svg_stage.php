<?php

	//	This class generates the SVG stage strings.

	class SVGStage {
		
		//	The height and width of the SVG object.
		private $height;
		private $width;
		
		//	The HTML name of the SVG object.
		private $name;
		
		public function __construct($height, $width, $name){
			$this->height = $height;
			$this->width = $width;
			$this->name = $name;
		}
		
		public function GenerateOpenString(){
			
			$openStr = "";
			
			$openStr .= '<svg ';
			$openStr .= 'xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" ';
			$openStr .= ' height="' . $this->height . '"';
			$openStr .= ' width="' . $this->width . '" ';
			$openStr .= ' name="' . $this->name . '"';
			$openStr .= ' id="' . $this->name . '"';
			$openStr .= '>' . "\n";
			$openStr .= "\t" . '<rect ';
			$openStr .= ' height="' . $this->height . '"';
			$openStr .= ' width="' . $this->width . '" ';
			$openStr .= 'style="fill:#ffffff;"/>';
			
			return $openStr;
			
		}
		
		public function GenerateCloseString(){
			
			return '</svg>';
			
		}
		
	}
	
?>