<?php
class Rss
{
    const NB_ARTICLE_SHOW = 10;
    private $xml;
    private $rss;
    private $node;
    private $channel;
    private $item;

    public function GenerateRss($url = null)
    {
        $category = new Category();
        $category->populate(['url' => $url]);

        if ($category->id() == null) {
            Helpers::error404();
        } else {
            header("Content-type: text/xml");
        }

        $this->xml = new DOMDocument('1.0', 'UTF-8');
        $this->rss = $this->xml->createElement('rss');

        $this->node = $this->xml->appendChild($this->rss);
        $this->node->setAttribute('version', '2.0');

        $channelElement = $this->xml->createElement('channel');
        $this->channel = $this->node->appendChild($channelElement);

        $this->channel->appendChild($this->xml->createElement('title', $category->title()));
        $this->channel->appendChild($this->xml->createElement('description', BASE_PATH.' - article'));
        $this->channel->appendChild($this->xml->createElement('link', BASE_PATH_PATTERN));
        $this->channel->appendChild($this->xml->createElement('pubdate', date(DATE_RFC2822)));

        $category->getArticle();
        $counter = 0;
        foreach ($category->articles() as $article) {
            if ($counter++ == self::NB_ARTICLE_SHOW) {
                break;
            }
            $itemElement = $this->xml->createElement('item');
            $this->item = $this->channel->appendChild($itemElement);
            $this->item->appendChild($this->xml->createElement('title', $article->title()));
            $this->item->appendChild($this->xml->createElement('excerpt', $article->content()));
            $this->item->appendChild($this->xml->createElement('link', $article->url()));
        }
        return $this->xml->saveXML();
    }
}