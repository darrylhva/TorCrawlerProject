<?php 
	include("header.php");
?>
  
<?php
// define variable and set to empty values
$website = $tor = $runlinux = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$website = test_input($_POST["website"]);
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = ($data);
return $data;
}
?>
<br>

<div class="container">
 
	<?php
	exec("ss -aln | grep 9050", $output, $return);
		if ($return == 0) {
			echo '<div class="alert alert-success">TOR is Running Safely</div>';
		} else {
			echo '<div class="alert alert-danger">TOR is Down</div>';
		}
	?>

	<br>
	<h3>Dark Web Crawler - Team 4</h3>
	
	<p>Hallo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b><br /> Welkom op het TOR Project dashboard.<br /> <br /></p>
  
	

<?php

	if(isset($_POST['keyword'])){
		
		$data1=$_POST['website'];
		$data2=$_POST['keyword'];
		$fp = fopen("/var/www/html/data/crawldata.txt", "w");
		fwrite($fp, $data1);
		fwrite($fp, PHP_EOL); // an enter in line
		fwrite($fp, $data2);
		fclose($fp);
		
		echo "<br>Start website: ";
		echo($data1);
		echo "<br>Search keyword: ";
		echo($data2);
		echo "<br>crawldata.txt readout: ";
		
		// reading crawldata.txt
		$file = fopen("/var/www/html/data/crawldata.txt", "r");
		//Output lines until EOF is reached
		while(! feof($file)) {
		$line = fgets($file);
		echo $line. "<br>";
		}
		fclose($file);
		
		echo "<h3>Crawled websites:</h3>\n";
		
		// run main.py
		//$command = "/var/www/html/crawler/python3 main.py";
	    $output = shell_exec("/var/www/cgi-bin/python3 main.py");
	    
		
		// reading crawled.txt - from the directory output saved
		$url = str_replace('http://', 'http:/', $data1 ); 
		$dir = "/var/www/cgi-bin/".$url;
		echo $dir;
		$crawled = fopen($dir."/crawled.txt","r");
		//$crawled = fopen("/var/www/html/crawler/http:/www.hva.nl/crawled.txt","r");
		while(! feof($crawled)) {
			$line = fgets($crawled);
			echo $line. "<br>";
		}
		fclose($crawled);
	
	}
	
	
		
	
?>
  
  


</div>

</body>
</html>
