<?php

	$a="1";
	$b="100";

	for($i=$a; $i<=$b; $i++) {
		if($i%3 == "0" ){ 
			echo "Fizz";
		}
		
		if( $i%5 == "0" ){
			echo "Buzz";
		}

		if(($i%3 != "0") and ($i%5 != 0)){
			echo "$i";
		}

		echo "<br />";
	}

?>