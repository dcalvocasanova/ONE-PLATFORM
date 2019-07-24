<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::paginate(25);
        return view('user.index', ['users'=> $users]);
    }

    /**
   * Show the form for creating a new gest.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('user.create');
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
          'name' => 'required|string|max:191',
          'email' => 'required|string|email|max:191|unique:users',
          'password' => 'required|string|min:6'
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'information' => $request['bio'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('user')->with('success', 'Usuario registrado exitosamente.');
    }

    /**
     * Display the specified guest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.view', ['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user'=> $user]);
    }

    /**
     * Show the form for seeing profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', ['user'=> $user]);
    }

    /**
     * Update the specified guest information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);

      $form_data = array(
          'name' => $request['name'],
          'email' => $request['email'],
          'type' => $request['type'],
          'information' => $request['bio'],
          'photo' => $request['photo'],
          'password' => Hash::make($request['password']),
      );
      User::whereId($id)->update($form_data);
      return redirect('user')->with('success', 'Usuario actualizado');
    }

    /**
     * Update the profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
   {
       $user = auth()->user();
       $this->validate($request,[
           'name' => 'required|string|max:191',
           'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
           'password' => 'sometimes|required|min:6'
       ]);
       $currentPhoto = $user->photo;
       if($request->photo != $currentPhoto){
           $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
           \Image::make($request->photo)->save(public_path('img/profile/').$name);
           $request->merge(['photo' => $name]);
           $userPhoto = public_path('img/profile/').$currentPhoto;
           if(file_exists($userPhoto)){
               @unlink($userPhoto);
           }
       }
       if(!empty($request->password)){
           $request->merge(['password' => Hash::make($request['password'])]);
       }
       $user->update($request->all());
       return redirect('user')->with('success', 'Perfil actualizado');
   }
    /**
     * Remove the gest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gest = Booking::findOrFail($id);
        $gest->delete();

        return redirect('planner')->with('success', 'Usuario eliminado');
    }
}
