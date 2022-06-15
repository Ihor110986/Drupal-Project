<?php

namespace Drupal\glossary_tooltip\Plugin\TaxonomyBulkActions;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Annotation\Translation;
use Drupal\taxonomy\TermInterface;
use Drupal\taxonomy_bulk_actions\Annotation\TaxonomyBulkActions;
use Drupal\taxonomy_bulk_actions\TaxonomyBulkActionsManagerBase;

/**
 * Class MyCustomBulkAction
 *
 * Use @TaxonomyBulkActions annotation to configure your plugin:
 *   - id: the plugin unique id.
 *   - description: your action description, it should be translatable because it
 *   appears on the user interface, it's the option label of your action in the bulk actions
 *   dropdown selector.
 *   - vids: (Optional) an array of vocabularies ids which are concerned by your action, if empty
 *   or omitted that means all vocabularies terms are concerned by your action.
 *
 * @TaxonomyBulkActions(
 *   id="my_custom_bulk_action",
 *   description=@Translation("Add [OK] suffix to selected terms names "),
 *   vids={"tags"}
 * )
 */
class MyCustomBulkAction extends TaxonomyBulkActionsManagerBase {
  /**
   * This method should implement the action logic that should be executed on each
   * selected term.
   *
   * @param TermInterface $term
   *   Term object that the action will be applied on.
   */
  public function execute(TermInterface $term) {
    $name = $term->getName();
    $new_name = $name . ' [OK]';
    $term->set('name', $new_name);
    $term->save();
  }

  /**
   * This implementation is Optional, just in case you want to add a custom message
   *  when your action execution finished.
   */
  public function actionFinishedMessage() {
    return $this->t('OK has been added to selected terms');
  }

  /**
   * This implementation is Optional, you can implement it to manage your action access,
   * it should return:
   *  - TRUE : When the current user could have access to your action
   *  - FALSE: When the current user should not have access to your action
   * NB: By default the action is accessible.
   */
  public function access(AccountProxyInterface $account) {
    return $account->hasPermission('administer taxonomy');
  }
}