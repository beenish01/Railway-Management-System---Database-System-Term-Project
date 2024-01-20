-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2023 at 04:15 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21500612_traintrac`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`id21500612_traintrac1`@`%` PROCEDURE `Booking1` (IN `trainnum` INT, IN `traindate` DATE, IN `t_category` VARCHAR(255), IN `p_name` VARCHAR(255), IN `p_age` INT, IN `p_sex` CHAR(10), IN `p_address` VARCHAR(255))   BEGIN
  DECLARE seats_available INTEGER;
  DECLARE seats_booked INTEGER;
  DECLARE waiting INTEGER;
  DECLARE p_ticket INTEGER;
  
  SELECT 
    CASE t_category
      WHEN 'AC' THEN total_ac_seats - ac_seats_booked
      WHEN 'general' THEN total_general_seats - general_seats_booked
    END 
    INTO seats_available FROM train_status  WHERE train_number = trainnum AND train_date = traindate;
  
  SELECT COUNT(*) into waiting from passenger where reservation_status='waiting';
  
  SELECT FLOOR(RAND() * 9000 + 1000) INTO p_ticket;
    WHILE (SELECT COUNT(*) FROM Passenger WHERE ticket_id = p_ticket) > 0 DO
      SELECT FLOOR(RAND() * 9000 + 1000) INTO p_ticket;
    END WHILE;
    
  IF seats_available > 0 THEN
      
    INSERT INTO passenger VALUES (p_ticket, trainnum, traindate, p_name, p_age, p_sex, p_address, 'confirmed',t_category);
   
   IF t_category='AC' THEN 
    UPDATE Train_Status SET  ac_seats_booked = ac_seats_booked + 1
    WHERE train_number = trainnum AND train_date = traindate  ;
    
    ELSEIF t_category='general' THEN
    UPDATE Train_Status SET general_seats_booked = general_seats_booked + 1
    WHERE train_number = trainnum AND train_date = traindate;
   END IF;
 
 ELSE
   IF waiting<=1 THEN
     INSERT INTO passenger VALUES (p_ticket,trainnum, traindate, p_name, p_age, p_sex, p_address, 'waiting',t_category);
    END IF;
  END IF;
END$$

CREATE DEFINER=`id21500612_traintrac1`@`%` PROCEDURE `BookTicket` (IN `p_train_number` INT, IN `p_ticket_date` DATE, IN `p_passenger_name` VARCHAR(255), IN `p_age` INT, IN `p_sex` CHAR(1), IN `p_address` VARCHAR(255), IN `p_ticket_category` VARCHAR(255))   BEGIN
    DECLARE available_seats INT;
    DECLARE is_ac_ticket BOOLEAN;

    -- Check if it's an AC ticket
    SELECT IFNULL(ac_fare, 0) INTO is_ac_ticket
    FROM trainlist
    WHERE train_number = p_train_number;

    -- Calculate available seats based on ticket category
    IF is_ac_ticket THEN
        SELECT total_ac_seats - ac_seats_booked INTO available_seats
        FROM train_status
        WHERE train_number = p_train_number AND train_date = p_ticket_date;
    ELSE
        SELECT total_general_seats - general_seats_booked INTO available_seats
        FROM train_status
        WHERE train_number = p_train_number AND train_date = p_ticket_date;
    END IF;

    -- Check seat availability
    IF available_seats > 0 THEN
        -- Insert passenger details into the passenger table
        INSERT INTO passenger (train_number, ticket_date, passenger_name, age, sex, address, reservation_status, ticket_category)
        VALUES (p_train_number, p_ticket_date, p_passenger_name, p_age, p_sex, p_address, 'confirmed', p_ticket_category);

        -- Update the train_status table with the booked seat
        IF is_ac_ticket THEN
            UPDATE train_status
            SET ac_seats_booked = ac_seats_booked + 1
            WHERE train_number = p_train_number AND train_date = p_ticket_date;
        ELSE
            UPDATE train_status
            SET general_seats_booked = general_seats_booked + 1
            WHERE train_number = p_train_number AND train_date = p_ticket_date;
        END IF;

        SELECT 'Ticket booked successfully.' AS result;
    ELSE
        SELECT 'No available seats in the selected category.' AS result;
    END IF;
END$$

CREATE DEFINER=`id21500612_traintrac1`@`%` PROCEDURE `Cancel` (IN `p_ticket_id` INT)   BEGIN
    DECLARE ticket_exists INT;
    DECLARE r_status VARCHAR(255);
    DECLARE train_num INT;
    DECLARE t_category VARCHAR(255);
    DECLARE waiting INT;

    SELECT COUNT(*) INTO ticket_exists FROM Passenger WHERE ticket_id = p_ticket_id;

    IF ticket_exists = 1 THEN
        SELECT reservation_status, train_number, ticket_category INTO r_status, train_num, t_category FROM Passenger WHERE ticket_id = p_ticket_id;

        DELETE FROM Passenger WHERE ticket_id = p_ticket_id;

        SELECT COUNT(*) INTO waiting FROM Passenger WHERE train_number = train_num AND ticket_category = t_category AND reservation_status = 'waiting';

        IF waiting > 0 THEN
            UPDATE Passenger SET reservation_status = 'confirmed'
            WHERE train_number = train_num AND ticket_category = t_category AND reservation_status = 'waiting'
            LIMIT 1;
        ELSEIF r_status = 'confirmed' THEN
            IF t_category = 'AC' THEN
                UPDATE train_status SET ac_seats_booked = ac_seats_booked - 1 WHERE train_number = train_num;
            ELSEIF t_category = 'general' THEN
                UPDATE train_status SET general_seats_booked = general_seats_booked - 1 WHERE train_number = train_num;
            END IF;
        END IF;
    END IF;
END$$

CREATE DEFINER=`id21500612_traintrac1`@`%` PROCEDURE `CheckStatus` (IN `p_ticket_id` INT)   BEGIN
    SELECT tl.train_name, tl.source, tl.destination, p1.* 
    FROM Passenger p1 
    INNER JOIN trainlist tl ON p1.train_number = tl.train_number
    WHERE p1.ticket_id = p_ticket_id;
END$$

CREATE DEFINER=`id21500612_traintrac1`@`%` PROCEDURE `Enquire` (IN `t_source` VARCHAR(255), IN `t_destination` VARCHAR(255))   BEGIN
    SELECT tl.*, ts.train_date, ts.total_ac_seats - ts.ac_seats_booked AS ac_seats_remaining, ts.total_general_seats - ts.general_seats_booked AS general_seats_remaining
    FROM trainlist tl
    INNER JOIN train_status ts ON tl.train_number = ts.train_number
    WHERE tl.source = t_source AND tl.destination = t_destination;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `ticket_id` int(11) NOT NULL,
  `train_number` int(11) NOT NULL,
  `ticket_date` date NOT NULL,
  `passenger_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `reservation_status` varchar(255) NOT NULL,
  `ticket_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`ticket_id`, `train_number`, `ticket_date`, `passenger_name`, `age`, `sex`, `address`, `reservation_status`, `ticket_category`) VALUES
(1234, 1762, '2023-11-20', 'Anna Smith', 31, 'Female', '12-Street, L block, RS Town', 'Confirmed', 'General'),
(1335, 1759, '2023-12-06', 'Beenish Ahmed', 20, 'Female', '245;;;', 'confirm ', 'AC'),
(1777, 1759, '2023-01-12', 'adeeba', 25, 'Female', 'clifton', 'confirmed ', 'AC'),
(1855, 1760, '2023-02-20', 'zohaib', 21, 'Male', 'pechs', 'confirmed', 'General'),
(2125, 1765, '2023-12-23', 'Alice John', 51, 'Female', '212-9th Street,  ASD town', 'Confirmed', 'General'),
(2514, 1767, '2023-10-20', 'Will Smith', 60, 'Male', '2481-9th Street,  ASD town', 'Confirmed', 'AC'),
(2859, 1759, '2023-12-06', 'Sam Smith', 51, 'Male', '12-Street, L block, PRTown', 'Confirmed', 'AC'),
(8760, 1765, '2023-01-07', 'saamia', 21, 'F', 'DHA, Phase 1 Karachi', 'confirmed', 'AC'),
(8764, 1761, '2023-01-06', 'Beenish Ahmed', 21, 'F', 'DHA, Phase 2 Karachi', 'confirmed', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `trainlist`
--

CREATE TABLE `trainlist` (
  `train_number` int(11) NOT NULL,
  `train_name` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `ac_fare` decimal(10,2) NOT NULL,
  `general_fare` decimal(10,2) NOT NULL,
  `weekdays` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainlist`
--

INSERT INTO `trainlist` (`train_number`, `train_name`, `source`, `destination`, `ac_fare`, `general_fare`, `weekdays`) VALUES
(1759, 'Shaheen Express', 'Quetta', 'Karachi', 3500.00, 2300.00, 'Monday, Wednesday, Friday'),
(1760, 'Orange Line Express', 'Peshawar', 'Mardan', 2000.00, 1200.00, 'Monday, Tuesday,Friday'),
(1761, 'Karachi Express', 'Karachi', 'Islamabad', 5000.00, 3500.00, 'Monday, Wednesday, Friday'),
(1762, 'Pindi Express', 'Rawalpindi', 'Multan', 2500.00, 1200.00, 'Tuesday, Thursday'),
(1764, 'Hyderabad Express', 'Hyderabad', 'Sukkur', 2000.00, 1100.00, 'Monday, Wednesday, Friday'),
(1765, 'Khyber Mail', 'Lahore', 'Rawalpindi', 2800.00, 1800.00, 'Tuesday, Thursday, Saturday'),
(1767, 'Express XYZ', 'City X', 'City Y', 2800.00, 1500.00, 'Tuesday, Thursday'),
(1788, 'ABC Express', 'Karachi', 'Islamabad', 2000.00, 1100.00, 'Monday, Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `train_status`
--

CREATE TABLE `train_status` (
  `train_number` int(11) NOT NULL,
  `train_date` date NOT NULL,
  `total_ac_seats` int(11) NOT NULL,
  `total_general_seats` int(11) NOT NULL,
  `ac_seats_booked` int(11) NOT NULL,
  `general_seats_booked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `train_status`
--

INSERT INTO `train_status` (`train_number`, `train_date`, `total_ac_seats`, `total_general_seats`, `ac_seats_booked`, `general_seats_booked`) VALUES
(1759, '2022-12-30', 10, 10, 10, 10),
(1760, '2023-01-06', 10, 10, 6, 9),
(1761, '2022-12-31', 10, 10, 1, 10),
(1762, '2023-01-01', 10, 10, 7, 5),
(1764, '2022-12-30', 10, 10, 9, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `train_number` (`train_number`);

--
-- Indexes for table `trainlist`
--
ALTER TABLE `trainlist`
  ADD PRIMARY KEY (`train_number`);

--
-- Indexes for table `train_status`
--
ALTER TABLE `train_status`
  ADD KEY `train_number` (`train_number`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`train_number`) REFERENCES `trainlist` (`train_number`);

--
-- Constraints for table `train_status`
--
ALTER TABLE `train_status`
  ADD CONSTRAINT `train_status_ibfk_1` FOREIGN KEY (`train_number`) REFERENCES `trainlist` (`train_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
