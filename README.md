# Technologies

1. PHP 8

2. Maria DB 10

3. Composer

4. Apache 2


# Installation 

1. Clone all files from git "https://github.com/mayusuf/oscarApi" in the server

2. run "composer install"

3. Import sql file "oscar_test.sql" in the Maria DB from sql folder

4. Provide Database connection in the file ".env"

5. run the app from the public folder. i.e. php -S 127.0.0.1:8080

6. if you want to get info of any car or bunch of car then it is necessary to change 
	the value of "is_active" column of "cars" table to 1 

7. the provided files are resid in the directory "uploads"


# API Doc

 
## Read files from uploads folder and save in DB

Url : /api/oscar_read
Method : GET

## Get Car list

Url : /api/cars
Method : GET

## Get a single car info

Url : /api/car
Method : GET

Query parameter:

id (required)


## Add Car

Url : /api/car
Method : POST
Data Format : form-data

Data:

string plate_no;
string brand;
string model;
string location
string car_year;
string doors;
string seats;
string fuel_type;
string transmission;
string car_type_group;
string car_type;
string distance;
string inside_height;
string inside_length;
string inside_width;


# Unit test
1. Please go the "tests" folder and open test file
2. Change the base uri 
3. run "composer test" command  