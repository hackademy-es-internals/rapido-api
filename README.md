# Rapido Api for rapido.es js client

In order to test the project download Postman and import rapidoApi_postman_xxxxxxx_.json included in this project root, then:

- go to User folder and first create a new user with "Register" request. It will output the newly created user resource and the token necessary for following requests
- for each request protected with jwt middleware you have to pass the header Authorization with value "Bearer paste_the_token" ex. "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyODQzODc1NSwiZXhwIjoxNjI4NDQyMzU1LCJuYmYiOjE2Mjg0Mzg3NTUsImp0aSI6IlJiRGx5bmNEMUtRN0NoUmoiLCJzdWIiOjUsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xoqZrlgo0mPy21Qt2MkL5Zpn9kQR5LQCLvVIwNr6nLQ"
- In case of using Postman a variable called "token" has been created and is used for all the protected requests, in order to avoid massive copy/paste of new token. Just go to variables section clicking on the name of the collection (rapidoApi) and change the value with the new token, don't forget Bearer word before the token content. Save with the proper button.
- Go to check whether each of the protected routes have Authorization header with value {{token}} 
- if you already registered in the system just launch a login request in User folder with email and password in the body. In case of success it will return a jwt token.
- Once logged, if you want to retrieve the authenticated user launch the Authenticated User request passing the token in Authorization header 
