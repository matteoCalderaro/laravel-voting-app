<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class MarkCommentAsNotSpam extends Component
{

    public Comment $comment;

    protected $listeners = ['setMarkAsNotSpamComment'];


    public function setMarkAsNotSpamComment($commentId){
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('markAsNotSpamCommentWasSet');

    }

    public function markAsNotSpam(){
        if(auth()->guest() || !auth()->user()->isAdmin()){
            abort(403);
        }

        $this->comment->spam_reports = 0;
        $this->comment->save();

        // $this->comment = Comment::make();

        $this->emit('commentWasMarkedAsNotSpam','Spam Counter was reset!');

    }
    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
