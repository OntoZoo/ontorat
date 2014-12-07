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
<html><!-- InstanceBegin template="Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
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




<h3><span class="header_darkred">Introduction</span></h3>
<p>Development of a new ontology is often time consuming. Different ways to improve the process of ontology development are desired. One pattern during an ontology development is that often we need to add new classes with similar patterns of logical definition. This process is     time consuming,  error prone, and often boring.  Ontorat is developed to facilitate this process. </p>
<p>Ontorat is developed based on Ontology Design Patterns  (OCPs) in the field of ontology engineeering. Ontorat uses &quot;class expressions with variables&quot;, which  is defined as &quot;OWL class expressions but allowing variables at positions of class expressions. The range of a variable can either be a named class, class expression, or any subtype of it as produced by the corresponding rule in OWL.&quot; (Reference: <a href="http://www.uni-ulm.de/fileadmin/website_uni_ulm/iui.inst.090/Publikationen/2009/patterns_WOP2009.pdf">Noppens and Liebig, 2009</a>). Ontorat offers a web-based platform for a user to write up class expressions with variables with the aim to quickly generate a large number of new ontology classes or annotate existing classes for a target ontology. </p>
<p>The inputs  of Ontorat include: (1) a target ontology in OWL format, (2) a user-provided data file (tab-delimited text file or Excel file), and (3) ontology design pattern using the class expressions with variables. The target ontology and user-provided data files will be parsed by our own Ontorat parser. The target ontology can be  used to avoid the assignment of repeated ontology identifiers (IDs). The user-provided data file provides the input data for high throughput processing. Each column of the data file needs to be very specific. A user will need to generate a script to represent the ontoogy design pattern using the <a href="http://www.co-ode.org/resources/reference/manchester_syntax/">Manchester OWL Syntax</a>, a new syntax designed for writing   OWL class expressions. An internally designed code is used to represent different columns (<em>i.e.</em>, variables). For example, we use $coA to represent the first column (or column A), and use $coB to represent the second column (or column B), et al. Each column represents a variable.</p>
<p>The development of Ontorat is inspired by the OBI project <a href="http://obi-ontology.org/page/Quick_Term_Templates">QTT</a> (Quick Term Templates). Ontorat implements the QTT strategy. The QTT has been implemented in MappingMaster, a plugin program in Protege 3.4. <em>Similar to MappingMaster: </em>(1) Ontorat uses an Excel spreadsheet file (or tab-delimited file) as input. (2) Ontorat relies on the pattern program using the OWL Manchester Syntax. <em>Different from MappingMaster: </em>(1) Ontorat is implemented as a web-based application, while MappingMaster works in Protege 3.4 but does not work in Protege 4.x. (2) MappingMaster cannot generate annotations for ontology terms for existing or newly generated ontology classes, for example, MappingMaster cannot automatically generate text definitions of a class term. However, this is not a difficult task in Ontorat if you know a design pattern. (3) MappingMaster cannot save the design patterns as a setting file, while Ontorat can do so. </p>
<p>Ontorat will allow domain experts and data curators to contribute actively to the ontology development without knowing the specifics of OWL. Ontorat is a robust approach can can be used in different ontology development scenarios. </p>
<p>Your suggestions and comments are welcome! The Ontorat development team provides good service and is usually fast to answer your questions. </p>
<p>Thank you for using Ontorat! </p>
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
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
</body>
<!-- InstanceEnd --></html>
