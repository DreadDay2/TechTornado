-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2023 at 06:58 PM
-- Wersja serwera: 8.0.35-0ubuntu0.20.04.1
-- Wersja PHP: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techtornado`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int NOT NULL,
  `name` text,
  `description` text,
  `price` float DEFAULT NULL,
  `img_url` text,
  `id_kategorie` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `name`, `description`, `price`, `img_url`, `id_kategorie`) VALUES
(1, 'Laptop ASUS VivoBook M1502YA', 'Klawiatura w laptopie ASUS Vivobook 15 została zaprojektowana z myślą o komforcie i wydajności użytkownika. Klawisze są dobrze rozstawione i mają odpowiednią głębokość, co ułatwia pisanie. Dodatkowo, klawiatura ma podświetlenie, dzięki czemu można z niej korzystać nawet w słabych warunkach oświetleniowych.', 2499.99, 'produkt1.jpg', 1),
(2, 'Apple Macbook Pro M3 Max', 'Najnowszy Macbook Pro to wspaniały produkt. Zapewnia wspaniałą wydajność na topowym poziomie i podzespołach. Renomowana marka Apple to bardzo dobry wybór.', 42000, 'produkt2.jpg', 1),
(3, 'Laptop LENOVO IdeaPad Gaming 3', 'Lenovo IdeaPad Gaming 3 to niezwykły laptop, który został stworzony specjalnie dla pasjonatów gier. Dzięki jego niezrównanej wydajności, doskonałej matrycy, krystalicznie czystemu dźwiękowi i efektywnemu systemowi chłodzenia, możesz osiągnąć szczyt swoich możliwości podczas rozgrywki.', 1899.99, 'produkt3.jpg', 1),
(4, 'Laptop HP 250 G9', 'Komputer stacjonarny idealny do pracy w biurze dla kadrowej, sekretarki. Zapewnia obsługę podstawowych programów biurowych pakietu Office 365. Procesor Intel Core i5 w połączeniu z resztą stanowi idealny kompromis między ceną a jakością.', 1299.99, 'produkt4.jpg', 1),
(5, 'Laptop LENOVO Legion 5', 'Poznaj rewolucyjny laptop Lenovo Legion 5 15ARH7, stworzony specjalnie dla wymagających graczy. Wyposażony w procesor AMD Ryzen 7 6800H, zapewnia niesamowitą wydajność podczas długich sesji gamingowych. Doświadcz mocnych wrażeń wizualnych dzięki zaawansowanym procesorom graficznym NVIDIA GeForce RTX 3050 Ti, które umożliwiają wyświetlanie grafiki na poziomie najnowszych gier AAA.', 5000, 'produkt5.jpg', 1),
(6, 'Smartfon Galaxy A23', 'W Galaxy A23 5G obudowa aparatu płynnie przechodzi w matowe wykończenie tylnej ścianki urządzenia, nadając mu stylowy wygląd, jednocześnie pozostaje niezwykle wygodna w korzystaniu. Smartfon jest dostępny w kolorze czarnym, białym, jasnoniebieskim i pomarańczowym.', 1099.99, 'produkt6.jpg', 2),
(7, 'Smartfon INFINIX Note 30 Pro', 'Ciesz się rozrywką każdego rodzaju i korzystaj z wielu aplikacji jednocześnie. INFINIX NOTE 30 Pro napędzany jest procesorem Helio G99 wykonanym w energooszczędnym procesie technologicznym 6 nm, dzięki czemu jest szybki i niezawodny. Smartfon wyposażony jest w 8 GB pamięci RAM, którą możesz wirtualnie rozszerzyć o kolejne 8 GB oraz 256 GB pamięci wbudowanej, którą za pomocą karty microSD możesz powiększyć nawet o 2 TB.', 1199.99, 'produkt7.jpg', 2),
(8, 'Smartfon REALME 11 Pro ', 'Smartfon realme 11 Pro 5G zachwyca swoją wydajnością, zakrzywionym ekranem AMOLED 120 Hz o przekątnej 6,7\" oraz aparatem głównym z matrycą OIS ProLight 100 MP. Korzystanie z podwójnego, bezstratnego zoomu oraz tryb Fotografii Ulicznej 4.0 pozwoli każdemu początkującemu amatorowi fotografii cieszyć się z uchwyconych momentów. ', 1699, 'produkt8.jpg', 2),
(9, 'Smartfon INFINIX Hot 30', 'Dzięki ośmiordzeniowemu procesorowi Helio G88 możesz cieszyć się z szybkości i wydajności podczas korzystania z zaawansowanych programów i gier, bez obaw o jakiekolwiek spowolnienie pracy sprzętu.', 799, 'produkt9.jpg', 2),
(10, 'Smartfon SAMSUNG Galaxy S23', 'Uchwyć noc i dzień. Dzięki zaawansowanemu zestawowi aparatów w [1] smartfonie Galaxy S23 zdjęcia rewelacyjnej jakości zrobisz w dzień i w nocy. Telefon wyposażono w matrycę o wysokiej rozdzielczości 50 MP, piksele, które wyłapują więcej światła i doskonale je utrwalają oraz OIS – optyczną stabilizację obrazu. To wszystko pozwoli Ci rejestrować wyraźne kadry niezależnie od sytuacji.', 4799, 'produkt10.jpg', 2),
(11, 'Monitor ACER Nitro XV240Y', 'Zanurz się w świetlistej perfekcji z monitorem ACER Nitro XV240Y, gdzie szybki czas reakcji na poziomie 1 ms, dzięki technologii Visual Response Boost, stawia w cieniu konkurencję. Pozbądź się efektu rozmycia, smużenia czy ghostingu – teraz każda scena jest kristalicznie ostra, nawet podczas najbardziej dynamicznych akcji. ', 699, 'produkt11.jpg', 3),
(12, 'Monitor SAMSUNG Odyssey G5', 'Ciesz się pulsującymi wrażeniami z gry, jak nigdy dotąd. Przełomowa grafika. Realistyczne szczegóły Ultra-WQHD pozwalają doświadczać światów gier jak nigdy dotąd. Już sam jego rozmiar sprawia, że przypomina wejście do innego świata. Nigdy więcej nie będziesz się martwić ramkami lub kablami pośrodku obrazu, gdy używasz dwóch monitorów obok siebie. Pokonaj każdego wroga, nawet przy maksymalnej prędkości.', 1749, 'produkt12.jpg', 3),
(13, 'Klawiatura LOGITECH MX Keys', 'Ta klawiatura opracowana została z myślą o Twoim komforcie. Wklęsły kształt przycisków wspaniale dostosowuje się do Twoich palców. Satysfakcjonującą reakcję zapewniają zaokrąglone krawędzie niezależnie od tego, gdzie uderzysz w klawisz. Matowa powłoka sprawia, że palce cudownie przemieszczają się po powierzchni klawiszy.', 399, 'produkt13.jpg', 4),
(14, 'Klawiatura STEELSERIES Apex 3 TKL US', 'Korzystaj z klawiatury SteelSeries Apex 3, aby grać w gry na jeszcze wyższym poziomie. Zaprojektowana przez połączenie nowoczesnej technologii SteelSeries z szeroką gamą funkcji dla graczy, zapewni Ci niesamowite wrażenia w każdej rozgrywce.', 249, 'produkt14.jpg', 5),
(15, 'Tablet SAMSUNG Galaxy Tab A9', 'Doświadczaj radości z rozrywki na dużym, jasnym ekranie. Galaxy Tab A9 (8,7\") i A9+ (11\") o wysokiej częstotliwości odświeżania ekranu – 90 Hz w Galaxy Tab A9+ – pozwala zanurzyć się w efektach wizualnych z gładkimi i płynnymi ruchami na ekranie. Nawet kiedy jesteś w słońcu, dobrze widzisz co dzieje się na wyświetlaczu.', 799, 'produkt15.jpg', 6),
(16, 'MacBook Air M1', 'Popularny  Macbook Air to wspaniały produkt. Zapewnia wydajność w codziennych czynnościach cechując się wykonaniem na poziomie premium. Renomowana marka Apple to bardzo dobry wybór.', 4599, 'produkt16.jpg', 1),
(17, 'Smartfon Iphone 14 PRO MAX 128GB', 'Flagowy smartfon od firmy Apple to wspaniały produkt. Zapewnia bezkompromisowe działanie i uchodzi za jeden najlepszych smartfonów na świecie. Renomowana marka Apple to bardzo dobry wybór.', 6498, 'produkt17.jpg', 2),
(18, 'Komputer Stacjonarny Intel Core i5 ', 'Zaprezentuj się z najlepszej strony w świecie cyfrowego wszechświata dzięki naszemu potężnemu komputerowi stacjonarnemu z procesorem Intel Core i5, 8GB pamięci RAM i szybkim dyskiem SSD o pojemności 512GB. To urządzenie, które łączy w sobie potęgę obliczeniową z eleganckim designem, sprawiając, że codzienna praca staje się przyjemnością.', 699, 'produkt18.jpg', 1),
(19, 'Monitor Samsung Oddysey S24', 'Monitor gamignowy firmy Samsung nada się do grania w najnowsze tytuły. Zapewnia odświeżanie 144Hz oraz dużą rozdzielczość. Zakrzywiona matryca oferuje jeszcze lepsze doznania podczas rozgrywki.', 999, 'produkt19.jpg', 3),
(20, 'Klawiatura gamingowa SteelSeries Apex Pro', 'Klawiatura gamingowa firmy SteelSeries jest idealna do grania w gry typu FPS.  Mechaniczne przełączniki zapewniają precyzję w każdym naciśnięciu. Dodatkowa podkładka pod dłonie zapewnia komfort podczas korzystania z niej.', 849.99, 'produkt20.jpg', 4),
(21, 'Myszka Gamingowa SteelSeries Rival 650 Wireless', 'Myszka gamingowa firmy SteelSeries jest idealna do grania w gry typu FPS. Zaawansowany S\r\nsensor optyczny zapewnia precyzję w każdym ruchu. Idealnie wyprofilowana pod rękę oraz bezprzewodowa łączność bez opóźnień. ', 450, 'produkt21.jpg', 4);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_id_kategorie` (`id_kategorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
