-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2009 at 05:24 PM
-- Server version: 5.0.37
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `moxie`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `number` int(11) unsigned NOT NULL,
  `bugtracker_id` int(11) unsigned NOT NULL,
  `summary` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `fixed` tinyint(1) NOT NULL default '0',
  `verified` tinyint(1) NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `bugtracker_id` (`bugtracker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `number`, `bugtracker_id`, `summary`, `assignee`, `fixed`, `verified`, `created`, `modified`) VALUES
(1, 500, 1, '', '', 0, 0, '0000-00-00 00:00:00', '2009-07-05 23:56:19'),
(2, 700, 1, 'can''t draw unicode characters', 'buster@formerly-netscape.com.tld', 1, 1, '0000-00-00 00:00:00', '2009-07-05 23:56:19'),
(3, 499738, 1, 'developer.AMO homepage designs', 'chowse@mozilla.com', 0, 0, '0000-00-00 00:00:00', '2009-07-05 23:56:19'),
(4, 501625, 1, 'Developer tools won''t load', 'clouserw@gmail.com', 0, 0, '0000-00-00 00:00:00', '2009-07-05 23:56:19'),
(5, 500000, 1, 'remove INTL_ConvertCharset because it is unused', 'timeless@bemail.org', 1, 0, '2009-07-10 00:26:29', '2009-07-10 00:26:29'),
(6, 500001, 1, 'fix compiler warnings in c-sdk/ldap', 'timeless@bemail.org', 0, 0, '2009-07-19 15:11:10', '2009-07-19 15:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `bugtrackers`
--

CREATE TABLE IF NOT EXISTS `bugtrackers` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `type` int(11) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bugtrackers`
--

INSERT INTO `bugtrackers` (`id`, `type`, `url`, `nickname`, `created`, `modified`) VALUES
(1, 1, 'https://bugzilla.mozilla.org', 'bugzilla', '2009-07-03 22:19:58', '2009-07-03 22:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deliverables`
--

INSERT INTO `deliverables` (`id`, `milestone_id`, `name`, `created`, `modified`) VALUES
(1, 1, 'Developer News', '2009-06-21 01:14:43', '2009-06-21 01:14:43'),
(2, 1, 'Upcoming Events', '2009-06-21 01:14:43', '2009-06-21 01:14:43');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `project_id`, `name`, `created`, `modified`) VALUES
(1, 1, 'developer.AMO', '2009-06-21 01:14:03', '2009-06-21 01:14:03');

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
-- Table structure for table `projects_bugtrackers`
--

CREATE TABLE IF NOT EXISTS `projects_bugtrackers` (
  `project_id` int(11) unsigned NOT NULL,
  `bugtracker_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `project_id` (`project_id`,`bugtracker_id`),
  KEY `bugtracker_id` (`bugtracker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_bugtrackers`
--

INSERT INTO `projects_bugtrackers` (`project_id`, `bugtracker_id`) VALUES
(1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `projects_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `deliverable_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `bug_id` int(11) unsigned default NULL,
  `name` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `deliverable_id` (`deliverable_id`),
  KEY `category_id` (`category_id`),
  KEY `bug_id` (`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `deliverable_id`, `category_id`, `bug_id`, `name`, `url`, `created`, `modified`) VALUES
(1, 1, 1, NULL, 'wiki spec', 'https://wiki.mozilla.org/AMO:Projects/developer.AMO/Features/News', '2009-06-21 18:21:09', '2009-06-21 18:21:09'),
(2, 1, 2, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 3, 2, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 2, 3, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 2, 4, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `bugs`
--
ALTER TABLE `bugs`
  ADD CONSTRAINT `bugs_ibfk_1` FOREIGN KEY (`bugtracker_id`) REFERENCES `bugtrackers` (`id`);

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
-- Constraints for table `projects_bugtrackers`
--
ALTER TABLE `projects_bugtrackers`
  ADD CONSTRAINT `projects_bugtrackers_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `projects_bugtrackers_ibfk_2` FOREIGN KEY (`bugtracker_id`) REFERENCES `bugtrackers` (`id`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_3` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`),
  ADD CONSTRAINT `resources_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `resources_ibfk_5` FOREIGN KEY (`bug_id`) REFERENCES `bugs` (`id`);
