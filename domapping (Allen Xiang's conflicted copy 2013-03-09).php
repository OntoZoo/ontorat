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
Date: July 2011 - March 2013
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

function getMapping($download_url, $output_file) {
	$a_mapping=array();
	$pos=strrpos($download_url, '/');
	if ($pos!==false) {
		$strFolder=substr($download_url, 0, $pos);
		system("wget -q $strFolder/catalog-v001.xml -O $output_file");
		$str_mapping=file_get_contents($output_file);
		
		preg_match_all('/<uri id="[^"]+" name="([^"]+)" uri="([^"]+)"\/>/', $str_mapping, $matches, PREG_SET_ORDER);
		foreach($matches as $match) {
			$mapping['to']=$match[1];
			$from=$strFolder.'/'.$match[2];
			
			while (preg_match('/\/[^\/\.]+\/\.\./', $from)) {
				$from=preg_replace('/\/[^\/\.]+\/\.\./', '', $from);
			}
			$mapping['from']=$from;
			$a_mapping[]=$mapping;
		}
	}
	
//	print_r($a_mapping);
	return($a_mapping);
}


$vali=new Validation($_REQUEST);

$file_name=createRandomPassword();

if (isset($_FILES['target_owl']) && is_uploaded_file($_FILES['target_owl']['tmp_name'])){
	$target_owl_text = trim(file_get_contents($_FILES['target_owl']['tmp_name']));
	if (trim($target_owl_text)=='') {
		$vali->concatError('Ontology file is empty');
	}
	
	if (strpos($target_owl_text, '</rdf:RDF>')===false) {
		$vali->concatError('Incorrect OWL(RDF/XML) format');
	}
	
	move_uploaded_file($_FILES["target_owl"]["tmp_name"], "userfiles/$file_name.input.owl");	
	
	
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


$cls_col = $vali->getInput('cls_col', 'Column that represents a class label (or preferred name)', 3, 128);

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
//		$objReader->setReadDataOnly(true);
		
		$objPHPExcel = $objReader->load($data_file_name);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		
		
		$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
		$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
		
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
		
		$tmp_i=0;
		for ($row = $data_start_row; $row <= $highestRow; $row++) {
			$tmp_value='';
			for ($col = 0; $col <= $highestColumnIndex; ++$col) $tmp_value.=trim($objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
			
			if ($tmp_value!='') {
				for ($col = 0; $col <= $highestColumnIndex; ++$col) {
					$array_data[$tmp_i][$col]=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
				}
				$tmp_i++;
			}
		}
	}
	else {
		$data_file_text = file_get_contents($data_file_name);
		$lines = preg_split('/[\r\n]+/', $data_file_text);
		
		$tmp_i=1;
		foreach($lines as $line) {
			if ($tmp_i>=$data_start_row && trim($line)!='') {
				$tokens = preg_split('/\t/', $line);
				$array_data[] = $tokens;
			}
			$tmp_i++;
		}
		
	}
	
	
//	print_r($array_data);
	
	$a_extra_terms=array();
	$a_defined_terms=array();

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
			$a_defined_terms[$tmp_term['URL']]=1;
		}
	}
	
	
	$json_settings = array();
	
	if (isset($target_owl_url) && trim($target_owl_url)!='') {
		$json_settings['download_url'] = $target_owl_url;
		$json_settings['mapping'] = getMapping($target_owl_url, "userfiles/$file_name.mapping");
	}
	else {
		$json_settings['download_url'] = "file://".dirname(__FILE__)."/userfiles/$file_name.input.owl";
		$json_settings['mapping'] = array();
	}
	$json_settings['output_file'] = "userfiles/$file_name.terms";
	
	
	file_put_contents("userfiles/$file_name.json", json_encode($json_settings));
	
	system("java -Xmx8g -cp .:./libs/* org.hegroup.ontorat.ListTerms userfiles/$file_name.json");

	$lines = file("userfiles/$file_name.terms", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	array_push($lines, "AnnotationProperty\tlabel\thttp://www.w3.org/2000/01/rdf-schema#label");
//	print($target_owl_text);
	
//	preg_match_all('/'.$term_id_prefix.'\d{'.$term_id_digits.'}/', $target_owl_text, $matches);
	
	$usedIDs = array();
	
	foreach($lines as $line) {
		$tokens_line = preg_split('/\t/', $line);
		
		if (preg_match('/'.$term_id_prefix.'\d{'.$term_id_digits.'}/', $tokens_line[2], $match))	$usedIDs[$match[0]] = 1;
		
		$a_tmp['type']=$tokens_line[0];
		$a_tmp['URL']=$tokens_line[2];
//		$a_defined_terms[$tokens_line[2]]=1;
		$a_extra_terms[$tokens_line[1]] =  $a_tmp;
		
		if ($tokens_line[0]=='AnnotationProperty') {
			$strOutputM	.="AnnotationProperty: <".$tokens_line[2].">
    Annotations:
    rdfs:label \"".$tokens_line[1]."\"
";
			$a_defined_terms[$tokens_line[2]]=1;

		}
	}
//	print_r($usedIDs);
	
	$currentNo=$term_id_start;
	
	
	$newIDs=array();
	
	foreach ($array_data as $values) {
		$strOutputMT='';
		if ($cls_col == 'generate new classes') {
			$newID = $term_id_prefix.sprintf('%0'.$term_id_digits.'s', $currentNo);
			while (isset($usedIDs[$newID])) {
				$currentNo++;
				$newID = $term_id_prefix.sprintf('%0'.$term_id_digits.'s', $currentNo);
			}
			
			$usedIDs[$newID] = 1;
			$newIDs[]=$newID;
			
			$strOutputM .= '
Class: <'.$term_uri_start_with.$newID.'>
	';

			$a_defined_terms[$term_uri_start_with.$newID]=1;
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
			
			preg_match('/(http:\/\/\S+)>/', $tmpM, $match);
			
			$a_defined_terms[$match[0]]=1;
		}
		
		if ($anno_tpl!='') {
			$tmp_tokens=preg_split('/,\s*[\r\n]+/', $anno_tpl);
			
			for($j=sizeof($tmp_tokens)-1;  $j>-1; $j--) {
				for($k=sizeof($values)-1;  $k>-1; $k--) {
					$key = 'column'.strtoupper(convertIntToAlphabet($k+1));
					if (trim($values[$k])=='' && strpos($tmp_tokens[$j], '{$'.$key.'}')!==false) {
						unset($tmp_tokens[$j]);
						break;
					}
				}
			}
			
			if (sizeof($tmp_tokens)>0) {
				$strOutputMT .= '
    Annotations:
        '.join(",\r\n", $tmp_tokens).'

';
			}
		}
		
		if ($equi_tpl!='') {
			$tmp_tokens=preg_split('/,/', $equi_tpl);
			
			for($j=sizeof($tmp_tokens)-1;  $j>-1; $j--) {
				for($k=sizeof($values)-1;  $k>-1; $k--) {
					$key = 'column'.strtoupper(convertIntToAlphabet($k+1));
					if (trim($values[$k])=='' && strpos($tmp_tokens[$j], '{$'.$key.'}')!==false) {
						unset($tmp_tokens[$j]);
						break;
					}
				}
			}
			
			if (sizeof($tmp_tokens)>0) {
			$strOutputMT .= '
    EquivalentTo:
        '.join(",\r\n", $tmp_tokens).'

';
			}
		}
		
		if ($sup_tpl!='') {
			$tmp_tokens=preg_split('/,/', $sup_tpl);
			
//			print_r($tmp_tokens);
			
			for($j=sizeof($tmp_tokens)-1;  $j>-1; $j--) {
				for($k=sizeof($values)-1;  $k>-1; $k--) {
					$key = 'column'.strtoupper(convertIntToAlphabet($k+1));
					
//					print("\r\n\r\n\r\n\r\n".$values[$k]."\r\n");
//					print($tmp_tokens[$j]."\r\n");
//					print('{$'.$key.'}'."\r\n");
					if (trim($values[$k])=='' && strpos($tmp_tokens[$j], '{$'.$key.'}')!==false) {
						unset($tmp_tokens[$j]);
						break;
					}
				}
			}
			
//			print_r($tmp_tokens);

			if (sizeof($tmp_tokens)>0) {
			$strOutputMT .= '
    SubClassOf:
        '.join(",\r\n", $tmp_tokens).'

';
			}
		}
		
		$i2=1;
		foreach ($values as $value) {
			$key = 'column'.strtoupper(convertIntToAlphabet($i2));
			$i2++;
			
			$strOutputMT = str_replace('{$'.$key.'}', trim(addslashes($value)), $strOutputMT); 
		}
		
		$strOutputMT2='';
		
		foreach ($a_extra_terms as $label => $extra_term) {
			$count_replaced=0;
			$strOutputMT = str_replace("'$label'", '<'.$extra_term['URL'].'>', $strOutputMT, $count_replaced); 
			if ($count_replaced>0 && !isset($a_defined_terms[$extra_term['URL']])) {
				$strOutputMT2 .= $extra_term['type'].": <".$extra_term['URL'].">\r\n    Annotations:\r\n    rdfs:label \"".$label."\"\r\n\r\n";
				$a_defined_terms[$extra_term['URL']]=1;
			}
		}
		
//		print('<pre>---'.$strOutputM.'===</pre>');

		$strOutputM .= $strOutputMT.$strOutputMT2 ;
		
//		print('<pre>---'.$strOutputM.'===</pre>');
		
		preg_match_all('/<(http:\/\/\S+)>/', $strOutputMT, $matches2);
		foreach($matches2[1] as $term_to_define){
			if (!isset($a_defined_terms[$term_to_define])) {
				$strOutputM .= "Class: <$term_to_define>\r\n\r\n";
				$a_defined_terms[$term_to_define]=1;
			}
		}
		
	}

	//update input file
	if ($cls_col == 'generate new classes') {
		if ($data_file_ext=='.xlsx' || $data_file_ext=='.xls') {
			if ($data_file_ext=='.xlsx') {
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			}
			else {
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			}
	//		$objReader->setReadDataOnly(true);
			
			$objPHPExcel = $objReader->load($data_file_name);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			$objPHPExcel->getActiveSheet()->insertNewColumnBeforeByIndex();
			
			
			$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
			$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
			
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
			
			$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 1)->setValue('Term ID');
			$tmp_i=0;
			for ($row = $data_start_row; $row <= $highestRow; $row++) {
				$tmp_value='';
				for ($col = 0; $col <= $highestColumnIndex; ++$col) $tmp_value.=trim($objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
				
				if ($tmp_value!='') {
					$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->setValue($newIDs[$tmp_i]);
					
					$tmp_i++;
				}
			}


			if ($data_file_ext=='.xlsx') {
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
			}
			else {
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
			}
			
			$objWriter->save($data_file_name);
		}
		else {
			$data_file_text = file_get_contents($data_file_name);
			$lines = preg_split('/[\r\n]+/', $data_file_text);
			$linesOut="Term ID\t".$lines[0]."\n";

			for($i=1; $i<$data_start_row-1; $i++) {
				if (trim($lines[$i])!='') {
					$linesOut.="\t".$lines[$i]."\n";
				}
			}
			
			$tmp_i=0;
			for($i=$data_start_row-1; $i<sizeof($lines); $i++) {
				if (trim($lines[$i])!='') {
					$linesOut.=$newIDs[$tmp_i]."\t".$lines[$i]."\n";
					$tmp_i++;
				}
			}
			file_put_contents($data_file_name, $linesOut);
			
		}
		
	}

	
	file_put_contents('userfiles/' . $file_name.'_in.owl', $strOutputM);

	exec("java -cp .:./libs/* org.hegroup.ontorat.OWLReformat ".dirname(__FILE__)."/userfiles/". $file_name . "_in.owl ".dirname(__FILE__)."/userfiles/" . $file_name . "_out.owl 2>&1", $array_out);
	

	if (file_exists('userfiles/' . $file_name . "_out.owl")) {
?>
<p><strong>Finished the Ontorat execuation. Please download <a href="userfiles/<?php echo $file_name?>_out.owl" target="_blank">the output file</a>.</strong></p>
<?php 
		if ($cls_col == 'generate new classes') {
?>
<p><strong>Your input file has been updated to include newly assigned term IDs. Please download <a href="<?php echo $data_file_name?>" target="_blank">the updated input file</a>.</strong></p>
<?php 
		}

	}
	else {
?>
<p><strong>Error occured when converting the output file into OWL(RDF/XML) format. For debugging, you can download and examine <a href="userfiles/<?php echo $file_name?>_in.owl" target="_blank">the output file in Manchester syntax</a>.</strong></p>
<pre>
<?php 
		$toPrint= false;
		foreach ($array_out as $line_out) {
			if ($line_out=="Parser: ManchesterOWLSyntaxOntologyParser") {
				$toPrint=true;
			}
			
			if ($toPrint) {
				print("$line_out\n");
			}
		}
	}
?>
</pre>
<?php
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
