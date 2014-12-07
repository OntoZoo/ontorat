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
<html><!-- InstanceBegin template="../Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontorat</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="../css/styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<?php include_once('../inc/googleanalytics.php') ?>
</head>

<body>
<div id="topbanner"><a href="/index.php" style="font-size:36px; color:#111144; text-decoration:none"><img src="../images/logo.gif" alt="Logo" width="280" height="49" border="0"></a></div>
<div id="topnav"><a href="../index.php" class="topnav">Home</a><a href="../intro.php" class="topnav">Introduction</a><a href="index.php" class="topnav">Tutorial</a><a href="../designtemplates/index.php" class="topnav">Templates</a><a href="../faqs.php" class="topnav">FAQs</a><a href="../refs.php" class="topnav">References</a><a href="../links.php" class="topnav">Links</a><a href="../contactus.php" class="topnav">Contact Us</a><a href="../ack.php" class="topnav">Acknowledge</a><a href="../news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->




<h3><span class="header_darkred">Tutorial</span></h3>
<p>Here we provide a tutorial of how Ontorat  can be applied for your research and ontology development: </p>
<p><strong>Table of Contents:</strong></p>
<ol>
  <li><a href="#toc1">Explanation of signs used in Ontorat</a></li>
  <li><a href="#webform">Ontorat execution using web input forms</a></li>
  <li><a href="#settingfile">Ontorat execution using setting file</a></li>
  <li><a href="#input">Ontorat input</a></li>
  <li><a href="#output">Ontorat output</a></li>
  <li><a href="#debugging">Ontorat debugging </a> </li>
  <li><a href="#usecase">Ontorat use cases</a> </li>
</ol>
<p><span id="toc1"><strong>1. Explanation of signs used in Ontorat: </strong></span></p>
<blockquote>
  <p> Ontorat  relies on the pattern program using the OWL  Manchester Syntax, a  syntax designed for writing OWL class expressions (<a href="http://www.w3.org/TR/owl2-manchester-syntax/">http://www.w3.org/TR/owl2-manchester-syntax/ </a>). For example, based on the Manchester Syntax, the full IRI is defined as: </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fullIRI&nbsp;:= <em>an IRI as defined in [<a href="http://www.w3.org/TR/owl2-manchester-syntax/#ref-rfc-3987" title="">RFC 3987</a>], enclosed in a pair of &lt; (U+3C) and &gt; (U+3E) characters</em></p>
  <p>The following table list some  commonly used OWL  Manchester Syntax keywords:</p>
  <blockquote>
    <table bgcolor="#333333" border="0" cellpadding="5" cellspacing="1">
      <tbody>
        <tr>
          <th bgcolor="#FFFFFF">OWL restrictions </th>
          <th bgcolor="#FFFFFF">DL Symbol </th>
          <th bgcolor="#FFFFFF">Manchester OWL Syntax</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <th bgcolor="#FFFFFF">OWL Boolean class constructors </th>
          <th bgcolor="#FFFFFF">DL Symbol </th>
          <th bgcolor="#FFFFFF">Manchester OWL Syntax</th>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">someValuesFrom</td>
          <th bgcolor="#FFFFFF">&exist;</th>
          <th bgcolor="#FFFFFF">some</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <td bgcolor="#FFFFFF">intersectionOf</td>
          <th bgcolor="#FFFFFF">&#8851;</th>
          <th bgcolor="#FFFFFF">and</th>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">allValuesFrom</td>
          <th bgcolor="#FFFFFF">&forall;</th>
          <th bgcolor="#FFFFFF">only</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <td bgcolor="#FFFFFF">unionOf</td>
          <th bgcolor="#FFFFFF">&#8852;</th>
          <th bgcolor="#FFFFFF">or</th>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">hasValue</td>
          <th bgcolor="#FFFFFF">&ni;</th>
          <th bgcolor="#FFFFFF">value</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <td bgcolor="#FFFFFF">complementOf</td>
          <th bgcolor="#FFFFFF">&not;</th>
          <th bgcolor="#FFFFFF">not</th>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">minCardinality</td>
          <th bgcolor="#FFFFFF">&ge;</th>
          <th bgcolor="#FFFFFF">min</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <td bgcolor="#FFFFFF">&nbsp; </td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">cardinality</td>
          <th bgcolor="#FFFFFF">=</th>
          <th bgcolor="#FFFFFF">exactly</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">maxCardinality</td>
          <th bgcolor="#FFFFFF">&le;</th>
          <th bgcolor="#FFFFFF">max</th>
          <th bgcolor="#FFFFFF">&nbsp;</th>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </blockquote>
  <p>More information about the  OWL  Manchester Syntax can be found on: <a href="http://www.co-ode.org/resources/reference/manchester_syntax/">http://www.co-ode.org/resources/reference/manchester_syntax/</a>. </p>
  <p>The following table lists some  syntax formats commonly used in Ontorat:  </p>
  <blockquote>
    <table bgcolor="#333333" border="0" cellpadding="5" cellspacing="1">
      <tbody>
        <tr>
          <th bgcolor="#FFFFFF">#</th>
          <th bgcolor="#FFFFFF">Construct</th>
          <th bgcolor="#FFFFFF">Syntax</th>
          <th bgcolor="#FFFFFF">Example </th>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">1</td>
          <th bgcolor="#FFFFFF">Column content </th>
          <td bgcolor="#FFFFFF"><div align="center">Curly braces of $columnX </div></td>
          <td bgcolor="#FFFFFF"><div align="center">{$columnA} for column A </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">2
              </th>
          <th bgcolor="#FFFFFF">Class name </th>
          <td bgcolor="#FFFFFF"><div align="center">Single quoted </div></td>
          <td bgcolor="#FFFFFF"><div align="center">'label', 'seeAlso', 'definition editor' (Note: use single quotes even for single word) </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">3
              </th>
          <th bgcolor="#FFFFFF">String annotation</th>
          <td bgcolor="#FFFFFF"><div align="center">Double quoted </div></td>
          <td bgcolor="#FFFFFF"><div align="center">&quot;{$columnB}&quot; (Note: the quoted content is considered as a string</div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">4</td>
          <th bgcolor="#FFFFFF">Full IRI </th>
          <td bgcolor="#FFFFFF"><div align="center">&lt;Full IRI&gt;</div></td>
          <td bgcolor="#FFFFFF"><div align="center">&lt;http://pur.obolibrary.og/obo/VO_0000001&gt; <br/>
            &lt;{$columnA}&gt; (Note: when column A has a full IRI) <br/>
            &lt;http://pur.obolibrary.og/obo/{$columnA}&gt; (Note: when columnA  has ontology ID) </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">5</td>
          <th bgcolor="#FFFFFF">Annotation</th>
          <td bgcolor="#FFFFFF"><div align="center">'Annotation property name' &quot;annotation&quot; </div></td>
          <td bgcolor="#FFFFFF"><div align="center">'label' &quot;{$columnB}&quot; (Note: use column B content as ontology term label) <br/>
            'label'  &quot;{$columnA} ({$columnB})&quot; (Note: merge columns A and B for label), </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">6</td>
          <th bgcolor="#FFFFFF">Parent class </th>
          <td bgcolor="#FFFFFF"><div align="center">Single quoted class name </div></td>
          <td bgcolor="#FFFFFF"><div align="center">&lt;http://pur.obolibrary.og/obo/{$columnD}&gt; (Note:  prefix not needed if it's part of columnD </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">7</td>
          <th bgcolor="#FFFFFF">Class logical definition</th>
          <td bgcolor="#FFFFFF"><div align="center">Relation some/or/only class </div></td>
          <td bgcolor="#FFFFFF"><div align="center">'is_manufactured_by' some ({$columnN}) (Note: ( ) is needed if ColumnN has &gt;1 classes) </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">8</td>
          <th bgcolor="#FFFFFF"><strong>Ontology terms used for definitions</strong></th>
          <td bgcolor="#FFFFFF"><div align="center">'term name': class full IRI </div></td>
          <td bgcolor="#FFFFFF"><div align="center">'is_manufactured_by': &lt;http://purl.obolibrary.org/obo/OBI_0000304&gt;</div></td>
        </tr>
      </tbody>
    </table>
  </blockquote>
</blockquote>
<p><span id="webform"><strong>2. Ontorat input using  web input forms:</strong></span></p>
<p>Ontorat provides a user-friendly web form for data input. The steps using the web form to generate Ontorat input include: </p>
<ol>
  <li><strong> Specify a target ontology in OWL format</strong>. The target ontology is used to avoid the assignment of repeated ontology identifiers (IDs). The ontology can be provided by specifying (i) a web URI that points to an ontology OWL file, or (ii) a local file location. The tutorial also provides an example ontology OWL file. <br/>
    <strong>NOTE</strong>: the OWL file must be a merged OWL file and do not have any import.</li>
  <li>	<strong>Specify the data input file</strong> (an Excel file or tab-delimited text file). This file provides the input data for high throughput processing. Each column of the data file needs to be very specific. The data input file can be provided by specifying (i) a web URI that points to an ontology OWL file, or (ii) a local file location. We also provide an example Excel file and an example tab-delimited text file.<br/>
    <strong>NOTE: </strong>Please do not forget to include the information of the row number that start to include the actual data after the term: <strong>Actual data starts from row</strong>. </li>
  <li><strong>Purpose of the new axiom generation</strong>, for example, generating new ontology classes or providing annotations.<br>
  </li>
  <li>	<strong>Annotations</strong>. The ontology design pattern is generated using the class expressions with variables. A user will need to generate a script to represent the ontology design pattern using the Manchester OWL Syntax (see the above table). An internally designed code is used to represent different columns (i.e., variables). For example, we use $columnA to represent the first column (or column A), and use $columnB to represent column B, et al. Each column represents a variable.<br>
  </li>
  <li><strong>Equivalent classes</strong>. The Manchester OWL Syntax is used to express an equivalent class (see the above table). <br>
  </li>
  <li><strong>Superclasses using the Manchester OWL Syntax</strong>. The Manchester OWL Syntax is used to express an equivalent class (see the above table). <br>
  </li>
  <li><strong>Terms used to define annotations, equivalent classes and superclasses</strong>. Those terms may be typed using term labels. In this section, the term labels are specified by ontology URI. This way Ontorat can map the labels with specific ontology URIs. Note that there is no need to define those annotation properties listed by Ontobee, including RDF schema annotation properties 'label', 'comment', and 'seeAlso', and IAO annotation terms 'editor preferred term', 'example of usage', 'has curation status', 'definition', 'editor note', 'definition editor', 'alternative term', and 'definition source'.) <br>
  </li>
  <li><strong>Term URI start content,</strong> i.e., a URI as the start of an ontology before an ontology ID, for example, http://pur.obolibrary.og/obo/ for OBO foundry library terms..<br>
  </li>
  <li><strong>Auto-generated term ID</strong>. Three data items are needed: <strong>prefix</strong>, <strong>number of digits</strong>, and <strong>start number</strong>. The information will be used for automatically generating unique term IDs.    </li></ol><blockquote>
                           
</blockquote>
<p><span id="settingfile"><strong>3. </strong></span><strong>Ontorat execution setting using Ontorat setting file: </strong></p>
<p>Ontorat provides a single setting file that contains all the information of settings for an Ontorat execuation. The following is an example (Note: this includes the same content as the  <a href="../examples/eg1_settings.txt">Example 1 setting file</a>, with an exception of including more comments here): </p>
<blockquote>
<p>[Online URL of the target OWL file (RDF/XML format)]<br>
  # Note: Local file won't be used by Ontorat for security reason. However, you can use local file using the Ontorat web form. <br>
  # Note: You can still use the setting file without the indication of the target OWL file. The setting file can be used to store the setting and can be loaded to the web form automatically on the Ontorat page. <br>
# Note: Any notes after # are considered as comments and will be ignored by the Ontorat program. </p>
<p><br>
[Online URL of the data file (Only Excel file (.xls, .xlsx) or tab-delimited text file (.txt)]<br>
  # Note: Local file won't be used by Ontorat for security reason. However, you can use local file using the Ontorat web form. <br>
# Note: You can still use the setting file without the indication of the data input file. The setting file can be used to store the setting and can be loaded to the web form automatically on the Ontorat page. </p><br>
<p>Actual data starts from row: 2 
<br/># The data input file often includes a header row that indicates the contents of each column. So real data often starts from row #2. <br>
</p>
<p>[New axioms will be used to]<br>
  # Note: two options: 1. &quot;generate new classes&quot;, <br>
  # or 2. &quot;edit existing classes with term IDs defined in column A(or another letter)&quot;<br>
  generate new classes<br>
  <br>
  [Annotations]<br>
  # Note: Use comma to separate annotations; Quote annotation property terms using single quotes ' ' even for a single word of annotation property term. <br>
  'label' &quot;{$columnA} ({$columnB})&quot;, # space can be added inside quotes. <br>
  'seeAlso' &quot;{$columnB}&quot;,  # anything after a space+# until the end of the line will be comments and be ignored by Ontorat program. <br>
  'seeAlso' &quot;violinID:{$columnO}&quot;</p>
<p>[Equivalent classes]<br>
  # Note: Use comma to separate classes; See below for some syntax example. </p>
<p>[Superclasses]<br>
  # Note: Use comma to separate classes <br>
  &lt;http://pur.obolibrary.og/obo/{$columnD}&gt;,<br>
  'vaccine immunization against microbe' some &lt;http://pur.obolibrary.og/obo/NCBITaxon_{$columnF}&gt;,<br>
  'vaccine immunization for host' some &lt;http://pur.obolibrary.og/obo/NCBITaxon_{$columnH}&gt;,<br>
  'bearer_of' some &lt;http://pur.obolibrary.og/obo/{$columnL}&gt;,<br>
  'is_manufactured_by' some ({$columnN})</p>
<p>[Terms used to define anntoations, equivalent classes and superclasses]<br>
  # Note: One line per term<br>
  AnnotationProperty: <br>
  Class:<br>
  ObjectProperty: <br>
  'is_manufactured_by': &lt;http://purl.obolibrary.org/obo/OBI_0000304&gt; <br>
  'bearer_of': &lt;http://purl.obolibrary.org/obo/bearer_of&gt; <br>
  'vaccine immunization for host': &lt;http://pur.obolibrary.og/obo/VO_0001243&gt; <br>
  'vaccine immunization against microbe': &lt;http://pur.obolibrary.og/obo/VO_0003355&gt; <br>
  DataProperty:</p>
<p>[Term URIs start with]<br>
  # Note: provide a prefix ontology URIs<br>
  http://pur.obolibrary.og/obo/</p>
<p>[Auto-generated term ID]<br>
  # Note: Prefix like &quot;VO_&quot;, number of digits like &quot;7&quot;, and start from like &quot;1&quot;.<br>
  Prefix: VO_<br>
  Number of digits: 7<br>
  Start from:  1<br>
  </blockquote>
</p>
<p><span id="input"><strong>4. Ontorat input: </strong></span></p>
<p>The Ontorat input data file can be in an Excel format or in a tab-delimited text format. You can include more columns (e.g., for confirmation purpose) in the input data file than what you need for Ontorat. Ontorat will automatically extract the  content of any column specified in your syntax (See the above tables). </p>
<p><span id="output"><strong>5. Ontorat output: </strong></span></p>
<p>The Ontorat output is an OWL file. Using the  Prot&eacute;g&eacute; ontology editor (<a href="http://protege.stanford.edu/">http://protege.stanford.edu/</a>),  an Ontorat output OWL file can be directly visualized and imported (or merged)  in the target ontology (<em>e.g.</em>, VO)  using the OWL import function.</p>
<p><span id="debugging"><strong>6. Ontorat debugging: </strong></span></p>
<p>If you have a problem in executing Ontorat, it means that there is some bug in the execuration. You will need to carefully examine every detail, including your input data format, script generation, needed information, etc. Ontorat will provide some warning or error message when something is wrong. To better support bebugging, you can download the output file in the Manchester Syntax format. The Ontorat error message page will provide some clue on which line(s) of the Manchester Syntax format output document has a problem. You can then trace it out. If you need help, please do not hesitate and feel free to contact the Ontorat development team for help. </p>
<p><span id="usecase"><strong>7. </strong></span><strong>Use cases: </strong></p>
<p>Please go to the<a href="../designtemplates/index.php"><strong> Ontorat Templates page</strong></a> to identify all the use cases done with Ontorat. </p>
<p>&nbsp;</p>
<p><strong>Explanation:</strong> This use case study aimed to use Ontorat to generate new VO terms for a list of USDA-licensed animal vaccines. The Ontorat input  Excel file and text file contain the same information. The Ontorat can be used to include the following information to the annotations or logical axiom definitions: vaccine name, parent term, host, pathogen, manufacturer,  VIOLIN_ID. The vaccine names are the labels of to-be-generated  VO classes. Manchester OWL Syntax scripts for expressing the axioms associating  the vaccine with other contents are generated and inserted to the Ontorat web  forms. It is noted that besides the relations between classes, Ontorat also  allows the generation of annotations using annotation properties (<em>e.g.</em>, see_Also and term definition). The Ontorat  output OWL file can be directly imported to VO. &nbsp;&nbsp;&nbsp;</p>
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
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="../images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
</body>
<!-- InstanceEnd --></html>
