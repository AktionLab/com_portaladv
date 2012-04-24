<?php

require_once("../../constants.php");

//retrieve xml doc
$sWeather = file_get_contents("http://xml.weather.yahoo.com/forecastrss?p=USCO0021");

//create weatherinfo array
$aWeather = array();

//get and store image locally
preg_match("/img src=\"[^\"]*\"/",$sWeather,$match);
$imgSrc = preg_replace("/(img src=)|(\")/","",$match[0]);
preg_match("/[^\/]*\.gif/",$imgSrc,$imgName);
$newImg = imagecreatefromgif($imgSrc);
imagegif($newImg,PATH_TO_PORTALADV . "images/" . $imgName[0]);
$aWeather['img'] = $imgName[0];

//get current conditions
preg_match("/Current Conditions:[^:]*/",$sWeather,$match);
//preg_match("/<br \/>[^<^>]*/",$match[0],$match2);
$aWeather['conditions'] = str_replace("Current Conditions:</b><br />","",$match[0]);
$aWeather['conditions'] = str_replace("<br  />","",$aWeather['conditions']);
$aWeather['conditions'] = str_replace("<BR />","",$aWeather['conditions']);
$aWeather['conditions'] = str_replace("Forecast","",$aWeather['conditions']);
//$aWeather['conditions'] = str_replace(", "," ",$match[0]);
$aWeather['conditions'] = trim($aWeather['conditions']);
//create output html
$output = "<table><tr><a href=\"http:index.php?option=com_resource&view=article&article=19330&Itemid=137\"><td valign=\"bottom\"><img src=\"components/com_portaladv/images/" . $imgName[0] . "\" width=\"35\" border=\"0\"/></td><td valign=\"bottom\">";
$output .= strip_tags(str_replace("\n","",$aWeather['conditions']));
$output .= "</td></tr></table></a>";
//$output .= "\ndocument.write('<td style=\"font-size:12px;\">".$aWeather['forecast1_conditions']."<br />High: ".$aWeather['forecast1_high']."  Low: ".$aWeather['forecast1_low']."</td></tr><tr><td style=\"font-size:12px;\" valign=\"top\"><strong>".$aWeather['forecast2_day']."</strong></td><td style=\"font-size:12px;\">".$aWeather['forecast2_conditions']."<br />High: ".$aWeather['forecast2_high']."  Low: ".$aWeather['forecast2_low']."</td></tr></table></td></tr><tr><td colspan=\"2\" align=\"right\" style=\"padding-right:30px;\"><a href=\"http://weather.yahoo.com/forecast/USCO0162.html\">&raquo; full forecast</a></td></tr></table>');";

$fh = fopen(PATH_TO_PORTALADV . "/includes/weather.txt","w+");
fwrite($fh,$output);
fclose($fh);

?>