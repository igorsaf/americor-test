# Развертывание
- `git clone git@github.com:igorsaf/americor-test.git`
- `cd americor-test`
- `make generate-certs`
- `make start`

# Процессинг асинхронной очереди событий
- `make process-async-events`

# Эндпоинты
## Создание пользователя
```
POST https://127.0.0.1:8443/api/v1/clients
Content-Type: application/json

{
  "lastName": "Test",
  "firstName": "User",
  "birthDate": "1990-01-01",
  "ssn": "123-45-6780",
  "addressStreet": "Street",
  "addressCity": "City",
  "addressState": "CA",
  "addressZip": "12345-6789",
  "ficoRating": 800,
  "email": "123@456.com",
  "phone": "+12345678910"
}
```
## Редактирование пользователя
```
PUT https://127.0.0.1:8443/api/v1/clients/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx // id клиента - получаем при создании
Content-Type: application/json

{
  "lastName": "Test",
  "firstName": "User",
  "birthDate": "1990-01-01",
  "ssn": "123-45-6780",
  "addressStreet": "Street",
  "addressCity": "City",
  "addressState": "CA",
  "addressZip": "12345-6789",
  "ficoRating": 800,
  "email": "123@456.com",
  "phone": "+12345678910"
}
```
## Проверка возможности выдачи кредита
```
POST https://127.0.0.1:8443/api/v1/loans/pre-issue-check
Content-Type: application/json

{
  "clientId": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", // id клиента - получаем при создании
  "loanProductId": "c2948333-c7f2-48bf-b8c5-414f52f9404f", // id демо кредитного продукт - создается при инициализации проекта
  "clientMonthlyIncome": 10000 // ежемесячный доход клиента в долларах
}
```
## Выдача кредита
```
POST https://127.0.0.1:8443/api/v1/loans/issue
Content-Type: application/json

{
  "approvedRequestId": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" // id одобренной заявки на кредит - получаем при проверке возможно выдачи кредита 
}
```