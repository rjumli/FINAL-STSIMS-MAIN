<?php

namespace App\Http\Resources\Scholar;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'avatar' => ($this->user) ? $this->user->avatar : 'avatar.jpg',
            'name' => $this->lastname.' '.$this->firstname.' '.$this->suffix.' '.$this->middlename,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'suffix' => $this->suffix,
            'sex' => $this->sex,
            'birthday' => ($this->birthday == null) ? '' : $this->birthday,
            'contact_no' => ($this->contact_no == null) ? 'n/a' : $this->contact_no
        ];
    }
}
