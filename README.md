# Felföldi Szabolcs vizsgafeladat

## Feladat rövid ismertetése

Vizsgafeladatnak egy hagyományos blog oldal elkészítését választottam. A feladatot Laravel 9 keretrendszer használatával valósítottam meg. A weboldal egyszerű regisztráció, bejelentkezés funkciókkal van ellátva, valamint blogbejegyzésekkel kapcsolatos CRUD műveleteket képes elvégezni. Formázáshoz Bootstrap 5-öt használtam, minimális animáláshoz a animate.style könyvtárat választottam.

## Telepítés

GitHub repository klónozása, vagy a forráskód letöltése után szükséges a Laravel applikáció előkészítése. Az app futásához a Laravel beépített szerver funkcióját írom le, de használható egyéb erre szolgáló programmal is, mint pl. az XAMPP.

Terminál segítségével navigáljunk be a létrehozott projekt mappájába:

    cd projekt/utvonala

Composer dependenciák telepítése:

	composer install

.env fájl létrehozása a .env.example példafájlból:

    cp .env.example .env

Laravel app kulcs generálása:

    php artisan key:generate

A gyökérkönyvtárban található db.sql fájlt importáljuk be MySQL adatbázisunkba (*vagy futtathatunk migrációt*).

Adjuk meg a létrehozott .env fájlban az adatbázis kapcsolódáshoz szükséges adatainkat a következő résznél:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE="ADATBÁZISUNK NEVE"
    DB_USERNAME="FELHASZNÁLÓ NÉV AZ ADATBÁZISHOZ
    DB_PASSWORD="JELSZÓ AZ ADATBÁZISHOZ

Ha nem töltjük be a db.sql fájlt, futtatthatunk migrációt, hogy létre jöjjenek a Laravel működéséhez szükséges táblák az adatbázisban (*vagy importáljuk a db.sql fájlt*):

    php artisan migrate

Futtassuk a Laravel beépített szerverét:

    php artisan serve

A [http://localhost:8000/](http://localhost:8000/) címre látogatva elindul a webalkalmazás (*nem beépített szerver esetén az útvonal eltérhet!*).

## Az oldal funkciói

A felső részen láthatjuk a navigációs sávot. Itt tudjuk megnézni az eddig elkészült összes posztot, be tudunk jelentkezni, ha van már fiókunk, illetve regisztrálni tudunk, amennyiben új fiókot szeretnénk létrehozni.

Regisztráció esetén alapvető adatokat kér az alkalmazás, a megadandó mezők kötelezőek, és egyedi e-mail címnek kell lennie. 

A jelszó Hash-elve kerül be az adatbázisba biztonsági szempontoknak megfelelően.

Regisztráció után az alkalmazás automatikusan be is jelentkeztet minket, így megnyílnak egyéb funkciók.

Az Új bejegyzés menüpontra kattintva van lehetőségünk új bejegyzés létrehozásához.

A Bejegyzéseim menüpontra kattintva láthatjuk a saját magunk készített bejegyzéseket, valamint tudjuk azokat szerkeszteni, illetve törölni a megfelelő gombokra kattintva. A bejegyzést manipuláló műveletek a Bejegyzések menüpont alatt is láthatóak, amennyiben a bizonyos poszt a bejelentkezett felhasználóhoz tartozik.

A Kijelentkezés gombra kattintva a felhasználót kilépteti az alkalmazás.

Ezen funkciókhoz kötött útvonalak védve vannak - authentikációtól függőek, csak bejelentkezett felhasználók vehetik igénybe. Nem authentikált felhasználók a bejelentkezési felületre irányítódnak, illetve a regisztráció csak vendég felhasználóknak elérhető, bejelentkezett felhasználók nem érik el.

## Technikai leírása a funkcióknak

Az alkalmazás alapvetően két táblát használ az adatbázisból: Users és Posts. A többi tábla a Laravel működéséhez, egyéb funkcióihoz szükséges táblák. Az adatbázis-stuktúra modelje a gyökérkönyvtárban található (db-model.png).

Az alkalmazás a Laravel struktúrája szerint épült fel, ami gyakorlatilag az MVC-modellen alapszik:

 - Az app/Models mappában találhatók az alkalmazás által használt
   modellek
   - User model a felhasználókat leíró model, amiben az Eloquent Model Relationship-eket kihasználva kapcsolatot létesítek a User és a Post modellek között -> egy felhasználónak több bejegyzése is lehet.
   - Post model a bejegyzéseket leíró model, amiben az Eloquent Model Relationship-eket kihasználval kapcsolatot létesítek a Post és User modellek között -> egy bejegyzés csak egy felhasználóhoz tartozik.
 - Az app/http/Controllers mappában találhatók a Controllerek:
	 - UserController: a felhasználóhoz kapcsolatos funkciókért felel, mint például a regisztráció, bejelentkezés. Itt eltértem kicsit a hagyományos Laravel felépítéstől, a funkciók elnevezéseit próbáltam úgy megválasztani, hogy magukért beszéljenek (pl: login_show() -> bejelentkezési felület mutatása, login() -> bejelentkezési folyamat funkciója)
	 - PostController: a bejegyzések alapvető CRUD funkcióiért felel, mint például bejegyzés megjelenítése, létrehozása, módosítása, törlése. Itt maradtam a Laravel alap felépítésénél.
- Az app/Requests mappában vannak a validációhoz tartozó kritériumok. Az egyszerűség miatt nem adtam meg szigorú kritériumokat, mint pl. a jelszó minimum hossza.
- A Resources/Views mappában találhatók a megjelenítéssel kapcsolatos fájlok:
	- /layouts mappában van a "wrapper", ami az alap html struktúrát tartalmazza
	- /pages mappában vannak a különböző útvonalakhoz tartozó oldalak tartalmai
	- /components mappába szerveztem a többször felhasznált komponenseket, mint pl. a blog kártya, alert doboz, navigációs sáv, formok.
- A routes/web.php tartalmazza a regisztrált útvonalait az alkalmazásnak
- A database/migrations tartalmazza a a migrációkor felhasznált "sémát" a táblák elkészítéséhez.

A védett tartalom megjelenítéséhez a Laravel @auth és @guest helper-jeit használtam.
A hibakezelésre, alert-ek megjelenítésére az @error helpert használtam.
