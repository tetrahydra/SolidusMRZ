<?php

# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = File Name  | mrz.php
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = File Date  | 28/01/2017
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = Version    | 1.0
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = Notes      | Halim Minai Rahman 
# =            | halim@ebyx.net
# =            |
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = Revision   | 2018-07-14 Added $EU_Countries and function for parseMRZID_EU()
# =            | 
# =            | 
# =            | 
# =            | 
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =

class SolidusMRZ {

	private $countries;
	private $EU_Countries;
	private $EU_additional_org;
	private $checkDigitValues;

    function __construct() { 
		
		// # ISO 3166 alpha-3 codes
		// # Source: http://unstats.un.org/unsd/methods/m49/m49alpha.htm
        $this->countries = 
			array(
				"AFG" => "Afghanistan",
				"ALB" => "Albania",
				"DZA" => "Algeria",
				"ASM" => "American Samoa",
				"AND" => "Andorra",
				"AGO" => "Angola",
				"AIA" => "Anguilla",
				"ATA" => "Antarctica",
				"ATG" => "Antigua and Barbuda",
				"ARG" => "Argentina",
				"ARM" => "Armenia",
				"ABW" => "Aruba",
				"AUS" => "Australia",
				"AUT" => "Austria",
				"AZE" => "Azerbaijan",
				"BHS" => "Bahamas",
				"BHR" => "Bahrain",
				"BGD" => "Bangladesh",
				"BRB" => "Barbados",
				"BLR" => "Belarus",
				"BEL" => "Belgium",
				"BLZ" => "Belize",
				"BEN" => "Benin",
				"BMU" => "Bermuda",
				"BTN" => "Bhutan",
				"BOL" => "Bolivia",
				"BIH" => "Bosnia and Herzegovina",
				"BWA" => "Botswana",
				"BVT" => "Bouvet Island",
				"BRA" => "Brazil",
				"IOT" => "British Indian Ocean Territory",
				"BRN" => "Brunei Darussalam",
				"BGR" => "Bulgaria",
				"BFA" => "Burkina Faso",
				"BDI" => "Burundi",
				"KHM" => "Cambodia",
				"CMR" => "Cameroon",
				"CAN" => "Canada",
				"CPV" => "Cape Verde",
				"CYM" => "Cayman Islands",
				"CAF" => "Central African Republic",
				"TCD" => "Chad",
				"CHL" => "Chile",
				"CHN" => "China",
				"CXR" => "Christmas Island",
				"CCK" => "Cocos (Keeling) Islands",
				"COL" => "Colombia",
				"COM" => "Comoros",
				"COG" => "Congo",
				"COK" => "Cook Islands",
				"CRI" => "Costa Rica",
				"CIV" => "Côte d'Ivoire",
				"HRV" => "Croatia",
				"CUB" => "Cuba",
				"CYP" => "Cyprus",
				"CZE" => "Czech Republic",
				"PRK" => "Democratic People's Republic of Korea",
				"COD" => "Democratic Republic of the Congo",
				"DNK" => "Denmark",
				"DJI" => "Djibouti",
				"DMA" => "Dominica",
				"DOM" => "Dominican Republic",
				"TMP" => "East Timor",
				"ECU" => "Ecuador",
				"EGY" => "Egypt",
				"SLV" => "El Salvador",
				"GNQ" => "Equatorial Guinea",
				"ERI" => "Eritrea",
				"EST" => "Estonia",
				"ETH" => "Ethiopia",
				"FLK" => "Falkland Islands (Malvinas)",
				"FRO" => "Faeroe Islands",
				"FJI" => "Fiji",
				"FIN" => "Finland",
				"FXX" => "France, Metropolitan",
				"GUF" => "French Guiana",
				"PYF" => "French Polynesia",
				"GAB" => "Gabon",
				"GMB" => "Gambia",
				"GEO" => "Georgia",
				"D"   => "Germany",
				"GHA" => "Ghana",
				"GIB" => "Gibraltar",
				"GRC" => "Greece",
				"GRL" => "Greenland",
				"GRD" => "Grenada",
				"GLP" => "Guadeloupe",
				"GUM" => "Guam",
				"GTM" => "Guatemala",
				"GIN" => "Guinea",
				"GNB" => "Guinea-Bissau",
				"GUY" => "Guyana",
				"HTI" => "Haiti",
				"HMD" => "Heard and McDonald Islands",
				"VAT" => "Holy See (Vatican City State)",
				"HND" => "Honduras",
				"HKG" => "Hong Kong",
				"HUN" => "Hungary",
				"ISL" => "Iceland",
				"IND" => "India",
				"IDN" => "Indonesia",
				"IRN" => "Iran, Islamic Republic of",
				"IRQ" => "Iraq",
				"IRL" => "Ireland",
				"ISR" => "Israel",
				"ITA" => "Italy",
				"JAM" => "Jamaica",
				"JPN" => "Japan",
				"JOR" => "Jordan",
				"KAZ" => "Kazakhstan",
				"KEN" => "Kenya",
				"KIR" => "Kiribati",
				"KWT" => "Kuwait",
				"KGZ" => "Kyrgyzstan",
				"LAO" => "Lao People's Democratic Republic",
				"LVA" => "Latvia",
				"LBN" => "Lebanon",
				"LSO" => "Lesotho",
				"LBR" => "Liberia",
				"LBY" => "Libyan Arab Jamahiriya",
				"LIE" => "Liechtenstein",
				"LTU" => "Lithuania",
				"LUX" => "Luxembourg",
				"MDG" => "Madagascar",
				"MWI" => "Malawi",
				"MYS" => "Malaysia",
				"MDV" => "Maldives",
				"MLI" => "Mali",
				"MLT" => "Malta",
				"MHL" => "Marshall Islands",
				"MTQ" => "Martinique",
				"MRT" => "Mauritania",
				"MUS" => "Mauritius",
				"MYT" => "Mayotte",
				"MEX" => "Mexico",
				"FSM" => "Micronesia, Federated States of",
				"MCO" => "Monaco",
				"MNG" => "Mongolia",
				"MSR" => "Montserrat",
				"MAR" => "Morocco",
				"MOZ" => "Mozambique",
				"MMR" => "Myanmar",
				"NAM" => "Namibia",
				"NRU" => "Nauru",
				"NPL" => "Nepal",
				"NLD" => "Netherlands, Kingdom of the",
				"ANT" => "Netherlands Antilles",
				"NTZ" => "Neutral Zone",
				"NCL" => "New Caledonia",
				"NZL" => "New Zealand",
				"NIC" => "Nicaragua",
				"NER" => "Niger",
				"NGA" => "Nigeria",
				"NIU" => "Niue",
				"NFK" => "Norfolk Island",
				"MNP" => "Northern Mariana Islands",
				"NOR" => "Norway",
				"OMN" => "Oman",
				"PAK" => "Pakistan",
				"PLW" => "Palau",
				"PAN" => "Panama",
				"PNG" => "Papua New Guinea",
				"PRY" => "Paraguay",
				"PER" => "Peru",
				"PHL" => "Philippines",
				"PCN" => "Pitcairn",
				"POL" => "Poland",
				"PRT" => "Portugal",
				"PRI" => "Puerto Rico",
				"QAT" => "Qatar",
				"KOR" => "Republic of Korea",
				"MDA" => "Republic of Moldova",
				"REU" => "Réunion",
				"ROM" => "Romania",
				"RUS" => "Russian Federation",
				"RWA" => "Rwanda",
				"SHN" => "Saint Helena",
				"KNA" => "Saint Kitts and Nevis",
				"LCA" => "Saint Lucia",
				"SPM" => "Saint Pierre and Miquelon",
				"VCT" => "Saint Vincent and the Grenadines",
				"WSM" => "Samoa",
				"SMR" => "San Marino",
				"STP" => "Sao Tome and Principe",
				"SAU" => "Saudi Arabia",
				"SEN" => "Senegal",
				"SYC" => "Seychelles",
				"SLE" => "Sierra Leone",
				"SGP" => "Singapore",
				"SVK" => "Slovakia",
				"SVN" => "Slovenia",
				"SLB" => "Solomon Islands",
				"SOM" => "Somalia",
				"ZAF" => "South Africa",
				"SGS" => "South Georgia and the South Sandwich Island",
				"ESP" => "Spain",
				"LKA" => "Sri Lanka",
				"SDN" => "Sudan",
				"SUR" => "Suriname",
				"SJM" => "Svalbard and Jan Mayen Islands",
				"SWZ" => "Swaziland",
				"SWE" => "Sweden",
				"CHE" => "Switzerland",
				"SYR" => "Syrian Arab Republic",
				"TWN" => "Taiwan Province of China",
				"TJK" => "Tajikistan",
				"THA" => "Thailand",
				"MKD" => "The former Yugoslav Republic of Macedonia",
				"TGO" => "Togo",
				"TKL" => "Tokelau",
				"TON" => "Tonga",
				"TTO" => "Trinidad and Tobago",
				"TUN" => "Tunisia",
				"TUR" => "Turkey",
				"TKM" => "Turkmenistan",
				"TCA" => "Turks and Caicos Islands",
				"TUV" => "Tuvalu",
				"UGA" => "Uganda",
				"UKR" => "Ukraine",
				"ARE" => "United Arab Emirates",
				"TZA" => "United Republic of Tanzania",
				"USA" => "United States of America",
				"UMI" => "United States of America Minor Outlying Islands",
				"URY" => "Uruguay",
				"UZB" => "Uzbekistan",
				"VUT" => "Vanuatu",
				"VEN" => "Venezuela",
				"VNM" => "Viet Nam",
				"VGB" => "Virgin Islands (Great Britian)",
				"VIR" => "Virgin Islands (United States)",
				"WLF" => "Wallis and Futuna Islands",
				"ESH" => "Western Sahara",
				"YEM" => "Yemen",
				"ZAR" => "Zaire",
				"ZMB" => "Zambia",
				"ZWE" => "Zimbabwe"
			);
		
		$this->non_ISO_3166 = 	
			array(	
				"XBA" => "African Development Bank",	
				"XIM" => "African Export–Import Bank",	
				"XCC" => "Caribbean Community",	
					 /* Caribbean Community or one of its emissaries */	
				"XCO" => "Common Market for Eastern and Southern Africa",	
				"XEC" => "Economic Community of West African States",	
				"EUE" => "European Union",	
				"D"   => "Germany",	
				"XPO" => "International Criminal Police Organization (Interpol)",	
				"IMO" => "International Maritime Organisation",	
				"RKS" => "Kosovo",	
				"XOM" => "Sovereign Military Order of Malta",	
				"WSA" => "World Service Authority World Passport"	
			);
		
		$this->united_nations = 	
			array(	
				"UNK" => "United Nations Interim Administration Mission in Kosovo (UNMIK)",	
				/* Travel document issued by the United Nations Interim Administration Mission in Kosovo (UNMIK) for Resident of Kosovo */	
 				"UNO" => "United Nations Organization Official",
 				"UNA" => "United Nations Organization Specialized Agency Official",	 				"UNA" => "United Nations Organization Specialized Agency Official",
 				"XAA" => "Stateless (per Article 1 of 1954 convention)",
				/* Stateless person, as per the 1954 Convention Relating to the Status of Stateless Persons */		 			
 				"XXB" => "Refugee (per Article 1 of 1951 convention, amended by 1967 protocol)",
				/* Refugee, as per the 1951 Convention Relating to the Status of Refugees */	
 				"XXC" => "Refugee (non-convention)",
				"XXX" => "Unspecified Nationality / Unknown",
 				"UTO" => "Utopian"
 			);
 		
 		$this->british_nationals =  
 			array(
				"GBR" => "United Kingdom of Great Britain and Northern Ireland Citizen",
				/* British National (Proper) */
				"GBD" => "United Kingdom of Great Britain and Northern Ireland Dependent Territories Citizen",		
				/* British Overseas Territories Citizen (BOTC) */
				"GBN" => "United Kingdom of Great Britain and Northern Ireland National (Overseas)",		
				/* British National (Overseas) */
				"GBO" => "United Kingdom of Great Britain and Northern Ireland Oversees Citizen",					
				/* British Overseas Citizen */	
				"GBP" => "United Kingdom of Great Britain and Northern Ireland Protected Person",	
				/* British Protected Person */	
				"GBS" => "United Kingdom of Great Britain and Northern Ireland Subject",	
				/* British Subject */	
 			);
		
		$this->EU_Countries = 
			array(
				"FRA" => "France",
			);
		
		$this->EU_additional_org = 
			array(
				'XPO' => 'Interpol',
				'IMO' => 'International Maritime Organisation',
			);
		
		$this->countries = array_merge(
			$this->countries, 
			$this->non_ISO_3166,
			$this->united_nations,
			$this->british_nationals,
			$this->EU_Countries, 
			$this->EU_additional_org
		);
		
    	// # Check Digit Weight
		$this->checkDigitValues = 
			array(
				"<" => "0",
				"A" => "10", "B" => "11", "C" => "12", "D" => "13", "E" => "14",
				"F" => "15", "G" => "16", "H" => "17", "I" => "18", "J" => "19",
				"K" => "20", "L" => "21", "M" => "22", "N" => "23", "O" => "24",
				"P" => "25", "Q" => "26", "R" => "27", "S" => "28", "T" => "29",
				"U" => "30", "V" => "31", "W" => "32", "X" => "33", "Y" => "34",
				"Z" => "35"
			);
			
	}
	
	private function returnCountryName($str) {
        return ( array_key_exists($str, $this->countries) ) ? $this->countries[$str] : "Unknown Country";
    }
    
    #   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
    
    private function returnCheckDigitValues($str) {
        return $this->checkDigitValues[$str];
    }
    
 	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #

	private function stripPadding($str) {

		if (!$str || $str == null) {
	
			return $str;
		
		} else {

                        $return = trim(preg_replace('/</', ' ', $str));
                        $return = preg_replace('/\s+/', ' ', $return); // strip double whitespaces
                        return $return;

		}
	
	}

	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	
	private function getNames($str) {
		$names             = explode('<<', $str);
		$name['lastName']  = $this->stripPadding($names[0]);
		$name['firstName'] = $this->stripPadding($names[1]);
		return $name;
	}
	
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	
	/**
	 * Get the full date value for the shortened date specified and also take
	 * into account the 19xx/20xx centennial into account when calculating the
	 * correct year value to return.
	 *
	 * t = 1 > Date of Birth
	 * t = 2 > Expiry Date
	 */
 
	private function getFullDate($str, $t) {
		
		$d = date('YY') + 11; // Documents are valid for 10 years and 9 months max after being issued.
		$centennial = substr($d, 2, 2);
		
		$year = ($t == 1) ? 
					( (substr($str, 0, 2) > $centennial) ? '19' . substr($str, 0, 2) : '20' . substr($str, 0, 2) )
					:
					( (substr($str, 0, 2) < $centennial) ? '19' . substr($str, 0, 2) : '20' . substr($str, 0, 2) );
	
		$date = substr($str, 4, 2) . '/' . substr($str, 2, 2) . '/' . $year;

		return $date;
	}
	
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #

	/**
	 * Get the gender/sex of the person using the sex/gender character specified.
	 *
	 * @param str The gender/sex character
	 * @returns {{abbr: *, full: *}} - The abbreviation (character) and the full gender/sex text
	 * @private
	 */
	private function getSex($str) {

		if ($str == 'M') {
			$sex['abbr'] = 'M';
			$sex['full'] = 'Male';
		} else if ($str == 'F') {
			$sex['abbr'] = 'F';
			$sex['full'] = 'Female';
		} else {
			$sex['abbr'] = 'X';
			$sex['full'] = 'Unspecified';
		}
	
		return $sex;
	
	}

	/**
	 * Get the country/territory name using the ISO code of the nationality value.
	 *
	 * @param str The ISO code of the Country/Territory
	 * @returns {{abbr: *, full: *}} - The abbreviation (ISO) and the full country/territory name
	 * @private
	 */
	private function getCountry($str) {

		try {
	
			$region['abbr'] = $str;
			$region['full'] = $this->returnCountryName($str);
			return $region;
		
		} catch (Exception  $err) {
			return('Invalid region');
		}
	
	}

	/**
	 * Performs the verification of the string to match the check digit.
	 * This is used to check the validity of the value of the string to check for any counter-fit issues.
	 *
	 * @param str The value to perform the validation on
	 * @param digit The value of the check digit which is to be compared to the result of the algorithm
	 * @returns {boolean} Whether the computed result of the value specified matches the check digit value
	 * @private
	 */
	private function checkDigitVerify($str, $digit) {

		$nmbrs     = array();
		$weighting = array(7, 3, 1);
	
		for ($i = 0; $i < strlen($str); $i++) {
	
			if ( preg_match('/[A-Za-z<]/', $str[$i], $match) ) {
				array_push( $nmbrs, $this->returnCheckDigitValues( $str[$i] ) );
			} else {
				array_push( $nmbrs, (int)$str[$i] );
			}
		
		}

		$curWeight = 0;
		$total     = 0;
	
		for ($j = 0; $j < count($nmbrs); $j++) {
			$total += $nmbrs[$j] * $weighting[$curWeight];
			$curWeight++;
			if ($curWeight == 3) {
				$curWeight = 0;
			}
		}

		return $total % 10 == $digit;
	
	}
    
    #   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	
	/**
	 * Parser of Passport MRZ strings. The machine readable zone on a passport has
	 * 2 lines, each consisting of 44 characters. Below a reference to the format:
	 *   01 - 02: Document code
	 *   03 - 05: Issuing state or organisation
	 *   06 - 44: Names
	 *   45 - 53: Document number
	 *   54 - 54: Check digit
	 *   55 - 57: Nationality
	 *   58 - 63: Date of birth
	 *   64 - 64: Check digit
	 *   65 - 65: Sex
	 *   66 - 71: Date of expiry
	 *   72 - 72: Check digit
	 *   73 - 86: Personal number
	 *   87 - 87: Check digit
	 *   88 - 88: Check digit
	 *
	 * @author Craig Newton <newtondev@gmail.com>
	 */
	 
	private function parseMRZPassport($mrz) {
	
		try {
		
			$documentCode      = substr($mrz, 0, 1);
	
			$issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );
			
			$names              = $this->getNames( substr($mrz, 5, 39) );
			
			$documentNumberRaw  = substr($mrz, 44, 9); 
			$documentNumber     = $this->stripPadding( $documentNumberRaw );
			$checkDigit1        = substr($mrz, 53, 1);
			$checkDigitVerify1  = $this->checkDigitVerify( $documentNumberRaw, $checkDigit1 );
			
			$nationality        = $this->getCountry( $this->stripPadding( substr($mrz, 54, 3) ) );
			
			$dobRaw             = substr($mrz, 57, 6);
			$dob                = $this->getFullDate( $this->stripPadding( $dobRaw), 1 );
			$checkDigit2        = substr($mrz, 63, 1);
			$checkDigitVerify2  = $this->checkDigitVerify( $dobRaw, $checkDigit2 );
			
			$sex                = $this->getSex( $this->stripPadding( substr($mrz, 64, 1) ) );
			$expiryRaw          = substr($mrz, 65, 6);
			$expiry             = $this->getFullDate( $this->stripPadding( $expiryRaw ), 2 );
		
			$checkDigit3        = $this->stripPadding( substr($mrz, 71, 1) );
			$checkDigitVerify3  = $this->checkDigitVerify( $expiryRaw, $checkDigit3 );
		
			$personalNumberRaw  = substr($mrz, 72, 14);
			$personalNumber     = $this->stripPadding( $personalNumberRaw );
			$checkDigit4        = substr($mrz, 86, 1);
			$checkDigitVerify4  = $this->checkDigitVerify( $personalNumberRaw, $checkDigit4);
		
			$finalCheckDigitRaw = $documentNumberRaw . $checkDigit1 . 
								  $dobRaw . $checkDigit2 . 
								  $expiryRaw . $checkDigit3 . 
								  $personalNumberRaw . $checkDigit4;
			$checkDigit5        = substr($mrz, 87, 1);
			$checkDigitVerify5  = $this->checkDigitVerify( $finalCheckDigitRaw, $checkDigit5);
	
			$passport['documentCode']     = substr($mrz, 0, 1);
			$passport['documentType']     = ($documentCode == 'P') ? 'PASSPORT' : 'UNKNOWN';
			$passport['issuerOrg']        = $issuerOrg;
			$passport['names']            = $names;
			$passport['documentNumber']   = $documentNumber;
			$passport['nationality']      = $nationality;
			$passport['dob']              = $dob;
			$passport['sex']              = $sex;
			$passport['expiry']           = $expiry;
			$passport['personalNumber']   = $personalNumber;
		
			$passport['checkDigit']['documentNumber']['checkDigit1']       = $checkDigit1;
			$passport['checkDigit']['documentNumber']['checkDigitVerify1'] = $checkDigitVerify1;
		
			$passport['checkDigit']['dob']['checkDigit2']       = $checkDigit2;
			$passport['checkDigit']['dob']['checkDigitVerify2'] = $checkDigitVerify2;
		
			$passport['checkDigit']['expiry']['checkDigit3']       = $checkDigit3;
			$passport['checkDigit']['expiry']['checkDigitVerify3'] = $checkDigitVerify3;
		
			$passport['checkDigit']['personalNumber']['checkDigit4']       = $checkDigit4;
			$passport['checkDigit']['personalNumber']['checkDigitVerify4'] = $checkDigitVerify4;
		
			$passport['checkDigit']['finalCheck']['checkDigit5']       = $checkDigit5;
			$passport['checkDigit']['finalCheck']['checkDigitVerify5'] = $checkDigitVerify5;
		
			$passport['mrzisvalid'] = $checkDigitVerify1 && $checkDigitVerify2 && $checkDigitVerify3 && $checkDigitVerify4 && $checkDigitVerify5;
		
			return $passport;
		}
		
		catch (Exception $e) {
			$error['error'] = 'Details parsing failed. ' . $e;
			return $error;
		}
		
	}
	
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	
	/**
	 * Parser of ID-1 MRZ strings. The machine readable zone on a identity card has
	 * 3 lines, each consisting of 30 characters. Below a reference to the format:
	 * Parser of "travel document type 1" (td1) documents. Below a reference to the format:
	 *
	 *   01 - 02: Document code
	 *   03 - 05: Issuing state or organization
	 *   06 - 14: Document number
	 *   15 - 15: Check digit
	 *   16 - 30: Optional data (personal number); 30 normally being check digit
	 *   31 - 36: Date of birth
	 *   37 - 37: Check digit of 31-36
	 *   38 - 38: Sex
	 *   39 - 44: Date of expiry
	 *   45 - 45: Check digit
	 *   46 - 48: Nationality
	 *   49 - 59: Optional data
	 *   60 - 60: Check digit over 01 - 59
	 *   61 - 90: Name
	 *
	 */
	 
	private function parseMRZID1($mrz) {
	
		try {
		
			$documentCode1      = substr($mrz, 0, 1);
			$documentCode2      = substr($mrz, 1, 1);
	
			$issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );
			
			$documentNumberRaw  = substr($mrz, 5, 9); 
			$documentNumber     = $this->stripPadding( $documentNumberRaw );
			$checkDigit1        = substr($mrz, 14, 1);
			$checkDigitVerify1  = $this->checkDigitVerify( $documentNumberRaw, $checkDigit1 );
			
			$optionalData       = $this->stripPadding( substr($mrz, 15, 15) );
			
			$dobRaw             = substr($mrz, 30, 6);
			$dob                = $this->getFullDate( $this->stripPadding( $dobRaw), 1 );
			$checkDigit2        = substr($mrz, 36, 1);
			$checkDigitVerify2  = $this->checkDigitVerify( $dobRaw, $checkDigit2 );
			
			$sex                = $this->getSex( $this->stripPadding( substr($mrz, 37, 1) ) );
			
			$expiryRaw          = substr($mrz, 38, 6);
			$expiry             = $this->getFullDate( $this->stripPadding( $expiryRaw ), 2 );
		
			$checkDigit3        = $this->stripPadding( substr($mrz, 44, 1) );
			$checkDigitVerify3  = $this->checkDigitVerify( $expiryRaw, $checkDigit3 );
			
			$nationality        = $this->getCountry( $this->stripPadding( substr($mrz, 45, 3) ) );
			
			$optionalData2      = $this->stripPadding( substr($mrz, 48, 11) );
		
			$finalCheckDigitRaw = $documentNumberRaw . $checkDigit1 . $dobRaw . $checkDigit2 . $expiryRaw . $checkDigit3 . $optionalData2;
			$checkDigit4        = substr($mrz, 59, 1);
			$checkDigitVerify4  = $this->checkDigitVerify( $finalCheckDigitRaw, $checkDigit4);
			
			$names              = $this->getNames( substr($mrz, 60, 30) );
	
			$id['documentCode']     = substr($mrz, 0, 1);
			$id['documentType']     = 'Travel Document TD-1';
			$id['documentType']    .= ($documentCode2 == 'R') ? ' Residence Card' : '';
			$id['issuerOrg']        = $issuerOrg;
			$id['names']            = $names;
			$id['documentNumber']   = $documentNumber;
			$id['optionalData']     = $optionalData;
			$id['optionalData2']    = $optionalData2;
			$id['nationality']      = $nationality;
			$id['dob']              = $dob;
			$id['sex']              = $sex;
			$id['expiry']           = $expiry;
		
			$id['checkDigit']['documentNumber']['checkDigit1']       = $checkDigit1;
			$id['checkDigit']['documentNumber']['checkDigitVerify1'] = $checkDigitVerify1;
		
			$id['checkDigit']['dob']['checkDigit2']       = $checkDigit2;
			$id['checkDigit']['dob']['checkDigitVerify2'] = $checkDigitVerify2;
		
			$id['checkDigit']['expiry']['checkDigit3']       = $checkDigit3;
			$id['checkDigit']['expiry']['checkDigitVerify3'] = $checkDigitVerify3;
		
			$id['checkDigit']['finalCheck']['checkDigit4']       = $checkDigit4;
			$id['checkDigit']['finalCheck']['checkDigitVerify4'] = $checkDigitVerify4;
		
			$id['mrzisvalid'] = $checkDigitVerify1 && $checkDigitVerify2 && $checkDigitVerify3 && $checkDigitVerify4;
		
			return $id;
		}
		
		catch (Exception $e) {
			$error['error'] = 'Details parsing failed. ' . $e;
			return $error;
		}
		
	}
	
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	
	/**
	 * 
	 * Reference : https://en.wikipedia.org/wiki/National_identity_card_(France)#Machine-readable_zone
	 * Formatted to permit future addition if other EU countries also have similar MRZ format.
	 * 
	 */
	 
	private function parseMRZID_EU($mrz) {
	
		try {
		
			$documentCode1      = substr($mrz, 0, 1);
			$documentCode2      = substr($mrz, 1, 1);
	
			$issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );
			
			$lastNameRaw        = substr($mrz, 5, 25); 
			$lastName           = $this->stripPadding( $lastNameRaw );

			$documentNumberRaw  = substr($mrz, 36, 12);
            		$documentNumber     = $this->stripPadding( $documentNumberRaw );
			
			$IDcardNumberRaw    = substr($mrz, 30, 3); 
			$IDcardNumber       = $this->stripPadding( $IDcardNumberRaw );
			$issuanceOffice1Raw = substr($mrz, 33, 3); 
			$issuanceOffice1    = $this->stripPadding( $issuanceOffice1Raw );
		
			$issueYearRaw       = substr($mrz, 36, 2); 
			$issueYear          = $this->stripPadding( $issueYearRaw );
			$issueMonthRaw      = substr($mrz, 38, 2); 
			$issueMonth         = $this->stripPadding( $issueMonthRaw );
			
			$issuanceOffice2Raw = substr($mrz, 40, 3); 
			$issuanceOffice2    = $this->stripPadding( $issuanceOffice2Raw );
			
			$assignment1Raw     = substr($mrz, 43, 5); 
			$assignment1        = $this->stripPadding( $assignment1Raw );
			
			$checkDigit1        = substr($mrz, 48, 1);
			$checkDigitVerify1  = $this->checkDigitVerify( substr($mrz, 36, 12), $checkDigit1 );
			
			$firstNameRaw       = substr($mrz, 49, 14); 
			$firstName          = $this->stripPadding( $firstNameRaw );
			
			$dobRaw             = substr($mrz, 63, 6);
			$dob                = $this->getFullDate( $this->stripPadding( $dobRaw), 1 );
			$checkDigit2        = substr($mrz, 69, 1);
			$checkDigitVerify2  = $this->checkDigitVerify( $dobRaw, $checkDigit2 );
			
			$sex                = $this->getSex( $this->stripPadding( substr($mrz, 70, 1) ) );
		
			$checkDigit3        = $this->stripPadding( substr($mrz, 71, 1) );
			$checkDigitVerify3  = $this->checkDigitVerify( substr($mrz, 0, 71), $checkDigit3 );
	
			$id['documentCode']     = substr($mrz, 0, 1);
			$id['documentType']     = 'Travel Document TD-1';
			$id['documentType']    .= ($documentCode2 == 'D') ? ' Identity Card' : '';
			$id['issuerOrg']        = $issuerOrg;
			$id['names']['lastName']         = $lastName;
			$id['names']['firstName']        = $firstName;
			$id['IDcardNumber']     = $IDcardNumber;
			$id['issuanceOffice1']  = $issuanceOffice1;
			$id['issuanceOffice2']  = $issuanceOffice2;
			$id['documentNumber']   = $documentNumber;
			$id['issueYear']        = $issueYear;
			$id['issueMonth']       = $issueMonth;
			$id['assignment1']      = $assignment1;
			$id['dob']              = $dob;
			$id['sex']              = $sex;
		
			$id['checkDigit']['documentNumber']['checkDigit1']       = $checkDigit1;
			$id['checkDigit']['documentNumber']['checkDigitVerify1'] = $checkDigitVerify1;
		
			$id['checkDigit']['dob']['checkDigit2']       = $checkDigit2;
			$id['checkDigit']['dob']['checkDigitVerify2'] = $checkDigitVerify2;
		
			$id['checkDigit']['finalCheck']['checkDigit4']       = $checkDigit3;
			$id['checkDigit']['finalCheck']['checkDigitVerify4'] = $checkDigitVerify3;
		
			$id['mrzisvalid'] = $checkDigitVerify1 && $checkDigitVerify2 && $checkDigitVerify3;
		
			return $id;
		}
		
		catch (Exception $e) {
			$error['error'] = 'Details parsing failed. ' . $e;
			return $error;
		}
		
	}
	
	
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	
	/**
	 * Parser of ID-2Visa MRZ strings. The machine readable zone on a visa has
	 * 2 lines, each consisting of 36 characters. Below a reference to the format:
	 *   01 - 01: Document code
	 *   02 - 02: Visa Type
	 *   03 - 05: Issuing state or organisation
	 *   06 - 35: Names
	 *
	 */
	 
	private function parseMRZVisa($mrz) {
	
		try {
		
			$documentCode1     = substr($mrz, 0, 1);
			$documentCode2     = substr($mrz, 1, 1);
	
			$issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );
			
			$names              = $this->getNames( substr($mrz, 5, 31) );
			
			$documentNumberRaw  = substr($mrz, 36, 9); 
			$documentNumber     = $this->stripPadding( $documentNumberRaw );
			$checkDigit1        = substr($mrz, 45, 1);
			$checkDigitVerify1  = $this->checkDigitVerify( $documentNumberRaw, $checkDigit1 );
			
			$nationality        = $this->getCountry( $this->stripPadding( substr($mrz, 46, 3) ) );
			
			$dobRaw             = substr($mrz, 49, 6);
			$dob                = $this->getFullDate( $this->stripPadding( $dobRaw), 1 );
			$checkDigit2        = substr($mrz, 55, 1);
			$checkDigitVerify2  = $this->checkDigitVerify( $dobRaw, $checkDigit2 );
			
			$sex                = $this->getSex( $this->stripPadding( substr($mrz, 56, 1) ) );
			
			$expiryRaw          = substr($mrz, 57, 6);
			$expiry             = $this->getFullDate( $this->stripPadding( $expiryRaw ), 2 );
		
			$checkDigit3        = $this->stripPadding( substr($mrz, 63, 1) );
			$checkDigitVerify3  = $this->checkDigitVerify( $expiryRaw, $checkDigit3 );
			
			$optionalData       = substr($mrz, 64, 8);
			
			$id['documentCode']     = substr($mrz, 0, 1);
			$id['documentType']     = ($documentCode1 == 'V') ? 'ID-2 Visa' : 'UNKNOWN';
			$id['VisaType']         = $documentCode2;
			$id['issuerOrg']        = $issuerOrg;
			$id['names']            = $names;
			
			$id['documentNumber']   = $documentNumber;
			$id['checkDigit']['documentNumber']['checkDigit1']       = $checkDigit1;
			$id['checkDigit']['documentNumber']['checkDigitVerify1'] = $checkDigitVerify1;
			
			$id['nationality']      = $nationality;
			
			$id['dob']              = $dob;
			$id['checkDigit']['passport']['checkDigit2']       = $checkDigit2;
			$id['checkDigit']['passport']['checkDigitVerify2'] = $checkDigitVerify2;
			
			$id['sex']              = $sex;
			
			$id['expiry']           = $expiry;
			$id['checkDigit']['expiry']['checkDigit3']       = $checkDigit3;
			$id['checkDigit']['expiry']['checkDigitVerify3'] = $checkDigitVerify3;
		
			$id['optionalData']     = $optionalData;
			
			$id['mrzisvalid'] = $checkDigitVerify1 && $checkDigitVerify2 && $checkDigitVerify3;
		
			return $id;
		}
		
		catch (Exception $e) {
			$error['error'] = 'Details parsing failed. ' . $e;
			return $error;
		}
		
	}
	
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
	#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
    
    public function parseMRZ($mrz) {

		$mrz = str_replace(array("\n\r", "\n", "\r"), "", $mrz);

		if ($mrz == null || (strlen($mrz) != 88  && strlen($mrz) != 90  && strlen($mrz) != 72) ) {
			$error['error'] = 'Invalid MRZ length for ICAO document.';
			return $error;
		}

		$documentCode = $this->stripPadding( substr($mrz, 0, 1) );
		
		switch ($documentCode) {
		
			case 'P' : return $this->parseMRZPassport($mrz); break;
			
			case 'I' : case 'A' : case 'C' : 

						if ( array_key_exists(substr(substr($mrz, 0, 5), 2, 3), $this->EU_Countries) ) {
							return $this->parseMRZID_EU($mrz); 
							break;
						}
							
					  	return $this->parseMRZID1($mrz); break;
			
			case 'V' : return $this->parseMRZVisa($mrz); break;
			
			default  : 
						$error['error'] = 'Unknown document.';
					 	return $error;
					 	
		}
		
	}
	
}

#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
