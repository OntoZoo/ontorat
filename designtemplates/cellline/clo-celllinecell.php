<!-- 
Copyright © 2014 The Regents of the University of Michigan
 
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at
 
http://www.apache.org/licenses/LICENSE-2.0
 
Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 
For more information, questions, or permission requests, please contact:
Yongqun "Oliver" He - yongqunh@med.umich.edu
Unit for Laboratory Animal Medicine, Center for Computational Medicine & Bioinformatics
University of Michigan, Ann Arbor, MI 48109, USA
He Group:  http://www.hegroup.org
-->
<!--
Author: Zuoshuang (Allen) Xiang, Yongqun (Oliver) He
The University Of Michigan
He Group
Date: July 2011 - December 2014
-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="../../Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontorat</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="../../css/styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<?php include_once('../../inc/googleanalytics.php') ?>
</head>

<body>
<div id="topbanner"><a href="/index.php" style="font-size:36px; color:#111144; text-decoration:none"><img src="../../images/logo.gif" alt="Logo" width="280" height="49" border="0"></a></div>
<div id="topnav"><a href="../../index.php" class="topnav">Home</a><a href="../../intro.php" class="topnav">Introduction</a><a href="../../tutorial/index.php" class="topnav">Tutorial</a><a href="../index.php" class="topnav">Templates</a><a href="../../faqs.php" class="topnav">FAQs</a><a href="../../refs.php" class="topnav">References</a><a href="../../links.php" class="topnav">Links</a><a href="../../contactus.php" class="topnav">Contact Us</a><a href="../../ack.php" class="topnav">Acknowledge</a><a href="../../news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->




<h3><span class="header_darkred">Design Pattern, Template, and Example: CLO Cell Line Cells</span></h3>
<p><strong>Task: </strong>Add Jappan RIKEN cell lines into Cell Line Ontology (CLO) that indicate the cell line repository as 'RIKEN Cell Bank' with rich annotations including label, alternative term, defintion, term editor, and comments about information of cell line derived from which animal tissue, originators of cell line, etc.</p>
<p><span id="toc1"><strong>1. Design Pattern:</strong></span></p>
<blockquote>
  <p>This use case has been reported in the CLO paper:  </p>
  <p>Sarntivijai S, Lin Y, Xiang Z, Meehan TF, Diehl AD, Vempati UD, Sch&uuml;rer   TC, Pang C, Malone J, Parkinson H, Liu Y, Takatsuki T, Saijo K, Masuya   H, Nakamura Y, Brush MH, Haendel MA, Zheng J, Stoeckert CJ, Peters B,   Mungall CJ, Carey TE, States DJ, Athey BD, He Y. <a href="http://www.jbiomedsem.com/content/5/1/37/abstract">CLO: The Cell Line Ontology</a>. <em>Journal of Biomedical Semantics</em>. 2014, <strong>5</strong>:37. doi:10.1186/2041-1480-5-37. </p>
  <p><strong>Design pattern diagram: </strong></p>
  <p><img src="pattern_cellline.jpg" alt="cell line cell ODP" width="600"></p>
  <p>&nbsp;</p>
  <p><strong>Notes</strong>: The example contains only 10 RIKEN cell lines. Current Ontorat does not support individual. Since 'RIKEN Cell Bank' is an instance, minor modification need to be made of Ontorat output OWL file to change class to individual.</p>
  </blockquote>
<p>&nbsp;</p>
<p><span id="toc1"><strong>2. Ontorat Template Files: </strong></span></p>
<blockquote>
  <p>Ontorat setting file: <a href="Ontorat_settings_cellline.txt">Ontorat_settings_cellline.txt</a> (.txt format)</p>
  <p>Ontorat input template file: <a href="Ontorat_input_cellline_template.xlsx">Ontorat_input_cellline_template.xlsx</a> (.xlsx format)</p>
  <p>&nbsp;</p>
</blockquote>
<p><span id="toc1"><strong>3. Ontorat Example: </strong></span></p>
<blockquote>
  <p><strong>Introduction: </strong>This example aims to add cell line cells based on the CLO. The input data is a list of cell line cells collected from the Japan Rikens institute. </p>
  <p>Ontorat input data file (based on template): <a href="Ontorat_input_cellline.xlsx">Ontorat_input_cellline.xlsx</a><a href="ontoRat_input_assay.xlsx"></a> (.xlsx format)</p>
  <p>Ontorat output file: </a><a href="Ontorat_output_cellline.owl">Ontorat_output_cellline.owl</a>  (.owl format)</p>
  <p>Ontorat output new IDs file when adding new ontology classes: <a href="Ontorat_output_newIds_cellline.xlsx">Ontorat_output_newIds_cellline.xlsx</a> (.xlsx format)</p>
  <p>&nbsp;</p>
</blockquote>
<p>Please feel free to <a href="../../contactus.php">contact us</a> for any questions, comments, and suggestions. Thank you! </p>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->
</div>
<div id="footer">
  <div id="footer_hl"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div id="footer_left"><a href="http://www.hegroup.org" target="_blank">He Group</a><br>
University of Michigan Medical School<br>
Ann Arbor, MI 48109</div></td>
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="../../images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
</body>
<!-- InstanceEnd --></html>
