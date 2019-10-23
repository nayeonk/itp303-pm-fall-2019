-- SELECT everything from tracks table
SELECT * FROM tracks;

-- Display tracks that cost more than 0.99
-- Sort them from shortest to longest in length
-- Display only track id, name, price and length columns
SELECT track_id, name, unit_price, milliseconds
FROM tracks 
WHERE unit_price > 0.99
ORDER BY milliseconds DESC;

-- Display tracks WITH composer
SELECT * FROM tracks
WHERE composer IS NOT NULL;

-- Display tracks that have 'you' or 'day' in their names
SELECT * FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';


-- Display tracks composed by U2 that have 'you' or 'day' in their names
SELECT * FROM tracks
WHERE (name LIKE '%you%' OR name LIKE '%day%') AND composer LIKE '%u2%';


-- Display all albums and artists corresponding to each album.
-- Only show album title and artist name
SELECT albums.title AS album_title, artists.name AS artist_name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;
    
-- Display all Jazz tracks (genre_id = 2 is Jazz)
-- Show track name, genre name, album title, artist name
SELECT track_id, tracks.name, genres.name, albums.title, artists.name
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN albums
	ON tracks.album_id = albums.album_id
JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;



