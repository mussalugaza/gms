<?php
$vdomain = preg_replace('|^mail\.|i', '', getenv('HTTP_HOST'));

$exdomain = array(
	'parliament.go.tz' => "Parliament Mailing System",
        'bunge.go.tz' => "Parliament Mailing System",
	'nec.go.tz' => "NEC Mailing System",
	'stamico.co.tz' => "STAMICO Mailing System",
	'eganet.go.tz' => "E-Ganet Mailing System",
        'judiciary.go.tz' => "Judiciary Mailing System",
        'ifm.ac.tz' => "IFM Mailing System"
);

if(isset($exdomain[$vdomain])){
	$gms_title = $exdomain[$vdomain];
}
else {
$gms_title =  "Government Mailing System";
}
//echo $title;
?>
