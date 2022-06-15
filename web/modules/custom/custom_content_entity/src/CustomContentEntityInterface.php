<?php

namespace Drupal\custom_content_entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a custom content entity entity type.
 */
interface CustomContentEntityInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
