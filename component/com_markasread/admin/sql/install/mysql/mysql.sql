--
-- Database: `joomla`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__markasread`
--

DROP TABLE IF EXISTS `#__markasread`;
CREATE TABLE `#__markasread` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__content table.',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__users table.',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `#__markasread`
--
ALTER TABLE `#__markasread`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE INDEX `idx_user_content` (`user_id`, `content_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `#__markasread`
--
ALTER TABLE `#__markasread`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  MODIFY `created` datetime DEFAULT CURRENT_TIMESTAMP,
  MODIFY `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
COMMIT;
