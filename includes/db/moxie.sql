-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2009 at 03:35 PM
-- Server version: 5.0.37
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `moxie2`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `deliverable_id` int(11) unsigned default NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `deliverable_id` (`deliverable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `deliverable_id`, `name`, `file`, `created`, `modified`) VALUES
(1, 1, 'Individual How-to Page', 'How-To.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'How-to Landing Page', 'How-Tos.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `number` int(11) unsigned NOT NULL,
  `summary` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `component` varchar(255) NOT NULL,
  `lastupdated` datetime NOT NULL default '0000-00-00 00:00:00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `number` (`number`),
  KEY `status` (`status`),
  KEY `assignee` (`assignee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `number`, `summary`, `status`, `assignee`, `priority`, `product`, `component`, `lastupdated`, `created`, `modified`) VALUES
(1, 513181, 'tags/prodexternal doesn''t have the schematic external', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Administration', '2009-08-28 09:12:30', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(2, 514356, 'Integrate zxtm-api into admin panel', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-03 11:08:21', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(3, 514482, 'stats_share_counts_totals table is broken', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Statistics', '2009-09-03 12:51:13', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(4, 514597, 'Whack the unverified contributions data', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Maintenance Scripts', '2009-09-04 10:59:37', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(5, 518158, 'Sort out forums IDs', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-23 15:26:40', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(6, 518707, 'Add locale column to update_counts', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Statistics', '2009-09-25 16:08:24', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(7, 513700, 'Backport 1.5 Search API into the regular API', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-05 19:57:07', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(8, 515832, 'Bring the sexy back to the add-ons'' Edit pages', 3, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-11 08:29:09', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(9, 517964, 'Links on edit an addon page are not properly displayed.', 3, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-21 12:48:38', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(10, 518431, '"Uploading file" message is seen on navigating to the Validator landing page', 3, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-23 14:35:15', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(11, 512258, 'Need to Clear Validation cache in maintenance scripts', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Maintenance Scripts', '2009-08-28 10:41:50', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(12, 513607, 'Summary, Downloads and Active Daily Users Statistics are not shown.', 3, 'smccammon@mozilla.com', '--', 'addons.mozilla.org', 'Statistics', '2009-08-30 16:57:04', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(13, 518602, 'Fizzypop toolbar button doesn''t work', 2, 'cdolivei.bugzilla@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 08:37:46', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(14, 515537, 'Updates for Fennec', 2, 'clouserw@gmail.com', 'P1', 'addons.mozilla.org', 'Public Pages', '2009-09-25 15:39:14', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(15, 512766, 'Several multi-byte string php function calls use the default non-UTF8 internal encoding', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Localization', '2009-09-30 02:26:46', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(16, 509775, 'Cron jobs should only print out errors', 2, 'jbalogh@jeffbalogh.org', 'P2', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-04 16:11:58', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(17, 503520, 'we need to pass mb_strlen() an encoding parameter or it''s not accurate', 3, 'bmo@mozilla-srbija.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-25 19:14:01', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(18, 511277, 'Inaccurate error message while logging in without any credentials', 2, 'bmo@mozilla-srbija.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-01 11:51:31', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(19, 511979, 'Password-reset page should call .focus() on its textfield', 2, 'bmo@mozilla-srbija.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-08-31 10:39:14', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(20, 512022, 'Remove hyphen on developer''s add-on first-run page', 2, 'bmo@mozilla-srbija.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-30 02:26:45', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(21, 511932, 'Use Javascript to test image uploads on the profile before the client sends the POST request', 2, 'cdolivei.bugzilla@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-09 12:38:20', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(22, 514865, '"Often used with" add-on does not exist', 2, 'cdolivei.bugzilla@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-14 09:48:11', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(23, 518119, 'Mistake in overlay.properties file from builder', 2, 'cdolivei.bugzilla@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-27 19:51:21', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(24, 512621, 'Update text on "What are add-ons" part of promo module', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-03 16:27:04', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(25, 513274, 'String "Add-on statistics" is unlocalizable on Statistics Dashboard', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Localization', '2009-09-24 18:30:53', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(26, 513743, 'Change message on validation suite for Conduit', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-08 10:24:44', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(27, 513857, '"Users Created" should be "Accounts Created" or "Users Registered"', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Statistics', '2009-09-15 07:07:43', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(28, 513993, 'Convert old-style messages.po Serbian to meet new locales .po file', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Localization', '2009-09-25 17:06:59', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(29, 515835, 'Cannot change add-on version license in dev tools', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 07:02:07', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(30, 516801, 'Enforce unique nicknames', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-28 12:11:03', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(31, 517066, 'Remove NEW! flag from Collections', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Collections', '2009-09-17 14:27:51', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(32, 517173, '"Submit Your Add-on" button is missing its link on the Developers Hub homepage, while logged out', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-17 21:05:34', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(33, 517315, 'Donations page sends base64NONSENSE data to the paypal page', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-10-03 20:54:23', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(34, 518384, 'Statistics page blank if admin', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Statistics', '2009-09-24 18:37:32', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(35, 518717, 'Registering as a New user on AMO fails', 2, 'clouserw@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-25 10:06:52', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(36, 519312, 'Unstyled button in dev cp', 2, 'craigcook.bugz@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 17:30:15', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(37, 519313, 'Message should be hidden but it''s not', 2, 'craigcook.bugz@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 17:29:21', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(38, 519314, 'Removing a tag forwards the person to the wrong page', 2, 'craigcook.bugz@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 17:38:46', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(39, 519315, 'Options should have linebreaks between them', 2, 'craigcook.bugz@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 17:36:36', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(40, 517344, 'Search for "Stumble Upon" does not result in StumbleUpon', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-22 11:12:45', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(41, 517357, 'Blank search should list all available addons', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-19 10:07:26', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(42, 517547, 'Searching for a tag doesn''t return any results', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-29 15:12:12', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(43, 517572, 'Sub-string search not supported', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-29 15:25:51', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(44, 517575, 'Search should list only exact matches when search term is enclosed within double quotes', 3, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-22 09:44:34', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(45, 517589, 'Searching for "ColorZilla 2.0.2"(add-on with latest version) returns no results', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-29 15:30:11', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(46, 517954, 'Searching for add-ons within a category is broken', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-29 15:32:07', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(47, 518466, 'SAMO:Searching for "A9 SiteInfo" fails in API', 3, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'API', '2009-09-24 11:08:29', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(48, 518646, 'Search fails to return existing search engines', 2, 'dd@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-29 14:38:47', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(49, 516626, 'Breadcrumb usages don''t match', 2, 'fligtar@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-14 20:09:30', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(50, 518159, '"forgot my password" link on the forums should go to AMO', 2, 'fligtar@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-29 13:22:50', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(51, 514158, 'Remove l10n message context from nav bar entries', 2, 'fwenzel@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:27:00', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(52, 514631, 'developer_faq.thtml: "SunBird" should be "Sunbird"', 2, 'fwenzel@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-30 02:27:01', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(53, 513226, 'Invalid vcard in about pages', 2, 'jbalogh@jeffbalogh.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-30 02:26:57', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(54, 514324, 'Policies and How-to landing pages weirdness', 2, 'jbalogh@jeffbalogh.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-17 10:20:28', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(55, 516638, 'Thumbs-up icon isn''t clickable to "like" a dev-doc article', 3, 'jbalogh@jeffbalogh.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-26 12:51:17', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(56, 518154, 'Number of results section shows incorrect value when no results are found under Collections', 2, 'jbalogh@jeffbalogh.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-24 16:16:11', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(57, 518180, 'No success message after subscribing to the add-ons newsletter', 2, 'jbalogh@jeffbalogh.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-24 15:50:39', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(58, 509973, 'Add Extend Firefox 3.5 Badge to AMO Developer Dashboard', 3, 'neilio@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 20:11:09', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(59, 517140, 'standalone page lacks footer', 3, 'nnguyen@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-22 09:54:29', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(60, 513284, 'number_format the table and graph values on the stats dashboard', 2, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-25 16:29:10', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(61, 515183, 'Make search categories localizable', 3, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 20:08:02', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(62, 517951, 'Subscribing to addons newsletter fails with uninformative user message', 2, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-22 13:54:10', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(63, 518063, 'Link to Calendar is missing from the Upcoming events section', 3, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 19:42:52', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(64, 518715, 'CAPTCHA should have a refresh button like on spreadfirefox', 3, 'nobody@mozilla.org', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-25 19:36:31', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(65, 512586, 'Make AMO login cookie httponly', 2, 'rdoherty@mozilla.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-10 17:28:33', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(66, 516804, 'Footer bg missing from /developers', 2, 'rdoherty@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-15 21:42:36', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(67, 430206, 'Inline auto-completion doesn''t work in the Admin CP when as Senior Editor status', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-18 13:34:45', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(68, 440114, 'Cannot remove platform', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-10 17:26:36', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(69, 461928, 'Add "Back to <extension>..." and "Edit/add your review" links to top of reviews page', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-11 13:52:53', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(70, 496392, 'Tighten up bottom-cell padding on Dictionaries & Language Packs page', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-11 14:21:58', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(71, 499254, 'Auto-completing "address book" puts add-on''s name in two separate parts', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Collections', '2009-09-11 14:46:39', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(72, 511719, 'Link collections'' icons to their pages on the /firefox homepage', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Public Pages', '2009-09-11 14:44:41', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(73, 511892, 'We should provide helpful feedback for broken install.rdfs', 2, 'rjbuild1088@gmail.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-11 11:43:07', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(74, 513267, 'Don''t show statistics for today if they are zero', 2, 'smccammon@mozilla.com', '--', 'addons.mozilla.org', 'Statistics', '2009-09-30 02:26:58', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(75, 513343, 'Some CSV files are empty', 2, 'smccammon@mozilla.com', '--', 'addons.mozilla.org', 'Statistics', '2009-09-01 09:33:06', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(76, 515208, 'Need to clarify that contribution graphs are not public', 2, 'smccammon@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:27:02', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(77, 516904, 'Validation page shouldn''t require login', 2, 'smccammon@mozilla.com', '--', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-30 02:27:04', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(78, 518207, 'Page titles for Developer hub pages are incorrect', 3, 'smccammon@mozilla.com', '--', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 19:41:53', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(79, 517985, 'Fix FizzyPop extensions', 2, 'cdolivei.bugzilla@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:27:05', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(80, 500486, 'When Fennec uses the search API, homepage is "firefox", not "fennec"', 2, 'clouserw@gmail.com', 'P1', 'addons.mozilla.org', 'API', '2009-09-21 11:52:21', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(81, 513380, '[1.9.2 & 1.9.3] Forum Accounts & Groups', 2, 'clouserw@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 22:49:06', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(82, 513504, 'User info pages no longer have edit link', 2, 'clouserw@gmail.com', 'P1', 'addons.mozilla.org', 'Public Pages', '2009-09-18 18:47:02', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(83, 514769, 'Redirect policy page to new policies section', 2, 'clouserw@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-22 15:11:22', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(84, 514770, 'Rename Developer Tools to Developer Hub', 2, 'clouserw@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-15 23:21:59', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(85, 519350, 'Developer Tools tweaks', 2, 'craigcook.bugz@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 20:11:00', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(86, 519382, 'Developer Tools tweaks, pt. II', 2, 'craigcook.bugz@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 20:14:14', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(87, 513364, '[1.9.1] Forum Styling', 2, 'fligtar@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-11 16:56:59', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(88, 513382, '[1.2.1] Getting Started page', 2, 'fligtar@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:59', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(89, 514772, 'Homepage link to Developer Hub', 2, 'fligtar@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:27:02', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(90, 512783, '[1.8] Developer Hub global header and navigation bar', 2, 'fwenzel@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:47', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(91, 513126, 'Specific policy page', 2, 'fwenzel@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:51', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(92, 513128, '[1.2.6] Case Studies Index', 2, 'fwenzel@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:52', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(93, 513130, '[1.2.7] Individual Case Study page', 2, 'fwenzel@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:52', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(94, 513134, '[1.2.8] API and Language Reference page', 2, 'fwenzel@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:53', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(95, 513138, '[1.5.1] Search Engine & Results Page', 2, 'fwenzel@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:54', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(96, 513114, '[1.2.2] How-to Library', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:49', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(97, 513122, '[1.2.3] How-to Category Page', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:50', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(98, 513124, '[1.2.5] Add-on Policies section', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:51', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(99, 513136, '[1.3.1] Add-on Builder', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 17:55:16', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(100, 513137, '[1.4.3.] Newsletter signup page', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:54', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(101, 514013, 'Move devhub pages to a new controller so they''re not login-protected', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-15 23:42:23', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(102, 514080, '[1.2.10] Theatre', 3, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 20:10:07', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(103, 517965, 'Builder fixes', 2, 'jbalogh@jeffbalogh.org', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 17:55:16', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(104, 516020, 'Unique-ify nicknames', 2, 'jeremy.orem+bugs@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 12:23:44', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(105, 512773, '[1.1] Developer Hub Homepage', 2, 'rdoherty@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-15 23:19:52', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(106, 517402, 'Homepage link columns reversed', 2, 'rdoherty@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-28 17:43:00', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(107, 513135, '[1.3.2] Add-on Validator page for non-hosted add-ons', 2, 'rjbuild1088@gmail.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-26 09:31:24', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(108, 512778, '[1.1.2] Developer Hub homepage for developers', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:46', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(109, 512816, '[1.1.4 & 1.7.2] Developer Promotion Boxes', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:47', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(110, 512817, '[1.1.6 & 1.7.1] Upcoming Events', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:48', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(111, 513140, '[1.6.2] Add-on Newsfeed', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:55', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(112, 513141, 'Newsfeed RSS', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:56', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(113, 516498, 'Make Submit Your Add-on box prettier', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:27:03', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(114, 517631, 'Admin-made newsfeed stories have escaping issues', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-30 02:27:05', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(115, 518482, 'Duplicate newsfeed stories when adding author', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-25 15:03:50', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(116, 518483, 'Don''t show add-on icons so much in newsfeed page', 2, 'smccammon@mozilla.com', 'P1', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:27:06', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(117, 512599, 'Add MOTD to editor tools', 2, 'buchanae@gmail.com', 'P2', 'addons.mozilla.org', 'Admin/Editor Tools', '2009-09-22 11:26:25', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(118, 493311, 'Update AMO Policy Page', 3, 'clouserw@gmail.com', 'P2', 'addons.mozilla.org', 'Public Pages', '2009-09-25 20:06:43', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(119, 513150, '[1.6.1] Re-skin existing Developer Tools', 2, 'craigcook.bugz@gmail.com', 'P2', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 17:47:20', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(120, 512845, 'Cannot remove developer tags when user tags are present', 2, 'fwenzel@mozilla.com', 'P2', 'addons.mozilla.org', 'Developer Pages', '2009-09-30 02:26:49', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(121, 499040, 'Show number of collections in browse/results footer', 2, 'jbalogh@jeffbalogh.org', 'P2', 'addons.mozilla.org', 'Collections', '2009-09-30 02:26:44', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(122, 513173, 'Developer''s e-mail address is not obfuscated in the developer profile', 2, 'jbalogh@jeffbalogh.org', 'P2', 'addons.mozilla.org', 'Public Pages', '2009-09-30 02:26:56', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(123, 513325, 'track clicks on recommended module', 2, 'jbalogh@jeffbalogh.org', 'P2', 'addons.mozilla.org', 'Public Pages', '2009-09-30 02:26:58', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(124, 507852, 'Collection description not properly escaped; less-than "<" and characters after it are not saved', 2, 'cdolivei.bugzilla@gmail.com', 'P3', 'addons.mozilla.org', 'Collections', '2009-09-25 12:19:53', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(125, 494088, 'Restyling of My Accounts page', 2, 'chowse@mozilla.com', 'P3', 'addons.mozilla.org', 'Public Pages', '2009-09-29 18:11:45', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(126, 495208, '"Advanced" search tab flyout panel should only close on an explicit click', 2, 'rjbuild1088@gmail.com', 'P3', 'addons.mozilla.org', 'Public Pages', '2009-09-11 16:31:24', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(127, 498080, 'Collection description character count is counting character escaping and inflating shown total', 2, 'smccammon@mozilla.com', 'P3', 'addons.mozilla.org', 'Collections', '2009-09-30 02:26:43', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(128, 507834, 'Collection descriptions should have character limit, not byte limit', 2, 'smccammon@mozilla.com', 'P3', 'addons.mozilla.org', 'Collections', '2009-09-30 02:26:44', '2009-10-04 00:02:08', '2009-10-04 00:02:08'),
(129, 513744, 'minor tweaks to public stats dashboard', 2, 'smccammon@mozilla.com', 'P3', 'addons.mozilla.org', 'Statistics', '2009-09-30 02:26:59', '2009-10-04 00:02:08', '2009-10-04 00:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `bugs_deliverables`
--

CREATE TABLE IF NOT EXISTS `bugs_deliverables` (
  `deliverable_id` int(11) unsigned NOT NULL,
  `bug_id` int(11) unsigned NOT NULL,
  `role` tinyint(1) NOT NULL,
  PRIMARY KEY  (`deliverable_id`,`bug_id`),
  KEY `bug_id` (`bug_id`),
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bugs_deliverables`
--

INSERT INTO `bugs_deliverables` (`deliverable_id`, `bug_id`, `role`) VALUES
(1, 96, 1),
(1, 97, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bugs_milestones`
--

CREATE TABLE IF NOT EXISTS `bugs_milestones` (
  `milestone_id` int(11) unsigned NOT NULL,
  `bug_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`milestone_id`,`bug_id`),
  KEY `bug_id` (`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bugs_milestones`
--

INSERT INTO `bugs_milestones` (`milestone_id`, `bug_id`) VALUES
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(5, 32),
(5, 33),
(5, 34),
(5, 35),
(5, 36),
(5, 37),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 42),
(5, 43),
(5, 44),
(5, 45),
(5, 46),
(5, 47),
(5, 48),
(5, 49),
(5, 50),
(5, 51),
(5, 52),
(5, 53),
(5, 54),
(5, 55),
(5, 56),
(5, 57),
(5, 58),
(5, 59),
(5, 60),
(5, 61),
(5, 62),
(5, 63),
(5, 64),
(5, 65),
(5, 66),
(5, 67),
(5, 68),
(5, 69),
(5, 70),
(5, 71),
(5, 72),
(5, 73),
(5, 74),
(5, 75),
(5, 76),
(5, 77),
(5, 78),
(5, 79),
(5, 80),
(5, 81),
(5, 82),
(5, 83),
(5, 84),
(5, 85),
(5, 86),
(5, 87),
(5, 88),
(5, 89),
(5, 90),
(5, 91),
(5, 92),
(5, 93),
(5, 94),
(5, 95),
(5, 96),
(5, 97),
(5, 98),
(5, 99),
(5, 100),
(5, 101),
(5, 102),
(5, 103),
(5, 104),
(5, 105),
(5, 106),
(5, 107),
(5, 108),
(5, 109),
(5, 110),
(5, 111),
(5, 112),
(5, 113),
(5, 114),
(5, 115),
(5, 116),
(5, 117),
(5, 118),
(5, 119),
(5, 120),
(5, 121),
(5, 122),
(5, 123),
(5, 124),
(5, 125),
(5, 126),
(5, 127),
(5, 128),
(5, 129);

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
  `type` int(11) NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `milestone_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `milestone_id` (`milestone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `type`, `date`, `milestone_id`) VALUES
(1, 2, '2009-09-29', 5),
(2, 1, '2009-09-30', 6),
(3, 2, '2009-10-20', 6),
(4, 1, '2009-10-21', 7),
(5, 2, '2009-11-10', 7),
(6, 1, '2009-11-11', 8),
(7, 2, '2009-12-01', 8);

-- --------------------------------------------------------

--
-- Table structure for table `deliverables`
--

CREATE TABLE IF NOT EXISTS `deliverables` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `project_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned default NULL,
  `position` int(11) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL,
  `description` text,
  `bug_id` int(11) unsigned default NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `parent_id` (`parent_id`),
  KEY `bug_id` (`bug_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deliverables`
--

INSERT INTO `deliverables` (`id`, `project_id`, `parent_id`, `position`, `name`, `description`, `bug_id`, `created`, `modified`) VALUES
(1, 1, NULL, 0, 'How-to Library', 'The how-to listing page will have each category of how-tos with a brief description and link to that category''s page. This page will be static and localizable.', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, NULL, 0, 'Case Studies', 'The Case Studies landing page should have introductory text followed by a list of the case studies, with a brief description of each and links to their individual pages. This page will be static and localizable.', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `bugquery` text NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `product_id`, `name`, `url`, `bugquery`, `created`, `modified`) VALUES
(1, 1, '5.0.6', '5.0.6', 'https://bugzilla.mozilla.org/buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.6', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '5.0.7', '5.0.7', 'https://bugzilla.mozilla.org/buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.7', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, '5.0.8', '5.0.8', 'https://bugzilla.mozilla.org/buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, '5.0.9', '5.0.9', 'https://bugzilla.mozilla.org/buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.9', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, '5.1', '5.1', 'https://api-dev.bugzilla.mozilla.org/0.1/bug?product=addons.mozilla.org&target_milestone=5.1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, '5.2', '5.2', 'https://api-dev.bugzilla.mozilla.org/0.1/bug?product=addons.mozilla.org&target_milestone=5.2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, '5.3', '5.3', 'https://bugzilla.mozilla.org/buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, '5.4', '5.4', 'https://bugzilla.mozilla.org/buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL default 'default',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `url`, `theme`, `created`, `modified`) VALUES
(1, 'AMO', 'amo', 'default', '2009-06-21 01:13:23', '2009-06-21 01:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `products_users`
--

CREATE TABLE IF NOT EXISTS `products_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `role` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `project_id` (`product_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `products_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) unsigned NOT NULL,
  `milestone_id` int(11) unsigned default NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`),
  KEY `milestone_id` (`milestone_id`),
  KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `product_id`, `milestone_id`, `name`, `url`, `description`, `created`, `modified`) VALUES
(1, 1, 5, 'developer.AMO', 'developer.AMO', 'One-stop-shop for add-on developers to learn why they''d want to make an add-on, how to make an add-on, and manage their add-ons on AMO.', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `buguser` varchar(255) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `buguser` (`buguser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bugs_deliverables`
--
ALTER TABLE `bugs_deliverables`
  ADD CONSTRAINT `bugs_deliverables_ibfk_3` FOREIGN KEY (`deliverable_id`) REFERENCES `deliverables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bugs_deliverables_ibfk_2` FOREIGN KEY (`bug_id`) REFERENCES `bugs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bugs_milestones`
--
ALTER TABLE `bugs_milestones`
  ADD CONSTRAINT `bugs_milestones_ibfk_2` FOREIGN KEY (`bug_id`) REFERENCES `bugs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bugs_milestones_ibfk_1` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deliverables`
--
ALTER TABLE `deliverables`
  ADD CONSTRAINT `deliverables_ibfk_3` FOREIGN KEY (`bug_id`) REFERENCES `bugs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `deliverables_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliverables_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `deliverables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `milestones`
--
ALTER TABLE `milestones`
  ADD CONSTRAINT `milestones_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_users`
--
ALTER TABLE `products_users`
  ADD CONSTRAINT `products_users_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
