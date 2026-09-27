-- ============================================================
--  database/schema.sql  —  CineVault schema with users + movies.
--  Import this into MySQL before using the app.
-- ============================================================

CREATE DATABASE IF NOT EXISTS `cinvault`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `cinvault`;

CREATE TABLE IF NOT EXISTS `users` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(120)    NOT NULL,
  `email`      VARCHAR(190)    NOT NULL,
  `password`   VARCHAR(255)    NOT NULL,
  `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME                 DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `movies` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(180)    NOT NULL,
  `slug`          VARCHAR(190)    NOT NULL,
  `description`   TEXT            NOT NULL,
  `release_year`  SMALLINT UNSIGNED NOT NULL,
  `genre`         VARCHAR(80)     NOT NULL,
  `duration`      VARCHAR(30)     NOT NULL,
  `rating`        DECIMAL(3,1)    NOT NULL DEFAULT 0.0,
  `poster_image`  VARCHAR(255)    NOT NULL,
  `backdrop_image` VARCHAR(255)    NOT NULL,
  `created_at`    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    DATETIME                 DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `movies_slug_unique` (`slug`),
  KEY `idx_movies_genre` (`genre`),
  KEY `idx_movies_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `movies` (`title`, `slug`, `description`, `release_year`, `genre`, `duration`, `rating`, `poster_image`, `backdrop_image`) VALUES
('Midnight Protocol', 'midnight-protocol', 'A renegade analyst uncovers a hidden satellite signal that can rewrite the fate of a city before sunrise.', 2026, 'Action / Thriller', '2h 08m', 8.4, '/assets/images/posters/midnight-protocol.svg', '/assets/images/backdrops/backdrop-midnight-protocol.svg'),
('Neon Horizon', 'neon-horizon', 'In a flooded future metropolis, a courier races across the skyline to deliver a memory that can save the last orbital colony.', 2025, 'Sci‑Fi', '2h 14m', 8.7, '/assets/images/posters/neon-horizon.svg', '/assets/images/backdrops/backdrop-neon-horizon.svg'),
('Last Signal', 'last-signal', 'A ghostly radio operator follows an impossible transmission from the edge of the solar system into a human conspiracy.', 2026, 'Mystery / Drama', '1h 56m', 8.2, '/assets/images/posters/last-signal.svg', '/assets/images/backdrops/backdrop-last-signal.svg'),
('Shadow District', 'shadow-district', 'When the power grid falters, a former detective must infiltrate a hidden district where dreams are being sold like contraband.', 2024, 'Cyberpunk', '2h 03m', 8.5, '/assets/images/posters/shadow-district.svg', '/assets/images/backdrops/backdrop-shadow-district.svg'),
('The Silent Planet', 'the-silent-planet', 'An ambitious geologist discovers a world beneath the desert where the silence itself is alive and listening.', 2027, 'Adventure / Sci‑Fi', '2h 19m', 8.9, '/assets/images/posters/the-silent-planet.svg', '/assets/images/backdrops/backdrop-the-silent-planet.svg'),
('Code Zero', 'code-zero', 'An elite cyber operative learns her mentor has built an emergency AI that can predict every major catastrophe on Earth.', 2025, 'Action / Techno', '1h 48m', 8.1, '/assets/images/posters/code-zero.svg', '/assets/images/backdrops/backdrop-code-zero.svg'),
('Crimson Night', 'crimson-night', 'Beneath a horizon of blood-red storms, a masked vigilante hunts a cult that steals memories from the sleeping.', 2024, 'Fantasy / Action', '2h 11m', 8.3, '/assets/images/posters/crimson-night.svg', '/assets/images/backdrops/backdrop-crimson-night.svg'),
('Beyond the Storm', 'beyond-the-storm', 'After a brutal storm disconnects the world, a lone pilot traces a route through impossible weather to find the missing city.', 2026, 'Adventure / Drama', '2h 02m', 8.6, '/assets/images/posters/beyond-the-storm.svg', '/assets/images/backdrops/backdrop-beyond-the-storm.svg'),
('Digital Eclipse', 'digital-eclipse', 'A startup founder wakes to a world where every digital identity is being rewritten by a hidden eclipse event.', 2025, 'Thriller / Drama', '1h 59m', 7.9, '/assets/images/posters/digital-eclipse.svg', '/assets/images/backdrops/backdrop-digital-eclipse.svg'),
('Final Frequency', 'final-frequency', 'A radio host receives a final broadcast from a vanished crew and must decide whether to stop the signal forever.', 2026, 'Mystery / Sci‑Fi', '2h 06m', 8.4, '/assets/images/posters/final-frequency.svg', '/assets/images/backdrops/backdrop-final-frequency.svg'),
('Dark Orbit', 'dark-orbit', 'Two astronauts stranded in a dead station discover a secret orbiting object that could rewrite human history.', 2023, 'Sci‑Fi / Thriller', '2h 21m', 8.8, '/assets/images/posters/dark-orbit.svg', '/assets/images/backdrops/backdrop-dark-orbit.svg'),
('Zero Hour', 'zero-hour', 'As midnight approaches, a team of specialists must prevent a synthetic apocalypse before the countdown reaches zero.', 2027, 'Action / Sci‑Fi', '2h 12m', 8.7, '/assets/images/posters/zero-hour.svg', '/assets/images/backdrops/backdrop-zero-hour.svg');
