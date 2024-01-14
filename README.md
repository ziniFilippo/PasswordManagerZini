# PasswordManagerZini
Un password manager online fatto da Filippo Zini.

**Che problema risolve?**

Risolve il problema legato alla gestione delle password. Più nello specifico il problema riguarda il "doversi ricordare" quale password è stata utilizzata per quale sito web/applicazione.

**Come lo risolve?**

Lo risolve utilizzando uno storage online al quale si può accedere solo tramite una master password. L'utente in questo modo deve solo ricordarsi una credenziale.

**A chi è rivolto?**

A tutti quegli utenti che hanno tante password e vogliono una soluzione sicura ed efficiente per non doversele ricordare.

**Funzionalità**
- Creazione Account
- Eliminazione Account
- Login sicuro e affidabile
- Gestione password(add,delete,modify)
- Controllo sicurezza password
- Notifica aggiornamento e modifica password obsolete tramite rigenerazione password

**Entità**
- Account
- Credenziale
- Sessione
- Verifica

<br><br>

# Diagramma E-R

![ERD](https://github.com/ziniFilippo/PasswordManagerZini/assets/101709141/2290b4f6-52a0-4fee-8567-895849c964f0)

<br><br>

# Modello(i) Relazionale(i)

- **Account**(<ins>**id**</ins> ,mail,sha3,salt);
- **Credenziale**(<ins>**id**</ins> ,<ins>account_id</ins>,mail,password,sito,data);
- **Sessione**(<ins>**id_sessione**</ins> ,<ins>account_id</ins>,data_inizio,timeout);
- **Verifica**(<ins>**id**</ins> ,mail,data_richiesta,token_auth,sha3,salt);

<br><br>

# Design e Mockup

**login**
![immagine](https://github.com/ziniFilippo/PasswordManagerZini/assets/101709141/057e2953-1733-4f58-af36-ff949bcd4510)

**aggiunta password**

![immagine](https://github.com/ziniFilippo/PasswordManagerZini/assets/101709141/4950508c-21ed-4d00-b510-90bfa25d9383)

**gestione passwords**

![immagine](https://github.com/ziniFilippo/PasswordManagerZini/assets/101709141/b1df62b3-3319-449c-b202-e7ab6235c1db)



# TODO LIST

- [x] aggiungere eliminazione e modifica di password singole salvate nella tabella in view_password.php

- [x] aggiungere ricerca password per sito o mail in view_password

- [ ] aggiungere funzionalità profilo