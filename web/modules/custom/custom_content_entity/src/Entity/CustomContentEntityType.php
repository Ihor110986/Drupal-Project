<?php

namespace Drupal\custom_content_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Custom content entity type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "custom_content_entity_type",
 *   label = @Translation("Custom content entity type"),
 *   label_collection = @Translation("Custom content entity types"),
 *   label_singular = @Translation("custom content entity type"),
 *   label_plural = @Translation("custom content entities types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count custom content entities type",
 *     plural = "@count custom content entities types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\custom_content_entity\Form\CustomContentEntityTypeForm",
 *       "edit" = "Drupal\custom_content_entity\Form\CustomContentEntityTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\custom_content_entity\CustomContentEntityTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   admin_permission = "administer custom content entity types",
 *   bundle_of = "custom_content_entity",
 *   config_prefix = "custom_content_entity_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/custom_content_entity_types/add",
 *     "edit-form" = "/admin/structure/custom_content_entity_types/manage/{custom_content_entity_type}",
 *     "delete-form" = "/admin/structure/custom_content_entity_types/manage/{custom_content_entity_type}/delete",
 *     "collection" = "/admin/structure/custom_content_entity_types"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   }
 * )
 */
class CustomContentEntityType extends ConfigEntityBundleBase {

  /**
   * The machine name of this custom content entity type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the custom content entity type.
   *
   * @var string
   */
  protected $label;

}
