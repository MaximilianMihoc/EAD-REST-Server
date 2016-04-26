-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 01:34 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dit`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`) VALUES
(1, 'max', 'mihoc', 'email@jjjsjs.com', 123456),
(13, 'Adrian', 'Mihoc', 'max@gmail.com', 111111),
(15, 'Adam', 'Miedodsn', 'adamdo@jaja.clo', 123456),
(24, 'updatedUser2', 'sur2', 'l2ala@lala.com', 1223456),
(26, 'Administrator', 'Admin', 'admin@email.com', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 01:33 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dit`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `email`, `phone`) VALUES
(1, 'Ian F.', 'Darwin', 'press@oreilly.com', 877767543),
(2, 'Leonard', 'Anghel', 'leonard@jury.com', 851737141),
(3, 'Adam', 'Tacy', 'adamt@manning.com', 862347141);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 01:34 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dit`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `authorID` int(11) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `pages` int(5) NOT NULL,
  `rating` decimal(11,2) DEFAULT NULL,
  `publisher` varchar(100) NOT NULL,
  `publicationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `authorID`, `ISBN`, `pages`, `rating`, `publisher`, `publicationDate`) VALUES
(1, 'Java Cookbook, 3rd Edition', 1, '978-1-4493-3704-9', 898, '4.50', 'O''Reilly Media, Inc.', '2014-07-08'),
(2, 'Android Cookbook', 1, '978-1-4493-8841-6', 710, '3.50', 'O''Reilly Media, Inc.', '2012-04-20'),
(3, 'Checking Java Programs', 1, '978-1-4493-8841-10', 198, '5.00', 'O''Reilly Media, Inc.', '2007-03-30'),
(4, 'Tomcat: The Definitive Guide, 2nd Edition', 1, '978-0-596-10106-0', 496, '4.50', 'O''Reilly Media, Inc.', '2007-10-23'),
(5, 'Mastering JavaServer Faces 2.2', 2, '978-1-78217-647-3', 578, '0.00', 'Packt Publishing', '2014-06-25'),
(6, 'Pro Java 7 NIO.2', 2, '978-1-4302-4011-2', 297, '4.00', 'Apress', '2011-12-07'),
(7, 'Pro Hibernate and MongoDB', 2, '978-1-4302-5794-3', 384, '3.00', 'Apress', '2013-06-26'),
(8, 'JSF 2.0 Cookbook', 2, '978-1-84719-953-9', 396, '2.50', 'Packt Publishing', '2010-06-08'),
(9, 'GWT in Action, Second Edition', 3, '978-1-935182-84-9', 680, '4.50', 'Manning Publications', '2013-02-07'),
(10, 'GWT in Action: Easy Ajax with the Google Web Toolkit', 3, '978-1-933988-23-8', 600, '5.00', 'Manning Publications', '2007-06-05'),
(11, 'Taming Text: How to Find, Organize, and Manipulate It', 3, '978-1-933988-38-2', 320, '4.50', 'Manning Publications', '2012-12-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
