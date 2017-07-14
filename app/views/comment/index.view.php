<?php if (isset($comment)):
    $this->includeModal('list', $comment->getListConfig(), $configList);
endif; ?>