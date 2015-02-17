<?php
function countFileLines($filename)
{
	$theFile = fopen($filename, "r");
	$lineFromFile = fgets($theFile);
	while(!feof($theFile)) {
		$lineCount++;
		$lineFromFile = fgets($theFile);
	}
	fclose($theFile);
	return $lineCount;
}

function getHighestID($filename)
{
	$theFile = fopen($filename, "r");
	$idArr = array();
	$lineFromFile = fgets($theFile);
	while(!feof($theFile)) {
		list($id, $question, $answer) = split(":", $lineFromFile);
		$idArr[] = $id;
		$lineFromFile = fgets($theFile);
	}
	fclose($theFile);
	$maxID = max($idArr);
	return $maxID;
}

function submitToFile($submission, $filename)
{
	$theFile = fopen($filename, "a");
	fputs($theFile, $submission."\n");
	fclose($theFile);
	echo "Successfully added to the database.";
}

function getQuestion($getID, $filename)
{
	$theFile = fopen($filename, "r");
	$lineFromFile = fgets($theFile);
	while(!feof($theFile)) {
		list($id, $question, $answer) = split(":", $lineFromFile);
		if($id == $getID) {
			fclose($theFile);
			return $question;
		}
		$lineFromFile = fgets($theFile);
	}
	fclose($theFile);
}

function getAnswer($getID, $filename)
{
	$theFile = fopen($filename, "r");
	$lineFromFile = fgets($theFile);
	while(!feof($theFile)) {
		list($id, $question, $answer) = split(":", $lineFromFile);
		if($id == $getID) {
			fclose($theFile);
			return $answer;
		}
		$lineFromFile = fgets($theFile);
	}
	fclose($theFile);
}

?>
