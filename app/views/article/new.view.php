<h1>Creation d'article</h1>
<?php
if (isset($article)) {
    $this->includeModal('form', $article->getFormConfig());
}
