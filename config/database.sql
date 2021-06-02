CREATE DATABASE shelter_caps;
USE shelter_caps;

CREATE TABLE  user_auth (
    id_auth int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    _email varchar(50) NOT NULL,
    _passwd varchar(50) NOT NULL,
    _fname varchar(50) NOT NULL,
    _addr text DEFAULT 'SUMATRA UTARA',
    _gender char(1) NOT NULL
);

CREATE TABLE news (
    id_news int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    _timestamp timestamp NOT NULL,
    _title varchar(100) NOT NULL,
    _briefDesc text NOT NULL,
    _linkImage varchar(200) NOT NULL,
    _link varchar(200) NOT NULL,
    _type int(1) NOT NULL
);

INSERT INTO news( _title, _briefDesc, _linkImage, _link, _type) VALUES
(
'Headline: Gunung Semeru Meletus, Awan Panas Guguran Terjadi sejak 1 Januari',
'Gunung Semeru yang terletak di wilayah Kabupaten Lumajang dan Kabupaten Malang, Jawa Timur, 
mengalami erupsi pada Sabtu (16/1/2021) pukul 17.24 WIB. Saat kejadian, Gunung Semeru mengeluarkan 
awan panas guguran (APG) sejauh 4,5 kilometer. Menurut Pusat Vulkanologi dan Mitigasi Bencana dan 
Geologi (PVMBG), guguran awan panas (APG) sudah terjadi sejak 1 Januari 2021.',
'https://asset.kompas.com/crops/6Lk1ZASQKRX8PWH7ONhkcLXdejE=/0x0:1200x800/750x500/data/photo/2021/01/16/6002fd28190cd.jpg',
'https://www.kompas.com/sains/read/2021/01/17/180300523/gunung-semeru-meletus-awan-panas-guguran-terjadi-sejak-1-januari?page=all',
1
),
(
'Headline: Banjir dan Tanah Longsor di Kota Manado Tewaskan 5 Warga',
'Banjir dan tanah longsor terjadi di Kota Manado, Sulawesi Utara diduga terjadi akibat hujan dengan intensitas tinggi dan struktur 
tanah yang labil. Peristiwa tersebut terjadi pada Sabtu (16/1/2021) pukul 15.09 WITA dengan tinggi muka air sekitar 50 sampai 300 sentimeter.',
'https://cdn-2.tstatic.net/tribunnews/foto/bank/images/banjir-tanah-longsor-manado.jpg',
'https://www.tribunnews.com/nasional/2021/01/17/banjir-dan-tanah-longsor-di-kota-manado-tewaskan-5-warga',
1
),
(
'Headline: Longsor Sumedang: 40 Orang Tewas, 1.126 Jiwa Terdampak',
'Sebanyak 40 orang meninggal dunia dan 26 unit rumah mengalami rusak berat akibat bencana tanah longsor di Desa Cihanjuang, Sumedang, 
Jawa Barat pada 9 Januari 2021.Kepala Pelaksana BPBD Jawa Barat Dani Ramdani menyebut ada 1.126 jiwa terdampak akibat bencana longsor tersebut.',
'https://www.cnnindonesia.com/nasional/20210203131442-20-601730/longsor-sumedang-40-orang-tewas-1126-jiwa-terdampak',
'https://www.cnnindonesia.com/nasional/20210203131442-20-601730/longsor-sumedang-40-orang-tewas-1126-jiwa-terdampak',
1
),
(
'Headline: Banjir Kalimantan Selatan: 5 Warga Tewas, 112 Ribu Mengungsi',
'Banjir bandang yang menerjang tujuh kabupaten/kota di Kalimantan Selatan (Kalsel) selama beberapa hari terakhir telah 
menewaskan lima orang dan membuat 112.709 orang lainnya kehilangan tempat tinggal hingga mengungsi.',
'https://akcdn.detik.net.id/visual/2021/01/16/kalsel-tetapkan-status-menjadi-tanggap-darurat-banjir-2_169.jpeg',
'https://www.cnnindonesia.com/nasional/20210117071801-20-594710/banjir-kalimantan-selatan-5-warga-tewas-112-ribu-mengungsi',
1
),
(
'Headline: Mahfud Sebut 135 Kejadian Karhutla Sejak Januari 2021, Kalbar Terbanyak',
'Menteri Koordinator Bidang Politik, Hukum dan Keamanan (Menkopolhukam) Mahfud MD melaporkan adanya 135 kejadian kebakaran lahan 
dan hutan (karhutla) sejak Januari 2021 hingga saat ini. Laporan itu disampaikan Mahfud dalam Rapat Koordinasi Nasional 
Pengendalian Kebakaran Hutan dan Lahan Tahun 2021 di Istana Negara, Senin (22/2/2021).',
'https://asset.kompas.com/crops/UYl1KaVkEVlkp-pIiuABE9uRn4Q=/0x0:999x666/750x500/data/photo/2021/02/22/6033ad680b6f5.jpg',
'https://nasional.kompas.com/read/2021/02/22/20231861/mahfud-sebut-135-kejadian-karhutla-sejak-januari-2021-kalbar-terbanyak',
1
);

INSERT INTO news( _title, _briefDesc, _linkImage, _link, _type) VALUES
(
'Headline: Obat yang Harus Disiapkan Saat Musim Hujan dan Banjir',
'Selain ancaman banjir, musim hujan juga berpotensi menyebabkan penyakit akibat menurunnya daya tahan tubuh.Selain menyiapkan 
jas hujan atau payung, dokter umum di RS Panti Rini Yogyakarta Cresti Chandra Pradelta pun menyarankan agar tiap keluarga menyiapkan beberapa jenis obat-obatan.',
'https://akcdn.detik.net.id/visual/2015/01/14/6cc06589-df89-4fac-bada-47851f9631a3_169.jpg?w=650',
'https://www.cnnindonesia.com/gaya-hidup/20200102151904-255-461887/obat-yang-harus-disiapkan-saat-musim-hujan-dan-banjir',
2
),
(
'Pertolongan Pertama untuk Korban Banjir yang Tenggelam',
'Bencana banjir dapat membahayakan jiwa. Misalnya yang paling umum adalah korban 
tenggelam. Bila hal ini terjadi pada orang di sekitar Anda, lakukanlah pertongan pertama yang tepat.',
'https://cdn.medcom.id/dynamic/content/2020/01/03/1098294/ZpMtYGc34s.jpeg?w=1024',
'https://www.medcom.id/rona/kesehatan/5b2A0XVN-pertolongan-pertama-untuk-korban-banjir-yang-tenggelam',
2
),
(
'Pertolongan Pertama Korban Kebakaran Hutan',
'Kebakaran hutan mengakibatkan kerusakan hutan dan lahan yang akan menimbulkan kerugian ekonomis dan lingkungan. 
Kebakaran hutan dan lahan juga menyebabkan bencana asap yang dapat mengganggu aktivitas dan kesehatan masyarakat sekitar.',
'https://indonesiabaik.id/public/uploads/post/713/1108_Pertolongan_Pertama_Korban_Kebakaran_Hutan-01.jpg',
'https://indonesiabaik.id/infografis/pertolongan-pertama-korban-kebakaran-hutan',
2
),
(
'P3K Akibat Abu Vulkanik',
'Material abu asap vulkanik yang keluar dari gunung berapi memiliki potensi bahaya kesehatan pernapasan. 
Materi mikro yang berterbangan di udara ini sangat mudah untuk bisa masuk ke dalam saluran pernapasan manusia 
dan membawa dampak fatal jika tidak ada pertolongan pertama ataupun lanjutan pada korban.',
'https://image-cdn.medkomtek.com/Sq2Zxt32QzG8uShwfQmv7SpBq6Q=/640x360/smart/filters:quality(75):strip_icc():format(webp)/klikdokter-media-buckets/medias/1454359/original/003632800_1483445801-health_highlights_abu_vulkanik_kelud.jpg',
'https://www.klikdokter.com/info-sehat/read/2695946/p3k-akibat-abu-vulkanik',
2
),
(
'Gunung Merapi Meletus, Ini 5 Langkah Penyelamatan Diri',
'Yogyakarta tampak menyemburkan asap tebal pada pukul 07.43 WIB, Jumat (11/5/2018). Asap tersebut membubung sekitar 500 meter ke angkasa. Warga sekitar yang berada dalam radius 3 kilometer diminta untuk menjauh dari Kawah Gunung Merapi.',
'https://cdn1-production-images-kly.akamaized.net/nnDcioFK_4KT3JyWapcT1K5EVuM=/640x360/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/2208876/original/030395200_1526001076-merapi.jpg',
'https://hellosehat.com/hidup-sehat/pertolongan-pertama/antisipasi-gunung-berapi-meletus/',
2
);

CREATE TABLE report (
    id_report int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Case ID
    _from varchar(100) NOT NULL, -- Email user
    _timestamp timestamp NOT NULL, -- Waktu server
    _method int(1) DEFAULT 1, -- 1 : Web , 2 : Apps
    _type varchar(10) NOT NULL, -- Urgent, Feedback
    _status boolean DEFAULT 0, -- 0 : Belum Selesai , 1 : Selesai
    _msg text NULL, -- Text 
    _response text NULL,  -- Response From Admin
    _photoLink text NULL,
    _currentLocation text NULL
);

CREATE TABLE crisis (
    id_crisis int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    _name varchar(20) NOT NULL,
    _color varchar(10) NOT NULL,
    _severity int(2) NOT NULL
);

CREATE TABLE weather (
    id_weather int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_loc int(3) NOT NULL FOREIGN KEY,
    _temperature float(100) NULL,
    _humidity float(5) NULL,
    _rainfall float(5) NULL,
    _windspeed float(5) NULL
);

CREATE TABLE locations (
    id_loc int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    _name varchar(100) NOT NULL,
    _latitude float(10) NOT NULL,
    _longitude float(10) NOT NULL,
    _parentId int(1) NULL 
);

CREATE TABLE disaster (
    id_disaster int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    _name varchar(100) NOT NULL
);

CREATE TABLE warning (
    id_warn int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    _timestamp timestamp NOT NULL,
    id_loc int(3) NOT NULL,
    id_disaster int(3) NOT NULL,
    id_crisis int(3) NOT NULL,
    _title varchar(100) NOT NULL,
    _desc varchar(200) NOT NULL,
    _imgLink varchar(100) NULL,
    _relatedNewsTimestamp timestamp NULL
);

