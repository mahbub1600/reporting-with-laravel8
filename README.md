** host the product as localhost or host at your desired server to run the project **

** Create a 'tmss' databse and Import tmss.sql to 'tmss' database. After that create a user named 'mahbub' and give 'tmss' database all privileges**

** There are 7 alternatives to view the project report. They are an approach to view the relational report in different ways **

** there are currently 50k+ rows in each of the tables **

# home url
/home -> this page will show the project URL to view

# data loading
/load -> will load 10 rows in both 'User' and 'UserBloodGroup' and recache by Redis

# data viewing
/show1 -> will view report with lazy loading
/show2 -> will view report with eager loading
/show3 -> will view report with DB::table Join
/show4 -> will view report with DB::select
/show5 -> will view report with Pdo statement
/show6 -> will view report with Redis cache
/show7 -> will view report with File Cache