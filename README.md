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

all file should have:<br>
header:{<br>
accept=application/json <br>
content_type=application/json <br>
} <br>
if need authorization: <br>
add Authorization="{token_type} {token}"  to request header <br>





<h4>login:</h4>
post
http://localhost:8000/api/login
json={password,email}

<h4>register:</h4>
post
http://localhost:8000/api/register
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
<h6>make address for ourself (user) </h6>
localhost:8000/api/v1/address/add_address <br>
json{city_id,address,postal_code}
<h6>get all address of ourself:</h6>
post
localhost:8000/api/v1/address/get_addresses



