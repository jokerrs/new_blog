


# Blog aplikacija

 1. [Konfiguracija servera](#konfiguracija-servera)
 2. [Instalacija](#Instalacija)
 3. [Korisničke opcije](#korisni%C4%8Dke-opcije)
 4. [Opcije krajnjeg korisnika](#opcije-krajnjeg-korisnika)

## Konfiguracija servera
 -  Ubuntu **>= 16.04**
 -  PHP **>= 7.0** (**PDO**,  **Tidy**, **BCrypt**)
 -  Mysql **>= 14**
 - Apache **>= 2.4**
 
## Instalacija
 -  Promeniti u fajlu **konfiguracija.php** sledeće varijable
    - $link_sajta (U odgovarajući domen na kome će biti blog aplikacija)
    - $password (U odgovarajući password za mysql bazu podataka)
    - $username (U odgovarakući username za mysql bazu podataka)
    - $dbhost (U odgovarajući database hose, u većini slučajeva je to *localhost*)
    - $dbname (U odgovarajuće ima baze koja je uneta u ovom slučaju je to *zadatak1*, i preporučuje se da ostane ta ista)
- Importovati bazu podataka, koja se nalazi u repozitorijumu.

## Korisničke opcije

 1. [Dodavanje novih objava](#dodavanje-novih-objava)
 2. [Lista svih objava sa opcijom odabira autora](#lista-svih-objava-sa-opcijom-odabira-autora) 
 3. [Izmena objava](#izmena-objava)
 4. [Brisanje objava](#brisanje-objava)

### Dodavanje novih objava
![](https://joker.rs/images/new_blog/add_new.png)

 - Sva polja su obavezna
 - TinyMCE editor se koristii za uređivanje sadržaja, veoma je jedostavan za upotrebu. Takođe TinyMCE podržava otpremanje slike, tako da se sike mogu koristiti u samom sadržaju.
 - Glavna slika objave se otprema automatski tj odma, tako da bi korisnik tj. autor mogao odmah da vidi da li je to ta slika.
 - Ukoliko korisnik tj autor, hoće da unese objavu, pre nego što popuni sva polja. Dobiće obaceštenje da su sva polja obavezna. Takođe ukoliko uspe da zaobiđe prvu liniju "odbrane" sa korisniče strane. Server će odgovoriti da su opet sva polja obavezna.
 - Datum unetog posta se automatski dodaje prilikom unosa u bazu podataka.

### Lista svih objava sa opcijom odabira autora 
![](https://joker.rs/images/new_blog/post_list.png)

 - Korisnik može da vidi koliko ukupno objava ima.
 - Takođe moe da pretražuje njih kroz listu svih objava.
 - Samo autor posta može da vrši promenu svog posta kao i brisanje istog. Ni jedan drugi autor ne može da obriše niti izmeni *tuđu* objavu.
 - Može se vršiti sortiranje objava po autoru. Tako što se izabere ime autora na samom dnu liste u padajućem meniju. 
![](https://joker.rs/images/new_blog/lista_autora.png)

 - Na istoj stranici autor tj korisnik može da odabere koju objavu želi da obriše ili izmeni, da naglasim još jednom samo objave koje je objavio isti autor tj može da izmeni sam svoje objave.
 - Na toj stranici korisnik može da poleda ceo sadržaj objave tako što će da klikne na link *Pogledaj ceo saržaj/Izmeni/Obriši*
  
  ![](https://joker.rs/images/new_blog/pogledajizmeniobrisi.png)
  

 - Kada korisnik pritisne na link otvara se pod-tabela za izabranu objavu
![](https://joker.rs/images/new_blog/pod_tabela.png)        
   - Tu korisnik može da izabere da li želi da obriše objavu ili je izmeni.
   - Takođe može da vidi ceo saržaj objave kao i datum i vreme kada je ista uneta
## Izmena objava
- Prilkom klika na dugme **Izmeni post**, pretraživač će autora tj korisnika da prebaci na novu stranicu na kojoj može da izmeni članak.
![](https://joker.rs/images/new_blog/izmenaclanka.png)
 
  - Ukoliko autor želi da izmeni glavnu sliku članka, dovoljno je samo da klikne na dugme "Odaberi datoteku".
  - Ovde važi isto pravilo ao i za pravljenje novog članka, tj koristi se TinyMce text editor koji nam omogućava brže i lakše manipulisanje sa sadržajem članka.
  - Takođe ukoliko korisnik koji nije autor izabranog članka pokuša da izmeni članak, neće uspeti, obzirom da nije autor istog. Tako da samo autor može da menja svoj članak.
  - Kada je uspešno izmenjen članak, autoru tj korisniku izlazi poruka da je članak uspešno izmenjen
  ![](https://joker.rs/images/new_blog/uspesnaizmena.png)
     - Takođe može da pogleda članak pritiskom na link "ovde"
  - Kada je članak izmenjen na delu sajta za krajnjeg korisnika se pojavljuje datum i vreme kada je čllanak izmenjen.
  ![](https://joker.rs/images/new_blog/slikavremena.png)
  
## Brisanje objava
   - Prilikom na klika na dugme za brisanje objave, izaćiće mu prozor sa pitanjem "Da li ste sigurni da želite da obrišete ovaj post?". Kao i sa obaveštenjem da se 
 
 ![](https://joker.rs/images/new_blog/brisanje.png)
 
 - Ukoliko autor izabrao svoju objavu da obrise dobiće obaveštenje da je uspešno obrisao objavu
 
 ![](https://joker.rs/images/new_blog/obrisano.png)

- Ukoliko nije autor objave, izaćiće obaveštenje kako ne moe da obriše objavu

 ![](https://joker.rs/images/new_blog/greskabrisanje.png)
  
## Opcije krajnjeg korisnika

 1. [Pregled svih objava](#Pregled-svih-objava)
 2. [Pregled objava po autoru](#Pregled-objava-po-autoru)
 3. [Pregled zasebne objave](#Pregled-zasebne-objave)

### Pregled svih objava
- Prilikom posete samog bloga, prvo što vidi krajnji korisnik jeste početna strana bloga, koja sadrži:
  -  Sa leve strane četiri članka. Prvi članak je poslednje dodati članak, a drugi je dodat pre nje i tako dalje.
  - Sa desne strane kao što vidimo imamo deset nasumičnih naslova, koji vode ka istim člancima.
  - U gornjem desnom uglu možemo videti da piše *Pocetna* i *Admin panel*, prilikom klika na link *Početna* on nas vodi ka početnoj strani samog bloga. Dok *Admin panel * nas vodi u poseban deo za autore, gde mogu da dodaju, menjaju i brišu članke. Ukoliko autor nije prijavljen, umestno *Admin panel* imaćemo link za prijavu i pri tome će pisati *Login*
  - Ispod četvrtog tj poslednjeg članka na početnoj strani, imamo paginaciju kojom možemo da listamo dalje članke.
  - Takođe sam članak sadrži dva linka, tj link od autora i link ka istom članku.
  - Prilikom klika na ime autora idemo na poseban deo bloga koji nam prikazuje sve članke od odabranog autora.
  - Prilikom klika na "Više" link nas vodi na samu stranicu od tog članka, gde ga možemo pročitati u celosti.

![](https://joker.rs/images/new_blog/pocetna.png)

### Pregled objava po autoru

- Ukoliko krajnji korisnik klikne na ime autora u bilo kom delu bloga, link će ga odvesti na stranicu na kojoj su prikazani sve objave izabranog autora.
- Isto tako kao i na početnoj strani imamo više delova sajta koji su intentični u oba slučaja. Stim što ovde imamo i ime autora kojeg smo odabrali.

 ![](https://joker.rs/images/new_blog/blogautor.png)

### Pregled zasebne objave
- Sve ostalo je isto kao i na predhodnim delovima sajta. Osim što u ovom slučaju imamo sa leve strane samo jedan članak i čitav njegov sadržaj sa njegovom glavnom slikom i sa slikama koje se nalaze u samom sadržaju članka. Kao što se može isto videti na priloženoj fotografiji.
- Vidimo koje autor članka, kada je postavljen članak i kada je izmenjen članak.

![](https://joker.rs/images/new_blog/zasebnaobjava.png)