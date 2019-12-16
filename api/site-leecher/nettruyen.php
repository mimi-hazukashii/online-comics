<?php

final class NetTruyen {
    private $url;

    public function __construct($url = null) {
        if ($url) {
            if (!filter_var($url, FILTER_VALIDATE_URL))
                die('Invalid URL!');
            $this->url = $url;
        }
    }

    public function set_url($url) {
        if (!filter_var($url, FILTER_VALIDATE_URL))
            die('Invalid URL!');
        $this->url = $url;
    }

    private function get_page_source() {
        $ch = curl_init($this->url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true
        ));
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function get_data() {
        $src = $this->get_page_source();
        $title = explode('</h1>', explode('<h1 class="title-detail">', $src)[1])[0];
        $other_title = null;
        if (strpos($src, 'Tên khác') !== false)
            $other_title = explode('</h2>', explode('<h2 class="other-name col-xs-8">', $src)[1])[0];
        preg_match('#<img src="(.*)" alt=".*">#', $src, $thumbnail);
        preg_match_all('#<p class="col-xs-8">(.*)</p>#', $src, $matches);
        $matches = $matches[1];
        $matches[2] = str_replace(' - ', PHP_EOL, $matches[2]);
        $author = null;
        if (strpos($matches[0], '<a') !== false)
            $author = explode('</', explode('>', $matches[0])[1])[0];
        preg_match_all("#<a href='.*'>(.*)</a>#", $matches[2], $categories);
        $description = explode('</p>', explode('<p>', $src)[1])[0];
        preg_match_all('#<a href="(.*)" data-id=".*">.*</a>#', $src, $chapters);
        $images = array();
        foreach ($chapters[1] as $chapter) {
            $no = explode('/', explode('chap-', $chapter)[1])[0];
            $this->set_url($chapter);
            $src = $this->get_page_source();
            $src = str_replace('<img alt', "\n<img alt", $src);
            $src = str_replace("' />", "' />\n", $src);
            if (strpos($src, "data-cdn='http") !== false)
                preg_match_all("#<img alt='.*' data-index='\d+' src='.*' data-original='.*' data-cdn='(.*)' />#", $src, $matches);
            else preg_match_all("#<img alt='.*' data-index='\d+' src='(.*)' data-original='.*' />#", $src, $matches);
            foreach ($matches[1] as $index => $link) {
                if (strpos($link, '//proxy') != false)
                    $matches[1][$index] = "http:$link";
            }
            array_push($images, array(
               'no' => $no,
               'links' => $matches[1]
            ));
        }
        return json_encode(array(
            'title' => $title,
            'other_title' => $other_title,
            'thumbnail' => $thumbnail[1],
            'author' => $author,
            'categories' => $categories[1],
            'description' => $description,
            'chapters' => $images
        ), true);
    }
}