<?php
namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class MyModuleTemplateController extends ControllerBase {
    public function content() {

        return array(
            '#theme' => 'my-module-template',
            '#test_var' => $this->t('Test Value'),
        );
    }
}
