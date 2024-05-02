-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 08:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainster_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `email`, `password`) VALUES
(1, 'kristijan@gmail.com', '$2y$10$30uqcF.tDe9dEjQWfH4UK./5WV9/NcTz2xYHtzFw4zs2toHl2G42K');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `bio` text NOT NULL CHECK (char_length(`bio`) >= 20),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `surname`, `bio`, `is_deleted`) VALUES
(1, 'John', 'Doe', 'Bestselling author with a passion for storytelling.', 0),
(2, 'Jane', 'Smith', 'Data scientist turned writer exploring the world of technology.', 0),
(3, 'Robert', 'Johnson', 'Experienced coder sharing the secrets of programming.', 0),
(5, 'Michaelssss', 'Turnersss', 'Astrophysicist delving into the mysteries of the cosmos.sss', 0),
(6, 'Alice', 'Baker', 'Chef and culinary expert on culinary adventures.', 0),
(7, 'David', 'Poet', 'Versatile poet expressing emotions through words.', 0),
(8, 'Samantha', 'Thriller', 'Master of suspense weaving thrilling tales.', 0),
(9, 'Chris', 'Scientist', 'Science enthusiast making complex subjects accessible to all.', 0),
(30, 'John', 'Doe', 'A prolific author with a passion for storytelling.', 0),
(31, 'Jane', 'Smith', 'An imaginative writer who explores new worlds in her works.', 0),
(32, 'Robert', 'Johnson', 'A master of mystery and intrigue in the literary world.', 0),
(33, 'Emily', 'Brown', 'A romantic soul who captures hearts with her words.', 0),
(34, 'David', 'Williams', 'A fantasy enthusiast creating magical realms in every book.', 0),
(35, 'Sarah', 'Miller', 'A thriller writer who keeps readers on the edge of their seats.', 0),
(36, 'Michael', 'Davis', 'A historical fiction author bringing the past to life.', 0),
(37, 'Olivia', 'Jones', 'An adventurous spirit weaving tales of excitement.', 0),
(38, 'Thomas', 'White', 'A horror writer who thrives on chilling the bones of readers.', 0),
(39, 'Grace', 'Wilson', 'A dramatist with a flair for compelling storytelling.', 0),
(40, 'Chris', 'Taylor', 'A humorist crafting stories that bring laughter.', 0),
(41, 'Anna', 'Clark', 'A biographer chronicling the lives of remarkable individuals.', 0),
(42, 'Mark', 'Baker', 'A self-help guru inspiring positive change.', 0),
(43, 'Laura', 'Adams', 'A scientist exploring the wonders of the natural world.', 0),
(44, 'William', 'Turner', 'A poet expressing emotions through verse.', 0),
(46, 'New', 'Authors', 'New author bio new author bio', 1),
(47, 'Newest', 'New', 'Newestnewestnewestnewestnewestnewestnewestnewestnewest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `year_of_issue` int(11) NOT NULL,
  `number_of_pages` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author_id`, `year_of_issue`, `number_of_pages`, `category_id`, `image`, `is_deleted`) VALUES
(2, 'Data Science for Beginners', 41, 2019, 240, 46, 'https://bukovero.com/wp-content/uploads/2016/07/greatreckoning.jpg', 0),
(3, 'The Coding Journey', 3, 2017, 180, 44, 'https://bukovero.com/wp-content/uploads/2016/07/The-Black-Widow-Gabriel-Allon-by-Daniel-Silva.jpg', 0),
(4, 'History Revisited', 40, 2010, 400, 4, 'https://bukovero.com/wp-content/uploads/2016/07/girlonthetrain.jpg', 0),
(5, 'Mystery of the Cosmos', 5, 2021, 280, 1, 'https://bukovero.com/wp-content/uploads/2016/07/gravityfalls.jpg', 0),
(6, 'Cooking Adventures', 6, 2015, 160, 6, 'https://bukovero.com/wp-content/uploads/2016/07/milkhoney.jpg', 0),
(7, 'Poetry Collection', 7, 2008, 120, 1, 'https://bukovero.com/wp-content/uploads/2016/07/mostlyvoid.jpg', 0),
(8, 'Thriller in the Shadows', 8, 2013, 350, 46, 'https://bukovero.com/wp-content/uploads/2016/07/greatglowingcoil.jpg', 0),
(9, 'The Science of Everything', 9, 2014, 300, 2, 'https://bukovero.com/wp-content/uploads/2016/07/Harry_Potter_and_the_Cursed_Child_Special_Rehearsal_Edition_Book_Cover.jpg', 0),
(23, 'The Hidden Gems', 1, 2020, 300, 1, 'https://bukovero.com/wp-content/uploads/2016/07/AfterYou.jpg', 0),
(24, 'Stellar Odyssey', 2, 2018, 400, 2, 'https://bukovero.com/wp-content/uploads/2016/07/5more.jpg', 0),
(25, 'Whodunit Chronicles', 3, 2015, 250, 45, 'https://bukovero.com/wp-content/uploads/2016/07/justfriends.jpg', 0),
(26, 'Eternal Love', 33, 2019, 350, 4, 'https://bukovero.com/wp-content/uploads/2016/07/mancalledove.jpg', 0),
(27, 'Realm of Magic', 5, 2021, 500, 4, 'https://bukovero.com/wp-content/uploads/2016/07/wrongsidegoodbye.jpg', 0),
(28, 'The Art of me', 36, 500, 500, 1, 'https://bukovero.com/wp-content/uploads/2016/07/greatglowingcoil.jpg', 1),
(29, 'The new art of me', 7, 2020, 500, 44, 'https://bukovero.com/wp-content/uploads/2016/07/greatglowingcoil.jpg', 1),
(30, 'The Art of messs', 2, 2013, 500, 4, 'https://bukovero.com/wp-content/uploads/2016/07/greatglowingcoil.jpg', 1),
(31, 'Adding new books', 2, 2050, 1500, 9, 'https://bukovero.com/wp-content/uploads/2016/07/greatglowingcoil.jpg', 1),
(32, 'The Art', 8, 2050, 5000, 2, 'https://bukovero.com/wp-content/uploads/2016/07/greatglowingcoil.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_comment`
--

CREATE TABLE `book_comment` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_new` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_comment`
--

INSERT INTO `book_comment` (`id`, `book_id`, `comment_id`, `user_id`, `is_approved`, `is_new`) VALUES
(81, 5, 83, 29, 1, 0),
(82, 7, 84, 29, 0, 1),
(83, 23, 85, 29, 0, 1),
(84, 5, 86, 22, 0, 0),
(85, 7, 87, 22, 0, 1),
(86, 23, 88, 22, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `is_deleted`) VALUES
(1, 'Fiction', 0),
(2, 'Science', 0),
(4, 'History', 0),
(6, 'Cookings', 0),
(9, 'Education', 0),
(43, 'Mystery', 0),
(44, 'Romance', 0),
(45, 'Fantasy', 0),
(46, 'Thriller', 0),
(63, 'New cat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `created_at`) VALUES
(83, 'blazho comment mystery', '2023-12-03 19:35:55'),
(84, 'blazho comment Poetry ', '2023-12-03 19:36:51'),
(85, 'blazho comm hidden', '2023-12-03 19:37:07'),
(86, 'Jane comm Mystery ', '2023-12-03 19:39:11'),
(87, 'Jane comm Mystery poetry', '2023-12-03 19:39:16'),
(88, 'Jane comm Mystery hidden', '2023-12-03 19:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `private_notes`
--

CREATE TABLE `private_notes` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `private_notes`
--

INSERT INTO `private_notes` (`id`, `book_id`, `user_id`, `note_text`) VALUES
(76, 24, 22, 'jane note odd'),
(77, 4, 22, 'jane history note'),
(80, 24, 21, 'john stellar notes'),
(81, 4, 21, 'john history note\n'),
(82, 24, 21, 'john stellar note 2'),
(83, 5, 29, 'blazho note mystery'),
(84, 23, 29, 'note blazho');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`) VALUES
(21, 'John', 'Doe', 'john@gmail.com', '$2y$10$yAB8u3fPc/P0yDmvhE5KiOrSJAreiofFFc1K3r2dSZUphtct9wrWu'),
(22, 'Jane', 'Doe', 'jane@gmail.com', '$2y$10$ozHtB2PtgmNzN/y8Ds5h0uRyuKOvxFB9u17PSzMHBGskCbzmOk2Zy'),
(23, 'elis', 'dow', 'elis@gmail.com', '$2y$10$.Z6yF6LdFjhu8SSg8zuS4eoFn1VwqP.FWTIbgyn76fK6oAH9rqRU6'),
(24, 'Crash', 'Ftw', 'kristijankacurovski@gmail.com', '$2y$10$TRitykBmM4LHNtHi0me58Oef7SnJDuzFs6cd5P3NeayulDKoxO6hW'),
(25, 'izabela', 'bran', 'izabela@gmail.com', '$2y$10$ZBenSz.5E02An29FY4wtIeAFz.z09eeUtAUEDzy9M0CktbBgx8h0.'),
(28, 'david', 'davidson', 'david@gmail.com', '$2y$10$4zgjbjmyh5AtxZPf/PunYO.s9RuoeQ9hj766/LC0Gcn6uXPJwKnue'),
(29, 'Blazho', 'Bran', 'blazho@gmail.com', '$2y$10$mT85UEipyZ6U5FQHvVtqIO3f8hmJZ2h1M0BCsIE1h6ZMNF0asc/BW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `book_comment`
--
ALTER TABLE `book_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `fk_book_comment_user` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_notes`
--
ALTER TABLE `private_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `book_comment`
--
ALTER TABLE `book_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `private_notes`
--
ALTER TABLE `private_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `book_comment`
--
ALTER TABLE `book_comment`
  ADD CONSTRAINT `book_comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_comment_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_book_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `private_notes`
--
ALTER TABLE `private_notes`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `private_notes_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `private_notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
