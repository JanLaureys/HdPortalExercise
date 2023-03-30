<?php

namespace Drupal\exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block to render react in..
 *
 * @Block(
 *   id = "react_block",
 *   admin_label = @Translation("Dog Breeds React Block"),
 *   category = @Translation("Exercise")
 * )
 */
class ReactBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {
    $build = [];
    $build[] = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'react-dogbreeds',
      ],
      '#attached' => [
        'library' => [
          'exercise/react-app',
        ],
      ],
    ];
    return $build;
  }
}
