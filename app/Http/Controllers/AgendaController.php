<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\TemaPortal;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AgendaController extends Controller
{

    public function tema()
    {
        $tema = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();
        if (!$tema) $tema = TemaDashboard::get()->first();

        return $tema;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tema = $this->tema();
        $agenda = agenda::all();

        return view('v_agenda.index', [
            'title' => 'Kelola Data agenda',
            'agendas' => $agenda,
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tema = $this->tema();

        return view('v_agenda.create', [
            'title' => 'Tambah Data Agenda',
            'tema' => $tema
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start' => 'required',
            'end' => 'required',
            'backgroundColor' => 'required',
            'borderColor' => 'required',
            'textColor' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Agenda::create($validatedData);
        return redirect('/dashboard/agenda')->with('success', 'Tambah Data Agenda Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        $events = User::all();
        $agendas = Agenda::all();

        if (!auth()->user()->role == 'admin') {
            $tema = TemaPortal::where('user_id', 1)->get()->first();
            return view('v_agenda.showagendauser', [
                'title' => 'Lihat Data Agenda',
                'agenda' => $agenda,
                'agendas' => $agendas,
                'tema' => $tema,
                'events' => $events,
            ]);
        } else {
            $tema = $this->tema();
            return view('v_agenda.show', [
                'title' => 'Lihat Data Agenda',
                'agenda' => $agenda,
                'tema' => $tema,
                'events' => $events,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        $tema = $this->tema();
        return view('v_agenda.edit', [
            'title' => 'Ubah Data Agenda',
            'agenda' => $agenda,
            'tema' => $tema,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start' => 'required',
            'end' => 'required',
            'backgroundColor' => 'required',
            'borderColor' => 'required',
            'textColor' => 'required',
        ]);

        Agenda::where('id', $agenda->id)->update($validatedData);

        return redirect('/dashboard/agenda')->with('success', 'Ubah Data Agenda Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        Agenda::destroy($agenda->id);
        return redirect('/dashboard/agenda')->with('success', 'Data Agenda Berhasil Dihapus');
    }

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'import' => 'required|file|mimes:xls,xlsx|max:8000'
        ]);

        $excelFile = $request->file('import');

        try {
            $spreadsheet = IOFactory::load($excelFile->getRealPath());
            $sheet        = $spreadsheet->getSheet(0);
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('A', $column_limit);
            $startcount = 2;

            // $data = array();

            foreach ($row_range as $row) {

                $start = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($sheet->getCell('J' . $row)->getCalculatedValue() + $sheet->getCell('K' . $row)->getCalculatedValue());
                $end = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($sheet->getCell('R' . $row)->getCalculatedValue() + $sheet->getCell('S' . $row)->getCalculatedValue());

                $data_mentah = [
                    'user_id' => auth()->user()->id,
                    'title' => $sheet->getCell('A' . $row)->getValue(),
                    'location' => $sheet->getCell('B' . $row)->getValue(),
                    'description' => $sheet->getCell('C' . $row)->getValue(),
                    'start' => gmdate("Y-m-d H:i:s", $start),
                    'end' => gmdate("Y-m-d H:i:s", $end),
                    'backgroundColor' => $sheet->getCell('T' . $row)->getValue(),
                    'borderColor' => $sheet->getCell('U' . $row)->getValue(),
                    'textColor' => $sheet->getCell('V' . $row)->getValue(),
                ];
                Agenda::create($data_mentah);
            }
        } catch (\Exception $e) {
            return redirect('/dashboard/agenda')->with('fail', 'Import Data agenda Gagal');
        }
        return redirect('/dashboard/agenda')->with('success', 'Import Data agenda Berhasil');
    }
}
