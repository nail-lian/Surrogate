<?php
/*
$req = new SimpleXMLElement("<surrogate/>");

$auth = $req->addChild("auth");
$auth->addAttribute("name","myusername");
$auth->addAttribute("pass","mypassword");

$cmd = $req->addChild("command");
$cmd->addAttribute("name","proxy_auth_cmd");
$cmd->addChild("arg","add_user");
$cmd->addChild("arg","skruger");
$cmd->addChild("arg","testing");

$reqStr = $req->asXML();
*/

$curl = curl_init("http://localhost:8181/rpc/surrogate_api/json");

curl_setopt($curl,CURLOPT_POST,TRUE);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
//curl_setopt($curl,CURLOPT_POSTFIELDS,$req->asXML());

$auth = array('command' => 'proxy_auth_cmd', 'auth' => array('username' => 'user', 'password' => 'mypasswd'));

//$reqAuth = "\"command\":\"proxy_auth_cmd\",\"auth\":{\"username\":\"user\",\"password\":\"mypasswd\"},";
//$reqStr = "{ $reqAuth \"authcmd\":\"list_users\"}";

$reqCommand = $auth;
$reqCommand['authcmd'] = 'list_users';

//$reqStr = "{ $reqAuth \"authcmd\":\"add_user\",\"username\":\"test\",\"password\":\"testing567\"}";
//$reqCommand['authcmd'] = 'add_user';
//$reqCommand['authargs'] = array('username' => 'test', 'password' => 'testing567');

//$reqStr = "{ $reqAuth \"authcmd\":\"is_user\",\"username\":\"test\"}";
//$reqCommand['authcmd'] = 'is_user';
//$reqCommand['authargs'] = array('username' => 'test');

$reqStr = json_encode($reqCommand);
curl_setopt($curl,CURLOPT_POSTFIELDS,$reqStr);

echo "Requesting: \n$reqStr\n\n";

$response = curl_exec($curl);

curl_close($curl);

echo "Got response:\n$response\n";

