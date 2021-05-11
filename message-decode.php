<?php

class messageDecode{
				
		
		function __construct() {
			$this->decodedMessage = '';
			$this->occurenceCtr = 0;
			$this->currentStr = '';
		}
		
        private function currentString($str, $execute=1){									
			
			if($this->currentStr != $str):
								
				// Add to decode message				
				$this->decodedMessage .= $this->occurenceCtr.$this->currentStr;
				
				
				$this->currentStr = $str;	
				
				
				if(!$execute<=2):
					//reset occurence
					$this->occurenceCtr=0;
					
				endif;				
			
				
			endif;
						
			
			return $this->currentStr; 	
			
		}
		
		
		function deMessage($strMessage){
			
			$arrMessage = str_split($strMessage);
			//$arrDistinctMessage = array_values(array_unique($arrMessage));
			
			
			$occurenceKey = 0;
			
			$objMessage = new ArrayObject( $arrMessage );
			$objMessageIterate = $objMessage->getIterator();
			
			
			
			
			while( $objMessageIterate->valid()){
						
						if($occurenceKey==0):
							//First execution set current string
							$this->currentStr = $objMessageIterate->current();														
						endif;
						
						if($this->currentString($objMessageIterate->current(), $occurenceKey) === $objMessageIterate->current()):																															
							
							//increment
							$this->occurenceCtr++;
							
							//set occurence
							$occurenceKey = $objMessageIterate->key()+1;

							
							//echo "Rewind Distinct Iterator<br>";
							//$objDistinctMessageIterate->rewind();
							
							//go to next string
							$objMessageIterate->next();

							
							//if last character
							if($objMessageIterate->count() == $occurenceKey):
								
								// Add to decode message		
								$this->decodedMessage .= $this->occurenceCtr.$this->currentStr;

								
							endif;
							

						endif;

					
				
			
			}
			
			return $this->decodedMessage;
			
		}
		
}




?>
<style>
	body{
		font-family:Verdana, Geneva, sans-serif;
		font-size:18px;
	}
	div.wrapper{
		display:flex;
		flex-direction:column;
		justify-content:center;
		align-items:center;
	}
	div#result{
		background:rgb(231,248,224);
		padding: 0.975em 1.85em 0.975em 1.85em;
		 border-radius: 5px;
	}
	input[type=text]{
		padding: 0.975em 1.85em 0.975em 1.85em;
	}
	input[type=submit]{
		background-color: #73cd4d;
	    margin-top: 10px;
    	padding: 0.975em 1.85em 0.975em 1.85em;
	    border: #73cd4d;
	    border-radius: 10em;
		cursor:pointer;
		color:white;
	}
</style>


<div class="wrapper">
    <h1>Message Decoder</h1>
        <form action="" method="post">
            
            <label>Enter your message:</label>
            <input name="strMessage" type="text" value=""/>
        
        <input type="submit" value="Decode message" />
        
        </form>
        <div id="result">
        	
            <?php
			if(isset($_POST['strMessage'])){
				
				
				$message = new messageDecode;
				echo $message->deMessage($_POST['strMessage']);
				
			}
			?>
        </div>


</div>