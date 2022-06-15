<?php

namespace Drupal\custom_content_entity;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of custom content entity type entities.
 *
 * @see \Drupal\custom_content_entity\Entity\CustomContentEntityType
 */
class CustomContentEntityTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = $this->t('Label');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['title'] = [
      'data' => $entity->label(),
      'class' => ['menu-label'],
    ];

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No custom content entity types available. <a href=":link">Add custom content entity type</a>.',
      [':link' => Url::fromRoute('entity.custom_content_entity_type.add_form')->toString()]
    );

    return $build;
  }

}
