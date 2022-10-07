<?php

# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = File Name  | mrz.php
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = File Date  | 28/01/2017
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = Version    | 1.0
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = Notes      | Halim Rahman Minai
# =            | halim@ebyx.net
# =            |
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# = Revision   |
# =            |
# =            |
# =            |
# =            |
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =
# =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =  =

class SolidusMRZ {

    private $countries;
    private $EU_additional_org;
    private $checkDigitValues;

    function __construct() {

        // # ISO 3166 alpha-3 codes
        // # Source: https://www.iso.org/iso-3166-country-codes.html
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
                "BHS" => "Bahamas (the)",
                "BHR" => "Bahrain",
                "BGD" => "Bangladesh",
                "BRB" => "Barbados",
                "BLR" => "Belarus",
                "BEL" => "Belgium",
                "BLZ" => "Belize",
                "BEN" => "Benin",
                "BMU" => "Bermuda",
                "BTN" => "Bhutan",
                "BOL" => "Bolivia (Plurinational State of)",
                "BES" => "Bonaire, Sint Eustatius and Saba",
                "BIH" => "Bosnia and Herzegovina",
                "BWA" => "Botswana",
                "BVT" => "Bouvet Island",
                "BRA" => "Brazil",
                "IOT" => "British Indian Ocean Territory (the)",
                "BRN" => "Brunei Darussalam",
                "BGR" => "Bulgaria",
                "BFA" => "Burkina Faso",
                "BDI" => "Burundi",
                "CPV" => "Cabo Verde",
                "KHM" => "Cambodia",
                "CMR" => "Cameroon",
                "CAN" => "Canada",
                "CYM" => "Cayman Islands (the)",
                "CAF" => "Central African Republic (the)",
                "TCD" => "Chad",
                "CHL" => "Chile",
                "CHN" => "China",
                "CXR" => "Christmas Island",
                "CCK" => "Cocos (Keeling) Islands (the)",
                "COL" => "Colombia",
                "COM" => "Comoros (the)",
                "COD" => "Congo (the Democratic Republic of the)",
                "COG" => "Congo (the)",
                "COK" => "Cook Islands (the)",
                "CRI" => "Costa Rica",
                "HRV" => "Croatia",
                "CUB" => "Cuba",
                "CUW" => "Curaçao",
                "CYP" => "Cyprus",
                "CZE" => "Czechia",
                "CIV" => "Côte d'Ivoire",
                "DNK" => "Denmark",
                "DJI" => "Djibouti",
                "DMA" => "Dominica",
                "DOM" => "Dominican Republic (the)",
                "ECU" => "Ecuador",
                "EGY" => "Egypt",
                "SLV" => "El Salvador",
                "GNQ" => "Equatorial Guinea",
                "ERI" => "Eritrea",
                "EST" => "Estonia",
                "SWZ" => "Eswatini",
                "ETH" => "Ethiopia",
                "FLK" => "Falkland Islands (the) [Malvinas]",
                "FRO" => "Faroe Islands (the)",
                "FJI" => "Fiji",
                "FIN" => "Finland",
                "FRA" => "France",
                "GUF" => "French Guiana",
                "PYF" => "French Polynesia",
                "ATF" => "French Southern Territories (the)",
                "GAB" => "Gabon",
                "GMB" => "Gambia (the)",
                "GEO" => "Georgia",
                "DEU" => "Germany",
                "GHA" => "Ghana",
                "GIB" => "Gibraltar",
                "GRC" => "Greece",
                "GRL" => "Greenland",
                "GRD" => "Grenada",
                "GLP" => "Guadeloupe",
                "GUM" => "Guam",
                "GTM" => "Guatemala",
                "GGY" => "Guernsey",
                "GIN" => "Guinea",
                "GNB" => "Guinea-Bissau",
                "GUY" => "Guyana",
                "HTI" => "Haiti",
                "HMD" => "Heard Island and McDonald Islands",
                "VAT" => "Holy See (the)",
                "HND" => "Honduras",
                "HKG" => "Hong Kong",
                "HUN" => "Hungary",
                "ISL" => "Iceland",
                "IND" => "India",
                "IDN" => "Indonesia",
                "IRN" => "Iran (Islamic Republic of)",
                "IRQ" => "Iraq",
                "IRL" => "Ireland",
                "IMN" => "Isle of Man",
                "ISR" => "Israel",
                "ITA" => "Italy",
                "JAM" => "Jamaica",
                "JPN" => "Japan",
                "JEY" => "Jersey",
                "JOR" => "Jordan",
                "KAZ" => "Kazakhstan",
                "KEN" => "Kenya",
                "KIR" => "Kiribati",
                "PRK" => "Korea (the Democratic People's Republic of)",
                "KOR" => "Korea (the Republic of)",
                "KWT" => "Kuwait",
                "KGZ" => "Kyrgyzstan",
                "LAO" => "Lao People's Democratic Republic (the)",
                "LVA" => "Latvia",
                "LBN" => "Lebanon",
                "LSO" => "Lesotho",
                "LBR" => "Liberia",
                "LBY" => "Libya",
                "LIE" => "Liechtenstein",
                "LTU" => "Lithuania",
                "LUX" => "Luxembourg",
                "MAC" => "Macao",
                "MDG" => "Madagascar",
                "MWI" => "Malawi",
                "MYS" => "Malaysia",
                "MDV" => "Maldives",
                "MLI" => "Mali",
                "MLT" => "Malta",
                "MHL" => "Marshall Islands (the)",
                "MTQ" => "Martinique",
                "MRT" => "Mauritania",
                "MUS" => "Mauritius",
                "MYT" => "Mayotte",
                "MEX" => "Mexico",
                "FSM" => "Micronesia (Federated States of)",
                "MDA" => "Moldova (the Republic of)",
                "MCO" => "Monaco",
                "MNG" => "Mongolia",
                "MNE" => "Montenegro",
                "MSR" => "Montserrat",
                "MAR" => "Morocco",
                "MOZ" => "Mozambique",
                "MMR" => "Myanmar",
                "NAM" => "Namibia",
                "NRU" => "Nauru",
                "NPL" => "Nepal",
                "NLD" => "Netherlands (the)",
                "NCL" => "New Caledonia",
                "NZL" => "New Zealand",
                "NIC" => "Nicaragua",
                "NER" => "Niger (the)",
                "NGA" => "Nigeria",
                "NIU" => "Niue",
                "NFK" => "Norfolk Island",
                "MKD" => "North Macedonia",
                "MNP" => "Northern Mariana Islands (the)",
                "NOR" => "Norway",
                "OMN" => "Oman",
                "PAK" => "Pakistan",
                "PLW" => "Palau",
                "PSE" => "Palestine, State of",
                "PAN" => "Panama",
                "PNG" => "Papua New Guinea",
                "PRY" => "Paraguay",
                "PER" => "Peru",
                "PHL" => "Philippines (the)",
                "PCN" => "Pitcairn",
                "POL" => "Poland",
                "PRT" => "Portugal",
                "PRI" => "Puerto Rico",
                "QAT" => "Qatar",
                "ROU" => "Romania",
                "RUS" => "Russian Federation (the)",
                "RWA" => "Rwanda",
                "REU" => "Réunion",
                "BLM" => "Saint Barthélemy",
                "SHN" => "Saint Helena, Ascension and Tristan da Cunha",
                "KNA" => "Saint Kitts and Nevis",
                "LCA" => "Saint Lucia",
                "MAF" => "Saint Martin (French part)",
                "SPM" => "Saint Pierre and Miquelon",
                "VCT" => "Saint Vincent and the Grenadines",
                "WSM" => "Samoa",
                "SMR" => "San Marino",
                "STP" => "Sao Tome and Principe",
                "SAU" => "Saudi Arabia",
                "SEN" => "Senegal",
                "SRB" => "Serbia",
                "SYC" => "Seychelles",
                "SLE" => "Sierra Leone",
                "SGP" => "Singapore",
                "SXM" => "Sint Maarten (Dutch part)",
                "SVK" => "Slovakia",
                "SVN" => "Slovenia",
                "SLB" => "Solomon Islands",
                "SOM" => "Somalia",
                "ZAF" => "South Africa",
                "SGS" => "South Georgia and the South Sandwich Islands",
                "SSD" => "South Sudan",
                "ESP" => "Spain",
                "LKA" => "Sri Lanka",
                "SDN" => "Sudan (the)",
                "SUR" => "Suriname",
                "SJM" => "Svalbard and Jan Mayen",
                "SWE" => "Sweden",
                "CHE" => "Switzerland",
                "SYR" => "Syrian Arab Republic (the)",
                "TWN" => "Taiwan (Province of China)",
                "TJK" => "Tajikistan",
                "TZA" => "Tanzania, the United Republic of",
                "THA" => "Thailand",
                "TLS" => "Timor-Leste",
                "TGO" => "Togo",
                "TKL" => "Tokelau",
                "TON" => "Tonga",
                "TTO" => "Trinidad and Tobago",
                "TUN" => "Tunisia",
                "TUR" => "Turkey",
                "TKM" => "Turkmenistan",
                "TCA" => "Turks and Caicos Islands (the)",
                "TUV" => "Tuvalu",
                "UGA" => "Uganda",
                "UKR" => "Ukraine",
                "ARE" => "United Arab Emirates (the)",
                "GBR" => "United Kingdom of Great Britain and Northern Ireland (the)",
                "UMI" => "United States Minor Outlying Islands (the)",
                "USA" => "United States of America (the)",
                "URY" => "Uruguay",
                "UZB" => "Uzbekistan",
                "VUT" => "Vanuatu",
                "VEN" => "Venezuela (Bolivarian Republic of)",
                "VNM" => "Viet Nam",
                "VGB" => "Virgin Islands (British)",
                "VIR" => "Virgin Islands (U.S.)",
                "WLF" => "Wallis and Futuna",
                "ESH" => "Western Sahara*",
                "YEM" => "Yemen",
                "ZMB" => "Zambia",
                "ZWE" => "Zimbabwe",
                "ALA" => "Åland Islands"
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
                "UNA" => "United Nations Organization Specialized Agency Official",
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

        $this->countries = array_merge(
            $this->countries,
            $this->non_ISO_3166,
            $this->united_nations,
            $this->british_nationals
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
     * Parser of Passport MRZ strings.
     * 
     * Size 3 Machine Readable Travel Documents (TD3)
     * Specified in Part 4 of ICAO Doc 9303
     * https://www.icao.int/publications/pages/publication.aspx?docnum=9303
     * 
     * The machine readable zone on a passport has
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
     * Parser of ID-1 MRZ strings.
     * 
     * Size 1 Machine Readable Travel Documents (TD1)
     * Specified in Part 5 of ICAO Doc 9303
     * https://www.icao.int/publications/pages/publication.aspx?docnum=9303
     * 
     * The machine readable zone on a identity card has
     * 3 lines, each consisting of 30 characters. Below a reference to the format:
     *   01 - 01: Document code
     *   02 - 02: Document type
     *   03 - 05: Issuing state or organisation
     *   06 - 14: Document number
     *   15 - 15: Check digit
     *   16 - 30: Optional data
     *   31 - 36: Date of birth
     *   37 - 37: Check digit
     *   38 - 38: Sex
     *   39 - 44: Date of expiry
     *   45 - 45: Check digit
     *   46 - 48: Nationality
     *   49 - 59: Optional data 2
     *   60 - 60: Composite check digit
     *   61 - 90: Name
     *
     */

    private function parseMRZID1($mrz) {

        try {

            $documentCode1     = substr($mrz, 0, 1);
            $documentCode2     = substr($mrz, 1, 1);

            $issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );

            $documentNumberRaw  = substr($mrz, 5, 9);
            $documentNumber     = $this->stripPadding( $documentNumberRaw );
            $checkDigit1        = substr($mrz, 14, 1);
            $checkDigitVerify1  = $this->checkDigitVerify( $documentNumberRaw, $checkDigit1 );

            $optionalDataRaw    = substr($mrz, 15, 15);
            $optionalData       = $this->stripPadding( $optionalDataRaw );

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

            $optionalData2Raw   = substr($mrz, 48, 11);
            $optionalData2      = $this->stripPadding( $optionalData2Raw );

            $finalCheckDigitRaw = $documentNumberRaw . $checkDigit1 . $optionalDataRaw . $dobRaw . $checkDigit2 . $expiryRaw . $checkDigit3 . $optionalData2Raw;
            $checkDigit4        = substr($mrz, 59, 1);
            $checkDigitVerify4  = $this->checkDigitVerify( $finalCheckDigitRaw, $checkDigit4);

            $names              = $this->getNames( substr($mrz, 60, 30) );

            $id['documentCode']     = substr($mrz, 0, 1);
            $id['documentType']     = ($documentCode1 == 'I') ? 'ID-1' : 'UNKNOWN';
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
     * Parser of ID-2 (TD2) Travel Document MRZ strings.
     * 
     * Size 2 Machine Readable Travel Documents (TD2)
     * Specified in Part6 of ICAO Doc 9303
     * https://www.icao.int/publications/pages/publication.aspx?docnum=9303
     * 
     * TD2 MRZ is almost the same as Visa MRV-B, only difference being
     * that TD2 has a final composite checksum
     * 
     * The machine readable zone on a visa has
     * 2 lines, each consisting of 36 characters. Below a reference to the format:
     *   01 - 02: Document code
     *   03 - 05: Issuing state or organisation
     *   06 - 36: Names
     *   37 - 45: Document Number
     *   46 - 46: Check digit
     *   47 - 49: Nationality
     *   50 - 55: Date of birth
     *   56 - 56: Check digit
     *   57 - 57: Sex
     *   58 - 63: Date of expiry
     *   64 - 64: Check digit
     *   65 - 71: Optional data
     *   72 - 72: Composite check digit
     */

    private function parseMRZID2($mrz) {

        try {

            $documentCode1     = substr($mrz, 0, 1);
            $documentCode2     = substr($mrz, 1, 1);

            $issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );

            $names              = $this->getNames( substr($mrz, 5, 31) );

            $documentNumberRaw  = substr($mrz, 36, 9);
            $documentNumber     = $this->stripPadding( $documentNumberRaw );
            $checkDigit1        = substr($mrz, 45, 1);
            $checkDigitVerify1  = $this->checkDigitVerify( $documentNumberRaw, $checkDigit1 );

            $nationalityRaw		= substr($mrz, 46, 3);
            $nationality        = $this->getCountry( $this->stripPadding( $nationalityRaw ) );

            $dobRaw             = substr($mrz, 49, 6);
            $dob                = $this->getFullDate( $this->stripPadding( $dobRaw), 1 );
            $checkDigit2        = substr($mrz, 55, 1);
            $checkDigitVerify2  = $this->checkDigitVerify( $dobRaw, $checkDigit2 );

            $sex                = $this->getSex( $this->stripPadding( substr($mrz, 56, 1) ) );

            $expiryRaw          = substr($mrz, 57, 6);
            $expiry             = $this->getFullDate( $this->stripPadding( $expiryRaw ), 2 );

            $checkDigit3        = $this->stripPadding( substr($mrz, 63, 1) );
            $checkDigitVerify3  = $this->checkDigitVerify( $expiryRaw, $checkDigit3 );

            $optionalData       = $this->stripPadding( substr($mrz, 64, 7) );

            $finalCheckDigitRaw = $documentNumberRaw . $checkDigit1 . $dobRaw . $checkDigit2 . $expiryRaw . $checkDigit3 . $optionalData;
            $checkDigit4        = substr($mrz, 71, 1);
            $checkDigitVerify4  = $this->checkDigitVerify( $finalCheckDigitRaw, $checkDigit4);

            $id['documentCode']     = substr($mrz, 0, 1);
            $id['documentType']     = ($documentCode1 == 'I') ? 'ID-2' : 'UNKNOWN';
            $id['documentType']    .= ($documentCode2 == 'R') ? ' Residence Card' : '';
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
     * Parser for French ID cards.
     * 
     * They have 2 rows of 36 characters, which makes them similar to the ID-2 and MRV-B formats,
     * but the position of the fields is very different
     * https://www.dcode.fr/french-id-card
     * 
     */
    private function parseMRZFrenchID($mrz) {
        try {
            $documentCode1     = substr($mrz, 0, 1);
            $documentCode2     = substr($mrz, 1, 1);

            $issuerOrg          = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );

            $documentNumberRaw  = substr($mrz, 36, 12);
            $documentNumber     = $this->stripPadding( $documentNumberRaw );
            $checkDigit1        = substr($mrz, 48, 1);
            $checkDigitVerify1  = $this->checkDigitVerify( $documentNumberRaw, $checkDigit1 );

            $optionalData       = $this->stripPadding( substr($mrz, 30, 6) );

            $dobRaw             = substr($mrz, 63, 6);
            $dob                = $this->getFullDate( $this->stripPadding( $dobRaw), 1 );
            $checkDigit2        = substr($mrz, 69, 1);
            $checkDigitVerify2  = $this->checkDigitVerify( $dobRaw, $checkDigit2 );

            $sex                = $this->getSex( $this->stripPadding( substr($mrz, 70, 1) ) );

            /*
            // data do not exist

            $expiryRaw          = substr($mrz, 38, 6);
            $expiry             = $this->getFullDate( $this->stripPadding( $expiryRaw ), 2 );
            */

            $checkDigit3        = null; //data missing
            //$checkDigitVerify3  = $this->checkDigitVerify( $expiryRaw, $checkDigit3 );
            $checkDigitVerify3  = 1; //data missing, set to 1

            $nationality        = $this->getCountry( $this->stripPadding( substr($mrz, 2, 3) ) );

            //$optionalData2      = $this->stripPadding( substr($mrz, 48, 11) );

            $finalCheckDigitRaw = substr($mrz, 0, 71);
            $checkDigit4        = $this->stripPadding( substr($mrz, 71, 1) );
            $checkDigitVerify4  = $this->checkDigitVerify( $finalCheckDigitRaw, $checkDigit4);

            $id['documentCode']     = substr($mrz, 0, 1);
            $id['documentType']     = ($documentCode1 == 'I') ? 'ID-1' : 'UNKNOWN';
            $id['documentType']    .= ($documentCode2 == 'R') ? ' Residence Card' : '';
            $id['issuerOrg']        = $issuerOrg;
            $id['names']['lastName']  = $this->stripPadding( substr($mrz, 5, 25) );
            $id['names']['firstName']  = $this->stripPadding( substr($mrz, 49, 14) );
            $id['documentNumber']   = $documentNumber;
            $id['optionalData']     = $optionalData;
            //$id['optionalData2']    = $optionalData2;
            $id['nationality']      = $nationality;
            $id['dob']              = $dob;
            $id['sex']              = $sex;
            //$id['expiry']           = $expiry; // data do not exist

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
     * Parser of MRV-B Visa MRZ strings.
     * 
     * Specified in Part 7 of ICAO Doc 9303
     * https://www.icao.int/publications/pages/publication.aspx?docnum=9303
     * 
     * MRV-B Visa MRZ is almost identical to ID-2, the only difference being
     * it does not have a final composite check digit
     * 
     * The machine readable zone on a visa has
     * 2 lines, each consisting of 36 characters. Below a reference to the format:
     *   01 - 02: Document code
     *   03 - 05: Issuing state or organisation
     *   06 - 36: Names
     *   37 - 45: Document Number
     *   46 - 46: Check digit
     *   47 - 49: Nationality
     *   50 - 55: Date of birth
     *   56 - 56: Check digit
     *   57 - 57: Sex
     *   58 - 63: Date of expiry
     *   64 - 64: Check digit
     *   65 - 72: Optional data
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

            $optionalData       = $this->stripPadding( substr($mrz, 64, 8) );

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
        $len = strlen($mrz);

        if ($mrz == null || ($len != 88  && $len != 90  && $len != 72) ) {
            $error['error'] = 'Invalid MRZ length for ICAO document.';
            return $error;
        }

        $documentCode = $this->stripPadding( substr($mrz, 0, 1) );

        switch ($documentCode) {

            case 'P' : return $this->parseMRZPassport($mrz);

            case 'A' :
            case 'C' :
            case 'I' :
                if ($len == 90) {
                    return $this->parseMRZID1($mrz);
                }
                else if ($len == 72) {
                    if (substr($mrz, 2, 3) == 'FRA') {
                        // special handling for french
                        return $this->parseMRZFrenchID($mrz);
                    }
                    else {
                        // normal ID-2
                        return $this->parseMRZID2($mrz);
                    }
                }
                break;

            case 'V' : return $this->parseMRZVisa($mrz);
        }

        $error['error'] = 'Unknown document.';
        return $error;

    }

}

#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
#   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   =    =    =    =   #
