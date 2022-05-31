<?php

namespace Drupal\my_product;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a my product entity type.
 */
interface MyProductInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
