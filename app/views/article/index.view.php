<h1>Article</h1>
<?php

if (isset($article)) {
    $this->includeModal('list', $article->getListConfig());
}