<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB; 
use App\Models\CriterioAccessoServizio;
use Carbon\Carbon;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('auth');
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $dataView['utentiDaValidare'] = User::select(
            'users.id',
            'nome',
            'cognome',
            'email',
            'cellulare',
            'codice_fiscale',
            'allegato_tessera_sanitaria',
            'copia_primo_foglio_ISEE_minorenne',
            'documento_genitore',
            'copia_primo_foglio_ISEE',
            'permesso_soggiorno',
            'allegato_documento_identita',
            'altri_pdf',
            'note_pdf',
            'categorie_di_vulnerabilita.descrizione as categorie_vulnerabilita__nome',
            'criteri_contesto.descrizione as criteri_contesto__nome',
            'criteri_persona.descrizione as criteri_persona__nome'
        )
            ->leftJoin('criteri_accesso_servizio', 'users.id', '=', 'criteri_accesso_servizio.id_user')
            ->leftJoin('categorie_di_vulnerabilita', 'criteri_accesso_servizio.categoria_vulnerabilita', '=', 'categorie_di_vulnerabilita.id')
            ->leftJoin('criteri_contesto', 'criteri_accesso_servizio.criteri_contesto', '=', 'criteri_contesto.codice')
            ->leftJoin('criteri_persona', 'criteri_accesso_servizio.criteri_persona', '=', 'criteri_persona.codice')
            ->where('ruolo_id', 1)
            ->where('stato', 0)
            ->get();

        return view('admin.dashboard')->with('dataView', $dataView);
    }


    public function utentiValidati()
    {
              $dataView['utentiValidati'] = User::select(
            'users.id',
            'nome',
            'cognome',
            'email',
            'cellulare',
            'note',
            'codice_fiscale',
            'allegato_tessera_sanitaria',
            'copia_primo_foglio_ISEE_minorenne',
            'documento_genitore',
            'copia_primo_foglio_ISEE',
            'permesso_soggiorno',
            'allegato_documento_identita',
            'altri_pdf',
            'note_pdf',
            'categorie_di_vulnerabilita.descrizione as categorie_vulnerabilita__nome',
            'criteri_contesto.descrizione as criteri_contesto__nome',
            'criteri_persona.descrizione as criteri_persona__nome'
        )
            ->leftJoin('criteri_accesso_servizio', 'users.id', '=', 'criteri_accesso_servizio.id_user')
            ->leftJoin('categorie_di_vulnerabilita', 'criteri_accesso_servizio.categoria_vulnerabilita', '=', 'categorie_di_vulnerabilita.id')
            ->leftJoin('criteri_contesto', 'criteri_accesso_servizio.criteri_contesto', '=', 'criteri_contesto.id')
            ->leftJoin('criteri_persona', 'criteri_accesso_servizio.criteri_persona', '=', 'criteri_persona.id')
            ->where('ruolo_id', 1)
            ->where('stato', 1)
            ->get();


        return view('admin.utentiValidati')->with('dataView', $dataView);
    }

    public function validazione($idUser)
    {
        $valida = User::where('id', $idUser)
            ->update(['stato' => 1]);

        if ($valida) {
            return redirect()->route('admin.dashboard')->with('success', 'Utente validato con successo');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Errore durante la validazione dell\'utente');
        }
    }

    public function logout()
    {
        Auth::logout(); // Effettua il logout dell'utente
        session()->invalidate(); // Invalidare la sessione
        session()->regenerateToken(); // Rigenera il token CSRF per sicurezza
        return redirect()->route('login')->with('success', 'Logout effettuato con successo');
    }


    public function flussoView()
    {

        return view('admin.flusso');
    }


    public function estraiDatiFlusso(Request $request)
    {
        
     $dataDa = $request->input('data_da'); 
     $dataA = $request->input('data_a');

    $dataView['utentiDaEsportare'] = User::select('users.*', \DB::raw('MIN(prenotazioni.data_inizio) as prima_prenotazione'))
        ->join('prenotazioni', 'users.id', '=', 'prenotazioni.id_paziente')
        ->whereBetween('prenotazioni.data_inizio', [$dataDa, $dataA])
        ->where('prenotazioni.stato_prenotazione', 1)
        ->groupBy('users.id')
        ->orderBy('prima_prenotazione', 'asc')
        ->paginate(10);


        return view('admin.flusso')->with('dataView', $dataView);
    }

public function esportaFlusso(Request $request)
{
    $dataDa = $request->input('data_da');
    $dataA = $request->input('data_a');

    $righe = User::join('prenotazioni', 'users.id', '=', 'prenotazioni.id_paziente')
        ->where('prenotazioni.stato_prenotazione', '=', 1)
        ->join('scheda_paziente', 'users.id', '=', 'scheda_paziente.paziente_id')
        ->join('nomenclatore','scheda_paziente.prestazione_erogata', '=', 'nomenclatore.codice_nomenclatore')
        ->join('criteri_accesso_servizio', 'users.id', '=', 'criteri_accesso_servizio.id_user')
        ->whereBetween('prenotazioni.data_inizio', [$dataDa, $dataA])
        ->get([
            'users.id as user_id',
            'users.nome',
            'users.cognome',
            'users.data_nascita',
            'users.codice_fiscale',
            'users.nazionalita',
            'users.comune',
            'users.sesso',
            'users.id_assistito',
            'scheda_paziente.id as scheda_id',  // Aggiungo ID univoco della scheda
            'scheda_paziente.codici_icd9',
            'scheda_paziente.prestazione_erogata',
            'scheda_paziente.luogo_prestazione',
            'scheda_paziente.erogazione_farmaci',
            'scheda_paziente.tipologia_farmaco',
            'scheda_paziente.erogazione_dispositivo_medico',
            'scheda_paziente.tipologia_dispositivo_medico',
            'nomenclatore.denominazione_nomenclatore',
            'prenotazioni.id as prenotazione_id',  // Aggiungo ID univoco della prenotazione
            'prenotazioni.data_inizio',
            'criteri_accesso_servizio.condizione_professionale',
            'criteri_accesso_servizio.criteri_contesto',
            'criteri_accesso_servizio.criteri_persona',
            'criteri_accesso_servizio.titolo_studio',
            'criteri_accesso_servizio.categoria_vulnerabilita',
            'criteri_accesso_servizio.cerca_lavoro',
            'criteri_accesso_servizio.condizione_vulnerabilita_socio_economica'
        ]);

      
    // Raggruppa per utente
    $utenti = [];

    foreach ($righe as $riga) {

      
        $id = $riga->user_id;

        if (!isset($utenti[$id])) {
            $utenti[$id] = [
                'info' => [
                   'id_assistito' => $riga->id_assistito ?: $riga->codice_fiscale,
                    'data_nascita' => $riga->data_nascita,
                    'nazionalita' => $riga->nazionalita,
                    'sesso' => $riga->sesso,
                    'comune' => $riga->comune,
                    'categoria_vulnerabilita_socio_economica' => $riga->condizione_vulnerabilita_socio_economica,
                    'criteri_persona' => $riga->criteri_persona,
                    'criteri_contesto' => $riga->criteri_contesto,
                    'titolo_studio' => $riga->titolo_studio,
                    'condizione_professionale' =>  $riga->condizione_professionale,
                    'cerca_lavoro' => $riga->cerca_lavoro,
                    'categoria_vulnerabilita' => $riga->categoria_vulnerabilita,
                ],
                'prestazioni_map' => []  // Uso una mappa con ID come chiave
            ];
        }

        // Usa l'ID della scheda_paziente come chiave univoca
        $schedaId = $riga->scheda_id;
        
        if (!isset($utenti[$id]['prestazioni_map'][$schedaId])) {
            // Nuova prestazione
            $utenti[$id]['prestazioni_map'][$schedaId] = [
                'data' => $riga->data_inizio,
                'diagnosi' => [$riga->codici_icd9],
                'prestazione' => $riga->prestazione_erogata . ' - ' . $riga->denominazione_nomenclatore,
                'luogo' => $riga->luogo_prestazione,
                'farmaci' => $riga->erogazione_farmaci,
                'tipologia_farmaco' => $riga->tipologia_farmaco,
                'dispositivo' => $riga->erogazione_dispositivo_medico,
                'tipologia_dispositivo' => $riga->tipologia_dispositivo_medico,
            ];
        } else {
            // Prestazione già esistente, aggiungi solo diagnosi se diversa
            if (!in_array($riga->codici_icd9, $utenti[$id]['prestazioni_map'][$schedaId]['diagnosi'])) {
                $utenti[$id]['prestazioni_map'][$schedaId]['diagnosi'][] = $riga->codici_icd9;
            }
        }
    }

    // Converti la mappa in array e prendi solo le prime 3
    foreach ($utenti as &$utente) {
        $utente['prestazioni'] = array_slice(array_values($utente['prestazioni_map']), 0, 3);
        unset($utente['prestazioni_map']);
    }

    $filename = "flusso_completo_" . now()->format('Ymd_His') . ".csv";
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $callback = function () use ($utenti) {
        $file = fopen('php://output', 'w');
        $delimiter = ';';

        $header = [
            'Beneficiario',
            'Nome beneficiario',
            'Codice Utente',
            'Data di nascita',
            'Stato nascita',
            'Genere',
            'Comune Residenza',
            'Diagnosi (per la quale viene erogato il farmaco o il dispositivo)',
            'Prestazione erogata',
            'Luogo della prestazione',
            'Erogazione farmaci',
            'Tipologia farmaco',
            'Erogazione dispositivo medico',
            'Tipologia dispositivo medico erogato',
            'SECONDA Diagnosi (per la quale viene erogato il farmaco o il dispositivo)',
            'SECONDA Prestazione erogata',
            'SECONDO Luogo della prestazione',
            'SECONDA Erogazione farmaci',
            'SECONDA Tipologia farmaco',
            'SECONDA Erogazione dispositivo medico',
            'SECONDA Tipologia dispositivo medico erogato',
            'TERZA Diagnosi (per la quale viene erogato il farmaco o il dispositivo)',
            'TERZA Prestazione erogata',
            'TERZA Luogo della prestazione',
            'TERZA Erogazione farmaci',    
            'Terza Tipologia farmaco',
            'TERZA Erogazione dispositivo medico',
            'TERZA Tipologia dispositivo medico erogato',
            'Condizione di vulnerabilita\' socio economica',
            '3.1 CRITERI RIFERITI ALLA PERSONA (indicare almeno uno dei seguenti documenti nella disponibilità del beneficiario)',
            '3.2 CRITERI RIFERITI AL CONTESTO (indicare il contesto rappresentato nel documento prodotto dal beneficiario e nella disponibilità dello stesso e attestante la vulnerabilità socio-economica in riferimento al contesto di deprivazione in cui è svolto l\'intervento)',
            'titolo di studio',
            'condizione professionale',
            'Da quanto tempo e\' in cerca di lavoro',
            'Categorie di vulnerabilità'
        ];

        fputcsv($file, $header, $delimiter);

   

        foreach ($utenti as $utente) {
            $info = $utente['info'];
            $p1 = $utente['prestazioni'][0] ?? [];
            $p2 = $utente['prestazioni'][1] ?? [];
            $p3 = $utente['prestazioni'][2] ?? [];


            $row = [
                '190208',
                'ASP_SR',
                $info['id_assistito'],
                $info['data_nascita'],
                $info['nazionalita'],
                $info['sesso'],
                $info['comune'],
                isset($p1['diagnosi']) ? implode(',', $p1['diagnosi']) : '',
                $p1['prestazione'] ?? '',
                $p1['luogo'] ?? '',
                $p1['farmaci'] ?? '',
                $p1['tipologia_farmaco'] ?? '',
                $p1['dispositivo'] ?? '',
                $p1['tipologia_dispositivo'] ?? '',
                isset($p2['diagnosi']) ? implode(',', $p2['diagnosi']) : '',
                $p2['prestazione'] ?? '',
                $p2['luogo'] ?? '',
                $p2['farmaci'] ?? '',
                $p2['tipologia_farmaco'] ?? '',
                $p2['dispositivo'] ?? '',
                $p2['tipologia_dispositivo'] ?? '',
                isset($p3['diagnosi']) ? implode(',', $p3['diagnosi']) : '',
                $p3['prestazione'] ?? '',
                $p3['luogo'] ?? '',
                $p3['farmaci'] ?? '',
                $p3['tipologia_farmaco'] ?? '',
                $p3['dispositivo'] ?? '',
                $p3['tipologia_dispositivo'] ?? '',
                $info['categoria_vulnerabilita_socio_economica'] ?? '',
                $info['criteri_persona'] ?? '',
                $info['criteri_contesto'] ?? '',
                $info['titolo_studio'] ?? '',
                $info['condizione_professionale'] ?? '',
                $info['cerca_lavoro'] ?? '',
                $info['categoria_vulnerabilita'] ?? '',
            ];

            fputcsv($file, $row, $delimiter);
        }
        
        

        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
}


public function etsView()
    {
        return view('admin.ets');
    }   


public function estraiDatiEts(Request $request){
        
     $dataDa = $request->input('data_da'); 
     $dataA = $request->input('data_a');

    /* $dataView['utentiDaEsportare'] = User::select('users.nome','users.cognome','criteri_accesso_servizio.id_ets','prenotazioni.*', 'ets.descrizione as descrizione_ets')
        ->join('prenotazioni', 'users.id', '=', 'prenotazioni.id_paziente')
        ->join('criteri_accesso_servizio', 'users.id', '=', 'criteri_accesso_servizio.id_user')
        ->join('ets', 'criteri_accesso_servizio.id_ets','=', 'ets.id')
        ->whereBetween('prenotazioni.data_inizio', [$dataDa, $dataA])
        ->where('prenotazioni.stato_prenotazione', '=', 1)
        ->orderBy('prenotazioni.data_inizio', 'asc')
        ->get();*/

         $dataView['conteggiPerEts'] = User::select(
            'ets.descrizione as descrizione_ets',
            DB::raw('COUNT(*) as totale_prenotazioni')
        )
        ->join('prenotazioni', 'users.id', '=', 'prenotazioni.id_paziente')
        ->join('criteri_accesso_servizio', 'users.id', '=', 'criteri_accesso_servizio.id_user')
        ->join('ets', 'criteri_accesso_servizio.id_ets', '=', 'ets.id')
        ->whereBetween('prenotazioni.data_inizio', [
            Carbon::parse($dataDa)->startOfDay(),
            Carbon::parse($dataA)->endOfDay()
        ])
        ->where('prenotazioni.stato_prenotazione', '=', 1)
        ->groupBy('ets.id', 'ets.descrizione')
        ->orderBy('totale_prenotazioni', 'desc')
        ->get();

        return view('admin.ets')->with('dataView', $dataView);
}



    public function scaricaETS(Request $request)
    {
        $dataDa = $request->input('data_da');
        $dataA = $request->input('data_a');

        $dataView = [];
        $dataView['dataDa'] = $dataDa;
        $dataView['dataA'] = $dataA;

        // Passo in sessione flash per la view
        return redirect()->back()->with('dataView', $dataView);
    }

    
    public function aggiornaDatiPaziente(Request $request, $pazienteId){

        $dataView['user'] =  User::find($pazienteId);

        $dataView['criteriAccesso'] = CriterioAccessoServizio::where('id_user',$pazienteId)->first();

      //  dd($dataView['criteriAccesso']);
        
        $dataView['nazioni'] = DB::table('nazionalita')
            ->select('id', 'nome_nazione', 'codice_nazione')
            ->get();

        $dataView['criteri_persona'] = DB::table('criteri_persona')
            ->select('id', 'descrizione','codice')
            ->get();

        $dataView['criterio_contesto'] = DB::table('criteri_contesto')
            ->select('id', 'descrizione','codice')
            ->get();

        $dataView['titoli_di_studio'] = DB::table('titoli_di_studio')
            ->select('id', 'descrizione')
            ->get();

        $dataView['condizione_professionale'] = DB::table('condizione_professionale')
            ->select('id', 'descrizione')
            ->get();

        $dataView['ricerca_lavoro'] = DB::table('ricerca_lavoro')
            ->select('id', 'descrizione')
            ->get();

        $dataView['categorie_di_vulnerabilita'] = DB::table('categorie_di_vulnerabilita')
            ->select('id', 'descrizione')
            ->get();

        // Aggiungi la voce "Altro tipo di vulnerabilità" con id 7 solo se non esiste già
        if (!$dataView['categorie_di_vulnerabilita']->contains('id', 7)) {
            $dataView['categorie_di_vulnerabilita']->push((object)[
                'id' => 7,
                'descrizione' => 'Altro tipo di vulnerabilità'
            ]);
        }

        $dataView['nazionalita'] = DB::table('nazionalita')
            ->select('id', 'nome_nazione', 'codice_nazione')
            ->get();

        $dataView['ets'] = DB::table('ets')
            ->select('id', 'descrizione')
            ->get();

        $dataView['comuni'] = DB::table('comuni')
            ->select('istat_comune', 'comune')
            ->get();

        return view('operatore.dashboard')->with('dataView', $dataView);
}



public function aggiornaDati(Request $request, $id)
{

//    dd($request->all());
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'Utente non trovato');
    }


    $user->update([
        'nome' => $request->nome,
        'cognome' => $request->cognome,
        'sesso' => $request->sesso,
        'email' => $request->email ?? null,
        'ruolo' => $request->ruolo,
        'cellulare' => $request->cellulare,
        'indirizzo' => $request->indirizzo,
        'data_nascita' => $request->data_nascita,
        'codice_fiscale' => $request->codice_fiscale,
        'nazionalita' => $request->nazionalita,
        'comune' => $request->comune,
        'indirizzo_residenza' => $request->indirizzo_residenza,
        'luogo_nascita' => $request->luogo_nascita,
        'stato' => 1,
        'ruolo_id' => 1,
        'modalita_autenticazione' => 1,
        'creato_da' => Auth::id(),
        'id_assistito' => $request->id_assistito ?? null,
        'updated_at' => now(),
    ]);

    
    $criterio = CriterioAccessoServizio::where('id_user', $id)->first();

    if (!$criterio) {
        return redirect()->back()->with('error', 'Criteri di accesso non trovati');
    }

    
    $fileFields = [
        'allegato_tessera_sanitaria',
        'copia_primo_foglio_ISEE_minorenne',
        'documento_genitore',
        'copia_primo_foglio_ISEE',
        'permesso_soggiorno',
        'allegato_documento_identita',
    ];

   
    $data = [
        'id_ets' => $request->ets,
        'titolo_studio' => $request->titolo_studio,
        'condizione_professionale' => $request->condizione_professionale,
        'cerca_lavoro' => $request->ricerca_lavoro,
        'categoria_vulnerabilita' => $request->categoria_vulnerabilita,
        'condizione_vulnerabilita_socio_economica' => $request->conferma,
        'criteri_contesto' => $request->criteri_contesto,
        'criteri_persona' => $request->criteri_persona,
        'note' => $request->note,
        'note_pdf' => $request->descrizione_file,
        'updated_at' => now(),
    ];

  
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $data[$field] = $request->file($field)->store('allegati', 'public');
        } else {
            $data[$field] = $criterio->$field; 
        }
    }

   
    if ($request->hasFile('altri_file')) {
        $paths = [];
        foreach ($request->file('altri_file') as $file) {
            $paths[] = $file->store('allegati', 'public');
        }
        $data['altri_pdf'] = implode(',', $paths);
    } else {
        $data['altri_pdf'] = $criterio->altri_pdf; // mantieni quelli esistenti
    }

    // 🔹 Aggiorna i criteri di accesso
    $criterio->update($data);

    return redirect()->route('admin.utentiValidati')->with('success', 'Utente aggiornato con successo');
}




public function indexGrafici(Request $request)
{
    $dataInizio = $request->data_inizio 
        ? Carbon::parse($request->data_inizio)->startOfDay() 
        : Carbon::now()->startOfMonth();

    $dataFine = $request->data_fine 
        ? Carbon::parse($request->data_fine)->endOfDay() 
        : Carbon::now()->endOfMonth();


    // Utenti unici con prenotazioni erogate
    $dataView['beneficiariUnici'] = User::join('prenotazioni', 'users.id', '=', 'prenotazioni.id_paziente')
        ->where('prenotazioni.stato_prenotazione', 1)
     ->whereBetween('prenotazioni.data_inizio', [
            Carbon::parse($dataInizio)->startOfDay(),
            Carbon::parse($dataFine)->endOfDay()
        ])
        ->distinct('users.id')
        ->count('users.id');


    $dataView['beneficiariTotali'] = DB::table('prenotazioni')
        ->where('stato_prenotazione', 1)
          ->whereBetween('prenotazioni.data_inizio', [
            Carbon::parse($dataInizio)->startOfDay(),
            Carbon::parse($dataFine)->endOfDay()
        ])
        ->count();

$dataView['prestazioniPiuFrequenti'] = DB::table('prenotazioni')
    ->where('stato_prenotazione', 1)
      ->whereBetween('prenotazioni.data_inizio', [
            Carbon::parse($dataInizio)->startOfDay(),
            Carbon::parse($dataFine)->endOfDay()
        ])
    ->join('nomenclatore', 'prenotazioni.branca_id', '=', 'nomenclatore.codice_nomenclatore')
    ->select('nomenclatore.denominazione_nomenclatore', DB::raw('COUNT(*) as totale'))
    ->groupBy('nomenclatore.denominazione_nomenclatore')
    ->orderByDesc('totale')
    ->limit(5)
    ->get();

    $dataView['prestazioniNomi'] = $dataView['prestazioniPiuFrequenti']->pluck('denominazione_nomenclatore')->toArray();
    $dataView['prestazioniTotali'] = $dataView['prestazioniPiuFrequenti']->pluck('totale')->toArray();


    $dataView['mediaPrestazioniPerBeneficiarioUnico'] = $dataView['beneficiariUnici'] > 0 
        ? round($dataView['beneficiariTotali'] / $dataView['beneficiariUnici'], 2) 
        : 0;

    // Passa le date anche alla vista, se utile
    $dataView['data_inizio'] = $dataInizio->toDateString();
    $dataView['data_fine'] = $dataFine->toDateString();

    return view('admin.grafici')->with('dataView', $dataView);
}



}
