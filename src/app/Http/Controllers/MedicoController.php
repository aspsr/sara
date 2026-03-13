<?php

namespace App\Http\Controllers;

use App\CommonTrait;
use App\Models\MedicoCentroVaccinale;
use App\Models\Patient;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Models\CentroVaccinale;

class MedicoController extends Controller
{
    use CommonTrait;

    public function __construct()
    {
        $this->middleware('role:medico');
    }

    private function caricaPazienti(Request $request)
    {
        $centroVaccinaleId = $request->input('centroVaccinale', session('centroVaccinaleId'));
    
        
        // Recupero i pazienti prenotati in data odierna
        $dataView['data_selezionata'] = date('Y-m-d');
        $dataView['pazienti'] = Patient::join("prenotazioni", "prenotazioni.paziente_id", "=", "patients.id", )
            ->join("centro_vaccinale", "centro_vaccinale.id", "=", "prenotazioni.centro_vaccinale_id")
            ->join("medico_centro_vaccinale", "medico_centro_vaccinale.centro_vaccinale_id", "=", "prenotazioni.centro_vaccinale_id")
            ->where("data_vaccino", date('Y-m-d'))
            ->where("medico_centro_vaccinale.patient_id", Auth::user()->id);
        if ($centroVaccinaleId == true) {
            $dataView['pazienti'] = $dataView['pazienti']->where("prenotazioni.centro_vaccinale_id", $centroVaccinaleId);
        } else {
            $mcv = new MedicoCentroVaccinale();
            $dataView['pazienti'] = $dataView['pazienti']->whereIn("prenotazioni.centro_vaccinale_id", $mcv->getCentroVaccinale(Auth::user()->id)->pluck("centro_vaccinale_id"));
        }
        $dataView['pazienti'] = $dataView['pazienti']->where('prenotazioni.stato', '!=', 2)->orderBy("prenotazione_id")

            ->select("patients.id", "patients.name", "patients.phone", "patients.surname", "patients.tax_id", "centro_vaccinale.descrizione as nome_centro_vaccinale", "prenotazioni.centro_vaccinale_id", "prenotazioni.stato", "prenotazioni.id as prenotazione_id", "data_ultimo_inoltro_msg")
            ->get();

    
        return view("medico.dashboard")->with("dataView", $dataView);
    }

    public function index(Request $request)
    {

        $centroVaccinaleId = $request->get('centroVaccinale');
        //$data = $request->get('data');
    
        // Logica per impostare il centro vaccinale selezionato nella sessione
        session(['centroVaccinaleId' => $centroVaccinaleId]);
        $centroVaccinaleId = $request->query('centroVaccinale');
        // Memorizza l'ID nella sessione
        $request->session()->put('centroVaccinaleId', $centroVaccinaleId);
       // $centroVaccinale = CentroVaccinale::find($centroVaccinaleId);
       

        return $this->caricaPazienti($request);

        //return $this->caricaPazienti($request)->with('centroVaccinale', $centroVaccinale)->with(['data' => $data]);

    }


    public function listaDisponibilita(Request $request)
    {
        $dataView['idPaziente'] = $request->idPaziente;

        $data = null;
        if (isset($request->anno)) {
            $data = $request->anno . "-" . $request->mese . "-01";
            $dataCarbon = Carbon::createFromDate($request->anno, $request->mese, 1);

            // se la data è inferiore alla data attuale non restituisco risultati
            if (
                Carbon::createFromDate($request->anno, $request->mese, date('d'))->isBefore(Carbon::today())
                || $dataCarbon->isBefore(Carbon::createFromDate(2024, 8, 1))
                || Carbon::today()->addMonths(6)->isBefore($dataCarbon)
            )
                return view('medico.sceltaData')->with('dataView', $dataView);

        }

        if (isset($data) || isset($request->centroVaccinale)) {
            $result = $this->disponibilita($data, $request->centroVaccinale);
            $page = LengthAwarePaginator::resolveCurrentPage();

            // Numero di record per pagina
            $perPage = 10;

            // Calcola il punto di partenza
            $offset = ($page - 1) * $perPage;

            // Crea una nuova collezione con i record da paginare
            $itemsForCurrentPage = array_slice($result, $offset, $perPage);

            // Crea l'istanza di LengthAwarePaginator
            $dataView['result'] = new LengthAwarePaginator(
                $itemsForCurrentPage,
                count($result),
                $perPage,
                $page,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

        }
        return view('medico.sceltaData')->with('dataView', $dataView);
        /*
                $dataView['result'] = $this->disponibilita($request->dataDisponibilita, $request->centroVaccinale);
                return view("medico.sceltaData")->with("dataView", $dataView);
                */
    }


    public function impostaPresenza(Request $request)
    {
        Prenotazione::where("paziente_id", $request->idPaziente)
            ->where("id", $request->idPrenotazione)
            ->first()->update([
                    "stato" => $request->presentato
                ]);

        return $this->caricaPazienti($request);
    }


    public function scegliFasciaView(Request $request)
    {
        $dataView['patient'] = Patient::find($request->patientID);
        $dataView['data'] = $request->dataID;
        $dataView['centroVaccinale'] = $request->centroVaccinaleID;
        $dataView['fasce'] = $this->fasce($request->dataID, $request->centroVaccinaleID);

        return view("medico.scegliFascia")->with("dataView", $dataView);
    }


    public function prenota(Request $request)
    {
        // Esegui la prenotazione del vaccino
        $this->prenotaVaccino($request->patientID, $request->dataID, $request->centroVaccinaleID, $request->fascia);
        // Aggiorna la colonna data_ultimo_inoltro_msg
        Prenotazione::where('paziente_id', $request->patientID)
            ->whereDate('data_vaccino', now()->toDateString())
            ->update(['data_ultimo_inoltro_msg' => now()->toDateString()]);



        // Reindirizza alla route 'medico.index'
        return redirect()->route('medico.index');
    }

    public function caricaPazientiPerData(Request $request)
    {
        $dataSelezionata = $request->input('scegliData', date('Y-m-d'));
        $centroVaccinaleId = $request->input('centroVaccinaleScelta', session('centroVaccinaleId'));

        $request->session()->put('centroVaccinaleId', $centroVaccinaleId);
    
        $pazientiQuery = Patient::join("prenotazioni", "prenotazioni.paziente_id", "=", "patients.id")
            ->join("centro_vaccinale", "centro_vaccinale.id", "=", "prenotazioni.centro_vaccinale_id")
            ->join("medico_centro_vaccinale", "medico_centro_vaccinale.centro_vaccinale_id", "=", "prenotazioni.centro_vaccinale_id")
            ->where("data_vaccino", $dataSelezionata)
            ->where("medico_centro_vaccinale.patient_id", Auth::user()->id);
    
        if ($centroVaccinaleId) {
            $pazientiQuery->where("prenotazioni.centro_vaccinale_id", $centroVaccinaleId);
        } else {
            $mcv = new MedicoCentroVaccinale();
            $centri = $mcv->getCentroVaccinale(Auth::user()->id)->pluck("centro_vaccinale_id");
            $pazientiQuery->whereIn("prenotazioni.centro_vaccinale_id", $centri);
        }
    
        $pazientiQuery->where('prenotazioni.stato', '!=', 2)
            ->orderBy("prenotazione_id")
            ->select("patients.id", "patients.name", "patients.surname","patients.phone","patients.tax_id", "centro_vaccinale.descrizione as nome_centro_vaccinale", "prenotazioni.centro_vaccinale_id", "prenotazioni.stato", "prenotazioni.id as prenotazione_id", "data_ultimo_inoltro_msg");
    
        $pazienti = $pazientiQuery->get();
       
    
        return view("medico.dashboard", [
            'dataView' => [
                'data_selezionata' => $dataSelezionata,
                'centroVaccinaleId' => $centroVaccinaleId,
                'pazienti' => $pazienti
            ]
        ]);
    }
    

}
