<?php

if (isset($article)) {
    $this->includeModal('list', $article->getListConfig());
}