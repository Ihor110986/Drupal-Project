<?php

/**
 * @file
 * Contains \Drupal\my_block\Plugin\Block\RegisterBlock.
 */

namespace Drupal\my_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'register' block.
 *
 * @Block(
 *   id = "register_block",
 *   admin_label = @Translation("Register block"),
 *   category = @Translation("Custom register block example")
 * )
 */
class RegisterBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\my_module\Form\RegisterForm');

    return $form;
  }
}
