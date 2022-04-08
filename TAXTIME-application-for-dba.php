<?php

/*
 * Template Name: DBA Application
 * Version: 1.0
 * Description: Overlaying the Application for DBA
 * Author:
 * Author URI:
 * Group: 1. Development
 * Required PDF Version: 4.4.0
 * Toolkit: true
 */

/* Prevent direct access to the template */
if (!class_exists('GFForms')) {
    return;
}

/**
 * Gravity PDF Toolkit templates have access to the following variables
 *
 * @var array  $form      The current Gravity Form array
 * @var array  $entry     The raw entry data
 * @var array  $form_data The processed entry data stored in an array
 * @var object $settings  The current PDF configuration
 * @var array  $fields    An array of Gravity Form fields which can be accessed with their ID number
 * @var array  $config    The initialised template config class – eg. /config/zadani.php
 * @var object $gfpdf     The main Gravity PDF object containing all our helper classes
 * @var array  $args      Contains an array of all variables - the ones being described right now - passed to the template
 */

/**
 * @var GFPDF\Plugins\DeveloperToolkit\Writer\Writer $w    A helper class that does the heavy lifting and PDF manipulation
 * @var \mPDF|\Mpdf\Mpdf|\GFPDF_Vendor\Mpdf\Mpdf      $mpdf The raw Mpdf object
 */

/* -------------------------------------------------------------------------------------------- */
/* GLOBAL VARIABLES */
$pdf_extended_templates = wp_upload_dir();
$pdf_extended_templates_models = $pdf_extended_templates['basedir'] . '/PDF_EXTENDED_TEMPLATES/includes/models/';
$pdf_extended_templates_common = $pdf_extended_templates['basedir'] . '/PDF_EXTENDED_TEMPLATES/includes/common/';
$pdf_extended_templates_sections_decree = $pdf_extended_templates['basedir'] . '/PDF_EXTENDED_TEMPLATES/includes/decree/';

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/* MODEL: Master Entries */
include $pdf_extended_templates_models . 'tax_time_master_entries.php';


/*  Form Specific Variables
--------------------------*/
$selectOption = 'X';
$leaveBlank = '&nbsp;';

$assets = array();

/* -------------------------------------------------------------------------------------------- */
/* Load PDF Styles */

/* -------------------------------------------------------------------------------------------- */
/* SECTION I: General Information  */
/* Variables */

/* Load PDF Styles */
$w->beginStyles();
?>
<style>
/* Helper styles to see the field mapping. Remove when ready. */
.single,
.multi {
  background: rgba(244, 247, 118, 0.5) color: #000;
}
</style>
<?php
$w->endStyles();

/* -------------------------------------------------------------------------------------------- */
/*
 * Begin PDF Generation
 *
 * The API documentation can be found at https://gravitypdf.com/developer-toolkit-api-documentation/
 */
$w->addPdf(__DIR__ . '/pdfs/DBA-application.pdf'); /* CHANGE THIS TO POINT TO YOUR PDF */


/* -------------------------------------------------------------------------------------------- */
/* LOAD: Page 1  */
    $w->addPage(1);

// VARIABLES

//Business Details 
 $businessName =  $master_entries[0][1]; //Name of corporation/LLC/entity etc.
 $businessPurpose = $master_entries[0][2]; //Purpose of corporation
// Mailing Address
 $businessAddress['street'] = $master_entries[0][3]['street']; 
 $businessAddress['street2'] = $master_entries[0][3]['street2']; 
 $businessAddress['city'] = $master_entries[0][3]['city']; 
 $businessAddress['state'] = $master_entries[0][3]['state']; 
 $businessAddress['zip'] = $master_entries[0][3]['zip']; 

    //IF[ street 2 is empty, street will just be 'street', otherwise the street will be 'street' + 'street2']
    if($businessAddress['street2'] == ''){
        $businessAddress['street_full'] = $businessAddress['street'];
    }else{
        $businessAddress['street_full'] = $businessAddress['street'] . ', ' . $businessAddress['street2'];
    }

 $isFemaleOwned = $master_entries[0][4]; //Is this a female owned business?
 $isMinorityOwned = $master_entries[0][401]; //Is this a minority owned business?
 $minoritySpecified = $master_entries[0][402]; //if yes, please specify



//State of incorporation
 $stateOfIncorporation = $master_entries[0][5]; //Always Utah 
//Date of incorporation 
 $dateOfIncorporation = $master_entries[0][6];

// Registered Agent Details 
// Registered agent name
 $registeredAgent['first'] = $master_entries[0][7]['first']; 
 $registeredAgent['middle'] = $master_entries[0][7]['middle'];
 $registeredAgent['last'] = $master_entries[0][7]['last'];

 $registeredAgentName = $registeredAgent['first'] . ' ' . $registeredAgent['middle'] . ' ' . $registeredAgent['last'];
// Registered agent address

 $registeredAgentAddress['street'] = $master_entries[0][8]['street'];
 $registeredAgentAddress['street2'] = $master_entries[0][8]['street2'];
 $registeredAgentAddress['city'] = $master_entries[0][8]['city'];
 $registeredAgentAddress['state'] = $master_entries[0][8]['state']; //Always Utah
 $registeredAgentAddress['zip'] = $master_entries[0][8]['zip'];

    if($registeredAgentAddress['street2'] == ''){
        $registeredAgentAddress['street_full'] = $registeredAgentAddress['street'];
    }else{
        $registeredAgentAddress['street_full'] = $registeredAgentAddress['street'] . ', ' . $registeredAgentAddress['street2'];
    }

/* Applicant/Owner One ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
// Name
 $applicantOneName['first'] = $master_entries[0][36]['first']; 
 $applicantOneName['middle'] = $master_entries[0][36]['middle']; 
 $applicantOneName['last'] = $master_entries[0][36]['last'];  

 $applicantOneNameFull = $applicantOneName['first'] . ' ' . $applicantOneName['middle'] . ' ' . $applicantOneName['last'];
//Entity Number
 $applicantOneEntityNumber = $master_entries[0][37];            

// Address  
 $applicantOneAddress['street'] = $master_entries[0][38]['street']; 
 $applicantOneAddress['street2'] = $master_entries[0][38]['street2']; 
 $applicantOneAddress['city'] = $master_entries[0][38]['city']; 
 $applicantOneAddress['state'] = $master_entries[0][38]['state']; 
 $applicantOneAddress['zip'] = $master_entries[0][38]['zip']; 

    if($applicantOneAddress['street2'] == ''){
        $applicantOneAddress['street_full'] = $applicantOneAddress['street'];
    }else{
        $applicantOneAddress['street_full'] = $applicantOneAddress['street'] . ', ' . $applicantOneAddress['street2'];
    }


 $applicantOneSignature = $master_entries[0][39]; //SIGNATURE

/* Applicant/Owner Two ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
// Name
 $applicantTwoName['first'] = $master_entries[0][40]['first']; 
 $applicantTwoName['middle'] = $master_entries[0][40]['middle']; 
 $applicantTwoName['last'] = $master_entries[0][40]['last'];

 $applicantTwoNameFull = $applicantTwoName['first'] . ' ' . $applicantTwoName['middle'] . ' ' . $applicantTwoName['last'];

//Entity Number
 $applicantTwoEntityNumber = $master_entries[0][41];            

// Address  
 $applicantTwoAddress['street'] = $master_entries[0][42]['street']; 
 $applicantTwoAddress['street2'] = $master_entries[0][42]['street2']; 
 $applicantTwoAddress['city'] = $master_entries[0][42]['city']; 
 $applicantTwoAddress['state'] = $master_entries[0][42]['state']; 
 $applicantTwoAddress['zip'] = $master_entries[0][42]['zip']; 

    if($applicantTwoAddress['street2'] == ''){
        $applicantTwoAddress['street_full'] = $applicantTwoAddress['street'];
    }else{
        $applicantTwoAddress['street_full'] = $applicantTwoAddress['street'] . ', ' . $applicantTwoAddress['street2'];
    }

 $applicantTwoSignature = $master_entries[0][43]; //SIGNATURE

/* OUTPUT */

//Business Name
    $w->add($businessName, [56, 53, 150, 7]); /* html, [x, y, w, h] */
//Business Purpose
    $w->add($businessPurpose, [56, 60, 150, 7]); /* html, [x, y, w, h] */

/*Business Address ----------------*/
//Address
    $w->add($businessAddress['street_full'], [56, 67, 85, 7]); /* html, [x, y, w, h] */
//City
    $w->add($businessAddress['city'], [145, 67, 30, 7]); /* html, [x, y, w, h] */
//State
    $w->add($businessAddress['state'], [181, 67, 10, 7]); /* html, [x, y, w, h] */
//Zip
    $w->add($businessAddress['zip'], [193, 67, 15, 7]); /* html, [x, y, w, h] */
/*--------------------------------*/
//Registered Agent Name
    $w->add($registeredAgentName, [60, 81, 100, 7]); /* html, [x, y, w, h] */
/*Registered Agent Address ----------------*/
//Address
$w->add($registeredAgentAddress['street_full'], [60, 92, 150, 7]); /* html, [x, y, w, h] */
//City
    $w->add($registeredAgentAddress['city'], [20, 101, 125, 7]); /* html, [x, y, w, h] */
//Zip
    $w->add($registeredAgentAddress['zip'], [180, 101, 15, 7]); /* html, [x, y, w, h] */
/*--------------------------------*/
/*Applicant Owner One----------------*/
//Name
    $w->add($applicantOneNameFull, [67, 107, 100, 7]); /* html, [x, y, w, h] */
//Entity Number
    $w->add($applicantOneEntityNumber, [114, 112.5, 70, 7]); /* html, [x, y, w, h] */
//Address
    $w->add($applicantOneAddress['street_full'], [70, 119, 100, 7]); /* html, [x, y, w, h] */
//City
    $w->add($applicantOneAddress['city'], [70, 125, 80, 7]); /* html, [x, y, w, h] */
//State
    $w->add($applicantOneAddress['state'], [163, 125, 10, 7]); /* html, [x, y, w, h] */
//Zip
    $w->add($applicantOneAddress['zip'], [187, 125, 20, 7]); /* html, [x, y, w, h] */
//Signature
    $w->add($applicantOneSignature, [70, 150, 20, 7]); /* html, [x, y, w, h] */
/*--------------------------------*/
/*Applicant Owner Two----------------*/
//Name
    $w->add($applicantTwoNameFull, [67, 145, 100, 7]); /* html, [x, y, w, h] */
//Entity Number
    $w->add($applicantTwoEntityNumber, [114, 150.5, 70, 7]); /* html, [x, y, w, h] */
//Address
    $w->add($applicantTwoAddress['street_full'], [70, 157, 100, 7]); /* html, [x, y, w, h] */
//City
    $w->add($applicantTwoAddress['city'], [70, 162, 80, 7]); /* html, [x, y, w, h] */
//State
    $w->add($applicantTwoAddress['state'], [163, 162, 10, 7]); /* html, [x, y, w, h] */
//Zip
    $w->add($applicantTwoAddress['zip'], [187, 162, 20, 7]); /* html, [x, y, w, h] */
//Signature
    $w->add($applicantTwoSignature, [70, 187, 20, 7]); /* html, [x, y, w, h] */

/*--------------------------------*/
/*Optional ownership of inclusion----------------*/
//Female owned business
    //IF[$isFemaleOwned = 1, put X in Yes box, else, but X in no box]
    if($isFemaleOwned == 1){
        $w->add($selectOption, [65.5, 192.5, 5, 7]); /* html, [x, y, w, h] */
    }else{
        $w->add($selectOption, [91, 192.5, 5, 7]); /* html, [x, y, w, h] */
    }
//Entity Number
    if($isMinorityOwned == 1){
        $w->add($selectOption, [65.5, 198.5, 5, 7]); /* html, [x, y, w, h] */
        $w->add($minoritySpecified, [141, 198.5, 15, 7]); /* html, [x, y, w, h] */
    }else{
        $w->add($selectOption, [91, 198.5, 5, 7]); /* html, [x, y, w, h] */
    }

