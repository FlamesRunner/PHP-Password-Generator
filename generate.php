<?php
function generateRandomPassword($characters = 7) {

	$words = file_get_contents('wordlist.txt');
	$symbol_list = '@,&,!,#,$,%';
	$symbols = explode(',', $symbol_list);
	$array = explode("\n", $words);
        $wordcount = count($array);
	$symbolcount = count($symbols);
	$words = '';
	$password = '';

        for ($i = 0; $i <= $characters; $i++){

		$password = trim($password);

		if (strlen($password) >= $characters){
			break;
		}

	        $choice = rand(0, $wordcount);
		$words .= $array[$choice];
		$choosecase = rand(0, 100);
		$letter = substr($array[$choice], 0, 1);

		if ($choosecase > 50) {
			$password .= strtoupper($letter);
		} else {
			$password .= strtolower($letter);
		}
		
		$addsymbol = rand(0, 100);

		if ($addsymbol > 80){
			$which_symbol = rand(1, $symbolcount);
			$password .= $symbols[$which_symbol];
			$words .= $symbols[$which_symbol] . ' ';
		}
	}

	$values = array('password' => $password, 'words' => $words);
	return $values;
}

$error = 0;

if (!isset($_POST['len'])) {
	$length = 7;
} 

if (!is_numeric($_POST['len'])){
	$length = 7;
} else {
	if ($_POST['len'] > 64){
		$length = 7;
	} else {
		$length = $_POST['len'];
	}
}

$data = generateRandomPassword($length);

echo json_encode($data);

?>
