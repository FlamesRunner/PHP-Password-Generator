<?php
function generateRandomPassword($characters = 7) {
        $words = file_get_contents('wordlist.txt');
        $symbols = array('@', '&', '!', '#', '$', '%');
        $wordList = explode("\n", $words);
        for ($i = 0; $i <= $characters; $i++){
                $password = trim($password);
                if (strlen($password) >= $characters) break;
                $choice = rand(0, count($wordList));
                $passwordPhrase .= $wordList[$choice];
                if (rand(0, 100) > 50) { $password .= strtoupper(substr($wordList[$choice], 0, 1)); } else { $password .= substr($wordList[$choice], 0, 1); }
                if (rand(0, 100) > 80) {
                        $symbolID = rand(0, count($symbols)-1);
                        $password .= $symbols[$symbolID];
                        $passwordPhrase .= $symbols[$symbolID] . ' ';
                }
        }
        $values = array('password' => $password, 'words' => $passwordPhrase);
        return $values;
}

$length = $_POST['len'];
if (!isset($_POST['len']) && !is_numeric($length) && $length > 64) $length = 7;
echo json_encode(generateRandomPassword($length));
?>
