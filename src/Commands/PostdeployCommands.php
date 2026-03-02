<?php

namespace Drupal\postdeploy\Commands;

use Drupal\Core\Database\Connection;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drush\Attributes as CLI;
use Drush\Commands\DrushCommands;

/**
 * Drush commands for post-deployment tasks.
 */
class PostdeployCommands extends DrushCommands {

  public function __construct(
    private readonly Connection $database,
    private readonly ModuleHandlerInterface $moduleHandler,
  ) {
    parent::__construct();
  }

  /**
   * Run post-deployment tasks: truncates the authmap table.
   */
  #[CLI\Command(name: 'postdeploy', aliases: ['pd'])]
  #[CLI\Usage(name: 'drush postdeploy', description: 'Truncates the authmap table as part of post-deployment cleanup.')]
  public function postdeploy(): void {
    if (!$this->moduleHandler->moduleExists('externalauth')) {
      $this->logger()->warning(dt('The externalauth module is not installed. Skipping authmap truncation.'));
      return;
    }
    $this->database->truncate('authmap')->execute();
    $this->logger()->success(dt('The authmap table has been truncated.'));
    $this->database->delete('key_value')->condition('collection', 'update_fetch_task', '=')->execute();
    $this->logger()->success(dt('The update_fetch_task collections have been removed from key_value.'));
  }
}
