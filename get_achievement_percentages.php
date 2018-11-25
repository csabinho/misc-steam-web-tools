<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/lib/twig_init.php";
include_once($path);
include_once("config.inc.php");

$games_achievement_data=array();
$user_achievement_data=array();
$game_infos=array();
$curl=curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, "https://api.achievementstats.com/profiles/".$config["mysteamid"]."/achievements/?key=".$config["achievementstats"]["key"]);
if(($response=curl_exec($curl)) === false)
{
	echo(curl_error($curl));
}
else
{
	//echo($response.PHP_EOL);
	echo("________________".PHP_EOL);
	$temp_array=json_decode($response,true);
	//var_dump($temp_array);
	//print_r($temp_array);
	print(count($temp_array).PHP_EOL."<br/>");
	foreach($temp_array as $temp_entry)
	{
		//TODO: AppId-Bug beheben
		$temp_appId=$temp_entry["appId"];
		$user_achievement_data["$temp_appId"][]=array("apiName"=>$temp_entry["apiName"],"unlocked"=>$temp_entry["unlocked"]);
	}
	print(count($user_achievement_data).PHP_EOL."<br/>");
	foreach($user_achievement_data as $appId => $user_achievement_data_set) //TODO:check ob es der doppelte Variablenname war?!?
	{
		$curl=curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, "https://api.achievementstats.com/games/$appId/achievements/?key=".$config["achievementstats"]["key"]);
		
		if(($response=curl_exec($curl)) === false)
		{
			echo(curl_error($curl));
		}		
		else
		{
			$games_achievement_data["$appId"]=json_decode($response,true);
		}
		
		$curl=curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, "https://api.achievementstats.com/games/$appId/?key=".$config["achievementstats"]["key"]);
		
		if(($response=curl_exec($curl)) === false)
		{
			echo(curl_error($curl));
		else
		{
			$game_infos["$appId"]=json_decode($response,true);
		}
		$count_user_achievements=count($user_achievement_data["$appId"]);
		$count_games_achievements=count($games_achievement_data["$appId"]);
		
		/*foreach($game_infos as $current_appId => $game_info)
		{
			echo("$current_appId => ");
			foreach($game_info as $key => $value)
			{
				echo("$key => $value");
			}
		}*/
		echo("|".$game_infos["$appId"]["name"]."($appId):".$count_user_achievements."/".$count_games_achievements." ->" .($count_user_achievements/$count_games_achievements)." ->".$game_infos["$appId"]["numOfAchievements"]."<br />");
	}
}
#https://api.achievementstats.com/profiles/76561198008003336/achievements/?key=0995bf550d748848521687278
