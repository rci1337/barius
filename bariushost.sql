-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 11:27 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bariushost`
--

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `isPrivate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `domainselector`
--

CREATE TABLE `domainselector` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL DEFAULT 'barius.club',
  `subDomain` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `embeds`
--

CREATE TABLE `embeds` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `embedColor` varchar(255) NOT NULL DEFAULT '#a600ff',
  `author` varchar(255) NOT NULL DEFAULT '{username} | {uid}',
  `title` varchar(255) NOT NULL DEFAULT '{file}',
  `description` varchar(255) NOT NULL DEFAULT 'Uploaded at {date}',
  `randomColor` varchar(255) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `ID` int(255) NOT NULL,
  `invite` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `isUsed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `UPID` int(11) NOT NULL,
  `uploadedBy` varchar(255) NOT NULL,
  `uploadName` varchar(255) NOT NULL,
  `fromUploadKey` varchar(255) NOT NULL,
  `fromIP` varchar(255) NOT NULL,
  `mimeType` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `invitedBy` varchar(255) NOT NULL,
  `uploadKey` varchar(500) NOT NULL DEFAULT 'N/A',
  `isAdmin` int(11) NOT NULL,
  `isBanned` varchar(255) DEFAULT NULL,
  `banReason` varchar(255) NOT NULL,
  `discordUsername` varchar(256) NOT NULL,
  `discordID` varchar(25) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `discordpfp` varchar(255) NOT NULL DEFAULT 'https://cdn.discordapp.com/attachments/863092966049316866/863180077695762432/bcyq3rjk2w071.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `domainselector`
--
ALTER TABLE `domainselector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `embeds`
--
ALTER TABLE `embeds`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`UPID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domainselector`
--
ALTER TABLE `domainselector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `embeds`
--
ALTER TABLE `embeds`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `UPID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
