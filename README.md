# kinos_in_Deutschland-1


## Thema

Online-Ausstellung: Kinos in Deutschland

## Sitemap
- `index:`
  - Bilder durch Javascript wechseln
  - Das letzte hinzugefügte Kino anzeigen
  - man kann durch klicken auf das letzte Kino auf cinemaOverviewPage gehen
  - wenn man angemeldet ist, kann man auch das Kino liken
  - Durch klicken auf den Button "See more cinemas" auf die Seite von allCinema gehen
  - Per API aufruf wird in einer OSM alle Kinos als Marker angezeigt

- `navigation`
  - wird in über allen Seiten angezeigt
  - wenn man in der Seite runterscrollt, wird der Navigation bar per javascript und css dunkler
  - Wenn man nicht angemeldet ist, enthält der navigationbar nur links zu anmelden und registrierung
  - wenn man angemeldet ist, enthält links zu userDetailHomePage, userProfilePage und logoutPage
  - das Navigationbar enthält auch unser logo, durch klicken auf das Logo kommt man auf die index Seite
  
- `footer:`
  - wird in unter allen Seiten angezeigt
  - enthält links zu impressum, privacy und terms 
  
- `LoginPage`
  - man kann sich mit seiner email und passwort anmelden, es wird dann überprüft, ob der user in unserer Datenbank existiert, falls ja wird man angemeldet falls nein bekommt der user eine Fehlermedlung
  - ebenfalls wenn der Nutzer sich verschreibt, bekommt man eine Fehlermeldung
  
- `RegistrationPage:`
  - in dieser Seite kann man sich registrieren, man muss Name, email, passwort und passwort bestätigen eingeben
  - per javascript und ajax wird alles überprüft
    - wenn der Name breits in der Datenbank gibt, dann sieht man in rot Name bereits vergeben, aber der user kann es auch ignorieren, weil es kein Problem ist
    - bei passwort die Meldungen: Passwort zu kurz, Sehr schwach, Mittel und Stark
    - links terms und privacy, die der Nutzer annehmen muss
    - beim klicken auf den button registrieren
      - wird überprüft, ob alles gefüllt ist oder nicht
      - wenn alles gefüllt ist, dann bekommt der Nutzer die Meldung: Es wurde eine E-Mail an die angegebene Adresse verschickt mit weiteren Infos, dann wird eine neue Tab geöffnet
        - wenn man schon registriert ist, dann bekommt der Nutzer die Meldung: Bitte ignoriere die E-Mail,
          wenn du es nicht warst, der sich versucht hat zu registrieren. Du bist aber bereits
          registriert. Solltest du dein Password vergessen habe, klicke bitte hier
        - wenn man nicht registriert ist, bekommt der Nutzer die Meldung: Bitte ignoriere die
          E-Mail, wenn du es nicht warst, der sich versucht hat zu registrieren. Ansonsten
          klicke auf folgenden Link, um die Registrierung abzuschließen.
- `userProfilePage`
  - Der Nutzer kann: seine Infos bearbeiten udn konto löschen 

- `userDetailHomePage:`
    - Anzeige von gespeicherten und erstellten Kinos mit den Optionen bearbeiten oder löschen
    - Button für Kino hinzufügen
    - durch Klicken auf Kino zu userDetailMoviePage
  
- `addOrEditCinemaPage`
  - Man kann ein Kino bearbeiten
  - Man kann zum Beispiel ein neues Foto laden
  - Man kann hier auch ein neues Kino hinzufügen
  
- `cinemaOverviewPage:`
    - Anzeige von Kino Informationen 
    - Anzeige von Kino Bild
    - Kommentare hinzufügen
    - Anzeige von dazugehörige Filme 
    - Anzeige von Kommentare
    - wenn man angemeldet ist, kann man auch kino liken, entliken 
  
- `userDetailMoviePage:`
  - Anzeige von gespeicherten und erstellten Kinos mit den Optionen bearbeiten oder löschen
  - Button für Kino hinzufügen
  - durch Klicken auf Kino zu userDetailMoviePage
  
- `addOrEditMoviePage:`
  - Man kann einen Film bearbeiten
  - Man kann zum Beispiel ein neues Foto laden
  - Man kann hier auch einen neuen Film hinzufügen
  
- `movieOverviewPage:`
  - Anzeige von Film Informationen
  - Anzeige von Film Bild
- `allCinema:`
  - Anzeige von allen Kinos
  - Suchfunktion nach Bundesland und nach Name der Kino
  - Anzeige von Vorschlägen Per Javascript, wenn man auf den Searchbar klickt

- `Privacy:`
    - Die Seite enthält datenschutzrechtliche Informationen. Außerdem gibt es auch einen Link zur Widerruf des Datenschutzes.
- `terms:`
  -  Die Seite enthält Informationen zu den Nutzungsbedingungen der Website.
- `impressum:`
    - Die Seite enthält das Impressum des Websites.
- `FAQ:`
  - Hier werden häufig gestellten Fragen zur Website aufgelistet und beantwortet.
- `registerUser:`
  - Anzeige von einer Nutzer Meldung nach einer erfolgreicher Registrierung
  
- `confirmRegistrationPage:`
  - hier wird überprüft, ob der Nutzer schon registriert ist oder nicht
    - falls ja, dann wird ein link zur Anmeldung angezeigt
    - falls nein, dann wird eine Meldung an den Nutzer angezeigt und ein link, ob er sich weiter registrieren will.

## Account Login-Informationen



## Weitere Vorraussetzungen für die Nutzung
- XAMPP

## Ausgelassene Teilaufgaben
- Keine

## Bekannte Fehler und Mängel
- Keine

