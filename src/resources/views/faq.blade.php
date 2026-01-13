@extends('bootstrap-italia::page')

@section("bootstrapitalia_css")
<link type="text/css" rel="stylesheet" href="{{ asset('css/spid-sp-access-button.min.css') }}" />
<link rel="stylesheet" href="<path-a-bootstrap-italia>/dist/css/bootstrap-italia.min.css" />

@endsection


@section('content')
<div class="container">
    <h4 style="text-align:center"> FAQ - Domande Frequenti </h4>
    <div class="row justify-content-center">
       
        <div class="col-md-12">
            <div class="card" style="border-box">

                <div class="card-body">
                    <h4>Assistito con anagrafica non certificata</h4>
                    <p>Non &egrave; possibile fare accesso in piattaforma in quanto i dati non sono validabili. Contattare direttamente il centro vaccinale pi&ugrave; vicino.</p>

                    <h4>Vaccinazioni nuovi nati</h4>
                    <p>Non &egrave; possibile prenotare un appuntamento a nome di un soggetto non ancora dotato di Codice Fiscale o tessera sanitaria. In questo caso uno dei due genitori può procedere con la prenotazione di un appuntamento a suo nome specificando nelle note di prenotazione che si tratta di una prenotazione per la prima vaccinazione di un nuovo nato non ancora dotato di codice fiscale. </p>

                    <h4>Quanto dura la vaccinazione</h4>
                    <p>Il tempo di una vaccinazione &egrave; mediamente di 15 minuti, ma ovviamente dipende da caso a caso.</p>

                    <h4>Quali documenti devo portare con me</h4>
                    <p>&egrave; necessario avere a disposizione sempre un documento di identit&agrave; e la tessera sanitaria. </p>

                    <h4>Come posso prenotare la vaccinazione</h4>
                    <p>&egrave; possibile prenotare un solo appuntamento per se stessi oppure per un utente collegato. Il collegamento di un utente deve essere certificato attraverso la tessera sanitaria. </p>

                    <h4>Cosa mi serve per registrarmi</h4>
                    <p>&egrave; necessario avere a disposizione il codice fiscale, la tessera sanitaria, una mail attiva ed un numeri di telefono cellulare</p>

                    <h4>Quale &egrave; la differenza tra i profili previsti</h4>
                    <p>Esiste un profilo principale relativo all'utente che attiva l'account, che valida i suoi dati sia tramite OTP ricevuto si tramite SMS che tramite OTP ricevuto via mail.
					L'utente principale può prenotare un solo appuntamento per s&egrave; stesso oppure per uno degli utenti collegati al proprio profilo (ad esempio figli, genitori anziani, ecc).
					</p>

                    <h4>Quali soggetti posso registrare nel profilo utente collegato</h4>
                    <p>Il profilo collegato permette ad utenti che hanno difficoltà o impossibilità a prenotare un appuntamento tramite l'utente principale. Soggetti che rientrano in tale categoria sono ad esempio: bambini, soggetti anziani, soggetti con difficoltà nell'utilizzo dei mezzi digitali. </p>

                    <h4>Dove si trovano i centri vaccinali</h4>
                    <p>I centri vaccinali sono distribuiti in tutta la provincia. &egrave; possibile leggere la lista completa al seguente link: <a href="https://www.asp.sr.it/Azienda/Centri-Vaccinali-SEMP" target="_blank">centri vaccinali</a></p>

                    <h4>Chi posso contattare in caso di dubbi, difficolt&agrave; o segnalazioni</h4>
                    <p>Se non riesci a completare la prenotazione di un appuntamento puoi scrivere a: vaccinazioni.sifa@asp.sr.it, per qualsiasi chiarimento di tipo sanitario sulla vaccinazione contatta semp@asp.sr.it </p>

                </div>
            </div>
        </div>
    </div>
    <br>
   
</div>


<style>
    .card {
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .4rem;
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }
</style>

@endsection
