<?php

class Functions {
	// APP NAME
	public function getAppName() {
		return ("Lab Materials Management System");
	}

	public function getLangRow($language) {

		if(isset($language) && $language=='lang_en') {
			$getrow = "kwd_english";
		} else if(isset($language) && $language=='lang_rw') {
			$getrow = "kwd_kinya";
		} else if(isset($language) && $language=='lang_fr') {
			$getrow = "kwd_french";
		}
		return $getrow;
	}
}
?>
