<?php

namespace App\Listeners;

use App\Events\BBCToHTML;
use App\Models\ForumPosts;

class ConvertBBCText
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BBCToHTML $event): void
    {
        //ACCEPTED BBC CODE:
        $pattern = array(
            "/\[b\]/is",
            "/\[\/b\]/is",
            "/\[B\]/is",
            "/\[\/B\]/is",
            "/\[u\]/is",
            "/\[\/u\]/is",
            "/\[U\]/is",
            "/\[\/U\]/is",
            "/\[i\]/is",
            "/\[\/i\]/is",
            "/\[I\]/is",
            "/\[\/I\]/is",
            "/\[Center\]/is",
            "/\[\/Center\]/is",
            "/\[center\]/is",
            "/\[\/center\]/is",
            "/\[quote\]/is",
            "/\[\/quote\]/is",
            "/\[Quote\]/is",
            "/\[\/Quote\]/is",
            "/\[color=([^\[\<]+?)\]/is",
            "/\[\/color\]/is",
            "/\[Color=([^\[\<]+?)\]/is",
            "/\[\/Color\]/is",
            "/\[font=([^\[\<]+?)\]/is",
            "/\[\/font\]/is",
            "/\[Font=([^\[\<]+?)\]/is",
            "/\[\/Font\]/is",
            "/\[size=(\d+?)\]/is",
            "/\[\/size\]/is",
            "/\[Size=(\d+?)\]/is",
            "/\[\/Size\]/is",
            "/\[url\]/i",
            "/\[\/url\]/i",
            "/\[Url\]/i",
            "/\[\/Url\]/i",
            "/\[spoiler\]/i",
            "/\[\/spoiler\]/i",
            "/\[Spoiler\]/i",
            "/\[\/Spoiler\]/i",
            "/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/i",
            "/\[Img\]\s*([^\[\<\r\n]+?)\s*\[\/Img\]/i",
        );
        //HTML REPLACEMENT
        $replacement = array(
            "<b>",
            "</b>",
            "<B>",
            "</B>",
            "<u>",
            "</u>",
            "<U>",
            "</U>",
            "<em>",
            "</em>",
            "<em>",
            "</em>",
            "<center>",
            "</center>",
            "<center>",
            "</center>",
            "<span class='forum-quote'>",
            "</span>",
            "<span class='forum-quote'>",
            "</span>",
            "<font color=\"\\1\">",
            "</font>",
            "<font color=\"\\1\">",
            "</font>",
            "<font face=\"\\1\">",
            "</font>",
            "<font face=\"\\1\">",
            "</font>",
            "<font size=\"\\1\">",
            "</font>",
            "<font size=\"\\1\">",
            "</font>",
            "<a href=\"\\1\" target=\"_blank\">",
            "</a>",
            "<a href=\"\\1\" target=\"_blank\">",
            "</a>",
            "<p><div class='spoiler'>
                <h3>Spoiler</h3>
                <div>",
            "</div></div></p>",
            "<p><div class='spoiler'>
                <h3>Spoiler</h3>
                <div>",
            "</div></div></p>",
            "<img src=\"\\1\" alt=\"\\1\" border=\"0\" />",
            "<img src=\"\\1\" alt=\"\\1\" border=\"0\" />",
        );
        // dd("count of pattern:" . count($pattern) . "count of replacement:" . count($replacement));
        //REPLACE THE BBC WITH HTML
        $content = preg_replace($pattern, $replacement, $event->string);

        switch ($event->origin) {
            case "post":
                ForumPosts::where('id', $event->text_id)
                    ->update([
                        'post_content' => $content,
                    ]);
                break;
        }
    }
}
