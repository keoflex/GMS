<?php

 $usage="usage: $argv[0] <env> where <env> is one of dev or prod";
 if ($argc < 2) {
 echo  "ERROR: invalid usage \n";
 echo "$usage \n";
 exit(2);
 }

 $env_name = $argv[1];

 $server['prod']	= "xxx.com";
 $server['dev'] 	= "keoflex.net";
 $server['local'] = "localhost";

 if(isset($server[$env_name]))
 {
 	$_SERVER['SERVER_NAME'] = $server[$env_name];
 }
 else
 {
	 echo "error - bad env \n";
	 exit(3);
 }


require_once( "../config.php");
require_once( "../dbcon/config_sqli.php");
require_once( "../dbcon/php_functions.php");
require_once( "../vendor/google/src/Google/autoload.php");
require_once( "../lib/google.php");



$google = new Google();


$query = "SELECT * FROM google_domains";
$result = mysqltng_query($query);

$domains = array();
for($i=0;$i<mysqltng_num_rows($result);$i++){
   $data = mysqltng_fetch_assoc($result);
   $domains[] = array("name"=> $data['name'], "id" => $data['id']);
	}
#print_r($domains);

foreach ($domains as $domain) {
   $domain_name = $domain['name'];
   $domain_id = $domain['id'];

	echo "Domain name: $domain_name =================================== \n";


	$results=$google->getGoogleGroups($domain_name);
	$groups = $results->getGroups();
	#print_r($groups);

	$query = sprintf("SELECT * FROM smart_groups where google_domain_id = %d", $domain_id);
	$result2 = mysqltng_query($query);
   $sg_list=array();
   for($i=0;$i<mysqltng_num_rows($result2);$i++){
		$data = mysqltng_fetch_assoc($result2);
		$sg_list[] = array("name"=> $data["name"], "google_group_id" => $data["google_group_id"], "pattern_condition"=> $data["pattern_condition"]);
		}

	#print_r($sg_list);

  $next = null;
  $page=1;
  $i=1;
  while ($next || $page==1) {
		$results=$google->getGoogleUsers($domain_name,$next);
		$users = $results->getUsers();
		#print_r($users);

		echo "Num users: " . count($users) . "\n";

		foreach($users as $user){
			 $email_value = $user['primaryEmail'];

if ($env_name == "dev") {
	if ($email_value != "christyvol@dumasschools.net" && $email_value != "joeparttime@dumasschools.net" && $email_value != "joeteacher@dumasschools.net" ) continue;
	}
else {
	if ($email_value != "28jimtest@dumasisd.org" && $email_value != "28joetest@dumasisd.org" && $email_value != "28jantest@dumasisd.org" &&
		 $email_value != "28jimtest@disd.me" && $email_value != "28joetest@disd.me" && $email_value != "28jantest@disd.me") continue;
	}
			echo  $email_value . "\n";

			 #print_r($user);
			 echo $i . " " . $user['name']['givenName'] . " " . $user["primaryEmail"] . " " . $user['orgUnitPath'] . " suspended: " . $user['suspended'] . "\n";
			 $org_unit = $user['orgUnitPath'];
			 $organizations = array();
			 if (isset($user['organizations']))
				$organizations = $user['organizations'];
			 $employee_type=$employee_title=$costcenter=$manager_email=$department="";
		foreach($organizations as $org) {
				  if (isset($org['description'])) 
			 $employee_type = $org['description'];
				  if (isset($org['title'])) 
			 $employee_title = $org['title'];
				  if (isset($org['costCenter'])) 
			 $costcenter = $org['costCenter'];
				  if (isset($org['department'])) 
			 $department = $org['department'];
				  break; # just use the first value
				  }
			 $relations = array();
			 if (isset($user['relations']))
				 $relations = $user['relations'];
		foreach($relations as $relation) {
			 $type = $relation['type'];
			 if ($type != "manager") continue;
			 $manager_email = $relation['value'];
				  break; # just use the first value
				  }

			 echo "  type: $employee_type title: $employee_title costcenter: $costcenter mgremail: $manager_email dept: $department \n";

			 #if (count($organizations) > 0) print_r($organizations);
			 #if (count($relations) > 0) print_r($relations);

			 $suspended=0;
			 if ($user['suspended'] == 1)
				  $suspended=1;

			 reset($sg_list);
			 foreach ($sg_list as $sg) {
				  echo "  " . $sg['name'] . " " . $user['id'] . "\n";
				  $group_id = $sg['google_group_id'];
				  #$group_id = "03x8tuzt2gq5esc";
				  $match=0;
				  $json = $sg['pattern_condition'];
				  $query = json_decode(utf8_encode($json), true);
				  #print_r($query);
				  # this function assumes that these variables exist: $email_value, $department, $costcenter, $manager_email, $employee_type, $employee_title
				  $query_str = condition_parser($query);

				  echo "conditions: $query_str \n";
				  eval('$found = '.$query_str.';');

							 if ($found) {
								  echo "  match \n";
								  $match=1;
								  $member = $google->getGroupMember($group_id, $user['id']);
								  if (!$member) {
										echo "  not yet a member, so add \n";
										$google->addUserToGroup($user['primaryEmail'],$group_id);
								  } else {
										echo "  already a member \n";
								  }

							 } else {
								  echo "  no match for $email_value with the query: $query_str\n";
							 }

			 if (!$match || $suspended) {
				  $member = $google->getGroupMember($group_id, $user['id']);
				  if ($member) {
						echo "  already a  member, so delete \n";
						$google->deleteUserFromGroup($user['id'],$group_id);
				  } else {
						echo "  not yet a member \n";
				  }
			 }

			 }
			 $i++;
		}



		$next = $results->getNextPageToken();
		$page++;
		}
  echo "page: $page \n";
  }





    function condition_parser($query) {
        $CONDITIONS = array("AND"=> '&&', "OR"=> '&&');
        $condition = $CONDITIONS[$query['condition']];
        $j=0;
        $statement ="(";
        foreach ($query['rules'] as $rule) {
            if ($j>0) $statement .=  " $condition ";
            if ($rule['id']) {
                $f = $rule['field'];
                switch ($rule['operator']) {
                    case "begins_with":
                    case "ends_with":
                    case "contains":
                        $statement .= $rule['operator'] . "($" . $f . ", '" . $rule['value'] . "')"; 
                        break;
                    case "equal":
                        $statement .= "$". $f . " == '" . $rule['value'] . "'"; 
                        break;
                    case "not_equal":
                        $statement .= "$". $f . " != '" . $rule['value'] . "'"; 
                        break;
                    default:
                        $statement .= "$" . $f . " " . $rule['operator'] . " '" . $rule['value'] . "'"; 
                        break;
                    }
                }
            else if ($rule['rules']) {
                $statement .= condition_parser($rule);
                }

        $j++;
        }
        $statement .= ")";
        return $statement;

    }

function contains($field, $value) {
  return preg_match("/$value/", $field);
}
function begins_with($field, $value) {
    return preg_match("/^$value/", $field);
 }
function ends_with($field, $value) {
     return preg_match("/${value}$/", $field);
 }


