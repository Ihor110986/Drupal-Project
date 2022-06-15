<?php
namespace Drupal\block_form\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 *
 * Provides a 'BlockFormDisplayBlock' block.
 *
 *
 * @Block( * id = "block_form_display_block",
 * admin_label = @Translation("Display block"),
 *
 * category = @Translation("Custom display block")* )
 */
class BlockFormDisplayBlock extends BlockBase {
  /**
   *
   * {@inheritdoc} */ public function build() {
     $form = \Drupal::formBuilder()
       ->getForm('Drupal\block_form\Form\BlockFormDisplayForm');
     return $form;
   }
}