-- -------------------------------------------------------------
-- TablePlus 5.9.0(538)
--
-- https://tableplus.com/
--
-- Database: youth
-- Generation Time: 2024-02-19 09:38:09.6990
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `kode_prefix_operator`;
CREATE TABLE `kode_prefix_operator` (
  `kode_prefix` text DEFAULT NULL,
  `operator` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kode_prefix_operator` (`kode_prefix`, `operator`) VALUES
('0811', 'Telkomsel'),
('0812', 'Telkomsel'),
('0813', 'Telkomsel'),
('0821', 'Telkomsel'),
('0822', 'Telkomsel'),
('0823', 'Telkomsel'),
('0851', 'Telkomsel'),
('0852', 'Telkomsel'),
('0853', 'Telkomsel'),
('0819', 'XL'),
('0818', 'XL'),
('0817', 'XL'),
('0859', 'XL'),
('0877', 'XL'),
('0878', 'XL'),
('0816', 'Indosat'),
('0815', 'Indosat'),
('0814', 'Indosat'),
('0858', 'Indosat'),
('0857', 'Indosat'),
('0856', 'Indosat'),
('0855', 'Indosat'),
('0831', 'Axis'),
('0832', 'Axis'),
('0833', 'Axis'),
('0838', 'Axis'),
('0896', 'Tri'),
('0895', 'Tri'),
('0897', 'Tri'),
('0898', 'Tri'),
('0899', 'Tri'),
('0881', 'Smartfren'),
('0882', 'Smartfren'),
('0883', 'Smartfren'),
('0884', 'Smartfren'),
('0885', 'Smartfren'),
('0886', 'Smartfren'),
('0887', 'Smartfren'),
('0888', 'Smartfren'),
('0889', 'Smartfren');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;