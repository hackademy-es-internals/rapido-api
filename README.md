# Rapido Api for rapido.es js client
## Launch the program
- composer install
- cp .env.exampl .env
- php artisan key:generate
- create a database and edit .env information DB_
- php artisan migrate
- php artisan db:seed
- php artisan serve

## Test con POSTMAN
In order to test the project download Postman and import rapidoApi_postman_collection.json included in this project root, then:

- go to User folder and first create a new user with "Register" request. It will output the newly created user resource and the token necessary for following requests

- for each request protected with jwt middleware you have to pass the header Authorization with value "Bearer paste_the_token" 
ex. "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyODQzODc1NSwiZXhwIjoxNjI4NDQyMzU1LCJuYmYiOjE2Mjg0Mzg3NTUsImp0aSI6IlJiRGx5bmNEMUtRN0NoUmoiLCJzdWIiOjUsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xoqZrlgo0mPy21Qt2MkL5Zpn9kQR5LQCLvVIwNr6nLQ"

- In case of using Postman a variable called "token" has been created and is used for all the protected requests, in order to avoid massive copy/paste of new token. Just go to variables section clicking on the name of the collection (rapidoApi) and change the value with the new token, don't forget Bearer word before the token content. Save with the proper button.

- Go to check whether each of the protected routes have Authorization header with value {{token}} 

- if you already registered in the system just launch a login request in User folder with email and password in the body. In case of success it will return a jwt token.

- Once logged, if you want to retrieve the authenticated user launch the Authenticated User request passing the token in Authorization header 

- Some of system's features are protected with the jwt middleware, so passing the header Authorization is necessary to use that feature (ex. create a new annoucement)

## Test con HTTPIE
Download httpie for terminal, install it and then copy and paste the following commands modifying parameters like the ids of users, categories, announcements according to your datas. When jwt token is required you have to replace "your-token" with the actual one.

- First of all register or login to obtain a jwt token in response, you can set your own name and email (and password)

http -f POST localhost:8000/api/register name=nico email=test@test.com password=12345678 password_confirmation=12345678 Accept:application/json

http -f POST localhost:8000/api/login name=nico email=test@test.com password=12345678 Accept:application/json 

- After that you can use protected routes setting the header in this way: Autorization:Bearer\ your-token
Ex.
Autorization:Bearer\ eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYzMjgzNTc5NiwiZXhwIjoxNjMyODM5Mzk2LCJuYmYiOjE2MzI4MzU3OTYsImp0aSI6ImtiMUYyaTdxU2hZRHJUYmMiLCJzdWIiOjE0OCwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.nUSXLXhIPUtp4spIvm1W9jWWAqmF96voE_vprq3Bw3g

### Protected Routes:
USERS

Retrieve the current logged user
http -f POST localhost:8000/api/users/authenticated Accept:application/json Authorization:Bearer\ your-token

Retrieve all users
http localhost:8000/api/users Accept:application/json Authorization:Bearer\ your-token

Retrieve a specific user by id
http localhost:8000/api/users/140 Accept:application/json Authorization:Bearer\ your-token

Update a specific user by id
http PUT localhost:8000/api/users/140 name=newname email=newemail@email.com Accept:application/json Authorization:Bearer\ your-token

Delete a specific user by id
http DELETE localhost:8000/api/users/140 Accept:application/json Authorization:Bearer\ your-token

ANNOUCEMENTS
Create a new announcement
http -f POST localhost:8000/api/announcements title='super moto' body='best used moto in marketplace' price=3000 category_id=8 Accept:application/json Authorization:Bearer\ your-token

Update an announcement
http -f PUT localhost:8000/api/announcements/359 title='super motorbike' body='best used moto in used marketplace' price=3500 category_id=8 Accept:application/json Authorization:Bearer\ your-token

Delete an announcement
http -f DELETE localhost:8000/api/announcements/359 Accept:application/json Authorization:Bearer\ your-token

CATEGORIES
Create a new category
http -f POST localhost:8000/api/category name=books Accept:application/json Authorization:Bearer\ your-token

Update an category
http -f PUT localhost:8000/api/category/8 name=book Accept:application/json Authorization:Bearer\ your-token

Delete an category
http -f DELETE localhost:8000/api/category/8 Accept:application/json Authorization:Bearer\ your-token

### Public Routes
For these routes jwt token is not necessary

Retrieve all announcements
http localhost:8000/api/announcements Accept:application/json

Retrieve a specific announcement by id
http localhost:8000/api/announcements/328 Accept:application/json

Retrieve announcements by category
http localhost:8000/api/announcements/category/8 Accept:application/json

Retrieve announcement by user
http localhost:8000/api/announcements/user/140 Accept:application/json

Retrieve all categories
http localhost:8000/api/categories Accept:application/json

Retrieve a specific category by id
http localhost:8000/api/categories/8 Accept:application/json