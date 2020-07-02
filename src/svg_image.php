<?php

	//	This class creates and returns an Image string.
	
	class SVGImage {
		
		//	Image height and width.
		private $imageHeight;
		private $imageWidth;
		
		//	The source of the image.
		private $imageSource;
		
		private $xPos;
		private $yPos;
		
		//	This function adds the properties.
		public function __construct($imageWidth, $imageHeight, $x, $y, $imageSource){
			$this->imageHeight = $imageHeight;
			$this->imageWidth = $imageWidth;
			$this->imageSource = $imageSource;
			$this->xPos = $x;
			$this->yPos = $y;
		}
		
		//	This function returns an image string.
		public function GenerateImageString(){
			
			//var_dump($this->imageSource);
			
			$imageStr = "\t";

			$imageStr .= '<image ';
			$imageStr .= 'height="' . $this->imageHeight . '" ';
			$imageStr .= 'width="' . $this->imageWidth . '" ';
			$imageStr .= 'x="' . $this->xPos . '" ';
			$imageStr .= 'y="' . $this->yPos . '" ';			
			$imageStr .= 'xlink:href="' . $this->imageSource . '" ';
			$imageStr .= ' >';
			$imageStr .= '<description>The main image.</description>';
			$imageStr .= '</image>';
				
			return $imageStr;
			
		}
		
	}
	
?>