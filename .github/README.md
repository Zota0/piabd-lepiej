!!! WSZYSTKIE DANE DO POŁĄCZENIA Z BAZĄ DANYCH ZNAJDUJĄ SIĘ W PLIKU `config.cfg` !!!

Aby móc korzystać z tej pracy, należy dodać cały folder do folderu `htdocs` programu `XAMPP`, 
a następnie otworzyć phpmyadmin(lub inną bazę danych MySQL), a następnie zaimportować pliki SQL,
w PODANEJ KOLEJNOŚĆI(inaczej może wystąpić błąd):

1. `skrypt.sql` - Zawiera bazę danych `piabd2` oraz dwie tabele `comments` oraz `accounts` - odpowiednio z języka angielskiego: `komentarze` oraz `konta`.

2. `konto_dewelopera.sql` - Zawiera konto dewelopera, które będzie użyte do połączenia z bazą danych - posiada TYLKO prawa do bazy danych `piabd2` oraz tabeli tej bazy (Można również użyć domyślnego konta ('root') i pustego hasła (''), żeby tak zrobić należy zmienić `username` oraz `password` w pliku `config.cfg` - oznaczające z języka ang. `login` oraz `hasło`).

Należy również zobaczyć, czy `port` w `config.cfg` jest poprawnym numerem, tzn. zgodnym z wartością drugiego od góry portu podanego w programie `XAMPP` - portu obok `MySql`(domyślnie powinno być 3306, o ile plik `my.ini` programu `XAMPP` nie był modyfikowany).

Praca była testowana na przeglądarce `Chrome` - (wersja: 124.0.6367.201).
Praca została wykonana przez Bartosza Zakrzewskiego. 
