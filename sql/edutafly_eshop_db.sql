-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1:3307
-- Χρόνος δημιουργίας: 17 Μάη 2025 στις 12:06:54
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `edutafly_eshop_db`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Black Pen', 'Reliable ballpoint pens with smooth ink flow. Ideal for everyday note-taking and exams.', 0.75, 'BlackPen.jpg', 'Pen'),
(2, 'Blue Pen', 'Reliable ballpoint pens with smooth ink flow. Ideal for everyday note-taking and exams.', 0.99, 'BluePen.jpg', 'Pen'),
(3, 'Red Pen', 'Reliable ballpoint pens with smooth ink flow. Ideal for everyday note-taking.', 0.80, 'RedPen.jpg', 'Pen'),
(4, 'Pack of Black Pens', 'Pack of 3. Reliable ballpoint pens with smooth ink flow. Ideal for everyday note-taking and exams.', 2.50, 'BlackPackPen.jpg', 'Pen'),
(5, 'Pack of Blue Pens', 'Pack of 5. Reliable ballpoint pens with smooth ink flow. Ideal for everyday note-taking and exams.', 4.40, 'BluePackPen.jpg', 'Pen'),
(6, 'Pack of Red Pens', 'Pack of 5. Reliable ballpoint pens with smooth ink flow. Ideal for everyday note-taking.', 4.40, 'RedPackPen.jpg', 'Pen'),
(7, 'Pencil', 'High-quality graphite pencils, perfect for writing, drawing, or sketching.', 0.30, 'Pencil.webp', 'Pencil'),
(8, 'Pencil with Eraser', 'High-quality graphite pencils, perfect for writing, drawing, or sketching.', 0.50, 'PencilwithEraser.jpg', 'Pencil'),
(9, 'Pack of Pencils', 'Pack of 5. High-quality graphite pencils, perfect for writing, drawing, or sketching.', 2.00, 'PackPencil.jpg', 'Pencil'),
(10, 'Double Barrel Sharpener', 'Practical sharpener with built-in container for shavings. Keeps your pencil case clean and tidy.', 2.20, 'PencilSharpenerWithContainer.jpg', 'Sharpener'),
(11, 'Double-Hole Sharpener', 'Sturdy dual-blade sharpener with two slots for regular and thick pencils.', 1.30, 'PencilSharpener.jpg', 'Sharpener'),
(12, 'Eraser', 'Soft and clean erasers that remove pencil marks without smudging.', 0.40, 'Eraser.jpg', 'Eraser'),
(13, 'Colored Pencils – 12 pcs', 'A set of 12 vibrant, smooth-colored pencils—perfect for school, creative projects, and everyday drawing.', 3.30, 'ColorPencils.webp', 'Colored Pencils'),
(14, 'Mega Marker Pack – 48 Colors', 'A complete set of 48 vibrant, washable markers. Perfect for drawing, coloring, and creative school projects.', 8.70, 'ColorMarkers.webp', 'Markers'),
(15, 'Classic School Backpack - Red', 'Durable and spacious school backpack with multiple compartments, padded shoulder straps for comfort, and reinforced handles. Perfect for carrying books, stationery, and personal items safely throughout the school day.', 35.00, 'RedBack.jpg', 'School Backpack'),
(16, 'Classic School Backpack - Black', 'Durable and spacious school backpack with multiple compartments, padded shoulder straps for comfort, and reinforced handles. Perfect for carrying books, stationery, and personal items safely throughout the school day.', 35.00, 'BlackBag.jpg', 'School Backpack'),
(17, 'Highlighters (Set of 6)', 'Bright and vibrant highlighters in assorted colors. Perfect for emphasizing important notes, textbooks, and documents. Quick-drying ink prevents smudging and ensures clean, clear highlighting every time.', 6.80, 'PackHighlighters.jpg', 'Highlighters'),
(18, 'Yellow Highlighter', 'Essential for students and professionals alike, these highlighters make your notes stand out with bright, long-lasting colors.', 0.90, 'YellowHighlighter.webp', 'Highlighters'),
(19, 'Orange Highlighter', 'Essential for students and professionals alike, these highlighters make your notes stand out with bright, long-lasting colors.', 0.90, 'OrangeHighlighter.webp', 'Highlighters'),
(20, 'Green Highlighter', 'Essential for students and professionals alike, these highlighters make your notes stand out with bright, long-lasting colors.', 0.90, 'GreenHighlighter.webp', 'Highlighters '),
(21, 'Pink Highlighters', 'Essential for students and professionals alike, these highlighters make your notes stand out with bright, long-lasting colors.', 0.90, 'PinkHighlighter.webp', 'Highlighters'),
(22, 'Purple Highlighter', 'Essential for students and professionals alike, these highlighters make your notes stand out with bright, long-lasting colors.', 0.90, 'PurpleHighlighter.webp', 'Highlighters'),
(23, 'Spiral Notebook (A4, 80 pages)', 'Durable spiral notebooks with 80 lined pages, perfect for taking notes in class or organizing your thoughts. The sturdy cover protects your notes while the spiral binding allows easy page turning and flat laying.', 3.70, 'Νotebook.jpg', 'Spiral Notebook'),
(24, 'Spiral Notebook Floral (A4, 80 pages)', 'Durable spiral notebooks with 80 lined pages, perfect for taking notes in class or organizing your thoughts. The sturdy cover protects your notes while the spiral binding allows easy page turning and flat laying.', 3.70, 'BlueFloralNotebook.webp', 'Spiral Notebook'),
(25, 'Daily Agenda Notebook - Blue Color', 'Elegant and practical notebooks designed like planners or agendas. Perfect for organizing your daily tasks, homework, and important notes. These notebooks usually have a hardcover, dated or undated pages, and space for notes and schedules.', 4.80, 'BlueNotebook.webp', 'Planner'),
(26, 'Daily Agenda Notebook - Black Color', 'Elegant and practical notebooks designed like planners or agendas. Perfect for organizing your daily tasks, homework, and important notes. These notebooks usually have a hardcover, dated or undated pages, and space for notes and schedules.', 4.80, 'BlackNotebook.jpg', 'Planner'),
(27, 'Daily Agenda Notebook - Pink Color', 'Elegant and practical notebooks designed like planners or agendas. Perfect for organizing your daily tasks, homework, and important notes. These notebooks usually have a hardcover, dated or undated pages, and space for notes and schedules.', 4.80, 'PinkNotebook.webp', 'Planner'),
(28, 'Daily Agenda Notebook - Green Color', 'Elegant and practical notebooks designed like planners or agendas. Perfect for organizing your daily tasks, homework, and important notes. These notebooks usually have a hardcover, dated or undated pages, and space for notes and schedules.', 4.80, 'GreenNotebook.webp', 'Planner'),
(29, 'Classic School Pencil Case - Blue Color', 'Durable and spacious pencil cases to keep all your school essentials organized. With compartments for pens, pencils, erasers, and more – perfect for daily school use.', 3.99, 'BluePencilCase.webp', 'Pencil Case'),
(30, 'Classic School Pencil Case - White Color', 'Durable and spacious pencil cases to keep all your school essentials organized. With compartments for pens, pencils, erasers, and more – perfect for daily school use. ', 3.99, 'BrownPencilCase.webp', 'Pencil Case'),
(31, 'Classic School Pencil Case - Green Color', 'Durable and spacious pencil cases to keep all your school essentials organized. With compartments for pens, pencils, erasers, and more – perfect for daily school use.', 3.99, 'GreenPencilCase.webp', 'Pencil Case'),
(32, 'Classic School Pencil Case - Pink Color', 'Durable and spacious pencil cases to keep all your school essentials organized. With compartments for pens, pencils, erasers, and more – perfect for daily school use.', 3.99, 'PinkPencilCase.webp', 'Pencil Case');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
