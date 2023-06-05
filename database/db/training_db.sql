-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 04:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allotment_letters`
--

CREATE TABLE `allotment_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_left_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_middle_heading` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_right_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_first_part` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_second_part` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_date` date DEFAULT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allotment_table` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_signed` int(11) NOT NULL DEFAULT 0,
  `signature_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_date` date DEFAULT NULL,
  `signature_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letter_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_first_part_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_second_part_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_date_2` date DEFAULT NULL,
  `letter_acknowledgement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_signed_2` int(11) NOT NULL DEFAULT 0,
  `signature_image_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_date_2` date DEFAULT NULL,
  `signature_info_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_allotments` int(11) DEFAULT 0,
  `total_units` int(11) DEFAULT 0,
  `unit_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fiscal_years` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double(20,2) DEFAULT 0.00,
  `mail_count` int(11) DEFAULT 0,
  `sms_count` int(11) DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allotment_letters`
--

INSERT INTO `allotment_letters` (`id`, `header_left_logo`, `header_middle_heading`, `header_right_logo`, `sub_header_memo_first_part`, `sub_header_memo_second_part`, `sub_header_memo_date`, `subject`, `reference`, `description`, `allotment_table`, `instructions`, `is_signed`, `signature_image`, `signature_date`, `signature_info`, `letter_to`, `sub_header_memo_first_part_2`, `sub_header_memo_second_part_2`, `sub_header_memo_date_2`, `letter_acknowledgement`, `is_signed_2`, `signature_image_2`, `signature_date_2`, `signature_info_2`, `total_allotments`, `total_units`, `unit_ids`, `code_ids`, `fiscal_years`, `total_amount`, `mail_count`, `sms_count`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'header_left_logo_20220124_1643023977.jpg', '<div style=\"text-align:center\">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার<br />\r\nবাংলাদেশ পুলিশ<br />\r\nপুলিশ হেডকোয়ার্টার্স, ঢাকা<br />\r\nট্রেনিং-১ শাখা<br />\r\nwww.police.gov.bd</div>', 'header_right_logo_20220124_1643024151.png', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-', '৫০০', '2022-02-12', '<div style=\"text-align:justify\"><strong>বিষয়ঃ&nbsp;২০২১-২২ অর্থ বছরের প্রশিক্ষণের সম্মানী ভাতা বাবদ অর্থ বরাদ্দ প্রসঙ্গে।</strong></div>', NULL, '<div style=\"text-align:justify\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; উপর্যুক্ত বিষয়ের প্রেক্ষিতে সদয় অবগতির জন্য জানানো যাচ্ছে যে, ২০/১১/২০২১খ্রি। হতে অনুষ্ঠিতব্য পদমর্যাদা ভিত্তিক নিম্নোক্ত প্রশিক্ষণ কোর্সের <strong>সম্মানী ভাতা</strong> বাবদ ব্যয় নির্বাহের জন্য চলতি ২০২১-২২ অর্থ বছরের বাংলাদেশ পুলিশ বাজেটের <strong>১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইন্সটিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা</strong>❜&nbsp;খাত হতে ছকে উল্লেখিত অর্থ আদিষ্ট হয়ে আপনার অনুকূলে বরাদ্দ প্রদান করা হলো।</div>', '<div style=\"font-weight:bold; text-align:center; width:100%\"><u>&zwnj;❛ছক❜</u></div>\r\n\r\n<div>\r\n<table border=\"1\" cellspacing=\"0\" style=\"border-collapse:collapse; border:1px solid black; width:100%\">\r\n	<thead>\r\n		<tr>\r\n			<th>ক্রমিক</th>\r\n			<th>ইউনিটের নাম</th>\r\n			<th>কোর্সের নাম</th>\r\n			<th>অফিস আইডি</th>\r\n			<th>ডিডিও আইডি</th>\r\n			<th>বরাদ্দকৃত অর্থ</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\">১</td>\r\n			<td>ঢাকা জেলা</td>\r\n			<td>নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স</td>\r\n			<td style=\"text-align:center\">১০৬১১০</td>\r\n			<td style=\"text-align:center\">০২৩৮১৫৮</td>\r\n			<td style=\"text-align:right\">৪৪,০০০.০০/-</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\">২</td>\r\n			<td>নারায়নগঞ্জ জেলা</td>\r\n			<td>নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স</td>\r\n			<td style=\"text-align:center\">১০৬১১৮</td>\r\n			<td style=\"text-align:center\">০১৯৬২৯৭</td>\r\n			<td style=\"text-align:right\">৪৪,০০০.০০/-</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\">৩</td>\r\n			<td>নরসিংদী জেলা</td>\r\n			<td>নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স</td>\r\n			<td style=\"text-align:center\">১০৬১১৯</td>\r\n			<td style=\"text-align:center\">০০৭৬০৬৪</td>\r\n			<td style=\"text-align:right\">৪৪,০০০.০০/-</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\" style=\"text-align:center\">৪</td>\r\n			<td rowspan=\"2\">গাজীপুর জেলা</td>\r\n			<td>সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স</td>\r\n			<td rowspan=\"2\" style=\"text-align:center\">১০৬১১২</td>\r\n			<td rowspan=\"2\" style=\"text-align:center\">০০২৯০১৫</td>\r\n			<td rowspan=\"2\" style=\"text-align:right\">১,১৮,০০০.০০/-</td>\r\n		</tr>\r\n		<tr>\r\n			<td>নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\">৫</td>\r\n			<td>মুন্সীগঞ্জ জেলা</td>\r\n			<td>নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স</td>\r\n			<td style=\"text-align:center\">১০৬১১৭</td>\r\n			<td style=\"text-align:center\">০০৭৩৮৪২</td>\r\n			<td style=\"text-align:right\">৪৪,০০০.০০/-</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', '<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:justify\">আর্থিক বরাদ্দকৃত অর্থ Delegation of Financial Powers 2020 এবং যথাযথ ভাবে আর্থিক বিধি-বিধান পরিপালন সাপেক্ষে ব্যয়যোগ্য।</li>\r\n	<li style=\"text-align:justify\">প্রধান হিসাব রক্ষণ কর্মকর্তার কার্যালয়ে হিসাব পাঠানোর নিমিত্ত বাজেট শাখায় প্রদানের লক্ষ্যে উপর্যুক্ত ব্যয়ের হিসাব পরবর্তি মাসের ৫ (পাঁচ) তারিখের মধ্যে স্থানীয় হিসাব রক্ষণ অফিস কর্তৃপক্ষের প্রতিসাক্ষরের কপিসহ হিসাব বিবরণী ট্রেনিং শাখায় প্রেরণ করার জন্য অনুরোধ করা হল।</li>\r\n	<li style=\"text-align:justify\">অব্যয়িত অর্থ যথাসময়ে সমর্পণ করার জন্যও অনুরোধ করা হলো।</li>\r\n</ul>', 1, NULL, '2022-02-12', '<div style=\"text-align:center\">(মিয়া মাসুদ করিম)<br />\r\nবিপি-৭২০১০৮৯৩৭৪<br />\r\nএ্যাডিশনাল ডিআইজি (ট্রেনিং-১)<br />\r\nবাংলাদেশ পুলিশ<br />\r\nফোন নং-০২২৩৩৮৪৭৭৫<br />\r\nE-mail: <u>aigtrg@police.gov.bd</u></div>', '<u><strong>বিতরণঃ (জেষ্ঠ্যতার ভিত্তিতে নয়)</strong></u><br />\r\n১। রেক্টর, পুলিশ স্টাফ কলেজ বাংলাদেশ, ঢাকা।<br />\r\n২। প্রিন্সিপ্যাল, বাংলাদেশ&nbsp; পুলিশ একাডেমী, সারদা, রাজশাহী।', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-', '৫০০', '2022-02-12', '<u><strong>অনুলিপি সদয় জ্ঞাতার্থে ও কার্যার্থেঃ</strong></u>&nbsp;<strong>(জেষ্ঠতার ভিত্তিতে নয়)</strong><br />\r\n১। প্রধান হিসাব রক্ষণ কর্মকর্তা, জননিরাপত্তা বিভাগ, স্বরাষ্ট্র মন্ত্রণালয়, সিজিএ ভবন, সেগুনবাগিচা, ঢাকা।<br />\r\n২। অতিরিক্ত ডিআইজি (ফিন্যান্স), বাংলাদেশ পুলিশ, পুলিশ হেডকোয়ার্টার্স, ঢাকা [সদয় অনুমোদনের জন্য]।', 1, NULL, '2022-02-12', '<div style=\"text-align:center\">(মিয়া মাসুদ করিম)<br />\r\nবিপি-৭২০১০৮৯৩৭৪<br />\r\nএ্যাডিশনাল ডিআইজি (ট্রেনিং-১)<br />\r\nবাংলাদেশ পুলিশ<br />\r\nফোন নং-০২২৩৩৮৪৭৭৫<br />\r\nE-mail: <u>aigtrg@police.gov.bd</u></div>', 6, 5, '|3| |4| |6| |7| |8|', '|1|', '|2021-2022| |2021-2022| |2021-2022| |2021-2022| |2021-2022| |2021-2022|', 294000.00, 0, 24, 2, 2, '2022-02-12 14:25:01', '2022-02-16 20:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `code`, `code_name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ', '১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ', '১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ', 2, 2, '2021-12-24 16:51:38', '2021-12-24 16:51:38'),
(2, '১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩২৩১৩০১-প্রশিক্ষণ', '১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩২৩১৩০১-প্রশিক্ষণ', '১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩২৩১৩০১-প্রশিক্ষণ', 2, 2, '2021-12-24 16:51:53', '2021-12-24 16:51:53'),
(3, '১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা', '১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা', '১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা', 2, 2, '2021-12-24 16:52:05', '2021-12-24 16:53:41'),
(4, '১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা', '১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা', '১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা', 2, 2, '2021-12-24 16:52:19', '2021-12-24 16:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `code_allotments`
--

CREATE TABLE `code_allotments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_id` int(11) NOT NULL COMMENT 'codes',
  `amount` double NOT NULL DEFAULT 0,
  `fiscal_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `allotment_memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allotment_memo_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=unapproved, 1=approved',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `code_allotments`
--

INSERT INTO `code_allotments` (`id`, `code_id`, `amount`, `fiscal_year`, `transaction_date`, `allotment_memo`, `allotment_memo_date`, `status`, `description`, `approved_at`, `approved_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 10000000, '2021-2022', '2021-12-28', 'dfdgfdg', '2021-12-09', 1, 'gfrgrfgr', '2022-01-14 17:04:16', 2, 2, 2, '2021-12-27 20:55:12', '2022-01-14 11:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `code_surrenders`
--

CREATE TABLE `code_surrenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_id` int(11) NOT NULL COMMENT 'codes',
  `amount` double NOT NULL DEFAULT 0,
  `fiscal_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memo_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=unapproved, 1=approved',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_server` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `related_model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_model_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `mail_server`, `from_mail`, `to_mail`, `subject`, `content`, `attachment`, `cc`, `status`, `related_model_type`, `related_model_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'bdchessfed.com', 'training@bdchessfed.com', 'phqtoukirahamed@gmail.com', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<!DOCTYPE html>\r\n<html lang=\"bn\" class=\"no-js\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <link rel=\"icon\" href=\"http://training.bdchessfed.com/public/images/logos/logo.png\">\r\n    <meta name=\"description\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\">\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n    <meta name=\"keywords\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\" />\r\n    <!-- CSRF Token -->\r\n    <meta name=\"csrf-token\" content=\"Q4SjERiX1JmLYDaeB85wNvlGeC2nCzpfYB9tdtid\">\r\n</head>\r\n<body>\r\n          <div style=\"text-align:justify\">১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।</div>\r\n</body>\r\n</html>\r\n', NULL, NULL, 1, 'unit_allotment', 4, 2, 2, '2022-02-14 19:01:58', '2022-02-14 19:01:58'),
(2, 'bdchessfed.com', 'training@bdchessfed.com', 'phqtoukirahamed@gmail.com', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<!DOCTYPE html>\r\n<html lang=\"bn\" class=\"no-js\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <link rel=\"icon\" href=\"http://training.bdchessfed.com/public/images/logos/logo.png\">\r\n    <meta name=\"description\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\">\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n    <meta name=\"keywords\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\" />\r\n    <!-- CSRF Token -->\r\n    <meta name=\"csrf-token\" content=\"Q4SjERiX1JmLYDaeB85wNvlGeC2nCzpfYB9tdtid\">\r\n</head>\r\n<body>\r\n          <div style=\"text-align:justify\">১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।</div>\r\n</body>\r\n</html>\r\n', NULL, NULL, 1, 'unit_allotment', 5, 2, 2, '2022-02-14 19:02:04', '2022-02-14 19:02:04'),
(3, 'bdchessfed.com', 'training@bdchessfed.com', 'phqtoukirahamed@gmail.com', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<!DOCTYPE html>\r\n<html lang=\"bn\" class=\"no-js\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <link rel=\"icon\" href=\"http://training.bdchessfed.com/public/images/logos/logo.png\">\r\n    <meta name=\"description\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\">\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n    <meta name=\"keywords\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\" />\r\n    <!-- CSRF Token -->\r\n    <meta name=\"csrf-token\" content=\"Q4SjERiX1JmLYDaeB85wNvlGeC2nCzpfYB9tdtid\">\r\n</head>\r\n<body>\r\n          <div style=\"text-align:justify\">১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।</div>\r\n</body>\r\n</html>\r\n', NULL, NULL, 1, 'unit_allotment', 6, 2, 2, '2022-02-14 19:02:09', '2022-02-14 19:02:09'),
(4, 'bdchessfed.com', 'training@bdchessfed.com', 'phqtoukirahamed@gmail.com', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<!DOCTYPE html>\r\n<html lang=\"bn\" class=\"no-js\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <link rel=\"icon\" href=\"http://training.bdchessfed.com/public/images/logos/logo.png\">\r\n    <meta name=\"description\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\">\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n    <meta name=\"keywords\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\" />\r\n    <!-- CSRF Token -->\r\n    <meta name=\"csrf-token\" content=\"Q4SjERiX1JmLYDaeB85wNvlGeC2nCzpfYB9tdtid\">\r\n</head>\r\n<body>\r\n          <div style=\"text-align:justify\">১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।</div>\r\n</body>\r\n</html>\r\n', NULL, NULL, 1, 'unit_allotment', 7, 2, 2, '2022-02-14 19:02:15', '2022-02-14 19:02:15'),
(5, 'bdchessfed.com', 'training@bdchessfed.com', 'phqtoukirahamed@gmail.com', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<!DOCTYPE html>\r\n<html lang=\"bn\" class=\"no-js\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <link rel=\"icon\" href=\"http://training.bdchessfed.com/public/images/logos/logo.png\">\r\n    <meta name=\"description\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\">\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n    <meta name=\"keywords\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\" />\r\n    <!-- CSRF Token -->\r\n    <meta name=\"csrf-token\" content=\"Q4SjERiX1JmLYDaeB85wNvlGeC2nCzpfYB9tdtid\">\r\n</head>\r\n<body>\r\n          <div style=\"text-align:justify\">১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।</div>\r\n</body>\r\n</html>\r\n', NULL, NULL, 1, 'unit_allotment', 8, 2, 2, '2022-02-14 19:02:21', '2022-02-14 19:02:21'),
(6, 'bdchessfed.com', 'training@bdchessfed.com', 'phqtoukirahamed@gmail.com', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<!DOCTYPE html>\r\n<html lang=\"bn\" class=\"no-js\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <link rel=\"icon\" href=\"http://training.bdchessfed.com/public/images/logos/logo.png\">\r\n    <meta name=\"description\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\">\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n    <meta name=\"keywords\" content=\"পুলিশ ট্রেনিং বাজেট Admin.\" />\r\n    <!-- CSRF Token -->\r\n    <meta name=\"csrf-token\" content=\"Q4SjERiX1JmLYDaeB85wNvlGeC2nCzpfYB9tdtid\">\r\n</head>\r\n<body>\r\n          <div style=\"text-align:justify\">১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।</div>\r\n</body>\r\n</html>\r\n', NULL, NULL, 1, 'unit_allotment', 9, 2, 2, '2022-02-14 19:02:26', '2022-02-14 19:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letter_allotment_transactions`
--

CREATE TABLE `letter_allotment_transactions` (
  `letter_id` int(11) NOT NULL,
  `allotment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `letter_allotment_transactions`
--

INSERT INTO `letter_allotment_transactions` (`letter_id`, `allotment_id`) VALUES
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `description`, `action`, `type`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '[Toukir Ahamed Pigeon]\'s Role [Developer] has been Removed.', 'Remove User Role', 'danger', 2, '2021-12-24 11:38:42', '2021-12-24 11:38:42'),
(2, '[Toukir Ahamed Pigeon] has been assigned to new Role as [Developer] User.', 'Assign User Role', 'success', 2, '2021-12-24 11:38:42', '2021-12-24 11:38:42'),
(3, '[Toukir Ahamed Pigeon] has Edited his Profile.', 'Edit Profile', 'success', 2, '2021-12-24 11:38:42', '2021-12-24 11:38:42'),
(4, 'Super Admin has been assigned permission Read Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(5, 'Admin has been assigned permission Read Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(6, 'Developer has been assigned permission Read Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(7, 'Read Recipient=create Recipient=edit Recipient=delete Recipient Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(8, 'Super Admin has been assigned permission Create Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(9, 'Admin has been assigned permission Create Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(10, 'Developer has been assigned permission Create Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(11, 'Read Recipient=create Recipient=edit Recipient=delete Recipient Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(12, 'Super Admin has been assigned permission Edit Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(13, 'Admin has been assigned permission Edit Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(14, 'Developer has been assigned permission Edit Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(15, 'Read Recipient=create Recipient=edit Recipient=delete Recipient Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(16, 'Super Admin has been assigned permission Delete Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(17, 'Admin has been assigned permission Delete Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(18, 'Developer has been assigned permission Delete Recipient.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(19, 'Read Recipient=create Recipient=edit Recipient=delete Recipient Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(20, 'Super Admin has been assigned permission Read Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:54', '2021-12-24 11:49:54'),
(21, 'Admin has been assigned permission Read Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:54', '2021-12-24 11:49:54'),
(22, 'Developer has been assigned permission Read Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:54', '2021-12-24 11:49:54'),
(23, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:54', '2021-12-24 11:49:54'),
(24, 'Super Admin has been assigned permission Create Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(25, 'Admin has been assigned permission Create Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(26, 'Developer has been assigned permission Create Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(27, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(28, 'Super Admin has been assigned permission Edit Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(29, 'Admin has been assigned permission Edit Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(30, 'Developer has been assigned permission Edit Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(31, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(32, 'Super Admin has been assigned permission Delete Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(33, 'Admin has been assigned permission Delete Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(34, 'Developer has been assigned permission Delete Unit.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(35, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(36, 'Super Admin has been assigned permission Read Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(37, 'Admin has been assigned permission Read Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(38, 'Developer has been assigned permission Read Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(39, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(40, 'Super Admin has been assigned permission Create Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(41, 'Admin has been assigned permission Create Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(42, 'Developer has been assigned permission Create Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(43, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(44, 'Super Admin has been assigned permission Edit Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(45, 'Admin has been assigned permission Edit Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(46, 'Developer has been assigned permission Edit Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(47, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(48, 'Super Admin has been assigned permission Delete Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(49, 'Admin has been assigned permission Delete Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(50, 'Developer has been assigned permission Delete Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(51, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(52, 'Super Admin has been assigned permission Approved Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(53, 'Admin has been assigned permission Approved Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(54, 'Developer has been assigned permission Approved Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(55, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(56, 'Super Admin has been assigned permission Unapproved Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(57, 'Admin has been assigned permission Unapproved Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(58, 'Developer has been assigned permission Unapproved Code Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(59, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(60, 'Super Admin has been assigned permission Read Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(61, 'Admin has been assigned permission Read Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(62, 'Developer has been assigned permission Read Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(63, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(64, 'Super Admin has been assigned permission Create Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(65, 'Admin has been assigned permission Create Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(66, 'Developer has been assigned permission Create Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(67, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(68, 'Super Admin has been assigned permission Edit Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(69, 'Admin has been assigned permission Edit Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(70, 'Developer has been assigned permission Edit Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(71, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(72, 'Super Admin has been assigned permission Delete Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(73, 'Admin has been assigned permission Delete Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(74, 'Developer has been assigned permission Delete Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(75, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(76, 'Super Admin has been assigned permission Approved Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(77, 'Admin has been assigned permission Approved Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(78, 'Developer has been assigned permission Approved Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(79, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(80, 'Super Admin has been assigned permission Unapproved Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(81, 'Admin has been assigned permission Unapproved Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(82, 'Developer has been assigned permission Unapproved Code Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(83, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(84, 'Super Admin has been assigned permission Read Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(85, 'Admin has been assigned permission Read Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(86, 'Developer has been assigned permission Read Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(87, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(88, 'Super Admin has been assigned permission Create Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(89, 'Admin has been assigned permission Create Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(90, 'Developer has been assigned permission Create Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(91, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(92, 'Super Admin has been assigned permission Edit Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(93, 'Admin has been assigned permission Edit Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(94, 'Developer has been assigned permission Edit Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(95, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(96, 'Super Admin has been assigned permission Delete Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(97, 'Admin has been assigned permission Delete Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(98, 'Developer has been assigned permission Delete Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(99, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(100, 'Super Admin has been assigned permission Approved Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(101, 'Admin has been assigned permission Approved Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(102, 'Developer has been assigned permission Approved Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(103, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(104, 'Super Admin has been assigned permission Unapproved Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(105, 'Admin has been assigned permission Unapproved Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(106, 'Developer has been assigned permission Unapproved Unit Allotment.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(107, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(108, 'Super Admin has been assigned permission Read Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(109, 'Admin has been assigned permission Read Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(110, 'Developer has been assigned permission Read Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(111, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(112, 'Super Admin has been assigned permission Create Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(113, 'Admin has been assigned permission Create Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(114, 'Developer has been assigned permission Create Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(115, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(116, 'Super Admin has been assigned permission Edit Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(117, 'Admin has been assigned permission Edit Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(118, 'Developer has been assigned permission Edit Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(119, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(120, 'Super Admin has been assigned permission Delete Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(121, 'Admin has been assigned permission Delete Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(122, 'Developer has been assigned permission Delete Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(123, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(124, 'Super Admin has been assigned permission Approved Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(125, 'Admin has been assigned permission Approved Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(126, 'Developer has been assigned permission Approved Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(127, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(128, 'Super Admin has been assigned permission Unapproved Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(129, 'Admin has been assigned permission Unapproved Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(130, 'Developer has been assigned permission Unapproved Unit Surrender.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(131, 'Read Unit=create Unit=edit Unit=delete Unit=read Code Allotment=create Code Allotment=edit Code Allotment=delete Code Allotment=approved Code Allotment=unapproved Code Allotment=read Code Surrender=create Code Surrender=edit Code Surrender=delete Code Surrender=approved Code Surrender=unapproved Code Surrender=read Unit Allotment=create Unit Allotment=edit Unit Allotment=delete Unit Allotment=approved Unit Allotment=unapproved Unit Allotment=read Unit Surrender=create Unit Surrender=edit Unit Surrender=delete Unit Surrender=approved Unit Surrender=unapproved Unit Surrender Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(132, 'Super Admin has been assigned permission Edit Setting.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:57:56', '2021-12-24 11:57:56'),
(133, 'Developer has been assigned permission Edit Setting.', 'Assign Permission to Role', 'success', 2, '2021-12-24 11:57:56', '2021-12-24 11:57:56'),
(134, 'Edit Setting Permission has been added successfully.', 'Add Permission', 'success', 2, '2021-12-24 11:57:56', '2021-12-24 11:57:56'),
(135, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ নামে [১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ] কোড নং যুক্ত করেছেন।', 'Add Code', 'success', 2, '2021-12-24 16:51:38', '2021-12-24 16:51:38'),
(136, 'Toukir Ahamed Pigeon ১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩২৩১৩০১-প্রশিক্ষণ নামে [১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩২৩১৩০১-প্রশিক্ষণ] কোড নং যুক্ত করেছেন।', 'Add Code', 'success', 2, '2021-12-24 16:51:53', '2021-12-24 16:51:53'),
(137, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা নামে [১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা] কোড নং যুক্ত করেছেন।', 'Add Code', 'success', 2, '2021-12-24 16:52:05', '2021-12-24 16:52:05'),
(138, 'Toukir Ahamed Pigeon ১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা নামে [১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইনস্টিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা] কোড নং যুক্ত করেছেন।', 'Add Code', 'success', 2, '2021-12-24 16:52:19', '2021-12-24 16:52:19'),
(139, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা নামে [১২২০২০১-১০৫৯৫৪-সদর দপ্তর- ৩২৫৭২০৬-সম্মানী ভাতা] কোড নং পরিবর্তন করেছেন।', 'Edit Code', 'success', 2, '2021-12-24 16:53:41', '2021-12-24 16:53:41'),
(140, 'Toukir Ahamed Pigeon asdad নামে [addasdf] কোড নং যুক্ত করেছেন।', 'Add Code', 'success', 2, '2021-12-24 16:54:09', '2021-12-24 16:54:09'),
(141, 'Toukir Ahamed Pigeon asdad নামে [addasdf] কোড নং ডিলিট করেছেন।', 'Delete Code', 'success', 2, '2021-12-24 16:54:20', '2021-12-24 16:54:20'),
(142, 'Toukir Ahamed Pigeon has Added New Lookup পদবী', 'Add Lookup', 'success', 2, '2021-12-24 17:05:15', '2021-12-24 17:05:15'),
(143, 'Toukir Ahamed Pigeon has Added New Lookup আইজিপি', 'Add Lookup', 'success', 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(144, 'Toukir Ahamed Pigeon has Added New Lookup অতিরিক্ত আইজিপি', 'Add Lookup', 'success', 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(145, 'Toukir Ahamed Pigeon has Added New Lookup ডিআইজি', 'Add Lookup', 'success', 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(146, 'Toukir Ahamed Pigeon has Added New Lookup অতিরিক্ত ডিআইজি', 'Add Lookup', 'success', 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(147, 'Toukir Ahamed Pigeon has Added New Lookup পুলিশ সুপার', 'Add Lookup', 'success', 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(148, 'Toukir Ahamed Pigeon has Added New Lookup অতিরিক্ত পুলিশ সুপার', 'Add Lookup', 'success', 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(149, 'Toukir Ahamed Pigeon এ,এ নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2021-12-25 14:15:51', '2021-12-25 14:15:51'),
(150, 'Toukir Ahamed Pigeon এ,এ নামে প্রাপকের তথ্য পরিবর্তন করেছেন।', 'Edit Recipient', 'success', 2, '2021-12-25 15:29:51', '2021-12-25 15:29:51'),
(151, 'Toukir Ahamed Pigeon এ,এ নামে প্রাপকের তথ্য পরিবর্তন করেছেন।', 'Edit Recipient', 'success', 2, '2021-12-25 15:30:18', '2021-12-25 15:30:18'),
(152, 'Toukir Ahamed Pigeon has Added New Lookup রেঞ্জ/মেট্রো', 'Add Lookup', 'success', 2, '2021-12-25 15:55:56', '2021-12-25 15:55:56'),
(153, 'Toukir Ahamed Pigeon has Added New Lookup ঢাকা রেঞ্জ', 'Add Lookup', 'success', 2, '2021-12-25 15:56:45', '2021-12-25 15:56:45'),
(154, 'Toukir Ahamed Pigeon has Added New Lookup চট্টগ্রাম রেঞ্জ', 'Add Lookup', 'success', 2, '2021-12-25 15:56:45', '2021-12-25 15:56:45'),
(155, 'Toukir Ahamed Pigeon has Added New Lookup রাজশাহী রেঞ্জ', 'Add Lookup', 'success', 2, '2021-12-25 15:56:45', '2021-12-25 15:56:45'),
(156, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2021-12-25 19:09:07', '2021-12-25 19:09:07'),
(157, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2021-12-25 19:38:37', '2021-12-25 19:38:37'),
(158, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2021-12-26 19:15:19', '2021-12-26 19:15:19'),
(159, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2021-12-26 19:20:36', '2021-12-26 19:20:36'),
(160, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2021-12-26 19:20:44', '2021-12-26 19:20:44'),
(161, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Allotment', 'success', 2, '2021-12-26 19:29:18', '2021-12-26 19:29:18'),
(162, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2021-12-26 19:33:06', '2021-12-26 19:33:06'),
(163, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2021-12-26 19:35:26', '2021-12-26 19:35:26'),
(164, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2021-12-26 19:44:21', '2021-12-26 19:44:21'),
(165, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Code Allotment', 'success', 2, '2021-12-27 20:55:12', '2021-12-27 20:55:12'),
(166, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Code Allotment', 'success', 2, '2021-12-27 20:56:33', '2021-12-27 20:56:33'),
(167, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Code Allotment', 'success', 2, '2021-12-27 20:56:47', '2021-12-27 20:56:47'),
(168, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা সমর্পন যুক্ত করেন।', 'Add Code Surrender', 'success', 2, '2021-12-27 20:59:10', '2021-12-27 20:59:10'),
(169, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা পরিমাণে সমর্পণের তথ্য অনুমোদন করেন।', 'Approve Code Surrender', 'success', 2, '2021-12-27 21:01:57', '2021-12-27 21:01:57'),
(170, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা সমর্পন পরিবর্তন করেন।', 'Edit Code Surrender', 'success', 2, '2021-12-27 21:02:11', '2021-12-27 21:02:11'),
(171, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ থেকে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০৮৮.০০ টাকা সমর্পণের তথ্য যুক্ত করেন।', 'Add Unit Surrender', 'success', 2, '2021-12-27 21:03:35', '2021-12-27 21:03:35'),
(172, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ থেকে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০৮৮.০০ টাকা পরিমাণে সমর্পণের তথ্য অনুমোদন করেন।', 'Approve Unit Surrender', 'success', 2, '2021-12-27 21:09:06', '2021-12-27 21:09:06'),
(173, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অননুমোদন করেন।', 'Unapproved Code Allotment', 'success', 2, '2022-01-14 09:25:06', '2022-01-14 09:25:06'),
(174, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2022-01-14 11:00:20', '2022-01-14 11:00:20'),
(175, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অননুমোদন করেন।', 'Unapproved Unit Allotment', 'success', 2, '2022-01-14 11:00:33', '2022-01-14 11:00:33'),
(176, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে সোম, ২৭-ডিসেম্বর-২০২১ ইং তারিখে ১০,০০০.০০ টাকা বরাদ্দের তথ্য ডিলিট করেন।', 'Delete Unit Allotment', 'success', 2, '2022-01-14 11:00:38', '2022-01-14 11:00:38'),
(177, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা সমর্পন পরিবর্তন করেন।', 'Edit Code Surrender', 'success', 2, '2022-01-14 11:01:38', '2022-01-14 11:01:38'),
(178, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা পরিমাণে সমর্পণের তথ্য অননুমোদন করেন।', 'Unapproved Code Surrender', 'success', 2, '2022-01-14 11:01:58', '2022-01-14 11:01:58'),
(179, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০০.০০ টাকা সমর্পনের তথ্য ডিলিট করেন।', 'Delete Code Surrender', 'success', 2, '2022-01-14 11:02:04', '2022-01-14 11:02:04'),
(180, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ থেকে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০৮৮.০০ টাকা সমর্পণের তথ্য অননুমোদন করেন।', 'Unapproved Unit Surrender', 'success', 2, '2022-01-14 11:02:17', '2022-01-14 11:02:17'),
(181, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ থেকে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০৮৮.০০ টাকা সমর্পণের তথ্য ডিলিট করেন।', 'Delete Unit Surrender', 'success', 2, '2022-01-14 11:02:21', '2022-01-14 11:02:21'),
(182, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Code Allotment', 'success', 2, '2022-01-14 11:04:08', '2022-01-14 11:04:08'),
(183, 'Toukir Ahamed Pigeon ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে মঙ্গল, ২৮-ডিসেম্বর-২০২১ ইং তারিখে ১,০০,০০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Code Allotment', 'success', 2, '2022-01-14 11:04:16', '2022-01-14 11:04:16'),
(184, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-01-14 11:05:52', '2022-01-14 11:05:52'),
(185, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-01-14 11:23:24', '2022-01-14 11:23:24'),
(186, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2022-01-14 11:59:54', '2022-01-14 11:59:54'),
(187, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-01-14 12:00:10', '2022-01-14 12:00:10'),
(188, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2022-01-14 12:00:26', '2022-01-14 12:00:26'),
(189, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2022-01-14 12:01:15', '2022-01-14 12:01:15'),
(190, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2022-01-14 12:31:47', '2022-01-14 12:31:47'),
(191, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-01-14 12:33:23', '2022-01-14 12:33:23'),
(192, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অননুমোদন করেন।', 'Unapproved Unit Allotment', 'success', 2, '2022-01-14 14:47:18', '2022-01-14 14:47:18'),
(193, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', 2, '2022-01-14 16:10:26', '2022-01-14 16:10:26'),
(194, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অননুমোদন করেন।', 'Unapproved Unit Allotment', 'success', 2, '2022-01-14 16:52:08', '2022-01-14 16:52:08'),
(195, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-01-14 16:52:11', '2022-01-14 16:52:11'),
(196, 'Super Admin has been assigned permission Edit Master Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10');
INSERT INTO `logs` (`id`, `description`, `action`, `type`, `created_by`, `created_at`, `updated_at`) VALUES
(197, 'Admin has been assigned permission Edit Master Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(198, 'Developer has been assigned permission Edit Master Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(199, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(200, 'Super Admin has been assigned permission Read Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(201, 'Admin has been assigned permission Read Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(202, 'Developer has been assigned permission Read Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(203, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(204, 'Super Admin has been assigned permission Add Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(205, 'Admin has been assigned permission Add Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(206, 'Developer has been assigned permission Add Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(207, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(208, 'Super Admin has been assigned permission Edit Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(209, 'Admin has been assigned permission Edit Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(210, 'Developer has been assigned permission Edit Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(211, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(212, 'Super Admin has been assigned permission Delete Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(213, 'Admin has been assigned permission Delete Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(214, 'Developer has been assigned permission Delete Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(215, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(216, 'Super Admin has been assigned permission Read Sms.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(217, 'Admin has been assigned permission Read Sms.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(218, 'Developer has been assigned permission Read Sms.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(219, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(220, 'Super Admin has been assigned permission Read Mail.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(221, 'Admin has been assigned permission Read Mail.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(222, 'Developer has been assigned permission Read Mail.', 'Assign Permission to Role', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(223, 'Edit Master Allotment Letter=Read Allotment Letter=Add Allotment Letter=Edit Allotment Letter=Delete Allotment Letter=Read SMS=Read Mail Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(224, 'edit-master-allotment-letter Permission has been Edited successfully.', 'Edit Role', 'success', 2, '2022-01-16 14:19:01', '2022-01-16 14:19:01'),
(225, 'Read Sms has been removed from role Admin.', 'Remove Permission from Role', 'danger', 2, '2022-01-16 14:22:15', '2022-01-16 14:22:15'),
(226, 'read-sms Permission has been Edited successfully.', 'Edit Role', 'success', 2, '2022-01-16 14:22:15', '2022-01-16 14:22:15'),
(227, 'Admin has been assigned permission Read Sms.', 'Assign Permission to Role', 'success', 2, '2022-01-16 14:22:20', '2022-01-16 14:22:20'),
(228, 'read-sms Permission has been Edited successfully.', 'Edit Role', 'success', 2, '2022-01-16 14:22:20', '2022-01-16 14:22:20'),
(229, 'create-allotment-letter Permission has been Edited successfully.', 'Edit Role', 'success', 2, '2022-01-16 14:22:26', '2022-01-16 14:22:26'),
(230, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:18:14', '2022-01-24 11:18:14'),
(231, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:19:42', '2022-01-24 11:19:42'),
(232, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:32:57', '2022-01-24 11:32:57'),
(233, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:34:03', '2022-01-24 11:34:03'),
(234, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:35:07', '2022-01-24 11:35:07'),
(235, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:35:31', '2022-01-24 11:35:31'),
(236, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:35:51', '2022-01-24 11:35:51'),
(237, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:37:27', '2022-01-24 11:37:27'),
(238, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:51:16', '2022-01-24 11:51:16'),
(239, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 11:52:12', '2022-01-24 11:52:12'),
(240, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 12:00:37', '2022-01-24 12:00:37'),
(241, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 12:04:25', '2022-01-24 12:04:25'),
(242, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 14:19:55', '2022-01-24 14:19:55'),
(243, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-24 14:41:02', '2022-01-24 14:41:02'),
(244, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-25 14:09:12', '2022-01-25 14:09:12'),
(245, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য যুক্ত করেছেন।', 'Add Allotment Letter', 'success', 2, '2022-01-26 17:36:59', '2022-01-26 17:36:59'),
(246, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-28 11:57:38', '2022-01-28 11:57:38'),
(247, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-28 11:58:16', '2022-01-28 11:58:16'),
(248, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-28 20:31:43', '2022-01-28 20:31:43'),
(249, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 09:24:19', '2022-01-29 09:24:19'),
(250, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:01:42', '2022-01-29 13:01:42'),
(251, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-29 13:01:54', '2022-01-29 13:01:54'),
(252, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-29 13:02:24', '2022-01-29 13:02:24'),
(253, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:02:48', '2022-01-29 13:02:48'),
(254, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-29 13:07:27', '2022-01-29 13:07:27'),
(255, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:07:47', '2022-01-29 13:07:47'),
(256, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:15:32', '2022-01-29 13:15:32'),
(257, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:21:55', '2022-01-29 13:21:55'),
(258, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:45:35', '2022-01-29 13:45:35'),
(259, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 13:55:38', '2022-01-29 13:55:38'),
(260, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 14:28:32', '2022-01-29 14:28:32'),
(261, 'Toukir Ahamed Pigeon সাধারণ বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Master Allotment Letter', 'success', 2, '2022-01-29 14:28:40', '2022-01-29 14:28:40'),
(262, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-01-29 14:31:38', '2022-01-29 14:31:38'),
(263, 'Super Admin has been assigned permission Print Signed Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-29 14:54:11', '2022-01-29 14:54:11'),
(264, 'Developer has been assigned permission Print Signed Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-29 14:54:11', '2022-01-29 14:54:11'),
(265, 'Print Signed Allotment Letter Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-01-29 14:54:11', '2022-01-29 14:54:11'),
(266, 'Print Signed Allotment Letter has been removed from role Developer.', 'Remove Permission from Role', 'danger', 2, '2022-01-29 15:00:50', '2022-01-29 15:00:50'),
(267, 'print-signed-allotment-letter Permission has been Edited successfully.', 'Edit Role', 'success', 2, '2022-01-29 15:00:50', '2022-01-29 15:00:50'),
(268, 'Developer has been assigned permission Print Signed Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-01-29 15:02:07', '2022-01-29 15:02:07'),
(269, 'print-signed-allotment-letter Permission has been Edited successfully.', 'Edit Role', 'success', 2, '2022-01-29 15:02:07', '2022-01-29 15:02:07'),
(270, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-11 17:43:40', '2022-02-11 17:43:40'),
(271, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-11 17:48:12', '2022-02-11 17:48:12'),
(272, 'Toukir Ahamed Pigeon আইজিপি মহোদয়, পুলিশ হেডকোয়ার্টার্স ঢাকা নামে প্রাপকের তথ্য পরিবর্তন করেছেন।', 'Edit Recipient', 'success', 2, '2022-02-11 19:07:59', '2022-02-11 19:07:59'),
(273, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-11 19:19:14', '2022-02-11 19:19:14'),
(274, 'Toukir Ahamed Pigeon ডিআইজি ঢাকা রেঞ্জ নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:21:00', '2022-02-12 08:21:00'),
(275, 'Toukir Ahamed Pigeon পুলিশ সুপার, ঢাকা নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:22:52', '2022-02-12 08:22:52'),
(276, 'Toukir Ahamed Pigeon পুলিশ সুপার, নারায়নগঞ্জ নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:24:19', '2022-02-12 08:24:19'),
(277, 'Toukir Ahamed Pigeon পুলিশ সুপার, নরসিংদী নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:25:33', '2022-02-12 08:25:33'),
(278, 'Toukir Ahamed Pigeon পুলিশ সুপার, গাজীপুর নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:26:19', '2022-02-12 08:26:19'),
(279, 'Toukir Ahamed Pigeon পুলিশ সুপার, মুন্সিগঞ্জ নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:27:31', '2022-02-12 08:27:31'),
(280, 'Toukir Ahamed Pigeon পুলিশ সুপার, মানিকগঞ্জ নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:29:11', '2022-02-12 08:29:11'),
(281, 'Toukir Ahamed Pigeon পুলিশ সুপার, কিশোরগঞ্জ নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:30:08', '2022-02-12 08:30:08'),
(282, 'Toukir Ahamed Pigeon পুলিশ সুপার, টাঙ্গাইল নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:30:59', '2022-02-12 08:30:59'),
(283, 'Toukir Ahamed Pigeon স্টাফ অফিসার টু আইজিপি নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:33:25', '2022-02-12 08:33:25'),
(284, 'Toukir Ahamed Pigeon অতিঃ পুলিশ সুপার (স্টাফ অফিসার টু ডিআইজি) নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', 2, '2022-02-12 08:35:49', '2022-02-12 08:35:49'),
(285, 'Toukir Ahamed Pigeon স্টাফ অফিসার টু আইজিপি নামে প্রাপকের তথ্য পরিবর্তন করেছেন।', 'Edit Recipient', 'success', 2, '2022-02-12 08:36:28', '2022-02-12 08:36:28'),
(286, 'Toukir Ahamed Pigeon has Added New Lookup পুলিশ হেডকোয়ার্টার্স', 'Add Lookup', 'success', 2, '2022-02-12 09:10:47', '2022-02-12 09:10:47'),
(287, 'Toukir Ahamed Pigeon পুলিশ হেডকোয়ার্টার্স নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 09:13:22', '2022-02-12 09:13:22'),
(288, 'Toukir Ahamed Pigeon ঢাকা রেঞ্জ নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:18:30', '2022-02-12 09:18:30'),
(289, 'Toukir Ahamed Pigeon ঢাকা জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:21:17', '2022-02-12 09:21:17'),
(290, 'Toukir Ahamed Pigeon ঢাকা রেঞ্জ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 09:21:52', '2022-02-12 09:21:52'),
(291, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:27:00', '2022-02-12 09:27:00'),
(292, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:31:40', '2022-02-12 09:31:40'),
(293, 'Toukir Ahamed Pigeon নরসিংদী জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:33:10', '2022-02-12 09:33:10'),
(294, 'Toukir Ahamed Pigeon গাজীপুর জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:34:17', '2022-02-12 09:34:17'),
(295, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 09:35:54', '2022-02-12 09:35:54'),
(296, 'Toukir Ahamed Pigeon মানিকগঞ্জ জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 10:03:32', '2022-02-12 10:03:32'),
(297, 'Toukir Ahamed Pigeon কিশোরগঞ্জ জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 10:05:05', '2022-02-12 10:05:05'),
(298, 'Toukir Ahamed Pigeon টাংগাইল জেলা নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', 2, '2022-02-12 10:06:49', '2022-02-12 10:06:49'),
(299, 'Toukir Ahamed Pigeon কিশোরগঞ্জ জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 10:07:22', '2022-02-12 10:07:22'),
(300, 'Toukir Ahamed Pigeon পুলিশ হেডকোয়ার্টার্স তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শুক্র, ১৪-জানুয়ারি-২০২২ ইং তারিখে ১,০০,০০,০০০.০০ টাকা বরাদ্দের তথ্য ডিলিট করেন।', 'Delete Unit Allotment', 'success', 2, '2022-02-12 13:17:30', '2022-02-12 13:17:30'),
(301, 'Toukir Ahamed Pigeon ঢাকা জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:20:17', '2022-02-12 13:20:17'),
(302, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:20:44', '2022-02-12 13:20:44'),
(303, 'Toukir Ahamed Pigeon নরসিংদী জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:21:38', '2022-02-12 13:21:38'),
(304, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা নামে ইউনিটের তথ্য ডিলিট করেছেন।', 'Delete Unit', 'success', 2, '2022-02-12 13:22:49', '2022-02-12 13:22:49'),
(305, 'Toukir Ahamed Pigeon গাজীপুর জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৭৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:25:35', '2022-02-12 13:25:35'),
(306, 'Toukir Ahamed Pigeon গাজীপুর জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:26:58', '2022-02-12 13:26:58'),
(307, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:27:26', '2022-02-12 13:27:26'),
(308, 'Toukir Ahamed Pigeon মানিকগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:27:44', '2022-02-12 13:27:44'),
(309, 'Toukir Ahamed Pigeon কিশোরগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ১,৭৬,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:28:33', '2022-02-12 13:28:33'),
(310, 'Toukir Ahamed Pigeon টাংগাইল জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ১,৩২,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:28:57', '2022-02-12 13:28:57'),
(311, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৭০,০০০.০০ টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', 2, '2022-02-12 13:31:23', '2022-02-12 13:31:23'),
(312, 'Toukir Ahamed Pigeon ঢাকা জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:47:47', '2022-02-12 13:47:47'),
(313, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:47:50', '2022-02-12 13:47:50'),
(314, 'Toukir Ahamed Pigeon নরসিংদী জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:52:11', '2022-02-12 13:52:11'),
(315, 'Toukir Ahamed Pigeon গাজীপুর জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৭৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:25', '2022-02-12 13:57:25'),
(316, 'Toukir Ahamed Pigeon গাজীপুর জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:28', '2022-02-12 13:57:28'),
(317, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:31', '2022-02-12 13:57:31'),
(318, 'Toukir Ahamed Pigeon মানিকগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৪৪,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:34', '2022-02-12 13:57:34'),
(319, 'Toukir Ahamed Pigeon কিশোরগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ১,৭৬,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:37', '2022-02-12 13:57:37'),
(320, 'Toukir Ahamed Pigeon টাংগাইল জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ১,৩২,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:41', '2022-02-12 13:57:41'),
(321, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা তে ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ কোডে শনি, ১২-ফেব্রুয়ারি-২০২২ ইং তারিখে ৭০,০০০.০০ টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', 2, '2022-02-12 13:57:44', '2022-02-12 13:57:44'),
(322, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য যুক্ত করেছেন।', 'Add Allotment Letter', 'success', 2, '2022-02-12 14:25:01', '2022-02-12 14:25:01'),
(323, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-02-12 14:52:31', '2022-02-12 14:52:31'),
(324, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-02-12 15:15:36', '2022-02-12 15:15:36'),
(325, 'Super Admin has been assigned permission Sign Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-02-12 15:24:49', '2022-02-12 15:24:49'),
(326, 'Developer has been assigned permission Sign Allotment Letter.', 'Assign Permission to Role', 'success', 2, '2022-02-12 15:24:49', '2022-02-12 15:24:49'),
(327, 'Sign Allotment Letter Permission has been added successfully.', 'Add Permission', 'success', 2, '2022-02-12 15:24:49', '2022-02-12 15:24:49'),
(328, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-02-12 15:46:38', '2022-02-12 15:46:38'),
(329, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-02-12 15:48:48', '2022-02-12 15:48:48'),
(330, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-02-12 15:48:59', '2022-02-12 15:48:59'),
(331, 'Toukir Ahamed Pigeon বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', 2, '2022-02-12 15:49:26', '2022-02-12 15:49:26'),
(332, 'Toukir Ahamed Pigeon ঢাকা রেঞ্জ পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:28:29', '2022-02-12 16:28:29'),
(333, 'Toukir Ahamed Pigeon ঢাকা জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:29:02', '2022-02-12 16:29:02'),
(334, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:29:21', '2022-02-12 16:29:21'),
(335, 'Toukir Ahamed Pigeon নরসিংদী জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:29:54', '2022-02-12 16:29:54'),
(336, 'Toukir Ahamed Pigeon গাজীপুর জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:29:58', '2022-02-12 16:29:58'),
(337, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:30:03', '2022-02-12 16:30:03'),
(338, 'Toukir Ahamed Pigeon মানিকগঞ্জ জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:30:08', '2022-02-12 16:30:08'),
(339, 'Toukir Ahamed Pigeon কিশোরগঞ্জ জেলা নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:30:35', '2022-02-12 16:30:35'),
(340, 'Toukir Ahamed Pigeon টাংগাইল জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:30:54', '2022-02-12 16:30:54'),
(341, 'Toukir Ahamed Pigeon কিশোরগঞ্জ জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:31:14', '2022-02-12 16:31:14'),
(342, 'Toukir Ahamed Pigeon মানিকগঞ্জ জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:31:19', '2022-02-12 16:31:19'),
(343, 'Toukir Ahamed Pigeon মুন্সীগঞ্জ জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:31:23', '2022-02-12 16:31:23'),
(344, 'Toukir Ahamed Pigeon গাজীপুর জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:31:27', '2022-02-12 16:31:27'),
(345, 'Toukir Ahamed Pigeon নরসিংদী জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:31:31', '2022-02-12 16:31:31'),
(346, 'Toukir Ahamed Pigeon নারায়নগঞ্জ জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:32:01', '2022-02-12 16:32:01'),
(347, 'Toukir Ahamed Pigeon ঢাকা জেলা পুলিশ নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', 2, '2022-02-12 16:32:05', '2022-02-12 16:32:05'),
(348, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-12 16:35:28', '2022-02-12 16:35:28'),
(349, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-12 16:51:27', '2022-02-12 16:51:27'),
(350, '[Toukir Ahamed Pigeon]\'s Role [Developer] has been Removed.', 'Remove User Role', 'danger', 2, '2022-02-13 04:30:52', '2022-02-13 04:30:52'),
(351, '[Toukir Ahamed Pigeon] has been assigned to new Role as [Developer] User.', 'Assign User Role', 'success', 2, '2022-02-13 04:30:52', '2022-02-13 04:30:52'),
(352, '[Toukir Ahamed Pigeon] has Edited his Profile.', 'Edit Profile', 'success', 2, '2022-02-13 04:30:52', '2022-02-13 04:30:52'),
(353, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-13 04:37:57', '2022-02-13 04:37:57'),
(354, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-14 05:49:56', '2022-02-14 05:49:56'),
(355, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-14 07:16:19', '2022-02-14 07:16:19'),
(356, 'Toukir Ahamed Pigeon সেটিংস পরিবর্তন করেছেন।', 'Edit Setting', 'success', 2, '2022-02-14 07:31:11', '2022-02-14 07:31:11'),
(357, '[Toukir Ahamed Pigeon]\'s Role [Developer] has been Removed.', 'Remove User Role', 'danger', 2, '2022-02-14 18:38:36', '2022-02-14 18:38:36'),
(358, '[Toukir Ahamed Pigeon] has been assigned to new Role as [Developer] User.', 'Assign User Role', 'success', 2, '2022-02-14 18:38:36', '2022-02-14 18:38:36'),
(359, '[Toukir Ahamed Pigeon] has Edited his Profile.', 'Edit Profile', 'success', 2, '2022-02-14 18:38:36', '2022-02-14 18:38:36'),
(360, '[Toukir Ahamed Pigeon]\'s Role [Developer] has been Removed.', 'Remove User Role', 'danger', 2, '2022-02-16 17:25:11', '2022-02-16 17:25:11'),
(361, '[Toukir Ahamed Pigeon] has been assigned to new Role as [Developer] User.', 'Assign User Role', 'success', 2, '2022-02-16 17:25:11', '2022-02-16 17:25:11'),
(362, '[Toukir Ahamed Pigeon] has Edited his Profile.', 'Edit Profile', 'success', 2, '2022-02-16 17:25:11', '2022-02-16 17:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE `lookups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookups`
--

INSERT INTO `lookups` (`id`, `parent_id`, `name`, `description`, `priority`, `status`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'পদবী', 'পদবী', 0, 1, 2, '2021-12-24 17:05:15', '2021-12-24 17:05:15'),
(2, 1, 'আইজিপি', NULL, 0, 1, 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(3, 1, 'অতিরিক্ত আইজিপি', NULL, 0, 1, 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(4, 1, 'ডিআইজি', NULL, 0, 1, 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(5, 1, 'অতিরিক্ত ডিআইজি', NULL, 0, 1, 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(6, 1, 'পুলিশ সুপার', NULL, 0, 1, 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(7, 1, 'অতিরিক্ত পুলিশ সুপার', NULL, 0, 1, 2, '2021-12-24 17:09:31', '2021-12-24 17:09:31'),
(8, 0, 'রেঞ্জ/মেট্রো', NULL, 0, 1, 2, '2021-12-25 15:55:56', '2021-12-25 15:55:56'),
(9, 8, 'ঢাকা রেঞ্জ', NULL, 0, 1, 2, '2021-12-25 15:56:45', '2021-12-25 15:56:45'),
(10, 8, 'চট্টগ্রাম রেঞ্জ', NULL, 0, 1, 2, '2021-12-25 15:56:45', '2021-12-25 15:56:45'),
(11, 8, 'রাজশাহী রেঞ্জ', NULL, 0, 1, 2, '2021-12-25 15:56:45', '2021-12-25 15:56:45'),
(12, 8, 'পুলিশ হেডকোয়ার্টার্স', 'পুলিশ হেডকোয়ার্টার্স', 0, 1, 2, '2022-02-12 09:10:47', '2022-02-12 09:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `master_allotment_letters`
--

CREATE TABLE `master_allotment_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_left_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_middle_heading` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_right_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_first_part` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_header_memo_first_part_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_image_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_info_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letter_to` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letter_acknowledgement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_allotment_letters`
--

INSERT INTO `master_allotment_letters` (`id`, `header_left_logo`, `header_middle_heading`, `header_right_logo`, `sub_header_memo_first_part`, `subject`, `reference`, `description`, `instructions`, `signature_image`, `signature_info`, `sub_header_memo_first_part_2`, `signature_image_2`, `signature_info_2`, `letter_to`, `letter_acknowledgement`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'header_left_logo_20220124_1643023977.jpg', '<div style=\"text-align:center\">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার<br />\r\nবাংলাদেশ পুলিশ<br />\r\nপুলিশ হেডকোয়ার্টার্স, ঢাকা<br />\r\nট্রেনিং-১ শাখা<br />\r\nwww.police.gov.bd</div>', 'header_right_logo_20220124_1643024151.png', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-', '<div style=\"text-align:justify\"><strong>বিষয়ঃ&nbsp;২০২১-২২ অর্থ বছরের প্রশিক্ষণের সম্মানী ভাতা বাবদ অর্থ বরাদ্দ প্রসঙ্গে।</strong></div>', NULL, '<div style=\"text-align:justify\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; উপর্যুক্ত বিষয়ের প্রেক্ষিতে সদয় অবগতির জন্য জানানো যাচ্ছে যে, ২০/১১/২০২১খ্রি। হতে অনুষ্ঠিতব্য পদমর্যাদা ভিত্তিক নিম্নোক্ত প্রশিক্ষণ কোর্সের <strong>সম্মানী ভাতা</strong> বাবদ ব্যয় নির্বাহের জন্য চলতি ২০২১-২২ অর্থ বছরের বাংলাদেশ পুলিশ বাজেটের <strong>১২২০২১৩-০০০০০০-পুলিশ ট্রেনিং ইন্সটিটিউটসমূহ-৩১১১৩৩২-সম্মানী ভাতা</strong>❜&nbsp;খাত হতে ছকে উল্লেখিত অর্থ আদিষ্ট হয়ে আপনার অনুকূলে বরাদ্দ প্রদান করা হলো।</div>', '<ul style=\"list-style-type:square\">\r\n	<li style=\"text-align:justify\">আর্থিক বরাদ্দকৃত অর্থ Delegation of Financial Powers 2020 এবং যথাযথ ভাবে আর্থিক বিধি-বিধান পরিপালন সাপেক্ষে ব্যয়যোগ্য।</li>\r\n	<li style=\"text-align:justify\">প্রধান হিসাব রক্ষণ কর্মকর্তার কার্যালয়ে হিসাব পাঠানোর নিমিত্ত বাজেট শাখায় প্রদানের লক্ষ্যে উপর্যুক্ত ব্যয়ের হিসাব পরবর্তি মাসের ৫ (পাঁচ) তারিখের মধ্যে স্থানীয় হিসাব রক্ষণ অফিস কর্তৃপক্ষের প্রতিসাক্ষরের কপিসহ হিসাব বিবরণী ট্রেনিং শাখায় প্রেরণ করার জন্য অনুরোধ করা হল।</li>\r\n	<li style=\"text-align:justify\">অব্যয়িত অর্থ যথাসময়ে সমর্পণ করার জন্যও অনুরোধ করা হলো।</li>\r\n</ul>', NULL, '<div style=\"text-align:center\">(মিয়া মাসুদ করিম)<br />\r\nবিপি-৭২০১০৮৯৩৭৪<br />\r\nএ্যাডিশনাল ডিআইজি (ট্রেনিং-১)<br />\r\nবাংলাদেশ পুলিশ<br />\r\nফোন নং-০২২৩৩৮৪৭৭৫<br />\r\nE-mail: <u>aigtrg@police.gov.bd</u></div>', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-', NULL, '<div style=\"text-align:center\">(মিয়া মাসুদ করিম)<br />\r\nবিপি-৭২০১০৮৯৩৭৪<br />\r\nএ্যাডিশনাল ডিআইজি (ট্রেনিং-১)<br />\r\nবাংলাদেশ পুলিশ<br />\r\nফোন নং-০২২৩৩৮৪৭৭৫<br />\r\nE-mail: <u>aigtrg@police.gov.bd</u></div>', '<u><strong>বিতরণঃ (জেষ্ঠ্যতার ভিত্তিতে নয়)</strong></u><br />\r\n১। রেক্টর, পুলিশ স্টাফ কলেজ বাংলাদেশ, ঢাকা।<br />\r\n২। প্রিন্সিপ্যাল, বাংলাদেশ&nbsp; পুলিশ একাডেমী, সারদা, রাজশাহী।', '<u><strong>অনুলিপি সদয় জ্ঞাতার্থে ও কার্যার্থেঃ</strong></u>&nbsp;<strong>(জেষ্ঠতার ভিত্তিতে নয়)</strong><br />\r\n১। প্রধান হিসাব রক্ষণ কর্মকর্তা, জননিরাপত্তা বিভাগ, স্বরাষ্ট্র মন্ত্রণালয়, সিজিএ ভবন, সেগুনবাগিচা, ঢাকা।<br />\r\n২। অতিরিক্ত ডিআইজি (ফিন্যান্স), বাংলাদেশ পুলিশ, পুলিশ হেডকোয়ার্টার্স, ঢাকা [সদয় অনুমোদনের জন্য]।', 2, '2022-01-16 11:29:34', '2022-01-29 13:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_04_16_081558_create_permission_tables', 1),
(10, '2020_04_16_195157_create_user_details_table', 2),
(11, '2019_08_02_214654_create_logs_table', 3),
(12, '2019_08_04_001852_create_notifications_table', 3),
(13, '2019_08_06_204306_create_lookups_table', 3),
(14, '2020_05_14_195130_create_user_tables_combinations_table', 5),
(15, '2021_12_24_100023_create_codes_table', 6),
(16, '2021_12_24_100119_create_recipients_table', 6),
(17, '2021_12_24_100139_create_units_table', 6),
(18, '2021_12_24_100252_create_code_allotments_table', 6),
(19, '2021_12_24_100311_create_code_surrenders_table', 6),
(20, '2021_12_24_100334_create_unit_allotments_table', 6),
(21, '2021_12_24_100350_create_unit_surrenders_table', 6),
(22, '2021_12_24_100423_create_settings_table', 6),
(23, '2022_01_15_151222_create_master_allotment_letters_table', 7),
(24, '2022_01_15_151402_create_allotment_letters_table', 7),
(25, '2022_01_15_151510_create_letter_allotment_transactions_table', 7),
(26, '2022_01_15_151545_create_emails_table', 7),
(27, '2022_01_15_151629_create_s_m_s_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\User', 1),
(4, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `send_other_devices` int(11) NOT NULL,
  `created_for` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('003ae20e255601a6cb9297be8a6b238d467f4755afdaf652233f1f8f9f397c09a7732f1eb5df5a6a', 1, 1, 'authToken', '[]', 0, '2020-05-08 00:37:12', '2020-05-08 00:37:12', '2021-05-08 06:37:12'),
('0df013390b9ba2ba7eb46064ce9445cb8752656ea06532ff0eea9b8d511053b416966ec204835046', 1, 1, 'authToken', '[]', 0, '2020-04-25 21:59:10', '2020-04-25 21:59:10', '2021-04-26 03:59:10'),
('105c57502a543826448469c9705029dcda50808e315b6f460876c0acb970917aa445133e4289f5f6', 2, 1, 'authToken', '[]', 0, '2020-04-27 01:27:37', '2020-04-27 01:27:37', '2021-04-27 07:27:37'),
('13de4ae3e6c4c35abb7e48b3cdd93a897ad3cfbae9672c5657f8b9fc62edc9908136f027c097455f', 1, 1, 'authToken', '[]', 0, '2020-04-25 21:23:13', '2020-04-25 21:23:13', '2021-04-26 03:23:13'),
('180be91b04978019e82d6979da5166b12657e3cb25fdc347e69193cae9c84456bbbefa09ab24778b', 1, 1, 'authToken', '[]', 0, '2020-04-18 18:08:56', '2020-04-18 18:08:56', '2021-04-19 00:08:56'),
('26d24e1f8a96a3be8a0b87bf9086bf68680e6f33ed6d2d3a205bbdeea634394445f5f3fed1176849', 1, 1, 'authToken', '[]', 0, '2020-04-30 05:45:46', '2020-04-30 05:45:46', '2021-04-30 11:45:46'),
('3808744a59392b99a2ec1801f75ebd3e9bd2d368ac430201bea8c5a263436582d351d4ccc87ec56a', 1, 1, 'authToken', '[]', 0, '2020-05-08 21:24:21', '2020-05-08 21:24:21', '2021-05-09 03:24:21'),
('39e8629d6d7020bf2a333eddf5a54438112f23d80cb728104db85bf47695f091132d6b03fb4aea6b', 2, 1, 'authToken', '[]', 0, '2020-04-27 18:43:45', '2020-04-27 18:43:45', '2021-04-28 00:43:45'),
('41220c0b76116a06ae5451e3d770180b3a2c575013f4f99a7dadc208aea3f7dbe4c459a19a062a4a', 1, 1, 'authToken', '[]', 0, '2020-04-19 06:14:41', '2020-04-19 06:14:41', '2021-04-19 12:14:41'),
('553e452a7ba11147e3e62cc98b57bab15fcaed1cd11f26454e634726cf29e17b353d7a0f60e89d19', 2, 1, 'authToken', '[]', 0, '2020-04-27 00:22:33', '2020-04-27 00:22:33', '2021-04-27 06:22:33'),
('596b9cb1d50549b40a7405d42fd89d4ce4e5dcbc8241246160592340301155f82538d46b4b6b5a21', 3, 1, 'authToken', '[]', 0, '2020-05-05 02:57:53', '2020-05-05 02:57:53', '2021-05-05 08:57:53'),
('5b0e5c780005380083eb2fa0c72046e9e75bfac080f6f57ddf5a00117b32a895f1e05aac40876e27', 1, 1, 'authToken', '[]', 0, '2020-04-17 19:31:21', '2020-04-17 19:31:21', '2021-04-18 01:31:21'),
('5e20a6bf75d214c8b3cf2d3b2048d22a63bb8d9fddf33bc2683296b8aef89323e00db07dadb3dcce', 1, 1, 'authToken', '[]', 0, '2020-05-01 00:41:55', '2020-05-01 00:41:55', '2021-05-01 06:41:55'),
('64fe62d9efc7738746492a5059b926f351049ee750b6f0c165a195a31d37967e6c77710ad0a129ad', 1, 1, 'authToken', '[]', 0, '2020-05-01 14:58:08', '2020-05-01 14:58:08', '2021-05-01 20:58:08'),
('66849a7470d85c307e85a7094d913e28d7737ed21a4722f25f983ab8d4c6150d1a5d6f56bd2f9923', 1, 1, 'authToken', '[]', 0, '2020-04-27 00:52:29', '2020-04-27 00:52:29', '2021-04-27 06:52:29'),
('66d6abb242e694420bc16810e734b19e57e6b1c40ef33b97adcfd9f5dfb06b57f966b7bf1a299687', 1, 1, 'authToken', '[]', 0, '2020-04-18 11:10:04', '2020-04-18 11:10:04', '2021-04-18 17:10:04'),
('7a1e08fcda1aa591939ab58e658ebb8d7bfdba380d2fbe8a617846fcc79b86ceca16f99fe4359548', 1, 1, 'authToken', '[]', 0, '2020-05-12 23:40:39', '2020-05-12 23:40:39', '2021-05-13 05:40:39'),
('862714a951a25744eaa38645213cd1f008d06807b5a16b49a09c77e63d5ed1efb874e3cf602c7ee1', 1, 1, 'authToken', '[]', 0, '2020-04-17 20:17:01', '2020-04-17 20:17:01', '2021-04-18 02:17:01'),
('867c1f1519e35ed62c64ffd1efd1778ceec9333f4b65c32920a876937058c69bf09c888ff275430a', 1, 1, 'authToken', '[]', 0, '2020-04-17 19:44:04', '2020-04-17 19:44:04', '2021-04-18 01:44:04'),
('86d128204ed79f729c28605ab477570f39ed02035c5c59ea1f3dda8dc2a0bb3d6fb0dd638aebe7ef', 1, 1, 'authToken', '[]', 0, '2020-05-05 01:29:59', '2020-05-05 01:29:59', '2021-05-05 07:29:59'),
('8a611990ae73977aba60796aa82c44d6aa2c4df5d8786bbe5b150d571777eae79cacc3125246e8a5', 1, 1, 'authToken', '[]', 0, '2020-04-19 22:08:19', '2020-04-19 22:08:19', '2021-04-20 04:08:19'),
('932fd755cdc0c66ad24de82fd2961ff23e4c3f47826509052a19bb7760d26d9d3b0ddec142587781', 1, 1, 'authToken', '[]', 0, '2020-04-18 07:28:06', '2020-04-18 07:28:06', '2021-04-18 13:28:06'),
('93597ceb17bb02f5fe5a3696e9a29b2fbdda78a463b0a5c09758e16c36edee9bc2f6f831f8a52c25', 1, 1, 'authToken', '[]', 0, '2020-05-07 14:37:24', '2020-05-07 14:37:24', '2021-05-07 20:37:24'),
('9988377fbce0da2e3908b448dffef4a1a28df93f317978f8f324ca09425f09fec2e8790f841762e8', 1, 1, 'authToken', '[]', 0, '2020-04-18 05:25:45', '2020-04-18 05:25:45', '2021-04-18 11:25:45'),
('9becbe3b9b8b4c39df2c9ddd66f5429c5a100bc2100180c67cdce22e692b7b7760a7f5f8e06ca7f6', 1, 1, 'authToken', '[]', 0, '2020-05-05 02:29:37', '2020-05-05 02:29:37', '2021-05-05 08:29:37'),
('9bf1f60296f66205fb56c91fb0fa7fe0c044a93044cc6b4737724cb357305114fdc6c8a28115fb79', 1, 1, 'authToken', '[]', 0, '2020-04-27 19:25:48', '2020-04-27 19:25:48', '2021-04-28 01:25:48'),
('a20f34f9ca701d3693348d0137c369421f82f562d2d3806b4027f4c480dd447d6dbc171f27cca70d', 1, 1, 'authToken', '[]', 0, '2020-04-29 02:35:49', '2020-04-29 02:35:49', '2021-04-29 08:35:49'),
('ad0dafb730e6c0b91aa907470d8ab93a5ec1ea0190fd18988d9f580777155503cb2226b0a1f2f608', 1, 1, 'authToken', '[]', 0, '2020-04-17 19:42:40', '2020-04-17 19:42:40', '2021-04-18 01:42:40'),
('b58ad4b492e1edf0687e58a63a3c90775585d65214bf2f493e2a741e57923c7f5e92a6d4460f83c3', 1, 1, 'authToken', '[]', 0, '2020-04-30 14:47:00', '2020-04-30 14:47:00', '2021-04-30 20:47:00'),
('b6125bc39cb972d30ff0e73cd651f58e925f3634b0162e8322221075635197ebc48f2dfe199f1b4c', 1, 1, 'authToken', '[]', 0, '2020-04-27 01:38:23', '2020-04-27 01:38:23', '2021-04-27 07:38:23'),
('b909dd80e32180bcb2d3b01d816034ec9dde7a8f75ca988e93986fe8799802be5c4b5580bf29deb2', 7, 1, 'authToken', '[]', 0, '2020-04-19 22:08:01', '2020-04-19 22:08:01', '2021-04-20 04:08:01'),
('c3c748e71d44bdccaab6ccbec661db15a538cbf417f848e946df5b234e6131026cd34c5ab54f453f', 1, 1, 'authToken', '[]', 0, '2020-05-08 00:40:49', '2020-05-08 00:40:49', '2021-05-08 06:40:49'),
('c6e6b865bb3145db803af91d43f3492858d7736024f708c96f7dbe2c6255fffa006e7d5480035ad8', 1, 1, 'authToken', '[]', 0, '2020-04-27 12:32:02', '2020-04-27 12:32:02', '2021-04-27 18:32:02'),
('ca2eaf0b9b53f50142ecd8a44067d0236d4f2e1919b4a35d34f56c69f56bb686e66478a27b51cc04', 1, 1, 'authToken', '[]', 0, '2020-04-20 08:00:24', '2020-04-20 08:00:24', '2021-04-20 14:00:24'),
('cfb8dad2539dbcc308966d28d3cf1ea20fe30852cbd36ab5dac89bd6cc21db5d9375c0067a5a72d4', 1, 1, 'authToken', '[]', 0, '2020-05-01 00:34:43', '2020-05-01 00:34:43', '2021-05-01 06:34:43'),
('d0bb9792c831261101a18d536b3acf64e18070aeb034956872e10f48f49f10a573f1b4d4f2e26daf', 3, 1, 'authToken', '[]', 0, '2020-04-27 19:22:59', '2020-04-27 19:22:59', '2021-04-28 01:22:59'),
('d3e6aa8e1256e03902ecca161e7f4ba48f8db77f37cb4451b654abd85b45bc3a8f3679dd0668cf9d', 1, 1, 'authToken', '[]', 0, '2020-05-08 21:56:52', '2020-05-08 21:56:52', '2021-05-09 03:56:52'),
('d50049a4f4a690810be232177b496ab4dfb212e372e586100902e8fcece7d04d6eca914d36c3d71d', 1, 1, 'authToken', '[]', 0, '2020-04-19 10:38:26', '2020-04-19 10:38:26', '2021-04-19 16:38:26'),
('d783adcbd0d07de17013e19de418187a54b9e1f1858cd62380ea6e09263b08214e4ed63bb4e1ede7', 3, 1, 'authToken', '[]', 0, '2020-04-27 19:24:34', '2020-04-27 19:24:34', '2021-04-28 01:24:34'),
('dcc3ec4dd67ff8c10a396ebfede3a435555f1a0056261248f352edfa8b2c9a6e0fcf4fa101d944c7', 3, 1, 'authToken', '[]', 0, '2020-05-08 21:56:19', '2020-05-08 21:56:19', '2021-05-09 03:56:19'),
('e18d9f6d8e52bbe9c542452d56e6cdc2da19a3dcd06f6f16e6f375c9fa81f43c00a08b7f55ecf68d', 1, 1, 'authToken', '[]', 0, '2020-04-28 22:51:39', '2020-04-28 22:51:39', '2021-04-29 04:51:39'),
('e8f0b897cd1bc695536d2722e28699820d07bf2643a5442f078ac79ece0b2355a0da9fd8ed405425', 1, 1, 'authToken', '[]', 0, '2020-04-26 21:06:01', '2020-04-26 21:06:01', '2021-04-27 03:06:01'),
('ece93b63c5090d2b8c42f6d5162cf49583b478f45c20f6c14a46d0f8637c1dc06898235631b6dff1', 1, 1, 'authToken', '[]', 0, '2020-04-27 19:08:07', '2020-04-27 19:08:07', '2021-04-28 01:08:07'),
('fe084bf5fe66049a566800759d080845f8ea7e7ed42fbd9c2e3070c402a30dc4c2af3572a5c18b20', 1, 1, 'authToken', '[]', 0, '2020-04-30 23:05:55', '2020-04-30 23:05:55', '2021-05-01 05:05:55'),
('fff2c3b174b6f66447a075538280b7da93692aaf12688ecd6969b6dcdd0f1ab6debb5de7a8a109bc', 1, 1, 'authToken', '[]', 0, '2020-04-26 13:02:09', '2020-04-26 13:02:09', '2021-04-26 19:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'pigeon', 'up2aJJiu29CCcorFAWUf8CjxqObxLEw0UTqNlHW1', 'http://localhost', 1, 0, 0, '2020-04-17 19:27:45', '2020-04-17 19:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-04-17 19:27:45', '2020-04-17 19:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'read-dashboard', 'web', '2020-04-16 14:10:56', '2020-04-16 14:10:56'),
(2, 'read-user', 'web', '2020-04-17 11:59:20', '2020-04-17 11:59:20'),
(3, 'edit-role', 'web', '2020-04-19 06:22:41', '2020-04-19 06:22:41'),
(4, 'edit-profile', 'web', '2020-04-19 13:20:04', '2020-04-19 13:20:04'),
(5, 'create-permission', 'web', '2020-04-25 21:34:37', '2020-04-25 21:34:37'),
(6, 'read-permission', 'web', '2020-04-25 22:08:01', '2020-04-25 22:08:01'),
(7, 'edit-permission', 'web', '2020-04-25 22:11:25', '2020-04-25 22:11:25'),
(8, 'delete-permission', 'web', '2020-04-25 22:11:38', '2020-04-25 22:11:38'),
(9, 'create-role', 'web', '2020-04-25 22:12:11', '2020-04-25 22:12:11'),
(10, 'read-role', 'web', '2020-04-25 22:12:24', '2020-04-25 22:12:24'),
(11, 'delete-role', 'web', '2020-04-25 22:12:46', '2020-04-25 22:12:46'),
(12, 'edit-user-role', 'web', '2020-04-25 22:14:12', '2020-04-25 22:14:12'),
(13, 'assign-user-permission', 'web', '2020-04-25 22:25:36', '2020-04-25 22:25:36'),
(14, 'delete-user-permission', 'web', '2020-04-25 22:27:29', '2020-04-25 22:27:29'),
(15, 'assign-role-permission', 'web', '2020-04-25 22:28:59', '2020-04-25 22:28:59'),
(16, 'delete-role-permission', 'web', '2020-04-25 22:29:47', '2020-04-25 22:29:47'),
(17, 'read-role-permission', 'web', '2020-04-25 22:31:54', '2020-04-25 22:31:54'),
(18, 'read-user-permission', 'web', '2020-04-25 22:32:06', '2020-04-25 22:32:06'),
(19, 'register-user', 'web', '2020-04-26 23:29:09', '2020-04-26 23:29:09'),
(20, 'read-log', 'web', '2020-04-29 02:49:08', '2020-04-29 02:49:08'),
(21, 'read-all-user-log', 'web', '2020-04-29 02:51:47', '2020-04-29 02:51:47'),
(22, 'read-user-tables-combination', 'web', '2020-05-14 22:28:49', '2020-05-14 22:28:49'),
(23, 'read-lookup', 'web', '2020-10-02 12:49:02', '2020-10-02 12:49:02'),
(24, 'create-lookup', 'web', '2020-10-02 12:49:40', '2020-10-02 12:49:40'),
(25, 'edit-lookup', 'web', '2020-10-02 12:50:00', '2020-10-02 12:50:00'),
(26, 'delete-lookup', 'web', '2020-10-02 12:53:05', '2020-10-02 12:53:05'),
(27, 'change-password', 'web', '2020-10-02 17:47:43', '2020-10-02 17:47:43'),
(43, 'backup', 'web', '2020-11-16 14:06:33', '2020-11-16 14:06:33'),
(48, 'read-code', 'web', '2021-11-27 08:42:05', '2021-11-27 08:42:05'),
(49, 'create-code', 'web', '2021-11-27 08:42:06', '2021-11-27 08:42:06'),
(50, 'edit-code', 'web', '2021-11-27 08:42:06', '2021-11-27 08:42:06'),
(51, 'delete-code', 'web', '2021-11-27 08:42:06', '2021-11-27 08:42:06'),
(52, 'read-recipient', 'web', '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(53, 'create-recipient', 'web', '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(54, 'edit-recipient', 'web', '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(55, 'delete-recipient', 'web', '2021-12-24 11:41:07', '2021-12-24 11:41:07'),
(56, 'read-unit', 'web', '2021-12-24 11:49:54', '2021-12-24 11:49:54'),
(57, 'create-unit', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(58, 'edit-unit', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(59, 'delete-unit', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(60, 'read-code-allotment', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(61, 'create-code-allotment', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(62, 'edit-code-allotment', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(63, 'delete-code-allotment', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(64, 'approved-code-allotment', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(65, 'unapproved-code-allotment', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(66, 'read-code-surrender', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(67, 'create-code-surrender', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(68, 'edit-code-surrender', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(69, 'delete-code-surrender', 'web', '2021-12-24 11:49:55', '2021-12-24 11:49:55'),
(70, 'approved-code-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(71, 'unapproved-code-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(72, 'read-unit-allotment', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(73, 'create-unit-allotment', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(74, 'edit-unit-allotment', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(75, 'delete-unit-allotment', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(76, 'approved-unit-allotment', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(77, 'unapproved-unit-allotment', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(78, 'read-unit-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(79, 'create-unit-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(80, 'edit-unit-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(81, 'delete-unit-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(82, 'approved-unit-surrender', 'web', '2021-12-24 11:49:56', '2021-12-24 11:49:56'),
(83, 'unapproved-unit-surrender', 'web', '2021-12-24 11:49:57', '2021-12-24 11:49:57'),
(84, 'edit-setting', 'web', '2021-12-24 11:57:56', '2021-12-24 11:57:56'),
(85, 'edit-master-allotment-letter', 'web', '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(86, 'read-allotment-letter', 'web', '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(87, 'create-allotment-letter', 'web', '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(88, 'edit-allotment-letter', 'web', '2022-01-16 10:17:10', '2022-01-16 10:17:10'),
(89, 'delete-allotment-letter', 'web', '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(90, 'read-sms', 'web', '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(91, 'read-mail', 'web', '2022-01-16 10:17:11', '2022-01-16 10:17:11'),
(92, 'print-signed-allotment-letter', 'web', '2022-01-29 14:54:11', '2022-01-29 14:54:11'),
(93, 'sign-allotment-letter', 'web', '2022-02-12 15:24:49', '2022-02-12 15:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `recipients`
--

CREATE TABLE `recipients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bangla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_id` int(11) NOT NULL COMMENT 'lookups',
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipients`
--

INSERT INTO `recipients` (`id`, `name`, `name_bangla`, `letter_name`, `email`, `mobile`, `designation_id`, `priority`, `status`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'IGP', 'আইজিপি', 'আইজিপি মহোদয়, পুলিশ হেডকোয়ার্টার্স ঢাকা', 'ig@police.gov.bd', '01320005000', 2, 0, 1, NULL, 2, 2, '2021-12-25 14:15:51', '2022-02-11 19:07:59'),
(2, 'DIG Dhaka Range', 'ডিআইজি ঢাকা রেঞ্জ', 'ডিআইজি ঢাকা রেঞ্জ', 'digdhaka@police.gov.bd', '0132008900', 4, 0, 1, NULL, 2, 2, '2022-02-12 08:21:00', '2022-02-12 08:21:00'),
(3, 'Superintendent of Police, Dhaka', 'পুলিশ সুপার, ঢাকা', 'পুলিশ সুপার, ঢাকা', 'spdhaka@police.gov.bd', '01320089300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:22:52', '2022-02-12 08:22:52'),
(4, 'Superintendent of Police, Narayanganj', 'পুলিশ সুপার, নারায়নগঞ্জ', 'পুলিশ সুপার, নারায়নগঞ্জ', 'spnarayanganj@police.gov.bd', '01320090300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:24:19', '2022-02-12 08:24:19'),
(5, 'Superintendent of Police, Narsingdi', 'পুলিশ সুপার, নরসিংদী', 'পুলিশ সুপার, নরসিংদী', 'spnarsingdi@police.gov.bd', '01320091300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:25:33', '2022-02-12 08:25:33'),
(6, 'Superintendent of Police, Gazipur', 'পুলিশ সুপার, গাজীপুর', 'পুলিশ সুপার, গাজীপুর', 'spgazipur@police.gov.bd', '01320092300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:26:19', '2022-02-12 08:26:19'),
(7, 'Superintendent of Police, Munshigonj', 'পুলিশ সুপার, মুন্সিগঞ্জ', 'পুলিশ সুপার, মুন্সিগঞ্জ', 'spmunshigonj@police.gov.bd', '013203300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:27:31', '2022-02-12 08:27:31'),
(8, 'Superintendent of Police, Manikgonj', 'পুলিশ সুপার, মানিকগঞ্জ', 'পুলিশ সুপার, মানিকগঞ্জ', 'spmanikgonj@police.gov.bd', '01320094300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:29:11', '2022-02-12 08:29:11'),
(9, 'Superintendent of Police, Kishorgonj', 'পুলিশ সুপার, কিশোরগঞ্জ', 'পুলিশ সুপার, কিশোরগঞ্জ', 'spkishorgonj@police.gov.bd', '01320095300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:30:08', '2022-02-12 08:30:08'),
(10, 'Superintendent of Police, Tangail', 'পুলিশ সুপার, টাঙ্গাইল', 'পুলিশ সুপার, টাঙ্গাইল', 'sptangail@police.gov.bd', '01320096300', 6, 0, 1, NULL, 2, 2, '2022-02-12 08:30:59', '2022-02-12 08:30:59'),
(11, 'Staff Officer to IGP', 'স্টাফ অফিসার টু আইজিপি', 'স্টাফ অফিসার টু আইজিপি', 'soig@police.gov.bd', '01320000400', 7, 0, 1, NULL, 2, 2, '2022-02-12 08:33:25', '2022-02-12 08:36:28'),
(12, 'Additional Superintendent of Police (Staff Officer to DIG)', 'অতিঃ পুলিশ সুপার (স্টাফ অফিসার টু ডিআইজি)', 'অতিঃ পুলিশ সুপার (স্টাফ অফিসার টু ডিআইজি)', NULL, '01320089032', 7, 0, 1, NULL, 2, 2, '2022-02-12 08:35:49', '2022-02-12 08:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `level`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', 1, '2020-04-16 14:10:56', '2020-04-16 14:10:56'),
(2, 'temporary', 'web', 5000, '2020-04-16 14:12:36', '2020-04-16 14:12:36'),
(3, 'admin', 'web', 2, '2020-04-27 00:21:36', '2020-04-27 00:21:36'),
(4, 'developer', 'web', 1, '2020-04-27 19:13:02', '2020-04-27 19:15:38'),
(5, 'member', 'web', 4, '2020-11-13 11:26:11', '2020-11-13 11:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 4),
(4, 1),
(4, 3),
(4, 4),
(4, 5),
(5, 4),
(6, 1),
(6, 3),
(6, 4),
(7, 1),
(7, 4),
(8, 4),
(9, 1),
(9, 4),
(10, 1),
(10, 3),
(10, 4),
(11, 4),
(12, 1),
(12, 3),
(12, 4),
(13, 1),
(13, 3),
(13, 4),
(14, 1),
(14, 3),
(14, 4),
(15, 1),
(15, 4),
(16, 1),
(16, 4),
(17, 1),
(17, 3),
(17, 4),
(18, 1),
(18, 3),
(18, 4),
(19, 1),
(19, 3),
(19, 4),
(20, 1),
(20, 3),
(20, 4),
(20, 5),
(21, 1),
(21, 4),
(22, 1),
(22, 3),
(22, 4),
(23, 1),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 1),
(27, 2),
(27, 3),
(27, 4),
(27, 5),
(43, 1),
(43, 4),
(48, 1),
(48, 3),
(48, 4),
(49, 1),
(49, 3),
(49, 4),
(50, 1),
(50, 3),
(50, 4),
(51, 1),
(51, 3),
(51, 4),
(52, 1),
(52, 3),
(52, 4),
(53, 1),
(53, 3),
(53, 4),
(54, 1),
(54, 3),
(54, 4),
(55, 1),
(55, 3),
(55, 4),
(56, 1),
(56, 3),
(56, 4),
(57, 1),
(57, 3),
(57, 4),
(58, 1),
(58, 3),
(58, 4),
(59, 1),
(59, 3),
(59, 4),
(60, 1),
(60, 3),
(60, 4),
(61, 1),
(61, 3),
(61, 4),
(62, 1),
(62, 3),
(62, 4),
(63, 1),
(63, 3),
(63, 4),
(64, 1),
(64, 3),
(64, 4),
(65, 1),
(65, 3),
(65, 4),
(66, 1),
(66, 3),
(66, 4),
(67, 1),
(67, 3),
(67, 4),
(68, 1),
(68, 3),
(68, 4),
(69, 1),
(69, 3),
(69, 4),
(70, 1),
(70, 3),
(70, 4),
(71, 1),
(71, 3),
(71, 4),
(72, 1),
(72, 3),
(72, 4),
(73, 1),
(73, 3),
(73, 4),
(74, 1),
(74, 3),
(74, 4),
(75, 1),
(75, 3),
(75, 4),
(76, 1),
(76, 3),
(76, 4),
(77, 1),
(77, 3),
(77, 4),
(78, 1),
(78, 3),
(78, 4),
(79, 1),
(79, 3),
(79, 4),
(80, 1),
(80, 3),
(80, 4),
(81, 1),
(81, 3),
(81, 4),
(82, 1),
(82, 3),
(82, 4),
(83, 1),
(83, 3),
(83, 4),
(84, 1),
(84, 4),
(85, 1),
(85, 3),
(85, 4),
(86, 1),
(86, 3),
(86, 4),
(87, 1),
(87, 3),
(87, 4),
(88, 1),
(88, 3),
(88, 4),
(89, 1),
(89, 3),
(89, 4),
(90, 1),
(90, 3),
(90, 4),
(91, 1),
(91, 3),
(91, 4),
(92, 1),
(92, 4),
(93, 1),
(93, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `software_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_mail_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allotment_letter_mail_subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allotment_letter_mail_format` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_sms_cost` double DEFAULT 0,
  `sms_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_sender_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allotment_letter_sms_format` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `software_mode`, `from_mail_title`, `allotment_letter_mail_subject`, `allotment_letter_mail_format`, `per_sms_cost`, `sms_company`, `sms_sender_id`, `sms_api`, `allotment_letter_sms_format`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'development', 'AIG Training-1', 'ট্রেনিং-১ শাখা থেকে পুলিশের প্রশিক্ষণের ব্যয় নির্বাহের জন্য বরাদ্দ প্রসংগে।', '<div style=\"text-align:justify\">[[memo_date]] তারিখে [[memo]] স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে [[course_name]] এর ব্যয় নির্বাহের জন্য [[fiscal_year]] অর্থবছরে বাংলাদেশ পুলিশ বাজেটের [[code]] খাতে [[unit_name]] এর জন্য [[amount]] টাকা বরাদ্দ করা হয়েছে।</div>', 0.25, 'Elitbuzz', '8804445629107', 'C20039515d26e5ed866570.74430102', '[[memo_date]] তারিখে [[memo]] স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে [[course_name]] এর ব্যয় নির্বাহের জন্য [[fiscal_year]] অর্থবছরে বাংলাদেশ পুলিশ বাজেটের [[code]] খাতে [[unit_name]] এর জন্য [[amount]] টাকা বরাদ্দ করা হয়েছে।', 2, '2022-02-11 17:42:42', '2022-02-14 07:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `s_m_s`
--

CREATE TABLE `s_m_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sms_bulk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_count` double DEFAULT NULL,
  `per_sms_charge` double DEFAULT NULL,
  `total_charge` double DEFAULT NULL,
  `related_model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_model_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s_m_s`
--

INSERT INTO `s_m_s` (`id`, `sms_bulk`, `sender_id`, `to_number`, `content`, `sms_count`, `per_sms_charge`, `total_charge`, `related_model_type`, `related_model_id`, `status`, `status_code`, `status_message`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 9, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 06:55:01', '2022-02-14 06:55:01'),
(2, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 6, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 06:55:01', '2022-02-14 06:55:01'),
(3, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 4, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 06:55:01', '2022-02-14 06:55:01'),
(4, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 8, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 06:55:01', '2022-02-14 06:55:01'),
(5, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 5, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 06:55:01', '2022-02-14 06:55:01'),
(6, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0, 0, 'unit_allotment', 7, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 06:55:01', '2022-02-14 06:55:01'),
(7, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 8, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:01:47', '2022-02-14 07:01:47'),
(8, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 4, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:01:47', '2022-02-14 07:01:47'),
(9, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 6, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:01:47', '2022-02-14 07:01:47'),
(10, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 5, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:01:47', '2022-02-14 07:01:47'),
(11, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0, 0, 'unit_allotment', 7, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:01:47', '2022-02-14 07:01:47'),
(12, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 9, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:01:47', '2022-02-14 07:01:47'),
(13, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 6, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:03:11', '2022-02-14 07:03:11'),
(14, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 8, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:03:11', '2022-02-14 07:03:11'),
(15, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0, 0, 'unit_allotment', 7, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:03:11', '2022-02-14 07:03:11'),
(16, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 4, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:03:11', '2022-02-14 07:03:11'),
(17, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 5, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:03:11', '2022-02-14 07:03:11'),
(18, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 9, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:03:11', '2022-02-14 07:03:11'),
(19, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 5, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:12:17', '2022-02-14 07:12:17'),
(20, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 8, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:12:17', '2022-02-14 07:12:17'),
(21, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 9, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:12:17', '2022-02-14 07:12:17'),
(22, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 4, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:12:17', '2022-02-14 07:12:17'),
(23, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0, 0, 'unit_allotment', 7, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:12:17', '2022-02-14 07:12:17'),
(24, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 6, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:12:17', '2022-02-14 07:12:17'),
(25, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 5, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:13:20', '2022-02-14 07:13:20'),
(26, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0, 0, 'unit_allotment', 7, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:13:20', '2022-02-14 07:13:20'),
(27, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 6, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:13:20', '2022-02-14 07:13:20'),
(28, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 4, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:13:20', '2022-02-14 07:13:20'),
(29, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 8, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:13:20', '2022-02-14 07:13:20'),
(30, 'Elitbuzz', '8809601000500', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0, 0, 'unit_allotment', 9, 'danger', '1007', '1007: Insufficient balance in SMS Bulk Account.', 2, 2, '2022-02-14 07:13:20', '2022-02-14 07:13:20'),
(31, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 9, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a01d6477ff', 'success', 2, 2, '2022-02-14 07:16:38', '2022-02-14 07:16:38'),
(32, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 5, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a01d64b03f', 'success', 2, 2, '2022-02-14 07:16:38', '2022-02-14 07:16:38'),
(33, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 6, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a01d64dcf5', 'success', 2, 2, '2022-02-14 07:16:38', '2022-02-14 07:16:38'),
(34, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 4, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a01d65044b', 'success', 2, 2, '2022-02-14 07:16:38', '2022-02-14 07:16:38'),
(35, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 8, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a01d65438a', 'success', 2, 2, '2022-02-14 07:16:38', '2022-02-14 07:16:38'),
(36, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0.25, 1.75, 'unit_allotment', 7, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a01d657b45', 'success', 2, 2, '2022-02-14 07:16:38', '2022-02-14 07:16:38'),
(37, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 6, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a0cac15a75', 'success', 2, 2, '2022-02-14 19:02:52', '2022-02-14 19:02:52'),
(38, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 8, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a0cac51acb', 'success', 2, 2, '2022-02-14 19:02:52', '2022-02-14 19:02:52'),
(39, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0.25, 1.75, 'unit_allotment', 7, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a0cac5725f', 'success', 2, 2, '2022-02-14 19:02:52', '2022-02-14 19:02:52'),
(40, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 4, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a0cac57e9f', 'success', 2, 2, '2022-02-14 19:02:52', '2022-02-14 19:02:52'),
(41, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 5, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a0cac587cc', 'success', 2, 2, '2022-02-14 19:02:52', '2022-02-14 19:02:52'),
(42, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 9, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620a0cac5aa27', 'success', 2, 2, '2022-02-14 19:02:52', '2022-02-14 19:02:52'),
(43, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 4, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d598f3ba0f', 'success', 2, 2, '2022-02-16 20:07:40', '2022-02-16 20:07:40'),
(44, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 9, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d598f3c927', 'success', 2, 2, '2022-02-16 20:07:40', '2022-02-16 20:07:40'),
(45, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0.25, 1.75, 'unit_allotment', 7, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d598f3c6ea', 'success', 2, 2, '2022-02-16 20:07:40', '2022-02-16 20:07:40'),
(46, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 8, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d598f429d6', 'success', 2, 2, '2022-02-16 20:07:40', '2022-02-16 20:07:40'),
(47, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 6, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d598f4296c', 'success', 2, 2, '2022-02-16 20:07:40', '2022-02-16 20:07:40'),
(48, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 5, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d598f790b8', 'success', 2, 2, '2022-02-16 20:07:41', '2022-02-16 20:07:41'),
(49, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে ঢাকা জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 4, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d5aa7beab5', 'success', 2, 2, '2022-02-16 20:12:21', '2022-02-16 20:12:21'),
(50, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নারায়নগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 5, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d5aa7cea4e', 'success', 2, 2, '2022-02-16 20:12:21', '2022-02-16 20:12:21'),
(51, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৭৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 7, 0.25, 1.75, 'unit_allotment', 7, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d5aa7d70ba', 'success', 2, 2, '2022-02-16 20:12:21', '2022-02-16 20:12:21'),
(52, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে গাজীপুর জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 8, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d5aa7de619', 'success', 2, 2, '2022-02-16 20:12:21', '2022-02-16 20:12:21'),
(53, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে নরসিংদী জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 6, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d5aa808ce3', 'success', 2, 2, '2022-02-16 20:12:21', '2022-02-16 20:12:21'),
(54, 'Elitbuzz', '8804445629107', '01754479709', '১২ ফেব্রুয়ারি ২০২২ খ্রিঃ তারিখে ৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০ স্মারকে একটি পত্রের মাধ্যমে ট্রেনিং-১ শাখা, পুলিশ হেডকোয়ার্টার্স থেকে নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স এর ব্যয় নির্বাহের জন্য ২০২১-২০২২ অর্থবছরে বাংলাদেশ পুলিশ বাজেটের ১২২০২০১-১০৫৯৫৪-সদর দপ্তর-৩২৩১৩০১-প্রশিক্ষণ খাতে মুন্সীগঞ্জ জেলা পুলিশ এর জন্য ৪৪,০০০.০০ টাকা বরাদ্দ করা হয়েছে।', 6, 0.25, 1.5, 'unit_allotment', 9, 'success', 'SMS SUBMITTED: ID - bw-rdC2003951620d5aa80affa', 'success', 2, 2, '2022-02-16 20:12:21', '2022-02-16 20:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bangla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_unit_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'lookups',
  `institution_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ddo_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_head_id` int(11) NOT NULL COMMENT 'recipients',
  `for_attention_id` int(11) DEFAULT NULL COMMENT 'recipients',
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `name_bangla`, `parent_unit_id`, `institution_code`, `office_id`, `ddo_id`, `unit_head_id`, `for_attention_id`, `priority`, `status`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Police Head Quarters', 'পুলিশ হেডকোয়ার্টার্স', '12', '১২২০২০১-সদর দপ্তর, বাংলাদেশ পুলিশ', '১০৫৯৫৪', NULL, 1, 11, 0, 1, NULL, 2, 2, '2021-12-25 19:09:07', '2022-02-12 09:13:22'),
(2, 'Dhaka Range Police', 'ঢাকা রেঞ্জ পুলিশ', '9', '১২২০২০২-রেঞ্জ পুলিশ', '১০৫৯৫৭', '০২৫২৬৮৪', 2, 12, 0, 1, NULL, 2, 2, '2022-02-12 09:18:30', '2022-02-12 16:28:29'),
(3, 'Dhaka District Police', 'ঢাকা জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১০', '০২৩৮১৫৮', 3, NULL, 0, 1, NULL, 2, 2, '2022-02-12 09:21:17', '2022-02-12 16:32:05'),
(4, 'Narayanganj District Police', 'নারায়নগঞ্জ জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১৮', '০১৯৬২৯৭', 4, NULL, 0, 1, NULL, 2, 2, '2022-02-12 09:27:00', '2022-02-12 16:32:01'),
(6, 'Narsingdi District Police', 'নরসিংদী জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১৯', '০০৭৬০৬৪', 5, NULL, 0, 1, NULL, 2, 2, '2022-02-12 09:33:10', '2022-02-12 16:31:31'),
(7, 'Gazipur District Police', 'গাজীপুর জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১২', '০০২৯০১৫', 6, NULL, 0, 1, NULL, 2, 2, '2022-02-12 09:34:17', '2022-02-12 16:31:27'),
(8, 'Munsigonj District Police', 'মুন্সীগঞ্জ জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১৭', '০০৭৩৮৪২', 7, NULL, 0, 1, NULL, 2, 2, '2022-02-12 09:35:54', '2022-02-12 16:31:23'),
(9, 'Manikgonj District Police', 'মানিকগঞ্জ জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১৬', '০১৬৮০৭৪', 8, NULL, 0, 1, NULL, 2, 2, '2022-02-12 10:03:32', '2022-02-12 16:31:19'),
(10, 'Kishorgonj District Police', 'কিশোরগঞ্জ জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১১৪', '০০৮৩৯৭৩', 9, NULL, 0, 1, NULL, 2, 2, '2022-02-12 10:05:05', '2022-02-12 16:31:14'),
(11, 'Tangail District Police', 'টাংগাইল জেলা পুলিশ', '9', '১২২০২২০-জেলা পুলিশ', '১০৬১২২', '০১০৯১৯৩', 10, NULL, 0, 1, NULL, 2, 2, '2022-02-12 10:06:49', '2022-02-12 16:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `unit_allotments`
--

CREATE TABLE `unit_allotments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_id` int(11) NOT NULL COMMENT 'codes',
  `unit_id` int(11) NOT NULL COMMENT 'units',
  `allocation_sector` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `fiscal_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memo_date` date DEFAULT NULL,
  `demand_memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demand_memo_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=unapproved, 1=approved',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_count` int(11) DEFAULT 0,
  `sms_count` int(11) DEFAULT 0,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_allotments`
--

INSERT INTO `unit_allotments` (`id`, `code_id`, `unit_id`, `allocation_sector`, `amount`, `fiscal_year`, `transaction_date`, `memo`, `memo_date`, `demand_memo`, `demand_memo_date`, `status`, `description`, `mail_count`, `sms_count`, `approved_at`, `approved_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'কন্সটেবল ট্রেনিং', 100000, '2021-2022', '2022-01-14', '', '2022-01-28', 'sdsd', '2022-01-14', 1, 'sdsds', 0, 0, '2022-01-14 22:52:11', 2, 2, 2, '2022-01-14 11:05:52', '2022-01-29 14:31:38'),
(4, 1, 3, 'নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স', 44000, '2021-2022', '2022-02-12', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০', '2022-02-12', NULL, NULL, 1, NULL, 0, 4, '2022-02-12 19:47:47', 2, 2, 2, '2022-02-12 13:20:17', '2022-02-16 20:12:21'),
(5, 1, 4, 'নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স', 44000, '2021-2022', '2022-02-12', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০', '2022-02-12', NULL, NULL, 1, NULL, 0, 4, '2022-02-12 19:47:50', 2, 2, 2, '2022-02-12 13:20:44', '2022-02-16 20:12:21'),
(6, 1, 6, 'নায়েক/কনস্টেবল দক্ষতা উন্নয়ন কোর্স', 44000, '2021-2022', '2022-02-12', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০', '2022-02-12', NULL, NULL, 1, NULL, 0, 4, '2022-02-12 19:52:11', 2, 2, 2, '2022-02-12 13:21:38', '2022-02-16 20:12:21'),
(7, 1, 7, 'সার্জেন্ট / টিএসআই রোড সেইফটি এন্ড ট্রাফিক ম্যানেজমেন্ট কোর্স', 74000, '2021-2022', '2022-02-12', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০', '2022-02-12', NULL, NULL, 1, NULL, 0, 4, '2022-02-12 19:57:25', 2, 2, 2, '2022-02-12 13:25:35', '2022-02-16 20:12:21'),
(8, 1, 7, 'নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স', 44000, '2021-2022', '2022-02-12', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০', '2022-02-12', NULL, NULL, 1, NULL, 0, 4, '2022-02-12 19:57:28', 2, 2, 2, '2022-02-12 13:26:58', '2022-02-16 20:12:21'),
(9, 1, 8, 'নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স', 44000, '2021-2022', '2022-02-12', '৪৪.০১.০০০০.৩০৩.২০.০০৮.২১-৫০০', '2022-02-12', NULL, NULL, 1, NULL, 0, 4, '2022-02-12 19:57:31', 2, 2, 2, '2022-02-12 13:27:26', '2022-02-16 20:12:21'),
(10, 1, 9, 'নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স', 44000, '2021-2022', '2022-02-12', NULL, NULL, NULL, NULL, 1, NULL, 0, 0, '2022-02-12 19:57:34', 2, 2, 2, '2022-02-12 13:27:44', '2022-02-12 13:57:34'),
(11, 1, 10, 'নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স', 176000, '2021-2022', '2022-02-12', NULL, NULL, NULL, NULL, 1, NULL, 0, 0, '2022-02-12 19:57:37', 2, 2, 2, '2022-02-12 13:28:33', '2022-02-12 13:57:37'),
(12, 1, 11, 'নায়েক / কন্সটেবল দক্ষতা উন্নয়ন কোর্স', 132000, '2021-2022', '2022-02-12', NULL, NULL, NULL, NULL, 1, NULL, 0, 0, '2022-02-12 19:57:41', 2, 2, 2, '2022-02-12 13:28:57', '2022-02-12 13:57:41'),
(13, 1, 8, 'এসআই (নিঃ) রিফ্রেসার কোর্স', 70000, '2021-2022', '2022-02-12', NULL, NULL, NULL, NULL, 1, NULL, 0, 0, '2022-02-12 19:57:44', 2, 2, 2, '2022-02-12 13:31:23', '2022-02-12 13:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `unit_surrenders`
--

CREATE TABLE `unit_surrenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_id` int(11) NOT NULL COMMENT 'codes',
  `unit_id` int(11) NOT NULL COMMENT 'units',
  `amount` double NOT NULL DEFAULT 0,
  `fiscal_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `surrender_memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surrender_memo_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=unapproved, 1=approved',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decrypted_password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `decrypted_password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rony Mondal', 'rony', 'ronymondal@gmail.com', NULL, '$2y$10$NFsrLqXwGbHX71mxZBd4BOWx15RFsCPcmGMpd.Z958SHkWrUvPccS', '12345678', NULL, '2021-05-07 22:10:45', '2021-05-07 22:10:45'),
(2, 'Toukir Ahamed Pigeon', 'pigeon', 'toukir.ahamed.pigeon@gmail.com', NULL, '$2y$10$XlSEkhQJvBRC4X64ZaIFKeU7Hy3CEbAWFO.geBX3D7xL8XAkdIXO6', '12345678', NULL, '2021-11-27 01:42:46', '2021-11-27 01:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT 0 COMMENT '1=male, 2=Female, 3=others',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `dob`, `gender`, `phone`, `address`, `picture`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, NULL, NULL, 'rony_mondal_1636225063.jpg', 1, 1, '2021-05-07 22:10:45', '2021-11-06 18:57:43'),
(2, NULL, 2, NULL, NULL, 'toukir_ahamed_pigeon_1645032311.jpg', 1, 2, '2021-11-27 01:42:46', '2022-02-16 17:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_tables_combinations`
--

CREATE TABLE `user_tables_combinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `combination` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tables_combinations`
--

INSERT INTO `user_tables_combinations` (`id`, `user_id`, `route_name`, `table_id`, `combination`, `created_at`, `updated_at`) VALUES
(1, 1, 'settings.user.index', 'userTable', '0,1,2,3,4,6,7,8,5', '2020-05-15 20:07:05', '2020-11-17 15:09:36'),
(2, 1, 'settings.role.index', 'roleTable', '0,1,2,4,5,6', '2020-05-20 20:00:26', '2020-05-20 20:25:39'),
(3, 1, 'settings.permission.index', 'permissionTable', '0,1,2,3,4,5', '2020-05-20 20:36:05', '2020-05-21 06:44:48'),
(4, 1, 'settings.log.index', 'logTable', '0,1,2,3,4', '2020-05-21 06:53:01', '2020-05-21 06:53:28'),
(5, 1, 'settings.lookup.index', 'lookupTable', '0,1,2,3,4,5,6,7', '2020-10-02 17:07:18', '2020-10-02 17:08:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allotment_letters`
--
ALTER TABLE `allotment_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code_allotments`
--
ALTER TABLE `code_allotments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code_surrenders`
--
ALTER TABLE `code_surrenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookups`
--
ALTER TABLE `lookups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_allotment_letters`
--
ALTER TABLE `master_allotment_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_m_s`
--
ALTER TABLE `s_m_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_allotments`
--
ALTER TABLE `unit_allotments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_surrenders`
--
ALTER TABLE `unit_surrenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_tables_combinations`
--
ALTER TABLE `user_tables_combinations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allotment_letters`
--
ALTER TABLE `allotment_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `code_allotments`
--
ALTER TABLE `code_allotments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `code_surrenders`
--
ALTER TABLE `code_surrenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `lookups`
--
ALTER TABLE `lookups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_allotment_letters`
--
ALTER TABLE `master_allotment_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `s_m_s`
--
ALTER TABLE `s_m_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `unit_allotments`
--
ALTER TABLE `unit_allotments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit_surrenders`
--
ALTER TABLE `unit_surrenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_tables_combinations`
--
ALTER TABLE `user_tables_combinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
