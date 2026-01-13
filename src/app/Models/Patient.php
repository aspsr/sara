<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PasswordReset; 
use Illuminate\Support\Facades\Log;

class Patient extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'birth_date',
        'email',
        'ldap_username',
        'password',
        'tax_id',
        'phone',
        'vaccination_center_id',
        'ruolo_id',
        'phone_verified_at',
        'email_verified_at',
        'stato', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Recupero la relazione con la tabella ruolo
     */
    public function ruolo()
    {
        return $this->belongsTo(Ruolo::class);
    }


    public function figli()
    {
        $figli = DB::table('patients')
            ->select('patients.*')
            ->join('padre_figlio', 'patients.id', '=', 'padre_figlio.figlio_id')
            ->where('padre_figlio.padre_id', '=', Auth::user()->id)
			->where('padre_figlio.stato', 1)
            ->get();
        return $figli;
    }

    public function centriVaccinali($idMedico) {
        $cv = DB::table('patients')
            ->join("medico_centro_vaccinale", "medico_centro_vaccinale.patient_id", "=", "patients.id")
            ->join("centro_vaccinale", "centro_vaccinale.id", "=", "medico_centro_vaccinale.centro_vaccinale_id")
            ->where("patients.ruolo_id", 2); // 2 = medico
        if ($idMedico != null)
            $cv = $cv->where("patients.id", $idMedico);
        $cv = $cv->select("centro_vaccinale.*")
            ->get();

        return $cv;
    }


    public function test() {
        
        dd( DB::connection("mysqlVaccinazioni")
        ->table("covid.fass_ok")
        ->select("id_tessera")
        ->where("codice_fiscale","BRNGNN76L21A522V")
        ->get());
    }


    public function data($codiceFiscale)
    {

        $_mesi = array( 
            1  => 'A',  2 => 'B',  3 => 'C',  4 => 'D',  5 => 'E',  
            6  => 'H',  7 => 'L',  8 => 'M',  9 => 'P', 10 => 'R', 
            11 => 'S', 12 => 'T'
        );
        
        $data = array();
        //  $str = $request->input('tax_id');
        $str = strtoupper($codiceFiscale);
        $anno = substr($str, 6, 2);
        $mese = substr($str, 8, 1);
        $giorno = substr($str, 9, 2);
        
        $mese = array_search($mese, $_mesi);
        $mese = sprintf("%02d", $mese);
    
        if ($giorno > 40) {
            //$sesso = 'F';
            $giorno -= 40;
        //} else {
            //$sesso = 'M';
        }
        
        //$currentYear = date('Y');
    
        $annoIntero = $anno > date('y') ? '19' . $anno : '20' . $anno;
    
        $data = array($annoIntero, $mese, $giorno); 

        //$data_formattata = implode('-', $data);
        $data_stringa = implode('-',$data);
    

        $data_formattata= date($data_stringa);
   
        //$oggi = date("Y-m-d");  
    
       
        //$interval = date_diff( date_create($oggi), date_create($data_formattata)); 

       return $data_formattata;
    }

    public function eta($codiceFiscale)
    {

        $_mesi = array( 
            1  => 'A',  2 => 'B',  3 => 'C',  4 => 'D',  5 => 'E',  
            6  => 'H',  7 => 'L',  8 => 'M',  9 => 'P', 10 => 'R', 
            11 => 'S', 12 => 'T'
        );
        
        $data = array();
        //  $str = $request->input('tax_id');
        $str = $codiceFiscale;
        $anno = substr($str, 6, 2);
        $mese = substr($str, 8, 1);
        $giorno = substr($str, 9, 2);
        

        $mese = array_search($mese, $_mesi);
        $mese = sprintf("%02d", $mese);

        if ($giorno > 40) {
            //$sesso = 'F';
            $giorno -= 40;
        //} else {
            //$sesso = 'M';
        }
        
        //$currentYear = date('Y');

        $annoIntero = $anno > date('y') ? '19' . $anno : '20' . $anno;

        $data = array($annoIntero, $mese, $giorno); 

        $data_formattata = implode('-', $data);

        $oggi = date("Y-m-d");  

        return date_diff(date_create($data_formattata), date_create($oggi))->y;
    // return $this->calcolaEta($codiceFiscale);
    }

    public function tessera8caratteri($codiceFiscale)
    {
        $data = [
            'email' => 'vaccinazioni@asp.sr.it',
            'password' => 'vaccinazioni2024WOW!!',
        ];

        $curl = curl_init("http://gitlab.asp.sr.it:8000/api/login");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            // gestisci l'errore
            Log::channel('daily')->info('(Patient) tessera8caratteri >' . $codiceFiscale . "> ".curl_error($curl));
            return null;
        } else {
            $result = json_decode($response, true);
        }
        curl_close($curl);

        $curl = curl_init("http://gitlab.asp.sr.it:8000/api/v1/getIdentificativoTesseraSanitaria/" . strtoupper($codiceFiscale));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $result['token'],
        ]);
        
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            // gestisci l'errore
            Log::channel('daily')->info('(Patient) tessera8caratteri >' . $codiceFiscale . "> ".curl_error($curl));
            return null;
        } else {
            $data = json_decode($response, true);
        }
        curl_close($curl);
//dd($data);
        return $data;
    }



    function estraiCognomeCodiceFiscale($cognome)
    {
        $consonanti = '';
        $vocali = '';
        
        foreach (str_split(strtoupper($cognome)) as $char) {
            if (preg_match('/[BCDFGHJKLMNPQRSTVWXYZbcdfghjklmnpqrstvwxyz]/', $char)) {
                $consonanti .= $char;
            } elseif (preg_match('/[AEIOUaeiou]/', $char)) {
                $vocali .= $char;
            }
        }
        $codice = substr($consonanti . $vocali . 'XXX', 0, 3);
        return $codice;
    }

    public function verificaCognome($cognome ,$codiceFiscale)
    {
		$cf = strtoupper(substr($codiceFiscale, 0, 3));
  
		$cognomeEstratto = strtoupper($this->estraiCognomeCodiceFiscale($cognome));
		if($cf == $cognomeEstratto){
			return true;
		} else{
			return false;
		}
	}

    function estraiNomeCodiceFiscale($nome)
    {
        $consonanti = '';
        $vocali = '';

        foreach (str_split(strtoupper($nome)) as $char) {
            if (preg_match('/[BCDFGHJKLMNPQRSTVWXYZbcdfghjklmnpqrstvwxyz]/', $char)) {
                $consonanti .= $char;
            } elseif (preg_match('/[AEIOUaeiou]/', $char)) {
                $vocali .= $char;
            }
        }

        
        if (strlen($consonanti) > 3) {
            $codice = $consonanti[0] . $consonanti[2] . $consonanti[3];
        } else {
       
            $codice = substr($consonanti . $vocali . 'XXX', 0, 3);
        }

        return $codice;
    }

	public function verificaNome($nome, $codiceFiscale)
	{
		$cf = strtoupper(substr($codiceFiscale, 3, 3)); 
	   
		$nomeEstratto = strtoupper($this->estraiNomeCodiceFiscale($nome));
	   
		if($cf == $nomeEstratto){
			return true;
		} else{
			return false;
		}
	}

    public function estraiDatiAnagrafici($codiceFiscale)
    {
        $data = [
            'email' => 'vaccinazioni@asp.sr.it',
            'password' => 'vaccinazioni2024WOW!!',
        ];

        $curl = curl_init("http://gitlab.asp.sr.it:8000/api/login");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            // gestisci l'errore
            Log::channel('daily')->info('(Patient) tessera8caratteri >' . $codiceFiscale . "> ".curl_error($curl));
            return null;
        } else {
            $result = json_decode($response, true);
        }
        curl_close($curl);

        $curl = curl_init("http://gitlab.asp.sr.it:8000/api/v1/getDatiTesseraSanitaria/" . strtoupper($codiceFiscale));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $result['token'],
        ]);
        
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            // gestisci l'errore
            Log::channel('daily')->info('(Patient) tessera8caratteri >' . $codiceFiscale . "> ".curl_error($curl));
            return null;
        } else {
            $data = json_decode($response);
        }
        curl_close($curl);

        return $data;
    }
}



