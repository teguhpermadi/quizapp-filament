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
    public $results = [];

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
        // detacth the tag and type from the question
        $this->question->detachTag($tag, auth()->user()->id);
        $this->tags = array_values(array_diff($this->tags, [$tag]));
    }

    public function setTag($tag)
    {
        $authId = auth()->user()->id; // for type of tag
        $this->question->attachTag($tag, $authId); 
        $this->tags[] = $tag;
        $this->newTag = '';
    }

    public function render()
    {
        if(\strlen($this->newTag) > 2) {
            $this->results = Tag::where('name->en', 'LIKE', "%".$this->newTag."%")
                                ->where('type', auth()->user()->id)
                                ->whereNotIn('name->en', $this->tags)
                                ->get()
                                ->pluck('name');
        } else {
            $this->results = [];
        }

        return view('livewire.question-tags');
    }
}
