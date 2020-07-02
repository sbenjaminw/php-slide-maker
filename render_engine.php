<?php
	
	//	The stage, image and text objects
	require_once("./src/svg_stage.php");
	require_once("./src/svg_image.php");
	require_once("./src/svg_text.php");
	
	//	The svg writer
	require_once("./src/svg_writer.php");
	
	//	The text file reader.
	require_once("./src/svg_word_reader.php");


	//	This reads from the text file and then 
	//	creates as many svgs based on lines in the file.
	class RenderEngine {
		
		private $reader;
		private $fpath;
		
		private $fileArray;
		
		public function __construct($fpath){
			
			$this->reader = new SVGWordReader($fpath);
			$this->fpath = $fpath;
			$this->fileArray = array();
		}
		
		//	Makes the SVGs.
		public function MakeSVG(){
			
			//	Read the file 
			$this->reader->ReadWordFile();
			
			//	Get the sentances 
			$sentances = $this->reader->GetSentances();
			
			$svgFileName = "./svgsGeneratedByPhp";
			$svgCounter = 0;
			
			$headerBanner = "D:\\Software\\WAMPServer\\www\\projects\\automating-svg\\coach-banner.png";
			//$headerBanner = "http://localhost/projects/automating-svg/coach-banner.png";
			
			//	Start looping through...
			foreach($sentances as $sentance){
				
				$containsImageOtherThanBanner = false;
				
				$namePlusSVG = "./svgs/" . $svgFileName . $svgCounter . ".svg";
			
				//	Set the stage.
				$svgstage = new SVGStage(800, 1024, $namePlusSVG);
				$svgStartTag = $svgstage->GenerateOpenString();
				
				if( strpos($sentance, ".pdf") ){
					
					$newName = explode("@img=", $sentance);
					
					$newPath = "D:\\Software\\WAMPServer\\www\\projects\\automating-svg\\imgs\\" . $newName[1];
										
					$svgimage = new SVGImage(600, 800, 200, 100, $newPath);
					$imageTag = $svgimage->GenerateImageString();
					
					$containsImageOtherThanBanner = true;
					
				} 
				
				if( strpos($sentance, ".png") ){
										
					$newName = explode("@img=", $sentance);
					
					$newPath = "D:\\Software\\WAMPServer\\www\\projects\\automating-svg\\imgs\\" . $newName[1];
					
					$svgimage = new SVGImage(600, 800, "20%", 100, $newPath);
					$imageTag = $svgimage->GenerateImageString();
					
					$containsImageOtherThanBanner = true;
					
				} 
				
				//	The image.
				$svgimage = new SVGImage(1024, 300, 0, 0, $headerBanner);
				$bannerTag = $svgimage->GenerateImageString();
				
				//	The text.
				$svgtext = new SVGText(100, 450, $sentance, 50);
				$textTag = $svgtext->GenerateTextString();
				
				$svgEnd = $svgstage->GenerateCloseString();
				
				$totalSvg = "";
				
				if($containsImageOtherThanBanner == true){
					
					$totalSvg = $svgStartTag . $imageTag . $bannerTag . $svgEnd;
					
				} else {
					
					$totalSvg = $svgStartTag . $bannerTag . $textTag . $svgEnd;
					
				}
				
				$svgwriter = new SVGWriter($namePlusSVG, $totalSvg);
				$svgwriter->WriteFile($namePlusSVG, $totalSvg);
				
				//echo "\n\n" . '"D:\Software\Inkscape\inkscape.exe" -z -f "' . $namePlusSVG . '" -w 1024 -j -e "' . $namePlusPNG . '"';
				
				$svgCounter++;
				
			}
			
			$this->PNGFileConversion();
			
		}
		
		public function PNGFileConversion(){
			
			//var_dump($this->fileArray);
			
			$dir = "./svgs/";
			
			if (is_dir($dir)) {
				
				if ($dh = opendir($dir)) {
										
					while (($file = readdir($dh)) !== false) {
						
						if(strlen($file) > 3){
							
							$newFile = explode(".", $file);
							
							array_push($this->fileArray, $newFile[0]);
							
						}
						
					}
					
					closedir($dh);
					
				}
			}
			
			//var_dump($fileArray);
			//$shellcmds = array();
			
			foreach($this->fileArray as $file2){
								
				$cmd =  '"D:\Software\Inkscape\inkscape.exe" -z -f "' . "D:/Software/WAMPServer/www/projects/automating-svg/svgs/" . $file2 . '.svg" -w 1024 -j -e "' . "D:/Software/WAMPServer/www/projects/automating-svg/pngs/" . $file2 . '.png"';
				
				echo $cmd;
				echo "<br/><br/>";
				
				shell_exec($cmd);
				
			}
			
		}
		
	}
?>