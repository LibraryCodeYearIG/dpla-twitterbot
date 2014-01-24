<?php
	// Twitter BOT group - 2014
	// Simon, Tessa & Coral	

	// echo <meta http-equiv="refresh" content="60" >;   uncomment this -> auto refresh this BOT script every 1 minutes

	echo "<p><font color=blue>Twitter BOT was activated.</font></p>";
	
			// grab new tweets from Twitter API #askDPLA	
			
			require_once 'twitteroauth/twitteroauth.php';
			 
			define('CONSUMER_KEY', 'hx2ahPuCxDUBJsHQ9P5Zw');
			define('CONSUMER_SECRET', 'SAEjUeen05hZrdVIXJXNxVTiQkxWX5IY97FpGnnAULU');
			define('ACCESS_TOKEN', '56239365-wKKZvlUDq1UTz8ljTU3iizT0x6dVoKHukgHQMDe4k');
			define('ACCESS_TOKEN_SECRET', 'UBSYFhMCpYdrXPBjPRNmivRL668hwida66LeeRY0gw2gg');
			 
			function search(array $query)
			{
			  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
			  return $toa->get('search/tweets', $query);
			}
			 
			$query = array(
			  "q" => "#askDPLA",
			);
			  
			$results = search($query);
			  
			foreach ($results->statuses as $result) {
			  echo "<font color=red><b>". $result->user->screen_name . ": " . $result->text . "</font></b><br>";
			  
			  		// format data --> query + identify the person have asked
							$keyword = $result->text;  
							// $keyword = substr($keyword, 0, -1); 
							$keyword = substr($keyword, 9); 
							$user = $result->user->screen_name;  
					
					// query to DPLA
							$url = 'http://api.dp.la/v2/items?q=' . $keyword . '&api_key=c5d2cd5671aa3e9acb9fbf2d97614103';
							echo "<br>Query to DPLA: ".$url."<br>";

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
					
					// Respond to the person have asked		- coming soon			
			  
			}
?>