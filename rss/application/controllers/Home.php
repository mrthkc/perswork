<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	//exclude words
	const OFFWORDS = array("the","be","to","of","and","a","in","that","have","I","it","for","not","on","with","he","as","you","do","at","this","but","his","by","from","they","we","say","her","she","or","an","will","my","one","all","would","there","their","what","so","up","out","if","about","who","get","which","go","me");
	//special feed tags not to check
	const OFFTAGS = array("id", "rel", "type", "href", "author");

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
    }
    
    public function index(){
		if($this->session->userdata('user')){
			$d['v'] = 'home';
			$this->load->view('template', $d);
		}
		else{
			$d['v'] = 'login';
			$this->load->view('template', $d);
		}
	}
	
	public function parse(){
		// result arrays
		$feed_top = array();
		$feed_items = array();

		// download feed
		$feed_url = $_POST["url"];
		$content = file_get_contents($feed_url);
		$xml = new SimpleXmlElement($content);

		// object to array
		$json_string = json_encode($xml);    
		$feed_array = json_decode($json_string, TRUE);
		$this->collect_words($feed_array, $feed_top);

		// finding top 10
		arsort($feed_top);
		$feed_top = array_slice($feed_top, 0, 10);

		// collecting feed entry titles & authors
		foreach($feed_array["entry"] as $tag => $val)
		{
			$feed_items[] = $val["title"] . " | by " . $val["author"]["name"];
		}


		$output["error"] = false;
		$output["message"] = array(
			"words" => $feed_top,
			"items" => $feed_items
		);
		echo json_encode($output);
	}

	private function collect_words($parent, &$words = array()){
		foreach ($parent as $k => $node)
		{
			// don't check - OFFTAGS
			if (in_array($k, self::OFFTAGS))
			{
				continue;
			}

			if (is_string($node))
			{
				// is text a url? - don't check
				if (preg_match('%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i', $node))
				{
					continue;
				}

				// matched words in a text
				preg_match_all('/([a-zA-Z]|\xC3[\x80-\x96\x98-\xB6\xB8-\xBF]|\xC5[\x92\x93\xA0\xA1\xB8\xBD\xBE]){2,}/', $node, $words_res);
				$matched_words = $words_res[0];
				foreach ($matched_words as $word)
				{
					$word = strtolower($word);
					if (in_array($word, self::OFFWORDS))
						continue;
					
					if (!isset($words[$word]))
					{
						$words[$word] = 1;
					}
					else{
						$words[$word] += 1;
					}
				}
			}
			else{
				$this->collect_words($node, $words);
			}
		}
	}
}