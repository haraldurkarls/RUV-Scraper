<?php
# @TODO: Sækja stream
class scrape {
	# @TODO:
	# 1. Failsafe:
	# Setja failsafe svo ekki séu teknir inn þættir ef listinn er ekki á réttum stað.
	# t.d. ef fjöldi ul elementa breytist. Sú tala verður þá að vera geymd í db.
	# Einnig ef fjöldi li elementa fækkar eða fjölgar um ákveðna tölu (3-5) á milli scrape-a?
	# Væri líka hægt að stöðva scrape ef Fréttir og Veður vantar í listann þar sem það ætti alltaf að birtast.

	# 2. Sækja alla þætti:
	# Komst að því að þetta nær ekki inn öllu sem rúv bíður uppá
	public function episodes() { // Keyrt einu sinni á dag
		global $dom;
		$dom->load(file_get_contents('http://www.ruv.is/sarpurinn/flokkar/1'));
		$loaded = $dom->find('ul', 8);
		
		# Slóðir inná þætti:
		$url = array();
		foreach($loaded->find('li a') as $v) {
			$url[] = $v->href;
		}

		# Setja saman array til að setja í db
		$result = array();
		$c = 0;
		foreach ($loaded->find('li') as $v) {
			$result[] = array('url' => $url[$c], 'name' => $v->plaintext);
			$c++;
		}

		return $result;
	}

	# Sækir alla þætti sem eru available.
	public function episode() { // Keyrt einu sinni á klst
		global $dom;
		# Tekur þessa slóð seinna úr db:
		$dom->load(file_get_contents('http://www.ruv.is/sarpurinn/folkid-i-blokkinni/17112013-0'));
		$loaded = $dom->find('.sarplisti li');
		$result = array();
		foreach ($loaded as $v) {
			$result[] = array('url' => $v->children[0]->href, 'img' => $v->children[0]->children[0]->src, 'time' => $v->children[3]->innertext);
		}

		return $result;
	}
}
?>