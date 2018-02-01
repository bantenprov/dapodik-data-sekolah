<?php namespace Bantenprov\DDSekolah\Http\Controllers;

/* require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\DDSekolah\Facades\DDSekolah;

/* Models */
use Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah\DDSekolah as PdrbModel;
use Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah\Province;
use Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah\Regency;

/* etc */
use Validator;

/**
 * The DDSekolahController class.
 *
 * @package Bantenprov\DDSekolah
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class DDSekolahController extends Controller
{

    protected $province;

    protected $regency;

    protected $dd_sekolah;

    public function __construct(Regency $regency, Province $province, PdrbModel $dd_sekolah)
    {
        $this->regency  = $regency;
        $this->province = $province;
        $this->dd_sekolah     = $dd_sekolah;
    }

    public function index(Request $request)
    {
        /* todo : return json */

        return 'index';

    }

    public function create()
    {

        return response()->json([
            'provinces' => $this->province->all(),
            'regencies' => $this->regency->all()
        ]);
    }

    public function show($id)
    {

        $dd_sekolah = $this->dd-sekolah->find($id);

        return response()->json([
            'negara'    => $dd-sekolah->negara,
            'province'  => $dd-sekolah->getProvince->name,
            'regencies' => $dd-sekolah->getRegency->name,
            'tahun'     => $dd-sekolah->tahun,
            'data'      => $dd-sekolah->data
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'negara'        => 'required',
            'province_id'   => 'required',
            'regency_id'    => 'required',
            'kab_kota'      => 'required',
            'tahun'         => 'required|integer',
            'data'          => 'required|integer',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'title'     => 'error',
                'message'   => 'add failed',
                'type'      => 'failed',
                'errors'    => $validator->errors()
            ]);
        }

        $check = $this->dd-sekolah->where('regency_id',$request->regency_id)->where('tahun',$request->tahun)->count();

        if($check > 0)
        {
            return response()->json([
                'title'         => 'error',
                'message'       => 'Data allready exist',
                'type'          => 'failed',
            ]);

        }else{
            $data = $this->dd-sekolah->create($request->all());

            return response()->json([
                    'type'      => 'success',
                    'title'     => 'success',
                    'id'      => $data->id,
                    'message'   => 'PDRB '. $this->regency->find($request->regency_id)->name .' tahun '. $request->tahun .' successfully created',
                ]);
        }

    }

    public function update(Request $request, $id)
    {
        /* todo : return json */
        return '';

    }

    public function destroy($id)
    {
        /* todo : return json */
        return '';

    }
}

