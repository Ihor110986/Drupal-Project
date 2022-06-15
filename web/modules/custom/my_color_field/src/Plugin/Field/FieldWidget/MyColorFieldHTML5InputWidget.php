<?php

/**
 * @file
 * Contains \Drupal\my_color_field\Plugin\Field\FieldWidget\MyColorFieldHTML5InputWidget.
 */

namespace Drupal\my_color_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldWidget(
 *   id = "my_color_field_html5_input_widget",
 *   module = "my_color_field",
 *   label = @Translation("HTML5 Color Picker"),
 *   field_types = {
 *     "my_color_field"
 *   }
 * )
 */
class MyColorFieldHTML5InputWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   *
   * У цьому методі ми створюємо форму в якій наше значення для поля буде
   * вводиться і редагуватися - це то, що бачать юзери в адмінці при роботі
   * з цим полем.
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element += [
      '#type' => 'color',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : '',
      '#size' => 7,
      '#maxlength' => 7,
      '#element_validate' => [
        [$this, 'hexColorValidation'],
      ],
    ];

    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   *
   * По суті валідація як така і не потрібна, адже HTML5 input і не дозволяє
   * руками вводить колір, але в разі, якщо браузер не підтримує цей
   * елемент, або ще якіcm аномалії, краще всього перевірити його на
   * відповідність HEX формату #FFFFFF.
   */
  public function hexColorValidation($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
      $form_state->setError($element, t('Color is not in HEX format'));
    }
  }

}