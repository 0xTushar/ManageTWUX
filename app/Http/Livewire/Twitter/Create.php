<?php

namespace App\Http\Livewire\Twitter;

use App\Models\Token;
use App\Models\Twitter;
use Livewire\Component;

class Create extends Component
{
    public Twitter $twitter;

    public string $password = '';

    public array $listsForFields = [];

    public function mount(Twitter $twitter)
    {
        $this->twitter         = $twitter;
        $this->twitter->status = 'pending';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.twitter.create');
    }

    public function submit()
    {
        $this->validate();
        $this->twitter->password = $this->password;
        $this->twitter->save();

        return redirect()->route('admin.twitters.index');
    }

    protected function rules(): array
    {
        return [
            'twitter.username' => [
                'string',
                'required',
                'unique:twitters,username',
            ],
            'password' => [
                'string',
                'nullable',
            ],
            'twitter.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'twitter.token_id' => [
                'integer',
                'exists:tokens,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['status'] = $this->twitter::STATUS_RADIO;
        $this->listsForFields['token']  = Token::pluck('private_key', 'id')->toArray();
    }
}
