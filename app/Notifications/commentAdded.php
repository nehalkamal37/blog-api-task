<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;
use App\Models\Comment;

class CommentAdded extends Notification
{
    use Queueable;

    protected $post;
    protected $comment;

    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello, ' . $this->post->user->name)
                    ->line('A new comment has been added to your post: ' . $this->post->title)
                    ->line('Comment: "' . $this->comment->content . '"')
                    ->action('View Post', url('/home'))
                    ->line('Thank you for using our application!');
    }
}