---
title: MyVid API Documentation

toc_footers:
  - <a href='https://github.com/niksat3/ProjectSOA/tree/master/proyekSoa'>Documentation for MyVid API</a>

includes:
  - errors

search: true
---

# Introduction

Welcome to the MyVid API! You can use our API to access MyVid API endpoints, which you can get information on videos, subscribers, like, and any others subject that is referenced for any Video Providers.

List of MyVid API operations:

Method | Endpoint | Usage | Use Authorization
------ | -------- | ----- | -----------------
PUT | /generateApiKey | Generate user API key from id and password user | NO
POST | /insertUser | Insert new user without API key | NO
GET | /searchChannel/{name} | Search channel video by user's name | YES	
GET | /searchVideo/{name} | Search video by video's name | YES
POST | /subscribeChannel | Subscribe requested user to requested channel | YES
GET | /getChannelSubscribed/{id_user} | Get subscriber list from one channel | YES
GET | /getTotalSubscriber/{id_user} | Get total subscriber from one channel | YES
GET | /getVideoViewers/{id_video} | Get video viewers | YES
GET | /getInfoChannel/{id_user} | Get channel information | YES
GET | /getNewCommentOnVideos/{id_user} | Get all unread comment on all videos from one channel | YES
POST | /insertComment | Add new comment to one video from one user | YES
POST | /uploadVideo | Upload new video in one channel | YES
POST | /translate | Translate from some text from one language to another | YES
GET | /getListLanguage | Get list language that is provided by API | NO

# Authentication

MyVid APIs is using Authorization header for authentication. Some endpoints must be provided with this header and the value is user API key that is given to user. List of endpoints that must use authorization header can be seen in Introduction section. You can use our example client at our [Portal](#).

MyVid expects for the API key to be included in some API requests to the server in a header that looks like the following:

`Authorization: 30fe3c9d643e5161f4`

<aside class="notice">
You must replace <code>30fe3c9d643e5161f4</code> with your personal API key. That authorization code can't be used.
</aside>

# API Services

## Generate API Key

This endpoint generate API Key for user and update it directly into database.

### HTTP Request

`PUT http://localhost/proyeksoa/index.php/generateApiKey`

### Query Parameters

Parameter | Type | Example
--------- | ---- | -------
id_user | string | asf123
password | string | asdf123456

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
api_key | user generated API key
error_message | description if there are any errors

<aside class="notice">
This endpoint doesn't need any authorization
</aside>

<aside class="warning">
Remember to put your real id and password or generate API key will fail
</aside>

## Insert User

This endpoint insert new user to database.

### HTTP Request

`POST http://localhost/proyekSoa/index.php/insertUser`

### Query Parameters

Parameter | Type | Example
--------- | ---- | -------
id_user | string | asf123
password | string | asdf123456
nama_user | string | safitri
email | string | safitri@gmail.com
tanggal_lahir | date | 02-02-1990
newfile | file | {your file photo}

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
error_message | description if there are any errors

<aside class="notice">
This endpoint doesn't need any authorization
</aside>

<aside class="warning">
This endpoint will fail if:<br>
- There's no picture/wrong file included in new file<br>
- Birth date not correctly defined (must be `dd-mm-yyyy`)<br>
- Id user already exists<br>
</aside>

## Search Channel

This endpoint search like based channel by channel's name.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/searchChannel/{name}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | all channel information that is found by this endpoint
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

## Search Video

This endpoint search like based video by video's name.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/searchVideo/{name}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | video's information that is found by this endpoint
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

## Subscribe Channel

This endpoint let user subscribe or unsubscribe to one channel.

### HTTP Request

`POST http://localhost/proyekSoa/index.php/subscribeChannel`

### Query Parameters

Parameter | Type | Example
--------- | ---- | -------
id_channel | string | a12
id_user | string | asf123
subscribe | string | "T" or "F"

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put real id user, id channel, and subscribe string, or subscribe channel will fail
</aside>

## Get Subscriber Channel

This endpoint get subscriber of one channel.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/getChannelSubscribed/{id_user}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | all user id that subscribe this channel
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put your real user id or get subscriber channel will fail
</aside>

## Get Total Subscriber

This endpoint get total subscriber count of one channel

### HTTP Request

`GET http://localhost/proyekSoa/index.php/getTotalSubscriber/{id_user}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | subscriber count of this channel
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put your real user id or get total subscriber will fail
</aside>

## Get Video Viewers

This endpoint get total viewers count of one video.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/getVideoViewers/{id_video}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | viewer count of this video
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put your real video id or get video viewers will fail
</aside>

## Get Channel Information

This endpoint get all information on one channel.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/getInfoChannel/{id_user}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | channel's information that is found by this endpoint
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put your real user id or get channel information will fail
</aside>

## Get Unread Comments

This endpoint get all comments on all videos on one user that haven't be read by the user.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/getNewCommentOnVideos/{id_user}`

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
data | all comments information that haven't be read by user
error_message | description if no data found or there are any errors

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put your real user id or get unread comments will fail
</aside>

## Add New Comment

This endpoint add comment to one video in database.

### HTTP Request

`POST http://localhost/proyekSoa/index.php/getNewCommentOnVideos/insertComment`

### Query Parameters

Parameter | Type | Example
--------- | ---- | -------
message | string | This video is really great and wonderful
id_video | int | 1
id_user | string | asf123

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
error_message | description if failed to add comment

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put your real user id and video id or add new comments will fail
</aside>

## Upload New Video

This endpoint upload new video from one user.

### HTTP Request

`POST http://localhost/proyekSoa/index.php/getNewCommentOnVideos/uploadVideo`

### Query Parameters

Parameter | Type | Example
--------- | ---- | -------
judul_video | string | Great Parody Clip
description | string | Hello! I came back with one of this great video. Hope you enjoy it!
newfile | file | {your file video}
id_user | string | asf123

### HTTP Response

Field | Description
----- | -----------
result | endpoint result
error_message | description if failed to upload new video

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
This endpoint will fail if:<br>
- There's no video/wrong file included in new file<br>
- Id user not exists<br>
</aside>

## Translate Text

This endpoint translate text from one language to any other language based on list language that is in database.

### HTTP Request

`POST http://localhost/proyekSoa/index.php/translate`

### Query Parameters

Parameter | Type | Example
--------- | ---- | -------
text | string | Hari terbaik
lang | string | id-en

### HTTP Response

Field | Description
----- | -----------
code | code result
lang | language inputed in endpoint
text | text translated result
result | endpoint result
message | description if failed to translate text

<aside class="success">
Remember to put authorization header
</aside>

<aside class="warning">
Remember to put lang code correctly(the list can be found in Get List Language section) or translate text will fail
</aside>

## Get List Language

This endpoint get all language used for parameter **lang** in Translate Text section.

### HTTP Request

`GET http://localhost/proyekSoa/index.php/getListLanguage`

### HTTP Response

Field | Description
----- | -----------
dirs | language string used in parameter **lang** in Translate Text section
langs | language name of every language code

<aside class="notice">
This endpoint doesn't need any authorization
</aside>

# Made By

This project is made by:

`Bernard Niklas Satrijo /214116296`

`Fernandito Stanford /214116318`

`Reynold Kevin /214116368`

`Rio Adianto /214116372`
