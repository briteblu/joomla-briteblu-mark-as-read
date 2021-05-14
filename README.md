# BriteBlu - 'Mark as Read' Joomla component

![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/briteblu/joomla-briteblu-mark-as-read?sort=semver&style=for-the-badge) [![GitHub stars](https://img.shields.io/github/stars/briteblu/joomla-briteblu-mark-as-read?style=for-the-badge)](https://github.com/briteblu/joomla-briteblu-mark-as-read/stargazers)

Simple Joomla extension to enable users to mark articles as 'read'.

- [BriteBlu - 'Mark as Read' Joomla component](#briteblu---mark-as-read-joomla-component)
  - [About](#about)
  - [Usage](#usage)
  - [To Do](#to-do)
  - [Changelog](#changelog)

## About

[BriteBlu](https://www.briteblu.com) adds functionality to Joomla (versions > 3.8)

In the past there have been Joomla users asking if functionality like this exists:
- Mark a group of articles (place these articles in a category or add a tag to them).
- Have logged in users read these articles from a page marked as 'important stuff' or 'must read items'.
- Offer each logged-in user the ability to 'mark' an article as 'read' (or even 'partly read', as extra options) which will then remove the article from this page listing.
- Upon login this page with 'important stuff' will show the respective user, which articles still need to be read and subsequently marked as 'read'.

This component should fulfill this functionality in a satisfying way.

Received future feature requests:
- Send notification to admin when all items for a user have been marked as 'read'.
- Send notification to user when new 'unread' articles within the category (or added tag) are available.

Questions on behavior and details of this component can be sent to [BriteBlu](https://www.briteblu.com).


## Usage

TODO

## To Do

...

## Changelog

### [Unreleased] <!-- omit in toc -->

#### Added <!-- omit in toc -->

- Simple `build.sh` script to generate Joomla package archive from command line
- Created boilerplate component folder structure and manifest file
- Added CSRF protection in plugin view
- Added language support to plugin view template
- Added controller task to mark article as read

#### Changed <!-- omit in toc -->

- Moved SQL database scripts from plugin to component
- Renamed `pkg_script.php` to `package.installer.php`
- Removed language tag from plugin manifest file - redundant

### [v0.0.3] - 2021-05-06 <!-- omit in toc -->

#### Added <!-- omit in toc -->

- Added debug option in plugin configuration
- Some cleanup in main plugin file (added doc comments, renamed private method, etc)
- Added `js` and `css` folders and files
- Added frontend plugin template `tmpl/read.php`
- Changed debug option from list select to radio button group
- Added `pkg_markasread.xml` package manifest file
- Added boilerplate package installer script
- Added `publish.yml` workflow to publish Joomla package archive when commit gets tagged

#### Changed <!-- omit in toc -->

- Changed directory structure for project to house plugin and component in seperate folders

#### Removed <!-- omit in toc -->

- Removed JXBuild github workflow (see `publish` workflow) and `build.jxb` file

### [v0.0.2] - 2021-05-05 <!-- omit in toc -->

#### Added <!-- omit in toc -->

- Added `About` section in README
- Added several blank `index.html` files to prevent directory index
- Added language files
- Added boilerplate Joomla plugin manifest file
- Added boilerplate installer script
- Added boilerplate plugin script
- Added install/update/uninstall SQL scripts for MySQL database
- Added `dependabot.yml` to `.github/`
- Added `FUNDING.yml` to `.github/`
- Added Joomla Extension Continuous Deployment Action as a GitHub workflow
- Added simple configuration option to plugin config

#### Changed <!-- omit in toc -->

- Set minimum Joomla version for `markasread` plugin from `3.8` to `3.1`
- Renamed `markasread.xml` to `manifest.xml`
- Renamed plugin
- First implementation of `markasread` plugin logic to determine if article was read

### [v0.0.1] - 2021-04-29 <!-- omit in toc -->

#### Added <!-- omit in toc -->
- Initial version of `joomla-briteblu-mark-as-read` repository

[Unreleased]: https://github.com/briteblu/joomla-briteblu-mark-as-read/compare/v0.0.3...HEAD
[v0.0.3]: https://github.com/briteblu/joomla-briteblu-mark-as-read/releases/tag/v0.0.3
[v0.0.2]: https://github.com/briteblu/joomla-briteblu-mark-as-read/releases/tag/v0.0.2
[v0.0.1]: https://github.com/briteblu/joomla-briteblu-mark-as-read/releases/tag/v0.0.1
