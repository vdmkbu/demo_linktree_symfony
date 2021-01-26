### Demo https://linktr.ee/ clone
клонируем репозиторий:  
```
git clone git@github.com:vdmkbu/demo_linktree_symfony.git .
```
инициализируем проект (установка пакетов, миграции и фикстуры):  
```
make docker-clear
make docker-build
make composer
make migrate
make fixtures
```

получить рандомный username для входа (пароль **password**):
```
make get-random-user
```

Главная:  
```
http://localhost:8080
```

Вывод ссылок пользователя **username**:  
```
http://localhost:8080/<username>
``` 

Форма входа:  
```
http://localhost:8080/login
```

Форма регистрации:  
```
http://localhost:8080/register
```

Список всех ссылок аккаунта и управление:  
```
http://localhost:8080/dashboard
```

Настройки аккаунта: цветовые настройки, API токены:  
```
http://localhost:8080/dashboard/settings
```

MailHog (для перехвата писем, отправляемых после регистрации):  
```
http://localhost:8025/
```

#### Простое API  
##### информация об аккаунте:  
```http request
GET /api/v1/account
Authorization: Bearer <API токен>
```
ответ:  
```json
{
  "username": "richie43",
  "email": "rogers.weber@powlowski.biz"
}
```

##### список всех ссылок аккаунта:
```http request
GET /api/v1/links
Authorization: Bearer <API токен>
```
ответ:  
```json
[
  {
    "id": 61,
    "name": "GitHub",
    "url": "https:\/\/github.com\/vdmkbu"
  },
  {
    "id": 72,
    "name": "Twitter",
    "url": "https:\/\/twitter.com\/vdmkbu"
  },
  {
    "id": 90,
    "name": "LinkedIn",
    "url": "https:\/\/www.linkedin.com\/in\/vdmkbu"
  }
]
```

##### посещения для ссылки <link_id>
```http request
GET GET /api/v1/links/<link_id>/visits
Authorization: Bearer <API токен>
``` 
ответ:  
```json
[
  {
    "id": 13,
    "userAgent": "Mozilla\/5.0 (Windows 98; Win 9x 4.90) AppleWebKit\/5311 (KHTML, like Gecko) Chrome\/38.0.877.0 Mobile Safari\/5311",
    "createdAt": "2016-03-15T13:46:49+00:00"
  },
  {
    "id": 99,
    "userAgent": "Mozilla\/5.0 (Windows NT 6.1) AppleWebKit\/5330 (KHTML, like Gecko) Chrome\/38.0.884.0 Mobile Safari\/5330",
    "createdAt": "2018-11-06T07:33:46+00:00"
  },
  {
    "id": 113,
    "userAgent": "Mozilla\/5.0 (Macintosh; U; Intel Mac OS X 10_7_9 rv:5.0; en-US) AppleWebKit\/531.42.3 (KHTML, like Gecko) Version\/4.0 Safari\/531.42.3",
    "createdAt": "2007-02-25T16:15:32+00:00"
  }
]
```