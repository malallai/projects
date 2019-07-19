<?php
use Pages\UserPage;

$page = new UserPage($this->_url);
echo $page->profile();
