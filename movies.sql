-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2025 at 03:36 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prime_cinemas`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cast` text COLLATE utf8mb4_unicode_ci,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int NOT NULL,
  `release_date` date NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_movie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('now_showing','kids_special','book_early','coming_soon') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'coming_soon',
  `rating` enum('U','P12','13','16','18','TBA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TBA',
  `is_top_famous` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `cast`, `director`, `subtitles`, `duration`, `release_date`, `language`, `genre`, `poster`, `bg_movie`, `trailer_url`, `status`, `rating`, `is_top_famous`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'NE ZHA 2 哪吒之魔童闹海', 'After the heavenly lightning, although Ne Zha and Ao Bing survived by becoming Spirits, they would soon dissipate completely. Taiyi plans to rebuild Ne Zha and Ao Bing’s mortal bodies with the Seven-colored Precious Lotus. However, during the process of reconstruction, numerous obstacles arise. What will become of the fate of Ne Zha and Ao Bing?\r\n\r\n电影概述及剧情简介： 本片总票房超过10亿美元，成为全球最高票房的非好莱坞电影、最高票房的动画电影，并成功登榜全球影史票房前十名！ 在天劫之后，哪吒及敖丙的灵魂虽然保住，但肉身很快就会魂飞魄散。太乙真人只能用七色宝莲给二人重塑肉身，但过程中却遭遇重重困难。申公豹放出被囚禁深海的四龙王，东海龙王敖光表示“我若出战，就让陈塘关鸡犬不留”，哪吒为了守卫陈塘关将与四海龙王大打出手。\r\n\r\nNe Zha 2 is not applicable to any promotions, discounts, free lists, vouchers, concession rates, bundle deals including but not limited to credit card promotions, corporate rates, senior citizen rates, student rates, children rates etc, throughout the full period of exhibition run, as indicated by film owner and film distributor.\r\n \r\nClassification P12: This film category is suitable for viewers of all ages. Parental guidance is advised for viewers under the age of 12.\r\nKlasifikasi P12: Kategori filem ini adalah sesuai untuk penonton di semua peringkat umur. Bimbingan ibu bapa/penjaga digalakkan untuk penonton di bawah umur 12 tahun.', 'Joseph 囧森瑟夫, Han Mo 韩沫, Chen Hao 陈浩, Lü Yanting 呂晏庭', 'Jiaozi 饺子 (Yang Yu 杨宇)', 'Bahasa Melayu, Chinese, English', 144, '2025-03-13', 'Mandarin', 'Animation, Action, Drama', 'm10.jpg', 'bg_m1.jpg', 'https://www.youtube.com/embed/axIa5sTi9B4?si=GnzuE7a5Vd5uwqLp', 'now_showing', 'P12', 1, 1, NULL, NULL),
(2, 'MICKEY 17', 'Mickey 17 is an \"expendable\", a disposable employee on a human expedition sent to colonise the ice world Niflheim. After one iteration of Mickey dies, a new body is regenerated with most of his memories intact.', 'Robert Pattinson, Steven Yeun, Naomi Ackie, Toni Collette, Mark Ruffalo', 'Bong Joon-ho', 'Bahasa Melayu, Chinese', 139, '2025-03-06', 'English', 'Adventure, Science Fiction', 'm7.jpg', NULL, 'https://www.youtube.com/embed/osYpGSz_0i4?si=U3zrywsQu-PRMGGx', 'now_showing', '18', 1, 1, '2025-03-12 14:35:48', NULL),
(3, 'LEGENDS OF THE CONDOR HEROES: THE GALLANTS 射雕英雄传：侠之大者', '恩怨情仇的江湖，权势角力的战乱时代，郭靖（肖战饰）童年离别家乡，逐渐炼就可改变局面和命运的庞大力量。虽受高人赏识和器重，得传天下绝世武功 “九阴真经”和“降龙十八掌”，却惹来各方嫉忌，成为众矢之的。\r\n \r\n郭靖，不亢不卑，怀赤子之心，与黄蓉（庄达菲 饰）在铁骑箭雨和硝烟旌旗中，力挽狂澜，保护南宋边关。\r\n \r\n雕海苍穹，勇者无惧，侠之大者，力拔山河，成就武林传说。\r\n \r\n本片主要改编自金庸同名原著第34至40章。\r\n \r\nThe film is adapted from Mr. Jin Yong\'s classic martial arts work \"The Legend of the Condor Heroes\". It tells the story of the world of grievances and hatred in the war-torn era of power struggle. Guo Jing (played by Xiao Zhan) left his hometown and acquired huge power of martial arts to change destiny. Although he was valued by Kung Fu Masters and who passed down the world\'s peerless martial arts \"Nine Yin Manual\" and \"Eighteen Dragon Subduing Palms\", jealousy towards him was formed from all parties where he became the target of public criticism. Guo Jing and Huang Rong (played by Zhuang Dafei) turned the tide and protected the Southern Song Dynasty border amidst the rain of arrows with the spirit of gallants.', 'Xiao Zhan 肖战, Zhuang Dafei 庄达菲, Leung Ka Fai Tony 梁家辉, Zhang Wenxin 张文昕, Bayaertu 巴雅尔图, Alan 阿如那, Ada Choi 蔡少芬', 'Tsui Hark 徐克', 'English, Bahasa Melayu, Chinese', 146, '2025-02-20', 'Mandarin', 'Action, Adventure', 'm2.jpg', NULL, NULL, 'now_showing', 'P12', 1, 1, '2025-03-12 14:48:18', NULL),
(4, 'CLOSE UR KOPITIAM 关你茶室', '你家宝贝 Ah Boy Ah Girl 一定会超喜欢！马来西亚知名 YouTuber 低清首部电影强势登场！并有新加坡“搞笑天王”李国煌助阵！通过“茶室”和“网络暴力”两个看似不相关的主题，探讨背后的深层社会问题。让你笑中带泪，重新审视网络暴力的影响。这部贺岁喜剧，诚意满满！\r\n\r\nAh Biao inherits his mother\'s Kopitiam and runs it with his wife, Yuriko. The business once thrived, but Ah Biao\'s management style and unconventional marketing strategies led to an unexpected crisis that put Kopitiam in unprecedented danger. After a conflict with a popular influencer, Kopitiam becomes embroiled in a media storm, causing the business to plummet. Just as Ah Biao and Yuriko work tirelessly to turn things around, they face the threat of repossession. Will they manage to overcome this crisis and protect their family business? How will their marriage and the Kopitiam fare in the face of adversity?', 'Song Bill 丧彪, Yuriko, DaHee 大Hee, Anthony Ng, Adeline Wong, Zuvia, Yuniyce, Michie, Lam, Klay K佬, Kim Chen Wu, Morn Liew, Mark Lee 李国煌, Jaspers Lai 赖宇涵', 'Vince Chong', 'English, Bahasa Melayu, Chinese', 105, '2025-01-29', 'Mandarin', 'Drama, Comedy', 'm3.jpg', NULL, NULL, 'now_showing', '13', 0, 1, '2025-03-12 14:53:08', NULL),
(5, 'IN THE LOST LANDS', 'A sorceress travels to the Lost Lands in search of a magical power that allows a person to transform into a werewolf.', 'Milla Jovovich, Dave Bautista, Arly Jover', 'Paul W.S. Anderson', 'Bahasa Melayu, Chinese', 101, '2025-03-06', 'English', 'Action, Fantasy, Adventure', 'm5.jpg', NULL, NULL, 'now_showing', '16', 0, 1, '2025-03-12 14:55:37', NULL),
(6, 'MOBILE SUIT GUNDAM GQUUUUUUX -BEGINNING-', 'In a war between Zeon and Earth Federation, a stolen prototype Gundam vanishes. Years later, a girl with mysterious abilities finds herself piloting a new Gundam in underground mech battles while searching for answers about her powers.', 'Tomoyo Kurosawa, Yui Ishikawa, Shimba Tsuchiya', 'Kazuya Tsurumaki', 'Bahasa Melayu, English, Chinese', 81, '2025-02-27', 'Japanese', 'Anime', 'm6.jpg', NULL, NULL, 'kids_special', '13', 0, 1, NULL, NULL),
(7, 'DEMON SLAYER: KIMETSU NO YAIBA INFINITY CASTLE', 'Tanjiro Kamado – a boy who joined an organization dedicated to hunting down demons called the Demon Slayer Corps after his younger sister Nezuko was turned into a demon.\r\n\r\nWhile growing stronger and deepening his friendships and bonds with fellow corps members, Tanjiro has battled many demons with his comrades – Zenitsu Agatsuma and Inosuke Hashibira. Along the way, his journey has led him to fight alongside the Demon Slayer Corps’ highest-ranking swordsmen, the Hashira, including Flame Hashira Kyojuro Rengoku aboard the Mugen Train, Sound Hashira Tengen Uzui within the Entertainment District, as well as Mist Hashira Muichiro Tokito and Love Hashira Mitsuri Kanroji at the Swordsmith Village.\r\n\r\nAs the Demon Slayer Corps members and Hashira engaged in a group strength training program, the Hashira Training, in preparation for the forthcoming battle against the demons, Muzan Kibutsuji appears at the Ubuyashiki Mansion. With the head of the Demon Corps in danger, Tanjiro and the Hashira rush to the headquarters but are plunged into a deep descent to a mysterious space by the hands of Muzan Kibutsuji.\r\n\r\nThe destination of where Tanjiro and Demon Slayer Corps have fallen is the demons’ stronghold – the Infinity Castle. And so, the battleground is set as the final battle between the Demon Slayer Corps and the demons ignites.', 'Natsuki Hanae, Yoshitsugu Matsuoka, Hiro Shimono', 'Haruo Sotozaki', 'Bahasa Melayu, English', 0, '2025-08-14', 'Japanese', 'Anime', 'm11.jpg', NULL, NULL, 'coming_soon', 'TBA', 0, 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
