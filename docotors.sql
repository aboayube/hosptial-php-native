-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 12:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `from_date` varchar(111) NOT NULL,
  `to_date` varchar(111) NOT NULL,
  `day` varchar(111) NOT NULL,
  `docotor_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `user_name` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `from_date`, `to_date`, `day`, `docotor_id`, `status`, `user_name`) VALUES
(3, 'يسششسيشسي', 'يسشيسششسي', 'سيشسيشسشي', 2, '1', ''),
(4, '5', '2', 'ثلاثاء خميس', 3, '1', ''),
(5, '3', '6', 'img/news/السبت|احد|خميس', 2, '1', ''),
(7, '213', '123213', 'img/news/ADSAS', 2, '1', ''),
(8, '21', '5', 'img/news/السبت|احد|خميس', 3, '1', ''),
(9, '231213', '123213', 'img/news/123213', 3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `discription` text NOT NULL,
  `image` varchar(111) NOT NULL,
  `docotor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `name`, `discription`, `image`, `docotor_id`, `status`, `department_id`) VALUES
(5, 'انف واذن وحجنره', 'انف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنرهانف واذن وحجنره', 'img/clinic/1638091355-blog-card-1.png', 6, 1, 5),
(6, 'عظام', 'sadsadsaddsa', 'img/clinic/1638091336-blog-card-3.png', 3, 1, 5),
(9, 'fsdfdssdf', 'dsffdsdfs', 'img/clinic/1638094822-header.png', 2, 1, 5),
(13, 'ثصضصضصث', 'صضثصثضصث', 'img/clinic/1638237125-frontend.png', 1, 1, 7),
(14, 'عياده اسنان', 'عياده اسنان', 'img/clinic/1638272345-footer-section-bg.png', 1, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `status` int(11) NOT NULL,
  `discription` varchar(111) NOT NULL,
  `image` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `discription`, `image`) VALUES
(5, 'عيادات خارجيه2', 1, 'قسم يحتوي علي العديد من العيادات الطبيه ونخبه من الاطباء', 'img/department/1638093339-blog-card-2.png'),
(6, 'عيادات خارجيه', 1, 'قسم يحتوي علي العديد من العيادات الطبيه ونخبه من الاطباء', 'img/clinic/1638092801-frontend.png'),
(7, 'اشعه', 0, 'قسم الاشعه', 'img/department/1638094929-frontend.png'),
(8, 'بطاطا', 1, 'بطاطابطاطاب', 'img/department/1638237156-frontend.png'),
(9, 'saddsa', 1, 'asdsadsda', 'img/department/1638268690-header.png'),
(10, 'sadsadsdasadsda', 1, 'sdaadsads', 'img/department/1638268697-blog-card-2.png'),
(11, 'dsadsa', 1, 'dasdsa', 'img/department/1638268713-blog-section-left-bg.png');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `user_name` varchar(111) NOT NULL,
  `docotor_id` int(11) NOT NULL,
  `checkup` varchar(111) NOT NULL,
  `investigation` varchar(111) NOT NULL,
  `time` varchar(111) NOT NULL,
  `treatment` text NOT NULL,
  `file` varchar(111) NOT NULL,
  `age` varchar(111) NOT NULL,
  `mobile` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `user_name`, `docotor_id`, `checkup`, `investigation`, `time`, `treatment`, `file`, `age`, `mobile`) VALUES
(1, 'sadasdsadasd', 2, 'adsasasd', 'dsaasdsad', '1638238662', 'asdasd', 'asdasd', 'sadasd', 'asdasd'),
(2, 'سيشسشي', 3, 'sadsdasad', 'sadasdsad', '1638260411', 'sadadsads', '1638260411-footer-section-bg.png', 'dsasadsad', 'sadsad'),
(3, 'sdadsasda', 3, 'asdsadsad', 'sadsadsad', '1638260432', 'sadsadasd', '1638260432-contact-header-img.png', 'sdasadsad', 'asdsadsad'),
(4, 'sdadsasda', 3, 'asdsadsad', 'sadsadsad', '1638260443', 'sadsadasd', '1638260443-contact-header-img.png', 'sdasadsad', 'asdsadsad'),
(5, 'dsaasdasd', 3, 'sadadsdsa', 'sadsad', '1638260454', 'asdsda', '1638260454-footer-section-bg.png', 'asdsadsad', 'sadsadsad'),
(6, 'dsaasdasd', 3, 'sadadsdsa', 'sadsad', '1638260460', 'asdsda', '1638260460-footer-section-bg.png', 'asdsadsad', 'sadsadsad'),
(7, 'dsaasdasd', 3, 'sadadsdsa', 'sadsad', '1638260471', 'asdsda', '1638260471-footer-section-bg.png', 'asdsadsad', 'sadsadsad');

-- --------------------------------------------------------

--
-- Table structure for table `docotor_clinic`
--

CREATE TABLE `docotor_clinic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docotor_clinic`
--

INSERT INTO `docotor_clinic` (`id`, `user_id`, `clinic_id`) VALUES
(3, 9, 6),
(4, 9, 14),
(5, 17, 14),
(6, 18, 14);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(111) NOT NULL,
  `discription` text NOT NULL,
  `image` varchar(111) NOT NULL,
  `status` int(11) NOT NULL,
  `userid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `discription`, `image`, `status`, `userid`) VALUES
(3, 'شيسيسشسيش', 'سشيسيشسيش', 'img/news/1637844368-blog-card-1.png', 1, '1'),
(4, 'sadasd', 'sadasdads', 'img/news/1638268746-blog-card-1.png', 1, '1'),
(5, 'dasdsadsa', 'saddasasd', 'img/news/1638253327-frontend.png', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `image` varchar(111) NOT NULL,
  `facebook` varchar(111) NOT NULL,
  `whatsApp` varchar(111) NOT NULL,
  `phone` varchar(111) NOT NULL,
  `mobial` varchar(111) NOT NULL,
  `discription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `image`, `facebook`, `whatsApp`, `phone`, `mobial`, `discription`) VALUES
(1, 'جمعية اصدقاء المريض', 'logo.jpg', 'جمعة', '129231231231', 'جمعة', 'جمعة', 'جمعية اصدقاء المريض');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `status` int(1) NOT NULL,
  `role` varchar(11) NOT NULL,
  `image` varchar(111) NOT NULL,
  `mobial` varchar(111) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `age` varchar(11) DEFAULT NULL,
  `discription` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `status`, `role`, `image`, `mobial`, `clinic_id`, `age`, `discription`) VALUES
(1, '3shimaa', '601f1889667efaebb33b8c12572835da3f027f78', 'shimaa2019@gmail.com', 1, 'admin', '1638238545-frontend.png', '0595913186', 5, NULL, 'asdsadsad'),
(2, 'هند', '601f1889667efaebb33b8c12572835da3f027f78', 'sadsadsadsa@asddas.as', 1, 'docotor', 'defulat.png', 'adssadads', 5, NULL, 'asdsadsad'),
(3, 'وجيه', '601f1889667efaebb33b8c12572835da3f027f78', 'sadsad21sadsa@asddas.as', 1, 'docotor', 'defulat.png', 'adssasdadads', 6, NULL, 'sadasdsad'),
(6, 'sadsdasad2', '601f1889667efaebb33b8c12572835da3f027f78', 'sadsa@gmail.com', 1, '', 'defulat.png', '21332321', 6, NULL, 'sadsadsad'),
(7, 'lkhjgugiyoi', '601f1889667efaebb33b8c12572835da3f027f78', 'ziyad2019@gmail.com', 1, '', 'defulat.png', '123321321', 5, NULL, 'sadsadsad'),
(8, 'محمو الشيخ علي', '601f1889667efaebb33b8c12572835da3f027f78', 'mohmoed2019@gmail.com', 0, '', 'defulat.png', '12312321', 6, NULL, 'sadasdsad'),
(9, 'شسيسشيسشي', '', 'شسيشيسشسي@يسشيسشسشي', 0, '', '', 'شسيسشيشسي', 0, 'شسيشسيشسي', ''),
(10, 'شسيسشيسشي', '', 'شسيشيسشسي@يسشيسشسشي', 0, '', '', 'شسيسشيشسي', 0, 'شسيشسيشسي', ''),
(11, 'sadasdsaddas', '', 'saddsadsa', 0, '', '', 'asdsadsad', 0, 'asdsadsad', ''),
(12, 'sadasdsaddas', '', 'saddsadsa', 0, '', '', 'asdsadsad', 0, 'asdsadsad', ''),
(13, 'sadasdsaddas', '', 'saddsadsa', 0, '', '', 'asdsadsad', 0, 'asdsadsad', ''),
(14, 'sadasdsaddas', '', 'saddsadsa', 0, '', '', 'asdsadsad', 0, 'asdsadsad', ''),
(15, 'محمد', '', '123213213', 0, '', '', '312132123', 0, '123213123', ''),
(16, 'sdaasdsad', '', 'asddas', 0, '', '', 'sadasddsa', 0, 'sadadssad', ''),
(17, 'sdaasdsad', '', 'asddas', 0, '', '', 'sadasddsa', 0, 'sadadssad', ''),
(18, 'سعيج', '', '123312132@يسششسي', 0, '', '', 'سشيسشيسشي', 0, '12', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docotor_id` (`docotor_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docotor_id` (`docotor_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docotor_clinic`
--
ALTER TABLE `docotor_clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `docotor_clinic`
--
ALTER TABLE `docotor_clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`docotor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `clinics`
--
ALTER TABLE `clinics`
  ADD CONSTRAINT `clinics_ibfk_1` FOREIGN KEY (`docotor_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
