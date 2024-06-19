<?php

namespace App\Http\Livewire\Token;

use App\Models\Token;
use Livewire\Component;

class Create extends Component
{
    public Token $token;

    public array $listsForFields = [];

    public function mount(Token $token)
    {
        $this->token         = $token;
        $this->token->status = 'pending';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.token.create');
    }

    public function submit()
    {
        $this->validate();

        $this->token->save();

        return redirect()->route('admin.tokens.index');
    }

    protected function rules(): array
    {
        return [
            'token.private_key' => [
                'string',
                'required',
                'unique:tokens,private_key',
            ],
            'token.uxwallet' => [
                'string',
                'nullable',
            ],
            'token.token' => [
                'string',
                'nullable',
            ],
            'token.aff' => [
                'string',
                'nullable',
            ],
            'token.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['status'] = $this->token::STATUS_RADIO;
    }
}
