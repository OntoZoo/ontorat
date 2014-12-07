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
<p><span class="header_darkred">Generate Settings File</span></p>


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


$target_owl_url= $vali->getInput('target_owl_url', 'Online URL', 0, 128);
$data_file_url= $vali->getInput('data_file_url', 'Online URL', 0, 128);
$data_start_row = $vali->getInput('data_start_row', 'Actual data starts from row #', 1, 1);
$cls_col = $vali->getInput('cls_col', 'Column that represents a class label (or preferred name)', 3, 12);
$anno_tpl = remove_comment(stripslashes($vali->getInput('anno_tpl', 'Annotations', 0, 4096)));
$equi_tpl = remove_comment(stripslashes($vali->getInput('equi_tpl', 'Equivalent classes', 0, 4096)));
$sup_tpl = remove_comment(stripslashes($vali->getInput('sup_tpl', 'Superclasses', 0, 4096)));
$extra_terms = remove_comment(stripslashes($vali->getInput('extra_terms', 'Other term URIs needed to define equivalent classes and superclasses (not in the uploaded data file)', 0, 4096)));
$term_uri_start_with = $vali->getInput('term_uri_start_with', 'Term URI start with', 0, 120);
$term_id_prefix = $vali->getInput('term_id_prefix', 'Term ID: prefix', 1, 20);
$term_id_digits = $vali->getInput('term_id_digits', 'Term ID: number of digits', 1, 2);
$term_id_start = $vali->getInput('term_id_start', 'Term ID: start', 1, 10);

$file_name=createRandomPassword();
$file_name='userfiles/' . $file_name.'_settings.txt';

$cls_col=str_replace(array('{', '}', '$'), array('', '', ''), $cls_col);
$cls_col=str_replace('column', 'edit existing classes with term IDs defined in column ', $cls_col);


$strOutput="# This is the template for setting up the Ontorat input conditions. 
# Any text after # is just for notes and won't be used by Ontorat.

[Online URL of the target OWL file (RDF/XML format)]
# Note: Local file won't be used by Ontorat for security reason.   
$target_owl_url

[Online URL of the data file (Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt)]
# Note: Local file won't be used by Ontorat for security reason. 
$data_file_url

Actual data starts from row: $data_start_row


[New axioms will be used to]
# Note: two options: 1. \"generate new classes\", 
# or 2. \"edit existing classes with term IDs defined in column A(or another letter)\"
$cls_col  
  
[Annotations]
# Note: Use comma to separate annotations
$anno_tpl

[Equivalent classes]
# Note: Use comma to separate classes 
$equi_tpl

[Superclasses]
# Note: Use comma to separate classes 
$sup_tpl

[Terms used to define anntoations, equivalent classes and superclasses]
# Note: One line per term
$extra_terms

[Term URIs start with]
# Note: provide a prefix ontology URIs
$term_uri_start_with

[Auto-generated term ID]
# Note: Prefix like \"VO_\", number of digits like \"7\", and start from like \"1\".
Prefix: $term_id_prefix
Number of digits: $term_id_digits
Start from:  $term_id_start
";

file_put_contents($file_name, $strOutput);

if (file_exists($file_name)) {
?>
<p><strong>Finished generating settings file. Please download <a href="<?php echo $file_name?>" target="_blank">the settings file</a>.</strong></p>
<?php 
}
else {
?>
<p><strong>Error occured when generating settings file. </strong></p>
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
