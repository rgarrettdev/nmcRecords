<?php
try {
	// include the file for the database connection
	require_once('../PHP/connect.php');
	// get database connection
}
catch (Exception $e) {
	throw new Exception("Connection error " . $e->getMessage(), 0, $e);
}

if (isset($_REQUEST['useXML'])) {
	// echo what getXMLOffer returns
	echo getXMLOffer($dbconnect);
}

else {    // otherwise just an html record is required

    // so echo whatever getHTMLOffer returns to the browser or back to the ajax script
    echo getHTMLOffer($dbconnect);
}

function getHTMLOffer($dbconnect) {
	try {
	    // store the sql for a random special offer, the sql wraps things using concat in an html 'wrapper'
	    $sql = "select concat('<p>&#8220;',recordTitle,'&#8221;<br />\n<span class=\"category\">Category: ',catDesc,'</span><br />\n<span class=\"price\">Price: ',recordPrice,'</span></p>') as offer from nmc_special_offers inner join nmc_category on nmc_special_offers.catID = nmc_category.catID order by rand() limit 1";

		// execute the query
		$rsOffer = $dbconnect->query($sql);

		// get the one offer returned
		$offer = $rsOffer->fetchObject();

		// return the offer
		return $offer->offer;
	}
	catch (Exception $e) {
		return "Problem: " . $e->getMessage();
	}
}

function getXMLOffer($dbconnect) {
	try {
		$xmlHeader = "<?xml version='1.0' encoding='UTF-8' ?>\n";
		// Start to assemble an output string with the xml head and root element
		$output = $xmlHeader;
		$output .= "<root>\n";
		$sql = "select recordTitle, catDesc, recordPrice from nmc_special_offers inner join nmc_category on nmc_special_offers.catID = nmc_category.catID order by rand() limit 1";
		$rsOffer = $dbconnect->query($sql);
		while ( $record = $rsOffer->fetchObject() ) {
			// start a new record element in xml and add to the output
			$output .= "\t<offer>\n";
			// iterate through each record pulling out the fieldname and its value
			foreach ( $record as $field => $value ) {
				$value = htmlspecialchars( $value );
				// wrap up the fields and values as xml
				$output .= "\t\t<$field>$value</$field>\n";
			}
			$output .= "\t</offer>\n";
		}
		$output .= "</root>";
		return $output;
	}
	catch (Exception $e) {
		return "Problem: " . $e->getMessage();
	}
}

?>
