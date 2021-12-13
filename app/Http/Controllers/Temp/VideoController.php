<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VideoCreateRequest;
use App\Video;
use Auth;
use Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return \DataTables::of(Video::all())
            ->addColumn('action', function ($row) {
                $btn = \Form::open(['url' => '/video/' . $row->id, 'method' => 'DELETE','style' => 'float:right;margin-right:5px']);
                $btn .= "<button type='submit' class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                $btn .= \Form::close();
                $btn .= '<a class="btn btn-danger btn-sm" href="/video/' . $row->id . '"><i class="fas fa-eye" aria-hidden="true"></i></a> ';
                $btn .= '<a class="btn btn-danger btn-sm" href="/video/' . $row->id . '/edit"><i class="fas fa-edit" aria-hidden="true"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        if (Auth::user()->level == 'administrator') {
            return view('video.index');
        }
        $data['videos'] = Video::paginate(9);
        return view('video.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoCreateRequest $request)
    {
        $request['description'] = $request->description1;
        Video::create($request->all());
        \Session::flash('message', 'Data video Berhasil Ditambahkan');
        return redirect('video');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['video']   = Video::findOrFail($id);
        return view('video.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['video']   = Video::findOrFail($id);
        return view('video.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['description'] = $request->description1;
        $video = Video::findOrFail($id);
        $video->update($request->all());
        \Session::flash('message', 'Data video Berhasil Diperbaharui');
        return redirect('video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        \Session::flash('message', 'Data video Berhasil Dihapus');
        return redirect('video');
    }
}
