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




<h3><span class="header_darkred">Design  Pattern, Template, and Example:  VO Vaccine</span></h3>
<p>&nbsp;</p>
<p><strong>Task: </strong>Generate new VO terms representing a list of USDA-licensed animal vaccines.</p>
<blockquote>
  <p>This use case study aimed to use Ontorat to generate new VO terms for a list of USDA-licensed animal vaccines. The Ontorat input  Excel file and text file contain the same information. The Ontorat can be used to include the following information to the annotations or logical axiom definitions: vaccine name, parent term, host, pathogen, manufacturer,  VIOLIN_ID. The vaccine names are the labels of to-be-generated  VO classes. Manchester OWL Syntax scripts for expressing the axioms associating  the vaccine with other contents are generated and inserted to the Ontorat web  forms. It is noted that besides the relations between classes, Ontorat also  allows the generation of annotations using annotation properties (<em>e.g.</em>, see_Also and term definition). The Ontorat  output OWL file can be directly imported to VO. &nbsp;&nbsp;&nbsp;</p>
</blockquote>
<p><span><strong>1. ODP Ontology Design Pattern:</strong></span></p>
<blockquote>
  <p>The design pattern for this case is shown by the design pattern diagram below:  &nbsp;&nbsp;&nbsp;</p>
  <p><img src="pattern_vaccine.jpg" alt="VO vaccine design pattern" width="850"></p>
</blockquote>
<p>&nbsp;</p>
<p><span id="toc1"><strong>2. Ontorat Template Files: </strong></span></p>
<blockquote>
  <p>Ontorat setting file: <a href="Ontorat_settings_vaccine.txt"> Ontorat_settings_vaccine.txt</a> (.txt format)</p>
  <p>Ontorat input template file: <a href="Ontorat_input_vaccine_template.xlsx">Ontorat_input_vaccine_template.xslx</a> (.xlsx format)</p>
  <p>&nbsp;</p>
</blockquote>
<p><span id="toc1"><strong>3. Ontorat Example: </strong></span></p>
<blockquote>
  <p><strong>Introduction: </strong>This example aims to add mouse strain terms into the Beta Cell Genomics Ontology (BCGO). </p>
  <p>Ontorat input data file (based on template): <a href="Ontorat_input_vaccine.xlsx">Ontorat_input_vaccine.xlsx</a> (.xlsx format)</p>
  <p>Ontorat output file: <a href="Ontorat_output_vaccine.owl">Ontorat_output_vaccine.owl</a> (.owl format)</p>
  <p>Ontorat output new IDs file when adding new ontology classes: <a href="Ontorat_output_newIds_vaccine.xlsx">Ontorat_output_newIds_vaccine.xlsx</a> (.xlsx format)</p>
  <p>&nbsp;</p>
  </blockquote>
<p><strong>Note:</strong> This example is slightly different from the example used in the <a href="http://ontorat.hegroup.org/index.php?settings_file_url=http://ontorat.hegroup.org/examples/eg1_settings.txt">Ontorat hands-on demo</a>, which is more complex and uses a relatively old version of VO. </p>
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
