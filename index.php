<?php
include('/class/class.shd.php');
include('/class/class.scrape.php');
$dom = new simple_html_dom();
$scrape = new scrape();

?><h1>Todo:</h1>
<ol>
	<li>Ná öllum þáttum (episodes er bara með helstu þætti, vantar t.d. barnaefni)</li>
	<li>Vista upplýsingar í gagnagrunn</li>
	<li>Finna vefslóð á stream fyrir hvern þátt</li>
</ol>

<h1>Þættir og vefslóðir:</h1><?
var_dump($scrape->episodes());

?><h1>Vefslóðir og nánari upplýsingar um þætti:</h1><?
var_dump($scrape->episode());
?>