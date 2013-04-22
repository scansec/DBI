<?php
        $body = file_get_contents('http://bitcoincharts.com/t/markets.json');
        
        $rate = @json_decode($body);
        
        if ($rate == NULL)
            die('ERROR RESPONSE');

        xcache_set("rate", $body, 3600);
            
            
  	foreach ($rate as $val)
		{
			if ($val->symbol == "mtgoxEUR")
				$EUR = $val->ask;
		}        
        
		$DKK = number_format($EUR * 7.5, 2);
        $DKK = preg_replace('/\,/i', "", $DKK);
        //$EUR = $rate->EUR->"24h";
        
         
        $myFile = "rate.inc";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh, $DKK);
        fclose($fh);
                                
        
        echo 'UPDATED TO ' . $DKK;
        
        //var_dump($rate);
                                      
        die();    
?>
