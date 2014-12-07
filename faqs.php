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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<?php include_once('inc/googleanalytics.php') ?>
</head>

<body>
<div id="topbanner"><a href="/index.php" style="font-size:36px; color:#111144; text-decoration:none"><img src="images/logo.gif" alt="Logo" width="280" height="49" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="intro.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="designtemplates/index.php" class="topnav">Templates</a><a href="faqs.php" class="topnav">FAQs</a><a href="refs.php" class="topnav">References</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact Us</a><a href="ack.php" class="topnav">Acknowledge</a><a href="news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<h3 class="header_darkred">Frequently Asked Questions</h3>
<p><strong>1. What is Ontorat? </strong></p>
<p> Ontorat is a web server that provides template-based axiom representation for quickly (1) generating new ontology terms and axioms or (2) providing annotations and axiom definitions to existing ontology terms.  </p>
<p><strong>2. What's the targeted users of Ontorat?</strong></p>
<p>The targetted users of Ontorat are ontology  developers.</p>
<p><strong>3. Does Ontorat rely on RDF store and SPARQL queries? </strong></p>
<p> No. Ontorat does not use RDF store and SPARQL queries. It's developed by PHP/HTML.  </p>
<p><strong>4. What are  the Ontorat template and design pattern? </strong></p>
<p> The Ontorat template is the  Ontorat data input template that specifies the contents of each column of the Ontorat input data file. This template can be generated in   an Excel file or a tab-delimited text file. </p>
<p>The Ontorat design pattern is a set of settings used for representation of a large number of axioms. This  set of setting scripts are used for generating annotations, equivalent classes,  superclasses, and other related information. These scripts can be stored in a single Ontorat setting file. The Ontorat data input template  and  the Ontorat scripts should be matched to each other. </p>
<p>The Ontorat template and design pattern can be reused. To use the Ontorat template, a user can fill in real data to the data input template in an Excel file or a tab-delimited text file. After specifying the locations of the latest version of the target ontology and the input file, and  uploading the setting file (or specifying the setting scripts individually using the web form), you can then run Ontorat by simplying clicking &quot;Get OWL (RDF/XML) Output File&quot; on the Ontorat web page.</p>
<p>If you generate different setting scripts using the Ontorat web form, you can save the settings in an Ontorat setting file automatically by clicking &quot;Generate Ontorat Settings File&quot; on the Ontorat web page. </p>
<p><strong>5. Can we reuse our Ontorat design pattern?</strong></p>
<p>Yes. The Ontorat design pattern is specified in the setting script file that uses the Ontorat input data template file. The settings file and input data template file generated for Ontorat execuation can be reused if the an input file uses the same format and the output target is the same. In the future, we plan to collect a number of commonly used design patterns paired with  Ontorat templates for users to download and use.   </p>
<p><strong>6. What are the common syntax signs used on Ontorat? </strong></p>
<p>For URL, we need to use the sign &lt;&gt; to quote URL. For defining columns, we need to use {}, like {$columnD}. For any  label, we need to use single quotes ' ' to quote the label, like 'has_specified_input'. However, the terms (some, and) can be used directly without any quote in any format. More specific details can be found in the Ontorat <a href="tutorial/index.php">Tutorial</a> page. </p>
<p><strong>7. Can I use an old version of a target ontology? </strong></p>
<p>The target ontology is used in Ontorat to identify currently used ontology term IDs so that Ontorat can automatically generate new ontology term IDs that are unique and have no duplication with  current target ontology. Therefore, please always use the latest version of your target ontoloy. Otherwise, you may find your newly generated ontology terms have the same ontology term IDs with some existing ontology terms. </p>
<p><strong>8. Why a RDF store is not needed for Ontorat execuation? </strong></p>
<p>A RDF store can store ontology contents. Many ontology tools, like <a href="http://ontofox.hegroup.org">OntoFox</a> and <a href="http://www.ontobee.org">Ontobee</a>, need to use a RDF store. However, this is not required in Ontorat. Ontorat only requires the specification of the location of a target ontology. The Ontorat program can parse the ontology and find out which ontology term URIs have been used and should be avoided in generation of new ontology term URIs. </p>
<p><strong>9. A common error: did not specify any ontology terms you used to define axioms. </strong></p>
<p>A very common mistake in Ontorat execution is that we forgot to specify any ontology terms that were used to define axioms. To specify these terms, we need to do them in the section of # <strong>(7) Terms  used to define axioms ... </strong>Even when we directly use an ontology term URI (instead of labels) in the sections of ontology axiom definitions, you still need to  define the URI  in the Section #7 because otherwise, the Ontorat system does not know if the term  is an object property or another type of ontology term. </p>
<p><strong>10. How to find the number of ontology terms generated?</strong></p>
<p>The Ontology metrics program in Protege ontology editor can be used to find out how many ontology terms exist in a newly obtained OWL file. The program is available in the protege menu: Window --&gt; View --&gt; Ontology view --&gt; Ontology metrics. </p>
<p><strong>11. How to merge Ontorat-generataed new ontology terms into a target ontology?</strong></p>
<p>The &quot;Merge ontologies&quot; program under &quot;Refactor&quot; menu of the Protege ontology editor can be used to merge the  OWL file of newly generated ontology terms into a target ontology. This program is easy  to use. Just follow the prompted instruction. </p>
<p><strong>12. Can Ontorat represent instance ontology data? </strong></p>
<p> No yet. This feature is not typically applied   in ontology development. If this proves to be needed by many users, we will develop this feature in Ontorat in the future.</p>
<p><strong>13. Can we use Ontorat without accessing the web interface? </strong></p>
<p>Not now. This feature is not typically needed   in our routine ontology development practice. If this proves to be needed by many users, we can develop an Ontorat Web Service  in the future. </p>
<p><strong>14. What are ontology axioms?  </strong></p>
<p>Ontology axioms are the statements  that provide  explicit  logical assertions about three types of things - classes, individuals and  properties. The other facts which are implicitly contained in the ontology can be inferred using  a piece of software called a reasoner. An OWL ontology is basically written as a set of axioms. See reference: (i) <a href="http://dior.ics.muni.cz/~makub/owl/">http://dior.ics.muni.cz/~makub/owl/</a>; (ii) <a href="http://www.w3.org/TR/owl2-syntax/#Axioms">http://www.w3.org/TR/owl2-syntax/#Axioms</a>; and (iii) <a href="http://en.wikipedia.org/wiki/Ontology_components">http://en.wikipedia.org/wiki/Ontology_components</a>.</p>
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
