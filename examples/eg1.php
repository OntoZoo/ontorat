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

$data_start_row=2;

$target_owl_url='http://ontorat.hegroup.org/examples/vo.owl';
$data_file_url='http://ontorat.hegroup.org/examples/eg1_data_file.xlsx';

$anno_tpl='\'label\' "{$columnA}", #read labels from column A

\'seeAlso\' "VIOLIN_vaccine_ID: {$columnB}", #add column B as a reference ID

\'comment\' "Manufacturer: {$columnC}" #add column C as a comment';

$sup_tpl='#define pathogen below
(\'administered_to_ameliorate\' some (\'infection_of\' some <http://purl.org/obo/owl/NCBITaxon#NCBITaxon_{$columnE}>))
 or (\'administered_to_prevent\' some (\'infection_of\' some <http://purl.org/obo/owl/NCBITaxon#NCBITaxon_{$columnE}>)),

#define vaccine host below
\'is_specified_input_of\' some (\'vaccination\' and (\'has_specified_input\' 
    some (<http://purl.org/obo/owl/NCBITaxon#NCBITaxon_{$columnD}> 
    and (\'has_role\' some \'host role\')))),

#define licensed country/region
(\'bearer_of\' some \'licensed vaccine role\') and (\'location_of\' some \'USA\'),

#define parent term
\'vaccine\'';

$extra_terms='ObjectProperty: 
\'is_specified_input_of\': <http://purl.obolibrary.org/obo/OBI_0000295>
\'has_specified_input\': <http://purl.obolibrary.org/obo/OBI_0000293>
\'has_role\': <http://purl.obolibrary.org/obo/OBI_0000316>
\'bearer_of\': <http://www.obofoundry.org/ro/ro.owl#bearer_of>
\'location_of\': <http://www.obofoundry.org/ro/ro.owl#location_of>
\'administered_to_ameliorate\': <http://purl.obolibrary.org/obo/VO_0000570>
\'administered_to_prevent\': <http://purl.obolibrary.org/obo/VO_0000637>
\'infection_of\': <http://purl.obolibrary.org/obo/VO_0000445>

Class:
\'vaccination\': <http://purl.obolibrary.org/obo/VO_0000002>
\'vaccine\': <http://purl.obolibrary.org/obo/VO_0000001>
\'licensed vaccine role\': <http://purl.obolibrary.org/obo/VO_0000630>
\'USA\': <http://purl.obolibrary.org/obo/VO_0010633>
\'host role\': <http://purl.obolibrary.org/obo/OBI_0000725>

AnnotationProperty:

DataProperty:

';

$term_id_prefix='VO_';


?>