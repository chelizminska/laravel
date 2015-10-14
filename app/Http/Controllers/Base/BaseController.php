<?php
namespace App\Http\Controllers\Base;

use App\Fish;
use App\ForumPageMessage;
use App\Page;
use App\PersonalMessage;
use App\Topic;
use App\User;
use App\News;
use Faker\Provider\DateTime;
use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexAction()
    {
        //$page = Page::where('title', '=', 'Главная')->get();
        $news = News::latest('created_at')->take(5)->get();
        return view('base.home', ['news' => $news]);
    }

    public function showNewsAction()
    {
        if (!isset($_GET['page'])){
            $page = 1;
        }
        else{
            $page = $_GET['page'];
        }
        $news = News::latest('created_at')->skip(($page - 1) * 10)->take(10)->get();
        return view('base.news', ['news' => $news, 'page' => $page]);
    }

    public function viewNewsAction()
    {
        if (isset($_GET['id'])){
            $news = News::where('id', '=', $_GET['id'])->first();
            return view('base.view_news', ['news' => $news]);
        }
    }

    public function showFishesAction()
    {
        $fishes = Fish::orderBy('title')->get();
        return view('base.fishes', ['fishes' => $fishes]);
    }

    public function showFishInfoAction($id)
    {
        $fish = Fish::where('id', '=', $id)->first();
        return view('base.fish_info', ['fish' => $fish]);
    }

    public function showAboutAction()
    {
        $page = Page::where('title', '=', 'О клубе')->get();
        return view('base.about', ['page' => $page[0]]);
    }

    public function showContactsAction()
    {
        $page = Page::where('title', '=', 'Контакты')->get();
        return view('base.contacts', ['page' => $page[0]]);
    }

    public function showForumAction($id = null)
    {
        if (isset($id)){
            $parent = Page::where('id', '=', $id)->first();
            if ($parent->is_sheet){
                $messages = ForumPageMessage::where('page_id', '=', $parent->id)
                    ->take(3)->skip(($_GET['page_number'] - 1) * 3)->get();
                $users = User::all();
                $page_title = $parent->title;
                $page_number = $_GET['page_number'];
                $messages_count = ForumPageMessage::where('page_id', '=', $parent->id)->count();
                return view('base.forum_page', ['messages' => $messages,
                    'page_id' => $id,
                    'users' => $users,
                    'page_title' => $page_title,
                    'page_number' => $page_number,
                    'messages_count' => $messages_count,
                ]);
            }
            $childs = Page::where('parent_id', '=', $parent->id)->get();
        }
        else{
            $parent = Page::where('title', '=', 'Форум')->first();
            $childs = Page::where('parent_id', '=', $parent->id)->get();
        }
        $child_messages = null;
        foreach($childs as $child){
            if ($child->is_sheet)
                $child_messages[] = ForumPageMessage::where('page_id', '=', $child->id)->get();
        }
        return view('base.forum', ['topics' => $childs, 'parent_page' => $parent, 'page_messages' => $child_messages]);
    }

    public function addForumMessageAction()
    {
        ForumPageMessage::create(array(
            'page_title' => Input::get('title'),
            'content' => Input::get('message_content'),
            'page_id' => Input::get('page_id'),
            'user' => Input::get('user'),
        ));
        $user = User::where('user_name', '=', Input::get('user'))->first();
        $user->messages_amount++;
        $user->save();
        return redirect('/forum/'.Input::get('page_id').'?page_number='.Input::get('page_number'));
    }

    public function getAddForumTopicAction($id)
    {
        $parentPage = Page::where('id', '=', $id)->first();
        return view('base.add_forum_topic', ['parent_page' => $parentPage]);
    }

    public function postAddForumTopicAction()
    {
        $user = Auth::user();
        Page::create(array(
            'title' => Input::get('title'),
            'parent_id' => Input::get('parent_page_id'),
        ));
        $page_id = Page::max('id');
        ForumPageMessage::create(array(
            'page_title' => Input::get('title'),
            'content' => Input::get('content'),
            'page_id' => $page_id,
            'user' => $user->user_name,
        ));
        $parent_page = Page::where('id', '=', Input::get('parent_page_id'))->first();
        $parent_page->child_amount++;
        $parent_page->save();
        return redirect('/forum/'.$page_id.'?page_number=1');
    }

    public function showPersonalInfoAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            return view('base.personal_info', ['user' => $user]);
        }
        else{
            abort(404);
        }
    }

    public function getChangePersonalInfoAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            return view('base.personal_info_change', ['user' => $user]);
        }
        else{
            abort(404);
        }
    }

    public function postChangePersonalInfoAction()
    {
        $user = Auth::user();
        if($_GET['user_id'] == Auth::user()->id){
            $user->user_name = Input::get('user_name');
            $user->save();
            return redirect('/personal_info?user_id='.$user->id);
        }
        else{
            abort(404);
        }
    }

    public function showUserInfoAction()
    {
        $dest_user = User::where('id', '=', $_GET['id'])->first();
        return view('base.user_info', ['dest_user' => $dest_user]);
    }

    public function getSendUserMessageAction()
    {
        if (isset($_GET['id'])){
            $dest_user = User::where('id', '=', $_GET['id'])->first();
            return view('base.send_personal_message', ['dest_user' => $dest_user]);
        }
        else{
            return view('base.send_personal_message');
        }
    }

    public function postSendUserMessageAction()
    {
        $destination_user = User::where('user_name', '=', Input::get('dest_user_name'))->first();
        $source_user = Auth::user();
        if (isset($destination_user)){
            PersonalMessage::create(array(
                'source_user' => $source_user->user_name,
                'destination_user' => $destination_user->user_name,
                'content' => Input::get('content'),
            ));
            return redirect('/');
        }
        else{
            return redirect('/send_message_to_user')->withErrors(array("Пользователя с таким именем не существует."));
        }
    }

    public function showPersonalMessagesAction()
    {
        $messages = PersonalMessage::latest()->where('destination_user', '=', Auth::user()->user_name)->get();
        return view('base.personal_messages', ['messages' => $messages]);
    }

    public function viewPersonalMessageAction()
    {
        $message = PersonalMessage::where('id', '=', $_GET['id'])->first();
        $message->is_viewed = true;
        $message->save();
        return view('base.view_personal_message', ['message' => $message]);
    }

}


