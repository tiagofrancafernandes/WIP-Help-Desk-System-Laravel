### [WIP]

## Help Desk System Laravel

### HTTP Request demo
```http
#####
## VSCode Extension: humao.rest-client
@TOKEN = 42|NtEhGInwLuacgED7p5lydwxkpwq33K6Cool9xgH4207bd56d
@BASE_API = http://127.0.0.1:8000/api
####################################################


### customers auth login
POST {{BASE_API}}/customers/auth/login
Accept: application/json
Content-Type: application/json

{
    "email": "demo1@mail.com",
    "password": "password"
}

### customers auth me
POST {{BASE_API}}/customers/auth/me
Accept: application/json
Content-Type: application/json
Authorization: Bearer {{TOKEN}}

### customers auth logout
POST {{BASE_API}}/customers/auth/logout
Accept: application/json
Content-Type: application/json
Authorization: Bearer {{TOKEN}}

### tickets
POST {{BASE_API}}/tickets
Accept: application/json
Content-Type: application/json
Authorization: Bearer {{TOKEN}}
```
