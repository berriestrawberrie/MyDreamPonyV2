<?php

namespace App\Http\Controllers;

use App\Events\BBCToHTML;
use App\Models\ForumCats;
use App\Models\ForumPosts;
use App\Models\ForumTops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    //
    public function forumHome()
    {
        $news = [1, 2, 3];
        $chats = [4, 5, 6];
        $world = [7, 8, 9, 10, 11];
        $game = [12, 13, 14];
        $newsCat = ForumCats::wherein('id', $news)->get();
        $chatCat = ForumCats::wherein('id', $chats)->get();
        $worldCat = ForumCats::wherein('id', $world)->get();
        $gameCat = ForumCats::wherein('id', $game)->get();
        return view('forum.category', compact('newsCat', 'chatCat', 'worldCat', 'gameCat'));
    }
    public function categoryTopics($category_id, $name)
    {
        $topics = ForumTops::where('category', $category_id)
            ->paginate(10)
            ->withQueryString();

        return view('forum.topics', compact('topics', 'name', 'category_id'));
    }

    //RETURN ALL THE POSTS RELATED TO A TOPIC THREAD
    public function getPost($category, $topic_id)
    {
        $topic = ForumTops::where('id', $topic_id)->get();
        $category = ForumCats::where('id', $category)->get();
        $posts = ForumPosts::where('post_topic', $topic_id)
            ->paginate(5)
            ->withQueryString();

        return view('forum.post', compact('posts', 'category', 'topic'));
    }

    //POST A NEW TOPIC THREAD
    public function newTopic($category_id, Request $request)
    {

        ForumTops::create([
            'subject' => $request->input('subject'),
            'date' => date('Y-m-d H:i:s'),
            'category' => $category_id,
            'topic_by' => Auth::user()->id,
            'user_name' => Auth::user()->name,
            'post_count' => 1
        ]);

        //GET THE LAST RECORD CREATED
        $topic = ForumTops::where('topic_by', Auth::user()->id)
            ->where('category', $category_id)
            ->orderby('id', 'DESC')
            ->first();
        $topic_id = $topic["id"];

        //CREATE THE POSTS FOR THAT TOPIC
        ForumPosts::create([
            'post_content' => $request->input('content'),
            'post_date' => date('Y-m-d H:i:s'),
            'post_topic' => $topic_id,
            'post_by' => Auth::user()->id,
            'post_user_name' => Auth::user()->name,
            'post_category' => $category_id,
        ]);
        return redirect(route('topic', ['topic_id' => $topic_id, 'category' => $category_id]))->with('success', 'Your comment has been posted');
    }

    //WRITE A NEW POST IN A SPECIFIC FORUMM TOPIC
    public function newPost($category_id, $topic_id, Request $request)
    {
        ForumPosts::create([
            'post_content' => $request->input('post-content'),
            'post_date' => date('Y-m-d H:i:s'),
            'post_topic' => $topic_id,
            'post_by' => Auth::user()->id,
            'post_user_name' => Auth::user()->name,
            'post_category' => $category_id

        ]);


        //UPDATE THE LATEST DATE
        ForumTops::where('id', $topic_id)
            ->increment('post_count', 1);

        return redirect(route('topic', ['topic_id' => $topic_id, 'category' => $category_id]))->with('success', 'Your comment has been posted');
    }

    //BRING UP THE EDIT POST PAGE
    public function editPost($post_id)
    {
        $post = ForumPosts::where('id', $post_id)->get();
        if ($post[0]["post_by"] != Auth::user()->id) {
            return redirect(route('/forums'))->with('error', 'Unauthroized to edit this post.');
        }

        return view('forum.editpost', compact('post'));
    }
    //SUBMIT A NEW EDITED POST
    public function submitEdit($post_id, Request $request)
    {

        ForumPosts::where('id', $post_id)
            ->update([
                'post_content' => $request->input('post-content'),
                'bbc_content' => $request->input('post-content'),
                'update_date' => date('Y-m-d H:i:s')
            ]);
        //GET THE TOPIC INFORMATION
        $post = ForumPosts::where('id', $post_id)->get();

        event(new BBCToHTML($request->input('post-content'), $post_id, "post"));

        return redirect(route('topic', ['topic_id' => $post[0]["post_topic"], 'category' => $post[0]["post_category"]]))->with('success', 'Your comment has been updated');
    }
}
