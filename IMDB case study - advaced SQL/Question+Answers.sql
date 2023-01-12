USE imdb;

/* Now that you have imported the data sets, let’s explore some of the tables. 
 To begin with, it is beneficial to know the shape of the tables and whether any column has null values.
 Further in this segment, you will take a look at 'movies' and 'genre' tables.*/

-- Segment 1:

-- Q1. Find the total number of rows in each table of the schema?
-- Type your code below:

SELECT table_name, table_rows
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'imdb';

-- Director Mpping has 3867 rows, Genre has 14662 rows, Movie has 7997 rows, Names has 25735 rows, Ratings has 7997 rows, Role Mapping has 15615 rows.

-- Q2. Which columns in the movie table have null values?
-- Type your code below:
-- Case Statements can be used. 
SELECT 
SUM(CASE WHEN id IS NULL THEN 1 ELSE 0 END) AS ID_nulls, 
SUM(CASE WHEN title IS NULL THEN 1 ELSE 0 END) AS title_nulls, 
SUM(CASE WHEN year IS NULL THEN 1 ELSE 0 END) AS year_nulls,
SUM(CASE WHEN date_published IS NULL THEN 1 ELSE 0 END) AS date_published_nulls,
SUM(CASE WHEN duration IS NULL THEN 1 ELSE 0 END) AS duration_nulls,
SUM(CASE WHEN country IS NULL THEN 1 ELSE 0 END) AS country_nulls,
SUM(CASE WHEN worlwide_gross_income IS NULL THEN 1 ELSE 0 END) AS worlwide_gross_income_nulls,
SUM(CASE WHEN languages IS NULL THEN 1 ELSE 0 END) AS languages_nulls,
SUM(CASE WHEN production_company IS NULL THEN 1 ELSE 0 END) AS production_company_nulls
FROM movie;

-- Columns having Null Values: Country, Worlwide_Gross_Income, Languages and Production_Company

-- Now as you can see four columns of the movie table has null values. Let's look at the at the movies released each year. 
-- Q3. Find the total number of movies released each year? How does the trend look month wise? (Output expected)

/* Output format for the first part:

+---------------+-------------------+
| Year			|	number_of_movies|
+-------------------+----------------
|	2017		|	2134			|
|	2018		|		.			|
|	2019		|		.			|
+---------------+-------------------+


Output format for the second part of the question:
+---------------+-------------------+
|	month_num	|	number_of_movies|
+---------------+----------------
|	1			|	 134			|
|	2			|	 231			|
|	.			|		.			|
+---------------+-------------------+ */
-- Type your code below:


-- Movies by year
SELECT year, COUNT(id) as number_of_movies FROM movie GROUP BY year ORDER BY year;
/* Output for the query:
+------+------------------+
| year | number_of_movies |
+------+------------------+
| 2017 |             3052 |
| 2018 |             2944 |
| 2019 |             2001 |
+------+------------------+ */
-- 2017 has High number of movie releases.

-- Movies by month
SELECT MONTH(date_published) AS month_num, COUNT(id) AS number_of_movies FROM movie GROUP BY MONTH(date_published) ORDER BY MONTH(date_published);
/* Output for the query:
+-----------+------------------+
| month_num | number_of_movies |
+-----------+------------------+
|         1 |              804 |
|         2 |              640 |
|         3 |              824 |
|         4 |              680 |
|         5 |              625 |
|         6 |              580 |
|         7 |              493 |
|         8 |              678 |
|         9 |              809 |
|        10 |              801 |
|        11 |              625 |
|        12 |              438 |
+-----------+------------------+
*/

/*The highest number of movies is produced in the month of March.
So, now that you have understood the month-wise trend of movies, let’s take a look at the other details in the movies table. 
We know USA and India produces huge number of movies each year. Lets find the number of movies produced by USA or India for the last year.*/
  
-- Q4. How many movies were produced in the USA or India in the year 2019??
-- Type your code below:

SELECT COUNT(id) AS number_of_movies, year FROM movie WHERE country = 'USA' OR country = 'India' GROUP BY country HAVING year=2019;
/* Output for the query:
+-----------+------------------+
| month_num | number_of_movies |
+-----------+------------------+
|         1 |              804 |
|         2 |              640 |
|         3 |              824 |
|         4 |              680 |
|         5 |              625 |
|         6 |              580 |
|         7 |              493 |
|         8 |              678 |
|         9 |              809 |
|        10 |              801 |
|        11 |              625 |
|        12 |              438 |
+-----------+------------------+ */
-- 1059 movies were produced.


/* USA and India produced more than a thousand movies(you know the exact number!) in the year 2019.
Exploring table Genre would be fun!! 
Let’s find out the different genres in the dataset.*/

-- Q5. Find the unique list of the genres present in the data set?
-- Type your code below:

SELECT DISTINCT genre FROM genre;

-- There are 13 genres in total.

/* So, RSVP Movies plans to make a movie of one of these genres.
Now, wouldn’t you want to know which genre had the highest number of movies produced in the last year?
Combining both the movie and genres table can give more interesting insights. */

-- Q6.Which genre had the highest number of movies produced overall?
-- Type your code below:
-- Below code shows one genre which has the highest number.
SELECT genre, year, COUNT(movie_id) AS number_of_movies FROM genre g
INNER JOIN movie m ON 
g.movie_id = m.id 
WHERE year = 2019 
GROUP BY genre 
ORDER BY number_of_movies DESC LIMIT 1;

-- The Drama Genre has the highest movies.

/* So, based on the insight that you just drew, RSVP Movies should focus on the ‘Drama’ genre. 
But wait, it is too early to decide. A movie can belong to two or more genres. 
So, let’s find out the count of movies that belong to only one genre.*/

-- Q7. How many movies belong to only one genre?
-- Type your code below:

SELECT COUNT(a.movie_id) AS number_of_movies FROM
(SELECT movie_id, COUNT(genre) AS number_of_movies FROM genre GROUP BY movie_id HAVING number_of_movies=1) a;

-- 3289 Movies have one genre associiated to them.


/* There are more than three thousand movies which has only one genre associated with them.
So, this figure appears significant. 
Now, let's find out the possible duration of RSVP Movies’ next project.*/

-- Q8.What is the average duration of movies in each genre? 
-- (Note: The same movie can belong to multiple genres.)


/* Output format:

+---------------+-------------------+
| genre			|	avg_duration	|
+-------------------+----------------
|	thriller	|		105			|
|	.			|		.			|
|	.			|		.			|
+---------------+-------------------+ */
-- Type your code below:

SELECT genre, ROUND(AVG(duration),2) AS avg_duration
FROM genre g
INNER JOIN movie m
ON g.movie_id = m.id
GROUP BY genre
ORDER BY AVG(duration) DESC;

/* Output for the query:
+-----------+--------------+
| genre     | avg_duration |
+-----------+--------------+
| Action    |       112.88 |
| Romance   |       109.53 |
| Crime     |       107.05 |
| Drama     |       106.77 |
| Fantasy   |       105.14 |
| Comedy    |       102.62 |
| Adventure |       101.87 |
| Mystery   |       101.80 |
| Thriller  |       101.58 |
| Family    |       100.97 |
| Others    |       100.16 |
| Sci-Fi    |        97.94 |
| Horror    |        92.72 |
+-----------+--------------+
*/

-- Action Genre has the high duration than Romance followed by Crime.

/* Now you know, movies of genre 'Drama' (produced highest in number in 2019) has the average duration of 106.77 mins.
Lets find where the movies of genre 'thriller' on the basis of number of movies.*/

-- Q9.What is the rank of the ‘thriller’ genre of movies among all the genres in terms of number of movies produced? 
-- (Hint: Use the Rank function)


/* Output format:
+---------------+-------------------+---------------------+
| genre			|		movie_count	|		genre_rank    |	
+---------------+-------------------+---------------------+
|drama			|	2312			|			2		  |
+---------------+-------------------+---------------------+*/
-- Type your code below:

SELECT * from
(	
	SELECT genre, COUNT(movie_id) AS movie_count,
	RANK() OVER (ORDER BY COUNT(movie_id) DESC) AS genre_rank
	FROM genre
	GROUP BY genre
) a
WHERE genre='thriller';

/* Output for the query:
+----------+-------------+------------+
| genre    | movie_count | genre_rank |
+----------+-------------+------------+
| Thriller |        1484 |          3 |
+----------+-------------+------------+
*/

/*Thriller movies is in top 3 among all genres in terms of number of movies
 In the previous segment, you analysed the movies and genres tables. 
 In this segment, you will analyse the ratings table as well.
To start with lets get the min and max values of different columns in the table*/

-- Segment 2:

-- Q10.  Find the minimum and maximum values in  each column of the ratings table except the movie_id column?
/* Output format:
+---------------+-------------------+---------------------+----------------------+-----------------+-----------------+
| min_avg_rating|	max_avg_rating	|	min_total_votes   |	max_total_votes 	 |min_median_rating|min_median_rating|
+---------------+-------------------+---------------------+----------------------+-----------------+-----------------+
|		0		|			5		|	       177		  |	   2000	    		 |		0	       |	8			 |
+---------------+-------------------+---------------------+----------------------+-----------------+-----------------+*/
-- Type your code below:
SELECT MIN(avg_rating) AS min_avg_rating, 
		MAX(avg_rating) AS max_avg_rating,
		MIN(total_votes) AS min_total_votes, 
        MAX(total_votes) AS max_total_votes,
		MIN(median_rating) AS min_median_rating, 
        MAX(median_rating) AS max_median_rating       
FROM ratings;


/* Output for the query:
+----------------+----------------+-----------------+-----------------+-------------------+-------------------+
| min_avg_rating | max_avg_rating | min_total_votes | max_total_votes | min_median_rating | max_median_rating |
+----------------+----------------+-----------------+-----------------+-------------------+-------------------+
|            1.0 |           10.0 |             100 |          725138 |                 1 |                10 |
+----------------+----------------+-----------------+-----------------+-------------------+-------------------+
*/

/* So, the minimum and maximum values in each column of the ratings table are in the expected range. 
This implies there are no outliers in the table. 
Now, let’s find out the top 10 movies based on average rating.*/

-- Q11. Which are the top 10 movies based on average rating?
/* Output format:
+---------------+-------------------+---------------------+
| title			|		avg_rating	|		movie_rank    |
+---------------+-------------------+---------------------+
| Fan			|		9.6			|			5	  	  |
|	.			|		.			|			.		  |
|	.			|		.			|			.		  |
|	.			|		.			|			.		  |
+---------------+-------------------+---------------------+*/
-- Type your code below:
-- It's ok if RANK() or DENSE_RANK() is used too
-- LIMIT clause - Used below.

SELECT title, avg_rating,
DENSE_RANK() OVER(ORDER BY avg_rating DESC) AS movie_rank
FROM movie m
INNER JOIN ratings r
ON r.movie_id = m.id
LIMIT 10;

/* Output for the query:
+--------------------------------+------------+------------+
| title                          | avg_rating | movie_rank |
+--------------------------------+------------+------------+
| Kirket                         |       10.0 |          1 |
| Love in Kilnerry               |       10.0 |          1 |
| Gini Helida Kathe              |        9.8 |          2 |
| Runam                          |        9.7 |          3 |
| Fan                            |        9.6 |          4 |
| Android Kunjappan Version 5.25 |        9.6 |          4 |
| Yeh Suhaagraat Impossible      |        9.5 |          5 |
| Safe                           |        9.5 |          5 |
| The Brighton Miracle           |        9.5 |          5 |
| Shibu                          |        9.4 |          6 |
+--------------------------------+------------+------------+
*/
-- First three top movies have average rating greater or equal than 9.8

/* Do you find you favourite movie FAN in the top 10 movies with an average rating of 9.6? If not, please check your code again!!
So, now that you know the top 10 movies, do you think character actors and filler actors can be from these movies?
Summarising the ratings table based on the movie counts by median rating can give an excellent insight.*/

-- Q12. Summarise the ratings table based on the movie counts by median ratings.
/* Output format:

+---------------+-------------------+
| median_rating	|	movie_count		|
+-------------------+----------------
|	1			|		105			|
|	.			|		.			|
|	.			|		.			|
+---------------+-------------------+ */
-- Type your code below:
-- Order by is good to have

SELECT median_rating, COUNT(movie_id) AS movie_count
FROM ratings
GROUP BY median_rating
ORDER BY median_rating;

/* Output for the query:
+---------------+-------------+
| median_rating | movie_count |
+---------------+-------------+
|             1 |          94 |
|             2 |         119 |
|             3 |         283 |
|             4 |         479 |
|             5 |         985 |
|             6 |        1975 |
|             7 |        2257 |
|             8 |        1030 |
|             9 |         429 |
|            10 |         346 |
+---------------+-------------+
*/

/* Movies with a median rating of 7 is highest in number. 
Now, let's find out the production house with which RSVP Movies can partner for its next project.*/

-- Q13. Which production house has produced the most number of hit movies (average rating > 8)??
/* Output format:
+------------------+-------------------+---------------------+
|production_company|movie_count	       |	prod_company_rank|
+------------------+-------------------+---------------------+
| The Archers	   |		1		   |			1	  	 |
+------------------+-------------------+---------------------+*/
-- Type your code below:
-- Dense Rank Function used

SELECT production_company, COUNT(id) AS movie_count,
DENSE_RANK() OVER(ORDER BY COUNT(id) DESC) AS prod_company_rank
FROM movie AS m
INNER JOIN ratings AS r
ON m.id = r.movie_id
WHERE avg_rating > 8 AND production_company IS NOT NULL
GROUP BY production_company
ORDER BY movie_count DESC;

/* Output for the query:
+-----------------------------------------+-------------+-------------------+
| production_company                      | movie_count | prod_company_rank |
+-----------------------------------------+-------------+-------------------+
| Dream Warrior Pictures                  |           3 |                 1 |
| National Theatre Live                   |           3 |                 1 |
| Lietuvos Kinostudija                    |           2 |                 2 |
| Swadharm Entertainment                  |           2 |                 2 |
| Panorama Studios                        |           2 |                 2 |
| Marvel Studios                          |           2 |                 2 |
| Central Base Productions                |           2 |                 2 |
| Painted Creek Productions               |           2 |                 2 |
| National Theatre                        |           2 |                 2 |
| Colour Yellow Productions               |           2 |                 2 |
| The Archers                             |           1 |                 3 |
| Blaze Film Enterprises                  |           1 |                 3 |
| Bradeway Pictures                       |           1 |                 3 |
| Bert Marcus Productions                 |           1 |                 3 |
| A Studios                               |           1 |                 3 |
| Ronk Film                               |           1 |                 3 |
| Benaras Mediaworks                      |           1 |                 3 |
| Bioscope Film Framers                   |           1 |                 3 |
| Bestwin Production                      |           1 |                 3 |
| Studio Green                            |           1 |                 3 |
| AKS Film Studio                         |           1 |                 3 |
| Kaargo Cinemas                          |           1 |                 3 |
| Animonsta Studios                       |           1 |                 3 |
| O3 Turkey Medya                         |           1 |                 3 |
| StarVision                              |           1 |                 3 |
| Synergy Films                           |           1 |                 3 |
| PVP Cinema                              |           1 |                 3 |
| Plan J Studios                          |           1 |                 3 |
| 20 Steps Productions                    |           1 |                 3 |
| Prime Zero Productions                  |           1 |                 3 |
| Shreya Films International              |           1 |                 3 |
| SLN Cinemas                             |           1 |                 3 |
| Epiphany Entertainments                 |           1 |                 3 |
| 3 Ng Film                               |           1 |                 3 |
| Eastpool Films                          |           1 |                 3 |
| A square productions                    |           1 |                 3 |
| Oak Entertainments                      |           1 |                 3 |
| Doha Film Institute                     |           1 |                 3 |
| Fenrir Films                            |           1 |                 3 |
| Fábrica de Cine                         |           1 |                 3 |
| Chernin Entertainment                   |           1 |                 3 |
| Cross Creek Pictures                    |           1 |                 3 |
| Loaded Dice Films                       |           1 |                 3 |
| WM Films                                |           1 |                 3 |
| Walt Disney Pictures                    |           1 |                 3 |
| Excel Entertainment                     |           1 |                 3 |
| Ancine                                  |           1 |                 3 |
| Twentieth Century Fox                   |           1 |                 3 |
| Ave Fenix Pictures                      |           1 |                 3 |
| Runaway Productions                     |           1 |                 3 |
| Aletheia Films                          |           1 |                 3 |
| 70 MM Entertainments                    |           1 |                 3 |
| Moho Film                               |           1 |                 3 |
| BR Productions and Riding High Pictures |           1 |                 3 |
| Cana Vista Films                        |           1 |                 3 |
| Gurbani Media                           |           1 |                 3 |
| Sony Pictures Entertainment (SPE)       |           1 |                 3 |
| InnoVate Productions                    |           1 |                 3 |
| Saanvi Pictures                         |           1 |                 3 |
| The SPA Studios                         |           1 |                 3 |
| Rotten Productions                      |           1 |                 3 |
| Film Village                            |           1 |                 3 |
| Arka Mediaworks                         |           1 |                 3 |
| Atresmedia Cine                         |           1 |                 3 |
| Goopy Bagha Productions Limited         |           1 |                 3 |
| Maxmedia                                |           1 |                 3 |
| 1234 Cine Creations                     |           1 |                 3 |
| Silent Hills Studio                     |           1 |                 3 |
| Blueprint Pictures                      |           1 |                 3 |
| Archangel Studios                       |           1 |                 3 |
| HI Film Productions                     |           1 |                 3 |
| Tin Drum Beats                          |           1 |                 3 |
| Frío Frío                               |           1 |                 3 |
| Warnuts Entertainment                   |           1 |                 3 |
| Potential Studios                       |           1 |                 3 |
| Adrama                                  |           1 |                 3 |
| Dark Steel Entertainment                |           1 |                 3 |
| Allfilm                                 |           1 |                 3 |
| Nokkhottro Cholochitra                  |           1 |                 3 |
| BOB Film Sweden AB                      |           1 |                 3 |
| Smash Entertainment!                    |           1 |                 3 |
| EFilm                                   |           1 |                 3 |
| Urvashi Theaters                        |           1 |                 3 |
| Angel Capital Film Group                |           1 |                 3 |
| Grass Root Film Company                 |           1 |                 3 |
| Art Movies                              |           1 |                 3 |
| Lost Legends                            |           1 |                 3 |
| Ra.Mo.                                  |           1 |                 3 |
| Avocado Media                           |           1 |                 3 |
| Tigmanshu Dhulia Films                  |           1 |                 3 |
| Think Music                             |           1 |                 3 |
| Anwar Rasheed Entertainment             |           1 |                 3 |
| Dwarakish Chitra                        |           1 |                 3 |
| Anto Joseph Film Company                |           1 |                 3 |
| Dijital Sanatlar Production             |           1 |                 3 |
| Missart produkcija                      |           1 |                 3 |
| Jayanna Combines                        |           1 |                 3 |
| Jar Pictures                            |           1 |                 3 |
| British Muslim TV                       |           1 |                 3 |
| Crossing Bridges Films                  |           1 |                 3 |
| BrightKnight Entertainment              |           1 |                 3 |
| Mirror Images LTD.                      |           1 |                 3 |
| Mango Pickle Entertainment              |           1 |                 3 |
| Detailfilm                              |           1 |                 3 |
| Archway Pictures                        |           1 |                 3 |
| Vehli Janta Films                       |           1 |                 3 |
| Grooters Productions                    |           1 |                 3 |
| Fulwell 73                              |           1 |                 3 |
| Participant                             |           1 |                 3 |
| Madras Enterprises                      |           1 |                 3 |
| Alchemy Vision Workz                    |           1 |                 3 |
| Axess Film Factory                      |           1 |                 3 |
| PRK Productions                         |           1 |                 3 |
| Dashami Studioz                         |           1 |                 3 |
| Fablemaze                               |           1 |                 3 |
| StarFab Production                      |           1 |                 3 |
| RGK Cinema                              |           1 |                 3 |
| Shreyasree Movies                       |           1 |                 3 |
| BRON Studios                            |           1 |                 3 |
| Bhadrakali Pictures                     |           1 |                 3 |
| The Icelandic Filmcompany               |           1 |                 3 |
| The Church of Almighty God Film Center  |           1 |                 3 |
| Maha Sithralu                           |           1 |                 3 |
| Mythri Movie Makers                     |           1 |                 3 |
| Orange Médias                           |           1 |                 3 |
| Mumbai Film Company                     |           1 |                 3 |
| Swapna Cinema                           |           1 |                 3 |
| Vivid Films                             |           1 |                 3 |
| HRX Films                               |           1 |                 3 |
| Wonder Head                             |           1 |                 3 |
| Sixteen by Sixty-Four Productions       |           1 |                 3 |
| Akshar Communications                   |           1 |                 3 |
| Moviee Mill                             |           1 |                 3 |
| Happy Hours Entertainments              |           1 |                 3 |
| M-Films                                 |           1 |                 3 |
| Cineddiction Films                      |           1 |                 3 |
| Heyday Films                            |           1 |                 3 |
| Diamond Works                           |           1 |                 3 |
| Shree Raajalakshmi Films                |           1 |                 3 |
| Dream Tree Film Productions             |           1 |                 3 |
| Cine Sarasavi Productions               |           1 |                 3 |
| Acropolis Entertainment                 |           1 |                 3 |
| RedhanThe Cinema People                 |           1 |                 3 |
| Hombale Films                           |           1 |                 3 |
| Swonderful Pictures                     |           1 |                 3 |
| COMETE Films                            |           1 |                 3 |
| Cinepro Lanka International             |           1 |                 3 |
| Williams 4 Productions                  |           1 |                 3 |
| Touch Wood Multimedia Creations         |           1 |                 3 |
| Rocket Beans Entertainment              |           1 |                 3 |
| Hepifilms                               |           1 |                 3 |
| SRaj Productions                        |           1 |                 3 |
| Kharisma Starvision Plus PT             |           1 |                 3 |
| MD productions                          |           1 |                 3 |
| Ataraxia Entertainment                  |           1 |                 3 |
| NBW Films                               |           1 |                 3 |
| Kannamthanam Films                      |           1 |                 3 |
| Brainbox Studios                        |           1 |                 3 |
| Matchbox Pictures                       |           1 |                 3 |
| Reliance Entertainment                  |           1 |                 3 |
| Neelam Productions                      |           1 |                 3 |
| Jyot & Aagnya Anusaare Productions      |           1 |                 3 |
| Clown Town Productions                  |           1 |                 3 |
| Special Treats Production Company       |           1 |                 3 |
| Mooz Films                              |           1 |                 3 |
| Bulb Chamka                             |           1 |                 3 |
| GreenTouch Entertainment                |           1 |                 3 |
| Crystal Paark Cinemas                   |           1 |                 3 |
| Kangaroo Broadcasting                   |           1 |                 3 |
| Swami Samartha Creations                |           1 |                 3 |
| DreamReality Movies                     |           1 |                 3 |
| Fahadh Faasil and Friends               |           1 |                 3 |
| Narrator                                |           1 |                 3 |
| Kineo Filmproduktion                    |           1 |                 3 |
| Appu Pathu Pappu Production House       |           1 |                 3 |
| Rishab Shetty Films                     |           1 |                 3 |
| Namah Pictures                          |           1 |                 3 |
| Annai Tamil Cinemas                     |           1 |                 3 |
| Viacom18 Motion Pictures                |           1 |                 3 |
| MNC Pictures                            |           1 |                 3 |
| Clyde Vision Films                      |           1 |                 3 |
| Adenium Productions                     |           1 |                 3 |
| Trafalgar Releasing                     |           1 |                 3 |
| Lovely World Entertainment              |           1 |                 3 |
| Hayagriva Movie Adishtana               |           1 |                 3 |
| OPM Cinemas                             |           1 |                 3 |
| Sithara Entertainments                  |           1 |                 3 |
| French Quarter Film                     |           1 |                 3 |
| Mumba Devi Motion Pictures              |           1 |                 3 |
| Fox STAR Studios                        |           1 |                 3 |
| Aries Telecasting                       |           1 |                 3 |
| Abis Studio                             |           1 |                 3 |
| Rapi Films                              |           1 |                 3 |
| Ay Yapim                                |           1 |                 3 |
| Aatpaat Production                      |           1 |                 3 |
| Channambika Films                       |           1 |                 3 |
| Cinenic Film                            |           1 |                 3 |
| The United Team of Art                  |           1 |                 3 |
| Grahalakshmi Productions                |           1 |                 3 |
| Mahesh Manjrekar Movies                 |           1 |                 3 |
| Manikya Productions                     |           1 |                 3 |
| Bombay Walla Films                      |           1 |                 3 |
| Viva Inen Productions                   |           1 |                 3 |
| Banana Film DOOEL                       |           1 |                 3 |
| Toei Animation                          |           1 |                 3 |
| Golden Horse Cinema                     |           1 |                 3 |
| V. Creations                            |           1 |                 3 |
| Moonshot Entertainments                 |           1 |                 3 |
| Humble Motion Pictures                  |           1 |                 3 |
| Coconut Motion Pictures                 |           1 |                 3 |
| Bayview Projects                        |           1 |                 3 |
| Piecewing Productions                   |           1 |                 3 |
| Manyam Productions                      |           1 |                 3 |
| Suresh Productions                      |           1 |                 3 |
| Benzy Productions                       |           1 |                 3 |
| RMCC Productions                        |           1 |                 3 |
+-----------------------------------------+-------------+-------------------+
*/

-- Dream Warrior Pictures and National Theatre Live production houses have movie count as 3 and rank as 1.

-- It's ok if RANK() or DENSE_RANK() is used too
-- Answer can be Dream Warrior Pictures or National Theatre Live or both

-- Q14. How many movies released in each genre during March 2017 in the USA had more than 1,000 votes?
/* Output format:

+---------------+-------------------+
| genre			|	movie_count		|
+-------------------+----------------
|	thriller	|		105			|
|	.			|		.			|
|	.			|		.			|
+---------------+-------------------+ */
-- Type your code below:
SELECT g.genre, COUNT(g.movie_id) AS movie_count
FROM genre g
INNER JOIN ratings r
ON g.movie_id = r.movie_id
INNER JOIN movie m
ON m.id = g.movie_id
WHERE MONTH(date_published)=3 AND year=2017 AND m.country='USA' AND r.total_votes>1000
GROUP BY g.genre
ORDER BY movie_count DESC;

/* Output for the query:
+----------+-------------+
| genre    | movie_count |
+----------+-------------+
| Drama    |          16 |
| Comedy   |           8 |
| Crime    |           5 |
| Horror   |           5 |
| Action   |           4 |
| Sci-Fi   |           4 |
| Thriller |           4 |
| Romance  |           3 |
| Fantasy  |           2 |
| Mystery  |           2 |
| Family   |           1 |
+----------+-------------+
*/

-- Lets try to analyse with a unique problem statement.
-- Q15. Find movies of each genre that start with the word ‘The’ and which have an average rating > 8?
/* Output format:
+---------------+-------------------+---------------------+
| title			|		avg_rating	|		genre	      |
+---------------+-------------------+---------------------+
| Theeran		|		8.3			|		Thriller	  |
|	.			|		.			|			.		  |
|	.			|		.			|			.		  |
|	.			|		.			|			.		  |
+---------------+-------------------+---------------------+*/
-- Type your code below:
SELECT title, avg_rating, genre
FROM genre g
INNER JOIN ratings r
ON g.movie_id = r.movie_id
INNER JOIN movie m
ON m.id = g.movie_id
WHERE title LIKE 'The%' AND avg_rating > 8
ORDER BY avg_rating DESC;

/* Output for the query:
+--------------------------------------+------------+----------+
| title                                | avg_rating | genre    |
+--------------------------------------+------------+----------+
| The Brighton Miracle                 |        9.5 | Drama    |
| The Colour of Darkness               |        9.1 | Drama    |
| The Blue Elephant 2                  |        8.8 | Drama    |
| The Blue Elephant 2                  |        8.8 | Horror   |
| The Blue Elephant 2                  |        8.8 | Mystery  |
| The Irishman                         |        8.7 | Crime    |
| The Irishman                         |        8.7 | Drama    |
| The Mystery of Godliness: The Sequel |        8.5 | Drama    |
| The Gambinos                         |        8.4 | Crime    |
| The Gambinos                         |        8.4 | Drama    |
| Theeran Adhigaaram Ondru             |        8.3 | Action   |
| Theeran Adhigaaram Ondru             |        8.3 | Crime    |
| Theeran Adhigaaram Ondru             |        8.3 | Thriller |
| The King and I                       |        8.2 | Drama    |
| The King and I                       |        8.2 | Romance  |
+--------------------------------------+------------+----------+
*/

-- The Brighton Miracle has highest average rating of 9.5 and also all the movies belong to the top 3 genres.

-- You should also try your hand at median rating and check whether the ‘median rating’ column gives any significant insights.
-- Q16. Of the movies released between 1 April 2018 and 1 April 2019, how many were given a median rating of 8?
-- Type your code below:

SELECT median_rating, COUNT(movie_id) AS movie_count
FROM movie m
INNER JOIN ratings r
ON m.id = r.movie_id
WHERE median_rating = 8 AND date_published BETWEEN '2018-04-01' AND '2019-04-01'
GROUP BY median_rating;

-- There are 361 movies with median rating of 8.

-- Once again, try to solve the problem given below.
-- Q17. Do German movies get more votes than Italian movies? 
-- Hint: Here you have to find the total number of votes for both German and Italian movies.
-- Type your code below:


SELECT total_votes, languages
FROM movie m
INNER JOIN ratings r
ON m.id = r.movie_id
WHERE languages LIKE 'German' OR languages LIKE 'Italian'
GROUP BY languages
ORDER BY total_votes DESC; 

-- German has 4695 votes and Italian has 1684 votes.
-- Answer is Yes

/* Now that you have analysed the movies, genres and ratings tables, let us now analyse another table, the names table. 
Let’s begin by searching for null values in the tables.*/




-- Segment 3:



-- Q18. Which columns in the names table have null values??
/*Hint: You can find null values for individual columns or follow below output format
+---------------+-------------------+---------------------+----------------------+
| name_nulls	|	height_nulls	|date_of_birth_nulls  |known_for_movies_nulls|
+---------------+-------------------+---------------------+----------------------+
|		0		|			123		|	       1234		  |	   12345	    	 |
+---------------+-------------------+---------------------+----------------------+*/
-- Type your code below:

SELECT 
		SUM(CASE WHEN name IS NULL THEN 1 ELSE 0 END) AS name_nulls, 
		SUM(CASE WHEN height IS NULL THEN 1 ELSE 0 END) AS height_nulls,
		SUM(CASE WHEN date_of_birth IS NULL THEN 1 ELSE 0 END) AS date_of_birth_nulls,
		SUM(CASE WHEN known_for_movies IS NULL THEN 1 ELSE 0 END) AS known_for_movies_nulls
FROM names;

/* Output for the query:
+------------+--------------+---------------------+------------------------+
| name_nulls | height_nulls | date_of_birth_nulls | known_for_movies_nulls |
+------------+--------------+---------------------+------------------------+
|          0 |        17335 |               13431 |                  15226 |
+------------+--------------+---------------------+------------------------+
*/

/* There are no Null value in the column 'name'.
The director is the most important person in a movie crew. 
Let’s find out the top three directors in the top three genres who can be hired by RSVP Movies.*/

-- Q19. Who are the top three directors in the top three genres whose movies have an average rating > 8?
-- (Hint: The top three genres would have the most number of movies with an average rating > 8.)
/* Output format:

+---------------+-------------------+
| director_name	|	movie_count		|
+---------------+-------------------|
|James Mangold	|		4			|
|	.			|		.			|
|	.			|		.			|
+---------------+-------------------+ */
-- Type your code below:
WITH top_3_genres AS
(
    SELECT     genre AS Genre,
    Count(m.id) AS Movie_Count ,
    Rank() OVER(ORDER BY Count(m.id) DESC) AS Genre_Rank
    FROM movie AS m
    INNER JOIN genre AS g
    ON g.movie_id = m.id
    INNER JOIN ratings AS r
    ON r.movie_id = m.id
    WHERE avg_rating > 8
    GROUP BY genre limit 3 
)
SELECT n.NAME AS Director_Name ,
    Count(d.movie_id) AS Movie_Count
FROM director_mapping  AS d
INNER JOIN genre G
using (movie_id)
INNER JOIN names AS n
ON n.id = d.name_id
INNER JOIN top_3_genres
using (genre)
INNER JOIN ratings
using (movie_id)
WHERE avg_rating > 8
GROUP BY NAME
ORDER BY movie_count DESC limit 3 ;


/* Output for the query:
+---------------+-------------+
| Director_Name | Movie_Count |
+---------------+-------------+
| James Mangold |           4 |
| Anthony Russo |           3 |
| Soubin Shahir |           3 |
+---------------+-------------+
*/

-- James Mangold leads with 4 movies followed by Anthony Russo and Soubin Shahir with 3 movies each. 

/* James Mangold can be hired as the director for RSVP's next project. Do you remeber his movies, 'Logan' and 'The Wolverine'. 
Now, let’s find out the top two actors.*/

-- Q20. Who are the top two actors whose movies have a median rating >= 8?
/* Output format:

+---------------+-------------------+
| actor_name	|	movie_count		|
+-------------------+----------------
|Christain Bale	|		10			|
|	.			|		.			|
+---------------+-------------------+ */
-- Type your code below:

SELECT DISTINCT name AS actor_name, COUNT(r.movie_id) AS movie_count
FROM ratings r
INNER JOIN role_mapping rm
ON rm.movie_id = r.movie_id
INNER JOIN names n
ON rm.name_id = n.id
WHERE median_rating >= 8 AND category = 'actor'
GROUP BY name
ORDER BY movie_count DESC
LIMIT 2;

/* Output for the query:
+------------+-------------+
| actor_name | movie_count |
+------------+-------------+
| Mammootty  |           8 |
| Mohanlal   |           5 |
+------------+-------------+
*/


-- Mammootty has 8 movies and Mohanlal has 5 movies having rating >=8

/* Have you find your favourite actor 'Mohanlal' in the list. If no, please check your code again. 
RSVP Movies plans to partner with other global production houses. 
Let’s find out the top three production houses in the world.*/

-- Q21. Which are the top three production houses based on the number of votes received by their movies?
/* Output format:
+------------------+--------------------+---------------------+
|production_company|vote_count			|		prod_comp_rank|
+------------------+--------------------+---------------------+
| The Archers		|		830			|		1	  		  |
|	.				|		.			|			.		  |
|	.				|		.			|			.		  |
+-------------------+-------------------+---------------------+*/
-- Type your code below:
SELECT production_company, SUM(total_votes) AS vote_count,
		DENSE_RANK() OVER(ORDER BY SUM(total_votes) DESC) AS prod_comp_rank
FROM movie AS m
INNER JOIN ratings r
ON m.id = r.movie_id
GROUP BY production_company
LIMIT 3;

/* Output for the query:
+-----------------------+------------+----------------+
| production_company    | vote_count | prod_comp_rank |
+-----------------------+------------+----------------+
| Marvel Studios        |    2656967 |              1 |
| Twentieth Century Fox |    2411163 |              2 |
| Warner Bros.          |    2396057 |              3 |
+-----------------------+------------+----------------+
*/

/*Yes Marvel Studios rules the movie world.
So, these are the top three production houses based on the number of votes received by the movies they have produced.

Since RSVP Movies is based out of Mumbai, India also wants to woo its local audience. 
RSVP Movies also wants to hire a few Indian actors for its upcoming project to give a regional feel. 
Let’s find who these actors could be.*/

-- Q22. Rank actors with movies released in India based on their average ratings. Which actor is at the top of the list?
-- Note: The actor should have acted in at least five Indian movies. 
-- (Hint: You should use the weighted average based on votes. If the ratings clash, then the total number of votes should act as the tie breaker.)

/* Output format:
+---------------+-------------------+---------------------+----------------------+-----------------+
| actor_name	|	total_votes		|	movie_count		  |	actor_avg_rating 	 |actor_rank	   |
+---------------+-------------------+---------------------+----------------------+-----------------+
|	Yogi Babu	|			3455	|	       11		  |	   8.42	    		 |		1	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
+---------------+-------------------+---------------------+----------------------+-----------------+*/
-- Type your code below:
SELECT name AS actor_name, total_votes,
    COUNT(m.id) as movie_count,
    ROUND(SUM(avg_rating*total_votes)/SUM(total_votes),2) AS actor_avg_rating,
    RANK() OVER(ORDER BY avg_rating DESC) AS actor_rank	
FROM movie m 
INNER JOIN ratings r 
ON m.id = r.movie_id 
INNER JOIN role_mapping rm 
ON m.id=rm.movie_id 
INNER JOIN names nm 
ON rm.name_id=nm.id
WHERE category='actor' AND country= 'india'
GROUP BY name
HAVING COUNT(m.id)>=5
LIMIT 1;
/* Output for the query:
+------------------+-------------+-------------+------------------+------------+
| actor_name       | total_votes | movie_count | actor_avg_rating | actor_rank |
+------------------+-------------+-------------+------------------+------------+
| Vijay Sethupathi |       20364 |           5 |             8.42 |          1 |
+------------------+-------------+-------------+------------------+------------+
*/


-- Top actor is Vijay Sethupathi

-- Q23.Find out the top five actresses in Hindi movies released in India based on their average ratings? 
-- Note: The actresses should have acted in at least three Indian movies. 
-- (Hint: You should use the weighted average based on votes. If the ratings clash, then the total number of votes should act as the tie breaker.)
/* Output format:
+---------------+-------------------+---------------------+----------------------+-----------------+
| actress_name	|	total_votes		|	movie_count		  |	actress_avg_rating 	 |actress_rank	   |
+---------------+-------------------+---------------------+----------------------+-----------------+
|	Tabu		|			3455	|	       11		  |	   8.42	    		 |		1	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
+---------------+-------------------+---------------------+----------------------+-----------------+*/
-- Type your code below:

SELECT name AS actress_name, total_votes,
    COUNT(m.id) AS movie_count,
    ROUND(SUM(avg_rating*total_votes)/SUM(total_votes),2) AS actress_avg_rating,
    RANK() OVER(ORDER BY avg_rating DESC) AS actress_rank		
FROM movie m 
INNER JOIN ratings r 
ON m.id = r.movie_id 
INNER JOIN role_mapping rm 
ON m.id=rm.movie_id 
INNER JOIN names nm 
ON rm.name_id=nm.id
WHERE category='actress' AND country='india' AND languages='hindi'
GROUP BY name
HAVING COUNT(m.id)>=3
LIMIT 1;

/* Output for the query:
+---------------+-------------+-------------+--------------------+--------------+
| actress_name  | total_votes | movie_count | actress_avg_rating | actress_rank |
+---------------+-------------+-------------+--------------------+--------------+
| Taapsee Pannu |        2269 |           3 |               7.74 |            1 |
+---------------+-------------+-------------+--------------------+--------------+
*/

/* Taapsee Pannu tops with average rating 7.74. 
Now let us divide all the thriller movies in the following categories and find out their numbers.*/


/* Q24. Select thriller movies as per avg rating and classify them in the following category: 

			Rating > 8: Superhit movies
			Rating between 7 and 8: Hit movies
			Rating between 5 and 7: One-time-watch movies
			Rating < 5: Flop movies
--------------------------------------------------------------------------------------------*/
-- Type your code below:
SELECT title,
	CASE WHEN avg_rating > 8 THEN 'Superhit movies'
	    WHEN avg_rating BETWEEN 7 AND 8 THEN 'Hit movies'
        WHEN avg_rating BETWEEN 5 AND 7 THEN 'One-time-watch movies'
		WHEN avg_rating < 5 THEN 'Flop movies'
		END AS avg_rating_category
FROM movie m
INNER JOIN genre g
ON m.id=g.movie_id
INNER JOIN ratings r
ON m.id=r.movie_id
WHERE genre='thriller';



/* Until now, you have analysed various tables of the data set. 
Now, you will perform some tasks that will give you a broader understanding of the data in this segment.*/

-- Segment 4:

-- Q25. What is the genre-wise running total and moving average of the average movie duration? 
-- (Note: You need to show the output table in the question.) 
/* Output format:
+---------------+-------------------+---------------------+----------------------+
| genre			|	avg_duration	|running_total_duration|moving_avg_duration  |
+---------------+-------------------+---------------------+----------------------+
|	comdy		|			145		|	       106.2	  |	   128.42	    	 |
|		.		|			.		|	       .		  |	   .	    		 |
|		.		|			.		|	       .		  |	   .	    		 |
|		.		|			.		|	       .		  |	   .	    		 |
+---------------+-------------------+---------------------+----------------------+*/
-- Type your code below:
SELECT genre,
	ROUND(AVG(duration),2) AS avg_duration,
    SUM(ROUND(AVG(duration),2)) OVER(ORDER BY genre ROWS UNBOUNDED PRECEDING) AS running_total_duration,
    AVG(ROUND(AVG(duration),2)) OVER(ORDER BY genre ROWS 10 PRECEDING) AS moving_avg_duration
FROM movie m 
INNER JOIN genre g 
ON m.id= g.movie_id
GROUP BY genre
ORDER BY genre;

/* Output for the query:
+-----------+--------------+------------------------+---------------------+
| genre     | avg_duration | running_total_duration | moving_avg_duration |
+-----------+--------------+------------------------+---------------------+
| Action    |       112.88 |                 112.88 |          112.880000 |
| Adventure |       101.87 |                 214.75 |          107.375000 |
| Comedy    |       102.62 |                 317.37 |          105.790000 |
| Crime     |       107.05 |                 424.42 |          106.105000 |
| Drama     |       106.77 |                 531.19 |          106.238000 |
| Family    |       100.97 |                 632.16 |          105.360000 |
| Fantasy   |       105.14 |                 737.30 |          105.328571 |
| Horror    |        92.72 |                 830.02 |          103.752500 |
| Mystery   |       101.80 |                 931.82 |          103.535556 |
| Others    |       100.16 |                1031.98 |          103.198000 |
| Romance   |       109.53 |                1141.51 |          103.773636 |
| Sci-Fi    |        97.94 |                1239.45 |          102.415455 |
| Thriller  |       101.58 |                1341.03 |          102.389091 |
+-----------+--------------+------------------------+---------------------+
*/
-- Round is good to have and not a must have; Same thing applies to sorting


-- Let us find top 5 movies of each year with top 3 genres.

-- Q26. Which are the five highest-grossing movies of each year that belong to the top three genres? 
-- (Note: The top 3 genres would have the most number of movies.)

/* Output format:
+---------------+-------------------+---------------------+----------------------+-----------------+
| genre			|	year			|	movie_name		  |worldwide_gross_income|movie_rank	   |
+---------------+-------------------+---------------------+----------------------+-----------------+
|	comedy		|			2017	|	       indian	  |	   $103244842	     |		1	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
+---------------+-------------------+---------------------+----------------------+-----------------+*/
-- Type your code below:

-- Top 3 Genres based on most number of movies
WITH t3genre AS
( 	
	SELECT genre, COUNT(movie_id) AS number_of_movies
    FROM genre g
    INNER JOIN movie m
    ON g.movie_id = m.id
    GROUP BY genre
    ORDER BY COUNT(movie_id) DESC
    LIMIT 3
),

top5 AS
(
	SELECT genre,
			year,
			title AS movie_name,
			worlwide_gross_income,
			DENSE_RANK() OVER(PARTITION BY year ORDER BY worlwide_gross_income DESC) AS movie_rank
        
	FROM movie m 
    INNER JOIN genre g 
    ON m.id= g.movie_id
	WHERE genre IN (SELECT genre FROM t3genre)
)

SELECT *
FROM top5
WHERE movie_rank<=5;


/* Output for the query:
+----------+------+----------------------------+-----------------------+------------+
| genre    | year | movie_name                 | worlwide_gross_income | movie_rank |
+----------+------+----------------------------+-----------------------+------------+
| Drama    | 2017 | Shatamanam Bhavati         | INR 530500000         |          1 |
| Drama    | 2017 | Winner                     | INR 250000000         |          2 |
| Drama    | 2017 | Thank You for Your Service | $ 9995692             |          3 |
| Comedy   | 2017 | The Healer                 | $ 9979800             |          4 |
| Drama    | 2017 | The Healer                 | $ 9979800             |          4 |
| Thriller | 2017 | Gi-eok-ui bam              | $ 9968972             |          5 |
| Thriller | 2018 | The Villain                | INR 1300000000        |          1 |
| Drama    | 2018 | Antony & Cleopatra         | $ 998079              |          2 |
| Comedy   | 2018 | La fuitina sbagliata       | $ 992070              |          3 |
| Drama    | 2018 | Zaba                       | $ 991                 |          4 |
| Comedy   | 2018 | Gung-hab                   | $ 9899017             |          5 |
| Thriller | 2019 | Prescience                 | $ 9956                |          1 |
| Thriller | 2019 | Joker                      | $ 995064593           |          2 |
| Drama    | 2019 | Joker                      | $ 995064593           |          2 |
| Comedy   | 2019 | Eaten by Lions             | $ 99276               |          3 |
| Comedy   | 2019 | Friend Zone                | $ 9894885             |          4 |
| Drama    | 2019 | Nur eine Frau              | $ 9884                |          5 |
+----------+------+----------------------------+-----------------------+------------+
*/

-- Finally, let’s find out the names of the top two production houses that have produced the highest number of hits among multilingual movies.
-- Q27.  Which are the top two production houses that have produced the highest number of hits (median rating >= 8) among multilingual movies?
/* Output format:
+-------------------+-------------------+---------------------+
|production_company |movie_count		|		prod_comp_rank|
+-------------------+-------------------+---------------------+
| The Archers		|		830			|		1	  		  |
|	.				|		.			|			.		  |
|	.				|		.			|			.		  |
+-------------------+-------------------+---------------------+*/
-- Type your code below:
SELECT production_company,
	COUNT(m.id) AS movie_count,
    ROW_NUMBER() OVER(ORDER BY count(id) DESC) AS prod_comp_rank
FROM movie m 
INNER JOIN ratings r 
ON m.id=r.movie_id
WHERE median_rating>=8 AND production_company IS NOT NULL AND POSITION(',' IN languages)>0
GROUP BY production_company
LIMIT 2;


/* Output for the query:
+-----------------------+-------------+----------------+
| production_company    | movie_count | prod_comp_rank |
+-----------------------+-------------+----------------+
| Star Cinema           |           7 |              1 |
| Twentieth Century Fox |           4 |              2 |
+-----------------------+-------------+----------------+
*/

-- Multilingual is the important piece in the above question. It was created using POSITION(',' IN languages)>0 logic
-- If there is a comma, that means the movie is of more than one language


-- Q28. Who are the top 3 actresses based on number of Super Hit movies (average rating >8) in drama genre?
/* Output format:
+---------------+-------------------+---------------------+----------------------+-----------------+
| actress_name	|	total_votes		|	movie_count		  |actress_avg_rating	 |actress_rank	   |
+---------------+-------------------+---------------------+----------------------+-----------------+
|	Laura Dern	|			1016	|	       1		  |	   9.60			     |		1	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
|		.		|			.		|	       .		  |	   .	    		 |		.	       |
+---------------+-------------------+---------------------+----------------------+-----------------+*/
-- Type your code below:

SELECT name, SUM(total_votes) AS total_votes,
	COUNT(rm.movie_id) AS movie_count,
	avg_rating,
    DENSE_RANK() OVER(ORDER BY avg_rating DESC) AS actress_rank
FROM names n
INNER JOIN role_mapping rm
ON n.id = rm.name_id
INNER JOIN ratings r
ON r.movie_id = rm.movie_id
INNER JOIN genre g
ON r.movie_id = g.movie_id
WHERE category = 'actress' AND avg_rating > 8 AND genre = 'drama'
GROUP BY name
LIMIT 3;

/* Output for the query:
+-----------------+-------------+-------------+------------+--------------+
| name            | total_votes | movie_count | avg_rating | actress_rank |
+-----------------+-------------+-------------+------------+--------------+
| Sangeetha Bhat  |        1010 |           1 |        9.6 |            1 |
| Fatmire Sahiti  |        3932 |           1 |        9.4 |            2 |
| Adriana Matoshi |        3932 |           1 |        9.4 |            2 |
+-----------------+-------------+-------------+------------+--------------+
*/

/* Q29. Get the following details for top 9 directors (based on number of movies)
Director id
Name
Number of movies
Average inter movie duration in days
Average movie ratings
Total votes
Min rating
Max rating
total movie durations

Format:
+---------------+-------------------+---------------------+----------------------+--------------+--------------+------------+------------+----------------+
| director_id	|	director_name	|	number_of_movies  |	avg_inter_movie_days |	avg_rating	| total_votes  | min_rating	| max_rating | total_duration |
+---------------+-------------------+---------------------+----------------------+--------------+--------------+------------+------------+----------------+
|nm1777967		|	A.L. Vijay		|			5		  |	       177			 |	   5.65	    |	1754	   |	3.7		|	6.9		 |		613		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
|	.			|		.			|			.		  |	       .			 |	   .	    |	.		   |	.		|	.		 |		.		  |
+---------------+-------------------+---------------------+----------------------+--------------+--------------+------------+------------+----------------+

--------------------------------------------------------------------------------------------*/
-- Type you code below:


WITH mdi AS
(
SELECT d.name_id, name, d.movie_id,
	   m.date_published, 
       LEAD(date_published, 1) OVER(PARTITION BY d.name_id ORDER BY date_published, d.movie_id) AS next_movie_date
FROM director_mapping d
	 JOIN names AS n 
     ON d.name_id=n.id 
	 JOIN movie AS m 
     ON d.movie_id=m.id
),

dd AS
(
	 SELECT *, DATEDIFF(next_movie_date, date_published) AS diff
	 FROM mdi
 ),
 
 aid AS
 (
	 SELECT name_id, AVG(diff) AS avg_inter_movie_days
	 FROM dd
	 GROUP BY name_id
 ),
 
 fr AS
 (
	 SELECT d.name_id AS director_id,
		 name AS director_name,
		 COUNT(d.movie_id) AS number_of_movies,
		 ROUND(avg_inter_movie_days) AS inter_movie_days,
		 ROUND(AVG(avg_rating),2) AS avg_rating,
		 SUM(total_votes) AS total_votes,
		 MIN(avg_rating) AS min_rating,
		 MAX(avg_rating) AS max_rating,
		 SUM(duration) AS total_duration,
		 ROW_NUMBER() OVER(ORDER BY COUNT(d.movie_id) DESC) AS director_row_rank
	 FROM
		 names AS n 
         JOIN director_mapping AS d 
         ON n.id=d.name_id
		 JOIN ratings AS r 
         ON d.movie_id=r.movie_id
		 JOIN movie AS m 
         ON m.id=r.movie_id
		 JOIN aid AS a 
         ON a.name_id=d.name_id
	 GROUP BY director_id
 )
 SELECT *	
 FROM fr
 LIMIT 9;


/* Output for the query:
+-------------+-------------------+------------------+------------------+------------+-------------+------------+------------+----------------+-------------------+
| director_id | director_name     | number_of_movies | inter_movie_days | avg_rating | total_votes | min_rating | max_rating | total_duration | director_row_rank |
+-------------+-------------------+------------------+------------------+------------+-------------+------------+------------+----------------+-------------------+
| nm2096009   | Andrew Jones      |                5 |              191 |       3.02 |        1989 |        2.7 |        3.2 |            432 |                 1 |
| nm1777967   | A.L. Vijay        |                5 |              177 |       5.42 |        1754 |        3.7 |        6.9 |            613 |                 2 |
| nm6356309   | Özgür Bakar       |                4 |              112 |       3.75 |        1092 |        3.1 |        4.9 |            374 |                 3 |
| nm2691863   | Justin Price      |                4 |              315 |       4.50 |        5343 |        3.0 |        5.8 |            346 |                 4 |
| nm0814469   | Sion Sono         |                4 |              331 |       6.03 |        2972 |        5.4 |        6.4 |            502 |                 5 |
| nm0831321   | Chris Stokes      |                4 |              198 |       4.33 |        3664 |        4.0 |        4.6 |            352 |                 6 |
| nm0425364   | Jesse V. Johnson  |                4 |              299 |       5.45 |       14778 |        4.2 |        6.5 |            383 |                 7 |
| nm0001752   | Steven Soderbergh |                4 |              254 |       6.48 |      171684 |        6.2 |        7.0 |            401 |                 8 |
| nm0515005   | Sam Liu           |                4 |              260 |       6.23 |       28557 |        5.8 |        6.7 |            312 |                 9 |
+-------------+-------------------+------------------+------------------+------------+-------------+------------+------------+----------------+-------------------+
/*
