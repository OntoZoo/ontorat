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




<h3><span class="header_darkred">ODP  Pattern and QTT template: VO Vaccine</span></h3>
<p>&nbsp;</p>
<p><span><strong>1. Introduction:</strong></span></p>
<blockquote>
  <p><strong>Task: </strong>Generate new VO terms representing a list of USDA-licensed animal vaccines.</p>
  <p>This use case study aimed to use Ontorat to generate new VO terms for a list of USDA-licensed animal vaccines. The Ontorat input  Excel file and text file contain the same information. The Ontorat can be used to include the following information to the annotations or logical axiom definitions: vaccine name, parent term, host, pathogen, manufacturer,  VIOLIN_ID. The vaccine names are the labels of to-be-generated  VO classes. Manchester OWL Syntax scripts for expressing the axioms associating  the vaccine with other contents are generated and inserted to the Ontorat web  forms. It is noted that besides the relations between classes, Ontorat also  allows the generation of annotations using annotation properties (<em>e.g.</em>, see_Also and term definition). The Ontorat  output OWL file can be directly imported to VO. &nbsp;&nbsp;&nbsp;</p>
</blockquote>
<p><span><strong>2. ODP Ontology Design Pattern:</strong></span></p>
<blockquote>
  <p>The design pattern for this case is shown by the design pattern diagram below:  &nbsp;&nbsp;&nbsp;</p>
  <p><img src="pattern_vaccine.jpg" alt="VO vaccine design pattern" width="750" border="1"></p>
</blockquote>
<p>&nbsp;</p>
<p><span id="toc1"><strong>2. QTT template (Ontorat setting file): </strong></span></p>
<p>The QTT setting file is here:</p>
<ul>
  <li>Setting file: <a href="../../examples/eg1_settings.txt">eg1_settings.txt</a> (.txt format)</li>
  </ul>
<p></p>
<p><span id="toc1"><strong>3. Ontorat input files: </strong></span></p>
<p>The Ontorat input files are provided below: </p>
<ul>
  <li>Input data: <a href="../../examples/eg1_data_file.xlsx">eg1_data_file.xlsx</a>, or <a href="../../examples/eg1_data_file.txt">eg1_data_file.txt</a> (.txt format)</li>
  <li>Target ontology: <a href="../../examples/vo.owl">vo.owl (version: 1.0.623)</a></li>
  </ul>
<p><strong>Note:</strong> The VO target ontology is not the same as the most updated VO version. The version of VO is cited here to match the output results provided below. </p>
<p></p>
<p><span id="toc1"><strong>4. Ontorat output OWL file: </strong></span></p>
<p>The Ontorat output files are provided below:</p>
<ul>
  <li>Output: <a href="../../examples/eg1_output.owl">eg1_output.owl </a> (.owl format)</li>
  <li>Updated input file that includes newly assigned term IDs: ... </li>
</ul>
<p><span id="toc1"><strong>Note: </strong>The updated input file that includes newly assigned term IDs is provided here for different usages. </span></p>
<p>&nbsp;</p>
<p><strong>Note:</strong> More information about this example can be found here: <a href="http://ontorat.hegroup.org/Ontorat_poster_ICBO2012.pdf">http://ontorat.hegroup.org/Ontorat_poster_ICBO2012.pdf</a>. </p>
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
