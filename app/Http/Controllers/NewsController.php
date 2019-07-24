<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\News;
use App\Http\Controllers\Controller;


class NewsController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  /**
     * Display a listing of guests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(25);
        return view('news.index', ['news'=> $news]);
    }

    /**
   * Show the form for creating a new gest.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('news.create');
  }

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'    =>  'required',
            'img'     =>  'required',
            'description' =>  'required'
        ]);

        $form_data = array(
            'title'=>   $request->title,
            'img'=>   $request->img,
            'description'=>  $request->description
        );
        News::create($form_data);
        return redirect('news')->with('success', 'Noticia agregada');
    }

    /**
     * Display the specified news.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.view', ['news'=> $news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $news = News::findOrFail($id);
      return view('news.edit', ['news'=> $news]);
    }

    /**
     * Update the specified news information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
          'title'    =>  'required',
          'img'     =>  'required',
          'description' =>  'required'
      ]);

      $form_data = array(
          'title'=>   $request->title,
          'img'=>   $request->img,
          'description'=>  $request->description
      );

      News::whereId($id)->update($form_data);
      return redirect('news')->with('success', 'Noticia modificada');
    }

    /**
     * Remove the news.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $gest->delete();

        return redirect('news')->with('success', 'Noticia eliminada');
    }  
}
