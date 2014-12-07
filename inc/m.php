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

$continue=true;
while ($continue) {
	$output = system('curl -s http://www.shopping.hp.com/product/rts_tablet/rts_tablet/1/storefronts/FB355UA%2523ABA |grep "name=\"add_prod_id\" value=\"FB355UA%23ABA\""');
	
	if (strpos($output, 'add_prod_id')!==false) {
		
		sleep(10);
		
		$output = system('curl -s http://www.shopping.hp.com/product/rts_tablet/rts_tablet/1/storefronts/FB355UA%2523ABA |grep "name=\"add_prod_id\" value=\"FB355UA%23ABA\""');
//	}
//	else {
		if (strpos($output, 'add_prod_id')!==false) {
			include('Mail.php');
			$recipients = '7134928145@txt.att.net';
			$headers['From']    = 'zxiang@umich.edu';
			$headers['Reply-To'] = 'zxiang@umich.edu';
			$headers['Date']      = date('r (T)');
			$headers['To']      = '7134928145@txt.att.net';
			$headers['Subject'] = 'HP status changed';
			$body = 'HP status changed';
			$params['host'] = 'mail-relay.itd.umich.edu';
			// Create the mail object using the Mail::factory method
			$mail_object =& Mail::factory('smtp', $params);
			$mail_object->send($recipients, $headers, $body);
			
			$recipients = 'xiangzsh@gmail.com';
			$headers['From']    = 'zxiang@umich.edu';
			$headers['Reply-To'] = 'zxiang@umich.edu';
			$headers['Date']      = date('r (T)');
			$headers['To']      = 'xiangzsh@gmail.com';
			$headers['Subject'] = 'HP status changed';
			$body = 'HP status changed';
			$params['host'] = 'mail-relay.itd.umich.edu';
			// Create the mail object using the Mail::factory method
			$mail_object =& Mail::factory('smtp', $params);
			$mail_object->send($recipients, $headers, $body);
			
			$continue=false;
		}
		else {
			sleep(60);
		}
	}
	else {
		sleep(60);
		
	}
	
	
}


?>