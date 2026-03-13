# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Drupal custom module (`postdeploy`) that provides a Drush command for post-deployment cleanup tasks. It targets Drupal 10 and 11.

## Architecture

- **Drush command**: `drush postdeploy` (alias: `pd`) — defined in `src/Commands/PostdeployCommands.php`
- **Service wiring**: `drush.services.yml` registers the command with `@database` and `@module_handler` injected
- The command truncates the `authmap` table (if the `externalauth` module is installed) and clears `update_fetch_task` entries from `key_value`

## Development

This module is installed via Composer as a `drupal-module` type package. It has no build step, tests, or linting configuration of its own — it runs within a host Drupal site.

To use: require the package in a Drupal project and enable the module, then run `drush postdeploy`.
