<meta http-equiv="refresh" content="60" >

<?php
	echo "<p><font color=blue>Twitter BOT was activated.</font></p>";
	
	// grab new data from Twitter API #askDPLA	
	
	// format data --> query + identify the person have asked
			$keyword = 'puppy';  // <<<< this supposed to be grabbed from Twitter
			$user = "TwitterIDofUser";  // <<<<< this too
	
	// query to DPLA
			$url = 'http://api.dp.la/v2/items?q=' . $keyword . '&api_key=c5d2cd5671aa3e9acb9fbf2d97614103';


			// Use cURL to GET data from the API
            $ch = curl_init($url);            
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec ( $ch ); 
            curl_close($ch);
            
            // Decode the JSON string into something we easily use
            $json_output = json_decode($response);
			
            // Dump some markup for title <-- just for testing. We're planning to format this into the response to Twitter User
            if (!empty($json_output->docs)) {
                echo "<h2>Items from DPLA containing: ".$keyword."</h2>";
                echo "<div style='margin-left: 12px; background-color: #EEE; padding: 5px;'>";
     
                foreach ( $json_output->docs as $doc ) {
                    echo "<h3>{$doc->sourceResource->title}</h3>";                                       
                }
                echo "</div>";
            }
	
	// Respond to the person have asked

?>