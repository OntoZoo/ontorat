<?php 
/*
Copyright © 2014 The Regents of the University of Michigan
 
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at
 
http://www.apache.org/licenses/LICENSE-2.0
 
Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 
For more information, questions, or permission requests, please contact:
Yongqun “Oliver” He - yongqunh@med.umich.edu
Unit for Laboratory Animal Medicine, Center for Computational Medicine & Bioinformatics
University of Michigan, Ann Arbor, MI 48109, USA
He Group:  http://www.hegroup.org
*/
/*
Author: Zuoshuang (Allen) Xiang, Yongqun (Oliver) He
The University Of Michigan
He Group
Date: July 2011 - December 2014
*/

include_once('inc/Classes.php');
include_once('PHPExcel/PHPExcel.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontorat</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="css/styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
<?php include_once('inc/googleanalytics.php') ?>
</head>

<body>
<div id="topbanner"><a href="/index.php" style="font-size:36px; color:#111144; text-decoration:none"><img src="images/logo.gif" alt="Logo" width="280" height="49" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="intro.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="designtemplates/index.php" class="topnav">Templates</a><a href="faqs.php" class="topnav">FAQs</a><a href="refs.php" class="topnav">References</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact Us</a><a href="ack.php" class="topnav">Acknowledge</a><a href="news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<p><span class="header_darkred">Retrieving Results</span></p>


<?php 
function remove_comment($str_in) {
	$lines = preg_split('/[\r\n]+/', $str_in);
	$str_out='';
	
	foreach($lines as $line) {
		if (strpos($line, ' #')!==false) {
			$line = substr($line, 0, strpos($line, ' #'));
		}
		if (strpos($line, '#')===0) {
			$line ='';
		}
		$str_out.=$line."\r\n";
	}
	
	return(trim($str_out));
}


$vali=new Validation($_REQUEST);


if (isset($_FILES['target_owl']) && is_uploaded_file($_FILES['target_owl']['tmp_name'])){
	$target_owl_text = trim(file_get_contents($_FILES['target_owl']['tmp_name']));
	if (trim($target_owl_text)=='') {
		$vali->concatError('Ontology file is empty');
	}
	
	if (strpos($target_owl_text, '</rdf:RDF>')===false) {
		$vali->concatError('Incorrect OWL(RDF/XML) format');
	}
	
}
else {
	$target_owl_url= $vali->getInput('target_owl_url', 'Online URL', 0, 128);
	if (trim($target_owl_url)=='') {
		$vali->concatError('Please specify the target ontology file.');
	}
	else {
		$target_owl_text = file_get_contents($target_owl_url);
		if ($target_owl_text===false) {
			$vali->concatError('An error occured downloading the target ontology file');
		}
		else {
			if (trim($target_owl_text)=='') {
				$vali->concatError('Ontology file is empty');
			}
			
			if (strpos($target_owl_text, '</rdf:RDF>')===false) {
				$vali->concatError('Incorrect OWL(RDF/XML) format');
			}
		}
	}
}

$file_name=createRandomPassword();
$data_file_name = '';
$data_file_ext = '';

if (isset($_FILES['data_file']) && is_uploaded_file($_FILES['data_file']['tmp_name'])){
	$tmp_name=$_FILES['data_file']['name'];
	$pos = strrpos($tmp_name, '.');
	
	if ($pos===false) {
		$vali->concatError('File extension not recognized. Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt) is accepted.');
	}
	else {
		$data_file_ext=strtolower(substr($tmp_name, strrpos($tmp_name, '.')));
		
		$data_file_name = 'userfiles/'.$file_name.$data_file_ext;
		if (!in_array($data_file_ext, array('.xls', '.xlsx', '.txt'))) {
			$vali->concatError('File extension $data_file_ext not allowed. Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt) is accepted.');
		}
		move_uploaded_file($_FILES['data_file']['tmp_name'], $data_file_name);
		if (!file_exists($data_file_name)) {
			$vali->concatError('An error occured uploading the data file');
		}
	}
}
else {
	$data_file_url= $vali->getInput('data_file_url', 'Online URL', 0, 128);
	
	if (trim($data_file_url)=='') {
		$vali->concatError('Please specify the data file (Microsoft Excel file or tab-delimited text file only)');
	}
	else {
		$pos = strrpos($data_file_url, '.');
		
		if ($pos===false) {
			$vali->concatError('File extension not recognized. Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt) is accepted.');
		}
		else {
			$data_file_ext=strtolower(substr($data_file_url, $pos));
			
			$data_file_name = 'userfiles/'.$file_name.$data_file_ext;
			if (!in_array($data_file_ext, array('.xls', '.xlsx', '.txt'))) {
				$vali->concatError('File extension $data_file_ext not allowed. Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt) is accepted.');
			}
			
			system("wget $data_file_url -O $data_file_name");
			if (!file_exists($data_file_name)) {
				$vali->concatError('An error occured downloading the data file');
			}
		}
	}
}


$data_start_row = $vali->getInput('data_start_row', 'Actual data starts from row #', 1, 1);


$cls_col = $vali->getInput('cls_col', 'Column that represents a class label (or preferred name)', 3, 12);

$anno_tpl = remove_comment(stripslashes($vali->getInput('anno_tpl', 'Annotations', 0, 4096)));
$equi_tpl = remove_comment(stripslashes($vali->getInput('equi_tpl', 'Equivalent classes', 0, 4096)));

$sup_tpl = remove_comment(stripslashes($vali->getInput('sup_tpl', 'Superclasses', 0, 4096)));

$extra_terms = remove_comment(stripslashes($vali->getInput('extra_terms', 'Other term URIs needed to define equivalent classes and superclasses (not in the uploaded data file)', 0, 4096)));

$extra_terms .='AnnotationProperty:
\'label\': <http://www.w3.org/2000/01/rdf-schema#label>
\'comment\': <http://www.w3.org/2000/01/rdf-schema#comment>
\'seeAlso\': <http://www.w3.org/2000/01/rdf-schema#seeAlso>
\'editor preferred term\': <http://purl.obolibrary.org/obo/IAO_0000111>
\'example of usage\': <http://purl.obolibrary.org/obo/IAO_0000112>
\'has curation status\': <http://purl.obolibrary.org/obo/IAO_0000114>
\'definition\': <http://purl.obolibrary.org/obo/IAO_0000115>
\'editor note\': <http://purl.obolibrary.org/obo/IAO_0000116>
\'definition editor\': <http://purl.obolibrary.org/obo/IAO_0000117>
\'alternative term\': <http://purl.obolibrary.org/obo/IAO_0000118>
\'definition source\': <http://purl.obolibrary.org/obo/IAO_0000119>

';


$term_uri_start_with = $vali->getInput('term_uri_start_with', 'Term URI start with', 0, 120);
$term_id_prefix = $vali->getInput('term_id_prefix', 'Term ID: prefix', 1, 20);
$term_id_digits = $vali->getInput('term_id_digits', 'Term ID: number of digits', 1, 2);
$term_id_start = $vali->getInput('term_id_start', 'Term ID: start', 1, 10);



if ($vali->getErrorMsg()=='') {
	$array_data = array();

	if ($data_file_ext=='.xlsx' || $data_file_ext=='.xls') {
		if ($data_file_ext=='.xlsx') {
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		}
		else {
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
		}
		$objReader->setReadDataOnly(true);
		
		$objPHPExcel = $objReader->load($data_file_name);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		
		$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
		$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
		
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
		
		$tmp_i=0;
		for ($row = $data_start_row; $row <= $highestRow; $row++) {
			for ($col = 0; $col <= $highestColumnIndex; ++$col) {
				$array_data[$tmp_i][$col]=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			}
			$tmp_i++;
		}
	}
	else {
		$data_file_text = file_get_contents($data_file_name);
		$lines = preg_split('/[\r\n]+/', $data_file_text);
		
		foreach($lines as $line) {
			$tokens = preg_split('/\t/', $line);
			$array_data[] = $tokens;
		}
		
	}
	
	
	$a_extra_terms=array();
	$defined_terms=array();

	preg_match_all('/(ObjectProperty|Class|AnnotationProperty|DataProperty):\s+((\'([^\']+)\'):\s*<(http:\/\/\S+)>\s*)+/s', $extra_terms, $matches);
	
	foreach ($matches[0] as $match) {
		$lines = preg_split('/[\r\n]+/', $match);
		$term_type=trim(trim($lines[0]), ':');
		unset($lines[0]);
		foreach ($lines as $line) {
			if (trim($line)!='') {
				if (preg_match('/(\'([^\']+)\'):\s*<(http:\/\/\S+)>/', $line, $match2)) {
//					print_r($match2);
					$a_tmp['type']=$term_type;
					$a_tmp['URL']=$match2[3];
					$defined_terms[$match2[3]]=1;
					$a_extra_terms[$match2[2]] =  $a_tmp;
				}
			}
		}
	}
//	print_r($a_extra_terms);
	
	
	
	

	$strOutputM='Prefix: xsd: <http://www.w3.org/2001/XMLSchema#>
Prefix: owl: <http://www.w3.org/2002/07/owl#>
Prefix: obo: <http://purl.obolibrary.org/obo/>
Prefix: xml: <http://www.w3.org/XML/1998/namespace>
Prefix: rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
Prefix: rdfs: <http://www.w3.org/2000/01/rdf-schema#>

Ontology: <http://purl.obolibrary.org/obo/ontorat_0000001.owl>


AnnotationProperty: <http://www.w3.org/2000/01/rdf-schema#label>

AnnotationProperty: <http://www.w3.org/2000/01/rdf-schema#comment>
    
AnnotationProperty: <http://www.w3.org/2000/01/rdf-schema#seeAlso>

AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000111>
    Annotations:
    rdfs:label "editor preferred term"
    
AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000112>
    Annotations:
    rdfs:label "example of usage"
    
AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000114>
    Annotations:
    rdfs:label "has curation status"
   
AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000115>
    Annotations:
    rdfs:label "definition"
    
AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000116>
    Annotations:
    rdfs:label "editor note"
    
AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000117>
    Annotations:
    rdfs:label "definition editor"

AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000118>
    Annotations:
    rdfs:label "alternative term"
    
AnnotationProperty: <http://purl.obolibrary.org/obo/IAO_0000119>
    Annotations:
    rdfs:label "definition source"

Datatype: rdf:PlainLiteral
Datatype: xsd:string
Datatype: xsd:nonNegativeInteger
Datatype: xsd:float
Datatype: rdfs:Literal
Datatype: xsd:integer

';

foreach($a_extra_terms as $tmp_label => $tmp_term) {
	if (strpos($strOutputM, '<' . $tmp_term['URL'] . '>')===false) {
		$strOutputM.= $tmp_term['type'] . ': <' . $tmp_term['URL'] . '>
';
	}
}
	
//	print($target_owl_text);
	
	preg_match_all('/'.$term_id_prefix.'\d{'.$term_id_digits.'}/', $target_owl_text, $matches);
	
	$usedIDs = array();
	
	foreach($matches[0] as $match) {
		$usedIDs[$match] = 1;
	}
	
//	print_r($usedIDs);
	
	$currentNo=$term_id_start;
	
	foreach ($array_data as $values) {
		$strOutputMT='';
		if ($cls_col == 'new') {
			$newID = $term_id_prefix.sprintf('%0'.$term_id_digits.'s', $currentNo);
			while (isset($usedIDs[$newID])) {
				$currentNo++;
				$newID = $term_id_prefix.sprintf('%0'.$term_id_digits.'s', $currentNo);
			}
			
			$usedIDs[$newID] = 1;
			
			$strOutputM .= '
Class: <'.$term_uri_start_with.$newID.'>
	';

		}
		else {
			$tmpM = '
Class: <'.$term_uri_start_with.$cls_col.'>
	';
			$i2=1;
			foreach ($values as $value) {
				$key = 'column'.strtoupper(convertIntToAlphabet($i2));
				$i2++;
				
				$tmpM = str_replace('{$'.$key.'}', trim($value), $tmpM); 
			}
		

			$strOutputM .= $tmpM;
		}
		
		
		if ($anno_tpl!='') {
			$strOutputMT .= '
    Annotations:
        '.$anno_tpl.'

';
		}
		
		if ($equi_tpl!='') {
			$strOutputMT .= '
    EquivalentTo:
        '.$equi_tpl.'

';
		}
		
		if ($sup_tpl!='') {
			$strOutputMT .= '
    SubClassOf:
        '.$sup_tpl.'

';
		}
		
		$i2=1;
		foreach ($values as $value) {
			$key = 'column'.strtoupper(convertIntToAlphabet($i2));
			$i2++;
			
			$strOutputMT = str_replace('{$'.$key.'}', trim(addslashes($value)), $strOutputMT); 
		}
		
		foreach ($a_extra_terms as $label => $extra_term) {
			$strOutputMT = str_replace("'$label'", '<'.$extra_term['URL'].'>', $strOutputMT); 
		}
		
		$strOutputM .= $strOutputMT;
		
		preg_match_all('/<(http:\/\/\S+)>/', $strOutputMT, $matches2);
		foreach($matches2[1] as $term_to_define){
			if (!isset($defined_terms[$term_to_define])) {
				$strOutputM .= "Class: <$term_to_define>\r\n\r\n";
				$defined_terms[$term_to_define]=1;
			}
		}
		
	}
	
	file_put_contents('userfiles/' . $file_name.'_in.owl', $strOutputM);

	exec("java -cp .:./libs/* org.hegroup.ontorat.OWLReformat ".dirname(__FILE__)."/userfiles/". $file_name . "_in.owl ".dirname(__FILE__)."/userfiles/" . $file_name . "_out.owl 2>&1", $array_out);
	

	if (file_exists('userfiles/' . $file_name . "_out.owl")) {
?>
<p><strong>Finished the Ontorat execution. Please download <a href="userfiles/<?php echo $file_name?>_out.owl" target="_blank">the output file</a>.</strong></p>
<?php 
	}
	else {
?>
<p><strong>Error occured when converting the output file into OWL(RDF/XML) format. For debugging, you can download and examine <a href="userfiles/<?php echo $file_name?>_in.owl" target="_blank">the output file in Manchester syntax</a>.</strong></p>
<?php 
		print("<pre>".join("\n", $array_out)."</pre>");
	}

}

//print("<pre>".htmlentities($strOutputM) . "</pre>");



if ($vali->getErrorMsg()!='') {
?>
<?php  include('inc/input_error.php');?>
<?php 
}
?>


<!-- InstanceEndEditable -->
</div>
<div id="footer">
  <div id="footer_hl"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div id="footer_left"><a href="http://www.hegroup.org" target="_blank">He Group</a><br>
University of Michigan Medical School<br>
Ann Arbor, MI 48109</div></td>
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
</body>
<!-- InstanceEnd --></html>
