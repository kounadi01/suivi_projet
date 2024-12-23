

INSERT INTO `regions` (`id`, `nom_region`) VALUES
(1, 'BOUCLE DU MOUHOUN'),
(2, 'CASCADE'),
(3, 'CENTRE'),
(4, 'CENTRE EST'),
(5, 'CENTRE NORD'),
(6, 'CENTRE OUEST'),
(7, 'CENTRE SUD'),
(8, 'EST'),
(9, 'HAUT BASSINS'),
(10, 'NORD'),
(11, 'PLATEAU CENTRAL'),
(12, 'SAHEL'),
(13, 'SUD OUEST');



INSERT INTO `provinces` (`id`, `nom_province`, `region_id`) VALUES
(1, 'BALE', 1),
(2, 'BANWA', 1),
(3, 'KOSSI', 1),
(4, 'MOUHOUN', 1),
(5, 'NAYALA', 1),
(6, 'SOUROU', 1),
(7, 'COMOE', 2),
(8, 'LERABA', 2),
(9, 'KADIOGO', 3),
(10, 'BOULGOU', 4),
(11, 'KOULPELGO', 4),
(12, 'KOURITENGA', 4),
(13, 'BAM', 5),
(14, 'NAMENTENGA', 5),
(15, 'SANMATENGA', 5),
(16, 'BOULKIEMDE', 6),
(17, 'SANGUIE', 6),
(18, 'SISSILI', 6),
(19, 'ZIRO', 6),
(20, 'BAZEGA', 7),
(21, 'NAHOURI', 7),
(22, 'ZOUNDWEOGO', 7),
(23, 'GNAGNA', 8),
(24, 'GOURMA', 8),
(25, 'KOMONDJARI', 8),
(26, 'KOMPIENGA', 8),
(27, 'TAPOA', 8),
(28, 'HOUET', 9),
(29, 'KENEDOUGOU', 9),
(30, 'TUY', 9),
(31, 'LOROUM', 10),
(32, 'PASSORE', 10),
(33, 'YATENGA', 10),
(34, 'ZONDOMA', 10),
(35, 'GANZOURGOU ', 11),
(36, 'KOURWEOGO', 11),
(37, 'OUBRITENGA', 11),
(38, 'OUDALAN', 12),
(39, 'SENO', 12),
(40, 'SOUM', 12),
(41, 'YAGHA', 12),
(42, 'BOUGOURIBA', 13),
(43, 'IOBA', 13),
(44, 'NOUMBIEL', 13),
(45, 'PONI', 13);


INSERT INTO `communes` (`id`, `nom_commune`, `province_id`) VALUES
(1, 'BAGASSI', 1),
(2, 'BANA', 1),
(3, 'BOROMO', 1),
(4, 'FARA', 1),
(5, 'OURY', 1),
(6, 'PA', 1),
(7, 'POMPOI', 1),
(8, 'POURA', 1),
(9, 'SIBY', 1),
(10, 'YAHO', 1),
(11, 'BALAVE', 2),
(12, 'KOUKA', 2),
(13, 'SAMI', 2),
(14, 'SANABA', 2),
(15, 'SOLENZO', 2),
(16, 'TANSILA', 2),
(17, 'BARANI', 3),
(18, 'BOMBOROKUY', 3),
(19, 'BOURASSO', 3),
(20, 'DJIBASSO', 3),
(21, 'DOKUY', 3),
(22, 'DOUMBALA', 3),
(23, 'KOMBORI', 3),
(24, 'MADOUBA', 3),
(25, 'NOUNA', 3),
(26, 'SONO', 3),
(27, 'BONDOKUY', 4),
(28, 'DEDOUGOU', 4),
(29, 'DOUROULA', 4),
(30, 'KONA', 4),
(31, 'OUARKOYE', 4),
(32, 'SAFANE', 4),
(33, 'TCHERIBA', 4),
(34, 'GASSAN', 5),
(35, 'GOSSINA', 5),
(36, 'KOUGNY', 5),
(37, 'TOMA', 5),
(38, 'YABA', 5),
(39, 'YE', 5),
(40, 'DI', 6),
(41, 'GOMBORO', 6),
(42, 'KASSOUM', 6),
(43, 'KIEMBARA', 6),
(44, 'LANFIERA', 6),
(45, 'LANKOUE', 6),
(46, 'TOENI', 6),
(47, 'TOUGAN', 6),
(48, 'BANFORA', 7),
(49, 'BEREGADOUGOU', 7),
(50, 'MANGODARA', 7),
(51, 'MOUSSODOUGOU', 7),
(52, 'NIANGOLOKO', 7),
(53, 'OUO', 7),
(54, 'SIDERADOUGOU', 7),
(55, 'SOUBAKANIEDOUGOU', 7),
(56, 'TIEFORA', 7),
(57, 'DAKORO', 8),
(58, 'DOUNA', 8),
(59, 'KANKALABA', 8),
(60, 'LOUMANA', 8),
(61, 'NIANKORODOUGOU', 8),
(62, 'OUELENI', 8),
(63, 'SINDOU', 8),
(64, 'WOLONKOTO', 8),
(65, 'KOMKI-IPALA', 9),
(66, 'KOMSILGA', 9),
(67, 'KOUBRI', 9),
(68, 'ARRONDISSEMENT N°1', 9),
(69, 'ARRONDISSEMENT N°2', 9),
(70, 'ARRONDISSEMENT N°3', 9),
(71, 'ARRONDISSEMENT N°4', 9),
(72, 'ARRONDISSEMENT N°5', 9),
(73, 'ARRONDISSEMENT N°6', 9),
(74, 'ARRONDISSEMENT N°7', 9),
(75, 'ARRONDISSEMENT N°8', 9),
(76, 'ARRONDISSEMENT N°9', 9),
(77, 'ARRONDISSEMENT N°10', 9),
(78, 'ARRONDISSEMENT N°11', 9),
(79, 'ARRONDISSEMENT N°12', 9),
(80, 'PABRE', 9),
(81, 'SAABA', 9),
(82, 'TANGHIN DASSOURI', 9),
(83, 'BAGRE', 10),
(84, 'BANE', 10),
(85, 'BEGUEDO', 10),
(86, 'BISSIGA', 10),
(87, 'BITTOU', 10),
(88, 'BOUSSOUMA', 10),
(89, 'GARANGO', 10),
(90, 'KOMTOEGA', 10),
(91, 'NIAOGO', 10),
(92, 'TENKODOGO', 10),
(93, 'ZABRE', 10),
(94, 'ZOAGA', 10),
(95, 'ZONSE', 10),
(96, 'COMIN-YANGA', 11),
(97, 'DOURTENGA', 11),
(98, 'LALGAYE', 11),
(99, 'OUARGAYE', 11),
(100, 'SANGA', 11),
(101, 'SOUDOUGUI', 11),
(102, 'YARGATENGA', 11),
(103, 'YONDE', 11),
(104, 'ANDEMTENGA', 12),
(105, 'BASKOURE', 12),
(106, 'DIALGAYE', 12),
(107, 'GOUNGHIN', 12),
(108, 'KANDO', 12),
(109, 'KOUPELA', 12),
(110, 'POUYTENGA', 12),
(111, 'TENSOBENTENGA', 12),
(112, 'YARGO', 12),
(113, 'BOURZANGA', 13),
(114, 'GUIBARE', 13),
(115, 'KONGOUSSI', 13),
(116, 'NASSERE', 13),
(117, 'ROLLO', 13),
(118, 'ROUKO', 13),
(119, 'SABCE', 13),
(120, 'TIKARE', 13),
(121, 'ZIMTENGA', 13),
(122, 'BOALA', 14),
(123, 'BOULSA', 14),
(124, 'BOUROUM', 14),
(125, 'DARGO', 14),
(126, 'NAGBINGOU', 14),
(127, 'TOUGOURI', 14),
(128, 'YALGO', 14),
(129, 'ZEGUEDEGUIN', 14),
(130, 'BARSALOGHO', 15),
(131, 'BOUSSOUMA', 15),
(132, 'DABLO', 15),
(133, 'KAYA', 15),
(134, 'KORSIMORO', 15),
(135, 'MANE', 15),
(136, 'NAMISSIGUIMA', 15),
(137, 'PENSA', 15),
(138, 'PIBAORE', 15),
(139, 'PISSILA', 15),
(140, 'ZIGA', 15),
(141, 'BINGO', 16),
(142, 'IMASGHO', 16),
(143, 'KINDI', 16),
(144, 'KOKOLOKO', 16),
(145, 'KOUDOUGOU', 16),
(146, 'NANDIALA', 16),
(147, 'NANORO', 16),
(148, 'PELLA', 16),
(149, 'POA', 16),
(150, 'RAMONGO', 16),
(151, 'SABOU', 16),
(152, 'SIGLE', 16),
(153, 'SOAW', 16),
(154, 'SOURGOU', 16),
(155, 'THYOU', 16),
(156, 'DASSA', 17),
(157, 'DIDYR', 17),
(158, 'GODYR', 17),
(159, 'KORDIE', 17),
(160, 'KYON', 17),
(161, 'POUNI', 17),
(162, 'REO', 17),
(163, 'TENADO', 17),
(164, 'ZAMO', 17),
(165, 'ZAWARA', 17),
(166, 'BIEHA', 18),
(167, 'BOURA', 18),
(168, 'LEO', 18),
(169, 'NEBIELIANAYOU', 18),
(170, 'NIABOURI', 18),
(171, 'SILLY', 18),
(172, 'TO', 19),
(173, 'BAKATA', 19),
(174, 'BOUGNOUNOU', 19),
(175, 'CASSOU', 19),
(176, 'DALO', 19),
(177, 'GAO', 19),
(178, 'SAPOUY', 19),
(179, 'DOULOUGOU', 20),
(180, 'GAONGO', 20),
(181, 'IPELCE', 20),
(182, 'KAYAO', 20),
(183, 'KOMBISSIRI', 20),
(184, 'SAPONE', 20),
(185, 'TOECE', 20),
(186, 'GUIARO', 21),
(187, 'PÔ', 21),
(188, 'TIEBELE', 21),
(189, 'ZECCO', 21),
(190, 'ZIOU', 21),
(191, 'BERE', 22),
(192, 'BINDE', 22),
(193, 'GOGO', 22),
(194, 'GOMBOUSSOUGOU', 22),
(195, 'GUIBA', 22),
(196, 'MANGA', 22),
(197, 'NOBERE', 22),
(198, 'BILANGA', 23),
(199, 'BOGANDE', 23),
(200, 'COALLA', 23),
(201, 'LIPTOUGOU', 23),
(202, 'MANI', 23),
(203, 'PIELA', 23),
(204, 'THION', 23),
(205, 'DIABO', 24),
(206, 'DIAPANGOU', 24),
(207, 'FADA N\'GOURMA', 24),
(208, 'MATIACOALI', 24),
(209, 'TIBGA', 24),
(210, 'YAMBA', 24),
(211, 'BARTIBOUGOU', 25),
(212, 'FOUTOURI', 25),
(213, 'GAYERI', 25),
(214, 'KOMPIENGA', 26),
(215, 'MADJOARI', 26),
(216, 'PAMA', 26),
(217, 'BOTOU', 27),
(218, 'DIAPAGA', 27),
(219, 'KANTCHARI', 27),
(220, 'LOGOBOU', 27),
(221, 'NAMOUNOU', 27),
(222, 'PARTIAGA', 27),
(223, 'TAMBAGA', 27),
(224, 'TANSARGA', 27),
(225, 'ARRONDISSEMENT N°1', 28),
(226, 'ARRONDISSEMENT N°2', 28),
(227, 'ARRONDISSEMENT N°3', 28),
(228, 'ARRONDISSEMENT N°4', 28),
(229, 'ARRONDISSEMENT N°5', 28),
(230, 'ARRONDISSEMENT N°6', 28),
(231, 'ARRONDISSEMENT N°7', 28),
(232, 'BAMA', 28),
(233, 'DANDE', 28),
(234, 'FARAMANA', 28),
(235, 'FO', 28),
(236, 'KARANKASSO SAMBLA', 28),
(237, 'KARANKASSO-VIGUE', 28),
(238, 'KOUNDOUGOU', 28),
(239, 'LENA', 28),
(240, 'PADEMA', 28),
(241, 'PENI', 28),
(242, 'SATIRI', 28),
(243, 'TOUSSIANA', 28),
(244, 'BANZON', 29),
(245, 'DJIGOUERA', 29),
(246, 'KANGALA', 29),
(247, 'KAYAN', 29),
(248, 'KOLOKO', 29),
(249, 'KOURIGNON', 29),
(250, 'KOUROUMA', 29),
(251, 'MOROLABA', 29),
(252, 'N\'DOROLA', 29),
(253, 'ORODARA', 29),
(254, 'SAMOGOHIRI', 29),
(255, 'SAMOROGOUAN', 29),
(256, 'SINDO', 29),
(257, 'BEKUY', 30),
(258, 'BEREBA', 30),
(259, 'BONY', 30),
(260, 'FOUNZAN', 30),
(261, 'HOUNDE', 30),
(262, 'KOTI', 30),
(263, 'KOUMBIA', 30),
(264, 'BANH', 31),
(265, 'OUINDIGUI', 31),
(266, 'SOLLE', 31),
(267, 'TITAO', 31),
(268, 'ARBOLE', 32),
(269, 'BAGARE', 32),
(270, 'BOKIN', 32),
(271, 'GOMPONSOM', 32),
(272, 'KIRSI', 32),
(273, 'LA-TODIN', 32),
(274, 'PILIMPIKOU', 32),
(275, 'SAMBA', 32),
(276, 'YAKO', 32),
(277, 'BARGA', 33),
(278, 'KAIN', 33),
(279, 'KALSAKA', 33),
(280, 'KOSSOUKA', 33),
(281, 'KOUMBRI', 33),
(282, 'NAMISSIGUIMA', 33),
(283, 'OUAHIGOUYA', 33),
(284, 'OULA', 33),
(285, 'RAMBO', 33),
(286, 'SEGUENEGA', 33),
(287, 'TANGAYE', 33),
(288, 'THIOU', 33),
(289, 'ZOGORE', 33),
(290, 'BASSI', 34),
(291, 'BOUSSOU', 34),
(292, 'GOURCY', 34),
(293, 'LEBA', 34),
(294, 'TOUGO', 34),
(295, 'BOUDRY', 35),
(296, 'KOGHO', 35),
(297, 'MEGUET', 35),
(298, 'MOGTEDO', 35),
(299, 'SALOGO', 35),
(300, 'ZAM', 35),
(301, 'ZORGHO', 35),
(302, 'ZOUNGOU', 35),
(303, 'BOUSSE', 36),
(304, 'LAYE', 36),
(305, 'NIOU', 36),
(306, 'SOURGOUBILA', 36),
(307, 'TOEGHIN', 36),
(308, 'ABSOUYA', 37),
(309, 'DAPELOGO', 37),
(310, 'LOUMBILA', 37),
(311, 'NAGREONGO', 37),
(312, 'OURGOU-MANEGA', 37),
(313, 'ZINIARE', 37),
(314, 'ZITENGA', 37),
(315, 'DEOU', 38),
(316, 'GOROM-GOROM', 38),
(317, 'MARKOYE', 38),
(318, 'OURSI', 38),
(319, 'TIN-AKOFF', 38),
(320, 'BANI', 39),
(321, 'DORI', 39),
(322, 'FALAGOUNTOU', 39),
(323, 'GORGADJI', 39),
(324, 'SAMPELGA', 39),
(325, 'SEYTENGA', 39),
(326, 'ARBINDA', 40),
(327, 'BARABOULE', 40),
(328, 'DIGUEL', 40),
(329, 'DJIBO', 40),
(330, 'KELBO', 40),
(331, 'KOUTOUGOU', 40),
(332, 'NASSOUMBOU', 40),
(333, 'POBE-MENGAO', 40),
(334, 'TONGOMAYEL', 40),
(335, 'BOUNDORE', 41),
(336, 'MANSILA', 41),
(337, 'SEBBA', 41),
(338, 'SOLHAN', 41),
(339, 'TANKOUGOUNADIE', 41),
(340, 'TITABE', 41),
(341, 'BONDIGUI', 42),
(342, 'DIEBOUGOU', 42),
(343, 'DOLO', 42),
(344, 'IOLONIORO', 42),
(345, 'TIANKOURA', 42),
(346, 'DANO', 43),
(347, 'DISSIN', 43),
(348, 'GUEGUERE', 43),
(349, 'KOPER', 43),
(350, 'NIEGO', 43),
(351, 'ORONKUA', 43),
(352, 'OUESSA', 43),
(353, 'ZAMBO', 43),
(354, 'BATIE', 44),
(355, 'BOUSSOUKOULA', 44),
(356, 'KPUERE', 44),
(357, 'LEGMOIN', 44),
(358, 'MIDEBDO', 44),
(359, 'BOUROUM-BOUROUM', 45),
(360, 'BOUSSERA', 45),
(361, 'DJIGOUE', 45),
(362, 'GAOUA', 45),
(363, 'GBOMBLORA', 45),
(364, 'KAMPTI', 45),
(365, 'LOROPENI', 45),
(366, 'MALBA', 45),
(367, 'NAKO', 45),
(368, 'PERIGBAN', 45);
