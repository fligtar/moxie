-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2009 at 02:13 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categories`
--


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
  `id` int(11) unsigned NOT NULL,
  `deliverable_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `bug_id` int(11) unsigned default NULL,
  `url` varchar(255) default NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `deliverable_id` (`deliverable_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--


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
-- Constraints for table `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `dates_ibfk_2` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`),
  ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`);

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
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`);
