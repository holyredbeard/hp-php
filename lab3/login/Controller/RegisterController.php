<?php

namespace Controller;

class RegisterController {

	public function DoControl(\Model\RegisterHandler $registerHandler, \View\RegisterView $registerView, \View\LoginView $loginView) {

		$xhtml = "";

    	if ($registerView->WantToRegister()) {
    		echo "Regbox me!";
    		$xhtml = $registerView->DoRegisterBox();
    	}
    	
    	else if ($registerView->TredToRegister()) {
    		echo "Reg me!";
    	}

    	return $xhtml;
	}
}