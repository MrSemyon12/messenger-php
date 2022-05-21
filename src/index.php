<?php
function addMessage($login, $message){
	if ($message !== '') {
		$json_data = json_decode(file_get_contents('messages.json'));
		$newMessage = (object)['date' => date('d-m-y h:i:s'), 'user' => $login, 'message' => $message];
		$json_data[] = $newMessage;
		file_put_contents('messages.json', json_encode($json_data));
	}
}

function printMessages() {
	$json_data = json_decode(file_get_contents('messages.json'));
	foreach($json_data as $cur){
		echo '<p style="color:#000000; font-weight: bold">' . $cur->date . ' | ' . $cur->user . ': ' . $cur->message;
    }
}

function check_user($user_list) {
    if (isset($_GET['log']) && isset($_GET['pas']) && isset($_GET['mes'])) {
        $lg = (string)$_GET['log'];
        $ps = (string)$_GET['pas'];
        $ms = (string)$_GET['mes'];

        if ($user_list[$lg] == $ps) {
            addMessage($lg, $ms);
        }
        else {
            echo '<p style="color:#ff0000; font-weight: bold">' . 'Wrong password';
        }
    }
}

$user_list = [
    "admin" => "password",
    "semen" => "semen",
    "maxim" => "maxim"
];

check_user($user_list);
printMessages();
?>

<div style="font-family: 'Arial Black'">
	<div style="font-weight: bold">
		<labe style="margin-left: 50px">Login:</labe>
		<labe style="margin-left: 115px">Password:</labe>
		<labe style="margin-left: 85px">Message:</labe>
	</div>
	<form action="/messenger/" method="GET">
		<input name="log" value="admin">
		<input name="pas" value="password">
		<input name="mes">
		<button>Submit</button>
	</form>
</div>