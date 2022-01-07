<?php
$body = json_decode(file_get_contents('php://input'), TRUE);
var_dump($body);

$TITLES = array(
	"api:addon" => "Add-on provisioned or deprovisioned",
	"api:addon-attachment" => "Add-on attached or detached",
	"api:app" => "App updated or destroyed",
	"api:build" => "Build created",
	"api:collaborator" => "Collaborator created or destroyed",
	"api:domain" => "Domain created or destroyed",
	"api:dyno" => "One-off dyno created via API",
	"api:formation" => "Formation update requested for scaling or changing dynos",
	"api:release" => "Release created due to your code deploy, config var change, or add-on provision or deprovision",
	"api:sni-endpoint" => "SNI Endpoint created or destroyed",
	"api:ssl-endpoint" => "SSL Endpoint created or destroyed",
	"dyno" => "Dyno lifecycle event triggered by formation changes, one-off dynos, scaling, and app restarts",
);

$title = $TITLES[$body["webhook_metadata"]["event"]["include"]];

$hookObject = json_encode(array(
	"username" => "Heroku",
	"avatar_url" => "https://cdn.iconscout.com/icon/free/png-256/heroku-3628830-3030107.png",
	"embeds" => array(
		array(
			"title" => "[" . $body['data']["app"]["name"] || $body["data"]["name"] . "] $title",

			// The type of your embed, will ALWAYS be "rich"
			"type" => "rich",
			"fields" => array(
				array("name" => "Buildpack", "value" => $body["data"]["buildpack_provided_description"], "inline" => TRUE),
				array("name" => "Build Stack", "value" => $body["data"]["build_stack"]["name"], "inline" => TRUE),
				array("name" => "Git URL", "value" => $body["data"]["git_url"], "inline" => TRUE),
				array("name" => "Is in maintenance mode?", "value" => $body["data"]["maintenance"], "inline" => TRUE),
				array("name" => "Owner", "value" => $body["data"]["owner"]["email"], "inline" => TRUE),
				array("name" => "Region", "value" => $body["data"]["region"]["name"], "inline" => TRUE),
				array("name" => "Organization", "value" => $body["data"]["organization"], "inline" => TRUE),
				array("name" => "Space", "value" => $body["data"]["space"], "inline" => TRUE),
				array("name" => "Repo size", "value" => $body["data"]["repo_size"], "inline" => TRUE),
				array("name" => "URL", "value" => $body["data"]["web_url"], "inline" => TRUE),
			),

			// The integer color to be used on the left side of the embed
			"color" => hexdec("FFFFFF"),

			// Author object
			"author" => array(
				"name" => $body["actor"]["email"]
			),
		)
	),
	"timestamp" => str_replace("Z", "-00:00", $body["created_at"])
), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$headers = array('Content-Type: application/json; charset=utf-8');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_GET["url"]);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $hookObject);
$response = curl_exec($ch);
