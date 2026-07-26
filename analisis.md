analisis lengkapnya:

---

## Analisis Lengkap: Theme AnimeStream by Themesia

---

### 🔍 Identitas Theme

| Atribut | Detail |
|---|---|
| **Nama Resmi** | AnimeStream |
| **Developer** | Themesia (`themesia.com`) |
| **Versi** | 2.2.6 |
| **Theme URI** | `themesia.com/animestream-wordpress-theme` |
| **Text Domain** | `animestream` |
| **Font** | Fira Sans (Google Fonts) |
| **Kategori** | Anime Streaming / Watch Online |

---

### ⚠️ Penemuan Kritis: Core yang Terenkripsi

File `inc/core.php` adalah **ionCube encrypted** — ini adalah penemuan paling penting. Artinya:

- Semua logika inti (admin panel, settings, registrasi CPT, sistem lisensi, class PHP utama) **tidak bisa dibaca atau dimodifikasi**
- Theme ini adalah **produk premium Themesia** yang di-crack/dibagikan ilegal di repo GitHub ini
- Untuk produksi, wajib beli lisensi resminya di Themesia

---

### 🏗️ Arsitektur File

```
animetrim/
├── functions.php           → Filter, shortcode, helper functions
├── inc/
│   ├── core.php            → ⛔ ionCube encrypted (admin, CPT, class)
│   └── hook.php            → Asset enqueue (CSS/JS)
├── embed_sc.php            → 14 shortcode embed video
├── tooltip.php             → Hover tooltip via AJAX
├── style.css               → Main stylesheet
├── single.php              → Halaman episode
├── index.php               → Homepage
├── archive-anime.php       → Halaman daftar anime
├── header.php / footer.php / sidebar.php
└── template-parts/
    ├── header/             → header-1.php, header-2.php
    ├── footer/             → footer-1.php, footer-2.php
    ├── home/               → home-hot.php, home-latest.php, home-blog.php
    ├── single/             → mode-video.php, mode-download.php, series-info.php,
    │                          related-episode.php, related-series.php
    ├── slider/             → slider-1.php, slider-2.php
    ├── style-home/         → style-1.php s/d style-4.php (card variants)
    └── general/            → main.php (card umum)
```

---

### 📦 Custom Post Type & Taxonomi

**CPT yang digunakan:**

| Post Type | Fungsi |
|---|---|
| `anime` | Halaman series anime (judul utama) |
| `post` | Episode (WP post standar, linked ke `anime`) |

**Custom Taxonomi (terdaftar di core.php terenkripsi):**

| Taxonomy | Keterangan |
|---|---|
| `genres` | Genre anime |
| `studio` | Studio produksi |
| `season` | Season tayang (Spring 2024, dll) |
| `network` | TV Network / platform |
| `country` | Negara asal |
| `director` | Sutradara |
| `cast` | Pengisi suara |

---

### 🗂️ Custom Meta Fields (prefix `ero_`)

**Untuk post type `anime` (series):**

| Field Key | Keterangan |
|---|---|
| `ero_japanese` | Judul Jepang |
| `ero_skor` | Rating/Score (numerik) |
| `ero_status` | Status: Ongoing / Completed |
| `ero_tayang` | Tanggal/tahun tayang |
| `ero_durasi` | Durasi per episode |
| `ero_type` | Tipe: TV / Movie / OVA / ONA |
| `ero_episode` | Total episode |
| `ero_sub` | Subtitle: Sub / Dub / Raw |
| `ero_fansub` | Grup fansub |
| `ero_mature` | Konten dewasa (Yes/No) |
| `ero_censor` | Status sensor |
| `ero_hot` | Badge HOT (Yes/No) |
| `ero_latest` | Nomor episode terbaru |
| `ero_latestid` | Post ID episode terbaru |

**Untuk post type `post` (episode):**

| Field Key | Keterangan |
|---|---|
| `ero_seri` | ID post anime induk |
| `ero_episodebaru` | Nomor episode ini |
| `ero_subepisode` | Override sub type per episode |

> **Plugin wajib**: Meta Box (gratis) — semua field menggunakan `rwmb_the_value()`

---

### 🎬 Sistem Video: 14 Shortcode Embed

File `embed_sc.php` mendukung provider berikut:

| Shortcode | Platform |
|---|---|
| `[mp4upload id=""]` | mp4upload.com |
| `[yourupload id=""]` | yourupload.com |
| `[acefile id=""]` | acefile.co |
| `[mirrorace id=""]` | mirrorace.com |
| `[fembed id=""]` | fembed.com |
| `[cloudvideo id=""]` | cloudvideo.tv |
| `[youtube id=""]` | YouTube |
| `[gdrive id=""]` | Google Drive |
| `[dood id=""]` | dood.watch |
| `[okru id=""]` | ok.ru |
| `[mixdrop id=""]` | mixdrop.co |
| `[streamsb id=""]` | StreamSB (sblongvu.com) |
| `[general id="url"]` | Iframe URL bebas |
| `[videohtml id="url" poster=""]` | HTML5 `<video>` native |

---

### 📥 Shortcode Download Box

```
[dl]
  [ttl]Batch Download[/ttl]
  [ddl]
    [link s="Server1" q="720p" l="https://..."]
    [link s="Server2" q="480p" l="https://..."]
  [/ddl]
[/dl]
```

Otomatis tampil favicon domain server via Google Favicon API.

---

### 🎨 Fitur Frontend

**Tampilan & Layout:**
- **Dua style utama**: Style 1 (default) dan Style 2 (dark premium + Swiper slider)
- **4 varian card** untuk listing anime (style-1 s/d style-4)
- **Dark/Light mode toggle** — state disimpan di `localStorage`
- **Dual logo** — logo gelap & logo terang, otomatis switch
- **RTL support** (opsional, via setting)
- **Responsive/mobile friendly**

**Homepage:**
- Hot Anime section (diurutkan berdasarkan `ts_today_view_count`)
- Latest Episodes section
- Random Genres section
- Blog section
- Slot shortcode custom di homepage (`schome`)
- Slot banner iklan: top recommend, top filter, top latest episode
- Announcement banner global

**Halaman Episode:**
- Mode video (player + server switcher)
- Mode download-only (jika tidak ada mirror yang bisa diplay)
- Overlay over-player (iklan/konten sebelum play)
- Expand/collapse player
- Info series di bawah player (score, status, genre, synopsis)
- Navigasi prev/next episode
- Episode list sidebar dengan dropdown
- Related episodes (prev/next)
- Related series (by genre, random)
- Social share (Facebook, Twitter, WhatsApp)
- Badge: HOT, Completed, Sub/Dub type label
- View counter per episode
- Komentar WordPress

**Halaman Anime/Series:**
- Thumbnail + info lengkap
- Episode list (daftar semua episode)
- Badge HOT
- Rating bar visual (score × 10%)
- Tooltip hover (AJAX loaded) — judul, score, durasi, type, genre, status

---

### 📚 Library JavaScript & CSS

| Library | Versi | Fungsi |
|---|---|---|
| jQuery | 3.5.1 | Core (override WP default) |
| Font Awesome | 5.13.0 | Icons |
| Owl Carousel | 2.3.4 | Slider homepage |
| Swiper | 5.4.5 | Slider Style 2 (CDN) |
| qTip2 | 2.2.1 | Tooltip hover |
| Blueimp Gallery | 2.38.0 | Lightbox galeri gambar |
| Fancybox | 3.5.7 | Modal trailer video |
| imagesLoaded | – | Support tooltip |

---

### 🔌 Fitur Admin & Setting (Terenkripsi, disimpulkan dari kode publik)

Dari referensi `get_option('...')` di file publik, setting yang ada:

| Setting Key | Fungsi |
|---|---|
| `genstyle` | Layout 1 atau 2 |
| `defaulttheme` | Dark/Light default |
| `logo` / `logox` | Logo dark / light |
| `tsbreadcrumb` | Aktifkan breadcrumb |
| `tooltip` | Aktifkan tooltip hover |
| `galleryanime` | Aktifkan gallery |
| `traileranime` | Aktifkan trailer fancybox |
| `singlesocial` | Aktifkan share button |
| `relatedepisode` | Tampilkan related episode |
| `relatedseries` | Tampilkan related series |
| `seriesinfo` | Tampilkan info series di episode |
| `episodelist` | Tampilkan daftar episode |
| `disable_surprise` | Tombol random anime |
| `tsrating` | Tampilkan rating |
| `thotupdate` | Jumlah hot anime di homepage |
| `tlatestepisode` | Jumlah latest episode di homepage |
| `stylehot` / `stylelatest` | Style card (1-4) |
| `tsrtl` | Mode RTL |
| `censorx` | Tampilkan info sensor |
| `homerecommend` | Tab rekomendasi di homepage |
| `removecompleted` | Badge completed |
| `removesub` | Badge sub/dub |
| `anngeneral` | Announcement bar global |
| `anntopplayer` | Iklan atas player |
| `themecolor` | Warna tema (meta theme-color) |
| `schome` | Shortcode custom di homepage |
| `ts_view_count` | View counter |
| `thumbdownload` | Thumbnail di mode download |
| `changeslug` | Custom slug CPT anime |
| `blogarchive` | Post per halaman blog |
| `azslug` | A-Z listing |
| `epssub` | Badge sub per episode |
| `tsscriptheader` | Custom script di `<head>` |
| `overplay` | Konten overlay atas player |
| `toprec` / `topf` / `tople` | Slot iklan/banner |

---

### 🧠 PHP Class Tersembunyi (di core.php)

| Class | Kegunaan |
|---|---|
| `GOV_lang` | Sistem terjemahan/i18n, semua label via `GOV_lang::get('key')` |
| `GOV_anime` | Utilitas gambar & data anime |
| `GOV_cache` | Fragment caching (tooltip, dll) |

---

### 🔴 Catatan Penting

1. **Ini adalah theme premium yang di-crack** — untuk produksi wajib beli lisensi resmi di [themesia.com](https://themesia.com) agar mendapat update & support
2. **ionCube Loader wajib** di server untuk menjalankan `inc/core.php`
3. **Meta Box plugin wajib** (versi gratis sudah cukup)
4. Beberapa video provider embed-nya sudah tidak aktif (fembed, streamsb sudah tutup)

---

Ketemu! Ada di `inc/meta.php`. Saya minta maaf atas kesalahan analisis sebelumnya. Mari saya koreksi dan lengkapi:

---

## ✅ Koreksi Analisis: MAL Importer Memang Ada (Built-in)

Fitur ini ada di meta box `series_generate` di `inc/meta.php`. Berikut detail lengkapnya yang saya lewatkan:

---

### 🎯 Meta Box: "Generate Data (from myanimelist.net)"

Tampil di halaman **Edit Post → CPT `anime`**, dengan field:

```
┌─────────────────────────────────────────────────────┐
│  Generate Data (from myanimelist.net)               │
├─────────────────────────────────────────────────────┤
│  URL/ID:  [ 35847 ]                                 │
│  Contoh: myanimelist.net/anime/35847/SSSSGridman    │
│  → Cukup isi angka MAL ID-nya saja                 │
│                                                     │
│  ☑ Generate Cast Images                             │
│                                                     │
│  [ Generate ]  ← tombol dengan data-section="myanimelist" │
└─────────────────────────────────────────────────────┘
```

**Cara kerja:**
1. Buka Edit Post → Anime series
2. Isi MAL ID di field `ero_series_generate` (contoh: `35847`)
3. Centang "Generate Cast Images" jika mau gambar karakter juga ikut diambil
4. Klik tombol **Generate**
5. Sistem otomatis fetch data dari MAL → populate semua field `ero_*`

Logika fetch-nya ada di `inc/core.php` (terenkripsi) dan dipanggil via AJAX dengan `data-section='myanimelist'`.

---

### 🗓️ Fitur Bonus yang Juga Saya Lewatkan: Schedule System

Ada meta box **Schedule** juga di post type `anime`:

| Field | Keterangan |
|---|---|
| `ero_schedule_mode` | Auto / Interval / Manual / Off |
| `ero_schedule_interval` | Jarak rilis per episode dalam hari (default 7) |
| `ero_schedule_manual` | Pilih hari: Senin–Minggu (checkbox) |

Ini sistem jadwal otomatis episode — artinya theme bisa **auto-create atau auto-schedule episode** berdasarkan pola hari tayang. Logikanya juga ada di `inc/core.php`.

---

### 🎭 Fitur Casts yang Juga Terlewat

Meta box **Casts** untuk CPT `anime` dengan struktur group yang clonable:

```
Tiap cast entry berisi:
├── Character (columns 6)
│   ├── Character Name  (class: ts-casts-char-name)
│   ├── Character Image (file_input)
│   └── Character Role
└── Voice Actor (columns 6)
    ├── Cast Name  (class: ts-casts-va-name)
    ├── Cast Image (file_input)
    └── Cast Role
```

Cast Name perlu ditambahkan ke **Cast Taxonomy** untuk bisa diklik sebagai link halaman cast.

---

### 📦 Tambahan Meta Box yang Lengkap (Revisi)

Sekarang gambar lengkap semua meta box di Edit Post:

**Untuk CPT `anime`:**

| Meta Box | Konten |
|---|---|
| **Automatic** | Auto create featured image & category, field image URL |
| **Series Info** | Slider, Big Cover, Sub/Dub, Mature, Hot, Japanese title, Status, Censor, Type, Duration, Score, Release Date, Total Episode, Trailer YouTube ID, Fansub |
| **Gallery** | Upload multiple images (Blueimp lightbox) |
| **Download** | Tab: Input Version (group clone: episode title, resolution, hosting, URL) + Shortcode Version (wysiwyg) |
| **Casts** | Group clone: karakter + voice actor per entry |
| **Generate Data (MAL)** | ⭐ MAL ID input + Generate button + opsi cast images |
| **Schedule** | Mode Auto/Interval/Manual/Off + hari tayang |

**Untuk post type `post` (episode):**

| Meta Box | Konten |
|---|---|
| **Episode** | Sub type, Episode Number, Episode Title, Download URL, Series (select dari anime CPT) |
| **Embed Video** | Tab Input Version (group clone: hostname + embed code) + Shortcode Version (clone textarea) |
| **Download** | Group clone: episode title → resolution → hosting + URL |

---

### 📝 Kesimpulan Koreksi

Fitur MAL importer memang **sudah built-in** di theme ini, bukan harus dibuat dari scratch. Yang saya salah sebelumnya adalah karena fitur ini ada di `inc/meta.php` — file yang tidak saya baca di awal. Satu-satunya bagian yang terenkripsi adalah **logika fetch-nya** (AJAX handler ke MAL API) yang ada di `inc/core.php`.

Jadi untuk menggunakannya, tetap butuh:
- Server dengan **ionCube Loader** (untuk `inc/core.php`)
- **Meta Box plugin** (gratis)
- Lisensi resmi dari Themesia untuk `inc/core.php` bisa berjalan

Belum sepenuhnya. Setelah melihat full tree, ada banyak file penting yang belum dibaca. Mari saya baca semuanya sekarang:Sekarang sudah lengkap. Jawaban jujurnya:

---

## Status Analisis Repository

**Belum sepenuhnya** di analisis sebelumnya. Dari total tree yang baru saya dapatkan, ada **file-file krusial yang terlewat**, termasuk beberapa penemuan sangat penting:

---

### 🚨 Temuan Baru yang Paling Kritis

**1. MAL Importer TIDAK memanggil MAL API secara langsung**

Dari `generate-series.js`, URL yang dipanggil adalah:
```javascript
var url = "https://api.themesia.com/myanimelist/";
jQuery.getJSON(url, {"id": input})
```

Artinya theme ini **memanggil proxy API milik Themesia sendiri**, bukan MAL API langsung. Implikasinya:
- User tidak perlu daftar MAL API key
- Semua request diproxy lewat server Themesia
- Fitur ini hanya berjalan kalau instalasi terverifikasi lisensi Themesia (itulah fungsi `inc/parts/checksum/init.php`)

**Data yang di-populate otomatis dari Themesia API:**

| Field | Target di WP |
|---|---|
| `name` | Post title |
| `synopsis` | Post content |
| `genres` | Taxonomy `genres` |
| `studios` | Taxonomy `studio` |
| `premiered` | Taxonomy `season` |
| `staff` (director) | Taxonomy `director` |
| `casts` (nama VA) | Taxonomy `cast` |
| `alternative_titles` | `ero_japanese` |
| `aired` | `ero_tayang` |
| `score` | `ero_skor` |
| `episodes` | `ero_episode` |
| `image` | `ero_image` |
| `duration` | `ero_durasi` |
| `type` | `ero_type` (select) |
| `status` | `ero_status` (select, otomatis dikonversi) |
| Semua karakter + VA + gambar | Meta box Casts (clone group) |

---

**2. CPT ketiga yang terlewat: `blog`**

Ada 3 CPT, bukan 2:

| CPT | Slug | Keterangan |
|---|---|---|
| `anime` | `/anime/` | Series anime |
| `post` | `/` | Episode |
| **`blog`** | `/blog/` | Halaman berita/artikel |

Dengan taxonomy tambahan `label` khusus untuk CPT blog.

---

**3. Autopick Series saat buat Episode baru**

File `autopick-series.js` menunjukkan fitur tersembunyi: saat admin membuat episode baru, sistem otomatis:
- Memilih Series (`ero_seri`) yang sesuai
- Memilih Category yang sesuai
- Pre-fill title dengan nama series

---

**4. Halaman Schedule dengan Countdown Live**

`page-templates/schedule.php` menunjukkan fitur jadwal yang cukup canggih menggunakan class `GOV_schedule`:
- Tampil per hari (Senin–Minggu)
- Countdown timer real-time (update tiap 60 detik)
- Menghitung next episode berdasarkan mode Auto/Interval/Manual
- Menampilkan apakah episode sudah dipost atau belum
- Di-cache 24 jam via `GOV_cache`
- Menggunakan timezone dari setting WordPress

---

**5. File besar yang belum dibaca isinya**

| File | Ukuran | Status |
|---|---|---|
| `inc/govclass.php` | **795 KB** | Belum dibaca |
| `inc/main.php` | **167 KB** | Belum dibaca |
| `assets/js/search.js` | 17 KB | Belum dibaca |
| `inc/ads.php` | 6.9 KB | Belum dibaca |
| `inc/language.php` + `language.json` | ~17 KB | Belum dibaca |
| `single-anime.php` | 13 KB | Belum dibaca |
| 9 varian card style | ~17 KB total | Baru tahu ada 9 bukan 4 |

`inc/govclass.php` kemungkinan besar berisi semua class PHP utama (`GOV_schedule`, `GOV_bookmark`, `GOV_cache`, dll) dalam versi **tidak terenkripsi** — ini jauh lebih besar dari `inc/core.php` (725KB terenkripsi).

---

Baik, saya sudah mendapat data awal. Sekarang saya baca semua file utama secara sistematis:     Sekarang saya sudah baca semua file penting. Mari saya tulis analisis lengkap beserta perbandingannya:

---

## Analisis Lengkap: FilmPlus (FcsThemes) + TMDB Film Bot Plugin

---

### 🔍 Identitas Theme

| Atribut | Detail |
|---|---|
| **Nama** | FilmPlus |
| **Developer** | FcsThemes (`fcsthemes.com`) |
| **Versi** | 4.1 |
| **Demo** | `demo.fcsthemes.com/filmplus/` |
| **Bahasa Default** | Turki (semua string label hardcoded Bahasa Turki) |
| **Font** | Poppins + Noto Sans (Google Fonts) |
| **Warna** | Dark purple (#0d0340 background, #ffd70d gold accent) |
| **Target Pasar** | Film/Movie (bukan anime), pasar Turki |

---

### ⚠️ Status Lisensi

File `functions.php` menunjukkan theme ini juga **versi crack**:
```php
require "lisans.php";
$lisans["hash"] = ("WarezM"); // tanda crack/nulled
if ($lisans["hash"] !== $lisans_anahtar) {
    exit("Lisans anahtarınız bu site için geçerli değildir.");
}
```
Berbeda dari AnimeStream yang menggunakan ionCube, FilmPlus sudah **di-decode ke plaintext** (semua file bisa dibaca) — kemungkinan di-crack oleh tool decoder `Decoder version: 1.0.0.2`.

---

### 🏗️ Struktur File

```
filmplus/
├── functions.php               → Entry point, register sidebars/menus
├── header.php / footer.php / sidebar.php
├── index.php                   → Homepage
├── single.php                  → Halaman film/episode
├── search.php                  → Halaman hasil pencarian
├── page.php                    → Halaman statis
├── filmlist.php                → Card komponen film (listing)
├── video.php / videoad.php     → Template embed video (tanpa/dengan iklan)
├── slider.php / slider2.php    → Dua varian slider
├── inc/
│   ├── filmplus.php            → Master include file
│   ├── features.php            → Taxonomy, utility functions, Part System
│   ├── language.php            → Semua string i18n sebagai PHP constants
│   ├── widgets.php             → Custom widgets
│   ├── install.php             → Auto-install halaman saat aktivasi tema
│   ├── custom-fields.php       → Native meta boxes (tanpa plugin)
│   ├── seo.php                 → Fungsi SEO (meta tags, OG, canonical)
│   ├── theme-options.php       → Helper theme settings
│   ├── panel/settings.php      → Admin panel UI
│   └── pages/single.php        → Logika halaman single film
├── page-templates/
│   ├── profiledit.php          → Edit profil user
│   ├── arsiv.php               → Arsip film + filter
│   ├── dublaj.php              → Filter film Turkish Dub
│   ├── altyazili.php           → Filter film Turkish Sub
│   └── yerli.php               → Filter film lokal
└── tmdb-film-botu/             → PLUGIN TERPISAH (lihat bagian plugin)
```

---

### 📦 Post Type & Taxonomi

**FilmPlus menggunakan struktur WordPress standar — tidak ada Custom Post Type:**

| Post Type | Slug | Fungsi |
|---|---|---|
| `post` | `/` | Semua konten: film, episode, series |

**Custom Taxonomies (di `inc/features.php`):**

| Taxonomy | Slug | Keterangan |
|---|---|---|
| `ulke` | `/ulke/` | Negara produksi |
| `oyuncu` | `/oyuncu/` | Pemain/Cast |
| `yil` | `/yil/` | Tahun produksi |
| `yonetmen` | `/yonetmen/` | Sutradara |
| `category` (bawaan WP) | `/category/` | Genre film (Action, Drama, dll) + Series grouping |

**Konsep "Series":** Film yang termasuk satu seri dimasukkan ke kategori dengan nama mengandung kata "Serisi" (misal: "Marvel Serisi"). Theme mendeteksi ini di `inc/pages/single.php` dan menampilkan "Serinin Diğer Filmleri" (Film Lain Seri Ini) di sidebar.

---

### 🗂️ Custom Meta Fields

Semua field diimplementasikan **native** dengan WordPress `add_meta_box` — **tidak butuh plugin Meta Box**.

| Field Key | Tipe | Keterangan |
|---|---|---|
| `filmadi` | text | Judul original film |
| `imdb` | text | Skor IMDb |
| `ozet` | textarea | Sinopsis |
| `youtube` | text | URL trailer YouTube |
| `info` | text | Catatan film |
| `cevirinotu` | textarea | Catatan terjemahan/subtitle |
| `indir` | text | Link download |
| `resim` | text | URL poster alternatif |
| `dil` | select | Bahasa: Girilmedi / Turkce Dublaj / Turkce Altyazi / Turkce Altyazi-Dublaj / Ingilizce Altyazi / Altyazisiz / Yerli Film |
| `kalite` | text | Kualitas video (default: 720p) |
| `film_poster` | text (multiple) | Path backdrop gallery (dari TMDB, bisa >1) |
| `filmplus_seotitle` | text | SEO title custom per post |
| `filmplus_seodescription` | textarea | SEO description custom |
| `filmplus_keywords` | text | SEO keywords |

---

### 🎬 Sistem Video: "Part System"

Ini fitur unik FilmPlus. Satu post bisa punya **banyak sumber/mirror** menggunakan fitur multipage bawaan WordPress (`<!--nextpage-->`):

```
Post content:
<!--baslik: Server 1 - 720p-->
[iframe/embed kode video 1]
<!--nextpage-->
<!--baslik: Server 2 - 1080p-->
[iframe/embed kode video 2]
<!--nextpage-->
<!--baslik: Server 3 - Backup-->
[iframe/embed kode video 3]
```

- Setiap "page" = satu sumber video
- Nama sumber dibaca dari `<!--baslik: ...-->`
- Tampil sebagai tab/tombol pilihan server di halaman film
- Penomoran bagian dibaca via `filmplus_part_sistemi()` dan `filmplus_ps()`

---

### 🏷️ Sistem Flag Bahasa

Visual badge otomatis berdasarkan field `dil`:

| Nilai `dil` | Tampilan |
|---|---|
| Turkce Dublaj | 🇹🇷 ikon + "Türkçe Dublaj" |
| Turkce Altyazi | CC ikon + "Türkçe Altyazılı" |
| Ingilizce Altyazi | 🇬🇧 ikon + "İngilizce Altyazılı" |
| Altyazisiz | ikon nosub + "Altyazısız" |
| Turkce Altyazi-Dublaj | Dua ikon + "Dublaj & Altyazı" |
| Yerli Film | 🇹🇷 ikon + "Yerli Film" |

---

### 👤 Sistem User (Lebih Lengkap dari AnimeStream)

FilmPlus punya sistem user yang cukup canggih:

| Fitur | Keterangan |
|---|---|
| **Register/Login** | Modal popup (SimpleModal Login plugin) |
| **Profile page** | `/profil/[username]` |
| **Edit profile** | Page template `profiledit.php` |
| **Favorilerim** | Daftar film favorit |
| **İzleyeceklerim** | Watchlist (akan ditonton) |
| **İzlediklerim** | Riwayat yang sudah ditonton |
| **Add to List** | Tombol dropdown di halaman film |
| **User badges** | Yönetici / Editör / Çevirmen / Kayıtlı Üye / Misafir |
| **Comment system** | Dengan like/dislike per komentar (via plugin CLD) |

---

### 📡 Fitur Admin Panel (dari `get_option` references)

| Setting Key | Fungsi |
|---|---|
| `filmplus_logo` / `filmplus_logo_title` | Logo gambar / text |
| `filmplus_favicon` | Favicon |
| `filmplus_analytics` | Kode analytics (di `<head>`) |
| `filmplus_slider` / `filmplus_slider_tipi` | Aktifkan slider + tipe (tip1/tip2) |
| `filmplus_sayfa_basi` | Post per halaman |
| `filmplus_homepage_pagination` | Pagination di homepage |
| `filmplus_sidebar_show` | Tampilkan/sembunyikan sidebar |
| `filmplus_benzer_show` / `_count` | Film serupa + jumlahnya |
| `filmplus_galeri_show` | Tampilkan galeri backdrop |
| `filmplus_seo_facebook` | Facebook Open Graph |
| `filmplus_seo_field` | Aktifkan custom SEO fields |
| `filmplus_r_a` s/d `filmplus_r_f` | Toggle slot iklan (6 posisi) |
| `filmplus_r_ps` | Page skin ad (kanan-kiri layar) |
| `filmplus_r_h` | Header banner ad |
| `filmplus_r_f` | Footer banner ad (sticky) |
| `filmplus_sosyal` | Link sosial media di footer |
| `filmplus_facebook_id` / `_twitter_id` / `_instagram_id` | URL sosmed |
| `filmplus_footer_left` | Teks footer kiri |
| `filmplus_tmdb_id` | **API Key TMDB** |
| `filmplus_tmdb_title` | Template judul post hasil import |
| `filmplus_tmdb_seo_title` / `_desc` / `_url` | Template SEO hasil import |

---

### 🎨 Fitur Frontend

**Layout:**
- Fixed dark purple color scheme (tidak ada dark/light mode toggle)
- Responsive (breakpoint di 1000px, 1439px, 600px, 450px, 479px)
- Fixed width 1000px desktop, full width mobile
- Optional wide layout (1243px at ≥1440px viewport)

**Homepage:**
- 2 slider varian (slider standar + slider2 dengan Owl Carousel)
- Grid film terbaru
- 4 sidebar zone (atas/bawah homepage, sidebar atas/bawah)
- "Günün Filmi" widget (Film of the Day)

**Halaman Film:**
- Film poster + info (IMDb, genre, sinopsis, pemain, sutradara, tahun, negara)
- Tombol trailer (YouTube modal)
- Part System (pilihan server video)
- Catatan film (`info`)
- Catatan terjemahan (`cevirinotu`)
- Tombol: Facebook Like, Facebook Share, Twitter Share, Like/Dislike
- "Sinema Modu" (layar gelap kecuali video)
- "Hata Bildir" (report error, via WPForms)
- Gallery backdrop (Owl Carousel + Blueimp lightbox)
- Film serupa (Owl Carousel berdasarkan genre)
- Film lain dari seri yang sama (sidebar kanan)
- Tombol Add to List (Favorite/Watchlist/Watched)
- Komentar dengan spoiler support dan nested reply

**Arsip:**
- Filter: genre/kategori, bahasa, tahun, IMDb min, nama film
- Sort: tanggal, IMDb, izlenme (views), beğeni (likes), yorum (comments), alfabet
- A-Z listing
- Halaman khusus: film dublaj, altyazili, yerli

**Pencarian:**
- Live AJAX search (saat mengetik di header)
- Mencari di judul post DAN `filmadi` (original title)

---

### 📚 JS Libraries

| Library | Versi | Fungsi |
|---|---|---|
| jQuery | 3.1.0 | Core |
| Font Awesome | 5.11.2 | Icons (CDN) |
| Bootstrap | 3.3.7 | Hanya di admin TMDB panel |
| Owl Carousel | – | Slider & related films |
| Blueimp Gallery | – | Lightbox gallery |
| SimpleModal Login | – | Login popup |
| twbsPagination | – | Pagination di TMDB panel |
| PerfectScrollbar | – | Custom scrollbar di sidebar |
| ListNav | – | A-Z navigation |

---

## 🔌 Analisis Plugin: TMDB Film Bot v3.0.0

### Cara Kerja End-to-End

```
[Admin] → Menu "TMDB Film Botu" → Sub-menu "Film Ekle"
    ↓
[Ketik nama film] → [Tombol Ara]
    ↓
[JS memanggil TMDB API langsung dari browser]
GET https://api.themoviedb.org/3/search/movie?language=tr-TR&query={nama}&api_key={key}
    ↓
[Tampil grid hasil: poster + judul + tombol Seç/Detay]
    ↓
[Klik Detay → AJAX fetch detail + credits → tampil sinopsis, genre, tahun, pemain, sutradara]
    ↓
[Pilih 1 atau lebih film → klik "Filmi Ekle"]
    ↓
[PHP backend (get-films.php) berjalan]
    ↓ memanggil 4 endpoint TMDB:
  - /movie/{id}?language=tr-TR           → info utama
  - /movie/{id}/credits                  → cast + crew
  - /movie/{id}/videos?language=en-US    → trailer
  - /movie/{id}/images                   → backdrop gallery
  - imdb.com/title/{imdb_id}/            → IMDb score (scraping HTML)
    ↓
[Membuat WordPress post]
[Set semua meta + taxonomi + featured image]
[Redirect atau tampil pesan sukses]
```

### Data yang Di-populate Otomatis

| Data | Sumber | Target WP |
|---|---|---|
| Judul film | TMDB `title` (TR) | Post title (template configurable) |
| Slug post | Configurable template | Post slug |
| Judul original | TMDB `original_title` | Meta `filmadi` |
| Sinopsis | TMDB `overview` (TR) | Meta `ozet` |
| Skor IMDb | **Scraping imdb.com** | Meta `imdb` |
| Trailer | TMDB `videos` → YouTube key | Meta `youtube` |
| Genre | TMDB `genres` | WP `category` (auto-create) |
| Pemain (5 orang) | TMDB `cast[0-4]` | Taxonomy `oyuncu` |
| Sutradara | TMDB `crew` filter Director | Taxonomy `yonetmen` |
| Tahun | TMDB `release_date` (4 chars) | Taxonomy `yil` |
| Negara | TMDB `production_countries` | Taxonomy `ulke` (dengan translate) |
| Poster | TMDB `/w300_and_h450_bestv2/` | WordPress Featured Image (di-download) |
| Gallery backdrop | TMDB `images.backdrops` (maks 8) | Meta `film_poster` (multiple) |
| Bahasa | Dipilih manual oleh admin | Meta `dil` |
| SEO fields | Template configurable | Meta SEO fields |

### Kelebihan vs Kekurangan Plugin

**Kelebihan:**
- Bisa import banyak film sekaligus (pilih multiple, submit satu kali)
- Poster didownload dan disimpan di WP media (bukan link eksternal)
- IMDb score juga di-fetch otomatis (walau dengan scraping)
- Semua kategori/genre dibuat otomatis jika belum ada
- Template judul/SEO yang fleksibel (`{title}`, `{original_title}`, `{yapim_yili}`)
- Bisa simpan sebagai draft dulu sebelum publish

**Kekurangan:**
- **TMDB API key di-expose di JavaScript** (visible di browser inspect → security risk)
- IMDb scraping sangat rapuh (bisa berubah kapan saja)
- Tidak ada fallback jika IMDb ID tidak ditemukan
- Hanya support film (movie), **bukan TV series**
- Hanya ambil 5 pemain pertama
- Hanya ambil 8 backdrop pertama
- Tidak ada opsi batch update (kalau data berubah di TMDB, harus manual)

---

## ⚖️ Perbandingan Langsung: FilmPlus vs AnimeStream

| Aspek | FilmPlus (FcsThemes) | AnimeStream (Themesia) |
|---|---|---|
| **Target konten** | Film/Movie biasa | Anime (series + episode) |
| **Target pasar** | Turki | Global (English) |
| **Post Type** | Standard `post` untuk segalanya | CPT `anime` + standard `post` (episode) + CPT `blog` |
| **Ketergantungan plugin** | Minimal — meta box native, tidak perlu plugin khusus | **Wajib Meta Box plugin** untuk custom fields |
| **Enkripsi core** | Sudah di-decode (plaintext) | ionCube encrypted (`inc/core.php`, `inc/govclass.php`) — harus beli lisensi |
| **Integrasi data eksternal** | TMDB API v3 langsung (user bawa API key sendiri) | Proxy `api.themesia.com` (key milik Themesia, perlu lisensi aktif) |
| **Cara import** | Plugin terpisah (TMDB Film Bot), form di admin | Built-in di Edit Post (meta box Generate Data) |
| **Sistem video** | WordPress multipage "Part System" (mirror per halaman) | 14 shortcode provider (mp4upload, gdrive, youtube, dll) |
| **Manajemen episode** | Tidak ada sistem episode khusus — semua adalah "post" | Dedicated episode meta: nomor, judul, parent series, sub type |
| **Sistem jadwal** | Tidak ada | ✅ Schedule page dengan countdown timer (GOV_schedule) |
| **Dark mode** | ❌ Tidak ada (fixed dark purple) | ✅ Dark/Light toggle dengan localStorage |
| **Bookmark** | ✅ Favorites/Watchlist/Watched (localStorage + AJAX sync) | ✅ Bookmark (localStorage + AJAX) |
| **User system** | ✅ Lengkap: register, login, profile, favorites, watchlist, izlediklerim | ⚠️ Dasar: hanya bookmark |
| **Like/Dislike** | ✅ Ada (via plugin PLD & CLD) | ❌ Tidak ada |
| **Galeri gambar** | ✅ Backdrop dari TMDB (otomatis diimport) | ✅ Upload manual |
| **SEO** | ✅ Built-in (title, desc, keywords, OG, canonical per post) | ⚠️ Bergantung pada `GOV_lang` di core terenkripsi |
| **Style/card variant** | 1 card style fixed | 9 varian card style |
| **Slider** | 2 tipe slider | 2 tipe (Style 1 dengan Owl, Style 2 dengan Swiper) |
| **Bahasa tema** | Semua hardcoded Turki (tidak ada i18n yang mudah diubah) | ✅ Sistem `GOV_lang` + `language.json` |
| **Auto-install** | ✅ Pages otomatis dibuat saat aktivasi | ❌ Manual setup |
| **Iklan / Ad slots** | ✅ 6+ posisi iklan dengan toggle admin | ⚠️ Beberapa slot (terenkripsi) |
| **Page skin (floating ad)** | ✅ Ada (kanan-kiri layar) | ❌ Tidak ada |
| **RTL Support** | ❌ Tidak ada | ✅ Ada (opsional) |
| **Tooltip hover** | ❌ Tidak ada | ✅ qTip2 (AJAX loaded) |
| **A-Z listing** | ✅ Ada | ✅ Ada |
| **Cast detail** | Hanya daftar nama (taxonomy) | ✅ Gambar karakter + voice actor + role (meta box group) |
| **Kemudahan kustomisasi** | ✅ Tinggi (semua plaintext, tidak ada enkripsi) | ❌ Rendah (core terenkripsi, tidak bisa modifikasi logika utama) |

---

### 💡 Kesimpulan Akhir

**FilmPlus cocok untuk:**
- Site streaming film/movie (bukan anime series)
- Developer yang ingin modifikasi bebas (semua source terbuka)
- Yang butuh sistem user lengkap out-of-the-box
- Yang ingin integrasi TMDB dengan API key sendiri

**AnimeStream cocok untuk:**
- Site streaming anime dengan sistem episode terstruktur
- Yang butuh jadwal rilis otomatis
- Multi-style card dan tampilan lebih variatif
- Yang bersedia beli lisensi Themesia (untuk core.php berjalan)

**Jika tujuan kamu** adalah site streaming untuk **konten film Indonesia/Asia** (bukan anime episodik), FilmPlus lebih sesuai karena sistemnya lebih sederhana, bisa dikustomisasi penuh, dan TMDB plugin langsung fungsional. Tapi perlu adaptasi dari Bahasa Turki ke Indonesia di `inc/language.php`.

Strategi Modifikasi FilmPlus untuk Anime Series
Rekomendasi: Pendekatan Hybrid (CPT + Post yang sudah ada)
Ini pendekatan paling clean dan minimal perubahan: tambahkan CPT anime untuk halaman series, gunakan post yang ada untuk episode — persis seperti AnimeStream tapi dengan base FilmPlus.
Yang TIDAK perlu diubah:

Part System untuk video (tetap gunakan, sangat cocok untuk multi-mirror)
Sistem user (Favorites, Watchlist, dll tetap bekerja)
Admin panel, SEO, iklan, slider
TMDB Bot (nanti bisa ganti ke MAL)

Yang perlu ditambah/modifikasi:

CPT anime (series page)
Meta fields untuk series dan episode
Template single-anime.php
Modifikasi single.php (episode page) untuk context series
Modifikasi inc/features.php dan inc/custom-fields.php