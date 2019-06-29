
# Blog aplikacija

## Konfiguracija servera
 -  Ubuntu **>= 16.04**
 -  PHP **>= 7.0** (**PDO**,  **Tidy**, **BCrypt**)
 -  Mysql **>= 14**

## Korisničke opcije

 1. Dodavanje novih objava
 2. Lista svih objava sa opcijom odabira autora 
 3. Izmena objava
 4. Brisanje objava

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
  - Prilikom na klika na dugme za brisanje objave, izaćiće mu prozor sa pitanjem "Da li ste sigurni da želite da obrišete ovaj post?". Kao i sa obaveštenjem da se 
 ![](https://joker.rs/images/new_blog/brisanje.png)
	
	- Ukoliko autor izabrao svoju objavu da obrise dobiće obaveštenje da je uspešno obrisao objavu
	
	![](https://joker.rs/images/new_blog/obrisano.png)
	
	- Ukoliko nije autor objave, izaćiće obaveštenje kako ne moe da obriše objavu
	
	![](https://joker.rs/images/new_blog/greskabrisanje.png)
	
## Opcije krajnjeg korisnika

 1. Pregled svih objava
 2. Pregled objava po autoru
 3. Pregled zasebne objave

