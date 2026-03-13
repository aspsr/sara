<?php

require_once "phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php";

// Configurazione dei parametri di connessione al database
$servername = "mariadb";
$username = "vaccinazioni_user";
$password = "";
$dbname = "vaccinazioni";

try {
    // Creazione della connessione PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connessione fallita: " . $e->getMessage());
}

// Query per i pazienti con vaccinazione tra 48 ore
$sql = "SELECT 
    prenotazioni.paziente_id, 
    prenotazioni.data_vaccino,
    prenotazioni.fascia_inizio AS orario,
    p_figlio.name AS nome,
    p_figlio.surname AS cognome,
    ce.email AS email_centro,
    ce.telefono AS telefono_centro,
    ce.indirizzo AS indirizzo_centro,
    ce.citta AS citta,
    p_figlio.email AS email_paziente,
    p_padre.name AS nome_padre,
    p_padre.surname AS cognome_padre,
    p_padre.email AS email_padre,
    COALESCE(p_padre.email, p_figlio.email) AS email
FROM 
    prenotazioni
JOIN 
    patients AS p_figlio ON prenotazioni.paziente_id = p_figlio.id
LEFT JOIN 
    padre_figlio AS pf ON p_figlio.id = pf.figlio_id
LEFT JOIN 
    patients AS p_padre ON pf.padre_id = p_padre.id
JOIN 
    centro_vaccinale AS ce ON prenotazioni.centro_vaccinale_id = ce.id
WHERE 
    prenotazioni.stato = -1
    AND prenotazioni.data_vaccino = DATE_ADD(CURRENT_DATE(), INTERVAL 2 DAY)";

// Esecuzione della query e iterazione sui risultati
$stmt = $conn->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $messaggioTmp =  "Gentile utente, 
    <br>
    Le ricordiamo che ha una prenotazione per" . " " . "<strong>" . ucfirst(strtolower($row["nome"])) . " " . ucfirst(strtolower($row["cognome"])) . "." . "</strong>" .
    "<br>" .
    "<ul>" .
    "<li>" .
    " Data  : " . " " . "<strong>" . date("d/m/Y", strtotime($row['data_vaccino'])) . "</strong>" .
    "<li>" .
    "Luogo: " . "<strong>" . $row['citta'] . "</strong>" .
    "</li>" .
    "<li>" .
    "Orario: " . "<strong>" . date("G:i", strtotime ($row["orario"])) . "</strong>" .
    "</li>" .  
    "<br>" .
    "Informazioni sul centro vaccinale :" .
    "<br>" .
    "<br>" .

    "<li>" .
    " Indirizzo: " . "<strong>" . $row["indirizzo_centro"] . "</strong>" .
    "</li>" .
    "<li>" .
    " Email: " . "<strong>" . $row["email_centro"] . "</strong>" .
    "</li>" .
    "<li>" .
    "Telefono: " . "<strong>" . $row["telefono_centro"] . "</strong>" .
    "</li>" 
    . "</ul>" .
    "<br>" .
    "La invitiamo a presentarsi con un documento d'identita' e la tessera sanitaria." .
    "<br>" .
    "Cordiali saluti, ASP SR.";

    $mail = new PHPMailer(true);

    try {
        // Configurazione server di posta
        $mail->isSMTP();
        $mail->Host = 'webmail.asp.sr.it';
        $mail->SMTPAuth = true;
        $mail->Username = 'notifiche@asp.sr.it';
        $mail->Password = 'Z0nn4W2022@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Impostazioni email
        $mail->setFrom('notifiche@asp.sr.it', 'Notifiche ASP SR');
        $mail->addAddress($row['email']);

        // Contenuto dell'email
        $mail->isHTML(true);
        $mail->Subject = "Vaccinazioni";
        $mail->Body = $messaggioTmp;

        $mail->send();
    } catch (Exception $e) {
        echo "Impossibile inviare il messaggio. Errore: {$mail->ErrorInfo}";
    }
}

/**************************************************************************************************************7 GIORNI******************************************************************************************** */

$sql = "SELECT 
    prenotazioni.paziente_id, 
    prenotazioni.data_vaccino,
    prenotazioni.fascia_inizio AS orario,
    p_figlio.name AS nome,
    p_figlio.surname AS cognome,
    ce.email AS email_centro,
    ce.telefono AS telefono_centro,
    ce.indirizzo AS indirizzo_centro,
    ce.citta AS citta,
    p_figlio.email AS email_paziente,
    p_padre.name AS nome_padre,
    p_padre.surname AS cognome_padre,
    p_padre.email AS email_padre,
    COALESCE(p_padre.email, p_figlio.email) AS email
FROM 
    prenotazioni
JOIN 
    patients AS p_figlio ON prenotazioni.paziente_id = p_figlio.id
LEFT JOIN 
    padre_figlio AS pf ON p_figlio.id = pf.figlio_id
LEFT JOIN 
    patients AS p_padre ON pf.padre_id = p_padre.id
JOIN 
    centro_vaccinale AS ce ON prenotazioni.centro_vaccinale_id = ce.id
WHERE 
    prenotazioni.stato = -1
    AND prenotazioni.data_vaccino = DATE_ADD(CURRENT_DATE(), INTERVAL 7 DAY)";


$stmt = $conn->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $messaggioTmp =  "Gentile utente, 
    <br>
    Le ricordiamo che ha una prenotazione per" . " " . "<strong>" . ucfirst(strtolower($row["nome"])) . " " . ucfirst(strtolower($row["cognome"])) . "." . "</strong>" .
    "<br>" .
    "<ul>" .
    "<li>" .
    " Data  : " . " " . "<strong>" . date("d/m/Y", strtotime($row['data_vaccino'])) . "</strong>" .
    "<li>" .
    "Luogo: " . "<strong>" . $row['citta'] . "</strong>" .
    "</li>" .
    "<li>" .
    "Orario: " . "<strong>" . date("G:i", strtotime ($row["orario"])) . "</strong>" .
    "</li>" .  
    "<br>" .
    "Informazioni sul centro vaccinale :" .
    "<br>" .
    "<br>" .

    "<li>" .
    " Indirizzo: " . "<strong>" . $row["indirizzo_centro"] . "</strong>" .
    "</li>" .
    "<li>" .
    " Email: " . "<strong>" . $row["email_centro"] . "</strong>" .
    "</li>" .
    "<li>" .
    "Telefono: " . "<strong>" . $row["telefono_centro"] . "</strong>" .
    "</li>" 
    . "</ul>" .
    "<br>" .
    "La invitiamo a presentarsi con un documento d'identita' e la tessera sanitaria." .
    "<br>" .
    "Cordiali saluti, ASP SR.";

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'webmail.asp.sr.it';
        $mail->SMTPAuth = true;
        $mail->Username = 'notifiche@asp.sr.it';
        $mail->Password = 'Z0nn4W2022@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        $mail->setFrom('notifiche@asp.sr.it', 'Notifiche ASP SR');
        $mail->addAddress($row['email']);

        $mail->isHTML(true);
        $mail->Subject = "Vaccinazioni";
        $mail->Body = $messaggioTmp;

        $mail->send();
    } catch (Exception $e) {
        echo "Impossibile inviare il messaggio. Errore: {$mail->ErrorInfo}";
    }
}
