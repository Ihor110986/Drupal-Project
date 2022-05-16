<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class MyModuleSettingsForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'my_module.settings';

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
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['Title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('my_module_thing'),
    ];  

    $form['Text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('other_things'),
    ];  

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('my_module_thing', $form_state->getValue('my_module_thing'))
      // You can set multiple configurations at once by making
      // multiple calls to set().
      ->set('other_things', $form_state->getValue('other_things'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}

     