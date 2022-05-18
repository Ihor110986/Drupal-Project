<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_module_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'my_module.admin_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('my_module.admin_settings');
    $form['filter_field'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('News order:'),
      '#options' => array('created' => 'By create date', 'changed' => 'By update date'),
      '#default_value' => $config->get('news_order'),
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('my_module.admin_settings')
      ->set('news_order', $form_state->getValue('filter_field'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
