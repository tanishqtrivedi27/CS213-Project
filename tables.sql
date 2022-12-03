CREATE DATABASE IF NOT EXISTS `booklib` ;

USE `booklib`;

CREATE TABLE IF NOT EXISTS `cart` (
   `pid` int(11) NOT NULL, 
   `qty` int(11) NOT NULL,
   `cid` int(11) NOT NULL,
   `wishlist` int(1) DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `seller` (
  `sid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `sname` varchar(255) NOT NULL,
  `semail` varchar(255) NOT NULL UNIQUE,
  `spassword` varchar(255) NOT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postalCode` INT(15) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS `customer` (
   `cid` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `name` VARCHAR(255) NOT NULL , 
   `psw` VARCHAR(50) NOT NULL , 
   `email` VARCHAR(255) NOT NULL UNIQUE,
   `street` varchar(50) DEFAULT NULL,
   `city` varchar(50) DEFAULT NULL,
   `state` varchar(50) DEFAULT NULL,
   `postalCode` INT(15) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS `product` (
  `pid` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pname` VARCHAR(255) NOT NULL,
  `price` Float(19) NOT NULL,
  `sid` INT(11),
  `stock` INT(11) NOT NULL,
  `description` VARCHAR(1000) NOT NULL,
  `keywords` VARCHAR(1000) NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `genre` VARCHAR(255) NOT NULL,
  `fileName` VARCHAR(255) NOT NULL,
  `edition` INT(10) DEFAULT 1,
  `publishingDate` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `orders` (
   `sid` INT(11) NOT NULL , 
   `pid` INT(11) NOT NULL , 
   `cid` INT(11) NOT NULL , 
   `qty` INT(11) NOT NULL,
   `date` VARCHAR(255) NOT NULL ,
   `paymentMode` VARCHAR(255) NOT NULL,
   `delDate` VARCHAR(255) NOT NULL,
   `shipping` INT(1) DEFAULT 1
);


CREATE TABLE IF NOT EXISTS `chat` (
   `sid` INT(11) NOT NULL , 
   `cid` INT(11) NOT NULL , 
   `pid` INT(11) NOT NULL , 
   `question` VARCHAR(255) NOT NULL,
   `answer` VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS `review`( 
   `cid` INT(11) NOT NULL , 
   `pid` INT(11) NOT NULL , 
   `review` VARCHAR(255) NOT NULL
);


INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('1', 'Head First Python', '1200', '1', '5', 'In case you are bored of slogging through Python how-to manuals, then Head-First Python is the way to go! This book is a brain-friendly guide (As its name suggests!) and it provides a more visual format to engage your brain rather than a text-heavy approach that can become boring pretty fast', 'Head-First-Python-Paul-Barry-Computer-Programming', 'Paul Barry', 'Computer Programming', '1.jpeg', '11 12 2022');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('2', 'Python Programming: An Introduction to Computer Science', '800', '1', '3', 'Python Programming: An Introduction to Computer Science is ideal if you want to understand the standard computer science concepts using a very non-standard language, Python!!! ', 'Python-Programming-Computer-Science-Introductoin-Computer-Programming', 'Brian Jones', 'Computer Programming','2.jpeg','11/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('3', 'Introduction to Machine Learning', '2499', '1', '9', ' Introduction to Machine Learning with Python tries to expand your imagination by teaching you methods to create your own machine learning solutions using Python and the scikit-learn library.', 'Intoduction-Machine-Learning-Computer Programming', ' Luciano Ramalho', 'Computer Programming','3.jpeg','10/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('4', 'Introduction To Alogrithms', '2499', '1', '10', 'We have designed this book to be both versatile and complete. You should find it nuseful for a variety of courses, from an undergraduate course in data structures up through a graduate course in algorithms. Because we have provided considerably more material than can fit in a typical one-term course', 'Algorithms-c-Computer-Programming', 'Corman', 'Computer Programming','4.png','8/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('5', 'The Maid', '200', '1', '12', 'A motley cast of personality-rich characters. And, of course, a murder. The storys protagonist is a hotel maid named Molly Gray who quickly becomes a suspect in the case. Molly sees things a little differently. ', 'The-Maid-Fiction', 'Nita Prose', 'Fiction','5.png','11/11/12');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('6', 'To Paradise', '500', '1', '8', 'takes place in an alternate New York reality that can be seen as utopian or dystopian, depending on the persons position in society. Readers will meet characters in 1893, 1993 and 2093. From these disparate times and versions of America, characters survive crises like the AIDS epidemic', 'To-Paradise-Fiction', 'Hanya Yanagihara', 'Fiction','6.jpeg','11/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('7', 'The Fields', '150', '1', '5', 'A newly appointed investigator. A second body. Ghosts of a dark past. The story of Sergeant Riley Fisher, a new crime investigator in a small farming town, simmers with tension and the niggling fear that theres something dangerous just around the corner.', 'The-Fields-Fiction', 'Erin Young', 'Fiction','7.jpeg','11/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('8', 'Our American Friend', '899', '1', '50', 'Shake up political drama, international espionage and potentially tyrannous female friendship. What do you get? Anna Pitoniaks latest novel. In Our American Friend, youll meet USSR-born First Lady Lara Caine and jaded journalist Sofie Morse.', 'Our-Ameri-can-Friend-Fiction', 'Anna Pitoniak', 'Fiction','8.jpeg','11/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('9', 'THE REPUBLIC', '599', '1', '12', 'The Republic is a Socratic dialogue authored by Plato sometime around 375 BCE. Plato argues that knowledge should be the determining factor as to who should rule the people, because those with the most expertise—in Platos view philosophers', 'The-Republic-Politics & Society', 'Plato', 'Politics & Society','9.jpeg','11/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('10', 'THE SOCIAL CONTRACT ', '2899', '1', '45', 'ean-Jacque Rosseau was a French philosopher who published this essay about the social contract between governments and people in 1762. The basic principle of his “social contract” is that laws are binding only when they are supported by the will of the people. This concept positions the will of the people above the authority of government, which was in a stark contradiction to governance in France at that time.', 'The-Social-Contract-Politics & Society', 'JEAN-JACQUE ROSSEAU', 'Politics & Society','10.jpeg','11/01/12');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('11', 'The History of Tom Jones', '900', '1', '85', 'A foundling of mysterious parentage brought up by Mr. Allworthy on his country estate, Tom Jones is deeply in love with the seemingly unattainable Sophia Western, the beautiful daughter of the neighboring squire—though he sometimes succumbs to the charms of the local girls.', 'The-History-of-Tom-Jones-Novels & Literature', 'Henry Fielding', 'Novels & Literature','11.jpeg','12/11/22');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('12', 'War and Peace', '1500', '9', '1', 'In Russia\s struggle with Napoleon, Tolstoy saw a tragedy that involved all mankind. Greater than a historical chronicle, War and Peace is an affirmation of life itself, `a complete picture\, as a contemporary reviewer put it, of everything in which people find their happiness and greatness, their grief and humiliation ', 'War-And-Peace-Novels & Literature', 'Leo Tolstoy', 'Novels & Literature','12.jpeg','4/11/12');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('13', 'Wuthering Heights', '795', '1', '41', 'At the centre of this novel is the passionate love between Catherine Earnshaw and Heathcliff - recounted with such emotional intensity that a plain tale of the Yorkshire moors acquires the depth and simplicity of ancient tragedy.', 'Wuthering-Heights-Novels & Literature', 'Richard J. Dunn\r ', 'Novels And Literature','13.jpeg','21/11/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('14', 'The Brothers Karamazov', '3000', '1', '25', 'The Brothers Karamazov is a murder mystery, a courtroom drama, and an exploration of erotic rivalry in a series of triangular love affairs involving the “wicked and sentimental” Fyodor Pavlovich Karamazov and his three sons―the impulsive and sensual Dmitri; ', 'The-Brothers-Karamazov-Novels & Literature', 'Fyodor Dostoevsky', 'Novels & Literature','14.jpeg','14/1/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('15', 'The Very Hungry Caterpillar ', '150', '1', '25', 'One of the greatest childrens classics of all time, The Very Hungry Caterpillar pictographically describes the evolution of caterpillar eating his way through an array of food to eventually pupate into a beautiful butterfly. ', 'The-Very-Hungry-Caterpillar-Story Books', 'Eric Carle', 'Story Books','15.jpeg','5/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('16', 'The Cat in the Hat ', '575', '1', '65', 'This children story revolves around an anthropomorphic cat who shows up at Sallys house, makes a mess while entertaining her and her brother and cleans up with the help of his friends, Thing 1 and Thing 2 just before Sallys mother comes home.', 'The-Cat-In-The-Hat-Story Books', 'Dr. Seuss ', 'Story Books','16.png','5/6/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('17', 'Charlottes Web ', '549', '1', '85', 'Inspiring animations, live-action films, direct-to-video sequels and a video game, E. B. Whites Charlottes Web is counted as classic in childrens English literature and one of the best selling paperback of all time', 'Charlottes Web-Story Books', 'E. B. White', 'Story Books','17.jpeg','15/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('18', 'Harold and the Purple Crayon', '600', '1', '64', 'How wonderful would it be if we could simply draw the world as we understand it? Crockett Johnson explores this possibility in Harold and the Purple Crayon where an inquiring four year old boy own a purple crayon with which he creates the world by drawing it. ', 'Harold-And-The-Purple-Crayon-Story Books', ' Crockett Johnson', 'Story Books','18.jpeg','18/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('19', 'Harry Potter ', '588', '1', '26', 'Harry Potter has been adapted into blockbuster films, won numerous British and American awards and reached New York Times best-seller list. The plot involves the boy himself, Harry Potter who discovers he is a wizard and begins his life at Hogwarts School of Witchcraft and Wizardry.', 'Harry-Potter-Fiction', 'J.K Rowlings', 'Fiction','19.jpeg','19/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('20', 'Introduction to JAVA', '3000', '1', '23', 'This books covers the basics of the Java OOPS and Other Concepts', 'Introduction-To-Algorithms-Computer Programming', 'Abhiram Ranade', 'Computer Programming','20.jpeg','20/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('21', 'Diary of a Wimpy Kid: Diper Överlöde', '3000', '1', '21', 'In Diper Överlöde, book 17 of the Diary of a Wimpy Kid series from #1 international bestselling author Jeff Kinney, Greg Heffley is finding out that the road to fame and glory comes with some hard knocks.', 'Diary-of-a-Wimpy-Kid-fiction', ' Jeff Kinney', 'fiction','21.jpeg','21/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('22', 'Diary of a Wimpy Kid: : Wrecking Ball', '3000', '1', '232', 'The BRAND NEW laugh-out-loud, fully illustrated bestselling Wimpy Kid book - now in paperback!*Big changes are in store for Greg Heffley and his family. They are making home improvements!But with unwelcome critters, toxic mould and the walls coming down', 'Diary-of-a-Wimpy-Kid-fiction', ' Jeff Kinney', 'fiction','22.jpg','21/4/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('23', 'Diary of a Wimpy Kid: The Deep End', '3000', '1', '21', 'In Diper Överlöde, book 17 of the Diary of a Wimpy Kid series from #1 international bestselling author Jeff Kinney, Greg Heffley is finding out that the road to fame and glory comes with some hard knocks.', 'Diary-of-a-Wimpy-Kid-fiction', ' Jeff Kinney', 'fiction','23.jpg','23/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('24', 'Diary of a Wimpy Kid: Big Shot', '3000', '1', '21', 'In Big Shot, book 16 of the Diary of a Wimpy Kid series from #1 international bestsetlling author Jeff Kinney, Greg Heffley and sports just dont mix.After a disastrous field day competition at school, Greg decides that when it comes to his athletic career, he officially retired. ', 'Diary-of-a-Wimpy-Kid-fiction', ' Jeff Kinney', 'fiction','24.jpeg','24/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('25', 'Diary of a Wimpy Kid: Last Straw', '3000', '1', '21', 'The book, ‘Diary of a Wimpy Kid – 3 The Last Straw’ is a part of the book series - Diary of a Wimpy Kid written by Jeff Kinney. The book series revolves around the kid Greg Heffley who is naughty, honest and charming in his own way. The book has been written to portray the journey of Greg whose life is laden with exciting and adrenaline pumping adventures. ', 'Diary-of-a-Wimpy-Kid-fiction', ' Jeff Kinney', 'fiction','25.jpeg','25/5/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('26', 'The Making of Hero: Four Brothers', '3110', '1', '231', 'Winner of the 2020 Tata Literature Live! Business Book Award From the bylanes of Kamalia and the rugged landscapes of Quetta in India of the 1940s which later became Pakistan, they escaped to the Partition-ravaged cities of Amritsar, Agra, Delhi and finally settled in Ludhiana with little more than the shirts on their backs. From here, four of the six Munjal brothers built their business, part by part. ', 'Four-Brothers-entrepreneurship', ' Sunil-Kant Munjal', 'entrepreneurship','26.jpeg','26/7/20');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('27', 'Famous Five', '1200', '1', '3', ' Is a popular childrens book by Enid Blyton. It is the first book in The Famous Five series. The first edition of the book was illustrated by Eileen Soper.', 'Famous-Five-story books', 'Enid Blyton', 'story books', '27.jpeg', '23/4/2003');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('28', 'NCERT History', '580', '1', '67', 'This is a basic history textbook for class 10', 'NCERT-History-textbook', 'Ncert', 'textbook', '28.jpeg', '23/13/2000');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('29', 'Harry Potter and the Chamber of Secrets', '150', '1', '12', 'There is a plot, Harry Potter. A plot to make most terrible things happen at Hogwarts School of Witchcraft and Wizardry this year.', 'Harry-Potter-And-The-Chamber-Of-Secrets-Fiction', 'J.K. Rowling', 'Fiction', '29.jpeg', '12/8/2004');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('30', 'Harry Potter: Philosopher Stone', '460', '1', '25', 'Prepare to be spellbound by Jim Kay dazzling depiction of the wizarding world and much loved characters in this full-colour illustrated hardback edition of the nation favourite children book - Harry Potter and the Philosophers Stone. Brimming with rich detail and humour that perfectly complements J.K. Rowlings timeless classic, Jim Kays glorious illustrations will captivate fans and new readers alike.', 'Harry-Potter-Philosopher-Stone ', 'ROWLING J.K.', 'Fiction', '30.jpg', '2/03/2001');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('31', 'Goblet of Fire', '399', '1', '98', 'There will be three tasks, spaced throughout the school year, and they will test the champions in many different ways...their magical prowess - their daring - their powers of deduction - and, of course, their ability to cope with danger', 'Harry-Potter-Goblet of-Fire-Fiction', 'J.K. Rowling', 'Fiction', '31.jpeg', '12/8/2004');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('32', 'Order of the Phoenix', '899', '1', '98', 'You are sharing the Dark Lords thoughts and emotions. The Headmaster thinks it inadvisable for this to continue. He wishes me to teach you how to close your mind to the Dark Lord', 'Harry-Potter-Order-of-Phoneix-Fiction', 'J.K. Rowling', 'Fiction', '32.webp', '12/8/2004');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('33', 'star wars:last jedi', '365', '1', '25', 'From the ashes of the Empire has arisen another threat to the galaxys freedom: the ruthless First Order. Fortunately, new heroes have emerged to take up arms—and perhaps lay down their lives—for the cause. ', 'Star-Wars-last-jedi-fiction', 'Paul S. Kemp', 'fiction', '33.png', '2/01/2009');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('34', 'NCERT FINGERTIPS', '365', '1', '25', 'The 10th revised edition of MTGs Objective NCERT at Your Fingertips, Chemistry is a completely revised edition of the existing Fingertips book. ', 'NCERT-Fingertips-textbooks', 'MTG', 'textbooks', '34.jpeg', '20/01/2019');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('35', 'Secrets Of the galaxy', '365', '1', '25', 'The secrets of the Star Wars galaxy have been recorded in a series of handbooks and guides created and kept hidden by the Jedi ', 'Secrets-of-the-Galaxy-fiction', 'Paul S. Kemp', 'fiction', '35.jpeg', '5/01/2009');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('36', 'Harry Potter: Philosopher Stone', '460', '1', '25', 'Prepare to be spellbound by Jim Kay dazzling depiction of the wizarding world and much loved characters in this full-colour illustrated hardback edition of the nation favourite children book - Harry Potter and the Philosophers Stone. Brimming with rich detail and humour that perfectly complements J.K. Rowlings timeless classic, Jim Kays glorious illustrations will captivate fans and new readers alike.', 'Harry-Potter-Philosopher-Stone ', 'ROWLING J.K.', 'Fiction', '36.jpg', '2/03/2001');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('37', 'Harry Potter and the Prisoner of Azkaban', '350', '1', '205', 'For twelve long years, the dread fortress of Azkaban held an infamous prisoner named Sirius Black. Convicted of killing thirteen people with a single curse, he was said to be the heir apparent to the Dark Lord, Voldemort', 'Harry-Potter-Prisnoner-of-Azkaban-Fiction', 'ROWLING J.K.', 'Fiction', '37.jpg', '20/03/2002');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('38', 'Harry Potter:Half-Blood Prince', '789', '1', '100', 'When Dumbledore arrives at Privet Drive one summer night to collect Harry Potter, his wand hand is blackened and shrivelled, but he does not reveal why?', 'Harry-Potter-Order-of-Phoneix-Fiction', 'J.K. Rowling', 'Fiction', '39.webp', '22/10/2018');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('39', 'Harry Potter and the Cursed Child', '899', '1', '360', 'Escape to Hogwarts with the unmissable series that has sparked a lifelong reading journey for children and families all over the world. The magic starts here.', 'Harry-Potter-and-the-Cursed Child-Fiction', 'J.K Rowlings', 'Fiction', '39.jpeg', '23/2/2015');

INSERT INTO `product` (`pid`, `pname`, `price`, `sid`, `stock`, `description`, `keywords`, `author`, `genre`, `fileName`, `publishingDate`) VALUES ('40', 'Harry Potter and the Deathly Hallows', '899', '1', '25', 'Give me Harry Potter,said Voldemorts voice, and none shall be harmed. Give me Harry Potter, and I shall leave the school untouched. Give me Harry Potter, and you will be rewarded.', 'Harry-Potter-Deathly-Hallows-Fiction', 'J.K Rowlings', 'Fiction', '40.jpeg', '23/12/2019');




INSERT INTO `customer` (`cid`, `name`, `psw`, `email`, `street`, `city`, `state`, `postalCode`) VALUES ('1', 'Tanishq Trivedi', 'Tanishq@123', '210010056@iitdh.ac.in', 'xyz', 'Dharwad', 'karnataka', '411038');

INSERT INTO `customer` (`cid`, `name`, `psw`, `email`, `street`, `city`, `state`, `postalCode`) VALUES ('2', 'Prajwal Biradar', 'Prajwal@123', '210020037@iitdh.ac.in', 'xyz', 'Dharwad', 'karnataka', '411038');

INSERT INTO `customer` (`cid`, `name`, `psw`, `email`, `street`, `city`, `state`, `postalCode`) VALUES ('3', 'Cebajel Tanan', 'Cebajel@123', '210010055@iitdh.ac.in', 'xyz', 'Dharwad', 'karnataka', '411038');

INSERT INTO `customer` (`cid`, `name`, `psw`, `email`, `street`, `city`, `state`, `postalCode`) VALUES ('4', 'Hrishikesh Karande', 'Hrishikesh@123', '210010020@iitdh.ac.in', 'xyz', 'Dharwad', 'karnataka', '411038');


INSERT INTO `seller` (`sid`, `sname`, `semail`, `spassword`, `street`, `city`, `state`, `postalCode`) VALUES ('1', 'John Wick', 'Johnwick@gmail.com', 'Johnwich@123', 'xyz', 'Albany', 'New York', '511038');