Shelter API

# Response Code
101 > User Not Found\
102 > Parameter Tidak sesuai\
103 > User Telah Terdaftar\
104 > Registrasi Berhasil\
105 > Registrasi Gagal

# API Allowed
![alt text](https://github.com/alfalifr/Shelter_Cloud/blob/master/screenshoot/API%20Allowed.jpg?raw=true)

# Example Request
Login => { "_authType": "_login","_email": "test111@mail.com","_password": "test123" }\
Register => {"_authType":"_register","_email":"test11111@mail.com","_password":"test123","_fname":"test sata","_gender":"M"} \
News => {"_requestType": 1}\
Article => {"_requestType": 2}\
Feedback => {"_feedback":true,"from":"feedback@mail.com","type":"isi beabas","msg":"Terjadi Kebarakaran Diwilayah A","imglink":""}\
gempa => {"_requestType": "gempa"}\
wilayah dampak gempa => {"_requestType": "city_gempa"}\
Filter Wilayah Gempa => {"_requestType":"gempa","filter":"Pulo Batal"}

# Example Response
Login => {"response":"success","data":{"id":"2","email":"test111@mail.com","full_name":"Muhammad Naufal","address":"AlamatBaru","gender":"B"}}\
Banjir => [{"kondisi":"Ekstrim","lat":"100.2343394427","lon":"1.7754650863","alamat_lengkap":"Q6GM+5P Aek Batu, South Labuhan Batu Regency, North Sumatra, Indonesia","desa":"Aek Batu"}]