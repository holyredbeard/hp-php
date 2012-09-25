<?php

class FileUploadView {

	private $submit = "submitUpload";

	public function CreateUploadForm() {

	}

	public function UserWantsToUpload() {
		if(isset($_POST[$this->submit])){
			return true;
		}
		else {
			return false;
		}
	}
 
	public function ShowListOfFiles() {
		$directory = "upload/";
		$listOfFiles = "";

		if(is_dir($directory)){
			if($dh = opendir($directory)){
				while (($file = readdir($dh)) !== false) {
					$listOfFiles .= $file . "\n";
				}
				closedir($dh);

				return $listOfFiles;
			}
		}
	}
}