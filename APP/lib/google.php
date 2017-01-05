<?php

class Google{

    protected $client;

    protected $service;
    protected $admin_user;

    function __construct() {
		global $config;

		$this->service_account_name = $config["google_service_account_name"];
      $this->admin_user = $config["google_admin_user"];
		$this->key_file = $config["google_service_account_key_file"];

		$this->client = new \Google_Client();
		$this->service = new \Google_Service_Directory($this->client);
      $this->client->setApplicationName("Dumas");

/*
      $this->admin_user = "admin@dumasschools.net";
		$this->key_file = "/Library/WebServer/Documents/gms/APP/lib/dumas-d760939fae36.p12";
		$this->service_account_name = "jan2017@dumas-1470212397620.iam.gserviceaccount.com";
      $this->admin_user = "production@dumasisd.org";
		$this->key_file = "/Library/WebServer/Documents/gms/APP/lib/SmartGroupsProject-c4d49f17ff48.p12";
		$this->service_account_name = "smartgroupsproject@appspot.gserviceaccount.com";
      $this->admin_user = "admin@dumasschools.net";
		$this->key_file = "/Library/WebServer/Documents/gms/APP/lib/dumas-1253d356d903.p12";
		$this->service_account_name = "rhc1-888@dumas-1470212397620.iam.gserviceaccount.com";
*/
    }

	public function getServiceToken(){
		$service_token=$_SESSION['google.service_token'];
		if (isset($service_token)) {
		  $this->client->setAccessToken($service_token);
		}
		$key = file_get_contents($this->key_file);
		$credentials = new \Google_Auth_AssertionCredentials(
			$this->service_account_name,
			  array('https://www.googleapis.com/auth/admin.directory.group', 'https://www.googleapis.com/auth/admin.directory.user'),
			$key
		);
		$credentials->sub = $this->admin_user;
		$this->client->setAssertionCredentials($credentials);

		if ($this->client->getAuth()->isAccessTokenExpired()) {

		  $this->client->getAuth()->refreshTokenWithAssertion($credentials);

		}
		$_SESSION['google.service_token']=$this->client->getAccessToken();

    }
    public function addGroup($email,$name,$description) {
    	$service_token=$this->getServiceToken();
		$service = $this->service;

    	$group = new \Google_Service_Directory_Group($this->client);
		$group->setEmail($email);
		$group->setName($name);
		$group->setDescription($description);

		$results = $this->service->groups->insert($group);
		return $results;
    }

    public function addUserToGroup($email,$group_id) {
    	$service_token=$this->getServiceToken();
		$service = $this->service;

    	$member = new \Google_Service_Directory_Member($this->client);
		$member->setEmail($email);
		$member->setRole("MEMBER");

		$results = $this->service->members->insert($group_id,$member);
		return $results;
    }
public function deleteUserFromGroup($user_id,$group_id) {
    	$service_token=$this->getServiceToken();
		$service = $this->service;

		$results = $this->service->members->delete($group_id,$user_id);
		return $results;
    }
    public function getGroupMember($group_id, $user_id) {
    	$service_token=$this->getServiceToken();
		$service = $this->service;

		$ok=0;
   		try {
			$results = $this->service->members->get($group_id,$user_id);
			$ok=1;

		} catch (\Exception $e) {

			$results = null;
		}
		return $results;

    }

    public function getGoogleUsers($domain,$next=null){

		$service_token=$this->getServiceToken();

		$params = array(
		  'domain' => $domain,
		  'maxResults' => 500,
		  'orderBy' => 'email',
		);
		if ($next) $params["pageToken"] = $next;
		$results = $this->service->users->listUsers($params);

		return $results;
    }


	 public function getGoogleGroups($domain){
		$service_token=$this->getServiceToken();

		$optParams = array(
		  'domain' => $domain,
		  'maxResults' => 500,
		);
		$results = $this->service->groups->listGroups($optParams);
		return $results;
    }
}
