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
$vali=new Validation($_REQUEST);
$settings_file_url = $vali->getInput('settings_file_url', 'Settings File URL', 0, 100);

foreach($section_tags as $section_tag_var => $section_tag_txt){
	eval("$section_tag_var = '';");
}

$data_start_row = '';
$term_id_prefix = '';
$term_id_digits = '';
$term_id_start = '';


$str_input='';
if (isset($_FILES['settings_file']) && is_uploaded_file($_FILES['settings_file']['tmp_name'])){
	$str_input = trim(file_get_contents($_FILES['settings_file']['tmp_name']));

}
elseif($settings_file_url!='') {
	$str_input=file_get_contents($settings_file_url);
}

if ($str_input!='') {
	$lines = preg_split('/[\r\n]+/', $str_input);
	$current_tag = '';
	foreach ($lines as $line) {
		$line = trim($line);
		if (strpos($line, '[')===0) {
			foreach($section_tags as $section_tag_var => $section_tag_txt){
				if (strpos($line, $section_tag_txt)===0) {
					$current_tag = $section_tag_var;
					eval("$current_tag = '';");
				}
			}
		}
		elseif (strpos($line, '#')===0) {
			//ignore comments
		}
		else {
			if (strpos($line, ' #')!==false) {
				$line = trim(substr($line, 0, strpos($line, ' #')));
			}

			if ($current_tag!='' && $line!='') {
				eval("$current_tag .= \"$line\\n\";");
			}
		}
	}
}

if ($data_file_url!='') {
	$lines = preg_split('/[\r\n]+/', $data_file_url);
	foreach($lines as $line) {
		$line=trim($line);
		if (strpos($line, 'Actual data starts from row:')!==false) {
			$data_start_row=trim(str_replace('Actual data starts from row:', '', $line));
		}
		elseif ($line!='') {
			$data_file_url=$line;
		}
	}
}

if ($auto_id!='') {
	$lines = preg_split('/[\r\n]+/', $auto_id);
	foreach($lines as $line) {
		$line=trim($line);
		if (strpos($line, 'Prefix:')!==false) {
			$term_id_prefix=trim(str_replace('Prefix:', '', $line));
		}
		elseif (strpos($line, 'Number of digits:')!==false) {
			$term_id_digits=trim(str_replace('Number of digits:', '', $line));
		}
		elseif (strpos($line, 'Start from:')!==false) {
			$term_id_start=trim(str_replace('Start from:', '', $line));
		}
	}
}


if ($extra_terms=='') $extra_terms = 'AnnotationProperty: 

Class:

ObjectProperty:

DataProperty:

';

if ($cls_col=='generate new classes') $cls_col='new';
$cls_col=trim(str_replace('edit existing classes with term IDs defined in column', '', $cls_col));

if ($term_id_prefix=='') $term_id_prefix = 'O_';
if ($term_id_digits=='') $term_id_digits = 7;
if ($term_id_start=='') $term_id_start = 1;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontorat</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="css/styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" language="javascript">
<!--
function alertboxAnnotation(msg){
	$("#messageBoxAnnotation").removeClass().addClass("errorbox").html(msg).fadeIn(1000).fadeOut(5000);
}

function alertboxSuperclass(msg){
	$("#messageBoxSuperclass").removeClass().addClass("errorbox").html(msg).fadeIn(1000).fadeOut(5000);
}


function alertboxExtraTerms(msg){
	$("#messageBoxExtraTerms").removeClass().addClass("errorbox").html(msg).fadeIn(1000).fadeOut(5000);
}
-->
</script>
<script language="JavaScript" type="text/javascript">
String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}


function add_anno() {
	anno_term=document.getElementById("anno_term").value;
	anno_col=document.getElementById("anno_col").value;
	anno_tpl=document.getElementById("anno_tpl").value.trim();
	
	if (anno_tpl.indexOf(anno_col)==-1) {
		if (anno_tpl!='') {
			anno_tpl = anno_tpl + ", \r\n";
		}
		document.getElementById("anno_tpl").value = anno_tpl + anno_term + " \"" + anno_col + "\"";
	}
	else {
		 alertboxAnnotation(anno_col + " is already used!");
	}
}

function add_sup() {
	sup_col=document.getElementById("sup_col").value;
	sup_col_type=document.getElementById("sup_col_type").value;
	sup_tpl=document.getElementById("sup_tpl").value.trim();
	
	if (sup_tpl.indexOf(sup_col)==-1) {
		if (sup_tpl!='') {
			sup_tpl = sup_tpl + ",\r\n";
		}
		if (sup_col_type=='uri') {
			document.getElementById("sup_tpl").value = sup_tpl +  "<" + sup_col + ">";
		}
		else {
			document.getElementById("sup_tpl").value = sup_tpl +  "'" + sup_col + "'";
		}
	}
	else {
		 alertboxSuperclass(sup_col + " is already used!");
	}
}

function add_extra() {
	extra_term_uri=document.getElementById("extra_term_uri").value.trim();
	extra_term_type=document.getElementById("extra_term_type").value;
	extra_term_label=document.getElementById("extra_term_label").value;
	add_extra_eg(extra_term_type, extra_term_label , extra_term_uri);
}

function add_extra_eg(extra_term_type, extra_term_label , extra_term_uri) {
	extra_terms=document.getElementById("extra_terms").value.trim();
	
	if (extra_term_label.trim() == '') {
		alertboxExtraTerms("Term label cannot be empty!");
	}
	else if(extra_term_uri.indexOf('http://')){
		alertboxExtraTerms("Incorrect URI format!");
	}
	else {
		if (extra_terms.indexOf("<"+extra_term_uri+">")==-1) {
			if (extra_terms.indexOf(extra_term_type)==-1) {
				if (extra_terms!='') {
					extra_terms = extra_terms + "\r\n\r\n";
				}
				document.getElementById("extra_terms").value = extra_terms +  extra_term_type + ": \r\n'"+extra_term_label+"': <" + extra_term_uri + ">";
			}
			else {
				document.getElementById("extra_terms").value = extra_terms.replace(extra_term_type+":",  extra_term_type + ": \r\n'"+extra_term_label+"': <" + extra_term_uri + ">");
			}
		}
		else {
			alertboxExtraTerms(extra_term_uri + " is already defined!");
		}
	}
}
</script>
<!-- InstanceEndEditable -->
<?php include_once('inc/googleanalytics.php') ?>
</head>

<body>
<div id="topbanner"><a href="/index.php" style="font-size:36px; color:#111144; text-decoration:none"><img src="images/logo.gif" alt="Logo" width="280" height="49" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="intro.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="designtemplates/index.php" class="topnav">Templates</a><a href="faqs.php" class="topnav">FAQs</a><a href="refs.php" class="topnav">References</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact Us</a><a href="ack.php" class="topnav">Acknowledge</a><a href="news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->

<h3 class="header_darkred">Ontorat: Ontology Representation of Axioms using Templates</h3>
      <p>Ontorat is a web server that automatically generates new ontology terms and axioms based on user-provided input file. The development of Ontorat is inspired by the QTT program developed by the OBI development team. The use of Ontorat is easy and is supported by an interactive web interface. </p>
      <p><strong>Examples: </strong><a href="index.php?e=1" target="_blank">Example 1</a>; example 2; example 3. (<strong>Note:</strong> to be generated)</p>
<form method="post" enctype="multipart/form-data" target="_blank">
<table border="0">
  <tr>
    <td>
      <strong style="margin-left:16px;">Load  settings from a settings file (optional):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Online URL:
      <input name="settings_file_url" id="settings_file_url" value="<?php echo $settings_file_url?>" size="70"></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Or file upload:      

        <input name="settings_file" type="file" id="settings_file" size="60">
</td>
  </tr>
  <tr>
    <td align="center" style="padding-top:12px"><input type="submit" name="Submit1" value="Load Settings File" />
      <input type="reset" name="Submit3" value="Reset" style="margin-left:40px;"></td>
  </tr>
</table>
</form>


<p>&nbsp;</p>
<form action="domapping.php" method="post" enctype="multipart/form-data" target="_blank" id="formMain">
<table border="0">
  <tr>
    <td>
      <strong style="margin-left:16px;">(1) Please specify the  target OWL file (<span class="darkred">RDF/XML format</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Online URL:
      <input name="target_owl_url" id="target_owl_url" value="<?php echo $target_owl_url?>" size="70"></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Or file upload:      

        <input name="target_owl" type="file" id="target_owl" size="60">
</td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(2) Please specify the data file (<span class="darkred">Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt) is accepted</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Online URL:
      <input name="data_file_url" id="data_file_url" value="<?php echo $data_file_url?>" size="70"></td>
  </tr>
  <tr>
    <td style="padding-left:16px">
        Or file upload:
          <input name="data_file" type="file" id="data_file" size="60">
</td>
  </tr>
  <tr>
    <td style="padding-left:16px">
Actual data starts from row 
  <select name="data_start_row" id="data_start_row">
  <option value="">Please select a row number</option>
    <?php 
for ($i=1; $i<=5; $i++) {
?>
    <option value="<?php echo $i?>" <?php  if ($data_start_row==$i) {?> selected <?php  }?>><?php echo $i?></option>
    <?php 
}
?>
  </select>
</td>

  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(3) New axioms will be  used to:</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px"><select name="cls_col" id="cls_col">
        <option value="new" <?php  if ($cls_col=='new') {?> selected <?php  }?>>generate new classes</option>
      <?php 
for ($i=1; $i<=26; $i++) {
?>
      <option value="{$column<?php echo strtoupper(convertIntToAlphabet($i))?>}" <?php  if ($cls_col==strtoupper(convertIntToAlphabet($i))) {?> selected <?php  }?>>edit existing classes with term IDs defined in column
          <?php echo strtoupper(convertIntToAlphabet($i))?>
          </option>
        <?php 
}
?>
      </select> 
      
      </td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(4) Annotations (<span class="darkred">use comma to separate annotations</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">
      <div><select name="anno_col" id="anno_col">
        <?php 
for ($i=1; $i<=26; $i++) {
?>
        <option value="{$column<?php echo strtoupper(convertIntToAlphabet($i))?>}">column
          <?php echo strtoupper(convertIntToAlphabet($i))?>
          </option>
        <?php 
}
?>
      </select>
      as 
      <select name="anno_term" id="anno_term">
        <optgroup label="RDF schema annotations">
        <option value="'label'">label</option>
        <option value="'comment'">comment</option>
        <option value="'seeAlso'">seeAlso</option>
        </optgroup>
        
        <optgroup label="IAO annotations">
        <option value="'editor preferred term'">editor preferred term</option>
        <option value="'example of usage'">example of usage</option>
        <option value="'has curation status'">has curation status</option>
        <option value="'definition'">definition</option>
        <option value="'editor note'">editor note</option>
        <option value="'definition editor'">definition editor</option>
        <option value="'alternative term'">alternative term</option>
        <option value="'definition source'">definition source</option>
        </optgroup>
      </select>
      <input type="button" name="button_anno" id="button_anno" value="Add annotaion" onClick="add_anno();">
      <br>
      All the listed annotation 
      terms will be added to section 7 automatically.</div>
      <div class="messagebox" id="messageBoxAnnotation" style="display:none"></div>
      </td>
  </tr>
  <tr>
    <td style="padding-left:16px"><textarea name="anno_tpl" cols="90" rows="5" id="anno_tpl" wrap="off"><?php echo $anno_tpl?></textarea></td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(5) Equivalent classes (<span class="darkred">use comma to separate classes</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px"><textarea name="equi_tpl" cols="90" rows="5" id="equi_tpl"><?php echo $equi_tpl?></textarea></td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(6) Superclasses (<span class="darkred">use comma to separate classes</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">
      <div><select name="sup_col" id="sup_col">
<?php 
for ($i=1; $i<=26; $i++) {
?>
<option value="{$column<?php echo strtoupper(convertIntToAlphabet($i))?>}">column <?php echo strtoupper(convertIntToAlphabet($i))?></option>
<?php 
}
?>      
      </select>
 as 
      <select name="sup_col_type" id="sup_col_type">
<option value="uri">full or partial term URI</option>
<option value="label">term label</option>
      </select>
      <input type="button" name="button_sup" id="button_sup" value="Add parent class" onClick="add_sup();"></div>
      <div class="messagebox" id="messageBoxSuperclass" style="display:none"></div>

      </td>
  </tr>
  <tr>
    <td style="padding-left:16px"><textarea name="sup_tpl" cols="90" rows="6" id="sup_tpl" wrap="off"><?php echo $sup_tpl?></textarea></td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(7) Terms  used to define anntoations, equivalent classes and superclasses (<span class="darkred">one line per term</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Examples: <a href="javascript:add_extra_eg('AnnotationProperty', 'label', 'http://www.w3.org/2000/01/rdf-schema#label')">rdfs:label</a>, <a href="javascript:add_extra_eg('AnnotationProperty', 'preferred term', 'http://purl.obolibrary.org/obo/IAO_0000111')">iao:preferredTerm</a>, <a href="javascript:add_extra_eg('AnnotationProperty', 'definition', 'http://purl.obolibrary.org/obo/IAO_0000115')">iao:definition</a>, <a href="javascript:add_extra_eg('AnnotationProperty', 'alternative term', 'http://purl.obolibrary.org/obo/IAO_0000118')">iao:alternative term</a>. </td>
  </tr>
  <tr>
    <td style="padding-left:16px">
      <select name="extra_term_type" id="extra_term_type">
        <option value="Class">Class</option>
        <option value="ObjectProperty">ObjectProperty</option>
        <option value="AnnotationProperty">AnnotationProperty</option>
        <option value="DataProperty">DataProperty</option>
      </select>
      <input name="extra_term_label" id="extra_term_label" size="30">
      has
      URI
<input name="extra_term_uri" id="extra_term_uri" value="http://pur.obolibrary.og/obo/" size="50">
      <input type="button" name="button_sup2" id="button_sup2" value="Add" onClick="add_extra();">
      
      <div class="messagebox" id="messageBoxExtraTerms" style="display:none"></div>
      </td>
  </tr>
  <tr>
    <td style="padding-left:16px"><textarea name="extra_terms" cols="90" rows="8" id="extra_terms" wrap="off"><?php echo $extra_terms?></textarea></td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(8) Term URIs:</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Start with:
      <input name="term_uri_start_with" id="term_uri_start_with" value="<?php echo $term_uri_start_with?>" size="80"></td>
  </tr>
  <tr>
    <td style="padding-left:16px; padding-top:10px"><strong>(9) Auto-generated term ID:</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Prefix:
      <input name="term_id_prefix" id="term_id_prefix" value="<?php echo $term_id_prefix?>" size="10">
      , number of digits:
      <select name="term_id_digits" id="term_id_digits">
        <?php 
for ($i=1; $i<=16; $i++) {
?>
        <option value="<?php echo $i?>" <?php  if ($i==$term_id_digits) {?> selected <?php  }?>>
          <?php echo $i?>
          </option>
        <?php 
}
?>
      </select>
      ,
      start from:
      <input name="term_id_start" id="term_id_start" value="<?php echo $term_id_start?>" size="10"></td>
  </tr>
  <tr>
    <td align="center" style="padding-top:12px"><input type="submit" name="Submit1" value="Get OWL(RDF/XML) Output File"  onClick="javascript: document.getElementById('formMain').action='domapping.php';"/>
      <input type="submit" name="Submit2" value="Generate Ontorat Settings File" style="margin-left:40px;" onClick="javascript: document.getElementById('formMain').action='getsettings.php';" /><input type="reset" name="Submit3" value="Reset" style="margin-left:40px;"></td>
  </tr>
</table>
</form>
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
