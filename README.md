
# Progetto S.A.R.A.

## Salute Accessibile per le Reti Ambulatoriali

### Manuale tecnico
**Versione:** 1  
**Data:** 30/10/2025
---
## 1. Premessa e finalità del progetto

Il progetto **S.A.R.A. – Salute Accessibile per le Reti Ambulatoriali** ha l’obiettivo di semplificare, velocizzare e rendere più sicura la gestione dei processi clinico-amministrativi, attraverso l’adozione di un modello organizzativo che valorizza le potenzialità delle tecnologie informatiche.

Uno dei principali risultati attesi è la **dematerializzazione dei flussi informativi**, finalizzata al superamento delle criticità connesse all’utilizzo esclusivo della documentazione cartacea.

L’applicativo consente la registrazione e l’aggiornamento in tempo reale dei dati dei pazienti, delle prenotazioni e delle attività cliniche, riducendo ridondanze informative, tempi di lavorazione e rischi di errore.

La **tracciabilità delle informazioni** garantisce un accesso sicuro, profilato e autorizzato ai documenti e ai referti, assicurando un miglioramento complessivo dell’efficienza operativa.

---

## 2. Entità presenti nel  sistema

Il sistema prevede i seguenti profili di accesso:

- **Paziente** – Soggetto che viene segnalato dalla figura operatore come colui il quale riceve prestazioni
- **Operatore** – Accede tramite autenticazione LDAP ad un profilo a lui dedicato
- **Amministratore** – Accesso tramite autenticazione LDAP ad un profilo a lui dedicato
- **ETS (Enti del Terzo Settore)** – Indicati dagli operatori come enti segnalatori dei Pazienti in fase di registrazione di essi stessi

---

## 3. Profilo Operatore

Il profilo operatore consente la gestione operativa delle attività clinico-amministrative.

### 3.1 Funzioni disponibili

L’operatore può:

- inserire i pazienti nel sistema;
- prenotare prestazioni sanitarie;
- gestire le configurazioni di sistema relative a:
  - branche e prestazioni;
  - agende;
  - farmaci;
  - storico dei pazienti;
- consultare le informazioni relative ai pazienti che hanno usufruito delle prestazioni.

### 4.2 Inserimento dei pazienti

L’inserimento dei pazienti può avvenire secondo due modalità:

- **Ricerca tramite APC**, utilizzando il codice fiscale;
- **Registrazione manuale**, mediante compilazione della scheda anagrafica.

I pazienti inseriti dall’operatore risultano immediatamente eleggibili e non sono soggetti a validazione.

---
## 5. Profilo Amministratore

Il profilo amministratore include tutte le funzionalità previste per l’operatore e le integra con ulteriori strumenti di controllo e analisi.

### 5.1 Funzioni aggiuntive

L’amministratore può:

- validare o contattare i pazienti registrati;
- visualizzare l’elenco dei pazienti validati;
- esportare il flusso delle prestazioni erogate per intervallo temporale;
- generare report relativi agli ETS;
- analizzare i dati di prestazioni e pazienti tramite strumenti grafici.

---

## 6. Esportazione del tracciato dati

La funzione di esportazione è riservata al profilo amministratore.

È possibile selezionare un intervallo temporale e procedere all’esportazione del tracciato in formato **CSV**, conforme alle specifiche progettuali.



## Crediti e mantenimento

**Committente:**
Azienda Sanitaria Provinciale di Siracusa
UOC SIFA e CDG – Ex ONP, Traversa La Pizzuta – Siracusa
[sifa@asp.sr.it](mailto:sifa@asp.sr.it)

**Copyright:**
© ASP Siracusa, 2025

**Manutenzione:**
ASP Siracusa - UOC Sistemi Informativi Flussi Aziendali e Controllo di Gestione - UOS Sistemi Informativi

---

## Segnalazioni di sicurezza

Le segnalazioni di sicurezza **non devono essere pubblicate tramite issue tracker**.
Inviare in modo riservato a:
[sifa@asp.sr.it](mailto:sifa@asp.sr.it)

## Licenza

Questo software è rilasciato come **open source** secondo le linee guida per il riuso del software nella Pubblica Amministrazione (AGID) con licenza EUPL v1.2
