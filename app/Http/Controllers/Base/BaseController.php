<?php
namespace App\Http\Controllers\Base;

use App\Fish;
use App\ForumPageMessage;
use App\Page;
use App\Topic;
use App\User;
use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexAction()
    {
        $page = Page::where('title', '=', 'Главная')->get();
        return view('base.home', ['page' => $page[0]]);
    }

    public function newsAction()
    {
        return view('base.news');
    }

    public function fishesAction()
    {
        $fishes = Fish::all();
        return view('base.fishes', ['fishes' => $fishes]);
    }

    public function fishInfoAction($arg1)
    {
        $fish = Fish::where('title', '=', $arg1)->get()[0 ];
        return view('base.fish_info', ['fish' => $fish]);
    }

    public function aboutAction()
    {
        return view('base.about');
    }

    public function contactsAction()
    {
        return view('base.contacts');
    }

    public function forumBaseAction()
    {
        $forum = Page::where('title', '=', 'Форум')->get();
        $topics = Page::where('parent_id', '=', $forum[0]['id'])->get();
        return view('base.forum', ['topics' => $topics]);
    }

    public function getForumPageMessages($id)
    {
        $messages = ForumPageMessage::all();
        $result = null;
        foreach($messages as $message)
        {
            if($message->topic_id == $id){
                $result[] = $message;
            }
        }
        return $result;
    }

    public function forumAction($topic)
    {
        $t = Topic::all();
        foreach($t as $top)
        {
            if($top->href == $topic){
                $result = $top;
            }
        }
        if($result->is_end){
            $forumPageMessages = $this->getForumPageMessages($result->id);
            return view('base.forum_page', ['messages' => $forumPageMessages]);
        }
        else{
            $r = null;
            foreach($t as $top)
            {
                if($result->id == $top->parent_id){
                    $r[] = $top;
                }
            }
            return view('base.forum', ['topics' => $r]);
        }
        //return view('base.forumTopic', ['topic' => $result]);
    }

    public function bbbAction(User $user)
    {
        $password = password_hash('saharruby', PASSWORD_DEFAULT);
        $user->create(['name' => 'alex', 'email' => 'mal.sasha@mail.ru', 'password' => $password, 'remember_token' => '1']);
    }

    public function aaaAction()
    {
        $users = User::all();
        foreach($users as $user)
        {
            echo $user->password.'<br>';
            if(password_verify('saharrrebt', $user->password))
            {
                echo "Ok<br>";
            }
        }
    }

}


