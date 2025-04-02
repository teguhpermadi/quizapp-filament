<?php

namespace App\Livewire;

use App\Models\Question;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Tags\Tag;

class QuestionTags extends Component
{
    public Question $question;
    public $tags = [];
    public $newTag = '';

    public function mount(Question $question)
    {
        $this->question = $question;
        $this->tags = $this->question->tags->pluck('name')->toArray();
    }

    public function addTag()
    {
        $authId = auth()->user()->id; // for type of tag
        if (!empty($this->newTag) && !in_array($this->newTag, $this->tags)) {
            // attach the tag to the question
            // create tag and give "type" to it
            $this->question->attachTag($this->newTag, $authId); 
            $this->tags[] = $this->newTag;
            $this->newTag = '';
        }
    }

    public function removeTag($tag)
    {
        $this->question->detachTag($tag);
        $this->tags = array_values(array_diff($this->tags, [$tag]));

        // delete the tag if it is not used by any other question
        $checkTag = Question::withAnyTags($tag)->count();
        if ($checkTag == 0) {
            Tag::whereJsonContains('name', ['en'=>$tag])->delete();
        }
    }


    public function render()
    {
        return view('livewire.question-tags');
    }
}
