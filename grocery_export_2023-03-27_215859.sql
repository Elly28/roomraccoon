CREATE TABLE `grocery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;