# 簡訊實聯制(網頁版)

## Installation

```
$ cd docker-compose

$ docker-compose up -d

$ docker exec -it php74-container /bin/bash

root#  php bin/console doctrine:database:create

root#  php bin/console doctrine:migration:migrate

```

## API

### 店家申請

method: POST

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

### 傳送實聯制資訊

method: POST

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

### 取得可能感染範圍

#### 使用時間和場所代碼

輸入後場所代碼和時間，可以找過去七天，到過該場所的人

method: GET 

url:
```
http://localhost/api/maybeInfected/byCodeAndTime?code=00010&time=2021-06-30
```

#### 使用感染者手機

輸入使用者手機後，可以找過去七天，跟確診者前後四小時到過相同場所的人

method: GET

url:
```
http://localhost/api/maybeInfected/byInfectedPhone?phone=0975349461
```