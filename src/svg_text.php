<?php

	//	This class creates and SVG Text object string and returns it.

	class SVGText {
		
		//	The height of the text, in pixels.
		private $textHeight;
		
		//	The position of the text. 
		private $textXpos;
		private $textYpos;
		
		//	The actual content of the text.
		private $content;
		
		//	Line character limit.
		private $charLimit;
		
		
		public function __construct($textXpos, $textYpos, $content, $textHeight){
			$this->textHeight = $textHeight;
			$this->textXpos = $textXpos;
			$this->textYpos = $textYpos;
			$this->content = $content;
			$this->charLimit = 30;
		}
		
		private function GenerateTSpanString($content){
			
			$tspanStr = "";
		
			$tspanStr .= "<tspan>";
			$tspanStr .= $content;
			$tspanStr .= "</tspan>";
			
			return $tspanStr;
		
		}
		
		public function GenerateTextString(){
			
			$textStr = "";
			
			if(strlen($this->content) > $this->charLimit){
					
				$wrap = wordwrap($this->content, $this->charLimit, "<br/>");
				$wwrap = explode("<br/>", $wrap);
				
				$counter = 0;
					
				foreach($wwrap as $word){
					
					$newYPos = $this->textYpos;
					$newXpos = $this->textXpos;
					
					$newYPos = ($this->textHeight + $this->textYpos);
											
					$textStr .= '<text style="font-family: Arial; font-size:' . $this->textHeight . 'px; text-align: center;"';
					
					if(strlen($word) < 16){
						$textStr .= ' x="40%"';
					} else if (strlen($word) < 16 && $counter > 0) {
						$textStr .= ' x="48%"';
					}  else {
						$textStr .= ' x="20%"';
					}
					
					
					//$textStr .= ' x="20%"';
					
					$textStr .= ' y="' . $this->textYpos . '" ';
					
					if($counter > 0){
						$textStr .= ' y="' . ($this->textYpos + $this->textHeight) . '" ';
					}
					
					
					$textStr .= ' height="' . $this->textHeight . 'px" ';
					$textStr .= '>';
					
					$textStr .= "\n\t\t";
					
					$textStr .= '<tspan>';
					$textStr .= $word;
					$textStr .= "</tspan>";
					
					$textStr .= "\n\t" . '</text>' . "\n";
					
					$counter++;
					
				}
			
			} else {
									
				$textStr .= '<text style="font-family: Arial; font-size:' . $this->textHeight . 'px; text-align: center;"';
				
				//$textStr .= ' x="20%"';
				
				if(strlen($this->content) < 16){
					$textStr .= ' x="40%"';
				} else {
					$textStr .= ' x="20%"';
				}
				
				$textStr .= ' y="' . $this->textYpos . '" ';
			
				
				$textStr .= ' height="' . $this->textHeight . 'px" ';
				$textStr .= '>';
			
				$textStr .= "\n\t\t";
					
				$textStr .= '<tspan>';
				$textStr .= $this->content;
				$textStr .= "</tspan>";
					
				$textStr .= "\n\t" . '</text>' . "\n";
					
			}
		
			return $textStr;
				
		}
		
	}

?>