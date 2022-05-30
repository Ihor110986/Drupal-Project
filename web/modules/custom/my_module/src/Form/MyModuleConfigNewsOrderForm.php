<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class MyModuleConfigNewsOrderForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'my_module_news_filter.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'filter_news_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('my_module_news_filter.settings');

    $form['filter_field'] = array(
      '#type' => 'radios',
      '#title' => $this->t('News filter:'),
      '#options' => array('created' => 'By create date', 'changed' => 'By update date'),
      '#default_value' => $config->get('news_filter'),
      '#required' => TRUE,
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('my_module_news_filter.settings')
      ->set('news_filter', $form_state->getValue('filter_field'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
