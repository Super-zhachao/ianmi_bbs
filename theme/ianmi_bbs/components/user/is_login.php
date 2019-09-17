<?php
	if ($userinfo['id'] == 0) {
    	redirect('/login', ['back_url' => $back_url]);
    }
?>