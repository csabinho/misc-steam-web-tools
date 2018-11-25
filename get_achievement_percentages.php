<?php
$start=microtime(true);
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/lib/twig_init.php";
include_once($path);
include_once("config.inc.php");
include_once("RequestCache.php");

$games_achievement_data=array();
$user_achievement_data=array();
$game_infos=array();
$irrelevant_parameters=array("key");
RequestCache::init();
//Vielleicht eine Alternative, allerdings pro Spiel ein Request: http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=588970&key=.$config["achievementstats"]["key"]."&steamid=.$config["mysteamid"]
$content=RequestCache::query("https://api.achievementstats.com/profiles/".$config["mysteamid"]."/achievements/?key=".$config["achievementstats"]["key"], $irrelevant_parameters);
if($content)
{
	echo("________________".PHP_EOL);
	$temp_array=json_decode($content,true);
	$games_with_finished_achievements=count($temp_array);
	foreach($temp_array as $temp_entry)
	{
		$temp_appId=$temp_entry["appId"];
		$user_achievement_data["$temp_appId"][]=array("apiName"=>$temp_entry["apiName"],"unlocked"=>$temp_entry["unlocked"]);
	}
	$finished_achievements=count($user_achievement_data);
	foreach($user_achievement_data as $appId => $user_achievement_data_set) //TODO:check ob es der doppelte Variablenname war?!?
	{
		$content=RequestCache::query("https://api.achievementstats.com/games/$appId/achievements/?key=".$config["achievementstats"]["key"],$irrelevant_parameters);
		if($content)
		{
			$games_achievement_data["$appId"]=json_decode($content,true);
		}
		
		$content=RequestCache::query("https://api.achievementstats.com/games/$appId/?key=".$config["achievementstats"]["key"],$irrelevant_parameters);
		if($content)
		{
			$game_infos["$appId"]=json_decode($content,true);
		}
		$count_user_achievements=count($user_achievement_data["$appId"]);
		$count_games_achievements=count($games_achievement_data["$appId"]);
		
		echo("|".$game_infos["$appId"]["name"]."($appId):".$count_user_achievements."/".$count_games_achievements." ->" .($count_user_achievements/$count_games_achievements)." ->".$game_infos["$appId"]["numOfAchievements"]."<br />");
	}
}
$end=microtime(true);
echo("Ausführungszeit:".sprintf("%.3f",($end-$start)));
#https://api.achievementstats.com/profiles/76561198008003336/achievements/?key=0995bf550d748848521687278
//\|(.*?)\((\d+)\):(\d+)\/(\d+) ->(\d+)\.?(\d+)? ->(\d+)