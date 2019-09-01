-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2019 at 04:22 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xvlox`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Humor'),
(2, 'Education'),
(3, 'Insspirational'),
(4, 'Romance'),
(5, 'Drama'),
(7, 'Sports'),
(8, 'Movies');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category`, `title`, `post`, `active`, `created_by`, `created_at`, `image`) VALUES
(9, 'Education', 'Introduction to Laravel', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias molestiae accusamus quaerat tempora vel eligendi neque provident minus expedita, impedit laborum ut reiciendis quia minima hic cum, esse eius illo voluptatem! Dolores, aliquid. Consectetur non magni nihil ipsum? Error quae officiis ea, dolorum qui, excepturi impedit voluptatum dolor debitis doloremque, laborum facere sit cupiditate omnis mollitia maiores quis dolore ex officia. Magnam ducimus ea, praesentium quis eum nesciunt nemo maiores unde modi repudiandae qui asperiores, iste, ab similique at. Veniam assumenda inventore nulla, quae facilis amet possimus accusamus quidem dicta excepturi natus aliquid, explicabo pariatur consectetur consequatur saepe nam quod perferendis eius hic corrupti dolores molestias! Omnis, id! Id possimus dignissimos eos ut nobis saepe dolorem dolor labore sunt, delectus facilis dicta repellendus odio quaerat quia laboriosam, tenetur officiis quisquam. Iusto voluptates unde, saepe illum autem blanditiis quas? Nisi dolorum corrupti excepturi quam ipsam consectetur. Consequuntur doloremque, error, dolorem illum quibusdam expedita in at aut tempore ad nihil quaerat commodi deleniti quae maxime ea fuga magnam fugiat alias ullam. Fuga voluptate saepe alias, dignissimos, quibusdam eum sunt debitis consequuntur facilis placeat repellendus sequi veniam nam at id facere! Placeat ea ut maxime inventore fugit voluptatem sequi vero, in porro accusantium excepturi quidem autem! Sequi, repudiandae doloremque! Impedit ipsam nostrum ratione id? Eligendi culpa, magni fugit qui consequuntur deleniti, sequi doloremque voluptate quaerat tenetur sed id numquam, ratione at? Velit exercitationem similique architecto eveniet cupiditate eligendi molestiae voluptatum quasi, alias quisquam, possimus ad labore vero aut accusamus perspiciatis minima. Commodi asperiores id earum sed quisquam inventore enim vero, praesentium eveniet doloribus! Quod soluta illo cupiditate architecto facilis adipisci commodi voluptatibus natus! Sapiente a culpa fugit eius, excepturi eum consequatur minus natus velit dolorum? Veniam odio unde iure voluptatum provident vel tenetur. Quos dolor deleniti velit at ad itaque non natus aliquid!', 1, 'TonyM', '2019-07-14 15:28:01', NULL),
(8, 'Inspirational', 'Always Be Strong', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum ratione minus dolorum ipsam inventore cupiditate corrupti reprehenderit ut sunt dolores sit saepe maiores doloribus quia repellat voluptates tempora cumque velit, accusantium suscipit necessitatibus! Ex amet ea facere quibusdam cumque molestiae, quisquam aliquid enim minus ut. Incidunt quaerat minus architecto eaque aliquid. Tempora, adipisci laborum quas provident harum doloribus quidem similique quasi temporibus labore consequuntur ea maxime incidunt eos libero vero. Odio facere ducimus adipisci ad? Incidunt, officiis voluptas quam est enim repudiandae placeat atque illo deserunt impedit odio et quidem quas quos reprehenderit? Fuga obcaecati mollitia velit magni aliquid repellendus, quos iure natus blanditiis quo aliquam tempore illo molestias, iusto sunt voluptatem excepturi! Itaque pariatur suscipit facere, assumenda eveniet repellat nihil omnis. Ratione itaque numquam at, sit harum ex rem sint perferendis quasi et, aperiam accusantium temporibus quia inventore nulla nemo eum! Dolorum ipsam quisquam optio exercitationem nulla facilis! Soluta, maxime amet asperiores nam, non aut quisquam neque architecto harum rerum dignissimos beatae eveniet? Aspernatur deserunt, numquam repellat iure alias ullam, asperiores dolores laborum itaque nostrum facere quod quis magnam sapiente expedita molestias laboriosam laudantium ratione magni corrupti aliquid quae recusandae cumque. Sit facere voluptatum in maiores veritatis nihil voluptas.', 1, 'John', '2019-06-14 03:01:28', NULL),
(7, 'Romance', 'Love is in the air', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta suscipit ipsam nesciunt illum adipisci harum nisi quasi magnam qui recusandae quaerat quidem corrupti, sapiente deleniti. Placeat unde molestiae nemo molestias, pariatur adipisci ipsum neque veniam, id optio sequi totam et quis nostrum modi? Quibusdam assumenda repellat autem! Ipsum, voluptates unde.', 1, 'TonyM', '2019-05-19 21:31:42', NULL),
(6, 'Inspirational', 'Don\'t give up', 'Not Valid User. Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident numquam incidunt esse! Doloribus eligendi maiores in quasi nesciunt quae id magni nobis exercitationem quibusdam molestiae ratione provident est vitae nostrum deserunt obcaecati, mollitia adipisci saepe, beatae ea suscipit! Eum doloremque voluptatum quos voluptatibus consequuntur obcaecati dolorem nam ducimus sint quaerat.', 1, 'TonyM', '2019-05-19 21:24:11', NULL),
(14, 'Education', 'Education', 'This is a test post and something else', 1, 'TonyM', '2019-08-19 01:03:41', NULL),
(17, 'Humor', 'Test Post for Humor', 'This is a test post for example purposes.', 1, 'TonyM', '2019-08-19 01:29:52', NULL),
(18, 'Education', 'Education', 'This is a post with letters for learning purposes', 1, 'TonyM', '2019-08-19 02:07:28', NULL),
(19, 'Sports', 'My New Sport', 'This is a testing post.', 1, 'John', '2019-08-31 19:36:53', NULL),
(20, 'Movies', 'My New Movie', 'This is a test post for example.', 1, 'John', '2019-08-31 19:43:38', NULL),
(21, 'Romance', 'This is a new romance post', 'This is a post for users to see and learn.', 1, 'John', '2019-08-31 19:45:07', NULL),
(13, 'Sports', 'Run Run Run', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ullam vel repellat tempore nulla a facilis itaque officiis, quis iure deserunt incidunt voluptatum asperiores autem sint nemo recusandae delectus deleniti dolor! Quisquam corporis esse fuga incidunt consequatur repellat magnam eaque non quis quasi tempora laboriosam, reiciendis autem adipisci mollitia fugit voluptate? Amet ullam quis ut tempore voluptatum ad! Minus eum, ducimus facere quis laboriosam neque suscipit. Expedita cupiditate enim earum? Deserunt maxime eligendi expedita cupiditate recusandae iste modi harum eum ex maiores. Porro adipisci sint quaerat aliquam aut rerum nam blanditiis facere! Ipsum debitis culpa possimus doloribus, in adipisci. Suscipit porro, nulla quae libero tempora asperiores accusamus. Fugit expedita ipsa adipisci, eum reprehenderit dolore? A velit architecto rerum labore blanditiis expedita eum necessitatibus praesentium dicta quo, exercitationem ad distinctio, nulla culpa reiciendis at asperiores vel! Consequatur officia reiciendis odio voluptate. Ut at aliquid eaque nam. Molestiae hic harum placeat, molestias nisi vero voluptatum minus, veritatis nostrum magni voluptatibus ducimus animi impedit quod ad? Fugiat eius pariatur, suscipit quae a unde delectus inventore error tenetur illum maxime quod omnis in dolorem laudantium corporis odio sapiente labore alias veritatis expedita consequuntur repellendus natus libero. Ratione, atque dolorem reprehenderit ullam illum fugiat alias voluptas provident quam culpa expedita explicabo facilis quo. Commodi accusamus eveniet voluptates hic dolorum similique vero rerum perspiciatis magni facilis voluptatibus totam natus possimus, voluptas assumenda recusandae harum est aperiam enim ratione reiciendis, odio atque! Unde molestiae porro amet ratione tempore placeat blanditiis, quisquam, ipsa quaerat officia temporibus impedit iure quasi ipsum eum illum magni minima. Eveniet, quam neque nihil qui dolorem harum at commodi, incidunt officia atque aut quia non aspernatur illo. Iure tempora officiis repudiandae animi, quos, adipisci quo totam nesciunt harum earum aut eaque provident mollitia quidem reiciendis. Neque praesentium dolor laborum iste modi consequatur fugit minus?', 1, 'TonyM', '2019-07-14 18:50:41', NULL),
(22, 'Drama', 'this is a new  drama post', 'this is a post for users to learn a new skill.', 1, 'John', '2019-08-31 20:03:21', 'images/posts/laravel_5d6ad289bb4b71.86451980.png'),
(23, 'Humor', 'this is a humor post', 'this is a post for testing puposses.', 1, 'John', '2019-08-31 20:11:26', 'images/posts/no-image-available.jpg'),
(24, 'Education', 'Laravel The Best Framework', 'Laravel is the best framework in the world to develop websites.', 1, 'John', '2019-08-31 20:33:54', 'images/posts/framework_5d6ad9b24d7178.00364380.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_code` varchar(30) DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `reset_code` varchar(64) DEFAULT NULL,
  `attempt` int(2) NOT NULL DEFAULT '0',
  `blocked` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `email_code`, `email_verified`, `reset_code`, `attempt`, `blocked`) VALUES
(1, 'TonyM', 'tutortonym@mastersdeveloping.com', '$2y$10$tOSui1Fn.2GS8UBCKy8p3OQ2pOawAcPXOh3KfOQc5BAToVW.u95mK', '449a318ff49cc1c99e602295ebd6ff', 0, NULL, 5, '2019-08-25 06:06:37'),
(6, 'John', 'john@example.com', '$2y$10$R/pvBR1ER3LTwCUYeK121uB0cf0WfFuUIfBGifgKvVoWZp.XqzRli', 'eb2665b9704218e9945a10c2f988c9', 0, NULL, 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
