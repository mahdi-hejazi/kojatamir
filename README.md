# درباره ی کجا تعمیر

یک وبسایت برای پیدا کردن تمیرکار مورد نظر



#نحوه ی استفاده
make a directory kojatamir<br>

1.copy all files in directory kojatamir<br>
\#gh repo clone mahdi-hejazi/kojatamir<br>

2.make a mysql db name= kojatamirdb <br>


3.\# php artisan serve<br>
4.\# php artisan migrate:refresh --seed   <br>



#rest api

<h4>login:</h4>
post
http://localhost:8000/api/login
accept=application/json
content_type=application/json
json={password,email}

<h4>register:</h4>
post
http://localhost:8000/api/register
accept=application/json
content_type=application/json
json={name,family,phone,password,email,profile_image}

<h4>Authorization: </h4>
add Authorization="{token_type} {token}"  to request header

<h3>Addresses:</h3>
<h6>get all provinces of iran:</h6>
http://localhost:8000/api/provinces/
<h6>get info of {province_id}:</h6>
http://localhost:8000/api/provinces/{province_id}/
<h6>get all cities of {province_id}:</h6>
http://localhost:8000/api/provinces/{province_id}/cities

