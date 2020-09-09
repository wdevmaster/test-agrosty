<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hid' => $this->hid,
            'to' => $this->to,
            'subject' => $this->subject->name,
            'por_spam' => $this->por_spam,
            'format_body' => $this->format_body,
            'num_words' => $this->num_words,
            'num_spam_words' => $this->num_spam_words,
            'created_at' => $this->created_at,
        ];
    }
}
