<?php	
	define(CODE_LENGTH, 15);
	
	
	/**
	 * Generate a new ticket code for a user
     * @param string $userId the user identifier
     * @param int $index the ticket index in the current set
     * @return string the ticket code
     */
    function generate_code($userId, $index) {
        $prefix = chr(97+mt_rand(0, 25)).chr(97+mt_rand(0, 25));
        $seed = rand(0, strlen($userId)*($index+1));
        $text = md5(uniqid($seed, true));
        return strtoupper($prefix.substr($text, 0, CODE_LENGTH-2));
    }
	
	// generate tickets
	$userId = "GUEST";
	$count = 3;
	for($i=0; $i<$count; $i++) {
		try {
			$code = generate_code($userId, $i);
			echo "generated ticket: $code".PHP_EOL;
		}
		catch(Exception $e) {
			echo "Failed to generate code: '".$e->getMessage()."'";
		}
	}
?>