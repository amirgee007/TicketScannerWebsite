Website for TicketScanner app
======
This is the backend api for the ticketscanner app. Live version is available on [ticketscanner.xlw.be](https://ticketscanner.xlw.be)

Api instructions
---
Api instructions are simple, yet so simple security isn't optimal, but good enough.
The api routes are defined in the route file of the MVC-model.
````php
Route::post('/api/createToken', 'ApiController@createToken');
Route::post('/api/event', 'ApiController@getEvents');
Route::post('/api/event/{id}', 'ApiController@getSingleEvent');
Route::post('/api/code/{id}', 'ApiController@getCode');
````
Get a token:
-------------------
Send a request to `/api/createToken` with the fields `email` and `password`.

Example:
* email: demo@example.com
* password: example
```json
{
  "state": true,
  "userName": "Example",
  "userMail": "example@example.com",
  "api_token": "QS04Vd5zdphF6MEMNjNq7qINv4J7ugSjSdh038BmuJoYsnfiVTSAS7p9Tv9s"
}
```
If information is invalid:
````json
{
  "state": false
}
````

List events:
-------------------
Send a request to `/api/event` with the field `api_token`.
```json
{
  "state": true,
  "events": [
    {
      "id": 1,
      "owner_id": 1,
      "name": "Testevent",
      "created_at": "2016-12-31 13:46:40",
      "updated_at": "2016-12-31 13:46:40"
    },
    {
      "id": 2,
      "owner_id": 1,
      "name": "test",
      "created_at": "2016-12-31 14:00:25",
      "updated_at": "2016-12-31 14:00:25"
    }
  ]
}
```

Get event codes:
-------------------
Send a request to `/api/event/{id}` with the field `api_token`.
```json
{
  "state": true,
  "codes": [
    {
      "id": 1,
      "event_id": 1,
      "code": "123456789",
      "state": "true",
      "created_at": "2016-12-31 13:46:40",
      "updated_at": "2016-12-31 13:46:40"
    }
  ]
}
```

Update a code:
-------------------
Send a request to `/api/code/{id}` with the fields `api_token` and `state`. Set state to false
```json
{
  "state": true,
  "update": 1
}
```