# Riwayat Perubahan — FilmPlus WordPress Theme

## SELESAI (Completed)

### 1. AnimeStream Parity Spec (47 tasks, 28 core selesai)
Semua core non-optional tasks selesai. File yang dimodifikasi:
`inc/anime-meta.php`, `inc/anime-episodes.php`, `inc/part-system.php`,
`single-anime.php`, `series-episode-list.php`, `video.php`, `single.php`,
`inc/anime-generate.php`, `inc/language.php`, `inc/anime-cpt.php`,
`functions.php`, `sidebar.php`, `sidebar-anime.php`, `filmlist.php`

### 2. MAL API v2 Generate
`inc/anime-generate.php` ditulis ulang sepenuhnya.
- AJAX `filmplus_mal_fetch`: server-side, nonce, 24h transient cache, User-Agent header (Cloudflare bypass).
- AJAX `filmplus_mal_apply_media`: sideload poster → Featured Image, `wp_set_object_terms` untuk genres/studio/season server-side.
- JS `inc/panel/js/anime-mal-generate.js` mengisi field client-side.
- Panel tab "TMDb Bot Ayarları" diubah nama menjadi "MyAnimeList", menyimpan `filmplus_mal_client_id`.

### 3. Episode Meta Box
Disederhanakan: Episode number (`ero_episodebaru`), Season (`ero_season`, default 1, multi-season ready), Series searchable AJAX picker (`ero_seri`). Download Link (`indir`) dihapus.

### 4. Download Table
Meta box repeatable baru "Download Links" di `inc/anime-meta.php`, menyimpan `ero_downloads` sebagai array terstruktur `[{quality, size, links:[{host,url}]}]`. JS `inc/panel/js/anime-download.js`. Dirender via `filmplus_episode_download_table()`.

### 5. Series Info Fields Refactored
Key `ero_*`: Image (URL), Big Cover (media picker), Subbed, Japanese, Status, Type, Duration, Score, Release Date (text "Apr 3, 2024"), Total Episodes, Trailer (YouTube ID), MAL ID.
Field dihapus: alttitles, censor, fansub, gallery (dari box), AniList ID. `ero_tayang` diubah dari date → text.

### 6. single.php
Anime episodes dideteksi via `filmplus_episode_series_id()`. Layout episode anime: player → download table → keyword tags → Anime Information box (`<h2>` "Info {title} Subtitle Indonesia") → comments. Sidebar diganti ke `sidebar-anime.php` untuk anime eps. Film Bilgileri lama, addToList, episode list duplikat dihapus.

### 7. video.php
Distrukturisasi ulang: area player lebih dulu → `.butonlar` (Report · Cinema · Download + EPS prev/next) → `.source-switcher`. Part System (`filmplus_episode_sources`) digunakan. addToList dihapus.

### 8. single-anime.php
Rebuild lengkap: header/cover/info table (field `ero_*`), trailer modal (tanpa fancybox), synopsis read-more/less, genres/cast/gallery/episode list (zebra table + date + suffix header), keyword tags (post_tag), Rekomendasi Anime Lainnya (genre-based + fallback), seksi comments. `sidebar.php` digunakan (orientasi anime).

### 9. sidebar.php
Diganti dengan anime sidebar: Popular Anime (ranked widget dengan score, genres, thumbnail) + Genre Anime taxonomy list.

### 10. sidebar-anime.php
File baru: Season/Episode selector panel (multi-season dropdown + episode number buttons, `ero_season` meta) + Popular Anime + Genre Anime.

### 11. filmlist.php
Anime card baru: badge Type (`ero_type`), Eps + Sub badge, ribbon COMPLETED dari `ero_status`. Poster dari episode atau parent anime.

### 12. CPT Anime
Ditambahkan support `comments` + taxonomy `post_tag`. Filter `comments_open` memaksa komentar terbuka untuk anime (retroaktif). Hook `filmplus_anime_force_comments_open`.

### 13. Genre Bug Fix
Genres/studio/season di-assign server-side via `wp_set_object_terms` (bukan client-side tag box). Tag meta boxes untuk genres/studio/season dihapus dari editor anime agar tidak terhapus saat save.

### 14. Login/Sign-up
Tombol guest login/register disembunyikan di `header.php`. Admin profile/logout tetap ada.

### 15. CSS/UX
- Icon margin pada heading.
- Related anime: gap + `border-radius:0` pada poster.
- Episode list: zebra style.
- Popular anime widget: overflow fix.
- Synopsis: read-more/less toggle.
- `border-radius:0` pada `.anime-card .ac-poster`, `.anime-card .ac-poster img`, `.fai-poster`, `.fai-poster img`, `.fai-poster a img`, `.animefull .thumbook .thumb img`.
- `border-radius:0` pada `.filmplus-popular .fp-pop-thumb img`.
- User-select override: `.singlecontent.animefull` dan semua descendant diset `user-select: text !important` untuk mengatasi `user-select: none` dari style.css.

---

## BELUM SELESAI / PERLU TINDAK LANJUT

### 1. Genre "TV" Sisa Data Lama
Taxonomy `genres` pada anime yang di-generate sebelum perbaikan server-side masih terisi "TV" (dari `media_type`).
**Solusi:** User perlu re-Generate setiap anime menggunakan tombol "Generate Data" di editor agar genre di-replace dengan genre MAL yang benar. Kode sudah benar.

### 2. Cache EasyWP
Perubahan mungkin tidak terlihat oleh pengunjung logout hingga cache di-purge.
**Wajib:** Dashboard EasyWP → Clear Cache setelah setiap deployment.

### 3. Optional Property-Based Tests (animestream-parity spec)
17 optional `*` tasks masih `not_started` (2.3–2.9, 3.2–3.10, 4.5–4.6, 6.5–6.6, 7.6). Checkpoint tasks 5 & 8 ditandai `~`. Tidak diperlukan untuk MVP.

### 4. test-provider-independence.php Stale
Mengharapkan 18 field, record sekarang punya 23 (5 parity field ditambahkan). Fix masuk ke optional task 3.2.

### 5. Popular Anime Widget
Saat ini diurut berdasarkan `ero_skor` desc. Tab Weekly/Monthly/All belum diimplementasi (butuh data view-count). Hanya "All" (by score) yang live.

### 6. Homepage Listing
Menampilkan episode posts (tipe `post`). Badge memerlukan parent anime (`ero_seri`). Jika episode tidak punya parent, badge kosong (by design).

### 7. Season/Episode Selector
`ero_season` default 1 untuk semua episode lama (belum di-backfill). Pengelompokan multi-season bekerja setelah `ero_season` diset dengan benar pada episode.

### 8. `edButtons is not defined` JS Error
Error `PozHtml_73_Advenced` (legacy quicktags) muncul di `post-new.php?post_type=anime`. Prioritas rendah, hanya kosmetik.

### 9. SimpleModalLogin Deprecation Warnings
`Creation of dynamic property SimpleModalLogin::$version` (features.php:872). Prioritas rendah, PHP 8.2 deprecation only.

### 10. `theme-options.php` Optional Param Warning
Baris 118, 139. Prioritas rendah.
