<?php

namespace App\Http\Controllers;

use App\CommonTrait;
use App\Models\CentroVaccinale;
use App\Models\ChiusuraCentroVaccinale;
use App\Models\Patient;
use App\Models\Prenotazione;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OperatoreController extends Controller
{
    use CommonTrait;


    private function sceltaDataView($idPaziente, $nomePaziente) {
        $dataView['idPaziente'] = $idPaziente;
        $dataView['nomePaziente'] = $nomePaziente;
        return view('operatore.sceltaData')->with('dataView', $dataView);        
    }


    public function __construct()
    {
        $this->middleware('role:operatore');
    }

    public function index()
    {

        $dataView = [];
        return view('operatore.dashboard')->with('dataView', $dataView);
    }


    public function ricercaCF(Request $request) {
        $pazientiAPC = DB::connection("oracleEBIT")->table('ASSISTITI_EBIT')
        ->selectRaw('ASSISTITI_EBIT.CODFIS, ASSISTITI_EBIT.COGNOME, ASSISTITI_EBIT.NOME, to_char(ASSISTITI_EBIT.DATANAS, \'YYYY-MM-DD\') as DATANAS, ASSISTITI_EBIT.TELEFONO, ASSISTITI_EBIT.COMUNERES || \' \' || ASSISTITI_EBIT.INDIRIZZO as residenza')
        ->where('CODFIS', 'like', '%'.strtoupper($request->get('query')).'%')
        ->orderBy('Cognome')->orderBy("Nome")
        ->get();


        return $pazientiAPC;
    }


    public function inserisciPazienteAPC(Request $request) {

        $dataView = [];

        // Se il paziente è già memorizzato recupero anche le prenotazioni
        $paziente = Patient::where("tax_id", $request->codice_fiscale)->first();
        if ($paziente) {
            $dataView["id"] = $paziente->id;
            $dataView["surname"] = ucwords(strtolower($paziente->surname));
            $dataView["name"] = ucwords(strtolower($paziente->name));
            $dataView["birth_date"] = $paziente->birth_date;
            $dataView["email"] = $paziente->email;
            $dataView["tax_id"] = strtoupper($paziente->tax_id);
            $dataView["phone"] = $paziente->phone;
            $dataView["prenotazioni"] = Prenotazione::where("paziente_id", "=", $paziente->id)
                ->where("stato", "=", -1)
                ->whereDate('data_vaccino', ">=", Carbon::now('Europe/Rome'))
                ->get();
            return view('operatore.verificaDatiPaziente')->with('dataView', $dataView);        
        } else {
            $dataView["surname"] = ucwords(strtolower($request->cognome));
            $dataView["name"] = ucwords(strtolower($request->nome));
            $dataView["birth_date"] = $request->data_nascita;
            $dataView["email"] = $request->email;
            $dataView["tax_id"] = strtoupper($request->codice_fiscale);
            $dataView["phone"] = $request->telefono;

            return view('operatore.registraPaziente')->with('dataView', $dataView);        
        }
    }


    public function registraPaziente(Request $request) {

        $paziente = Patient::where("tax_id", $request->tax_id)->first();
        if (isset($paziente))
            $paziente->update([
                'surname' => ucwords(strtolower($request->surname)),
                'name' => ucwords(strtolower($request->name)),
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'email' => $request->email,
                'password' => null,
                'ruolo_id' => 1, // 1. paziente
                'health_insurance_card' => null,
            ]); 
        else
            $paziente = Patient::create([
                'surname' => ucwords(strtolower($request->surname)),
                'name' => ucwords(strtolower($request->name)),
                'tax_id' => strtoupper($request->tax_id),
                'phone' => $request->phone,
                'vaccination_center_id' => null,
                'birth_date' => $request->birth_date,
                'email' => $request->email,
                'password' => null,
                'ruolo_id' => 1, // 1. paziente
                'health_insurance_card' => null,
            ]); 

        return $this->sceltaDataView($paziente->id, $request->surname . " " . $request->name);
    }

    public function visualizzaPaziente(Request $request) {
        
        $dataView = [];
        $dataView["surname"] = ucwords(strtolower($request->surname));
        $dataView["name"] = ucwords(strtolower($request->name));
        $dataView["birth_date"] = $request->birth_date;
        $dataView["tax_id"] = strtoupper($request->tax_id);
        $dataView["email"] = $request->email;
        $dataView["phone"] = $request->phone;

        return view('operatore.registraPaziente')->with('dataView', $dataView);        
    }


    public function aggiornaPaziente(Request $request) {

        Patient::where("id", $request->id)->update([
            'surname' => ucwords(strtolower($request->surname)),
            'name' => ucwords(strtolower($request->name)),
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
        ]); 

        return $this->sceltaDataView($request->id, $request->surname . " " . $request->name);
    }

    public function modificaPrenotazione(Request $request) {
        return $this->sceltaDataView($request->id, $request->nominativo);
    }

    public function listaDisponibilita(Request $request) {
        $dataView['idPaziente'] = $request->idPaziente;
        $dataView['nomePaziente'] = $request->nomePaziente;
        $dataView['result'] = $this->disponibilita($request->dataDisponibilita, $request->centroVaccinale);
        return view("operatore.sceltaData")->with("dataView", $dataView);
    }


    public function registraPrenotazione(Request $request) {

        $this->prenotaVaccino($request->patientID, $request->dataID, $request->centroVaccinaleID);
        return view('operatore.dashboard');

    }

    public function cancellaPrenotazione(Request $request) {

        Prenotazione::where('id', $request->prenotazioneID)->update([
            'stato' => 2
        ]);

        return $this->sceltaDataView($request->id, $request->nominativo);
    }


    
    public function motivazione(Request $request)
    {
        $dataInizio = new Carbon($request->data_inizio);
        $dataFine = new Carbon($request->data_fine);
        //Crea un array di date tra dataInizio e dataFine
        $dateRange = [];
        for ($date = $dataInizio; $date->lte($dataFine); $date->addDay()) {
            $dateRange[] = $date->format('Y-m-d');
        }

        $chiusureEsistenti = ChiusuraCentroVaccinale::where('cv_id', $request->centroVaccinaleScelta)
        ->whereIn('data_chiusura', $dateRange)
        ->pluck('data_chiusura')
        ->toArray();

        foreach ($dateRange as $date) {
            if (!$chiusureEsistenti) {
                ChiusuraCentroVaccinale::create([
                    'cv_id' => $request->centroVaccinaleScelta,
                    'motivazione' => $request->motivazione,
                    'data_chiusura' => $date,
                    'id_operatore' => Auth::user()->id,
                ]);
            }
            else{
                throw ValidationException::withMessages(["errore" => 'ermessaggio di rore']);
            }
        }
        return $this->index();
    }
    

    public function listaChiusuraCentri()
    {
        $dataView['centriVaccinali'] = CentroVaccinale::select('centro_vaccinale.id', 'centro_vaccinale.descrizione as nome', 'chiusura_cv.data_chiusura as data', 'chiusura_cv.motivazione as motivazione')
            ->join('chiusura_cv', 'centro_vaccinale.id', '=', 'chiusura_cv.cv_id')
            ->where('chiusura_cv.data_chiusura', '>=', DB::raw('CURRENT_DATE'))
            ->orderBy('chiusura_cv.data_chiusura', 'desc')
            ->paginate(10);
         
        return view('operatore.listaCV')->with('dataView', $dataView);
        
    }

    public function scegliCentro($centroVaccinale)
    {
 
        $dataView['centriVaccinali'] = CentroVaccinale::select('centro_vaccinale.id', 'centro_vaccinale.descrizione as nome', 'chiusura_cv.data_chiusura as data', 'chiusura_cv.motivazione as motivazione')
        ->join('chiusura_cv', 'centro_vaccinale.id', '=', 'chiusura_cv.cv_id')
        ->where('chiusura_cv.data_chiusura', '>=', DB::raw('CURRENT_DATE'))
        ->where('centro_vaccinale.id',$centroVaccinale )
        ->orderBy('chiusura_cv.data_chiusura', 'desc')
        ->get();
        
        return view('operatore.listaCV')->with('dataView', $dataView);
    }
    public function cancellaChiusura(Request $request)
    {

        $prenotazione = DB::table('chiusura_cv')->where('cv_id',$request->chiusuraID);
        $prenotazione ->delete();
       
        return $this->index();
    }
    
}
