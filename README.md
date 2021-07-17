# E Bansos

**Ebansos** (Electronic Social Assistance) is a web application that provides citizen data management who will receive social assistance to avoid misdirection assistance from public service/government and this application already uses the MVC.

## Preliminary

This project was initiated by Annisa and her friends, who are currently majoring in State Development Administration, to examine the effectiveness of using information systems to implement subsidy distribution in the local district.

Made by Azvya Erstevan I and UI Mockup by Muhammad Taufan Z.

This project coincided with its release in mid-July with an application owned by the Ministry of Social Affairs. You can check it at [Cek Bansos Kemensos](https://cekbansos.kemensos.go.id/)

## Features

### General Features
- Crud
- Login/Registration
- Admin Rights Privileges (For example, RW 01 officers cannot view other RW residents data, even though if we input the resident detail URL manually)
- History admin activity.

### Error Control & Privilege

- A 404 error can appear if the controller/method doesn't exist, you can try it by typing random text in the URL.

- Error 401 can appear when the controller/method address is accessed but not logged in/login as an unprivileged user, and you can try it when you are not logged in and go to the URL [Error 401 Page](https://ebansostest.erstevn.com/admin)

### Data Test

**Check on the home page before logging in.**
```
NIK : 1114966709060280
Birthdate : 15 - 12 - 1971
```
**Account types**

_1. Village Officers (View user activity history, manage residents and officers data)_
``` 
Username : superadmin
Password : 12345678
```

_2. RW officer (Can only manage RW resident data)_
```
Username : Sarijadi01
Password : Maimunah@245
```
_3. Social Assistance Officer (Input social assistance data)_
```
Username : BansosTest
Password : Fitriani@646
```
## Tech Used

- HTML CSS JS
- Jquery
- PHP 8 Native
- Bootstrap 5
- Faker (create a readable password generator)
- Particles JS (just for fun)