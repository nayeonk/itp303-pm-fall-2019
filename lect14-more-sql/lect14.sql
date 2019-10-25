-- Add album 'Fight On' by artist 'Spirit of Troy'
INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276);

-- Check if album got added to albums table
SELECT * FROM albums
ORDER BY album_id DESC;

-- Get the artist_id of 'Spirit of Troy'
SELECT * FROM artists
WHERE name LIKE '%spirit%';
-- There is no artist 'Spirit of Troy' so let's add one
INSERT INTO artists (name)
VALUES ('Spirit of Troy');

-- Update track 'All My Love' composed by E. Schrody to be part of the Fight On album and be composed
-- by Tommy Trojan
UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
WHERE track_id = 3316;

SELECT * FROM tracks
WHERE name = 'All My Love';

-- DELETE the album Fight On
SELECT * FROM albums
WHERE album_id = 348;

DELETE FROM albums
WHERE album_id = 348;

-- Two things that we can do when a record references another record in another table
-- 1) Delete the tracks in Fight On album
-- 2) Nullify the album_id for tracks that use Fight On albums

UPDATE tracks
SET album_id = null
WHERE track_id = 3316;


-- Create a view that displays all albums and their artist names
-- Only show album id, album title, and artist name
CREATE OR REPLACE VIEW album_artists AS
SELECT album_id, title AS album_title, name AS artist_name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;
    
-- "Call" the view
SELECT * FROM album_artists;

-- Delete Views
DROP VIEW album_artists;



-- AGGREGATE FUNCTIONS
-- How many tracks are in my DB
SELECT COUNT(*), COUNT(composer)
FROM tracks;

-- Min/Max/Avg
-- In tracks table, what's the min/max/average/sum milliseconds?
SELECT MAX(milliseconds), MIN(milliseconds), AVG(milliseconds), SUM(milliseconds)
FROM tracks;

-- How long is a specific album?
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 2;

-- Generate random number
SELECT RAND();

-- Order tracks by random, aka shuffling
SELECT * FROM tracks
ORDER BY RAND();

-- How long is the shortest track for EACH album
-- Show the album name
SELECT tracks.album_id, albums.title, MIN(milliseconds)
FROM tracks
JOIN albums
	ON tracks.album_id = albums.album_id
GROUP BY album_id;

-- For each artist, show artists and number of their albums
SELECT albums.artist_id, artists.name, COUNT(*)
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
GROUP BY albums.artist_id;








