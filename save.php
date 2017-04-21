<?php
if (is_numeric($_POST["f"])) {
	if ($_COOKIE["coord"] != "1") {
		$timestamp = time();
		if (setcookie("coord", "1", $timestamp+60*60*24*60)) {
			$header = array("timestamp", "ip", "field");
			$data = array($timestamp, $_SERVER["REMOTE_ADDR"], $_POST["f"]);
			$fname = 'data.csv';
			$topline = file_exists($fname);
			$fp = fopen($fname, 'a');
			if (!$topline) {
				fputcsv($fp,$header,';','"');
			}
			fputcsv($fp,$data,';','"');
			fclose($fp);
			echo "success";
		} else {
			echo "cfail";
		}
	} else {
		die("exists");
	}
} else {
	die("nonint");
}
?>
