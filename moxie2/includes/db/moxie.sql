-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2009 at 11:44 PM
-- Server version: 5.0.37
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `moxie`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Spec'),
(2, 'Design'),
(3, 'Implementation');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`key`, `value`) VALUES
('site_name', 'Mozilla'),
('theme', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE IF NOT EXISTS `dates` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `milestone_id` int(11) unsigned default NULL,
  `deliverable_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `milestone_id` (`milestone_id`),
  KEY `deliverable_id` (`deliverable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dates`
--


-- --------------------------------------------------------

--
-- Table structure for table `deliverables`
--

CREATE TABLE IF NOT EXISTS `deliverables` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `milestone_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `milestone_id` (`milestone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deliverables`
--

INSERT INTO `deliverables` (`id`, `milestone_id`, `name`, `created`, `modified`) VALUES
(1, 1, 'Add-on Collector', '2009-06-21 01:14:43', '2009-06-21 01:14:43'),
(2, 1, 'Collections', '2009-06-21 01:14:43', '2009-06-21 01:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `project_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `project_id`, `name`, `created`, `modified`) VALUES
(1, 1, 'Bandwagon, Phase II', '2009-06-21 01:14:03', '2009-06-21 01:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `open` tinyint(1) NOT NULL,
  `theme` varchar(255) NOT NULL default 'default',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `url`, `open`, `theme`, `created`, `modified`) VALUES
(1, 'AMO', 'amo', 1, 'default', '2009-06-21 01:13:23', '2009-06-21 01:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `projects_users`
--

CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `project_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `role` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `project_id` (`project_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `projects_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `resourcetype` varchar(255) NOT NULL,
  `deliverable_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `data` text,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `deliverable_id` (`deliverable_id`),
  KEY `category_id` (`category_id`),
  KEY `resourcetype` (`resourcetype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `resourcetype`, `deliverable_id`, `category_id`, `data`, `created`, `modified`) VALUES
(1, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511931";s:10:"bz_summary";s:116:"On viewing the same collection using different locales,it gets listed multiple times under "Recently viewed" section";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(2, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"512134";s:10:"bz_summary";s:49:"chrome.manifest not actually required for themes?";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(3, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"512025";s:10:"bz_summary";s:74:"Collection barometer wraps for more than 4 digits on /collections/ listing";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(4, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"512135";s:10:"bz_summary";s:23:"Themes can be in a .xpi";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(5, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510907";s:10:"bz_summary";s:64:"On site statistics, some CSS image requests return 404 Not Found";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(6, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"512111";s:10:"bz_summary";s:82:"Negative text-indented text in bars is not hidden in RTL, but only on listing page";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(7, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"512000";s:10:"bz_summary";s:66:"Use breadcrumb element to include name of collection in stats page";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(8, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"504692";s:10:"bz_summary";s:20:"Improve slow queries";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(9, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"400996";s:10:"bz_summary";s:39:"Developer documentation for the AMO API";s:11:"bz_assignee";s:17:"laura@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(10, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"507732";s:10:"bz_summary";s:54:"Confirm that API for fennec has appropriate capability";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(11, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509753";s:10:"bz_summary";s:38:"Are our category total numbers broken?";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(12, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508574";s:10:"bz_summary";s:23:"s/%d/%1$s/ in .po files";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(13, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511948";s:10:"bz_summary";s:39:"Add the /contribute/ page to robots.txt";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(14, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"503354";s:10:"bz_summary";s:32:"Build search indexing via Sphinx";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(15, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508172";s:10:"bz_summary";s:36:"Need to fix some minor L10n problems";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(16, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"504699";s:10:"bz_summary";s:52:"Write a new Search API as part of addons services!!!";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(17, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509618";s:10:"bz_summary";s:56:"Update config/sql/remora.sql with changes for bug 503354";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(18, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508058";s:10:"bz_summary";s:36:"Set up install URLs for Labs add-ons";s:11:"bz_assignee";s:19:"fligtar@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(19, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509619";s:10:"bz_summary";s:61:"Make sure newly added versions play nice with Sphinx indexing";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(20, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510374";s:10:"bz_summary";s:20:"whitelist test pilot";s:11:"bz_assignee";s:19:"fligtar@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(21, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"504930";s:10:"bz_summary";s:63:"Encoding error in JSON error message when uploading invalid xpi";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(22, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510898";s:10:"bz_summary";s:88:"most_recent_versions temp table in bin/update-search-views is causing replication errors";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:54', '2009-08-23 23:24:54'),
(23, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"512075";s:10:"bz_summary";s:44:"pt-PT lost their L10n in the great migration";s:11:"bz_assignee";s:17:"gandalf@aviary.pl";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(24, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506501";s:10:"bz_summary";s:67:"Add-On Collector Won''t Save Ad Block Plus Extension in Subscription";s:11:"bz_assignee";s:20:"lorchard@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(25, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508904";s:10:"bz_summary";s:60:"AMO: ''Sort by Newest'' search results gives incorrect results";s:11:"bz_assignee";s:18:"nobody@mozilla.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(26, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511775";s:10:"bz_summary";s:64:"Centralize browser-check regex and add Namoroka to supported UAs";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(27, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"501988";s:10:"bz_summary";s:35:"Convert AMO to use normal .po files";s:11:"bz_assignee";s:17:"gandalf@aviary.pl";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(28, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"441852";s:10:"bz_summary";s:36:"Verify dictionaries are dictionaries";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(29, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"441854";s:10:"bz_summary";s:40:"Verify language packs are language packs";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(30, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"444136";s:10:"bz_summary";s:63:"Create framework to automatically scan add-ons for bad patterns";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(31, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508173";s:10:"bz_summary";s:67:"Come up with a better test for dictionary_security_checkInstallJS()";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(32, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"505260";s:10:"bz_summary";s:62:"Create tests for L10n completeness in AMO validation framework";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(33, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"498679";s:10:"bz_summary";s:40:"Run Addons tests automatically on upload";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(34, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508062";s:10:"bz_summary";s:45:"Unable to access uploaded search-engine addon";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(35, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509038";s:10:"bz_summary";s:42:"Tweak all_security_filterUnsafeJS() regexs";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(36, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508275";s:10:"bz_summary";s:34:"3 strings should have plural forms";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(37, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509427";s:10:"bz_summary";s:46:"Minor test suite tweaks for themes (from blog)";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(38, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508988";s:10:"bz_summary";s:67:"Validator: source links don''t work if source viewing is not enabled";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(39, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506154";s:10:"bz_summary";s:37:"[W-2.2.1] Recently Viewed Collections";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(40, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509500";s:10:"bz_summary";s:70:"Validator should treat setTimeout/setInterval as potentially dangerous";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(41, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506152";s:10:"bz_summary";s:43:"[W-2.1.1] Collection Rating on display page";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(42, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509039";s:10:"bz_summary";s:35:"tweak install.js test for seamonkey";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(43, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506155";s:10:"bz_summary";s:41:"[W-2.2.2] Collection ratings in directory";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(44, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506158";s:10:"bz_summary";s:49:"[W-2.4.2] Similar Add-ons on add-on display pages";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(45, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506800";s:10:"bz_summary";s:30:"[W-2.4.1] Add-on Relationships";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(46, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"482396";s:10:"bz_summary";s:36:"Track share count totals in database";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(47, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508468";s:10:"bz_summary";s:81:"Add contribution amounts to listings on home page, categories, and search results";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(48, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511697";s:10:"bz_summary";s:55:"Can''t access management pages for tags or contributions";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(49, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506157";s:10:"bz_summary";s:36:"[W-2.3.2] Collection Stats Dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(50, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"371210";s:10:"bz_summary";s:56:"Check add-ons for security vulnerabilities at submission";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(51, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"498038";s:10:"bz_summary";s:30:"Remove extra space on homepage";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(52, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508469";s:10:"bz_summary";s:30:"Create Contributions dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(53, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510031";s:10:"bz_summary";s:79:"Registration Form Error Message for Taken Nicknames Should be in Red or in Bold";s:11:"bz_assignee";s:22:"bmo@mozilla-srbija.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(54, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509542";s:10:"bz_summary";s:37:"Expectant recommended install buttons";s:11:"bz_assignee";s:22:"bmo@mozilla-srbija.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(55, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"499840";s:10:"bz_summary";s:54:"Unordered lists on the registration page aren''t styled";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(56, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506362";s:10:"bz_summary";s:76:"Use JavaScript to test file uploads before the client sends the POST request";s:11:"bz_assignee";s:27:"cdolivei.bugzilla@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(57, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"507310";s:10:"bz_summary";s:82:"Multiple-developer add-ons don''t consistently list all authors / hyperlink #others";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(58, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508868";s:10:"bz_summary";s:50:"Need to be able to link to the developer agreement";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(59, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509916";s:10:"bz_summary";s:75:"Cannot submit language packs for Thunderbird as no categories are available";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(60, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508984";s:10:"bz_summary";s:81:"Add more detail to validation FAQ; unsafe settings warnings need more explanation";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(61, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"496539";s:10:"bz_summary";s:86:"remove locale code (en-US etc.) from links in new add-on version in queue notification";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(62, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511981";s:10:"bz_summary";s:49:"Some new strings still follow old .po file format";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(63, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"507931";s:10:"bz_summary";s:54:"Blank editor name showing in MTD Activity; Review Logs";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(64, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509235";s:10:"bz_summary";s:52:"Reviews on user profile pages lost their line breaks";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(65, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511685";s:10:"bz_summary";s:71:"Accessibility/navigational links appearing on preview (top-left corner)";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(66, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511840";s:10:"bz_summary";s:56:"Voting for a collection explodes if you''re not logged in";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(67, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"504124";s:10:"bz_summary";s:77:"[IE7, JavaScript-disabled] "Go" button in language/locale picker doesn''t work";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(68, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508912";s:10:"bz_summary";s:41:""Other add-ons by author" section missing";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(69, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508763";s:10:"bz_summary";s:48:"Support for manage collection in Collections API";s:11:"bz_assignee";s:20:"lorchard@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(70, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"501273";s:10:"bz_summary";s:77:"On window resize, titles on a "Browse themes" pages overlaps downloads number";s:11:"bz_assignee";s:18:"neilio@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(71, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511923";s:10:"bz_summary";s:27:"Change tooltip after rating";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(72, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506818";s:10:"bz_summary";s:42:"Review/expand/improve validation help text";s:11:"bz_assignee";s:18:"nobody@mozilla.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(73, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508735";s:10:"bz_summary";s:56:"An error message on the file upload interface is garbled";s:11:"bz_assignee";s:18:"nobody@mozilla.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(74, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511194";s:10:"bz_summary";s:36:"Sprites for collection rating thumbs";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(75, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"490077";s:10:"bz_summary";s:62:"Tabs'' layout is broken in the Admin Users'' "About Me" textbox.";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(76, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"494454";s:10:"bz_summary";s:30:"Full name of addon in tooltip?";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(77, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"496764";s:10:"bz_summary";s:32:"Can''t add author with + in email";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(78, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"493070";s:10:"bz_summary";s:44:"Font style wrong on successful add-on upload";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(79, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506106";s:10:"bz_summary";s:33:"Add help links to validation page";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(80, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509142";s:10:"bz_summary";s:92:"Regression: Can not delete pending add-on file so that it can be replaced with a newer file.";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(81, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509921";s:10:"bz_summary";s:44:"Not matching terms in the validation section";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(82, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506797";s:10:"bz_summary";s:139:"on the /admin page under Recent Admin Activity it says ''User ''A'' added to group admins'' instead of ''User ''A'' added User ''B'' to group admins";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(83, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510142";s:10:"bz_summary";s:71:"Editors should be able to run the validation test suite against add-ons";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(84, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510342";s:10:"bz_summary";s:64:"View Contents link turns into "File not found!", then into a 404";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(85, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510347";s:10:"bz_summary";s:67:"Links to add-on review pages in /performance are missing add-on IDs";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(86, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509869";s:10:"bz_summary";s:37:"Recommended list not ordered randomly";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(87, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"507205";s:10:"bz_summary";s:71:"Not localized tooltips for buttons in the Editor Comments â€“ AMO 5.0.8";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(88, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"510542";s:10:"bz_summary";s:78:"Add-on name autocomplete field on Collection build page doesn''t return results";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(89, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511922";s:10:"bz_summary";s:39:"Add rating sort to Collection Directory";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(90, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"511926";s:10:"bz_summary";s:38:"Add link to collection stats dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(91, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509436";s:10:"bz_summary";s:55:"Add verification suite output to editor''s control panel";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(92, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506153";s:10:"bz_summary";s:33:"[W-2.1.2] Collection Share widget";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(93, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509645";s:10:"bz_summary";s:80:"Uncaught exception: ''An invalid or illegal string was specified'' @ amo-bundle.js";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(94, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"497646";s:10:"bz_summary";s:30:"Cannot update collections icon";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(95, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"507753";s:10:"bz_summary";s:54:"Create standalone contribution page URL for developers";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(96, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"483835";s:10:"bz_summary";s:29:"Create public stats dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(97, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"493306";s:10:"bz_summary";s:52:"Collections add page: Preserve form choices on error";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(98, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"506391";s:10:"bz_summary";s:70:"Attempt to change collection name to â€œ<â€ results in the empty name";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(99, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509738";s:10:"bz_summary";s:54:"Admin logs page is blank (0-byte content length); OOM?";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(100, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"440811";s:10:"bz_summary";s:44:"Theme browser doesn''t show compatible themes";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(101, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"498872";s:10:"bz_summary";s:54:"Version notes header not showing next to version notes";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(102, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"508688";s:10:"bz_summary";s:58:"Not localized words on the Editor Tools > Performance page";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(103, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"496979";s:10:"bz_summary";s:48:"Files not checked when going to review an add-on";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(104, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"498082";s:10:"bz_summary";s:61:"Multiple layout problems with manage collections add-ons page";s:11:"bz_assignee";s:18:"neilio@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(105, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"429273";s:10:"bz_summary";s:57:"Pre-3.2 image-preview link pages are missing their images";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55'),
(106, 'bugzilla', 2, 3, 'a:5:{s:9:"bz_number";s:6:"509074";s:10:"bz_summary";s:38:"Change style of stats dashboard header";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:24:55', '2009-08-23 23:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `resourcetypes`
--

CREATE TABLE IF NOT EXISTS `resourcetypes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `resourcetype` varchar(255) NOT NULL,
  `project_id` int(11) unsigned NOT NULL,
  `enabled` tinyint(1) NOT NULL default '1',
  `config` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `resourcetypes`
--

INSERT INTO `resourcetypes` (`id`, `resourcetype`, `project_id`, `enabled`, `config`, `created`, `modified`) VALUES
(1, 'link', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'wiki', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'bugzilla', 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `data` text,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=319 ;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `data`, `created`, `modified`) VALUES
(1, 'a:5:{s:9:"bz_number";s:6:"511931";s:10:"bz_summary";s:116:"On viewing the same collection using different locales,it gets listed multiple times under "Recently viewed" section";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(2, 'a:5:{s:9:"bz_number";s:6:"512025";s:10:"bz_summary";s:74:"Collection barometer wraps for more than 4 digits on /collections/ listing";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(3, 'a:5:{s:9:"bz_number";s:6:"512111";s:10:"bz_summary";s:82:"Negative text-indented text in bars is not hidden in RTL, but only on listing page";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(4, 'a:5:{s:9:"bz_number";s:6:"512134";s:10:"bz_summary";s:49:"chrome.manifest not actually required for themes?";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(5, 'a:5:{s:9:"bz_number";s:6:"512135";s:10:"bz_summary";s:23:"Themes can be in a .xpi";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(6, 'a:5:{s:9:"bz_number";s:6:"510907";s:10:"bz_summary";s:64:"On site statistics, some CSS image requests return 404 Not Found";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(7, 'a:5:{s:9:"bz_number";s:6:"512000";s:10:"bz_summary";s:66:"Use breadcrumb element to include name of collection in stats page";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(8, 'a:5:{s:9:"bz_number";s:6:"400996";s:10:"bz_summary";s:39:"Developer documentation for the AMO API";s:11:"bz_assignee";s:17:"laura@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(9, 'a:5:{s:9:"bz_number";s:6:"504692";s:10:"bz_summary";s:20:"Improve slow queries";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(10, 'a:5:{s:9:"bz_number";s:6:"507732";s:10:"bz_summary";s:54:"Confirm that API for fennec has appropriate capability";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(11, 'a:5:{s:9:"bz_number";s:6:"508172";s:10:"bz_summary";s:36:"Need to fix some minor L10n problems";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(12, 'a:5:{s:9:"bz_number";s:6:"508574";s:10:"bz_summary";s:23:"s/%d/%1$s/ in .po files";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(13, 'a:5:{s:9:"bz_number";s:6:"509753";s:10:"bz_summary";s:38:"Are our category total numbers broken?";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(14, 'a:5:{s:9:"bz_number";s:6:"511948";s:10:"bz_summary";s:39:"Add the /contribute/ page to robots.txt";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(15, 'a:5:{s:9:"bz_number";s:6:"503354";s:10:"bz_summary";s:32:"Build search indexing via Sphinx";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(16, 'a:5:{s:9:"bz_number";s:6:"504699";s:10:"bz_summary";s:52:"Write a new Search API as part of addons services!!!";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(17, 'a:5:{s:9:"bz_number";s:6:"509618";s:10:"bz_summary";s:56:"Update config/sql/remora.sql with changes for bug 503354";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(18, 'a:5:{s:9:"bz_number";s:6:"509619";s:10:"bz_summary";s:61:"Make sure newly added versions play nice with Sphinx indexing";s:11:"bz_assignee";s:14:"dd@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(19, 'a:5:{s:9:"bz_number";s:6:"508058";s:10:"bz_summary";s:36:"Set up install URLs for Labs add-ons";s:11:"bz_assignee";s:19:"fligtar@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(20, 'a:5:{s:9:"bz_number";s:6:"510374";s:10:"bz_summary";s:20:"whitelist test pilot";s:11:"bz_assignee";s:19:"fligtar@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(21, 'a:5:{s:9:"bz_number";s:6:"504930";s:10:"bz_summary";s:63:"Encoding error in JSON error message when uploading invalid xpi";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(22, 'a:5:{s:9:"bz_number";s:6:"511775";s:10:"bz_summary";s:64:"Centralize browser-check regex and add Namoroka to supported UAs";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(23, 'a:5:{s:9:"bz_number";s:6:"501988";s:10:"bz_summary";s:35:"Convert AMO to use normal .po files";s:11:"bz_assignee";s:17:"gandalf@aviary.pl";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(24, 'a:5:{s:9:"bz_number";s:6:"512075";s:10:"bz_summary";s:44:"pt-PT lost their L10n in the great migration";s:11:"bz_assignee";s:17:"gandalf@aviary.pl";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(25, 'a:5:{s:9:"bz_number";s:6:"510898";s:10:"bz_summary";s:88:"most_recent_versions temp table in bin/update-search-views is causing replication errors";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(26, 'a:5:{s:9:"bz_number";s:6:"506501";s:10:"bz_summary";s:67:"Add-On Collector Won''t Save Ad Block Plus Extension in Subscription";s:11:"bz_assignee";s:20:"lorchard@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(27, 'a:5:{s:9:"bz_number";s:6:"508904";s:10:"bz_summary";s:60:"AMO: ''Sort by Newest'' search results gives incorrect results";s:11:"bz_assignee";s:18:"nobody@mozilla.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(28, 'a:5:{s:9:"bz_number";s:6:"441852";s:10:"bz_summary";s:36:"Verify dictionaries are dictionaries";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(29, 'a:5:{s:9:"bz_number";s:6:"441854";s:10:"bz_summary";s:40:"Verify language packs are language packs";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(30, 'a:5:{s:9:"bz_number";s:6:"444136";s:10:"bz_summary";s:63:"Create framework to automatically scan add-ons for bad patterns";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(31, 'a:5:{s:9:"bz_number";s:6:"498679";s:10:"bz_summary";s:40:"Run Addons tests automatically on upload";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(32, 'a:5:{s:9:"bz_number";s:6:"505260";s:10:"bz_summary";s:62:"Create tests for L10n completeness in AMO validation framework";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(33, 'a:5:{s:9:"bz_number";s:6:"508062";s:10:"bz_summary";s:45:"Unable to access uploaded search-engine addon";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(34, 'a:5:{s:9:"bz_number";s:6:"508173";s:10:"bz_summary";s:67:"Come up with a better test for dictionary_security_checkInstallJS()";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(35, 'a:5:{s:9:"bz_number";s:6:"508275";s:10:"bz_summary";s:34:"3 strings should have plural forms";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(36, 'a:5:{s:9:"bz_number";s:6:"508988";s:10:"bz_summary";s:67:"Validator: source links don''t work if source viewing is not enabled";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(37, 'a:5:{s:9:"bz_number";s:6:"509038";s:10:"bz_summary";s:42:"Tweak all_security_filterUnsafeJS() regexs";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(38, 'a:5:{s:9:"bz_number";s:6:"509039";s:10:"bz_summary";s:35:"tweak install.js test for seamonkey";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(39, 'a:5:{s:9:"bz_number";s:6:"509427";s:10:"bz_summary";s:46:"Minor test suite tweaks for themes (from blog)";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(40, 'a:5:{s:9:"bz_number";s:6:"509500";s:10:"bz_summary";s:70:"Validator should treat setTimeout/setInterval as potentially dangerous";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(41, 'a:5:{s:9:"bz_number";s:6:"506152";s:10:"bz_summary";s:43:"[W-2.1.1] Collection Rating on display page";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(42, 'a:5:{s:9:"bz_number";s:6:"506154";s:10:"bz_summary";s:37:"[W-2.2.1] Recently Viewed Collections";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(43, 'a:5:{s:9:"bz_number";s:6:"506155";s:10:"bz_summary";s:41:"[W-2.2.2] Collection ratings in directory";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(44, 'a:5:{s:9:"bz_number";s:6:"506158";s:10:"bz_summary";s:49:"[W-2.4.2] Similar Add-ons on add-on display pages";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(45, 'a:5:{s:9:"bz_number";s:6:"506800";s:10:"bz_summary";s:30:"[W-2.4.1] Add-on Relationships";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(46, 'a:5:{s:9:"bz_number";s:6:"508468";s:10:"bz_summary";s:81:"Add contribution amounts to listings on home page, categories, and search results";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(47, 'a:5:{s:9:"bz_number";s:6:"371210";s:10:"bz_summary";s:56:"Check add-ons for security vulnerabilities at submission";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(48, 'a:5:{s:9:"bz_number";s:6:"511697";s:10:"bz_summary";s:55:"Can''t access management pages for tags or contributions";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(49, 'a:5:{s:9:"bz_number";s:6:"506157";s:10:"bz_summary";s:36:"[W-2.3.2] Collection Stats Dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(50, 'a:5:{s:9:"bz_number";s:6:"482396";s:10:"bz_summary";s:36:"Track share count totals in database";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(51, 'a:5:{s:9:"bz_number";s:6:"508469";s:10:"bz_summary";s:30:"Create Contributions dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(52, 'a:5:{s:9:"bz_number";s:6:"498038";s:10:"bz_summary";s:30:"Remove extra space on homepage";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:0;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(53, 'a:5:{s:9:"bz_number";s:6:"509542";s:10:"bz_summary";s:37:"Expectant recommended install buttons";s:11:"bz_assignee";s:22:"bmo@mozilla-srbija.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(54, 'a:5:{s:9:"bz_number";s:6:"510031";s:10:"bz_summary";s:79:"Registration Form Error Message for Taken Nicknames Should be in Red or in Bold";s:11:"bz_assignee";s:22:"bmo@mozilla-srbija.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(55, 'a:5:{s:9:"bz_number";s:6:"506362";s:10:"bz_summary";s:76:"Use JavaScript to test file uploads before the client sends the POST request";s:11:"bz_assignee";s:27:"cdolivei.bugzilla@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(56, 'a:5:{s:9:"bz_number";s:6:"499840";s:10:"bz_summary";s:54:"Unordered lists on the registration page aren''t styled";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(57, 'a:5:{s:9:"bz_number";s:6:"507310";s:10:"bz_summary";s:82:"Multiple-developer add-ons don''t consistently list all authors / hyperlink #others";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(58, 'a:5:{s:9:"bz_number";s:6:"507931";s:10:"bz_summary";s:54:"Blank editor name showing in MTD Activity; Review Logs";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(59, 'a:5:{s:9:"bz_number";s:6:"508868";s:10:"bz_summary";s:50:"Need to be able to link to the developer agreement";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(60, 'a:5:{s:9:"bz_number";s:6:"508984";s:10:"bz_summary";s:81:"Add more detail to validation FAQ; unsafe settings warnings need more explanation";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(61, 'a:5:{s:9:"bz_number";s:6:"509916";s:10:"bz_summary";s:75:"Cannot submit language packs for Thunderbird as no categories are available";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(62, 'a:5:{s:9:"bz_number";s:6:"511981";s:10:"bz_summary";s:49:"Some new strings still follow old .po file format";s:11:"bz_assignee";s:18:"clouserw@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(63, 'a:5:{s:9:"bz_number";s:6:"496539";s:10:"bz_summary";s:86:"remove locale code (en-US etc.) from links in new add-on version in queue notification";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(64, 'a:5:{s:9:"bz_number";s:6:"504124";s:10:"bz_summary";s:77:"[IE7, JavaScript-disabled] "Go" button in language/locale picker doesn''t work";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(65, 'a:5:{s:9:"bz_number";s:6:"508912";s:10:"bz_summary";s:41:""Other add-ons by author" section missing";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(66, 'a:5:{s:9:"bz_number";s:6:"509235";s:10:"bz_summary";s:52:"Reviews on user profile pages lost their line breaks";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(67, 'a:5:{s:9:"bz_number";s:6:"511685";s:10:"bz_summary";s:71:"Accessibility/navigational links appearing on preview (top-left corner)";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(68, 'a:5:{s:9:"bz_number";s:6:"511840";s:10:"bz_summary";s:56:"Voting for a collection explodes if you''re not logged in";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(69, 'a:5:{s:9:"bz_number";s:6:"511923";s:10:"bz_summary";s:27:"Change tooltip after rating";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(70, 'a:5:{s:9:"bz_number";s:6:"508763";s:10:"bz_summary";s:48:"Support for manage collection in Collections API";s:11:"bz_assignee";s:20:"lorchard@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(71, 'a:5:{s:9:"bz_number";s:6:"501273";s:10:"bz_summary";s:77:"On window resize, titles on a "Browse themes" pages overlaps downloads number";s:11:"bz_assignee";s:18:"neilio@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(72, 'a:5:{s:9:"bz_number";s:6:"506818";s:10:"bz_summary";s:42:"Review/expand/improve validation help text";s:11:"bz_assignee";s:18:"nobody@mozilla.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(73, 'a:5:{s:9:"bz_number";s:6:"508735";s:10:"bz_summary";s:56:"An error message on the file upload interface is garbled";s:11:"bz_assignee";s:18:"nobody@mozilla.org";s:8:"bz_fixed";i:0;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(74, 'a:5:{s:9:"bz_number";s:6:"511194";s:10:"bz_summary";s:36:"Sprites for collection rating thumbs";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(75, 'a:5:{s:9:"bz_number";s:6:"490077";s:10:"bz_summary";s:62:"Tabs'' layout is broken in the Admin Users'' "About Me" textbox.";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(76, 'a:5:{s:9:"bz_number";s:6:"493070";s:10:"bz_summary";s:44:"Font style wrong on successful add-on upload";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(77, 'a:5:{s:9:"bz_number";s:6:"494454";s:10:"bz_summary";s:30:"Full name of addon in tooltip?";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(78, 'a:5:{s:9:"bz_number";s:6:"496764";s:10:"bz_summary";s:32:"Can''t add author with + in email";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(79, 'a:5:{s:9:"bz_number";s:6:"506106";s:10:"bz_summary";s:33:"Add help links to validation page";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(80, 'a:5:{s:9:"bz_number";s:6:"506797";s:10:"bz_summary";s:139:"on the /admin page under Recent Admin Activity it says ''User ''A'' added to group admins'' instead of ''User ''A'' added User ''B'' to group admins";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(81, 'a:5:{s:9:"bz_number";s:6:"509142";s:10:"bz_summary";s:92:"Regression: Can not delete pending add-on file so that it can be replaced with a newer file.";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(82, 'a:5:{s:9:"bz_number";s:6:"509921";s:10:"bz_summary";s:44:"Not matching terms in the validation section";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(83, 'a:5:{s:9:"bz_number";s:6:"510142";s:10:"bz_summary";s:71:"Editors should be able to run the validation test suite against add-ons";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(84, 'a:5:{s:9:"bz_number";s:6:"510342";s:10:"bz_summary";s:64:"View Contents link turns into "File not found!", then into a 404";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(85, 'a:5:{s:9:"bz_number";s:6:"507205";s:10:"bz_summary";s:71:"Not localized tooltips for buttons in the Editor Comments â€“ AMO 5.0.8";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(86, 'a:5:{s:9:"bz_number";s:6:"510347";s:10:"bz_summary";s:67:"Links to add-on review pages in /performance are missing add-on IDs";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(87, 'a:5:{s:9:"bz_number";s:6:"511926";s:10:"bz_summary";s:38:"Add link to collection stats dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(88, 'a:5:{s:9:"bz_number";s:6:"509869";s:10:"bz_summary";s:37:"Recommended list not ordered randomly";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(89, 'a:5:{s:9:"bz_number";s:6:"510542";s:10:"bz_summary";s:78:"Add-on name autocomplete field on Collection build page doesn''t return results";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(90, 'a:5:{s:9:"bz_number";s:6:"511922";s:10:"bz_summary";s:39:"Add rating sort to Collection Directory";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(91, 'a:5:{s:9:"bz_number";s:6:"506153";s:10:"bz_summary";s:33:"[W-2.1.2] Collection Share widget";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(92, 'a:5:{s:9:"bz_number";s:6:"509436";s:10:"bz_summary";s:55:"Add verification suite output to editor''s control panel";s:11:"bz_assignee";s:21:"rjbuild1088@gmail.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(93, 'a:5:{s:9:"bz_number";s:6:"497646";s:10:"bz_summary";s:30:"Cannot update collections icon";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(94, 'a:5:{s:9:"bz_number";s:6:"509645";s:10:"bz_summary";s:80:"Uncaught exception: ''An invalid or illegal string was specified'' @ amo-bundle.js";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(95, 'a:5:{s:9:"bz_number";s:6:"507753";s:10:"bz_summary";s:54:"Create standalone contribution page URL for developers";s:11:"bz_assignee";s:20:"rdoherty@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(96, 'a:5:{s:9:"bz_number";s:6:"483835";s:10:"bz_summary";s:29:"Create public stats dashboard";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(97, 'a:5:{s:9:"bz_number";s:6:"440811";s:10:"bz_summary";s:44:"Theme browser doesn''t show compatible themes";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(98, 'a:5:{s:9:"bz_number";s:6:"493306";s:10:"bz_summary";s:52:"Collections add page: Preserve form choices on error";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(99, 'a:5:{s:9:"bz_number";s:6:"496979";s:10:"bz_summary";s:48:"Files not checked when going to review an add-on";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(100, 'a:5:{s:9:"bz_number";s:6:"506391";s:10:"bz_summary";s:70:"Attempt to change collection name to â€œ<â€ results in the empty name";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(101, 'a:5:{s:9:"bz_number";s:6:"509738";s:10:"bz_summary";s:54:"Admin logs page is blank (0-byte content length); OOM?";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(102, 'a:5:{s:9:"bz_number";s:6:"498872";s:10:"bz_summary";s:54:"Version notes header not showing next to version notes";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(103, 'a:5:{s:9:"bz_number";s:6:"508688";s:10:"bz_summary";s:58:"Not localized words on the Editor Tools > Performance page";s:11:"bz_assignee";s:21:"smccammon@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(104, 'a:5:{s:9:"bz_number";s:6:"429273";s:10:"bz_summary";s:57:"Pre-3.2 image-preview link pages are missing their images";s:11:"bz_assignee";s:19:"fwenzel@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(105, 'a:5:{s:9:"bz_number";s:6:"509074";s:10:"bz_summary";s:38:"Change style of stats dashboard header";s:11:"bz_assignee";s:22:"jbalogh@jeffbalogh.org";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56'),
(106, 'a:5:{s:9:"bz_number";s:6:"498082";s:10:"bz_summary";s:61:"Multiple layout problems with manage collections add-ons page";s:11:"bz_assignee";s:18:"neilio@mozilla.com";s:8:"bz_fixed";i:1;s:11:"bz_verified";i:1;}', '2009-08-23 23:15:56', '2009-08-23 23:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`),
  ADD CONSTRAINT `dates_ibfk_2` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`);

--
-- Constraints for table `deliverables`
--
ALTER TABLE `deliverables`
  ADD CONSTRAINT `deliverables_ibfk_1` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`);

--
-- Constraints for table `milestones`
--
ALTER TABLE `milestones`
  ADD CONSTRAINT `milestones_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_6` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`),
  ADD CONSTRAINT `resources_ibfk_7` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `resourcetypes`
--
ALTER TABLE `resourcetypes`
  ADD CONSTRAINT `resourcetypes_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
