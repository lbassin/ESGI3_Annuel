<?php

/** @var $config Config */
if (isset($config)) {
    $this->includeModal('form', $config->getSetupForm());
}