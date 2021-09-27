# 簡訊實聯制(網頁版)

## Installation

```
$ cd docker-compose

$ docker-compose up -d --build

$ docker exec -it php8-container /bin/bash

root#  composer install

root#  php bin/console doctrine:database:create

root#  php bin/console doctrine:migration:migrate --quiet

root# php bin/console cache:warmup --env=prod

```

## API

### 店家申請

method: 

POST

url: 
```
http://localhost/api/business
```

json payload:
```
{
	"name" : "bussiness name",
	"address" : "adress name ",
	"wgs84E": "24.123456",
	"wgs84N": "124.1234567"
}
```

備註:

如果需要自動帶入地址，請在專案內.env設定上加入Google Geocode的 API token(不放在git上 沒有的話 請跟我要)。

.env
```
GOOGLE_GEOCODE_API_KEY=(API token)
```

設定完後只要不輸入wgs座標就會自動去Google API撈座標。

如沒有設定黨還是沒有更新，請清除Symfony的Cache。
```
$ docker exec -it php8-container /bin/bash

root# php bin/console cache:clear --env=prod
```

----

### 傳送實聯制資訊

method: 

POST

url:
```
http://localhost/api/visiting
```

json payload:
```
{
	"visitTime":"2021-06-21T20:30:40",
	"phone" : "0912-345-678",
	"text": "場所代碼：0000 0000 0000 010\n本簡訊是簡訊實聯制發送，限防疫目的使用"
}
```

----

### 取得可能感染範圍

----

#### 使用時間和場所代碼

輸入後場所代碼和時間，可以找過去七天，到過該場所的人

method: 

GET 

url:
```
http://localhost/api/maybeInfected/byCodeAndTime?code=00010&time=2021-06-30
```

----

#### 使用感染者手機

輸入使用者手機後，可以找過去七天，跟確診者前後四小時到過相同場所的人

method: 

GET

url:
```
http://localhost/api/maybeInfected/byInfectedPhone?phone=0975349461
```

----

#### 使用時間和場所代碼(感染範圍50公尺)

輸入後場所代碼和時間，可以找過去七天 到過範圍50公尺場所的民眾資訊

作法:

先篩選東西南北50公尺(+-0.005度分秒)內的場所，在計算兩點球面距離50公尺內後，找到該場所7天內的使用者。


method:

GET

url:
```
http://localhost/api/maybeInfected/byCodeAndTimeEnhance?code=00016&time=2021-06-23T10:30:00
```

### 處理億量級的方法

php: nginx + opcache + reverse proxy

mysql: partition table 根據店家的代碼
