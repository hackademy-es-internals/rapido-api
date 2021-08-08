# Rapido Api for rapido.es js client

In order to test the project download Postman and import rapidoApi_postman_xxxxxxx_.json included in this project root, then:

- go to User folder and first create a new user with "Register" request. It will output the newly created user resource and the token necessary for following requests
- for each request protected with jwt middleware you have to pass the header Authorization with value "Bearer paste_the_token" ex. "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyODQzODc1NSwiZXhwIjoxNjI4NDQyMzU1LCJuYmYiOjE2Mjg0Mzg3NTUsImp0aSI6IlJiRGx5bmNEMUtRN0NoUmoiLCJzdWIiOjUsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xoqZrlgo0mPy21Qt2MkL5Zpn9kQR5LQCLvVIwNr6nLQ"

