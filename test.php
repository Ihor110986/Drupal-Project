<?php
use \Drupal\user\Entity\User;
print User::load(1)->getAccountName();