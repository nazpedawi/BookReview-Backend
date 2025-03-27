-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 27, 2025 at 04:30 PM
-- Server version: 11.5.2-MariaDB-ubu2404
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDevelopment2DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `publication_year` int(11) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`book_id`, `title`, `description`, `author`, `publication_year`, `cover_image`) VALUES
(2, 'Pride and Prejudice', 'A romantic novel that centers on Elizabeth Bennet and her complex relationship with the proud Mr. Darcy. The novel explores themes of social class, marriage, and personal growth.', 'Jane Austen', 1900, 'book_2.jpg'),
(3, 'The Great Gatsby', 'Set in the Roaring Twenties, the novel tells the story of Jay Gatsby, a wealthy and mysterious man who is obsessed with the love of his life, Daisy Buchanan. It explores themes of the American Dream, wealth, and the moral decay of society.', 'Scott Fitzgerald', 1925, 'book_3.webp'),
(63, 'The Road', 'his Pulitzer Prize-winning novel follows a father and his young son as they struggle to survive in a post-apocalyptic world where the sun has been obscured by ash, and humanity has descended into barbarism. With only their love for each other to keep them going, they travel through a desolate, cold landscape filled with danger. McCarthy’s spare, haunting prose highlights themes of survival, love, and the human condition.\r\n', ' Cormac McCarthy', 2006, '510x840.jpg'),
(64, 'The Kite Runner', 'Set against the backdrop of Afghanistan’s tumultuous history, The Kite Runner follows the friendship between two boys, Amir and Hassan. Despite being from different social classes, they share an intense bond until betrayal shatters their relationship. The novel explores themes of guilt, redemption, and the impact of historical events on personal lives, as Amir returns to Afghanistan years later to seek forgiveness and come to terms with his past.', 'Khaled Hosseini', 2003, '521x840.jpg'),
(65, 'The Hunger Games', 'In a dystopian future where North America has collapsed into the nation of Panem, the Capitol controls the districts and forces them to participate in the Hunger Games: a televised event where children are selected to fight to the death. Katniss Everdeen volunteers in place of her sister and becomes a symbol of rebellion. This gripping series explores survival, sacrifice, and the effects of power and manipulation on society.', ' Suzanne Collins', 2008, 'boekenbalie_9789000314126_cover_1920x1920.jpg'),
(66, 'The Da Vinci Code', 'Robert Langdon, a Harvard symbologist, is called to investigate the murder of a curator at the Louvre. As he delves deeper, he uncovers a secret society, a hidden message in the works of Da Vinci, and a centuries-old conspiracy involving the Catholic Church. Fast-paced and filled with historical references and codes, this bestseller explores themes of faith, knowledge, and truth.', 'Dan Brown', 2003, '538x840.jpg'),
(67, 'The Girl with the Dragon Tattoo', 'This gripping crime thriller introduces Lisbeth Salander, a brilliant hacker with a troubled past, and Mikael Blomkvist, a journalist facing legal troubles. They team up to solve the mystery of a wealthy family’s disappearance, only to uncover dark secrets that threaten to expose powerful figures. The novel blends complex characters, a deep investigation, and a chilling narrative with themes of vengeance, justice, and corruption.', 'Stieg Larsson', 2005, '547x840 (6).jpg'),
(70, 'To All the Boys I\'ve Loved Before', 'Lara Jean Covey, a shy, introverted high school junior, has written secret love letters to all of her past crushes, but never intended for anyone to read them. However, when her younger sister sends out these letters without her knowledge, Lara Jean’s life is turned upside down. She must now face the boys from her past, including Peter Kavinsky, her ex-best friend. What starts as a fake relationship between Lara Jean and Peter to cover up her feelings turns into something more complicated. To All the Boys I&#039;ve Loved Before is a charming, heartwarming story about love, family, and finding yourself amidst unexpected circumstances.', 'Jenny Han', 2014, '546x840.jpg'),
(71, 'P.S. I Still Love You', 'Lara Jean and Peter have begun dating for real, but their relationship isn’t as perfect as it seems. When another one of Lara Jean’s former crushes, John Ambrose McClaren, reappears in her life, it causes Lara Jean to question her feelings. Torn between her past and present loves, Lara Jean must figure out what she truly wants and whether she can make her relationship with Peter work amid new challenges and growing emotions.', 'Jenny Han', 2015, '550x825 (1).jpg'),
(72, 'Always and Forever, Lara Jean', 'As Lara Jean’s senior year of high school comes to an end, she faces the reality of growing up and moving on. With college decisions to be made, Lara Jean has to navigate the future of her relationship with Peter, especially as they face new obstacles like distance and differing plans for their futures. As they approach the next chapter of their lives, Lara Jean must decide what she wants for herself and how to balance love, family, and independence.', 'Jenny Han', 2017, '550x836 (1).jpg'),
(73, 'The Hobbit', 'Bilbo Baggins, a hobbit living a quiet life in the Shire, is thrust into an unexpected adventure when the wizard Gandalf and a group of dwarves choose him to help them reclaim their homeland from the dragon Smaug. Along the way, Bilbo encounters trolls, goblins, elves, and giant spiders, all while discovering hidden strengths and courage he never knew he had. The Hobbit is a classic tale of bravery, friendship, and self-discovery, set in a richly imagined world full of magic and danger.', 'J.R.R. Tolkien', 1937, '51HA63io4WL._SY445_SX342_.jpg'),
(74, 'The Hitchhikers Guide to the Galaxy', 'This quirky and beloved novel follows Arthur Dent, an ordinary man who is swept off Earth just before it is destroyed to make way for a hyperspace bypass. Arthur is rescued by Ford Prefect, an alien, and together they embark on an intergalactic adventure. Along the way, they encounter eccentric characters, such as Zaphod Beeblebrox, the two-headed, three-armed ex-President of the Galaxy, and Marvin, a depressed robot. The book is filled with absurd humor, witty dialogue, and playful satire of human nature and the universe. It&#039;s a hilarious journey through space, blending philosophical musings with slapstick comedy.', 'Douglas Adams', 1979, '515x840.jpg'),
(75, 'The Perks of Being a Wallflower', 'his heartfelt novel is written in the form of letters from Charlie, a shy, introspective teenager navigating the ups and downs of growing up. As he begins high school, Charlie faces the challenges of finding his place in the world, dealing with the loss of his best friend, and uncovering painful family secrets. Along the way, he forms deep connections with two seniors, Sam and Patrick, who introduce him to new experiences, both joyful and heartbreaking. The book captures the turbulence of adolescence with raw honesty and explores themes of friendship, love, mental health, and self-discovery. Charlie’s journey to understand himself and his emotions resonates with readers, making this a defining coming-of-age story.', 'Stephen Chbosky', 1999, '81OuvmloNjL._SY522_.jpg'),
(76, 'The Power of Now', 'This book encourages readers to live in the present moment and release past and future worries. Tolle emphasizes the importance of mindfulness and how letting go of mental distractions can lead to inner peace and enlightenment. It&#039;s a guide to achieving spiritual awakening by focusing on the present.', 'Eckhart Tolle', 1997, '546x840 (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book_genres`
--

CREATE TABLE `book_genres` (
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `book_genres`
--

INSERT INTO `book_genres` (`book_id`, `genre_id`) VALUES
(2, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 2),
(3, 3),
(63, 3),
(2, 4),
(64, 4),
(66, 5),
(73, 6),
(75, 7),
(65, 8),
(2, 9),
(3, 9),
(66, 11),
(67, 11),
(75, 11),
(65, 13),
(70, 13),
(71, 13),
(72, 13),
(74, 13),
(76, 14),
(3, 16),
(74, 17),
(67, 19),
(74, 21),
(75, 21);

-- --------------------------------------------------------

--
-- Table structure for table `Genres`
--

CREATE TABLE `Genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Genres`
--

INSERT INTO `Genres` (`genre_id`, `name`) VALUES
(1, 'Romance'),
(2, 'Adventure'),
(3, 'Fiction'),
(4, 'Historical Fiction'),
(5, 'Mystery'),
(6, 'Fantasy'),
(7, 'Coming-of-Age'),
(8, 'Dystopian'),
(9, 'Classic'),
(10, 'Horror'),
(11, 'Thriller'),
(12, 'Non-Fiction'),
(13, 'Young Adult'),
(14, 'Self-Help'),
(15, 'Biography'),
(16, 'Literary Fiction'),
(17, 'Poetry'),
(18, 'Comedy'),
(19, 'Crime'),
(20, 'Science Fiction'),
(21, 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `review_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `review_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`review_id`, `book_id`, `user_id`, `review_text`, `rating`, `review_date`) VALUES
(9, 2, 13, 'Pride and Prejudice is such a fun read! Elizabeth Bennet is witty, strong, and super relatable, and watching her go from disliking Mr. Darcy to falling in love with him is such a great journey. The chemistry between them is amazing, and I love how their story is about more than just romance – it’s also about overcoming misunderstandings and learning not to judge people too quickly. Austen’s humor and the way she portrays society’s pressures really make the book stand out. Definitely a must-read if you enjoy a mix of romance, drama, and clever dialogue.', 5, '2024-12-08 15:53:15'),
(10, 2, 14, 'I wasn’t sure what to expect from Pride and Prejudice, but it definitely surprised me. The book’s not just about the love story between Elizabeth and Darcy – it’s also about all the social drama and how people are constantly judging each other. Elizabeth’s a strong character, and Darcy’s transformation is actually pretty cool to watch. The whole “I hate you, but I actually love you” thing is a classic, but it still works well here. It’s not a super quick read, but it’s worth it if you like a bit of wit, romance, and a peek into 19th-century British society.', 4, '2024-12-08 15:54:48'),
(12, 3, 15, 'Man, Gatsby’s wild. Dude spends his whole life chasing this idea of the American Dream, but it all turns out to be some fake mess. He’s got money, parties, and the whole world at his feet, but he’s still chasing some chick who’s not even worth it. The whole thing’s just sad—showing how people can be fake and lost even when they got everything. It’s got that old-school 1920s vibe, but the story’s real enough to make you think. Definitely worth a read if you’re into that rich-people drama.', 3, '2024-12-08 16:01:24'),
(13, 2, 15, 'so this one’s all about love, but with some old-school drama. Elizabeth Bennet’s a strong woman who doesn’t fall for the first rich guy that comes her way, which is honestly kinda rare for the time. Mr. Darcy? Dude’s got a major ego at first, but he’s actually a softie under all that pride. The back-and-forth between them is like a constant game of cat and mouse. It’s slow-paced, but once you’re into it, the tension is real. If you’re cool with some fancy words and old vibes, you’ll see why this book’s a classic.', 4, '2024-12-08 16:02:49'),
(25, 2, 16, 'one of those books you can&#039;t help but fall in love with. The chemistry between Elizabeth Bennet and Mr. Darcy is so captivating, and their relationship grows in such an interesting way. I absolutely loved how witty and sharp the writing is, and the characters are all so well-crafted. It’s not just a romance, but a clever commentary on social expectations and class. I found myself laughing, getting frustrated, and cheering for Elizabeth as she navigates love and life. Definitely a book that stays with you long after you&#039;ve finished it!', 5, '2024-12-25 16:14:24'),
(26, 3, 16, ' is often praised for its symbolism and portrayal of the American Dream, I found it to be somewhat underwhelming. The characters, especially Gatsby himself, felt a bit one-dimensional, and I struggled to connect with their motivations. The story’s pacing was slow, and I often found myself frustrated by the superficiality of the characters&#039; actions. Although Fitzgerald’s writing is undeniably poetic, I felt the novel&#039;s overall message about wealth and desire lacked the depth I expected. It’s a book that’s clearly well-regarded, but for me, it didn’t live up to the hype.', 2, '2024-12-25 16:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('RegularUser','Admin') DEFAULT 'RegularUser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `firstName`, `lastName`, `username`, `password`, `email`, `role`) VALUES
(13, 'Jane', 'Smith', 'Janesmith', '$2y$12$WbUJcB5po351BRGVstSeQuJSc/6U9ef8nPAhbY9U7SAGYfj7ToMrW', 'janesmith@gmail.com', 'Admin'),
(14, 'John', 'Doe', 'Johndoe', '$2y$12$tFtrCUHcx2Wv9faken750e8K6QX4NiNw3RF5T.HWH8/.lDEWZbgGO', 'johndoe@gmail.com', 'RegularUser'),
(15, 'Sarah', 'Johnson', 'Sarahjohnson', '$2y$12$PgYI3Q8ONc9qaDK6CNwjm.WOv64FUxlsfe.Gv.52EGH2v37PzXLna', 'sarajohnson@gmail.com', 'RegularUser'),
(16, 'Amy', 'Bryan', 'amybryan', '$2y$12$bpK9f.dywsixINg0ISbFNuJjh1GwxoDOmA6tIpJtNrW6v0YZ0T2/a', 'amybryan@gmail.com', 'RegularUser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD PRIMARY KEY (`book_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `Genres`
--
ALTER TABLE `Genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Books`
--
ALTER TABLE `Books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `Genres`
--
ALTER TABLE `Genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD CONSTRAINT `book_genres_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `Books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `Genres` (`genre_id`) ON DELETE CASCADE;

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `Reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `Books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
