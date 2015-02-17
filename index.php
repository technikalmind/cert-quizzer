<!--	Author: George Hall
	A+ Certification Quizzer
	- Randomly chooses questions from the A+ certification exam
-->

<html>
<head>
	<title>A+ Certification Quizzer</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<table>
<?php
	include("functions.php");
	include("navigation.php");
?>
</table>
<br />
<table>
<?php
	if($_GET['page'] == "submit") {
		$submitID = getHighestID("quizData.txt") + 1;
		$submitQuestion = $_POST['question'];
		$submitAnswer = $_POST['answer'];
		$password = $_POST['password'];
		$submitBoth = $submitID.":".$submitQuestion.":".$submitAnswer;
		if(!empty($submitQuestion) && !empty($submitAnswer) && $password == "gimme2certs") {
				// Idea: Auto-append "?" if it's left out
				echo "Submitting...<br /><br />
				
				<strong>Record #".$submitID."</strong>: <br />
				Question: <strong>".$submitQuestion."</strong> <br />
				Answer: <strong>".$submitAnswer."</strong> <br /> <br />";
				
				submitToFile($submitBoth, "quizData.txt");
			} else {
			print("
				<form action='index.php?page=submit' method='post'>
				<tr><td class='inpt'>Question:</td>
					<td class='inpt'><input size='75' name='question' type='text' /></td>
				</tr><tr>
					<td class='inpt'>Answer:</td>
					<td class='inpt'><input size='75' name='answer' type='text' /></td>
				</tr><tr>
					<td class='inpt'>Password:</td>
					<td class='inpt'><input size='15' name='password' type='password' /></td>
				</tr><tr>
					<td colspan='2' class='inpt'>
					<input class='submit' value='Submit' type='submit' />
					</td>
				</tr>
				</form>
			");
		}
	} elseif($_GET['page'] == "home" || empty($_GET['page']) || !isset($_GET['page'])) {
		$sizeQuizFile = countFileLines("quizData.txt");
		$randomNumber = rand(1,$sizeQuizFile);

		$quizFile = fopen("quizData.txt", "r");
		for($i = 1; $i <= $randomNumber; $i++) {
			$quizLine = fgets($quizFile);
			list($id, $question, $answer) = split(":", $quizLine);
		}
		fclose($quizFile);
		
		print("
			<tr><td>QID</td><td>Question</td><td>Answer</td></tr>
			<tr>
				<td>".$id."</td>
				<td width='320px'>".$question."</td>
				<td><a href='index.php?page=answer&id=".$id."'>See answer</a></td>
			</tr>
			");
	} elseif($_GET['page'] == "answer") {
		$id = $_GET['id'];
		$question = getQuestion($id, "quizData.txt");
		$answer = getAnswer($id, "quizData.txt");
		print("
			<tr><td>QID</td><td>Question</td><td>Answer</td></tr>
			<tr>
				<td>".$id."</td>
				<td width='320px'>".$question."</td>
				<td>".$answer."</td>
			</tr>
			");
	
	} else {
		echo "Invalid page.<br />
					Please reference the navagation bar above for valid page options.";
	}
?>
</table>
</body>
</html>
