<?php

/**
 * @file
 * Contains Drupal\my_color_field\Plugin\Field\FieldType\MyColorFieldItem.
 */

namespace Drupal\my_color_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *   id = "my_color_field",
 *   label = @Translation("My color field"),
 *   module = "my_color_field",
 *   description = @Translation("Custom color picker."),
 *   category = @Translation("Color"),
 *   default_widget = "my_color_field_html5_input_widget",
 *   default_formatter = "my_color_field_default_formatter"
 * )
 */
class MyColorFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   *
   * Ми оголошуємо поля для таблиці, де будуть зберігатися значення нашого поля.
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   *
   * Це повідомляє Drupal, як зберігати значення в цьому полі.
   * Наприклад, ціле число, рядок або будь-який інший.
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Hex color'));

    return $properties;
  }
}