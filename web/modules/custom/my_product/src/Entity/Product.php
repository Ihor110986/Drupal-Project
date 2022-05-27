<?php
//
//namespace Drupal\my_product\Entity;
//
//use Drupal\Core\Entity\ContentEntityBase;
//use Drupal\Core\Entity\ContentEntityInterface;
//use Drupal\Core\Entity\EntityTypeInterface;
//use Drupal\Core\Field\BaseFieldDefinition;
//
///**
// * Defines the Product entity.
// *
// * @ingroup product
// *
// * @ContentEntityType(
// *   id = "product",
// *   label = @Translation("Product"),
// *   base_table = "product",
// *   entity_keys = {
// *     "id" = "pid",
// *   },
// * )
// */
//class Product extends ContentEntityBase implements ContentEntityInterface {
//
//  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
//    // Standard field, used as unique if primary index.
//    $fields['pid'] = BaseFieldDefinition::create('integer')
//      ->setLabel(t('PID'))
//      ->setDescription(t('The PID of the Product entity.'))
//      ->setReadOnly(TRUE);
//    // Standard field in the current project.
//    $fields['name'] = BaseFieldDefinition::create('string')
//      ->setLabel(t('Name product'))
//      ->setDescription(t('The name of the product'))
//      ->setRequired(TRUE);
//    // Standard field in the current project.
//    $fields['description'] = BaseFieldDefinition::create('text')
//      ->setLabel(t('Description'))
//      ->setDescription('The description of the product')
//      ->setRequired(TRUE);
//    // Standard field in the current project.
//    $fields['price'] = BaseFieldDefinition::create('integer')
//      ->setLabel(t('Price'))
//      ->setDescription(t('The price of the product'))
//      ->setRequired(TRUE);
//
//    return $fields;
//  }
//
//}
