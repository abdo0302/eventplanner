<?php

namespace App\Http\Controllers;

use App\Mail\eventmail;
use App\Models\comment;
use App\Models\evaluation;
use App\Models\event;
use App\Models\inscription;
use App\Models\utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class StaticController extends Controller
{
    public function index(){
        $name='abdo';
        $events=event::all();
        return view('welcome',compact("name",'events'));
    }

    public function profile(){
        $events=event::all();
        $users=utilisateur::all(); 
        $info=session()->get('user');
        if($info->role_id==1){
             return view('profile',compact('events','users','info'));
        }elseif($info->role_id==2){
             return redirect()->route('admin');
        }
        
    }

    public function admin(){
        $users=utilisateur::all();
        $events=event::all();
        $users=utilisateur::all(); 
        $info=session()->get('user');
        if($info->role_id==1){
            return redirect()->route('profile');
       }elseif($info->role_id==2){
            return view('admin',compact('users','events','users','info'));
       }
       
    }

    public function show(Request $request){
        $id=$request->id;
        $comments = Comment::where('event_id', $id)->get();
        $evaluation = evaluation::where('event_id', $id)->get();
        $event = event::where('id', $id)->get();
        $inscription = inscription::where('event_id', $id)->get();
        $users=utilisateur::all(); 
        $info=session()->get('user');   
        $is_inscri=false;                    
        return view('show',compact('comments','users','evaluation','event','inscription','info'));
    }

    public function store(Request $request){
        $title=$request->title;
        $description=$request->description;
        $date=$request->date;
        $location=$request->location;
        $info=session()->get('user');
        $organizer_id=$info->id;
        
        //validation

        //insrtion
        event::create([
            'title'=>$title,
            'description'=>$description,
            'date'=>$date,
            'location'=>$location,
            'organizer_id'=>$organizer_id
        ]);
        return redirect()->back()->withInput();
    }

    public function commant(Request $request){
        $event_id=$request->event_id;
        $info=session()->get('user');
        $user_id=$info->id;
        $content=$request->content;

        //validation

        //insrtion
        comment::create([
            'content'=>$content,
            'user_id'=>$user_id,
            'event_id'=>$event_id
        ]);
        return redirect()->back()->withInput();
    }

    public function evaluation(Request $request){
        $info=session()->get('user');
        $user_id= $info->id;
        $event_id=$request->event_id;
        $score=$request->score;

        //validation

        //insrtion
        evaluation::create([
            'score'=>$score,
            'user_id'=>$user_id,
            'event_id'=>$event_id
        ]);

        return redirect()->back()->withInput();
    }

    public function inscription(Request $request) {
        $info = session()->get('user');
        $user_id = $info->id;
        $event_id = $request->event_id;
        $event = event::where('id', $event_id)->get();
        $email_event=$event[0]->title;
        $data = [
            'title' => 'Inscrivez-vous à lévénement',
            'message' => 'Nous confirmons votre inscription à lévénement intitulé '."( $email_event )",
        ];
    
        // Validation (you can add validation logic here)
    
        // Insertion
        Inscription::create([
            'user_id' => $user_id,
            'event_id' => $event_id
        ]);
       
        Mail::to($info->email)->send(new EventMail($data));
        
        return redirect()->back()->withInput()->with('email', $info->email);
    }
    

    public function signin(Request $request){
         $name=$request->name;
         $email=$request->email;
         $password=$request->password;

        //validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'password' => 'required|string|min:8',
        ]);

        //insrtion
        $user=utilisateur::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'role_id'=>1
        ]);
        if($user){
            $u = utilisateur::where('email', $email)->first();
            session()->put('user',$u);
            return redirect()->route('profile');
        }
        
    }

    public function connexion(Request $request){
        $credentials = $request->only('email', 'password');
 
        $user = utilisateur::where('email', $credentials['email'])->first();
        if($user){
            session()->put('user',$user);
            if($user->role_id==1){
              return redirect()->route('profile');
            }elseif($user->role_id==2){
                return redirect()->route('admin');
            }
            
        }else{
            return redirect()->back()->withInput()->with('login','email ou mot de passe invalide');
        }
    }

    public function logout(){
        session()->flush();
        return redirect()->route('home');
    }

    public function back(){
        $info=session()->get('user');
        if($info->role_id==1){
            return redirect()->route('profile');
        }elseif($info->role_id==2){
            return redirect()->route('admin');
        }
    }

    public function supprimer(Request $request){
        $id=$request->id;
        $event=event::find($id);
        if ($event) {
            $event->delete();
                $info=session()->get('user');
            if($info->role_id==1){
                return redirect()->route('profile');
            }elseif($info->role_id==2){
                return redirect()->route('admin');
            }
        }
    }

    public function supprimeruser(Request $request){
        $id=$request->id;
        $utilisateur=utilisateur::find($id);
        $deleted = DB::table('inscriptions')->where('user_id', $id)->delete();
        $deletedevent = DB::table('events')->where('organizer_id', $id)->delete();
        if ($utilisateur) {
            $utilisateur->delete();
                $info=session()->get('user');
            if($info->role_id==1){
                return redirect()->route('profile');
            }elseif($info->role_id==2){
                return redirect()->route('admin');
            }
        }
    }

    public function modifier(Request $request){
        $id=$request->id;
        $event = event::where('id', $id)->get();
        return view('modifier',compact('event'));
    }

    public function update(Request $request){
        $event=event::find($request->id);
        if($event){
            $event->update($request->all());
            $info=session()->get('user');
            if($info->role_id==1){
                return redirect()->route('profile');
            }elseif($info->role_id==2){
                return redirect()->route('admin');
            }
        }
        
    }
}
