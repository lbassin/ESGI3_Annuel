<?php

if (isset($user)) {
    $this->includeModal('list', $user->getListConfig());
}