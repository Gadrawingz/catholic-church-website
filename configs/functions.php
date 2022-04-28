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

	// @gadrawingz:relative sh**
	public function gadsonDateTimeFormatter($datetime) {
	    $depth=1;

	    $units = array(
	    	"year"=>31104000, "month"=>2592000, "week"=>604800,
	    	"day"=>86400, "hour"=>3600, "minute"=>60, "second"=>1
	    );

	    $plural = "s";
	    $conjugator = " and ";
	    $separator = ", ";
	    $suffix1 = " ago";
	    $suffix2 = " left";
	    $now = "now";
	    $empty = "";

	    # DO NOT TOUCH OR MODIFY BELOW LINE @Gadrawin
	    $timediff = time()-strtotime($datetime);

	    if ($timediff == 0) return $now;
	    if ($depth < 1) return $empty;

	    $max_depth = count($units);
	    $remainder = abs($timediff);
	    $output = "";
	    $count_depth = 0;
	    $fix_depth = true;

	    foreach($units as $unit=>$value){
	    	if($remainder>$value && $depth-->0) {
	    		if($fix_depth) {
	    			$max_depth -= ++$count_depth;
	    			if($depth>=$max_depth) $depth=$max_depth;
	    			$fix_depth = false;
	    		}

	    		$u = (int)($remainder/$value);
	    		$remainder %= $value;
	    		$pluralise = $u>1?$plural:$empty;
	    		$separate = $remainder==0||$depth==0?$empty: ($depth==1?$conjugator:$separator);
	    		$output .= "{$u} {$unit}{$pluralise}{$separate}";
	    	}
	    	$count_depth++;
	    }
	    return $output.($timediff<0?$suffix2:$suffix1);
	}
}
?>
