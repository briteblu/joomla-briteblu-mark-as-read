# BriteBlu - 'Mark as Read' Joomla component

- [BriteBlu - 'Mark as Read' Joomla component](#briteblu---mark-as-read-joomla-component)
  - [About](#about)
  - [Usage](#usage)
  - [To Do](#to-do)
  - [Changelog](#changelog)

Simple Joomla plugin to enable users to mark articles as 'read'.

## About

[BriteBlu](https://www.briteblu.com) adds functionality to Joomla (versions 3.9.x)

There have been Joomla users in the past years asking if a functionality like this exists:
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

- Fix github workflow `JXBuild`

## Changelog

### [Unreleased] <!-- omit in toc -->

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

[v0.0.1]: https://github.com/briteblu/joomla-briteblu-mark-as-read/releases/tag/v0.0.1
