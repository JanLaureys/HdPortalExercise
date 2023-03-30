<?php

namespace Drupal\exercise;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an entry entity type.
 */
interface HdEntryInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
