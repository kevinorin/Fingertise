<?php

class GoogleAuth {
	protected $client;
	
	public function __construct(Google_Client $googleClient = null, $clientid, $clientsecret, $redirecturi, $scopes){
		$this->client = $googleClient;
		
		if ($this->client) {
			$this->client->setClientId($clientid);
			$this->client->setClientSecret($clientsecret);
			$this->client->setRedirectUri($redirecturi);
			$this->client->setScopes($scopes);
		}
	}
	
	public function isLoggedIn() {
		return isset($_SESSION['access_token']);
	}
	
	public function getAuthUrl() {
		return $this->client->createAuthUrl(array('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email'));
	}
	
	public function checkRedirectCode() {
		if(isset($_GET['code'])) {
			$this->client->authenticate($_GET['code']);
			
			$this->setToken($this->client->getAccessToken());
			
			return true;
		}
		return false;
	}
	
	public function setToken($token) {
		$_SESSION['access_token'] = $token;
		
		$this->client->setAccessToken($token);
	}
	
	public function getPayload() {
		$payload = $this->client->verifyIdToken()->getAttributes()['payload'];

		return $payload;
	}
	
}

?>